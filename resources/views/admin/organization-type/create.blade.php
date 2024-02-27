@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Organization Types</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Create Organization Type</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.organization-types.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Organization Type Name</label>
                            <input type="text" name="name" class="form-control {{ hasError($errors, 'name') }}">
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
