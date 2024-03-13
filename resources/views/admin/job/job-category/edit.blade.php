@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Languages</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Language</h4>
                    <div class="card-header-form">
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.job-categories.update', $jobCategory->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Icon</label>
                            <div role="iconpicker" data-align="left"
                            name="icon" class="{{ hasError($errors, 'icon') }}"
                            data-icon="{{ old('icon', $jobCategory->icon) }}"
                            ></div>
                          <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name"
                            class="form-control {{ hasError($errors, 'name') }}"
                            value="{{ old('name', $jobCategory->name) }}"
                            >
                          <x-input-error :messages="$errors->get('name')" class="mt-2" />
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
