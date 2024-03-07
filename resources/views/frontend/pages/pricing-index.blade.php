@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Pricing page</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Pricing page</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-90">
        <div class="container">
            <h2 class="text-center mb-15 wow animate__animated animate__fadeInUp">Pricing Table</h2>
            <div class="font-lg color-text-paragraph-2 text-center wow animate__animated animate__fadeInUp">Choose The Best
                Plan That&rsquo;s For You</div>
            <div class="max-width-price">
                <div class="block-pricing mt-70">
                    <div class="row">
                        @foreach ($plans as $plan)
                            <div class="col-xl-4 col-lg-6 col-md-6 wow animate__animated animate__fadeInUp">
                                <div class="box-pricing-item">
                                    <h3>{{ $plan->lable }}</h3>
                                    <div class="box-info-price"><span
                                            class="text-price for-month display-month">${{ $plan->price }}</span><span
                                            class="text-month">/month</span></div>
                                    <ul class="list-package-feature">
                                        <li>{{ $plan->job_limit }} Job limit</li>
                                        <li>{{ $plan->feature_job_limit }} Feature job limit</li>
                                        <li>{{ $plan->highlight_job_limit }} Highlight job limit</li>
                                        @if ($plan->profile_verified)
                                            <li>Profile verified</li>
                                        @else
                                            <li><strike>Profile verified</strike></li>
                                        @endif
                                    </ul>
                                    <div><a class="btn btn-border" href="#">Choose plan</a></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
