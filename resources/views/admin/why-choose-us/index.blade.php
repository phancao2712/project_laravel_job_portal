@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Why Choose Us Section</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Why Choose Us Sections</h4>
                    <div class="card-header-form">
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.whyChooseUs.update', 1) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Icon 1</label>
                                    <div role="iconpicker"
                                    data-align="left"
                                    name="icon_1"
                                    class="{{ hasError($errors, 'icon_1') }}"
                                    data-icon="{{ old('icon_1', $sections?->icon_1) }}"
                                    ></div>
                                  <x-input-error :messages="$errors->get('icon_1')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label>Title 1</label>
                                    <input type="text"
                                    name="title_1" class="form-control {{ hasError($errors, 'title_1') }}"
                                    value="{{ old('title_1', $sections?->title_1) }}"
                                    >
                                  <x-input-error :messages="$errors->get('title_1')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <label>Sub Title 1</label>
                                    <input type="text"
                                    name="subtitle_1" class="form-control {{ hasError($errors, 'subtitle_1') }}"
                                    value="{{ old('subtitle_1', $sections?->subtitle_1) }}"
                                    >
                                  <x-input-error :messages="$errors->get('subtitle_1')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Icon 2</label>
                                    <div role="iconpicker"
                                    data-align="left"
                                    name="icon_2"
                                    class="{{ hasError($errors, 'icon_2') }}"
                                    data-icon="{{ old('icon_2', $sections?->icon_2) }}"
                                    ></div>
                                  <x-input-error :messages="$errors->get('icon_2')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label>Title 2</label>
                                    <input type="text"
                                    name="title_2" class="form-control {{ hasError($errors, 'title_2') }}"
                                    value="{{ old('title_2', $sections?->title_2) }}"
                                    >
                                  <x-input-error :messages="$errors->get('title_1')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <label>Sub Title 2</label>
                                    <input type="text"
                                    name="subtitle_2" class="form-control {{ hasError($errors, 'subtitle_2') }}"
                                    value="{{ old('subtitle_2', $sections?->subtitle_2) }}"
                                    >
                                  <x-input-error :messages="$errors->get('subtitle_2')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Icon 3</label>
                                    <div role="iconpicker"
                                    data-align="left"
                                    name="icon_3"
                                    class="{{ hasError($errors, 'icon_3') }}"
                                    data-icon="{{ old('icon_3', $sections?->icon_3) }}"
                                    ></div>
                                  <x-input-error :messages="$errors->get('icon_3')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label>Title 3</label>
                                    <input type="text"
                                    name="title_3" class="form-control {{ hasError($errors, 'title_3') }}"
                                    value="{{ old('title_3', $sections?->title_3) }}"
                                    >
                                  <x-input-error :messages="$errors->get('title_1')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <label>Sub Title 3</label>
                                    <input type="text"
                                    name="subtitle_3" class="form-control {{ hasError($errors, 'subtitle_3') }}"
                                    value="{{ old('subtitle_3', $sections?->subtitle_3) }}"
                                    >
                                  <x-input-error :messages="$errors->get('subtitle_3')" class="mt-2" />
                                </div>
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
