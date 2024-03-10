<div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">
    <form action="{{ route('admin.stripe-settings.update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Stripe Status</label>
                    <select name="stripe_status" id="" class="form-control">
                        <option @selected(config('gatewaySettings.stripe_status') === 'active') value="active">Active</option>
                        <option @selected(config('gatewaySettings.stripe_status') === 'inactive') value="inactive">Inactive</option>
                    </select>
                    <x-input-error :messages="$errors->get('stripe_status')" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Stripe Country Name</label>
                    <select name="stripe_country" class="form-control select2" id="">
                        <option value="">Select Country</option>
                        @foreach (config('countries') as $key => $country)
                            <option @selected(config('gatewaySettings.stripe_country') === $key) value="{{ $key }}">{{ $country }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('stripe_country')" class="mt-2" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Stripe Currency Name</label>
                    <select name="stripe_currency_name" id="" class="form-control select2">
                        <option value="">Select currency</option>
                        @foreach (config('currencies.currency_list') as $key => $currency)
                            <option @selected(config('gatewaySettings.stripe_currency_name') === $currency) value="{{ $currency }}">{{ $currency }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('stripe_currency_name')" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Stripe Currency Rate</label>
                    <input value="{{ config('gatewaySettings.stripe_currency_rate') }}" type="text"
                        name="stripe_currency_rate"
                        class="form-control {{ hasError($errors, 'stripe_currency_rate') }}">
                    <x-input-error :messages="$errors->get('stripe_currency_rate')" class="mt-2" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Stripe Publishable Key</label>
                    <input value="{{ config('gatewaySettings.stripe_publishable_key') }}" type="text"
                        name="stripe_publishable_key" class="form-control {{ hasError($errors, 'stripe_publishable_key') }}">
                    <x-input-error :messages="$errors->get('stripe_publishable_key')" class="mt-2" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Stripe Secret Key</label>
                    <input value="{{ config('gatewaySettings.stripe_secret_key') }}" type="text"
                        name="stripe_secret_key" class="form-control {{ hasError($errors, 'stripe_secret_key') }}">
                    <x-input-error :messages="$errors->get('stripe_secret_key')" class="mt-2" />
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
