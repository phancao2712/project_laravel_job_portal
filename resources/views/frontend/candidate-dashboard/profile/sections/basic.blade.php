<div class="tab-pane fade show active" id="pills-basic" role="tabpanel" aria-labelledby="pills-basic-tab" tabindex="0">
    <form action="{{ route('candidate.profile.basic-info') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row form-contact">
            {{-- Logo --}}
            <div class="col-md-3">
                <div class="form-group">
                    @if ($candidate?->image)
                                                <x-image-preview :height="200" :width="200" :source="$candidate?->image" />
                                            @endif
                    <label class="font-sm color-text-mutted mb-10">Profile Picture *</label>
                    <input class="form-control {{ $errors->has('picture') ? 'is-invalid' : '' }}" type="file"
                    name="picture">
                    <x-input-error :messages="$errors->get('picture')" class="mt-2" />
                </div>
                <div class="form-group">
                    <label class="font-sm color-text-mutted mb-10">CV <span class="mr-10 text-primary">{{ ($candidate?->cv) ? 'Have atteched CV!' : '' }}</span></label>
                    <input class="form-control {{ $errors->has('cv') ? 'is-invalid' : '' }}" type="file"
                        value="{{ old('cv') }}" name="cv">
                    <x-input-error :messages="$errors->get('cv')" class="mt-2" />
                </div>
            </div>

            {{-- Company Name --}}
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Fullname *</label>
                            <input class="form-control {{ $errors->has('fullname') ? 'is-invalid' : '' }}" type="text"
                                value="{{ old('fullname', $candidate?->fullname) }}" name="fullname">
                            <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Title/Tagline</label>
                            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text"
                                value="{{ old('title', $candidate?->title) }}" name="title">
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group select-style">
                            <label class="font-sm color-text-mutted mb-10">Experience Level *</label>
                            <select name="experience" class="form-control form-icons select-active select2-hidden-accessible {{ $errors->has('experience') ? 'is-invalid' : '' }} select-2">
                                @foreach ($experience as $exp)
                                <option value="{{ $exp->id }}">{{ $exp->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('experience')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Website</label>
                            <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text"
                                value="{{ old('website', $candidate?->website) }}" name="website">
                            <x-input-error :messages="$errors->get('website')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Date Of Birth</label>
                            <input class="form-control {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" type="date"
                                value="{{ old('date_of_birth', $candidate?->birth_date) }}" name="date_of_birth">
                            <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>


            <div class="box-button mt-15">
                <button class="btn btn-apply-big font-md font-bold">Save All Changes</button>
            </div>
        </div>
    </form>
</div>
