<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendJobPageController extends Controller
{
    public function index() : View
    {
        $jobs = Job::where(['status' => 'active'])
        ->where('deadline', '>=', date('Y-m-d'))
        ->paginate(10);
        return view('frontend.pages.job-index', compact(
            'jobs'
        ));
    }

    public function show(string $slug) : View
    {
        $job = Job::where(['slug' => $slug])->first();
        $openJob = Job::where('company_id', $job->company->id)->where('status', 'active')->where('deadline', '>=', date('Y-m-d'))->count();

        return view('frontend.pages.job-show', compact(
            'job',
            'openJob'
        ));
    }
}
