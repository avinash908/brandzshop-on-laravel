@extends('layouts.master')
@section('title', 'Brandzshop - Register')
@section('content')
<div class="ps-blog-grid pt-80 pb-80 with-no-sidebar">
    <div class="ps-container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-lg-offset-3 col-sm-12 col-xs-12">
                <div class="ps-post--detail">
                    <div class="ps-post__content">
                    <h1 class="ps-section__title" data-mask="Register">-{{ __('Register') }}</h1>
                    <!-- Form -->
                    <form method="POST" action="{{ route('register') }}" class="bs_form">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">{{__('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{__('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                             <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                        </div>
                        <div class="form-group">
                        <label>Complete Captcha</label>
                         <?php
                         $attributes = [
                            'data-theme' => 'dark',
                            'data-type' => 'audio',
                        ];
                        ?>
                         {!! Captcha::display($attributes) !!}
                         @if($errors->has('g-recaptcha-response'))
                            @foreach($errors->get('g-recaptcha-response') as $message)
                              <span style="color:red">{{$message}}</span>
                            @endforeach
                         @endif
                      </div>
                        <div class="form-group">
                            <button type="submit" class="ps-btn btn-primary bs_form_btn" type="submit">{{ __('Register') }}</button>
                        </div>
                    </form> 
                    <div class="text-center dont-have">Already have an account?<a href="{{url('login')}}">Login</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
