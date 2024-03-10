{{--
    -paypal status
    -paypal mode
    -paypal country
    -paypal currency rate
    -paypal currency name
    -paypal client id
    -paypal serect key
    -paypal app id
    -paypal logo
--}}

<div class="tab-pane fade show active" id="home4" role="tabpanel" aria-labelledby="home-tab4">
    <form action="{{ route('admin.paypal-settings.update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Paypal Status</label>
                    <select name="paypal_status" id="" class="form-control">
                        <option @selected(config('gatewaySettings.paypal_status') === 'active') value="active">Active</option>
                        <option @selected(config('gatewaySettings.paypal_status') === 'inactive') value="inactive">Inactive</option>
                    </select>
                    <x-input-error :messages="$errors->get('paypal_status')" class="mt-2" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Paypal Account Mode</label>
                    <select name="paypal_account_mode" id="" class="form-control">
                        <option @selected(config('gatewaySettings.paypal_account_mode') === 'sandbox') value="sandbox">Sandbox</option>
                        <option @selected(config('gatewaySettings.paypal_account_mode') === 'live') value="live">Live</option>
                    </select>
                    <x-input-error :messages="$errors->get('paypal_account_mode')" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Paypal Country Name</label>
                    <select name="paypal_country" class="form-control select2" id="">
                        <option value="">Select Country</option>
                        @foreach (config('countries') as $key => $country)
                            <option @selected(config('gatewaySettings.paypal_country') === $key) value="{{ $key }}">{{ $country }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('paypal_country')" class="mt-2" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Paypal Currency Name</label>
                    <select name="paypal_currency_name" id="" class="form-control select2">
                        <option value="">Select currency</option>
                        @foreach (config('currencies.currency_list') as $key => $currency)
                            <option @selected(config('gatewaySettings.paypal_currency_name') === $currency) value="{{ $currency }}">{{ $currency }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('paypal_currency_name')" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Paypal Currency Rate</label>
                    <input value="{{ config('gatewaySettings.paypal_currency_rate') }}" type="text"
                        name="paypal_currency_rate"
                        class="form-control {{ hasError($errors, 'paypal_currency_rate') }}">
                    <x-input-error :messages="$errors->get('paypal_currency_rate')" class="mt-2" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Paypal Client Id</label>
                    <input value="{{ config('gatewaySettings.paypal_client_id') }}" type="text"
                        name="paypal_client_id" class="form-control {{ hasError($errors, 'paypal_client_id') }}">
                    <x-input-error :messages="$errors->get('paypal_client_id')" class="mt-2" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Paypal Secret Key</label>
                    <input value="{{ config('gatewaySettings.paypal_secret_key') }}" type="text"
                        name="paypal_secret_key" class="form-control {{ hasError($errors, 'paypal_secret_key') }}">
                    <x-input-error :messages="$errors->get('paypal_secret_key')" class="mt-2" />
                </div>
            </div>
            <div class="col-md-12 ">
                <div class="form-group">
                    <label>Paypal App Id</label>
                    <input value="{{ config('gatewaySettings.paypal_app_id') }}" type="text" name="paypal_app_id"
                        class="form-control {{ hasError($errors, 'paypal_app_id') }}">
                    <x-input-error :messages="$errors->get('paypal_app_id')" class="mt-2" />
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
