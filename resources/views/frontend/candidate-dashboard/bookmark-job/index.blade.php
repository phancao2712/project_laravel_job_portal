@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Bookmark Job</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ route('home') }}">Home</a></li>
                            <li>Bookmark Job</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-box mt-120">
        <div class="container">
            <div class="row">
                @include('frontend.candidate-dashboard.sidebar')
                <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">
                    <div class="">
                        <div class="d-flex justify-content-between">
                            <h3>Bookmark Job</h3>
                        </div>
                        <br>
                        <table class="table table-striped" id="bookmarkTable">
                            <thead>
                                <tr>
                                    <th scope="col">Company</th>
                                    <th scope="col">Salary</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" style="width:15%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="experience-tbody">
                                @forelse ($bookmarkJobs as $bookmarkJob)
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <img style="object-fit: cover" width="50px" height="50px" src="{{ $bookmarkJob->job->company->logo }}" alt="">
                                            <div class="ps-3">
                                                <h6><a href="{{ route('companies.show', $bookmarkJob->job->company->slug) }}">{{ $bookmarkJob->job->company->name }}</a></h6>
                                                <span>{{ $bookmarkJob->job?->company?->companyCountry?->name }}</span>
                                            </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($bookmarkJob->job->salary_mode == 'range')
                                                {{ $bookmarkJob->job->min_salary }} - {{ $bookmarkJob->job->max_salary }}
                                                {{ config('settings.site_default_currency') }}
                                            @else
                                                {{ $bookmarkJob->job?->custom_salary !== null ? $bookmarkJob->job?->custom_salary : 'compativities' }}<br>
                                            @endif
                                        </td>
                                        <td>{{ formatDate($bookmarkJob->created_at) }}</td>
                                        <td> @if($bookmarkJob->job->deadline < date('Y-m-d'))
                                            <span class="badge bg-error">Expired</span>
                                        @else
                                        <span class="badge bg-success">Active</span>

                                        @endif</td>
                                        <td>
                                            <a href="{{ route('job.show', $bookmarkJob->job->slug) }}" class="btn btn-sm btn-primary"><i class="fa-regular fa-eye"></i></a>
                                            <a href="{{ route('candidate.bookmarked-job.destroy', $bookmarkJob->id) }}" class="btn btn-sm btn-danger delete-item"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Not Found Data!</td>
                                        </tr>
                                @endforelse
                            </tbody>
                        </table>

                        @if ($bookmarkJobs->hasPages())
                            {{ $bookmarkJobs->withQueryString()->links() }}
                        @endif
                    </div>
                </div>
            </div>


        </div>
    </section>

@endsection
@push('script')
    <script>
        $("body").on("click", '.delete-item', function(e) {
            e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = $(this).attr("href");
                    console.log(url);
                    let csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        method: "DELETE",
                        url: url,
                        data: {
                            _token: csrfToken
                        },
                        beforeSend: function() {
                            showLoader()
                        },
                        success: function(response) {
                            window.location.reload()
                            hideLoader();
                            notyf.success(response.message);
                        },
                        error: function(status, error, xhr) {
                            console.log(error);
                            hideLoader();
                        },
                    });
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                }
            });
        });
    </script>
@endpush



