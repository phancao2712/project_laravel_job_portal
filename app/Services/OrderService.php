<?php

namespace App\Services;

use App\Models\Order;
use App\Models\UserPlan;
use Auth;
use Illuminate\Support\Facades\Session;

class OrderService
{
    static function OrderService(
        string $transactionId,
        string $paymentProvider,
        string $amount,
        string $painInCurrency,
        string $paymentStatus
    ) {
        $model = new Order();
        $model->company_id = Auth::user()->company->id;
        $model->plan_id = Session::get('selected_plan')['id'];
        $model->package_name = Session::get('selected_plan')['label'];
        $model->transaction_id = $transactionId;
        $model->order_id = uniqid();
        $model->payment_provider = $paymentProvider;
        $model->amount = $amount;
        $model->paid_in_currency = $painInCurrency;
        $model->default_amount = Session::get('selected_plan')['price'] . config('settings.site_default_currency');
        $model->payment_status = $paymentStatus;

        $model->save();
    }


    static function setUserPlan()
    {
        $userPlan = UserPlan::where('company_id', Auth::user()->company->id)->first();
        UserPlan::updateOrCreate(
            ['company_id' => Auth::user()->company->id],
            [
                'plan_id' =>  Session::get('selected_plan')['id'],

                'job_limit' => $userPlan?->job_limit ?
                    $userPlan?->job_limit + Session::get('selected_plan')['job_limit'] :
                    Session::get('selected_plan')['job_limit'],

                'featured_job_limit' => $userPlan?->featured_job_limit ?
                    $userPlan?->featured_job_limit + Session::get('selected_plan')['featured_job_limit'] :
                    Session::get('selected_plan')['featured_job_limit'],

                'highlight_job_limit' => $userPlan?->highlight_job_limit ?
                    $userPlan?->highlight_job_limit + Session::get('selected_plan')['highlight_job_limit'] :
                    Session::get('selected_plan')['highlight_job_limit'],

                'profile_verified' => Session::get('selected_plan')['profile_verified']
            ]
        );
    }
}
