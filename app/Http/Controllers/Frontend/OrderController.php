<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class OrderController extends Controller
{
    public function index() : View {
        $orders = Order::where('company_id', auth()->user()->company?->id)->paginate(10);
        return view('frontend.company-dashboard.order.index', compact(
            'orders'
        ));
    }

    function show(string $id) : View
    {
        $order = Order::findOrFail($id);
        return view('frontend.company-dashboard.order.detail', compact(
            'order'
        ));
    }

    function invoice(string $id) {
        $order = Order::findOrFail($id);
        $customer = new Buyer([
            'name'          => $order->company->name,
            'custom_fields' => [
                'email' => $order->company->email,
                'transaction no' => $order->transaction_id,
                'payment provider' => $order->payment_provider

            ],
        ]);

        $seller = new Party([
            'name'          => config('settings.site_name'),
            'custom_fields' => [
                'email' => config('settings.site_email'),
                'phone' => config('settings.site_phone')
            ],
        ]);

        $item = InvoiceItem::make($order->package_name . 'Plan')->pricePerUnit($order->amount);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->seller($seller)
            ->series($order->order_id)
            ->currencyCode($order->paid_in_currency)
            ->currencySymbol($order->paid_in_currency)
            ->status('paid')
            ->payUntilDays(0)
            ->addItem($item);

        return $invoice->download();
    }
}
