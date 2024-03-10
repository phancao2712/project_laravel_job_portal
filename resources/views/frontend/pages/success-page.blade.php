@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Payment Success</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Payment Success</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-90">
        <div class="container">
            <div style="text-align: center; margin-bottom:90px;" >
                <i class="fa-solid fa-circle-check" style="font-size:100px; color:rgb(1, 152, 1); margin-bottm: 90px;"></i>
                <h2>Payment Successful</h2>
                <a class="btn-default btn btn-shadow hover-up mt-4" href="{{ route('company.dashboard') }}" >Go to
                    Dashboard</a>
            </div>
        </div>
    </section>
@endsection
