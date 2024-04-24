@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Company Profile</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Company Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-box-2">
        <div class="container">
            <div class="banner-hero banner-image-single"><img style="height: 375px; object-fit:cover;"
                    src="{{ asset($company->banner) }}" alt="joblist"></div>
            <div class="box-company-profile">
                <div class="row mt-10">
                    <div class="col-lg-8 col-md-12">
                        <img style="width:100px; height:100px; object-fix:cover;" src="{{ asset($company->logo) }}"
                            alt="">
                        <h5 class="f-18">{{ $company->name }}<span
                                class="card-location font-regular ml-20">
                                {{ $company?->address }}
                                {{ $company->companyCountry?->name ? $company->companyCountry?->name : '' }}
                                {{ $company->companyProvince?->name ? ',' . $company->companyProvince?->name : '' }}</span>
                        </h5>
                        <p class="mt-5 font-md color-text-paragraph-2 mb-15">Our Mission to make working life simple</p>
                    </div>
                    <div class="col-lg-4 col-md-12 text-lg-end"><a class="btn btn-apply btn-apply-big" href="javascript:;"
                            onclick="document.getElementById('open-position').scrollIntoView()">Open Postion</a></div>
                </div>
            </div>

            <div class="border-bottom pt-10 pb-10"></div>
        </div>
    </section>

    <section class="section-box mt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="content-single">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-about" role="tabpanel"
                                aria-labelledby="tab-about">
                                <h4>Welcome to {{ $company->name }}</h4>
                                {!! $company->bio !!}
                                <h4>Company Vision</h4>
                                {!! $company->vision !!}
                            </div>
                        </div>
                    </div>
                    <div class="box-related-job content-page" id="open-position">
                        <h5 class="mb-30">Latest Jobs</h5>
                        <div class="box-list-jobs display-list">
                            @forelse ($openJobs as $job)
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
                            <h5 class="text-center">Sorry! No Open Job😢.</h5>
                            @endforelse
                        </div>
                        <div class="paginations mt-60">
                            <ul class="pager">
                                <li><a class="pager-prev" href="#"><i class="fas fa-arrow-left"></i></a></li>
                                <li><a class="pager-number" href="#">1</a></li>
                                <li><a class="pager-number" href="#">2</a></li>
                                <li><a class="pager-number active" href="#">3</a></li>
                                <li><a class="pager-number" href="#">4</a></li>
                                <li><a class="pager-next" href="#"><i class="fas fa-arrow-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
                    <div class="sidebar-border">
                        <div class="sidebar-heading">
                            <div class="avatar-sidebar">
                                <div class="sidebar-info pl-0"><span
                                        class="sidebar-company">{{ $company->name }}</span><span class="card-location">
                                        {{ $company->companyProvince?->name ? ',' . $company->companyProvince?->name : '' }},
                                        {{ $company->companyCountry?->name ? ',' . $company->companyCountry?->name : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-list-job">
                            <div class="box-map">
                                {!! $company->map_link !!}
                            </div>
                        </div>
                        <div class="sidebar-list-job">
                            <ul>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-briefcase"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Industry
                                            Type</span><strong
                                            class="small-heading">{{ $company->companyIndustry->name }}</strong></div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-marker"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Organization
                                            Type</span><strong
                                            class="small-heading">{{ $company->companyOrganization->name }}</strong></div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fa-regular fa-user"></i></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Team Size</span><strong
                                            class="small-heading">{{ $company->companyTeamSize->name }}</strong></div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-clock"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Etablish
                                            Date</span><strong
                                            class="small-heading">{{ formatDate($company->establishment_date) }}</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-time-fast"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Last Jobs
                                            Posted</span><strong class="small-heading">4 days</strong></div>
                                </li>
                            </ul>
                        </div>
                        <div class="sidebar-list-job">
                            <ul class="ul-disc">
                                <li>{{ $company->address }}
                                    {{ $company->companyDisctrict?->name ? ',' . $company->companyDisctrict?->name : '' }}
                                    {{ $company->companyProvince?->name ? ',' . $company->companyProvince?->name : '' }}
                                    {{ $company->companyCountry?->name ? ',' . $company->companyCountry?->name : '' }}</li>
                                <li>Phone: {{ $company?->phone }}</li>
                                <li>Email: {{ $company?->email }}</li>
                            </ul>
                            <div class="mt-30"><a class="btn btn-send-message"
                                    href="mailto:{{ $company?->email }}">Send Message</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
