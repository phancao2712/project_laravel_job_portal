<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Order;
use App\Models\UserPlan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompanyDashboardController extends Controller
{
    public function index():View {
        $jobPostCount = Job::where('company_id', auth()->user()->company?->id)->where('status', ['pending', 'active'])->count();
        $jobTotalCount = Job::where('company_id', auth()->user()->company?->id)->count();
        $totalOrders = Order::where('company_id', auth()->user()->company?->id)->get();
        $userPlan = UserPlan::where('company_id', auth()->user()->company?->id)->first();
        return view('frontend.company-dashboard.dashboard', compact(
            'jobPostCount',
            'jobTotalCount',
            'totalOrders',
            'userPlan'
        ));
    }
}
