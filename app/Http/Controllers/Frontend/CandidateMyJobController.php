<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AppliedJob;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CandidateMyJobController extends Controller
{
    public function index() : View {
        $appliedJobs = AppliedJob::with('job')->where(['candidate_id' => auth()->user()->id])->paginate(10);
        return view('frontend.candidate-dashboard.my-jobs.index',compact(
            'appliedJobs',
        ));
    }
}
