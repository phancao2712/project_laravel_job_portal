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
        @include('frontend.candidate-dashboard.sidebar')
        <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">
          <div class="content-single">
            <h3 class="mt-0 mb-0 color-brand-1">Dashboard</h3>
            <div class="dashboard_overview">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <div class="dash_overview_item bg-info-subtle">
                    <h2>{{ $jobAppliedCount }} <span>job applied</span></h2>
                    <span class="icon"><i class="fas fa-briefcase"></i></span>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6">
                  <div class="dash_overview_item bg-danger-subtle">
                    <h2>{{ $jobBookmarkedCount }} <span>job bookmarked</span></h2>
                    <span class="icon"><i class="fas fa-briefcase"></i></span>
                  </div>
                </div>
              </div>
              @if(!checkCompleteCandidateProfile())
              <div class="row">
                <div class="col-12 mt-30">
                  <div class="dash_alert_box p-30 bg-danger rounded-4 d-flex flex-wrap">
                    <span class="img">
                      <img src="{{ asset(auth()->user()->profileCandidate->image ?? 'frontend/assets/imgs/avatar/ava_17.png') }}" alt="avatar">
                    </span>
                    <div class="text">
                        <h4>Waring: You have to complete your company profile first!</h4>
                        <p>Please complete your profile to use all the features.</p>
                    </div>
                    <a href="{{ route('candidate.profile') }}" class="btn btn-default rounded-1">Edit Profile</a>
                  </div>
                </div>
              </div>
              @endif

              <h3 class="mt-30 mb-0 color-brand-1">Recently Applied</h3>
              <table class="table table-striped" id="experienceTable">
                <thead>
                    <tr>
                        <th scope="col">Company</th>
                        <th scope="col">Salary</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col" style="width:15%;">Actions</th>
                    </tr>
                </thead>
                <tbody class="experience-tbody">
                    @forelse ($appliedJobs as $appliedJob)
                        <tr>
                            <td>
                                <div class="d-flex">
                                    <img style="object-fit: cover" width="50px" height="50px"
                                        src="{{ $appliedJob->job->company->logo }}" alt="">
                                    <div class="ps-3">
                                        <h6><a href="{{ route('companies.show', $appliedJob->job->company->slug) }}">{{ $appliedJob->job->company->name }}</a></h6>
                                        <span>{{ $appliedJob->job?->company?->companyCountry?->name }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if ($appliedJob->job->salary_mode == 'range')
                                    {{ $appliedJob->job->min_salary }} - {{ $appliedJob->job->max_salary }}
                                    {{ config('settings.site_default_currency') }}
                                @else
                                    {{ $appliedJob->job?->custom_salary !== null ? $appliedJob->job?->custom_salary : 'compativities' }}<br>
                                @endif
                            </td>
                            <td>{{ formatDate($appliedJob->created_at) }}</td>
                            <td>
                                @if ($appliedJob->job->deadline < date('Y-m-d'))
                                    <span class="badge bg-error">Expired</span>
                                @else
                                    <span class="badge bg-success">Active</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('job.show', $appliedJob->job->slug) }}"
                                    class="btn btn-sm btn-primary"><i class="fa-regular fa-eye"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Not Found Data!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @if ($appliedJobs->hasPages())
                {{ $appliedJobs->withQueryString()->links() }}
            @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
