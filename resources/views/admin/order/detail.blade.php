@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Order Detail</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
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
                                    <td><a href="{{ route('admin.orders.invoice', $order?->id) }}" class="text-primary">Dowload invoice</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card">
                        <h5 class="pl-4 pt-4">Billing and Payment Info</h5>
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

                <div class="col-sm-4">
                    <div class="card">
                        <h5 class="pl-4 pt-4">Plan</h5>
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
    </section>
@endsection
