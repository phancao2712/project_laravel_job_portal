<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CandidateProfileExperienceStoreRequest;
use App\Models\CandidateExperience;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class CandidateExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experienceCandidate = CandidateExperience::where('candidate_id', auth()->User()->profileCandidate->id)->orderBy('id', 'DESC')->get();

        return view('frontend.candidate-dashboard.profile.sections.table-experience', compact('experienceCandidate'))->render();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CandidateProfileExperienceStoreRequest $request) : Response
    {

        $model = new CandidateExperience();
        $model->candidate_id = auth()->User()->profileCandidate->id;
        $model->company = $request->company;
        $model->department = $request->department;
        $model->designation = $request->designation;
        $model->start = $request->start;
        $model->end = $request->end;
        $model->current_working = $request->filled('currently_working') ? 1 : 0;
        $model->responsibilites = $request->responsibilites;
        $model->save();

        return response(['message' => 'Create Success'], 200);
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
    public function edit(string $id) : Response
    {
        $candidateExp = CandidateExperience::findOrFail($id);

        return response($candidateExp);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model = CandidateExperience::findOrFail($id);

        if($model->candidate_id !== auth()->User()->profileCandidate->id){
            abort(404);
        }

        $model->company = $request->company;
        $model->department = $request->department;
        $model->designation = $request->designation;
        $model->start = $request->start;
        $model->end = $request->end;
        $model->current_working = $request->filled('current_working') ? 1 : 0;
        $model->responsibilites = $request->responsibilites;
        $model->save();

        return response(['message' => 'Update Success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $model = CandidateExperience::findOrFail($id);
            if($model->candidate_id !== auth()->User()->profileCandidate->id){
                abort(404);
            }
            $model->delete();
            return response(['message' => 'Delete Success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'error'], 500);
        }
    }
}
