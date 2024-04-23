@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Companies</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ route('home') }}">Home</a></li>
                            <li>Companies</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-120">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-9 col-md-12 col-sm-12 col-12 float-right">
                    <div class="content-page company_page text-center">
                        <div class="row">
                            @forelse ($companies as $company)
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="card-grid-1 hover-up wow animate__animated animate__fadeIn">
                                        <div class="image-box"><a href="company-details.html"><img
                                                    src="{{ asset($company?->logo) }}" alt="joblist"></a></div>
                                        <div class="info-text mt-10">
                                            <h5 class="font-bold"><a
                                                    href="{{ route('companies.show', $company->slug) }}">{{ $company?->name }}</a>
                                            </h5>
                                            <div class="mt-5">
                                            </div><span
                                                class="card-location">{{ formatLocation($company->companyCountry?->name, $company->companyProvince?->name) }}</span>
                                            <div class="mt-30"><a class="btn btn-grey-big"
                                                    href="{{ route('companies.show', $company->slug) }}"><span>{{ $company->jobs_count }}</span><span>
                                                        Jobs
                                                        Open</span></a></div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h5>Sorry! No data Found😢.</h5>
                            @endforelse
                        </div>
                    </div>
                    <div class="paginations">
                        @if ($companies->hasPages())
                            {{ $companies->withQueryString()->links() }}
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="sidebar-shadow none-shadow mb-30">
                        <div class="sidebar-filters">
                            <div class="filter-block head-border mb-30">
                                <h5>Advance Filter <a class="link-reset" href="{{ route('companies.index') }}">Reset</a>
                                </h5>
                            </div>
                            <form action="{{ route('companies.index') }}" method="GET">
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control"
                                        value="{{ request('search') }}" placeholder="Search...">
                                </div>
                                <div class="filter-block mb-20">
                                    <div class="form-group select-style">
                                        <select name="country" class="form-control country form-icons select-active">
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $country)
                                                <option @selected(request('country') == $country->id) value="{{ $country->id }}">
                                                    {{ $country?->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="filter-block mb-20">
                                    <div class="form-group select-style">
                                        <select name="province" class="form-control province form-icons select-active">
                                            <option value="">Select Province</option>
                                            @if ($selectedProvince)
                                                @foreach ($selectedProvince as $province)
                                                    <option @selected(request('province') == $province->id) value="{{ $province->id }}">
                                                        {{ $province->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="filter-block mb-30">
                                    <div class="form-group select-style">
                                        <select name="district" class="form-control district form-icons select-active">
                                            <option value="">Select District</option>
                                            @if ($selectedDistrict)
                                                @foreach ($selectedDistrict as $district)
                                                    <option @selected(request('district') == $district->id) value="{{ $district->id }}">
                                                        {{ $district->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <button class="submit btn btn-default mt-10 rounded-1 w-100"
                                            type="submit">Search</button>
                                    </div>
                                </div>

                            </form>
                            <form action="{{ route('companies.index') }}" method="GET">
                                <div class="filter-block mb-20">
                                    <h5 class="medium-heading mb-15">Industry</h5>
                                    <div class="form-group">
                                        <ul class="list-checkbox">
                                                @foreach ($industries as $type)
                                            <li>
                                                <label class="d-flex gap-2" style="flex: start">
                                                    <input @checked(request()->industry == $type->slug) type="radio" value="{{ $type->slug }}" name="industry" class="x-radio"><span
                                                        class="text-small">{{ $type->name }}</span>
                                                </label><span class="number-item">{{ $type->companies_count }}</span>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="filter-block mb-30">
                                    <h5 class="medium-heading mb-10">Popular Keyword</h5>
                                    <div class="form-group">
                                        <ul class="list-checkbox">
                                            @foreach ($organization_types as $type)
                                            <li>
                                                <label class="d-flex gap-2" style="flex: start">
                                                    <input @checked(request()->organization == $type->slug) type="radio" value="{{ $type->slug }}" name="organization" class="x-radio"><span
                                                        class="text-small">{{ $type->name }}</span>
                                                </label><span class="number-item">{{ $type->companies_count }}</span>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <button class="submit btn btn-default mt-10 rounded-1 w-100"
                                            type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@include('frontend.layouts.get_location')
