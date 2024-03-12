<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use Searchable;
    public function index() : View
    {
        $query = JobCategory::query();

        $this->search($query, ['name']);

        $jobCategories = $query->paginate(10);
        return view('admin.job.job-category.index', compact(
            'jobCategories'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
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

        $jobCategory = new JobCategory();
        $jobCategory->icon = $request->icon;
        $jobCategory->name = $request->name;
        $jobCategory->save();

        Notify::CreateNotify();

        return to_route('admin.job-categories.index');
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
