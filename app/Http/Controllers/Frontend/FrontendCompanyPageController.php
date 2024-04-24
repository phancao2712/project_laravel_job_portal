<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Country;
use App\Models\District;
use App\Models\Industry_type;
use App\Models\Job;
use App\Models\Organization_type;
use App\Models\Province;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendCompanyPageController extends Controller
{
    use Searchable;
    function index(Request $request) : View {
        $selectedDistrict = null;
        $selectedProvince = null;
        $query = Company::query();
        $query->withCount(['jobs' => function($query){
            $query->where('status', 'active')->where('deadline','>=',date('Y-m-d'));
        }])
        ->where(['profile_completion' => 1, 'visibility' => 1]);

        $this->search($query, ['name']);
        $this->searchItem($query, 'country');
        $this->searchItem($query, 'province');
        $this->searchItem($query, 'district');

        if($request->has('country') && $request->filled('country')){
            $selectedProvince = Province::where('country_id',$request->country)->get();
        }
        $this->searchItem($query, 'province');
        if($request->has('province') && $request->filled('province')){
            $selectedDistrict = District::where('province_id',$request->province)->get();
        }
        if($request->has('industry') && $request->filled('industry')){
            $query->whereHas('companyIndustry', function ($query) use ($request) {
                $query->where('slug', $request->industry);
            });
        }
        if($request->has('organization') && $request->filled('organization')){
            $query->whereHas('companyOrganization', function ($query) use ($request) {
                $query->where('slug', $request->organization);
            });
        }

        $companies = $query->paginate(20);
        $countries = Country::all();
        $industries = Industry_type::withCount('companies')->get();
        $organization_types = Organization_type::withCount('companies')->get();

        return view('frontend.pages.company-page', compact(
            'companies',
            'selectedProvince',
            'selectedDistrict',
            'countries',
            'industries',
            'organization_types'
        ));
    }

    function show(string $slug) : View
    {
        $company = Company::where(['profile_completion' => 1, 'visibility' => 1, 'slug' => $slug])->firstOrFail();
        $openJobs = Job::where('company_id', $company->id)->where('status', 'active')->where('deadline', '>=', date('Y-m-d'))->paginate(5);
        return view('frontend.pages.company-detail', compact(
            'company',
            'openJobs'
        ));
    }
}
