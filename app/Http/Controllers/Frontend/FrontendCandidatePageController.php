<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\Experience;
use App\Models\Skill;
use App\Traits\Searchable;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendCandidatePageController extends Controller
{
    use Searchable;
    public function index(Request $request) : View
    {
        $skills = Skill::all();
        $experiences = Experience::all();

        $query = Candidate::query();
        $query->where(['profile_complete' => 1, 'visibility' => 1]);
        if(request()->has('skill') && request()->filled('skill') ){
            $ids = Skill::whereIn('slug', $request->skill)->pluck('id')->toArray();
            $query->whereHas('skills', function ($query) use ($ids) {
                $query->whereIn('skill_id', $ids);
            });
        }

        $this->searchItem($query,'experience_id');

        $candidates = $query->paginate(21);
        return view('frontend.pages.candidate-page', compact(
            'candidates',
            'skills',
            'experiences'
        ));
    }

    function show(string $slug) : View {
        $candidate = Candidate::where(['profile_complete' => 1, 'visibility' => 1, 'slug' => $slug])->firstOrFail();
        return view('frontend.pages.candidate-detail', compact(
            'candidate'
        ));
    }
}
