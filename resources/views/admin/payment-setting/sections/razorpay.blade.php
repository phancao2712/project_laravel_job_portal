<div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">
    <form action="{{ route('admin.razorpay-settings.update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Razorpay Status</label>
                    <select name="razorpay_status" id="" class="form-control">
                        <option @selected(config('gatewaySettings.razorpay_status') === 'active') value="active">Active</option>
                        <option @selected(config('gatewaySettings.razorpay_status') === 'inactive') value="inactive">Inactive</option>
                    </select>
                    <x-input-error :messages="$errors->get('razorpay_status')" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Razorpay Country Name</label>
                    <select name="razorpay_country" class="form-control select2" id="">
                        <option value="">Select Country</option>
                        @foreach (config('countries') as $key => $country)
                            <option @selected(config('gatewaySettings.razorpay_country') === $key) value="{{ $key }}">{{ $country }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('razorpay_country')" class="mt-2" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Razorpay Currency Name</label>
                    <select name="razorpay_currency_name" id="" class="form-control select2">
                        <option value="">Select currency</option>
                        @foreach (config('currencies.currency_list') as $key => $currency)
                            <option @selected(config('gatewaySettings.razorpay_currency_name') === $currency) value="{{ $currency }}">{{ $currency }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('razorpay_currency_name')" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Razorpay Currency Rate</label>
                    <input value="{{ config('gatewaySettings.razorpay_currency_rate') }}" type="text"
                        name="razorpay_currency_rate"
                        class="form-control {{ hasError($errors, 'razorpay_currency_rate') }}">
                    <x-input-error :messages="$errors->get('razorpay_currency_rate')" class="mt-2" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Razorpay  Key</label>
                    <input value="{{ config('gatewaySettings.razorpay_key') }}" type="text"
                        name="razorpay_key" class="form-control {{ hasError($errors, 'razorpay_key') }}">
                    <x-input-error :messages="$errors->get('razorpay_key')" class="mt-2" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Razorpay Secret Key</label>
                    <input value="{{ config('gatewaySettings.razorpay_secret_key') }}" type="text"
                        name="razorpay_secret_key" class="form-control {{ hasError($errors, 'razorpay_secret_key') }}">
                    <x-input-error :messages="$errors->get('razorpay_secret_key')" class="mt-2" />
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
