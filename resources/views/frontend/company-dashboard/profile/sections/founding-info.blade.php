<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                            tabindex="0">
                            <form action="{{ route('company.profile.founding-info') }}" method="POST">
                                @csrf
                                <div class="row form-contact">
                                    {{-- Industry type --}}
                                    <div class="col-md-4">
                                        <div class="form-group mt-10">
                                            <label class="font-sm color-text-mutted mb-10">Industry Type *</label>
                                            <select name="industry_type_id" class="mr-10 select-active form-control "
                                                style="width:100%">
                                                <option value="">Select Industry</option>
                                                @foreach ($industryTypes as $industry)
                                                    <option @selected($companyInfo?->industry_type_id == $industry->id) value="{{ $industry->id }}">
                                                        {{ $industry->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('industry_type_id')" class="mt-2" />
                                        </div>
                                    </div>

                                    {{-- Organization type --}}
                                    <div class="col-md-4">
                                        <div class="form-group mt-10">
                                            <label class="font-sm color-text-mutted mb-10">Organization Type *</label>
                                            <select name="organization_type_id" class="mr-10 select-active form-control "
                                                style="width:100%">
                                                <option value="">Select Organization</option>
                                                @foreach ($organizationTypes as $organization)
                                                    <option @selected($companyInfo?->organization_type_id == $organization->id) value="{{ $organization->id }}">
                                                        {{ $organization->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('organization_type_id')" class="mt-2" />
                                        </div>
                                    </div>

                                    {{-- Team size --}}
                                    <div class="col-md-4">
                                        <div class="form-group mt-10">
                                            <label class="font-sm color-text-mutted mb-10">Team Size *</label>
                                            <select name="team_size_id" class="mr-10 select-active form-control"
                                                style="width:100%">
                                                <option value="">Select TeamSize</option>
                                                @foreach ($teamSizes as $teamSize)
                                                    <option @selected($companyInfo?->team_size_id == $teamSize->id) value="{{ $teamSize->id }}">
                                                        {{ $teamSize->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('team_size_id')" class="mt-2" />
                                        </div>
                                    </div>

                                    {{-- Establishment Date --}}
                                    <div class="col-md-6">
                                        <div class="form-group mt-10">
                                            <label class="font-sm color-text-mutted mb-10">Establishment Date *</label>
                                            <input name="establishment_date"
                                                value="{{ $companyInfo?->establishment_date }}" type="date"
                                                class="form-control {{ $errors->has('establishment_date') ? 'is-invalid' : '' }}">
                                            <x-input-error :messages="$errors->get('establishment_date')" class="mt-2" />
                                        </div>
                                    </div>

                                    {{-- Website --}}
                                    <div class="col-md-6">
                                        <div class="form-group mt-10">
                                            <label class="font-sm color-text-mutted mb-10">Website *</label>
                                            <input name="website" type="text" value="{{ $companyInfo?->website }}"
                                                class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}">
                                            <x-input-error :messages="$errors->get('website')" class="mt-2" />
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-md-6">
                                        <div class="form-group mt-10">
                                            <label class="font-sm color-text-mutted mb-10">Email *</label>
                                            <input name="email" type="text" value="{{ $companyInfo?->email }}"
                                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                    </div>

                                    {{-- Phone --}}
                                    <div class="col-md-6">
                                        <div class="form-group mt-10">
                                            <label class="font-sm color-text-mutted mb-10">Phone *</label>
                                            <input name="phone" type="text" value="{{ $companyInfo?->phone }}"
                                                class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}">
                                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                        </div>
                                    </div>

                                    {{-- Country --}}
                                    <div class="col-md-4">
                                        <div class="form-group mt-10">
                                            <label class="font-sm color-text-mutted  mb-10">Country</label>
                                            <select name="country" class="mr-10 select-active country form-control"
                                                style="width:100%">
                                                <option value="">Select Country</option>
                                                @foreach ($countries as $country)
                                                    <option @selected($companyInfo?->country == $country->id) value="{{ $country->id }}">
                                                        {{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('country')" class="mt-2" />
                                        </div>
                                    </div>

                                    {{-- Province --}}
                                    <div class="col-md-4">
                                        <div class="form-group mt-10">
                                            <label class="font-sm color-text-mutted mb-10">Province</label>
                                            <select name="province" class="mr-10 select-active province form-control"
                                                style="width:100%">
                                                @foreach ($provinces as $province)
                                                    <option @selected($companyInfo?->province == $province->id) value="{{ $province->id }}">
                                                        {{ $province->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('province')" class="mt-2" />
                                        </div>
                                    </div>

                                    {{-- District --}}
                                    <div class="col-md-4">
                                        <div class="form-group mt-10">
                                            <label class="font-sm color-text-mutted mb-10">District</label>
                                            <select name="district" class="mr-10 select-active district form-control"
                                                style="width:100%">
                                                @foreach ($districts as $district)
                                                    <option @selected($companyInfo?->district == $district->id) value="{{ $district->id }}">
                                                        {{ $district->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('district')" class="mt-2" />
                                        </div>
                                    </div>

                                    {{-- Address --}}
                                    <div class="col-md-12">
                                        <div class="form-group mt-10">
                                            <label class="font-sm color-text-mutted mb-10">Address</label>
                                            <input name="address" type="text" value="{{ $companyInfo?->address }}"
                                                class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                                id="">
                                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                        </div>
                                    </div>

                                    {{-- Maplink --}}
                                    <div class="col-md-12">
                                        <div class="form-group mt-10">
                                            <label class="font-sm color-text-mutted mb-10">Maplink</label>
                                            <input name="maplink" type="text" class="form-control"
                                                value="{{ $companyInfo?->map_link }}" id="">
                                        </div>
                                    </div>

                                    <div class="box-button mt-15">
                                        <button class="btn btn-apply-big font-md font-bold">Save All Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
