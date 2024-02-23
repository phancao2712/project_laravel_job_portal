@extends('frontend.layouts.master')

@section('contents')
<section class="section-box mt-75">
    <div class="breacrumb-cover">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-12">
            <h2 class="mb-20">Login</h2>
            <ul class="breadcrumbs">
              <li><a class="home-icon" href="{{ route('home') }}">Home</a></li>
              <li>Login</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="pt-120 login-register">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-md-6 col-sm-12 mx-auto">
          <div class="login-register-cover">
            <div class="text-center">
              <h2 class="mb-5 text-brand-1">Login</h2>
              <p class="font-sm text-muted mb-30">Lorem ipsum dolor sit amet consectetur.</p>
            </div>

             <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form class="login-register text-start mt-20" action="{{ route('login') }}" method="POST">
                @csrf

              <div class="row">
                <div class="col-xl-12">
                    <!-- Email Address -->
                  <div class="form-group">
                    <label class="form-label" for="input-3">Email *</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                    id="input-3"
                    type="email"
                    required=""
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="abc@gmail.com"
                    >
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                  </div>
                </div>

                <!-- Password -->
                <div class="col-xl-12">
                  <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="input-4">Password *</label>
                        <a href="{{ route('password.request') }}">Forgot password</a>
                    </div>
                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="input-4" type="password" required="" name="password"
                      placeholder="************">
                  </div>
                  <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                {{-- Remmeber me --}}
                <div class="col-xl-12">
                    <div class="form-check form-group form-check-inline">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                </div>

              </div>
              <div class="form-group">
                <button class="btn btn-default hover-up w-100" type="submit" name="login">Login</button>
              </div>
              <div class="text-muted text-center">Don't have an account?
                <a href="{{ route('register') }}">Registration</a>
              </div>
            </form>
            {{-- <div class="text-center mt-20">
              <div class="divider-text-center"><span>Or continue with</span></div>
              <button class="btn social-login hover-up mt-20"><img src="assets/imgs/template/icons/icon-google.svg"
                  alt="joblist"><strong>Sign up with Google</strong></button>
            </div> --}}
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="mt-120"></div>
@endsection
