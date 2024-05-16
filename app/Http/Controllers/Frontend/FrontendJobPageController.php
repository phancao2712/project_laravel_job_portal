<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AppliedJob;
use App\Models\Candidate;
use App\Models\Country;
use App\Models\District;
use App\Models\Job;
use App\Models\JobBookmark;
use App\Models\JobCategory;
use App\Models\JobType;
use App\Models\Province;
use App\Models\Skill;
use App\Services\CalculateMatchingPercentageService;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class FrontendJobPageController extends Controller
{
    use Searchable;
    public function index(Request $request): View
    {
        $selectedDistrict = null;
        $selectedProvince = null;
        $query = Job::query();

        $query->where(['status' => 'active'])
            ->where('deadline', '>=', date('Y-m-d'));

        $this->search($query, ['title']);
        $this->searchItem($query, 'country');
        $this->searchItem($query, 'province');
        $this->searchItem($query, 'district');
        if ($request->has('country') && $request->filled('country')) {
            $selectedProvince = Province::where('country_id', $request->country)->get();
        }
        $this->searchItem($query, 'province');
        if ($request->has('province') && $request->filled('province')) {
            $selectedDistrict = District::where('province_id', $request->province)->get();
        }
        if ($request->has('category') && $request->filled('category')) {
            if (!in_array('all', $request->category)) {
                $categoryIds = JobCategory::whereIn('slug', request('category'))->pluck('id')->toArray();
                $query->whereIn('job_category_id', $categoryIds);
            }
        }
        if ($request->has('min_salary') && $request->filled('min_salary') && $request->min_salary > 0) {
            $query->where('min_salary', '<=', $request->min_salary)->where('max_salary', '>=', $request->min_salary);
        }
        if ($request->has('type') && $request->filled('type')) {
            $typeIds = JobType::whereIn('slug', request('type'))->pluck('id')->toArray();
            $query->whereIn('job_type_id', $typeIds);
        }

        $jobs = $query->paginate(20);

        $countries = Country::all();
        $categories = JobCategory::withCount(['jobs' => function ($query) {
            $query->where('status', 'active')->where('deadline', '>=', date('Y-m-d'));
        }])->get();
        $jobTypes = JobType::withCount(['jobs' => function ($query) {
            $query->where('status', 'active')->where('deadline', '>=', date('Y-m-d'));
        }])->get();

        $jobScores = [];
        if (isset(auth()->user()->profileCandidate->id)) {
            $allJob = Job::where(['status' => 'active'])
            ->where('deadline', '>=', date('Y-m-d'))->get();
            $candidate = Candidate::with(['experience', 'skills', 'candidateCountry'])->where('user_id', auth()->user()?->id)->first();
            $countSkill = Skill::count();

            foreach ($allJob as $job) {
                $math = (new CalculateMatchingPercentageService)->calculate($candidate, $job, $countSkill);

                if($math){
                    $jobScores[] = [
                        'job' => $job,
                        'score' => $math
                    ];
                }
            }
            usort($jobScores, function ($a, $b) {
                return $b['score'] <=> $a['score'];
            });
        }

        return view('frontend.pages.job-index', compact(
            'jobs',
            'countries',
            'categories',
            'jobTypes',
            'selectedProvince',
            'selectedDistrict',
            'jobScores'
        ));
    }

    public function show(string $slug): View
    {
        $job = Job::where(['slug' => $slug])->first();
        $openJob = Job::where('company_id', $job->company->id)->where('status', 'active')->where('deadline', '>=', date('Y-m-d'))->count();
        $alreadyApplied = AppliedJob::where(['job_id' => $job->id, 'candidate_id' => auth()?->user()?->id])->exists();

        return view('frontend.pages.job-show', compact(
            'job',
            'openJob',
            'alreadyApplied'
        ));
    }

    public function applyJob(string $id): Response
    {
        if (!auth()->check()) {
            throw ValidationException::withMessages(['Please login for apply to the job']);
        }

        if (auth()->user()->role !== 'candidate') {
            throw ValidationException::withMessages(["You can't apply job"]);
        }
        $alreadyApplied = AppliedJob::where(['job_id' => $id, 'candidate_id' => auth()->user()->id])->exists();
        if ($alreadyApplied) {
            throw ValidationException::withMessages(['You already applied to this job']);
        }

        $applyJob = new AppliedJob();
        $applyJob->job_id = $id;
        $applyJob->candidate_id = auth()->user()->id;
        $applyJob->save();
        return response(['message' => 'Applied successful', 200]);
    }
}
