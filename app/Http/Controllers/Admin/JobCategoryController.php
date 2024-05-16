<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobCategory;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class JobCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use Searchable;
    function __construct(){
        $this->middleware(['permission: job category create|job category update|job category delete'])->only('index');
        $this->middleware(['permission: job category create'])->only('create','store');
        $this->middleware(['permission: job category update'])->only('update','edit');
        $this->middleware(['permission: job category delete'])->only('destroy');
    }
    public function index(): View
    {
        $query = JobCategory::query();

        $this->search($query, ['name']);

        $jobCategories = $query->withCount(['jobs' => function ($query) {
            $query->where('status', 'active')->where('deadline', '>=', date('Y-m-d'));
        }])->paginate(10);
        return view('admin.job.job-category.index', compact(
            'jobCategories'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.job.job-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => ['required', 'max:255'],
            'name' => ['required', 'max:255']
        ]);

        $data = [];
        $data['name'] = $request->name;
        $data['icon'] = $request->icon;
        JobCategory::create(
            $data
        );

        Notify::CreateNotify();

        return to_route('admin.job-categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $jobCategory = JobCategory::findOrFail($id);
        return view('admin.job.job-category.edit', compact(
            'jobCategory'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon' => ['nullable', 'max:255'],
            'name' => ['required', 'max:255']
        ]);

        $jobCategory = JobCategory::findOrFail($id);
        if ($request->filled('icon')) $jobCategory->icon = $request->icon;

        $data = [];
        $data['name'] = $request->name;
        $data['icon'] = $request->icon;
        JobCategory::updateOrCreate(
            ['id' => $id],
            $data
        );

        Notify::CreateNotify();

        return to_route('admin.job-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobExist = Job::where('job_category_id', $id)->exists();
        if ($jobExist) {
            return response(['message' => 'error'], 500);
        }
        try {
            JobCategory::findOrFail($id)->delete();
            Notify::DeleteNotify();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'error'], 500);
        }
    }

    public function changeStatus(string $id): Response
    {
        $jobCategory = JobCategory::FindOrFail($id);
        $jobCategory->featured = $jobCategory->featured == 0 ? 1 : 0;
        $jobCategory->save();
        Notify::UpdateNotify();
        return response(['message' => 'success', 200]);
    }
}
