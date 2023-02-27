@extends('layouts.master')
@section('title', 'Brandzshop - Reset Password')
@section('content')
<div class="ps-blog-grid pt-80 pb-80 with-no-sidebar">
    <div class="ps-container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-lg-offset-3 col-sm-12 col-xs-12">
                <div class="ps-post--detail">
                    <div class="ps-post__content">
                    <h1 class="ps-section__title" data-mask="Reset">-{{ __('Reset Password') }}</h1>
                    <!-- Form -->
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif  
                        <p class="account-subtitle">Enter your email to get a password reset link</p>
                        
                        <!-- Form -->
                       <form method="POST" action="{{ route('password.email') }}" class="bs_form">
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
                            <div class="form-group mb-0">
                                <button type="submit" class="ps-btn btn-primary bs_form_btn">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </form>
                        <!-- /Form -->
                        <br>
                        <div class="text-center dont-have">Remember your password? <a href="{{url('login')}}">Login</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection