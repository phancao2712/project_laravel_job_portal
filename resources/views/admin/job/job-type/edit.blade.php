@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Job Types</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Job Type</h4>
                    <div class="card-header-form">
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.job-types.update', $jobType->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name"
                            class="form-control {{ hasError($errors, 'name') }}"
                            value="{{ old('name', $jobType->name) }}"
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
