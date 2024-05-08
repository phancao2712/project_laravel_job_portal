@extends('admin.layouts.master')
@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Price Plan</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Plan</h4>
                    <div class="card-header-form">
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.plans.update', $plan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Label</label>
                                    <input value="{{ old('label', $plan->label) }}" type="text" name="label" class="form-control {{ hasError($errors, 'label') }}">
                                  <x-input-error :messages="$errors->get('label')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input value="{{ old('price', $plan->price) }}" type="number" name="price"
                                        class="form-control {{ hasError($errors, 'price') }}">
                                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Job limit</label>
                                    <input value="{{ old('job_limit', $plan->job_limit) }}" type="number" name="job_limit"
                                        class="form-control {{ hasError($errors, 'job_limit') }}">
                                    <x-input-error :messages="$errors->get('job_limit')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Feature job limit</label>
                                    <input value="{{ old('featured_job_limit', $plan->featured_job_limit) }}" type="number" name="featured_job_limit"
                                        class="form-control {{ hasError($errors, 'featured_job_limit') }}">
                                    <x-input-error :messages="$errors->get('featured_job_limit')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Highlight job limit</label>
                                    <input value="{{ old('highlight_job_limit', $plan->highlight_job_limit) }}" type="number" name="highlight_job_limit"
                                        class="form-control {{ hasError($errors, 'highlight_job_limit') }}">
                                    <x-input-error :messages="$errors->get('highlight_job_limit')" class="mt-2" />
                                </div>
                            </div>
                            @php
                                $lists = [
                                    0 => 'No',
                                    1 => 'Yes',
                                ];
                            @endphp
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Profile verified</label>
                                    <select class="form-control {{ hasError($errors, 'profile_verified') }}"
                                        name="profile_verified" id="">
                                        @foreach ($lists as $index => $value)
                                            <option @selected($plan->profile_verified === $index) value="{{ $index }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('profile_verified')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Recommend</label>
                                    <select name="recommended" class="form-control {{ hasError($errors, 'recommended') }}"
                                        name="recommended">
                                        @foreach ($lists as $index => $value)
                                            <option @selected($plan->recommended === $index) value="{{ $index }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('recommended')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Show this package at page</label>
                                    <select name="frontend_show"
                                        class="form-control {{ hasError($errors, 'frontend_show') }}" name="frontend_show">
                                        @foreach ($lists as $index => $value)
                                            <option @selected($plan->frontend_show === $index) value="{{ $index }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('frontend_show')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Show this package at home</label>
                                    <select name="show_at_home"
                                        class="form-control {{ hasError($errors, 'show_at_home') }}" name="show_at_home">
                                        @foreach ($lists as $index => $value)
                                            <option @selected($plan->show_at_home === $index) value="{{ $index }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('show_at_home')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
                </form>
            </div>
        </div>
        </div>
        <div class="section-body">
        </div>
    </section>
@endsection
