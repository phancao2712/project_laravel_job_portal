<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AppliedJob;
use App\Models\JobBookmark;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CandidateDashboardController extends Controller
{
    function index():View {
        $jobAppliedCount = AppliedJob::where('candidate_id', auth()->user()->id)->count();
        $jobBookmarkedCount =  JobBookmark::where('candidate_id', auth()->user()->id)->count();
        $appliedJobs = AppliedJob::with('job')->where(['candidate_id' => auth()->user()->id])->paginate(10);

        return view('frontend.candidate-dashboard.dashboard', compact(
            'jobAppliedCount',
            'jobBookmarkedCount',
            'appliedJobs'
        ));
    }
}
