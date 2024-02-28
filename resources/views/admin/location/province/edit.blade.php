@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Provinces</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Province</h4>
                    <div class="card-header-form">
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.province.update', $province->id) }}"  method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <div class="col-6">
                                <label>Country Name</label>
                            <select name="country_id" id="" class="form-control select2">
                                <option value="">Select country</option>
                                @foreach ($countries as $country)
                                <option value="{{ $country->id }}" {{ ($province->country_id == $country->id) ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('country_id')" class="mt-2" />
                            </div>
                            <div class="col-6">
                                <label>Province Name</label>
                            <input type="text" value="{{ $province->name }}" name="name" class="form-control {{ hasError($errors, 'name') }}">
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
