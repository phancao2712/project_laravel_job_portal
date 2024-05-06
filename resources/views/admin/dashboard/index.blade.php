@extends('admin.layouts.master')`

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="icon-dashboard far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Earning</h4>
                        </div>
                        <div class="card-body">
                            {{ config('settings.site_currency_icon') }} {{ $totalEarning }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="icon-dashboard far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Candidate Count</h4>
                        </div>
                        <div class="card-body">
                            {{ $candidateCount }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="icon-dashboard far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Company Count</h4>
                        </div>
                        <div class="card-body">
                            {{ $companyCount }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="icon-dashboard far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Job</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalJob }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="icon-dashboard far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Job Active</h4>
                        </div>
                        <div class="card-body">
                            {{ $jobActive }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="icon-dashboard far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>JobExpired</h4>
                        </div>
                        <div class="card-body">
                            {{ $jobExpired }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="icon-dashboard far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Job Pending</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalBlog }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="icon-dashboard far fa-newspaper"></i>

                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Blog</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalBlog }}
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </section>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Job Pending</h4>
                <div class="card-header-form">
                    <form action="{{ route('admin.jobs.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control form-search" placeholder="Search" name="search"
                                value="{{ request('search') }}">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-search"><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
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
                                <th>Approve</th>
                            </tr>
                            @forelse ($jobs as $job)
                                <tr>
                                    <td>
                                        <div class="d-flex g-2">
                                            <img width="30px" height="30px" style="object-fit: cover;"
                                                src="{{ asset($job->company?->logo) }}" alt="">
                                            <div>
                                                <b>{{ $job->title }}</b>
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
                                            {{ $job?->min_salary }} - {{ $job?->max_salary }}
                                            {{ config('settings.site_default_currency') }}
                                        @else
                                            {{ $job?->custom_salary !== null ? $job?->custom_salary : 'compativities' }}
                                        @endif
                                    </td>
                                    <td>{{ formatDate($job->deadline) }}</td>
                                    <td class="column-status">
                                        @if ($job->status === 'pending')
                                            <span class="badge bg-warning text-white">Pending</span>
                                        @elseif ($job->deadline >= date('Y-m-d'))
                                            <span class="badge bg-success text-white">Active</span>
                                        @else
                                            <span class="badge bg-danger text-light">Expired</span>
                                        @endif
                                    </td>
                                    <td>
                                        <label class="custom-switch mt-2">
                                            <input type="checkbox" @checked($job->status == 'active')
                                                name="custom-switch-checkbox" class="custom-switch-input btn-change"
                                                data-id="{{ $job->id }}">
                                            <span class="custom-switch-indicator"></span>
                                        </label>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No reusult found!</td>
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
@endsection
