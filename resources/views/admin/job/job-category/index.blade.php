@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Job Categories</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>All Job Category</h4>
                    <div class="card-header-form">
                        <form action="{{ route('admin.job-categories.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control form-search" placeholder="Search" name="search" value="{{ request('search') }}">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-primary btn-search"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <a href="{{ route('admin.job-categories.create') }}" class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i> Create New</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tbody >
                                <tr>
                                    <th>Icon</th>
                                    <th>Name</th>
                                    <th>Job Cout</th>
                                    <th>Show at featured</th>
                                    <th style="width:10%;">Action</th>
                                </tr>
                                @forelse ($jobCategories as $jobCategory)
                                <tr>
                                    <td><i style="font-size: 40px" class="{{ $jobCategory->icon }}"></i></td>
                                    <td>{{ $jobCategory->name }}</td>
                                    <td>{{ $jobCategory->jobs_count }}</td>
                                    <td>
                                        <label class="custom-switch mt-2">
                                            <input @checked($jobCategory->featured == 1) type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-change" data-id="{{ $jobCategory->id }}">
                                            <span class="custom-switch-indicator"></span>
                                        </label>
                                    </td>
                                    <td >
                                        <a href="{{ route('admin.job-categories.edit', $jobCategory->id) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="{{ route('admin.job-categories.destroy', $jobCategory->id) }}" class="btn btn-sm btn-danger delete-btn"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">No reusult found!</td>
                                </tr>

                                @endforelse
                            </tbody>

                        </table>
                        @if ($jobCategories->hasPages())
                            {{ $jobCategories->withQueryString()->links() }}
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
                    url: '{{ route('admin.categoryStatus.update', ":id") }}'.replace(":id", id),
                    data: {
                        _token: csrfToken
                    },
                    success: function (response) {
                        window.location.reload()
                    },
                    error: function (status, error, xhr) {

                    },
                });
            })
        });
    </script>
@endpush
