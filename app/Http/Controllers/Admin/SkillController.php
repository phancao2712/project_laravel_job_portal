<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CandidateSkill;
use App\Models\JobSkill;
use App\Models\Skill;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    use Searchable;
    function __construct(){
        $this->middleware(['permission: job attributes']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $query = Skill::query();

       $this->search($query, ['name']);

       $skills = $query->orderBy('id', 'DESC')->paginate(10);

       return view('admin.skill.index', compact(
        'skills'
       ));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.skill.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:skills,name'],
        ]);

        $model = new Skill();
        $model->name = $request->name;
        $model->save();

        Notify::CreateNotify();
        return to_route('admin.skills.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $skill = Skill::findOrFail($id);
        return view('admin.skill.edit', compact(
            'skill'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:skills,name'],
        ]);

        $model = Skill::findOrFail($id);
        $model->name = $request->name;
        $model->save();

        Notify::UpdateNotify();
        return to_route('admin.skills.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobExist = JobSkill::where('skill_id', $id)->exists();
        $candidateExist = CandidateSkill::where('skill_id', $id)->exists();
        if ($jobExist || $candidateExist) {
            return response(['message' => 'error'], 500);
        }
        try {
            $skill = Skill::findOrFail($id)->delete();
            Notify::DeleteNotify();
            return response(['message' => 'Success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'error'], 500);
        }
    }
}
