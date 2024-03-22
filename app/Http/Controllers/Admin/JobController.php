<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobPortStoreRequest;
use App\Models\Company;
use App\Models\Country;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobRole;
use App\Models\JobTag;
use App\Models\JobType;
use App\Models\SalaryType;
use App\Models\Skill;
use App\Models\Tag;
use App\Services\Notify;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('admin.job.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
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
        return view('admin.job.create', compact(
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
        $job->company_id = $request->company_id;
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

        Notify::CreateNotify();

        return to_route('admin.jobs.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
