@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Social Icons</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>All Social Icon</h4>
                    <div class="card-header-form">

                    </div>
                    <a href="{{ route('admin.social-icons.create') }}" class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i> Create New</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tbody >
                                <tr>
                                    <th>Icon</th>
                                    <th>Url</th>
                                    <th style="width:10%;">Action</th>
                                </tr>
                                @forelse ($socialIcons as $icon)
                                <tr>
                                    <td><i class="{{ $icon?->icon }}" style="font-size:30px;"></i></td>
                                    <td>{{ $icon?->url }}</td>
                                    <td >
                                        <a href="{{ route('admin.social-icons.edit', $icon->id) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="{{ route('admin.social-icons.destroy', $icon->id) }}" class="btn btn-sm btn-danger delete-btn"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">No reusult found!</td>
                                </tr>

                                @endforelse
                            </tbody>

                        </table>
                        {{ $socialIcons->withQueryString()->links() }}
                    </div>

                </div>
            </div>
        </div>
        <div class="section-body">
        </div>
    </section>
@endsection
