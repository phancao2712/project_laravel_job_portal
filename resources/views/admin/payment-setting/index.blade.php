@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Payment Gateway Setting</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>All Gateway setting</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-3">
                            <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab4" data-toggle="tab" href="#home4"
                                        role="tab" aria-controls="home" aria-selected="true">Paypal</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4" role="tab"
                                        aria-controls="profile" aria-selected="false">Stripe</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4" role="tab"
                                        aria-controls="contact" aria-selected="false">Razorpay</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-sm-12 col-md-9">
                            <div class="tab-content no-padding" id="myTab2Content">
                                {{-- Paypal --}}
                                @include('admin.payment-setting.sections.paypal')

                                {{-- Stripe --}}
                                @include('admin.payment-setting.sections.stripe')

                                {{-- Razor --}}
                                @include('admin.payment-setting.sections.razorpay')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-body">
        </div>
    </section>
@endsection
