@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>About us page</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update About us page</h4>
                    <div class="card-header-form">
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.about-us.update', 1) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <x-image-preview :height="200" :width="300" :source="$aboutUs?->image" />
                            <label>Image</label>
                            <input type="file" name="image" class="form-control {{ hasError($errors, 'image') }}"
                                value="{{ old('image') }}">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control {{ hasError($errors, 'title') }}"
                                value="{{ old('title', $aboutUs?->title) }}">
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="editor" cols="30" rows="10">{{ $aboutUs?->description }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <label>Url</label>
                            <input type="text" name="url" class="form-control {{ hasError($errors, 'url') }}"
                                value="{{ old('url', $aboutUs?->url) }}">
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
