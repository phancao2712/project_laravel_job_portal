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
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tbody>
                                    <tr>
                                        <th>Order</th>
                                        <th>Plan</th>
                                        <th>Paid Amount</th>
                                        <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td>
                                               <strong> #{{ $order->order_id }}</strong>
                                            </td>
                                            <td>
                                                {{ $order->package_name }}
                                            </td>
                                            <td>
                                                {{ $order->amount }} {{ $order->paid_in_currency }}
                                            </td>
                                            <td>
                                                {{ $order->payment_provider }}
                                            </td>
                                            <td>
                                                <p class="badge bg-primary text-light">{{ $order->payment_status }}</p>
                                            </td>
                                            <td>
                                                <a href="{{ route('company.orders.show', $order->id) }}"
                                                    class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                                            </td>
                                        </tr>

                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No reusult found😢!</td>
                                            </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="paginations">
                                    @if ($orders->hasPages())
                                    {{ $orders->withQueryString()->links() }}
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
