@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>District</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Create District</h4>
                    <div class="card-header-form">
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.district.store') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-4">
                                <label>Country Name</label>
                                <select name="country_id" id="" class="form-control select2 country">
                                    <option value="">Select country</option>
                                    @foreach ($countries as $country)
                                        <option @selected(old('country_id') == $country->id) value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('country_id')" class="mt-2" />
                            </div>
                            <div class="col-4">
                                <label>Province Name</label>
                                <select name="province_id" id="" class="form-control select2 province">
                                    <option value="">Select Province</option>

                                </select>
                                <x-input-error :messages="$errors->get('province_id')" class="mt-2" />
                            </div>
                            <div class="col-4">
                                <label>District Name</label>
                                <input type="text" value="{{ old('name') }}" name="name" class="form-control {{ hasError($errors, 'name') }}">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
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
@include('admin.location.district.getLocation');
