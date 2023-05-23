@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="self-bg">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="bg-images-color">
                                <img class="rounded mx-auto d-block" src="/images/login-family.svg" alt="">
                                <img class="rounded mx-auto d-block" src="/images/flower-pot-icon.svg" alt="">

                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="otp-section">
                                <h4 style="font-size: 21px;font-weight: bold;color: #000000;">Register or Sign In</h4>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" placeholder="Enter Your Email Id*" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Your Password*"
                                                required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                    {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn1 btn-success">
                                                {{ __('Login') }}
                                            </button>

                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                            @if (Route::has('register'))
                                                <a class="btn btn-link" href="{{ route('register') }}">
                                                    {{ __('Register Now') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>

                                <p style="font-size: 12px;padding: 3px 0px;padding: 6px 0px;">By Sign In/Registration, I
                                    agree to the<a href="#"> Terms of Service</a> and<a href="#"> Privacy
                                        Policy</a></p>

                                <!-- <h4 class="digilocker">Login with <b> Digilicker</b> MeriPehchaan</h4> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
