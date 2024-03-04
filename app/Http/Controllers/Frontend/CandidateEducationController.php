<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CandidateEducationStoreRequest;
use App\Models\CandidateEducation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CandidateEducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $candidateEducation = CandidateEducation::where('candidate_id', auth()->user()->profileCandidate->id)->orderBy('id', 'DESC')->get();
        return view('frontend.candidate-dashboard.profile.sections.table-education', compact(
            'candidateEducation'
        ));
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
    public function store(CandidateEducationStoreRequest $request) : Response
    {
        $model = new CandidateEducation();

        $model->candidate_id = auth()->user()->profileCandidate->id;
        $model->level = $request->level;
        $model->year = $request->year;
        $model->degree = $request->degree;
        $model->note = $request->note;
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
        $candidateEducation = CandidateEducation::findOrFail($id);
        return response($candidateEducation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CandidateEducationStoreRequest $request, string $id)
    {
        $model = CandidateEducation::findOrFail($id);

        if(auth()->user()->profileCandidate->id !== $model->id){
            abort(404);
        }
        $model->level = $request->level;
        $model->year = $request->year;
        $model->degree = $request->degree;
        $model->note = $request->note;
        $model->save();

        return response(['message' => 'Update Success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $model = CandidateEducation::findOrFail($id);
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
