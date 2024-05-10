@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Applications</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ route('home') }}">Home</a></li>
                            <li>Applications</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-box mt-120">
        <div class="container">
            <div class="row">
                @include('frontend.company-dashboard.sidebar')
                <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $jobTitle->title }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-md">
                                    <tbody>
                                        <tr>
                                            <th style="width:270px">Detail</th>
                                            <th>Experience</th>
                                            <th style="width:20%;">Action</th>
                                        </tr>
                                        @foreach ($applications as $application)
                                            <tr>
                                                <td>
                                                   <div class="d-flex">
                                                    <img height="50px" width="50px" style="object-fit: cover;" src="{{ $application->candidate?->image }}" alt="">
                                                    <div class="ms-3">
                                                        <div>{{ $application->candidate->fullname }}</div>
                                                        <div>{{ $application->candidate->profession?->name }}</div>
                                                    </div>
                                                   </div>
                                                </td>
                                                <td>
                                                    {{ $application->candidate->experience->name }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('candidates.show', $application->candidate->slug) }}"
                                                        class="btn btn-primary">View profile</i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                @if ($applications->hasPages())
                                    {{ $applications->withQueryString()->links() }}
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
@endsection
