@extends('layouts.master')
@section('title', 'Brandzshop - Verify')
@section('content')
<div class="ps-blog-grid pt-80 pb-80 with-no-sidebar">
    <div class="ps-container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-lg-offset-3 col-sm-12 col-xs-12">
                <div class="ps-post--detail">
                    <div class="ps-post__content">
                    <h1 class="ps-section__title" data-mask="Verify Your Email Address">-{{ __('Verify Your Email Address') }}</h1>
                    <!-- Form -->
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline bs_form" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="ps-btn btn btn-link p-0 m-0 align-baseline bs_form_btn">{{ __('click here to request another') }}</button>.
                    </form>  
                    <div class="text-center dont-have"><a href="{{url('login')}}">Login</a> or <a href="{{url('register')}}">Register</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection