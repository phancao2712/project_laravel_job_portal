@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Payment Error</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Payment Error</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-90">
        <div class="container">
            <div style="text-align: center; margin-bottom:90px;" >
                <i class="fa-solid fa-circle-check" style="font-size:100px; color:red; margin-bottm: 90px;"></i>
                <h2>Payment Cancled</h2>
                @if (session('errors'))
                <div class="alert alert-danger mt-3" style="width:400px; margin:auto;" role="alert">
                    {{ session('errors')->first('error') }}
                  </div>
                @endif
                <a class="btn-default btn btn-shadow hover-up mt-4" href="{{ route('company.dashboard') }}" >Go to
                    Dashboard</a>
            </div>
        </div>
    </section>
@endsection
