<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobType;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobTypeController extends Controller
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
        $query = JobType::query();

        $this->search($query, ['name']);

        $jobTypes = $query->paginate(10);

        return view('admin.job.job-type.index', compact(
            'jobTypes'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.job.job-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:job_types,name']
        ]);

        $type = new JobType();
        $type->name = $request->name;
        $type->save();

        Notify::CreateNotify();
        return to_route('admin.job-types.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jobType = JobType::findOrFail($id);
        return view('admin.job.job-type.edit', compact(
            'jobType'
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

        $type = JobType::findOrFail($id);
        $type->name = $request->name;
        $type->save();

        Notify::CreateNotify();
        return to_route('admin.job-types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobExist = Job::where('job_type_id', $id)->exists();
        if ($jobExist) {
            return response(['message' => 'error'], 500);
        }
        try {
            JobType::findOrFail($id)->delete();
            Notify::DeleteNotify();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'error'], 500);
        }
    }
}
