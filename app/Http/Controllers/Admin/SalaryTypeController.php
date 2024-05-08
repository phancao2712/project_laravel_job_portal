<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobTag;
use App\Models\SalaryType;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SalaryTypeController extends Controller
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
        $query = SalaryType::query();

        $this->search($query, ['name']);

        $salaryTypes = $query->paginate(10);

        return view('admin.job.salary-type.index', compact(
            'salaryTypes'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.job.salary-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:job_types,name']
        ]);

        $type = new SalaryType();
        $type->name = $request->name;
        $type->save();

        Notify::CreateNotify();
        return to_route('admin.salary-types.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $salaryType = SalaryType::findOrFail($id);
        return view('admin.job.salary-type.edit', compact(
            'salaryType'
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

        $type = SalaryType::findOrFail($id);
        $type->name = $request->name;
        $type->save();

        Notify::CreateNotify();
        return to_route('admin.salary-types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $jobExist = Job::where('salary_type_id', $id)->exists();
        if ($jobExist) {
            return response(['message' => 'error'], 500);
        }
        try {
            SalaryType::findOrFail($id)->delete();
            Notify::DeleteNotify();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'error'], 500);
        }
    }
}
