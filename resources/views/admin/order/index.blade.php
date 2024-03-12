@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Orders</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>All orders</h4>
                    <div class="card-header-form">
                        <form action="{{ route('admin.orders.index') }}" method="GET">
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
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tbody>
                                <tr>
                                    <th>Order & Transaction</th>
                                    <th>Company</th>
                                    <th>Plan</th>
                                    <th>Paid Amount</th>
                                    <th>Main Price</th>
                                    <th>Payment Method</th>
                                    <th>Payment Status</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>
                                            #{{ $order->order_id }} <br>
                                            Transaction:{{ $order->transaction_id }}
                                        </td>

                                        <td class="d-flex " style="gap:10px;">
                                            <img style="width:50px; height:50px; object-fit:cover;"
                                                src="{{ asset($order->company->logo) }}" alt="">
                                            <div class="">
                                                <strong>{{ $order->company->name }}</strong> <br>
                                                {{ $order->company->email }}
                                            </div>
                                        </td>
                                        <td>
                                            {{ $order->package_name }}
                                        </td>
                                        <td>
                                            {{ $order->amount }} {{ $order->paid_in_currency }}
                                        </td>
                                        <td>
                                            {{ $order->default_amount }}
                                        </td>
                                        <td>
                                            {{ $order->payment_provider }}
                                        </td>
                                        <td>
                                            <p class="badge bg-primary text-light">{{ $order->payment_status }}</p>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary">View Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                        {{ $orders->withQueryString()->links() }}
                    </div>

                </div>
            </div>
        </div>
        <div class="section-body">
        </div>
    </section>
@endsection
