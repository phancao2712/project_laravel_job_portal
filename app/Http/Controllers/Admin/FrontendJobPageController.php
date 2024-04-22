<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\District;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobType;
use App\Models\Province;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendJobPageController extends Controller
{
    use Searchable;
    public function index(Request $request) : View
    {

        $selectedDistrict = null;
        $selectedProvince = null;
        $query = Job::query();

        $query->where(['status' => 'active'])
            ->where('deadline', '>=', date('Y-m-d'));

        if($request->has('search') && $request->filled('search')){
            $query->where('title' , 'LIKE' , '%' . $request->search . '%');
        }
        if($request->has('country') && $request->filled('country')){
            $query->where('country' , 'LIKE' , '%' . $request->country . '%');
        }
        if($request->has('province') && $request->filled('province')){
            $query->where('province' , 'LIKE' , '%' . $request->province . '%');
            $selectedProvince = Province::where('country_id', $request->country)->get();
        }
        if($request->has('district') && $request->filled('district')){
            $query->where('district' , 'LIKE' , '%' . $request->district . '%');
            $selectedDistrict = District::where('province_id', $request->province)->get();
        }
        if($request->has('category') && $request->filled('category')){
            $categoryIds = JobCategory::whereIn('slug', request('category'))->pluck('id')->toArray();
            $query->whereIn('job_category_id', $categoryIds);
        }
        if($request->has('min_salary') && $request->filled('min_salary') && $request->min_salary > 0){
            $query->where('min_salary', '<=', $request->min_salary)->where('max_salary','>=',$request->min_salary);
        }
        if($request->has('type') && $request->filled('type')){
            $typeIds = JobType::whereIn('slug', request('type'))->pluck('id')->toArray();
            $query->whereIn('job_type_id', $typeIds);
        }

        $jobs = $query->paginate(10);

        $countries = Country::all();
        $categories = JobCategory::withCount(['jobs' => function($query){
            $query->where('status', 'active')->where('deadline', '>=', date('Y-m-d'));
        }])->get();
        $jobTypes = JobType::withCount(['jobs' => function($query){
            $query->where('status', 'active')->where('deadline', '>=', date('Y-m-d'));
        }])->get();
        return view('frontend.pages.job-index', compact(
            'jobs',
            'countries',
            'categories',
            'jobTypes',
            'selectedProvince',
            'selectedDistrict'
        ));
    }

    public function show(string $slug) : View
    {
        $job = Job::where(['slug' => $slug])->first();
        $openJob = Job::where('company_id', $job->company->id)->where('status', 'active')->where('deadline', '>=', date('Y-m-d'))->count();

        return view('frontend.pages.job-show', compact(
            'job',
            'openJob'
        ));
    }
}
