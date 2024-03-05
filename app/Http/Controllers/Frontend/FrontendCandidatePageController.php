<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendCandidatePageController extends Controller
{
    public function index() : View
    {
        $candidates = Candidate::where(['profile_complete' => 1, 'visibility' => 1])->get();
        return view('frontend.pages.candidate-page', compact(
            'candidates'
        ));
    }
}
