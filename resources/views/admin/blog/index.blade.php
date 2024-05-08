@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Blogs</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Blog Table</h4>
                    <div class="card-header-form">
                        <form action="{{ route('admin.blogs.index') }}" method="GET" enctype="multipart/form-data">
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
                    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary"><i
                            class="fa-solid fa-circle-plus"></i> Create New</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tbody>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Approve</th>
                                    <th style="width:10%;">Action</th>
                                </tr>
                                @forelse ($blogs as $blog)
                                    <tr>
                                        <td>
                                            <img src="{{ $blog->image }}" style="object-fit: cover" width="70px"
                                                height="50px" alt="">
                                        </td>
                                        <td>{{ $blog->title }}</td>
                                        <td class="column-status">
                                            @if ($blog->status == 0)
                                                <span class="badge text-white bg-danger">Inactive</span>
                                            @else
                                                <span class="badge text-white bg-success">Active</span>
                                            @endif
                                        </td>
                                        <td>
                                            <label class="custom-switch mt-2">
                                                <input @checked($blog->status == 1) type="checkbox"
                                                    name="custom-switch-checkbox" class="custom-switch-input btn-change"
                                                    data-id="{{ $blog->id }}">
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                                class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="{{ route('admin.blogs.destroy', $blog->id) }}"
                                                class="btn btn-sm btn-danger delete-btn"><i
                                                    class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No reusult found!</td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                        {{ $blogs->withQueryString()->links() }}
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
        $(document).ready(function() {
            $('.btn-change').on('change', function() {
                let id = $(this).data('id');
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    method: "POST",
                    url: '{{ route('admin.blogStatus.update', ':id') }}'.replace(":id", id),
                    data: {
                        _token: csrfToken
                    },
                    success: function(response) {
                        window.location.reload('.column-status');
                    },
                    error: function(status, error, xhr) {

                    },
                });
            })
        });
    </script>
@endpush
