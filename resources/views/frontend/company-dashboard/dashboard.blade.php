@extends('frontend.layouts.master')
@section('contents')
<section class="section-box mt-75">
    <div class="breacrumb-cover">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-12">
            <h2 class="mb-20">Dashboard</h2>
            <ul class="breadcrumbs">
              <li><a class="home-icon" href="{{ route('home') }}">Home</a></li>
              <li>Dashboard</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section-box mt-120">
    <div class="container">
      <div class="row">
        @include('frontend.company-dashboard.sidebar')
        <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">
          <div class="content-single">
            <h3 class="mt-0 mb-0 color-brand-1">Dashboard</h3>
            <div class="dashboard_overview">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <div class="dash_overview_item bg-info-subtle">
                    <h2>{{ $jobPostCount }} <span>job posts</span></h2>
                    <span class="icon"><i class="fas fa-briefcase"></i></span>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6">
                  <div class="dash_overview_item bg-danger-subtle">
                    <h2>{{ $jobTotalCount }} <span>job total</span></h2>
                    <span class="icon"><i class="fas fa-briefcase"></i></span>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6">
                  <div class="dash_overview_item bg-warning-subtle">
                    <h2>{{ $totalOrders->count() }} <span>order</span></h2>
                    <span class="icon"><i class="fa-solid fa-cart-plus"></i></span>
                  </div>
                </div>
              </div>
              @if(empty(checkCompleteProfile()))
              <div class="row">
                <div class="col-12 mt-30">
                  <div class="dash_alert_box p-30 bg-danger rounded-4 d-flex flex-wrap">
                    <span class="img">
                      <img src="{{ auth()->user()->image }}" alt="alert">
                    </span>
                    <div class="text">
                      <h4>Waring: You have to complete your company profile first!</h4>
                      <p>Please complete your profile to use all the features.</p>
                    </div>
                    <a href="{{ route('company.profile') }}" class="btn btn-default rounded-1">Edit Profile</a>
                  </div>
                </div>
              </div>
              @endif
              <div class="border mt-30">
                <table class="table">
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Current Package</td>
                        <td>{{ $userPlan?->plan?->label }}</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Job Post Available </td>
                        <td>{{ $userPlan?->job_limit }}</td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td>Featured Post Available</td>
                        <td>{{ $userPlan?->featured_job_limit }}</td>
                      </tr>
                      <tr>
                        <th scope="row">4</th>
                        <td>Highlight Post Available</td>
                        <td>{{ $userPlan?->highlight_job_limit }}</td>
                      </tr>
                    </tbody>
                  </table>
             </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
