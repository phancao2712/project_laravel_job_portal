@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Section Hero</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Section Hero</h4>
                    <div class="card-header-form">
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.heros.update', 1) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-image-preview :height="200" :width="300" :source="$hero?->image" />
                                    <label>Image</label>
                                    <input type="file" name="image"
                                    class="form-control {{ hasError($errors, 'image') }}"
                                    value="{{ old('image') }}"
                                    >
                                  <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-image-preview :height="200" :width="300"  :source="$hero?->background_image"/>
                                    <label>Background Image</label>
                                    <input type="file" name="backgroundImage"
                                    class="form-control {{ hasError($errors, 'backgroundImage') }}"
                                    value="{{ old('backgroundImage') }}"
                                    >
                                  <x-input-error :messages="$errors->get('backgroundImage')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title"
                            class="form-control {{ hasError($errors, 'title') }}"
                            value="{{ old('title', $hero?->title) }}"
                            >
                          <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <label>Sub title</label>
                            <input type="text" name="sub_title"
                            class="form-control {{ hasError($errors, 'sub_title') }}"
                            value="{{ old('sub_title', $hero?->sub_title) }}"
                            >
                          <x-input-error :messages="$errors->get('sub_title')" class="mt-2" />
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
