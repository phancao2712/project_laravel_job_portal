<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CompanyUpdateRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Traits\FileUploadTrait;

class CompanyProfileController extends Controller
{
    use FileUploadTrait;

    function index():View {
        $companyInfo = Company::where('user_id', auth()->user()->id)->first();
        return view('frontend.company-dashboard.profile.index', compact(
            'companyInfo'
        ));
    }

    function companyInfoUpdate(CompanyUpdateRequest $request) {
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

        notify()->success('Update Success','Success');
        return redirect()->back();
    }
}
