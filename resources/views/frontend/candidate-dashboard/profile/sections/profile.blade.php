<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
    <form action="{{ route('candidate.profile.profile-info') }}" method="POST">
        @csrf
        <div class="row form-contact">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group select-style">
                            @php
                                $genders = ['male', 'female'];
                            @endphp
                            <label class="font-sm color-text-mutted mb-10">Gender *</label>
                            <select
                                class="form-control form-icons select-active select2-hidden-accessible {{ $errors->has('gender') ? 'is-invalid' : '' }}"
                                name="gender" id="">
                                <option value="">Select Gender</option>
                                @foreach ($genders as $gender)
                                    <option @selected($gender === $candidate?->gender) value="{{ $gender }}">{{ $gender }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group select-style">
                            @php
                                $maritals = ['married', 'single'];
                            @endphp
                            <label class="font-sm color-text-mutted mb-10">Marital Status *</label>
                            <select
                                class="form-control form-icons select-active select2-hidden-accessible {{ $errors->has('marital_status') ? 'is-invalid' : '' }}"
                                name="marital_status" id="">
                                <option value="">Select Marital Status</option>
                                @foreach ($maritals as $marital)
                                    <option @selected($marital === $candidate?->marital_status) value="{{ $marital }}">{{ $marital }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('marital_status')" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group select-style">
                            <label class="font-sm color-text-mutted mb-10">Profession *</label>
                            <select
                                class="form-control form-icons select-active select2-hidden-accessible {{ $errors->has('profession') ? 'is-invalid' : '' }}"
                                name="profession" id="">
                                <option value="">Select Profession</option>
                                @foreach ($professions as $profession)
                                    <option @selected($profession->id === $candidate?->profession_id) value="{{ $profession->id }}">{{ $profession->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('profession')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group select-style">
                            <label class="font-sm color-text-mutted mb-10">Your availabillty *</label>
                            <select class="form-control form-icons select-active select2-hidden-accessible"
                                name="availability" id="">
                                <option value="">Select availabillty</option>
                                <option @selected($candidate?->status === 'available') value="available">Available</option>
                                <option @selected($candidate?->status === 'not_available') value="not_available">Not Available</option>
                            </select>
                            <x-input-error :messages="$errors->get('availability')" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="form-group select-style">
                    <label class="font-sm color-text-mutted mb-10">Skill You Have *</label>
                    <select name="skill[]" multiple=""
                        class="form-control form-icons select-active select2-hidden-accessible {{ $errors->has('skill') ? 'is-invalid' : '' }}">
                        <option value="">Select Skills</option>
                        @php
                            $candidateSkills = $candidate?->skills->pluck('skill_id')->toArray() ?? [];
                        @endphp
                        @foreach ($skills as $skill)
                            <option @selected(in_array($skill->id , $candidateSkills)) value="{{ $skill->id }}">{{ $skill->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('skill')" class="mt-2" />
                </div>

                <div class="form-group select-style">
                    <label class="font-sm color-text-mutted mb-10">Language You Now *</label>
                    <select name="language[]" multiple=""
                        class="form-control form-icons select-active select2-hidden-accessible {{ $errors->has('language') ? 'is-invalid' : '' }}">
                        <option value="">Select Languages</option>
                        @php
                            $candidateLanguages = $candidate?->languages->pluck('language_id')->toArray() ?? [];
                        @endphp
                        @foreach ($languages as $language)
                            <option @selected(in_array($language->id , $candidateLanguages)) value="{{ $language->id }}">{{ $language->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('language')" class="mt-2" />
                </div>

                <div class="form-group select-style">
                    <label class="font-sm color-text-mutted mb-10">Biography *</label>
                    <textarea name="bio" id="editor">{!! $candidate?->bio !!}</textarea>
                    <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                </div>
            </div>

        </div>
        <div class="box-button mt-15">
            <button class="btn btn-apply-big font-md font-bold">Save All Changes</button>
        </div>
    </form>
</div>
  