<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index() :View {
        $plans = Plan::where('show_at_home', 1)->get();
        return view('frontend.home.index', compact(
            'plans'
        ));
    }
}
