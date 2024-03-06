@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Price Plan</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Create Plan</h4>
                    <div class="card-header-form">
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.plans.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Lable</label>
                                    <input type="text" name="lable"
                                        class="form-control {{ hasError($errors, 'lable') }}">
                                    <x-input-error :messages="$errors->get('lable')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" name="price"
                                        class="form-control {{ hasError($errors, 'price') }}">
                                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Job limit</label>
                                    <input type="number" name="job_limit"
                                        class="form-control {{ hasError($errors, 'job_limit') }}">
                                    <x-input-error :messages="$errors->get('job_limit')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Feature job limit</label>
                                    <input type="number" name="featured_job_limit"
                                        class="form-control {{ hasError($errors, 'featured_job_limit') }}">
                                    <x-input-error :messages="$errors->get('featured_job_limit')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Highlight job limit</label>
                                    <input type="number" name="highlight_job_limit"
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
                                            <option value="{{ $index }}">{{ $value }}</option>
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
                                            <option value="{{ $index }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('recommended')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Show this package in frontend</label>
                                    <select name="frontend_show"
                                        class="form-control {{ hasError($errors, 'frontend_show') }}" name="frontend_show">
                                        @foreach ($lists as $index => $value)
                                            <option value="{{ $index }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('frontend_show')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                </div>
                <button class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
        </div>
        <div class="section-body">
        </div>
    </section>
@endsection
