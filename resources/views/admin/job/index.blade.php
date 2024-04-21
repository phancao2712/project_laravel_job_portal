@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Job Post</h1>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>All Job Post</h4>
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
                    <a href="{{ route('admin.jobs.create') }}" class="btn btn-primary"><i
                            class="fa-solid fa-circle-plus"></i> Create New</a>
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
                                    <th style="width:10%;">Action</th>
                                </tr>
                                @forelse ($jobs as $job)
                                    <tr>
                                        <td>
                                            <div class="d-flex g-2">
                                                <img width="30px" height="30px" style="object-fit: cover;" src="{{ asset($job->company?->logo) }}" alt="">
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
                                                {{ $job?->min_salary }} - {{ $job?->max_salary }} {{ config('settings.site_default_currency') }}
                                            @else
                                                {{ ($job?->custom_salary !== null) ? $job?->custom_salary : "compativities" }}
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
                                                <input type="checkbox" @checked($job->status == 'active') name="custom-switch-checkbox" class="custom-switch-input btn-change" data-id="{{ $job->id }}">
                                                <span class="custom-switch-indicator"></span>
                                              </label>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.jobs.edit', $job->id) }}"
                                                class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="{{ route('admin.jobs.destroy', $job->id) }}"
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
        <div class="section-body">
        </div>
    </section>
@endsection

@push('script')
    <script>

        $(document).ready(function () {
            $('.btn-change').on('change', function () {
                let id = $(this).data('id');
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    method: "POST",
                    url: '{{ route('admin.jobStatus.update', ":id") }}'.replace(":id", id),
                    data: {
                        _token: csrfToken
                    },
                    success: function (response) {
                        window.location.reload('.column-status');
                    },
                    error: function (status, error, xhr) {

                    },
                });
            })
        });
    </script>
@endpush
