@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Candidates</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Candidates</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-120">
        <div class="container">
            <div class="content-page">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="sidebar-shadow none-shadow mb-30">
                            <div class="sidebar-filters">
                                <form action="{{ route('candidates.index') }}" method="GET">
                                    <div class="filter-block mb-30">
                                        <div class="filter-block head-border mb-30">
                                            <h5>Advance Filter <a class="link-reset"
                                                    href="{{ route('candidates.index') }}">Reset</a></h5>
                                        </div>
                                        <div class="filter-block mb-30">
                                            <div class="form-group select-style">
                                                <label class="fw-bolder" for="">Skills</label>
                                                <select multiple class="form-control form-icons select-active"
                                                    name="skill[]">
                                                    @foreach ($skills as $skill)
                                                        <option @selected(request()->has('skill') ? in_array($skill->slug,request()->skill) : false) value="{{ $skill->slug }}">{{ $skill->name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-block mb-30">
                                        <h5 class="medium-heading mb-10">Experience Level</h5>
                                        <div class="form-group">
                                            <ul class="list-checkbox">
                                                @foreach ($experiences as $type)
                                                    <li>
                                                        <label class="d-flex gap-2" style="flex: start">
                                                            <input type="radio" value="{{ $type->id }}" @checked(request()->experience_id == $type->id)
                                                                name="experience_id" class="x-radio"><span
                                                                class="text-small">{{ $type->name }}</span>
                                                        </label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <button class="submit btn btn-default mt-10 rounded-1 w-100"
                                        type="submit">Search</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9">
                        <div class="row">
                            @forelse ($candidates as $candidate)
                                <div class="col-lg-4 col-md-6">
                                    <div class="card-grid-2 hover-up">
                                        <div class="card-grid-2-image-left d-flex">
                                            <div class="card-grid-2-image-rd online"><a
                                                    href="{{ route('candidates.show', $candidate->slug) }}">
                                                    <figure><img alt="joblist" src="{{ asset($candidate->image) }}">
                                                    </figure>
                                                </a></div>
                                            <div class="card-profile pt-10">
                                                <a href="{{ route('candidates.show', $candidate->slug) }}">
                                                    <h5>{{ $candidate->fullname }}</h5>
                                                </a>
                                                <span class="font-xs color-text-mutted">{{ $candidate->title }}</span>
                                                <p class="font-xs color-text-paragraph-2"><b>I am avilable</b></p>
                                            </div>
                                        </div>
                                        <div class="card-block-info">
                                            <div class="card-2-bottom card-2-bottom-candidate mt-30">
                                                <div class="text-start">
                                                    @foreach ($candidate->skills as $candidateSkill)
                                                        @if ($loop->index <= 5)
                                                            <a class="btn btn-tags-sm mb-10 mr-5"
                                                                href="">{{ $candidateSkill->skill->name }}</a>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="employers-info align-items-center justify-content-center mt-15">
                                                <div class="row">
                                                    <div class="col-6"><span class="d-flex align-items-center"><i
                                                                class="fi-rr-marker mr-5 ml-0"></i><span
                                                                class="font-sm text-nowrap color-text-mutted">{{ $candidate->candidateCountry->name }}</span></span>
                                                    </div>
                                                    <div class="col-6"><span
                                                            class="d-flex justify-content-end align-items-center"><a
                                                                class="font-sm text-primary d-flex justify-items-center"
                                                                href="{{ route('candidates.show', $candidate->slug) }}">View<i
                                                                    class="fi fi-rr-arrow-right"
                                                                    style="margin-top:1px;"></i></a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h5 class="text-center">Sorry! No data Found😢.</h5>
                            @endforelse
                            <div class="col-12">
                                <div class="paginations mt-35">
                                    @if ($candidates->hasPages())
                                        {{ $candidates->withQueryString()->links() }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
