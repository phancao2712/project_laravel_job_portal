<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CandidateProfileAccountUpdateRequest;
use App\Http\Requests\Frontend\CandidateUpdateProfileRequest;
use App\Http\Requests\Frontend\UpdateBasicInfoRequest;
use App\Models\Candidate;
use App\Models\CandidateEducation;
use App\Models\CandidateExperience;
use App\Models\CandidateLanguage;
use App\Models\CandidateSkill;
use App\Models\Country;
use App\Models\District;
use App\Models\Experience;
use App\Models\Language;
use App\Models\Profession;
use App\Models\Province;
use App\Models\Skill;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class CandidateProfileController extends Controller
{
    use FileUploadTrait;
    public function index(): View
    {
        $candidate = Candidate::with(['skills', 'languages'])->where('user_id', auth()->user()->id)->first();
        $experienceCandidate = CandidateExperience::where('candidate_id', $candidate?->id)->orderBy('id', 'DESC')->get();
        $educationCandidate = CandidateEducation::where('candidate_id', $candidate?->id)->orderBy('id', 'DESC')->get();
        $experience = Experience::all();
        $professions = Profession::all();
        $skills = Skill::all();
        $languages = Language::all();
        $countries = Country::all();
        $provinces = Province::select(['id', 'name', 'country_id'])->where('country_id', $candidate?->country)->get();
        $districts = District::select(['id', 'name', 'country_id', 'province_id'])->where('province_id', $candidate?->province)->get();
        return view('frontend.candidate-dashboard.profile.index', compact(
            'candidate',
            'experience',
            'professions',
            'skills',
            'languages',
            'experienceCandidate',
            'educationCandidate',
            'countries',
            'provinces',
            'districts'
        ));
    }

    public function updateBasicInfo(UpdateBasicInfoRequest $request): RedirectResponse
    {
        $picturePath = $this->uploadFile($request, 'picture', auth()->user()->profileCandidate?->image);
        $cvPath = $this->uploadFile($request, 'cv',auth()->user()->profileCandidate?->cv);

        $data = [];

        if (!empty($picturePath)) $data['image'] = $picturePath;
        if (!empty($cvPath)) $data['cv'] = $cvPath;

        $data['fullname'] = $request->fullname;
        $data['title'] = $request->title;
        $data['experience_id'] = $request->experience;
        $data['website'] = $request->website;
        $data['birth_date'] = $request->date_of_birth;

        Candidate::updateOrCreate(
            ['user_id' => auth()->user()->id],
            $data
        );

        if(checkCompleteCandidateProfile()){
            $model = Candidate::where('user_id', auth()->user()->id)->first();
            $model->profile_complete = 1;
            $model->visibility = 1;
            $model->save();
        }

        Notify::CreateNotify();

        return redirect()->back();
    }

    public function updateProfileInfo(CandidateUpdateProfileRequest $request): RedirectResponse
    {
        $data = [];

        $data['gender'] = $request->gender;
        $data['marital_status'] = $request->marital_status;
        $data['profession_id'] = $request->profession;
        $data['status'] = $request->availability;
        $data['bio'] = $request->bio;

        $candidate = Candidate::where('user_id', auth()->user()->id)->first();

        CandidateSkill::where('candidate_id', $candidate->id)->delete();
        CandidateLanguage::where('candidate_id', $candidate->id)->delete();

        foreach ($request->skill as $skill) {
            $model = new CandidateSkill();
            $model->candidate_id = $candidate->id;
            $model->skill_id = $skill;
            $model->save();
        }

        foreach ($request->language as $language) {
            $model = new CandidateLanguage();
            $model->candidate_id = $candidate->id;
            $model->language_id = $language;
            $model->save();
        }

        Candidate::updateOrCreate([
            'user_id' => auth()->user()->id,

        ], $data);

        if(checkCompleteCandidateProfile()){
            $model = Candidate::where('user_id', auth()->user()->id)->first();
            $model->profile_complete = 1;
            $model->visibility = 1;
            $model->save();
        }

        Notify::UpdateNotify();

        return redirect()->back();
    }

    public function updateAccountInfo(CandidateProfileAccountUpdateRequest $request): RedirectResponse
    {
        Candidate::updateOrCreate([
            'user_id' => auth()->user()->id,
        ],
        [
            'country' => $request->country,
            'district' => $request->district,
            'province' => $request->province,
            'address' => $request->address,
            'phone_one' => $request->phone_one,
            'phone_two' => $request->phone_two,
            'email' => $request->email,
        ]
    );

        Notify::UpdateNotify();

        return redirect()->back();

    }
}
