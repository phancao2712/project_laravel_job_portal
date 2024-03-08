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

<form action="{{ route('admin.plans.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Paypal Status</label>
                <select name="paypal_status" id="" class="form-control">
                    <option value="active">Active</option>
                    <option value="in_active">Inactive</option>
                </select>
                <x-input-error :messages="$errors->get('paypal_status')" class="mt-2" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Paypal Account Mode</label>
                <select name="paypal_account_mode" id="" class="form-control">
                    <option value="sandbox">Sandbox</option>
                    <option value="live">Live</option>
                </select>
                <x-input-error :messages="$errors->get('paypal_account_mode')" class="mt-2" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Paypal Country</label>
                <select name="paypal_country" class="form-control" id="">
                    <option value="sandbox">Sandbox</option>
                    <option value="live">Live</option>
                </select>
                <x-input-error :messages="$errors->get('paypal_country')" class="mt-2" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Paypal Currency Name</label>
                <select name="paypal_country" id="" class="form-control">
                    <option value="sandbox">Sandbox</option>
                    <option value="live">Live</option>
                </select>
                <x-input-error :messages="$errors->get('paypal_country')" class="mt-2" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Paypal Currency Rate</label>
                <input value="{{ old('paypal_currency_rate') }}" type="text"
                    name="paypal_currency_rate"
                    class="form-control {{ hasError($errors, 'paypal_currency_rate') }}">
                <x-input-error :messages="$errors->get('paypal_currency_rate')" class="mt-2" />
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Paypal Client Id</label>
                <input value="{{ old('paypal_client-id') }}" type="text"
                    name="paypal_client-id"
                    class="form-control {{ hasError($errors, 'paypal_client-id') }}">
                <x-input-error :messages="$errors->get('paypal_client-id')" class="mt-2" />
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Paypal Serect Key</label>
                <input value="{{ old('paypal_serect_key') }}" type="text"
                    name="paypal_serect_key"
                    class="form-control {{ hasError($errors, 'paypal_serect_key') }}">
                <x-input-error :messages="$errors->get('paypal_serect_key')" class="mt-2" />
            </div>
        </div>
        <div class="col-md-12 ">
            <div class="form-group">
                <label>Paypal App Id</label>
                <input value="{{ old('paypal_app_id') }}" type="text"
                    name="paypal_app_id"
                    class="form-control {{ hasError($errors, 'paypal_app_id') }}">
                <x-input-error :messages="$errors->get('paypal_app_id')" class="mt-2" />
            </div>
        </div>
    </div>
    {{-- <div class="col-md-6">
        <div class="form-group">
            <label>Paypal Logo</label>
            <input value="{{ old('paypal_app_id') }}" type="text"
                name="paypal_app_id"
                class="form-control {{ hasError($errors, 'paypal_app_id') }}">
            <x-input-error :messages="$errors->get('paypal_app_id')" class="mt-2" />
        </div>
    </div> --}}
    <button type="submit" class="btn btn-primary">Create</button>
</form>
