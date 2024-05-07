@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Job Location</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Job Location</h4>
                    <div class="card-header-form">
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.job-location.update', $jobLocation?->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <x-image-preview :height="200" :width="300" :source="$jobLocation?->image" />
                                    <label>Image</label>
                                    <input type="file" name="image"
                                        class="form-control {{ hasError($errors, 'image') }}" value="{{ old('image') }}">
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="form group row">
                            <div class="col-6">
                                <label>Country Name</label>
                                <select name="country_id" id="" class="form-control select2 country">
                                    <option value="">Select country</option>
                                    @foreach ($countries as $country)
                                        <option @selected($jobLocation?->country_id == $country->id) value="{{ $country->id }}">
                                            {{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('country_id')" class="mt-2" />
                            </div>
                            <div class="col-6">
                                <label>Province Name</label>
                                <select name="province_id" id="" class="form-control select2 province">
                                    <option value="">Select Province</option>
                                    @foreach ($provinces as $province)
                                    <option @selected($jobLocation?->province_id == $province->id) value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('province_id')" class="mt-2" />
                            </div>
                        </div>
                        @php
                            $lists = [
                               'hot',
                               'trending',
                               'featured'
                            ];
                        @endphp
                            <div class="form-group mt-3">
                                <label>Status</label>
                                <select class="form-control {{ hasError($errors, 'status') }}"
                                    name="status" id="">
                                    <option value="">Select Status</option>
                                    @foreach ($lists as $list)
                                        <option @selected($jobLocation?->status == $list) value="{{ $list }}">{{ $list }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                        <button class="btn mt-4 btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="section-body">
        </div>
    </section>
@endsection
@include('admin.layouts.get-location')
