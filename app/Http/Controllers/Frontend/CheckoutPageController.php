<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Services\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CheckoutPageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,string $id)
    {
        if(!isset(auth()->user()->company->id) && empty(auth()->user()->company->id)){
            Notify::ErrorNotify('You haven\'t registered company information');
            return to_route('company.dashboard');
        }
        $plan = Plan::findOrFail($id);
        Session::put('selected_plan', $plan->toArray());
        return view('frontend.pages.checkout-page', compact(
            'plan'
        ));
    }
}
