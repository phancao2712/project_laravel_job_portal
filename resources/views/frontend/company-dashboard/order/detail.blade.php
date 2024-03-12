@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Profile</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ route('home') }}">Home</a></li>
                            <li>Profile</li>
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
                    <div class="col-sm-12 mt-4">
                        <div class="card p-4">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">Order Id</th>
                                        <td>{{ $order?->order_id }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Transaction No</th>
                                        <td>{{ $order?->transaction_id }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Date</th>
                                        <td>{{ formatDate($order?->created_at) }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Action</th>
                                        <td><a href="{{ route('company.orders.invoice', $order?->id) }}" class="btn btn-primary">Dowload invoice</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-sm-12 mt-4">
                        <div class="card p-4">
                            <h5 class="pl-4">Billing and Payment Info</h5>
                            <div class="card-body p-0">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Company</th>
                                            <td>{{ $order->company?->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td>{{ $order->company?->email }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Payment method</th>
                                            <td>{{ $order?->payment_provider }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 mt-4">
                        <div class="card p-4">
                            <h5 class="pl-4">Plan</h5>
                            <div class="card-body p-0">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Name</th>
                                            <td>{{ $order->plan?->lable }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Price</th>
                                            <td>{{ $order->plan?->price }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><b>Plan Benefits</b></th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Job Post Limit</th>
                                            <td>{{ $order->plan?->job_limit }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Featured Job Limit</th>
                                            <td>{{ $order->plan?->featured_job_limit }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Highlight Job Limit</th>
                                            <td>{{ $order->plan?->highlight_job_limit }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Profile Verifies</th>
                                            <td>{{ ($order->plan?->profile_verifies === 1) ? 'Yes' : 'No' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
@endsection
