@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Price Plan</h1>
        </div>
        <div class="text-right">
            <a href="{{ route('admin.plans.create') }}" class="btn mb-4 btn-primary"><i class="fa-solid fa-circle-plus"></i> Create New</a>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 col-lg-4">
                <div class="pricing">
                    <div class="pricing-title">
                        Developer
                    </div>
                    <div class="pricing-padding">
                        <div class="pricing-price">
                            <div>$19</div>
                            <div>per month</div>
                        </div>
                        <div class="pricing-details">
                            <div class="pricing-item">
                                <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                <div class="pricing-item-label">1 user agent</div>
                            </div>
                            <div class="pricing-item">
                                <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                <div class="pricing-item-label">Core features</div>
                            </div>
                            <div class="pricing-item">
                                <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                <div class="pricing-item-label">1GB storage</div>
                            </div>
                            <div class="pricing-item">
                                <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                <div class="pricing-item-label">2 Custom domain</div>
                            </div>
                            <div class="pricing-item">
                                <div class="pricing-item-icon bg-danger text-white"><i class="fas fa-times"></i></div>
                                <div class="pricing-item-label">Live Support</div>
                            </div>
                        </div>
                    </div>
                    <div class="pricing-cta">
                        <a href="#">Subscribe <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-4">
                <div class="pricing pricing-highlight">
                    <div class="pricing-title">
                        Small Team
                    </div>
                    <div class="pricing-padding">
                        <div class="pricing-price">
                            <div>$60</div>
                            <div>per month</div>
                        </div>
                        <div class="pricing-details">
                            <div class="pricing-item">
                                <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                <div class="pricing-item-label">5 user agent</div>
                            </div>
                            <div class="pricing-item">
                                <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                <div class="pricing-item-label">Core features</div>
                            </div>
                            <div class="pricing-item">
                                <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                <div class="pricing-item-label">10GB storage</div>
                            </div>
                            <div class="pricing-item">
                                <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                <div class="pricing-item-label">10 Custom domain</div>
                            </div>
                            <div class="pricing-item">
                                <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                <div class="pricing-item-label">24/7 Support</div>
                            </div>
                        </div>
                    </div>
                    <div class="pricing-cta">
                        <a href="#">Subscribe <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-4">
                <div class="pricing">
                    <div class="pricing-title">
                        Enterprise
                    </div>
                    <div class="pricing-padding">
                        <div class="pricing-price">
                            <div>$499</div>
                            <div>per month</div>
                        </div>
                        <div class="pricing-details">
                            <div class="pricing-item">
                                <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                <div class="pricing-item-label">Unlimited user agent</div>
                            </div>
                            <div class="pricing-item">
                                <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                <div class="pricing-item-label">Core features</div>
                            </div>
                            <div class="pricing-item">
                                <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                <div class="pricing-item-label">8TB storage</div>
                            </div>
                            <div class="pricing-item">
                                <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                <div class="pricing-item-label">Unlimited custom domain</div>
                            </div>
                            <div class="pricing-item">
                                <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                <div class="pricing-item-label">Lifetime Support</div>
                            </div>
                        </div>
                    </div>
                    <div class="pricing-cta">
                        <a href="#">Subscribe <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection