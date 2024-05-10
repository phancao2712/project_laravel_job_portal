@extends('frontend.layouts.master')

@section('contents')
    {{-- hero-section start --}}
    @include('frontend.home.hero_section')
    {{-- hero-section end --}}

    <div class="mt-100"></div>

    {{-- category-section start --}}
    @include('frontend.home.category_section')
    {{-- category-section end --}}

    {{-- futured-section start --}}
    @include('frontend.home.featured_section')
    {{-- futured-section end --}}

    {{-- why-section start --}}
    @include('frontend.home.why_choose_section')
    {{-- why-section end --}}

    {{-- learn_more-section start --}}
    @include('frontend.home.learn_more_section')
    {{-- learn_more-section end --}}

    {{-- recruiters_section start --}}
    @include('frontend.home.recruiters_section')
    {{-- recruiters_section end --}}

    @if (auth()->user()?->role == 'company')
        {{-- price_section start --}}
        @include('frontend.home.price_section')
        {{-- price_section end --}}
    @endif
    {{-- job_by_location_section start --}}
    @include('frontend.home.job_by_location_section')
    {{-- job_by_location_section end --}}

    {{-- blog_section start --}}
    @include('frontend.home.blog_section')
    {{-- blog_section end --}}
@endsection
