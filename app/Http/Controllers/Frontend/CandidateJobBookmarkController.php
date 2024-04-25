<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\JobBookmark;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CandidateJobBookmarkController extends Controller
{
    public function save(string $id) : Response {
        if(!auth()->check()){
            throw ValidationException::withMessages(['Please login for bookmark the job']);
        }

        if(auth()->user()->role !== 'candidate'){
            throw ValidationException::withMessages(["Only candidate can bookmark job"]);
        }

        $alreadyBookmark = JobBookmark::where(['job_id' => $id, 'candidate_id' => auth()->user()->id ])->exists();

        if($alreadyBookmark){
            throw ValidationException::withMessages(['You already bookmark to this job']);
        }

        $applyJob = new JobBookmark();
        $applyJob->job_id = $id;
        $applyJob->candidate_id = auth()->user()->id;
        $applyJob->save();
        return response(['message' => 'Bookmark successful', 'id' => $id]);
    }
}
