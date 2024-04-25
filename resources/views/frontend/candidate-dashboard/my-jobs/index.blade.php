@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Applied Job</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ route('home') }}">Home</a></li>
                            <li>Applied Job</li>
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
                    <div class="">
                        <div class="d-flex justify-content-between">
                            <h3>Applied Job (100)</h3>
                        </div>
                        <br>
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
                                                <img style="object-fit: cover" width="50px" height="50px" src="{{ $appliedJob->job->company->logo }}" alt="">
                                            <div class="ps-3">
                                                <h6>{{ $appliedJob->job->company->name }}</h6>
                                                <span>{{ $appliedJob->job?->company?->companyCountry?->name }}</span>
                                            </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($appliedJob->job->salary_mode == 'range')
                                                {{ $appliedJob->job->min_salary }} - {{ $appliedJob->job->max_salary }}
                                                {{ config('settings.site_default_currency') }}
                                            @else
                                                {{ $job->job?->custom_salary !== null ? $job->job?->custom_salary : 'compativities' }}<br>
                                            @endif
                                        </td>
                                        <td>{{ formatDate($appliedJob->created_at) }}</td>
                                        <td> @if($appliedJob->job->deadline < date('Y-m-d'))
                                            <span class="badge bg-error">Expired</span>
                                        @else
                                        <span class="badge bg-success">Active</span>

                                        @endif </td>
                                        <td>
                                            <a href="javascript" class="btn btn-sm btn-primary"><i class="fa-regular fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Not Found Data!</td>
                                        </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </section>

@endsection
@include('frontend.layouts.get_location')



