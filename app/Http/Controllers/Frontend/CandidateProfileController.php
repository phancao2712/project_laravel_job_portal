<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\UpdateBasicInfoRequest;
use App\Models\Candidate;
use App\Models\Experience;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class CandidateProfileController extends Controller
{
    use FileUploadTrait;
    public function index() : View
    {
        $candidate = Candidate::where('user_id', auth()->user()->id)->first();
        $experience = Experience::all();
        return view('frontend.candidate-dashboard.profile.index', compact(
            'candidate',
            'experience'
        ));
    }

    public function updateBasicInfo(UpdateBasicInfoRequest $request) : RedirectResponse
    {
        $picturePath = $this->uploadFile($request, 'picture');
        $cvPath = $this->uploadFile($request, 'cv');

        $data = [];

        if(!empty($picturePath)) $data['image'] = $picturePath;
        if(!empty($cvPath)) $data['cv'] = $cvPath;

        $data['fullname'] = $request->fullname;
        $data['title'] = $request->title;
        $data['experience_id'] = $request->experience;
        $data['website'] = $request->website;
        $data['birth_date'] = $request->date_of_birth;

        Candidate::updateOrCreate(
            ['user_id' => auth()->user()->id],
            $data
        );

        Notify::CreateNotify();

        return redirect()->back();
    }
}
