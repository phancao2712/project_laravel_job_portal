<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Company;
use App\Models\Country;
use App\Models\Footer;
use App\Models\Hero;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobLocation;
use App\Models\LearnMore;
use App\Models\Plan;
use App\Models\WhyChooseUsSection;
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
        $whyChooseUs = WhyChooseUsSection::first();
        $learnMore = LearnMore::first();

        $companies = Company::select('name','logo','slug','province')->withCount(['jobs' => function($query){
            $query->where('status', 'active')->where('deadline','>=',date('Y-m-d'));
        }])->where(['profile_completion' => 1, 'visibility' => 1])->latest()->take(20)->get();

        $jobLocations = JobLocation::take(8)->get();
        $blogs = Blog::take(6)->get();
        return view('frontend.home.index', compact(
            'plans',
            'hero',
            'categories',
            'countries',
            'jobCount',
            'featuredCategory',
            'whyChooseUs',
            'learnMore',
            'companies',
            'jobLocations',
            'blogs'
        ));
    }
}
