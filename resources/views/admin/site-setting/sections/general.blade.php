<div class="tab-pane fade show active" id="home4" role="tabpanel" aria-labelledby="home-tab4">
<form action="{{ route('admin.site-settings.update') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Site Name</label>
                <input value="{{ config('settings.site_name') }}" type="text"
                    name="site_name"
                    class="form-control {{ hasError($errors, 'site_name') }}">
                <x-input-error :messages="$errors->get('site_name')" class="mt-2" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Site Email</label>
                <input value="{{ config('settings.site_email') }}" type="text"
                    name="site_email"
                    class="form-control {{ hasError($errors, 'site_email') }}">
                <x-input-error :messages="$errors->get('site_email')" class="mt-2" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Site Phone</label>
                <input value="{{ config('settings.site_phone') }}" type="text"
                    name="site_phone"
                    class="form-control {{ hasError($errors, 'site_phone') }}">
                <x-input-error :messages="$errors->get('site_phone')" class="mt-2" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Site Default Currency</label>
                <select name="site_default_currency" class="form-control select2" id="">
                    <option value="">Select Currency</option>
                    @foreach (config('countries') as $key => $country)
                        <option @selected(config('settings.site_default_currency') === $key) value="{{ $key }}">{{ $country }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('site_default_currency') " class="mt-2" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Currency Icon</label>
                    <input value="{{ config('settings.site_currency_icon') }}" type="text"
                    name="site_currency_icon"
                    class="form-control {{ hasError($errors, 'site_currency_icon') }}">
                <x-input-error :messages="$errors->get('site_currency_icon') " class="mt-2" />
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>
