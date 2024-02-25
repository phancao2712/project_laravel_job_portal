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
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">Company Info</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">Founding Info</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                                aria-selected="false">Account Setting</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        {{-- Company Info --}}
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab" tabindex="0">
                            <form action="{{ route('company.profile.company-info') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row form-contact">
                                    {{-- Logo --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            @if ($companyInfo?->logo)
                                            <x-image-preview :height="200" :width="200" :source="$companyInfo?->logo" />
                                            @endif
                                            <label class="font-sm color-text-mutted mb-10">Logo *</label>
                                            <input class="form-control {{ $errors->has('logo') ? 'is-invalid' : '' }}"
                                            type="file"
                                            value="{{ old('logo') }}"
                                            name="logo">
                                            <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                                        </div>
                                    </div>

                                    {{-- Banner --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            @if ($companyInfo?->banner)
                                            <x-image-preview :height="200" :width="500" :source="$companyInfo?->banner" />
                                            @endif
                                            <label class="font-sm color-text-mutted mb-10">Banner *</label>
                                            <input class="form-control {{ $errors->has('banner') ? 'is-invalid' : '' }}"
                                            type="file"
                                            name="banner"
                                            value="{{ old('banner') }}">
                                            <x-input-error :messages="$errors->get('banner')" class="mt-2" />
                                        </div>
                                    </div>

                                    {{-- Company Name --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Company Name *</label>
                                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            type="text"
                                            value="{{ $companyInfo?->name }}"
                                            name="name">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                    </div>

                                    {{-- Bio --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Company Bio *</label>
                                            <textarea name="bio"
                                            class="form-control {{ $errors->has('bio') ? 'is-invalid' : '' }}"
                                           >{{ $companyInfo?->bio }}</textarea>
                                            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                                        </div>
                                    </div>

                                    {{-- Vision --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Company Vision *</label>
                                            <textarea name="vision" class="form-control {{ $errors->has('vision') ? 'is-invalid' : '' }}"
                                            >{{ $companyInfo?->vision }}</textarea>
                                            <x-input-error :messages="$errors->get('vision')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="box-button mt-15">
                                        <button class="btn btn-apply-big font-md font-bold">Save All Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- Founding Info --}}
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                            tabindex="0">
                            <form action="{{ route('company.profile.founding-info') }}" method="POST">
                                @csrf
                                <div class="row form-contact">
                                    {{-- Industry type --}}
                                    <div class="col-md-4">
                                        <div class="form-group mt-10">
                                            <label class="font-sm color-text-mutted mb-10">Industry Type *</label>
                                            <select name="industry_type_id" class="mr-10 select-active form-control " style="width:100%">
                                               <option value="">Select 1</option>
                                               <option value="0">Option 1</option>
                                            </select>
                                            <x-input-error :messages="$errors->get('industry_type_id')" class="mt-2" />
                                        </div>
                                    </div>

                                    {{-- Organization type --}}
                                    <div class="col-md-4">
                                        <div class="form-group mt-10">
                                            <label class="font-sm color-text-mutted mb-10">Organization Type *</label>
                                            <select name="organization_type_id" class="mr-10 select-active form-control " style="width:100%">
                                               <option value="">Select 1</option>
                                               <option value="0">Option 1</option>

                                            </select>
                                            <x-input-error :messages="$errors->get('organization_type_id')" class="mt-2" />
                                        </div>
                                    </div>

                                    {{-- Team size --}}
                                    <div class="col-md-4">
                                        <div class="form-group mt-10">
                                            <label class="font-sm color-text-mutted mb-10">Team Size *</label>
                                            <select name="team_size_id" class="mr-10 select-active form-control" style="width:100%">
                                               <option value="">Select 1</option>
                                               <option value="0">Option 1</option>
                                            </select>
                                            <x-input-error :messages="$errors->get('team_size_id')" class="mt-2" />
                                        </div>
                                    </div>

                                    {{-- Establishment Date --}}
                                    <div class="col-md-6">
                                        <div class="form-group mt-10">
                                            <label class="font-sm color-text-mutted mb-10">Establishment Date</label>
                                            <input name="establishment_date" value="{{ $companyInfo?->establishment_date }}" type="date" class="form-control {{ $errors->has('establishment_date') ? 'is-invalid' : '' }}">
                                            <x-input-error :messages="$errors->get('establishment_date')" class="mt-2" />
                                        </div>
                                    </div>

                                    {{-- Website --}}
                                    <div class="col-md-6">
                                        <div class="form-group mt-10">
                                            <label class="font-sm color-text-mutted mb-10">Website</label>
                                            <input name="website" type="text" value="{{ $companyInfo?->website }}" class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}">
                                            <x-input-error :messages="$errors->get('website')" class="mt-2" />
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-md-6">
                                        <div class="form-group mt-10">
                                            <label class="font-sm color-text-mutted mb-10">Email *</label>
                                            <input name="email" type="text" value="{{ $companyInfo?->email }}" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                    </div>

                                    {{-- Phone --}}
                                    <div class="col-md-6">
                                        <div class="form-group mt-10">
                                            <label class="font-sm color-text-mutted mb-10">Phone *</label>
                                            <input name="phone" type="text" value="{{ $companyInfo?->phone }}" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}">
                                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                        </div>
                                    </div>

                                     {{-- Country --}}
                                     <div class="col-md-4">
                                        <div class="form-group mt-10">
                                            <label class="font-sm color-text-mutted mb-10">Country *</label>
                                            <select name="country" class="mr-10 select-active form-control" style="width:100%">
                                               <option value="">Select 1</option>
                                               <option value="0">Option 1</option>
                                            </select>
                                            <x-input-error :messages="$errors->get('country')" class="mt-2" />
                                        </div>
                                    </div>

                                    {{-- State --}}
                                    <div class="col-md-4">
                                        <div class="form-group mt-10">
                                            <label class="font-sm color-text-mutted mb-10">State</label>
                                            <select name="state" class="mr-10 select-active form-control" style="width:100%">
                                               <option value="">Select 1</option>
                                               <option value="0">Option 1</option>
                                            </select>
                                            <x-input-error :messages="$errors->get('state')" class="mt-2" />
                                        </div>
                                    </div>

                                    {{-- City --}}
                                    <div class="col-md-4">
                                        <div class="form-group mt-10">
                                            <label class="font-sm color-text-mutted mb-10">City *</label>
                                            <select name="city" class="mr-10 select-active form-control" style="width:100%">
                                               <option value="">Select 1</option>
                                               <option value="0">Option 1</option>
                                            </select>
                                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                                        </div>
                                    </div>

                                    {{-- Address --}}
                                    <div class="col-md-12">
                                        <div class="form-group mt-10">
                                            <label class="font-sm color-text-mutted mb-10">Address</label>
                                            <input name="address" type="text" value="{{ $companyInfo?->address }}" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"  id="">
                                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                        </div>
                                    </div>

                                     {{-- Maplink --}}
                                     <div class="col-md-12">
                                        <div class="form-group mt-10">
                                            <label class="font-sm color-text-mutted mb-10">Maplink</label>
                                            <input name="maplink" type="text" class="form-control" value="{{ $companyInfo?->map_link }}" id="">
                                        </div>
                                    </div>

                                    <div class="box-button mt-15">
                                        <button class="btn btn-apply-big font-md font-bold">Save All Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- Account setting --}}
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
                            tabindex="0">

                                <div class="row form-contact">
                                    {{-- Email --}}
                                    <form action="{{ route('company.profile.account-info') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="font-sm color-text-mutted mb-10">Email *</label>
                                                    <input class="" type="text" value="{{ auth()->user()->email }}" name="email" readonly>
                                                </div>
                                            </div>

                                            {{-- Username --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="font-sm color-text-mutted mb-10">Username *</label>
                                                    <input name='name' class="form-control" type="text" value="{{ auth()->user()->name }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <button class="btn btn-default btn-shadow">Save</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="row mt-10 form-contact">
                                    {{-- password --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Password *</label>
                                            <input class="form-control" type="password" value="">
                                        </div>
                                    </div>

                                    {{-- Confirm password --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Confirm Password *</label>
                                            <input class="form-control" type="password" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <button class="btn btn-default btn-shadow">Save</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    </div>
@endsection
