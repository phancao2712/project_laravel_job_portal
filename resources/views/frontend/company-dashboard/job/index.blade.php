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
                                                <input type="text" class="form-control form-search" placeholder="Search" name="search"
                                                    value="{{ request('search') }}">
                                                <div class="input-group-btn">
                                                    <button style="height: 50px;" type="submit" class="btn btn-primary btn-search"><i
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
                                            <th>Salary</th>
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
                                                    @if ($job->salary_mode == 'range')
                                                        {{ $job->min_salary }} - {{ $job->max_salary }} {{ config('settings.site_default_currency') }}
                                                    @else
                                                    {{ ($job?->custom_salary !== null) ? $job?->custom_salary : "compativities" }}<br>
                                                    {{ $job->salary_type->name }}
                                                    @endif
                                                </td>
                                                <td>{{ formatDate($job->deadline) }}</td>
                                                <td>
                                                    @if ($job->deadline < date('Y-m-d'))
                                                        <span class="badge bg-success text-white">Active</span>
                                                    @else
                                                    <span class="badge bg-danger text-light">Expired</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('company.jobs.edit', $job->id) }}"
                                                        class="btn btn-sm btn-primary mb-2"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <a href="{{ route('company.jobs.destroy', $job->id) }}"
                                                        class="btn btn-sm btn-danger delete-btn"><i
                                                            class="fa-solid fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">No reusult found!</td>
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
