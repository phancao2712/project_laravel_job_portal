@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Blogs</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Blog</h4>
                    <div class="card-header-form">
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mt-3">
                            <label>Title <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('title', $blog->title) }}" name="title" class="form-control {{ hasError($errors, 'title') }}">
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <label>Image <span class="text-danger">*</span></label>
                            <input type="file" name="image" class="form-control {{ hasError($errors, 'image') }}">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                        <x-image-preview :source="$blog->image" :height="200" :width="300" />
                        <div class="form-group mt-3">
                            <label>Description <span class="text-danger">*</span></label>
                            <textarea name="description" id="editor" cols="30" rows="10">{!! $blog->description !!}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
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
