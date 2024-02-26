@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Industry Types</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Industry Type Table</h4>
                    <div class="card-header-form">
                        <form action="{{ route('admin.industry-types.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control form-search" placeholder="Search" name="search" value="{{ request('search') }}">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-primary btn-search"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <a href="{{ route('admin.industry-types.create') }}" class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i> Create New</a>
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
                                @foreach ($industry_types as $industry_type)
                                    <tr>
                                        <td>{{ $industry_type->name }}</td>
                                        <td>{{ $industry_type->slug }}</td>
                                        <td >
                                            <a href="{{ route('admin.industry-types.edit', $industry_type->id) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="{{ route('admin.industry-types.destroy', $industry_type->id) }}" class="btn btn-sm btn-danger delete-btn"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                        {{ $industry_types->withQueryString()->links() }}
                    </div>

                </div>
            </div>
        </div>
        <div class="section-body">
        </div>
    </section>
@endsection
