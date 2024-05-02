@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Section Learn More</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Section Learn More</h4>
                    <div class="card-header-form">
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.learnMores.update', 1) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <x-image-preview :height="200" :width="300" :source="$learnMore?->image" />
                            <label>Image</label>
                            <input type="file" name="image" class="form-control {{ hasError($errors, 'image') }}"
                                value="{{ old('image') }}">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control {{ hasError($errors, 'title') }}"
                                value="{{ old('title', $learnMore?->title) }}">
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <label>Sub title</label>
                            <input type="text" name="subtitle" class="form-control {{ hasError($errors, 'subtitle') }}"
                                value="{{ old('subtitle', $learnMore?->subtitle) }}">
                            <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <label>Main title</label>
                            <input type="text" name="main_title" class="form-control {{ hasError($errors, 'main_title') }}"
                                value="{{ old('main_title', $learnMore?->main_title) }}">
                            <x-input-error :messages="$errors->get('main_title')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <label>Lear More Url</label>
                            <input type="text" name="url" class="form-control {{ hasError($errors, 'url') }}"
                                value="{{ old('url', $learnMore?->url) }}">
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
