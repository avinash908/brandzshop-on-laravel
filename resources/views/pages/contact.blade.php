@extends('layouts.master')
@section('canonical', url("/","contact"))
@section('meta-description', 'Contact to brandzshop for buy original branded products like shoes and tshirts')
@section('meta-keywords', 'Contact with brandzshop' )
@section('title', 'Brandzshop - Contact us to buy original brands products')
@section('content')
<div class="ps-section--features-product ps-section masonry-root pt-100 pb-100">
 <div class="ps-container">
 	 {{ Breadcrumbs::render('contact') }}
        <div class="ps-section__header mb-50">
            <h3 class="ps-section__title" data-mask="Contact">- Contact Us</h3>
        </div>
       <div class="row">
	        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
	            <form class="ps-contact__form bs_form" action="{{route('contact.store')}}" method="post">
	            	@csrf()
	              <div class="row">   
	                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
	                      <div class="form-group">
	                        <label>Name <sub>*</sub></label>
	                        <input class="form-control @error('name') is-invalid @enderror"  value="{{ old('name') }}" name="name" type="text" placeholder="Your full name" required>
	                          @if($errors->has('name'))
	                            @foreach($errors->get('name') as $message)
	                              <span style="color:red">{{$message}}</span>
	                            @endforeach
	                          @endif
	                      </div>
	                    </div>
	                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
	                      <div class="form-group">
	                        <label>Email <sub>*</sub></label>
	                        <input class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}" name="email" type="email" placeholder="Your email address" required>
	                        @if($errors->has('email'))
	                            @foreach($errors->get('email') as $message)
	                              <span style="color:red">{{$message}}</span>
	                            @endforeach
	                          @endif
	                      </div>
	                    </div>
	                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
	                      <div class="form-group mb-25">
	                        <label>Your Message <sub>*</sub></label>
	                        <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="6" required>{{ old('message') }}</textarea>
	                        @if($errors->has('message'))
	                            @foreach($errors->get('message') as $message)
	                              <span style="color:red">{{$message}}</span>
	                            @endforeach
	                         @endif
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
	                        <button type="submit" class="ps-btn bs_form_btn">Send Message<i class="fa fa-long-arrow-right"></i></button>
	                      </div>
	                    </div>
	              </div>
	            </form>
	        </div>
	        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
	          <div class="ps-section__content">
	            <div class="row">
	                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
	                    <div class="ps-contact__block" data-mh="contact-block" style="height: 237px;">
	                      <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	                        <h3>Pakistan <span> (SINDH) </span></h3>
	                      </header>
	                      <footer>
	                        <p><i class="fa fa-map-marker"></i>Main Naseem Nagar Qasimabad, Hyderabad</p>
	                        <p><i class="fa fa-envelope-o"></i><a href="mailto:brandzshopweb@gmail.com">brandzshopweb@gmail.com</a></p>
	                        <p><i class="fa fa-phone"></i> +923184251545 </p>
	                      </footer>
	                    </div>
	                  </div>
	                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
	                    <div class="ps-contact__block" data-mh="contact-block" style="height: 237px;">
	                      <header>
	                        <h3>Social <span> (Media) </span></h3>
	                      </header>
	                      <footer>
	                        <p><a href="https://web.facebook.com/Brandz-Shop-103395707790337/" target="_blank"><i class="fa fa-facebook"></i> facebook </a></p>
	                        <p><a href="https://www.instagram.com/brandzshop.pk/"><i class="fa fa-instagram"></i> Instagram </a></p>
		                    <p>
		                      <a href="https://wa.me/923184251545"  target="_blank"><i class="fa fa-whatsapp"></i>+923184251545</a>
		                     </p>
	                      </footer>
	                    </div>
	                  </div>
	            </div>
	          </div>
	        </div>
	  </div>
 </div>
</div>
@endsection