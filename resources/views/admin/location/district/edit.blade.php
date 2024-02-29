@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Country Types</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Country Type</h4>
                    <div class="card-header-form">
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.district.update', $district->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <div class="col-4">
                                <label>Country Name</label>
                                <select name="country_id" id="" class="form-control select2 country">
                                    <option value="">Select country</option>
                                    @foreach ($countries as $country)
                                        <option @selected($district->country_id == $country->id) value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('country_id')" class="mt-2" />
                            </div>
                            <div class="col-4">
                                <label>Province Name</label>
                                <select name="province_id" id="" class="form-control select2 province">
                                    <option value="">Select Province</option>
                                    @foreach ($provinces as $province)
                                    <option @selected($district->province_id == $province->id) value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('province_id')" class="mt-2" />
                            </div>
                            <div class="col-4">
                                <label>District Name</label>
                                <input type="text" value="{{ old('name', $district->name) }}" name="name" class="form-control {{ hasError($errors, 'name') }}">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>
                        <button class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="section-body">
        </div>
    </section>
@endsection
@include('admin.location.district.getLocation');
