<div class="tab-pane fade" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
    <div class="row mt-30">
        <div class="col-md-12">
            <h4>Email Account</h4>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="font-sm color-text-mutted mb-10">Email</label>
                        <input class="form-control" type="text" value="{{ auth()->user()->email }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <form action="{{ route('candidate.profile.account-info') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <h4>Location</h4>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="form-group select-style">
                            <label class="font-sm color-text-mutted mb-10">Country *</label>
                            <select
                                class="country form-control form-icons select-active select2-hidden-accessible {{ $errors->has('country') ? 'is-invalid' : '' }}"
                                name="country" id="">
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                    <option @selected($candidate?->country === $country->id) value="{{ $country->id }}">
                                        {{ $country->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('country')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group select-style">
                            <label class="font-sm color-text-mutted mb-10">Province</label>
                            <select
                                class="province form-control form-icons select-active select2-hidden-accessible {{ $errors->has('province') ? 'is-invalid' : '' }}"
                                name="province" id="">
                                @foreach ($provinces as $province)
                                    <option @selected($candidate?->province == $province->id) value="{{ $province->id }}">
                                        {{ $province->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('province')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group select-style">
                            <label class="font-sm color-text-mutted mb-10">District</label>
                            <select
                                class="district form-control form-icons select-active select2-hidden-accessible {{ $errors->has('district') ? 'is-invalid' : '' }}"
                                name="district" id="">
                                @foreach ($districts as $district)
                                    <option @selected($candidate?->district == $district->id) value="{{ $district->id }}">
                                        {{ $district->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('district')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Address </label>
                            <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                type="text" value="{{ old('address', $candidate?->address) }}" name="address">
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-30">
                <div class="col-md-12">
                    <h4>Your Contact Information</h4>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-sm color-text-mutted mb-10">Phone</label>
                                <input class="form-control {{ $errors->has('phone_one') ? 'is-invalid' : '' }}"
                                    type="text" value="{{ old('phone_one', $candidate?->phone_one) }}"
                                    name="phone_one">
                                <x-input-error :messages="$errors->get('phone_one')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-sm color-text-mutted mb-10">Secondary Phone</label>
                                <input class="form-control {{ $errors->has('phone_two') ? 'is-invalid' : '' }}"
                                    type="text" value="{{ old('phone_two', $candidate?->phone_two) }}"
                                    name="phone_two">
                                <x-input-error :messages="$errors->get('phone_two')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="font-sm color-text-mutted mb-10">Email</label>
                                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                    type="text" value="{{ old('email', $candidate?->email) }}" name="email">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
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
