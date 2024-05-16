<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Job;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\View\View;


class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use Searchable;
    function __construct(){
        $this->middleware(['permission: job attributes']);
    }
    public function index()
    {
        $query = Education::query();

        $this->search($query, ['name']);

        $educations = $query->paginate(10);
        return view('admin.job.education.index', compact(
            'educations'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('admin.job.education.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:education,name']
        ]);

        $data = [];
        $data['name'] = $request->name;
        Education::create(
            $data
        );

        Notify::CreateNotify();
        return to_route('admin.education.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $education = Education::findOrFail($id);
        return view('admin.job.education.edit', compact(
            'education'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:255']
        ]);

        $data = [];
        $data['name'] = $request->name;
        Education::updateOrCreate(
            ['id' => $id],
            $data
        );

        Notify::CreateNotify();
        return to_route('admin.education.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobExist = Job::where('education_id', $id)->exists();
        if ($jobExist) {
            return response(['message' => 'error'], 500);
        }
        try {
            Education::findOrFail($id)->delete();
            Notify::DeleteNotify();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'error'], 500);
        }
    }
}
