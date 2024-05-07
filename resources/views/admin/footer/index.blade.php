@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Footer</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Footer</h4>
                    <div class="card-header-form">
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.footer.update', 1) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <x-image-preview :height="50" :width="100" :source="$footer?->logo" />
                            <label>Image</label>
                            <input type="file" name="image" class="form-control {{ hasError($errors, 'image') }}"
                                value="{{ old('image') }}">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="editor" cols="30" rows="10">{{ $footer?->description }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <label>Copyright</label>
                            <input type="text" name="copyright" class="form-control {{ hasError($errors, 'copyright') }}"
                                value="{{ old('copyright', $footer?->copyright) }}">
                            <x-input-error :messages="$errors->get('copyright')" class="mt-2" />
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
