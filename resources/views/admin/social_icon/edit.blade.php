@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Social Icons</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Social Icon</h4>
                    <div class="card-header-form">
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.social-icons.update', $socialIcon->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Icon</label>
                            <div role="iconpicker" data-align="left" name="icon" class="{{ hasError($errors, 'icon') }}"
                                data-icon="{{ old('icon', $socialIcon?->icon) }}"></div>
                            <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <label>Url</label>
                            <input type="text" name="url" class="form-control {{ hasError($errors, 'url') }}"
                                value="{{ old('url', $socialIcon?->url) }}">
                            <x-input-error :messages="$errors->get('url')" class="mt-2" />
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
