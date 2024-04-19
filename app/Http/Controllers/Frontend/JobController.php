<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\JobPortStoreRequest;
use App\Models\Benefits;
use App\Models\Company;
use App\Models\Country;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Job;
use App\Models\JobBenefits;
use App\Models\JobCategory;
use App\Models\JobRole;
use App\Models\JobSkill;
use App\Models\JobTag;
use App\Models\JobType;
use App\Models\SalaryType;
use App\Models\Skill;
use App\Models\Tag;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\Request;

class JobController extends Controller
{
    use Searchable;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        storeUserPlanInfo();
        $query = Job::query();

        $this->search($query, ['title']);
        $jobs = $query->paginate(10);

        return view('frontend.company-dashboard.job.index', compact(
            'jobs'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::where(['profile_completion' => 1], ['visibility' => 1])->get();
        $categories = JobCategory::all();
        $countries = Country::all();
        $salary_types = SalaryType::all();
        $experiences = Experience::all();
        $job_roles = JobRole::all();
        $educations = Education::all();
        $job_types = JobType::all();
        $tags = Tag::all();
        $skills = Skill::all();
        return view('frontend.company-dashboard.job.create', compact(
            'companies',
            'categories',
            'countries',
            'salary_types',
            'experiences',
            'job_roles',
            'educations',
            'job_types',
            'tags',
            'skills'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobPortStoreRequest $request)
    {
        $job = new Job();
        $job->title = $request->title;
        $job->company_id = auth()->user()->company->id;
        $job->job_category_id = $request->job_category_id;
        $job->vacancies = $request->vacancies;
        $job->deadline = $request->deadline;

        $job->country = $request->country;
        $job->province = $request->province;
        $job->district = $request->district;
        $job->address = $request->address;

        $job->salary_mode = $request->salary_mode;
        $job->max_salary = $request->max_salary;
        $job->min_salary = $request->min_salary;
        $job->custom_salary = $request->custom_salary;
        $job->job_experience_id = $request->job_experience_id;
        $job->job_role_id = $request->job_role_id;
        $job->education_id = $request->education_id;
        $job->job_type_id = $request->job_type_id;
        $job->salary_type_id = $request->salary_type;

        $job->apply_on = $request->receive_application;
        $job->featured = $request->featured;
        $job->highlight = $request->highlight;
        $job->description = $request->description;
        $job->save();

        // insert tag
        foreach ($request->tags as $tagItem) {
            $tag = new JobTag();
            $tag->job_id = $job->id;
            $tag->tag_id = $tagItem;
            $tag->save();
        }

        $benefits = explode(',', $request->benefits);

        // insert benefits and jobBenefits
        foreach ($benefits as $benefitItem) {
            $benefit = new Benefits();
            $benefit->company_id = auth()->user()->company->id;
            $benefit->name = $benefitItem;
            $benefit->save();

            $jobBenefit = new JobBenefits();
            $jobBenefit->job_id = $job->id;
            $jobBenefit->benefit_id = $benefit->id;
            $jobBenefit->save();
        }

        // insert skill
        foreach ($request->skills as $skillItem) {
            $skill = new JobSkill();
            $skill->job_id = $job->id;
            $skill->skill_id = $skillItem;
            $skill->save();
        }

        Notify::CreateNotify();

        return to_route('company.jobs.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $job = Job::findOrFail($id);
        $categories = JobCategory::all();
        $countries = Country::all();
        $salary_types = SalaryType::all();
        $experiences = Experience::all();
        $job_roles = JobRole::all();
        $educations = Education::all();
        $job_types = JobType::all();
        $tags = Tag::all();
        $skills = Skill::all();
        return view('frontend.company-dashboard.job.edit', compact(
            'categories',
            'countries',
            'salary_types',
            'experiences',
            'job_roles',
            'educations',
            'job_types',
            'tags',
            'skills',
            'job'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $job = Job::findOrFail($id);
        $job->title = $request->title;
        $job->company_id = auth()->user()->company->id;
        $job->job_category_id = $request->job_category_id;
        $job->vacancies = $request->vacancies;
        $job->deadline = $request->deadline;

        $job->country = $request->country;
        $job->province = $request->province;
        $job->district = $request->district;
        $job->address = $request->address;

        $job->salary_mode = $request->salary_mode;
        $job->max_salary = $request->max_salary;
        $job->min_salary = $request->min_salary;
        $job->custom_salary = $request->custom_salary;
        $job->job_experience_id = $request->job_experience_id;
        $job->job_role_id = $request->job_role_id;
        $job->education_id = $request->education_id;
        $job->job_type_id = $request->job_type_id;
        $job->salary_type_id = $request->salary_type;

        $job->apply_on = $request->receive_application;
        $job->featured = $request->featured;
        $job->highlight = $request->highlight;
        $job->description = $request->description;
        $job->save();

        // insert tag
        JobTag::where('job_id', $id)->delete();
        foreach ($request->tags as $tagItem) {
            $tag = new JobTag();
            $tag->job_id = $job->id;
            $tag->tag_id = $tagItem;
            $tag->save();
        }


        $selected_benefits = JobBenefits::where('job_id', $id);
        foreach ($selected_benefits->get() as $selected_benefit) {
            Benefits::find($selected_benefit->benefit_id)->delete();
        }
        $selected_benefits->delete();
        $benefits = explode(',', $request->benefits);
        // insert benefits and jobBenefits
        foreach ($benefits as $benefitItem) {
            $benefit = new Benefits();
            $benefit->company_id = auth()->user()->company->id;
            $benefit->name = $benefitItem;
            $benefit->save();

            $jobBenefit = new JobBenefits();
            $jobBenefit->job_id = $job->id;
            $jobBenefit->benefit_id = $benefit->id;
            $jobBenefit->save();
        }

        JobSkill::where('job_id', $id)->delete();
        // insert skill
        foreach ($request->skills as $skillItem) {
            $skill = new JobSkill();
            $skill->job_id = $job->id;
            $skill->skill_id = $skillItem;
            $skill->save();
        }

        Notify::UpdateNotify();

        return to_route('company.jobs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Job::findOrFail($id)->delete();
            Notify::DeleteNotify();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'error'], 500);
        }
    }
}
