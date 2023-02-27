@extends('layouts.master')
@section('title', 'Brandzshop - Login')
@section('content')
<div class="ps-blog-grid pt-80 pb-80 with-no-sidebar">
    <div class="ps-container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-lg-offset-3 col-sm-12 col-xs-12">
                <div class="ps-post--detail">
                    <div class="ps-post__content">
                    <h1 class="ps-section__title" data-mask="Login">-{{ __('Login') }}</h1>
                    <!-- Form -->
                    <form method="POST" action="{{ route('login') }}" class="bs_form">
                        @csrf
                        <div class="form-group">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class=" form-group form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="ps-btn btn btn-primary bs_form_btn" type="submit">{{ __('Login') }}</button>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>  
                    <div class="text-center mt-10 mb-10">
                        <a href="{{ url('/gmail/redirect') }}">
                            <img src="{{url('images/icon/login_with_google.png')}}" width="100%">
                        </a>
                    </div>
                    <div class="text-center mt-10 mb-10">
                        <a href="{{ url('/fb/redirect') }}">
                            <img src="{{url('images/icon/login_with_facebook.png')}}" width="100%">
                        </a>
                    </div>
                    <div class="text-center dont-have">Don’t have an account? <a href="{{url('register')}}">Register</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection