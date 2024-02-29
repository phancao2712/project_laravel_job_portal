@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Professions</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>All Profession</h4>
                    <div class="card-header-form">
                        <form action="{{ route('admin.professions.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control form-search" placeholder="Search" name="search" value="{{ request('search') }}">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-primary btn-search"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <a href="{{ route('admin.professions.create') }}" class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i> Create New</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tbody >
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th style="width:10%;">Action</th>
                                </tr>
                                @forelse ($professions as $lprofession)
                                <tr>
                                    <td>{{ $lprofession->name }}</td>
                                    <td>{{ $lprofession->slug }}</td>
                                    <td >
                                        <a href="{{ route('admin.professions.edit', $lprofession->id) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="{{ route('admin.professions.destroy', $lprofession->id) }}" class="btn btn-sm btn-danger delete-btn"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">No reusult found!</td>
                                </tr>

                                @endforelse
                            </tbody>

                        </table>
                        {{ $professions->withQueryString()->links() }}
                    </div>

                </div>
            </div>
        </div>
        <div class="section-body">
        </div>
    </section>
@endsection
