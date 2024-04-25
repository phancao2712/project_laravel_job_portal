<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\JobBookmark;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CandidateJobBookmarkController extends Controller
{
    public function index() : View {
        $bookmarkJobs = JobBookmark::with('job')->where(['candidate_id' => auth()->user()->id])->paginate(10);
        return view('frontend.candidate-dashboard.bookmark-job.index', compact(
            'bookmarkJobs'
        ));
    }
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

    public function destroy(string $id) {
        try {
            $Bookmark = JobBookmark::findOrFail($id)->delete();
            return response(['message' => 'Success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'error'], 500);
        }
    }
}
