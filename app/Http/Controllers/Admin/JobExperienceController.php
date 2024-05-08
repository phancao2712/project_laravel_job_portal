<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Job;
use App\Models\JobExperience;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\View\View;

class JobExperienceController extends Controller
{
    use Searchable;
    function __construct(){
        $this->middleware(['permission: job attributes']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = JobExperience::query();

        $this->search($query, ['name']);

        $jobExperiences = $query->paginate(10);

        return view('admin.job.job-experience.index', compact(
            'jobExperiences'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.job.job-experience.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:job_types,name']
        ]);

        $type = new JobExperience();
        $type->name = $request->name;
        $type->save();

        Notify::CreateNotify();
        return to_route('admin.job-experiences.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jobExperience = JobExperience::findOrFail($id);
        return view('admin.job.job-experience.edit', compact(
            'jobExperience'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:job_types,name']
        ]);

        $type = JobExperience::findOrFail($id);
        $type->name = $request->name;
        $type->save();

        Notify::CreateNotify();
        return to_route('admin.job-experiences.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobExist = Job::where('job_experience_id', $id)->exists();
        $candidateExists = Candidate::where('experience_id', $id)->exists();
        if ($jobExist || $candidateExists) {
            return response(['message' => 'error'], 500);
        }
        try {
            JobExperience::findOrFail($id)->delete();
            Notify::DeleteNotify();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'error'], 500);
        }
    }
}
