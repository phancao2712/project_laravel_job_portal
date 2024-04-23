@extends('frontend.layouts.master')

@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Jobs</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Jobs</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-120">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-9 col-md-12 col-sm-12 col-12 float-right">
                    <div class="content-page">
                        <div class="row display-list">
                            @forelse ($jobs as $job)
                                <div class="col-xl-12 col-12">
                                    <div class="card-grid-2 hover-up"><span class="flash"></span>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="card-grid-2-image-left">
                                                    <div class="image-box"><img src="{{ asset($job->company?->logo) }}"
                                                            alt="joblist"></div>
                                                    <div class="right-info"><a class="name-job"
                                                            href="{{ route('companies.show', $job->company->slug) }}">{{ $job->company->name }}</a><span
                                                            class="location-small">{{ formatLocation($job->countries?->name, $job->provinces?->name, $job?->address) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 text-start text-md-end pr-60 col-md-6 col-sm-12">
                                                <div class="pl-15 mb-15 mt-30">
                                                    @if ($job->featured)
                                                        <a class="btn btn-grey-small mr-5 featured"
                                                            href="javascript:;">Featured</a>
                                                    @endif
                                                    @if ($job->highlight)
                                                        <a class="btn btn-grey-small mr-5 highlight"
                                                            href="javascript:;">Highlight</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-block-info">
                                            <h4><a href="{{ route('job.show', $job->slug) }}">{{ $job?->title }}</a></h4>
                                            <div class="mt-5">
                                                <span class="card-briefcase">{{ $job->jobType->name }}</span>
                                                <span class="card-briefcase">{{ $job->jobExperience?->name }}</span>
                                                <span class="card-time">{{ $job->created_at->diffForHumans() }}</span>
                                            </div>
                                            {{-- <p class="font-sm color-text-paragraph mt-10">Lorem ipsum dolor sit amet,
                                                consectetur adipisicing
                                                elit. Recusandae architecto eveniet, dolor quo repellendus pariatur</p> --}}
                                            <div class="pl-15 mb-15 mt-30">
                                                @foreach ($job->skills as $skill)
                                                    @if ($loop->index <= 6)
                                                        <a class=" mr-5 job-skill"
                                                            href="javascript:;">{{ $skill->skill->name }}</a>
                                                    @elseif($loop->index >= 7)
                                                        <a class=" mr-5 job-skill" href="javascript:;">More ...</a>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="card-2-bottom mt-20">
                                                <div class="row">
                                                    <div class="col-lg-7 col-7"><span class="card-text-price">
                                                            @if ($job->salary_mode == 'range')
                                                                {{ $job?->min_salary }} - {{ $job?->max_salary }}
                                                                {{ config('settings.site_default_currency') }}
                                                                <span class="text-muted"> /
                                                                    {{ $job->salaryType->name }}</span>
                                                            @else
                                                                {{ $job?->custom_salary !== null ? $job?->custom_salary . config('settings.site_default_currency') . ' / ' . $job->salaryType->name : 'Compativities' }}
                                                            @endif
                                                        </span></div>
                                                    <div class="col-lg-5 col-5 text-end">
                                                        <div class="btn ">
                                                            <i class="fa-regular fa-bookmark"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                            <h5 class="text-center">Sorry! No data Found😢.</h5>
                            @endforelse
                        </div>
                    </div>
                    <div class="paginations">
                        @if ($jobs->hasPages())
                            {{ $jobs->withQueryString()->links() }}
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="sidebar-shadow none-shadow mb-30">
                        <div class="sidebar-filters">
                            <div class="filter-block head-border mb-30">
                                <h5>Advance Filter <a class="link-reset" href="{{ route('jobs.index') }}">Reset</a></h5>
                            </div>
                            <form action="{{ route('jobs.index') }}">
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control"
                                        value="{{ request('search') }}" placeholder="Search...">
                                </div>
                                <div class="filter-block mb-20">
                                    <div class="form-group select-style">
                                        <select name="country" class="form-control country form-icons select-active">
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $country)
                                                <option @selected(request('country') == $country->id) value="{{ $country->id }}">
                                                    {{ $country?->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="filter-block mb-20">
                                    <div class="form-group select-style">
                                        <select name="province" class="form-control province form-icons select-active">
                                            <option value="">Select Province</option>
                                            @if ($selectedProvince)
                                                @foreach ($selectedProvince as $province)
                                                    <option @selected(request('province') == $province->id) value="{{ $province->id }}">
                                                        {{ $province->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="filter-block mb-30">
                                    <div class="form-group select-style">
                                        <select name="district" class="form-control district form-icons select-active">
                                            <option value="">Select District</option>
                                            @if ($selectedDistrict)
                                                @foreach ($selectedDistrict as $district)
                                                    <option @selected(request('district') == $district->id) value="{{ $district->id }}">
                                                        {{ $district->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <button class="submit btn btn-default mt-10 rounded-1 w-100"
                                            type="submit">Search</button>
                                    </div>
                                </div>

                            </form>
                            <form action="{{ route('jobs.index') }}" method="GET">
                                <div class="filter-block mb-20">
                                    <h5 class="medium-heading mb-15">Category</h5>
                                    <div class="list-checkbox">
                                        @foreach ($categories as $jobCategory)
                                            <li>
                                                <label class="cb-container">
                                                    <input name="category[]" value="{{ $jobCategory->slug }}"
                                                        type="checkbox"
                                                        @if (request('category')) @checked(in_array($jobCategory->slug, request('category'))) @endif><span
                                                        class="text-small">{{ $jobCategory->name }}</span><span
                                                        class="checkmark"></span>
                                                </label><span class="number-item">{{ $jobCategory->jobs_count }}</span>
                                            </li>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="filter-block mb-20">
                                    <h5 class="medium-heading mb-25">Salary Range</h5>
                                    <div class="list-checkbox pb-20">
                                        <div class="row position-relative mt-10 mb-20">
                                            <div class="col-sm-12 box-slider-range">
                                                <div id="slider-range"></div>
                                            </div>
                                            <div class="box-input-money">
                                                <input class="input-disabled form-control min-value-money" type="text"
                                                    name="min-value-money" disabled="disabled" value="">
                                                <input class="form-control min-value" type="hidden" name="min_salary">
                                            </div>
                                        </div>
                                        <div class="box-number-money">
                                            <div class="row mt-30">
                                                <div class="col-sm-6 col-6"><span
                                                        class="font-sm color-brand-1">{{ config('settings.site_currency_icon') }}0</span>
                                                </div>
                                                <div class="col-sm-6 col-6 text-end"><span
                                                        class="font-sm color-brand-1">{{ config('settings.site_currency_icon') }}100000</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-block mb-20">
                                    <h5 class="medium-heading mb-15">Job Types</h5>
                                    <div class="form-group">
                                        <ul class="list-checkbox">
                                            @foreach ($jobTypes as $jobType)
                                                <li>
                                                    <label class="cb-container">
                                                        <input type="checkbox" name="type[]"
                                                            value="{{ $jobType->slug }}"
                                                            @if (request('type')) @checked(in_array($jobType->slug, request('type'))) @endif><span
                                                            class="text-small">{{ $jobType->name }}</span><span
                                                            class="checkmark"></span>
                                                    </label><span class="number-item">{{ $jobType->jobs_count }}</span>
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
            </div>
        </div>
    </section>
@endsection
@include('frontend.layouts.get_location')
