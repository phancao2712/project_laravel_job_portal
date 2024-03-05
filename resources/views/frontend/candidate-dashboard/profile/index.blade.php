@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Candidate Profile</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ route('home') }}">Home</a></li>
                            <li>Candidate Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-box mt-120">
        <div class="container">
            <div class="row">
                @include('frontend.candidate-dashboard.sidebar')
                <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-basic-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-basic" type="button" role="tab" aria-controls="pills-basic"
                                aria-selected="true">Basic</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-experience-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-experience" type="button" role="tab"
                                aria-controls="pills-experience" aria-selected="false">Experience & Education</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-account-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-account" type="button" role="tab" aria-controls="pills-account"
                                aria-selected="false">Account Setting</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        {{-- Basic --}}
                        @include('frontend.candidate-dashboard.profile.sections.basic')

                        {{-- Profile --}}
                        @include('frontend.candidate-dashboard.profile.sections.profile')

                        {{-- Experience --}}
                        @include('frontend.candidate-dashboard.profile.sections.experience')

                        {{-- Account --}}
                        @include('frontend.candidate-dashboard.profile.sections.account')
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>

    <!-- Experience Modal -->
    @include('frontend.candidate-dashboard.profile.sections.experience-modal')

    <!-- Education Modal -->
    @include('frontend.candidate-dashboard.profile.sections.education-modal')
@endsection
@include('frontend.layouts.get_location')



