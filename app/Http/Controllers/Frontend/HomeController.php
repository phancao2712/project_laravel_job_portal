<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Hero;
use App\Models\Industry_type;
use App\Models\JobCategory;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index() :View {
        $plans = Plan::where('show_at_home', 1)->get();
        $hero = Hero::first();
        $categories = JobCategory::all();
        $countries = Country::all();
        return view('frontend.home.index', compact(
            'plans',
            'hero',
            'categories',
            'countries'
        ));
    }
}
