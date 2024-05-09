<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CompanyFoundingInfoUpdateRequest;
use App\Http\Requests\Frontend\CompanyUpdateRequest;
use App\Models\Company;
use App\Models\Country;
use App\Models\District;
use App\Models\Industry_type;
use App\Models\Organization_type;
use App\Models\Province;
use App\Models\TeamSize;
use App\Services\Notify;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Traits\FileUploadTrait;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules;

class CompanyProfileController extends Controller
{
    use FileUploadTrait;

    function index(): View
    {
        $companyInfo = Company::where('user_id', auth()->user()->id)->first();
        $industryTypes = Industry_type::all();
        $organizationTypes = Organization_type::all();
        $teamSizes = TeamSize::all();
        $countries = Country::all();
        $provinces = Province::select(['id', 'name', 'country_id'])->where('country_id', $companyInfo?->country)->get();
        $districts = District::select(['id', 'name', 'country_id', 'province_id'])->where('province_id', $companyInfo?->province)->get();

        return view('frontend.company-dashboard.profile.index', compact(
            'companyInfo',
            'industryTypes',
            'organizationTypes',
            'teamSizes',
            'countries',
            'provinces',
            'districts'
        ));
    }

    function companyInfoUpdate(CompanyUpdateRequest $request): RedirectResponse
    {

        $logoPath = $this->uploadFile($request, 'logo',auth()->user()->company?->banner);
        $bannerPath = $this->uploadFile($request, 'banner',auth()->user()->company?->logo);

        $data = [];
        if (!empty($logoPath)) {
            $data['logo'] = $logoPath;
        }
        if (!empty($bannerPath)) {
            $data['banner'] = $bannerPath;
        }

        $data['name'] = $request->name;
        $data['vision'] = $request->vision;
        $data['bio'] = $request->bio;

        Company::updateOrCreate(
            ['user_id' => auth()->user()->id],
            $data
        );

        if(checkCompleteProfile()){
            $company = Company::where('user_id', auth()->user()->id)->first();
            $company->profile_completion = 1;
            $company->visibility = 1;
            $company->save();
        }

        Notify::UpdateNotify();
        return redirect()->back();
    }

    function foundingInfoUpdate(CompanyFoundingInfoUpdateRequest $request): RedirectResponse
    {
        Company::updateOrCreate(
            ['user_id' => auth()->user()->id],
            [
                "industry_type_id" => $request->industry_type_id,
                "organization_type_id" => $request->organization_type_id,
                "team_size_id" => $request->team_size_id,
                "establishment_date" => $request->establishment_date,
                "website" => $request->website,
                "email" => $request->email,
                "phone" => $request->phone,
                "country" => $request->country,
                "province" => $request->province,
                "district" => $request->district,
                "address" => $request->address,
                "map_link" => $request->maplink
            ]
        );

        if(checkCompleteProfile()){
            $company = Company::where('user_id', auth()->user()->id)->first();
            $company->profile_completion = 1;
            $company->visibility = 1;
            $company->save();
        }


        Notify::UpdateNotify();
        return redirect()->back();
    }

    function accountInfoUpdate(Request $request): RedirectResponse
    {

        $validate = $request->validate([
            'email' => ['required', 'email'],
            'name' => ['required', 'string', 'max:50']
        ]);

        Auth::user()->update($validate);

        Notify::UpdateNotify();
        return redirect()->back();
    }

    function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        Auth::user()->update(['password' => bcrypt($request->password)]);
        Notify::UpdateNotify();
        return redirect()->back();
    }
}
