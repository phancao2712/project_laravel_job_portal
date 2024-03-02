<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CandidateUpdateProfileRequest;
use App\Http\Requests\Frontend\UpdateBasicInfoRequest;
use App\Models\Candidate;
use App\Models\CandidateLanguage;
use App\Models\CandidateSkill;
use App\Models\Experience;
use App\Models\Language;
use App\Models\Profession;
use App\Models\Skill;
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
        $candidate = Candidate::with(['skills' ,'languages'])->where('user_id', auth()->user()->id)->first();
        $experience = Experience::all();
        $professions = Profession::all();
        $skills = Skill::all();
        $languages = Language::all();
        return view('frontend.candidate-dashboard.profile.index', compact(
            'candidate',
            'experience',
            'professions',
            'skills',
            'languages'
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

    public function updateProfileInfo(CandidateUpdateProfileRequest $request) : RedirectResponse
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

        Notify::UpdateNotify();

        return redirect()->back();

    }
}
