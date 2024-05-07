@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Job Locations</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Job Location Table</h4>
                    <a href="{{ route('admin.job-location.create') }}" class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i> Create New</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tbody >
                                <tr>
                                    <th>Image</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th style="width:10%;">Action</th>
                                </tr>
                                @forelse ($jobLocations as $jobLocation)
                                <tr>
                                    <td><x-image-preview :height="50" :width="100" :source="$jobLocation?->image" /></td>
                                    <td>{{ formatLocation($jobLocation?->country->name, $jobLocation?->province->name) }}</td>
                                    <td><span class="badge text-white bg-primary">{{ $jobLocation?->status }}</span></td>
                                    <td>
                                        <a href="{{ route('admin.job-location.edit', $jobLocation?->id) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="{{ route('admin.job-location.destroy', $jobLocation?->id) }}" class="btn btn-sm btn-danger delete-btn"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">No reusult found!</td>
                                </tr>
                                @endforelse
                            </tbody>

                        </table>
                       @if ($jobLocations->hasPages())
                       {{ $jobLocations->withQueryString()->links() }}
                       @endif
                    </div>

                </div>
            </div>
        </div>
        <div class="section-body">
        </div>
    </section>
@endsection
