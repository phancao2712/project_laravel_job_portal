@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Role</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>All Role</h4>
                    <div class="card-header-form">
                        <form action="{{ route('admin.role-permission.index') }}" method="GET">
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
                    <a href="{{ route('admin.role-permission.create') }}" class="btn btn-primary"><i
                            class="fa-solid fa-circle-plus"></i> Create New</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tbody>
                                <tr>
                                    <th>Role Name</th>
                                    <th>Permission</th>
                                    <th style="width:10%;">Action</th>
                                </tr>
                                @forelse ($roles as $role)
                                    <tr>
                                        <td >{{ $role->name }}</td>

                                    <td style="width:70%">
                                        @foreach ($role->permissions as $permission)
                                        <span class=" badge bg-primary text-light m-1">
                                            {{ $permission->name }}
                                        </span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($role->name !== 'Super Admin')
                                        <a href="{{ route('admin.role-permission.edit', $role->id) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="{{ route('admin.role-permission.destroy', $role->id) }}" class="btn btn-sm btn-danger delete-btn"><i class="fa-solid fa-trash"></i></a>
                                        @endif
                                    </td>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No reusult found!</td>
                                    </tr>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                        {{ $roles->withQueryString()->links() }}
                    </div>

                </div>
            </div>
        </div>
        <div class="section-body">
        </div>
    </section>
@endsection
