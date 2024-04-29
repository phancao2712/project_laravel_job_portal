<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Hero;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $plans = Plan::where('show_at_home', 1)->get();
        $hero = Hero::first();
        $categories = JobCategory::withCount([
            'jobs' => function ($query) {
                $query->where('status', 'active');
            }
        ])->get();
        $jobCount = Job::count();
        $countries = Country::all();
        $featuredCategory = JobCategory::where(['featured'=> 1])->take(5)->get();
        return view('frontend.home.index', compact(
            'plans',
            'hero',
            'categories',
            'countries',
            'jobCount',
            'featuredCategory'
        ));
    }
}
