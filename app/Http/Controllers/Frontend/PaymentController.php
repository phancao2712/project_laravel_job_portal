<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Stripe;
use Stripe\Checkout\Session as SessionStripe;
use Razorpay\Api\Api as RazorpayApi;

class PaymentController extends Controller
{
    // pay with paypal
    function setPaypalSetting(): array
    {
        return [
            'mode'    => env('PAYPAL_MODE', 'sandbox'),
            'sandbox' => [
                'client_id'         => config('gatewaySettings.paypal_client_id'),
                'client_secret'     => config('gatewaySettings.paypal_secret_key'),
                'app_id'            => 'APP-80W284485P519543T',
            ],
            'live' => [
                'client_id'         => config('gatewaySettings.paypal_client_id'),
                'client_secret'     => config('gatewaySettings.paypal_secret_key'),
                'app_id'            => config('gatewaySettings.paypal_app_id'),
            ],

            'payment_action' => 'Sale',
            'currency'       => config('gatewaySettings.paypal_currency_name'),
            'notify_url'     => '',
            'locale'         => 'en_US',
            'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true),
        ];
    }

    function payWithPaypal()
    {
        abort_if(!$this->checkSession(), 404);
        $paypalSetting = $this->setPaypalSetting();
        $provider = new PayPalClient($paypalSetting);
        $provider->getAccessToken();

        $paypalAmount = round(Session::get('selected_plan')['price'] * config('gatewaySettings.paypal_currency_rate'));

        $response = $provider->createOrder([
            'intent' => 'CAPTURE',
            'application_context' => [
                'return_url' => route('company.paypal.success'),
                'cancel_url' => route('company.payment.cancel')
            ],
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => config('gatewaySettings.paypal_currency_name'),
                        'value' => $paypalAmount
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] !== null) {
            foreach ($response['links'] as $link) {
                if ($link['rel']  === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }
    }

    function paypalSuccess(Request $request)
    {
        abort_if(!$this->checkSession(), 404);
        $paypalSetting = $this->setPaypalSetting();
        $provider = new PayPalClient($paypalSetting);
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] === 'COMPLETED') {

            $capture = $response['purchase_units'][0]['payments']['captures'][0];
            try {
                OrderService::OrderService($capture['id'], 'paypal', $capture['amount']['value'], $capture['amount']['currency_code'], 'paid');
                OrderService::setUserPlan();

                Session::forget('selected_plan');

                return redirect()->route('company.payment.success');
            } catch (\Exception $e) {
                logger('Payment ERROR' >> $e);
            }
        }

        return redirect()->route('company.payment.error')->withErrors(['errors' => $response['error']['message']]);
    }

    // pay with stripe
    function payWithStripe()
    {
        abort_if(!$this->checkSession(), 404);

        Stripe::setApiKey(config('gatewaySettings.stripe_secret_key'));

        $paypalAmount = round(Session::get('selected_plan')['price'] * config('gatewaySettings.stripe_currency_rate')) * 100;

        $response = SessionStripe::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => config('gatewaySettings.stripe_currency_name'),
                        'product_data' => [
                            'name' => Session::get('selected_plan')['label'] . 'Package',
                        ],
                        'unit_amount' => $paypalAmount
                    ],
                    'quantity' => 1
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('company.stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('company.payment.cancel')
        ]);

        return redirect()->away($response->url);
    }

    function stripeSuccess(Request $request)
    {
        abort_if(!$this->checkSession(), 404);

        Stripe::setApiKey(config('gatewaySettings.stripe_secret_key'));

        $sessionId = $request->session_id;

        $response = SessionStripe::retrieve($sessionId);

        if ($response->payment_status === 'paid') {
            try {
                OrderService::OrderService($response->payment_intent, 'stripe', ($response->amount_total / 100), $response->currency, $response->payment_status);
                OrderService::setUserPlan();

                Session::forget('selected_plan');

                return redirect()->route('company.payment.success');
            } catch (\Exception $e) {
                logger($e);
            }
        }
    }

    // pay with razorpay
    function razorpayRedirect(): View
    {
        abort_if(!$this->checkSession(), 404);
        return view('frontend.pages.razorpay-redirect');
    }

    function payWithRazorpay(Request $request)
    {
        abort_if(!$this->checkSession(), 404);
        $api = new RazorpayApi(
            config('gatewaySettings.razorpay_key'),
            config('gatewaySettings.razorpay_secret_key')
        );

        if (isset($request->razorpay_payment_id) && filled($request->razorpay_payment_id)) {
            $amount = (Session::get('selected_plan')['price']) * config('gatewaySettings.razorpay_currency_rate') * 100;

            try {
                $response =  $api->payment
                    ->fetch($request->razorpay_payment_id)
                    ->capture(['amount' => $amount]);

                if ($response->status === 'captured') {
                    OrderService::OrderService(
                        $response->id,
                        'razorpay',
                        ($response->amount / 100),
                        $response->currency,
                        'paid'
                    );
                    OrderService::setUserPlan();

                    Session::forget('selected_plan');
                    return redirect()->route('company.payment.success');
                } else {
                    redirect()->route('company.payment.error')->withErrors(['error' => 'Something went wrong please try again.']);
                }
            } catch (\Exception $e) {
                logger($e);
                redirect()->route('company.payment.error')->withErrors(['error' => $e->getMessage()]);
            }
        }
    }

    function success(): View
    {
        return view('frontend.pages.success-page');
    }

    function error(): View
    {
        return view('frontend.pages.error-page');
    }

    function cancel()
    {
        return redirect()->route('company.payment.error')->withErrors(['error' => 'Something went wrong please try again']);
    }

    function checkSession() : bool {
        if(session()->has('selected_plan')){
            return true;
        }
        return false;
    }
}
