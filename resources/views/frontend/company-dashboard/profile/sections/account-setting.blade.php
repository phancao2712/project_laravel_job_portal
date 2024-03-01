<div class="tab-pane fade" id="pills-contact" role="tabpanel"
aria-labelledby="pills-contact-tab" tabindex="0">
<div class="row form-contact">
    {{-- Email --}}
    <form action="{{ route('company.profile.account-info') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="font-sm color-text-mutted mb-10">Email *</label>
                    <input class="" type="text" value="{{ auth()->user()->email }}"
                        name="email" readonly>
                </div>
            </div>

            {{-- Username --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label class="font-sm color-text-mutted mb-10">Username *</label>
                    <input name='name' class="form-control" type="text"
                        value="{{ auth()->user()->name }}">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <button class="btn btn-default btn-shadow">Save</button>
        </div>
    </form>
</div>
<div class="row mt-10 form-contact">
    {{-- password --}}
    <form action="{{ route('company.profile.password-update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="font-sm color-text-mutted mb-10">Password *</label>
                    <input name="password"
                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                        type="password" value="">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            </div>

            {{-- Confirm password --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label class="font-sm color-text-mutted mb-10">Confirm Password *</label>
                    <input name="password_confirmation" class="form-control" type="password"
                        value="">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <button class="btn btn-default btn-shadow">Save</button>
        </div>
    </form>
</div>
</div>
