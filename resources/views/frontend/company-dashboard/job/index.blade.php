@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Profile</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ route('home') }}">Home</a></li>
                            <li>Profile</li>
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
                    <div class="card">
                        <div class="card-header">
                            <h4>All Job</h4>
                            <div class="row mt-2">
                                <div class="col-sm-9">
                                    <div class="card-header-form">
                                        <form action="{{ route('company.jobs.index') }}" method="GET">
                                            <div class="input-group">
                                                <input type="text" class="form-control form-search" placeholder="Search"
                                                    name="search" value="{{ request('search') }}">
                                                <div class="input-group-btn">
                                                    <button style="height: 50px;" type="submit"
                                                        class="btn btn-primary btn-search"><i
                                                            class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-sm-3 text-right">
                                    <a href="{{ route('company.jobs.create') }}" class="btn btn-primary"><i
                                            class="fa-solid fa-circle-plus"></i> Create New</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-md">
                                    <tbody>
                                        <tr>
                                            <th>Job</th>
                                            <th>Category/Role</th>
                                            <th>Applications</th>
                                            <th>Deadline</th>
                                            <th>Status</th>
                                            <th style="width:10%;">Action</th>
                                        </tr>
                                        @forelse ($jobs as $job)
                                            <tr>
                                                <td>
                                                    <div class="d-flex g-2">
                                                        <div>
                                                            <span class="fw-bold">{{ $job->title }}</span>
                                                            <br>
                                                            {{ $job->company?->name }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <b>{{ $job->category?->name }}</b>
                                                    <br>
                                                    {{ $job->role?->name }}
                                                </td>
                                                <td>
                                                    {{ $job->applied_jobs_count }} applications
                                                </td>
                                                <td>{{ formatDate($job->deadline) }}</td>
                                                <td>
                                                    @if ($job->status === 'pending')
                                                        <span class="badge bg-warning text-white">Pending</span>
                                                    @elseif ($job->deadline >= date('Y-m-d'))
                                                        <span class="badge bg-success text-white">Active</span>
                                                    @else
                                                        <span class="badge bg-danger text-light">Expired</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-gear"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                          <li><a class="dropdown-item" href="{{ route('company.job.applications', $job->id) }}">Application</a></li>
                                                          <li><a class="dropdown-item" href="{{ route('company.jobs.edit', $job->id) }}">Edit</a></li>
                                                          <li><a class="dropdown-item delete-btn" href="{{ route('company.jobs.destroy', $job->id) }}">Delete</a></li>
                                                        </ul>
                                                      </div>

                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No reusult found😢!</td>

                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                                @if ($jobs->hasPages())
                                    {{ $jobs->withQueryString()->links() }}
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
@endsection
