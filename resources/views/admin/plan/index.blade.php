@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Price Plan</h1>
        </div>
        <div class="text-right">
            <a href="{{ route('admin.plans.create') }}" class="btn mb-4 btn-primary"><i class="fa-solid fa-circle-plus"></i>
                Create New</a>
        </div>
        <div class="row">
            @foreach ($plans as $plan)
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="pricing">
                        @if ($plan->recommended)
                            <div class="pricing-title">
                                Recommend
                            </div>
                        @endif

                        <div class="pricing-padding">
                            @if ($plan->frontend_show)
                                <span class="badge text-light bg-primary">Showing at page</span>
                            @endif
                            @if ($plan->show_at_home)
                                <span class="badge text-light bg-success">Showing at page</span>
                            @endif
                        </div>
                        <div class="pricing-padding">
                            <div>
                                <h4>{{ $plan->label }}</h4>
                            </div>
                            <div class="pricing-price">
                                <div>${{ $plan->price }}</div>
                            </div>
                            <div class="pricing-details">
                                <div class="pricing-item">
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                    <div class="pricing-item-label">{{ $plan->job_limit }} Job Post Limit</div>
                                </div>
                                <div class="pricing-item">
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                    <div class="pricing-item-label">{{ $plan->featured_job_limit }} Featured Job Post Limit
                                    </div>
                                </div>
                                <div class="pricing-item">
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                    <div class="pricing-item-label">{{ $plan->highlight_job_limit }} Highlight Job Post
                                        Limit</div>
                                </div>

                                <div class="pricing-item">
                                    @if ($plan->profile_verified)
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        <div class="pricing-item-label">Verify Company</div>
                                    @else
                                        <div class="pricing-item-icon bg-danger text-white"><i class="fas fa-times"></i>
                                        </div>
                                        <div class="pricing-item-label">Verify Company</div>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="pricing-cta d-flex" style="justify-content: space-between; width:100%;">
                            <a class="w-100 bg-primary text-light" href="{{ route('admin.plans.edit', $plan->id) }}">Edit <i
                                    class="fas fa-arrow-right "></i></a>
                            <a class="w-100 bg-danger text-light delete-btn"
                                href="{{ route('admin.plans.destroy', $plan->id) }}">Delete <i class="fas fa-times"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
