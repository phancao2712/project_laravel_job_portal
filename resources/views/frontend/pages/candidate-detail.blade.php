@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Candidate Profile</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Candidate Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box-2">
        <div class="container">
            <div class="banner-hero banner-image-single"><img
                    style="width:150px; height:150px; object-fit:cover; boder-radius:50%;"
                    src="{{ asset($candidate->image) }}" alt="joblist"></div>
            <div class="box-company-profile">
                <div class="row mt-10">
                    <div class="col-lg-8 col-md-12">
                        <h5 class="f-18">{{ $candidate->fullname }} <span
                                class="card-location font-regular ml-20">{{ $candidate->candidateProvince?->name ? $candidate->candidateProvince?->name : '' }}{{ $candidate->candidateCountry?->name ? ',' . $candidate->candidateCountry?->name : '' }}</span>
                        </h5>
                        <p class="mt-0 font-md color-text-paragraph-2 mb-15">{{ $candidate->title }}</p>
                        {{-- <div class="mt-0 mb-15 d-flex flex-wrap align-items-center">
              <img src="assets/imgs/template/icons/star.svg" alt="joblist">
              <img src="assets/imgs/template/icons/star.svg" alt="joblist">
              <img src="assets/imgs/template/icons/star.svg" alt="joblist">
              <img src="assets/imgs/template/icons/star.svg" alt="joblist">
              <img src="assets/imgs/template/icons/star.svg" alt="joblist">
              <span class="font-xs color-text-mutted ml-10">(66)</span>
              <img class="ml-30" src="assets/imgs/page/candidates/verified.png" alt="joblist">
            </div> --}}
                    </div>
                    <div class="col-lg-4 col-md-12 text-lg-end"><a class="btn btn-download-icon btn-apply btn-apply-big"
                            href="{{ asset($candidate?->cv) }}">Download CV</a></div>
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
                            <div class="tab-pane fade show active" id="tab-short-bio" role="tabpanel"
                                aria-labelledby="tab-short-bio">
                                <h4>Biography</h4>
                                {!! $candidate->bio !!}
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 mb-5">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Experiences</h4>
                                <ul class="timeline">
                                    @foreach ($candidate->experiences as $experience)
                                    <li>
                                        <a target="_blank" href="javascript:;">{{ $experience->designation }}</a> | <span>{{ $experience->department }}</span>
                                        <a href="#" class="float-right">{{ formatDate($experience->start) }} - {{ $experience->current_working ? 'Current' : formatDate($experience->end) }}</a>
                                        <p><strong>{{ $experience->company }}</strong></p>
                                        <p>{{ $experience->responsibilites }}</p>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 mb-5">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Education</h4>
                                <ul class="timeline">

                                    @foreach ($candidate->educations as $education)
                                    <li>
                                        <a target="_blank" href="javascript:;">{{ $education->degree }}</span>
                                        <a href="#" class="float-right">{{ formatDate($education->year) }}</a>
                                        <p><strong>{{ $education->level }}</strong></p>
                                        <p>{{ $education->note }}</p>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
                    <div class="sidebar-border">
                        <h5 class="f-18">Overview</h5>
                        <div class="sidebar-list-job">
                            <ul>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-briefcase"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Experience</span><strong
                                            class="small-heading">{{ $candidate->experience->name }}</strong></div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fa-regular fa-clipboard"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Skills</span><strong
                                            class="small-heading">
                                            @foreach ($candidate->skills as $skills)
                                                <p class="badge bg-info text-light">{{ $skills->skill->name }}</p>
                                            @endforeach
                                        </strong></div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fa-solid fa-language"></i></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Languages</span><strong
                                            class="small-heading">
                                            @foreach ($candidate->languages as $skills)
                                                <p class="badge bg-info text-light">{{ $skills->language?->name }}</p>
                                            @endforeach
                                        </strong></div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-briefcase"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Profession</span><strong
                                            class="small-heading">{{ $candidate->profession->name }}</strong></div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi fi-rr-venus-mars"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Gender</span><strong
                                            class="small-heading">{{ $candidate->gender }}</strong></div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fa-solid fa-user-tie"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Marital
                                            Status</span><strong
                                            class="small-heading">{{ $candidate->marital_status }}</strong></div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi fi-rr-cake-birthday"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Birthday</span><strong
                                            class="small-heading">{{ formatDate($candidate->birth_date) }}</strong></div>
                                </li>
                            </ul>
                        </div>
                        <div class="sidebar-list-job">
                            <ul class="ul-disc">
                                <li>{{ $candidate?->address }}
                                    {{ $candidate->candidateProvince?->name ? $candidate->candidateProvince?->name : '' }}
                                    {{ $candidate->candidateCountry?->name ? ',' . $candidate->candidateCountry?->name : '' }}
                                </li>
                                <li>Phone one: {{ $candidate->phone_one }}</li>
                                <li>Phone two: {{ $candidate->two }}</li>
                                <li>Email: {{ $candidate->email }}</li>
                            </ul>
                            <div class="mt-30"><a class="btn btn-send-message" href="mailto:{{ $candidate->email }}">Send Message</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
