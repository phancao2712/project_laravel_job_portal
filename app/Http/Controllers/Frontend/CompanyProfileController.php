<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CompanyFoundingInfoUpdateRequest;
use App\Http\Requests\Frontend\CompanyUpdateRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Traits\FileUploadTrait;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules;

class CompanyProfileController extends Controller
{
    use FileUploadTrait;

    function index():View {
        $companyInfo = Company::where('user_id', auth()->user()->id)->first();
        return view('frontend.company-dashboard.profile.index', compact(
            'companyInfo'
        ));
    }

    function companyInfoUpdate(CompanyUpdateRequest $request) :RedirectResponse {
        $logoPath = $this->uploadFile($request, 'logo');
        $bannerPath = $this->uploadFile($request, 'banner');

        $data = [];
        if(!empty($logoPath)) { $data['logo'] = $logoPath; }
        if(!empty($bannerPath)) { $data['banner'] = $bannerPath; }

        $data['name'] = $request->name;
        $data['vision'] = $request->vision;
        $data['bio'] = $request->bio;

        Company::updateOrCreate(
        ['user_id' => auth()->user()->id],
        $data);

        notify()->success('Update Success','Success!');
        return redirect()->back();
    }

    function foundingInfoUpdate(CompanyFoundingInfoUpdateRequest $request) :RedirectResponse
    {
        Company::updateOrCreate(
            ['user_id' => auth()->user()->id],
            [
                "industry_type_id" => $request->industry_type_id,
                "organization_type_id" => $request->organization_type_id,
                "team_size_id" => $request->team_size_id,
                "establishment_date" => $request->establishment_date ,
                "website" => $request->website,
                "email" => $request->email,
                "phone" => $request->phone,
                "country" => $request->country,
                "state" => $request->state,
                "city" => $request->city,
                "address" => $request->address,
                "map_link" => $request->maplink
            ]
        );
        notify()->success('Update Success','Success');
        return redirect()->back();
    }

    function accountInfoUpdate(Request $request): RedirectResponse
    {

        $validate = $request->validate([
            'email' => ['required', 'email'],
            'name' => ['required', 'string', 'max:50']
        ]);

        Auth::user()->update($validate);

        notify()->success('Update Success','Success!');
        return redirect()->back();
    }

    function updatePassword(Request $request):RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        Auth::user()->update(['password' => bcrypt($request->password)]);
        notify()->success('Update Success','Success!');
        return redirect()->back();
    }

}
