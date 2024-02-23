@extends('frontend.layouts.master')
@section('contents')
<section class="pt-120 login-register">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-md-6 col-sm-12 mx-auto">
          <div class="login-register-cover">
            <div class="text-center">
              <h2 class="mb-5 text-brand-1">Reset password</h2>
              <p class="font-sm text-muted mb-30">Lorem ipsum dolor sit amet consectetur.</p>
            </div>
            <form class="login-register text-start mt-20" action="{{ route('password.store') }}" method="POST">
                @csrf

                 <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
              <div class="row">
                <div class="col-xl-12">
                <!-- Email Address -->
                  <div class="form-group">
                    <label class="form-label" for="input-3">Email *</label>
                    <input class="form-control" id="input-3"
                    type="text" required=""
                    name="email"
                    value="{{ old('email', $request->email) }}"
                    placeholder="stevenjob"
                    readonly
                    >
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                  </div>
                </div>

                <!-- Password -->
                <div class="col-xl-12">
                  <div class="form-group">
                    <label class="form-label" for="input-4">Password *</label>
                    <input class="form-control" id="input-4"
                    type="password" required="" name="password"
                      placeholder="************">
                      <x-input-error :messages="$errors->get('password')" class="mt-2" />
                  </div>
                </div>

                <!-- Confirm Password -->
                <div class="col-xl-12">
                    <div class="form-group">
                      <label class="form-label" for="input-4">Confirm Password *</label>
                      <input class="form-control" id="input-4"
                      type="password" required=""
                      name="password_confirmation"
                        placeholder="************">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                  </div>
              </div>
              <div class="form-group">
                <button class="btn btn-default hover-up w-100" type="submit" name="login">Reset Password</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
