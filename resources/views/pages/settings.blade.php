@extends('layouts.master')
@section('title', 'Brandzshop - My Account')
@section('content')
<div class="ps-content pt-40 pb-40">
	<div class="container">
		{{ Breadcrumbs::render('my-account') }}
		<div class="ps-section__content">
			<div class="row">
				<div class="col-md-3">
					@include('partials.customer_dashboard_sidebar')
				</div>
				<div class="col-md-9">
					<div class="bs_customer_content">
		                <div class="col-md-12 bs_customer_detail">
		                	<div class="media">
							  <img class="img img-circle img-responsive bs_customer_avatar" src="{{asset('images/user/'.Auth::user()->avatar)}}" >
							  <div class="media-body">
							    <h3 class="mt-40 ml-10">{{ucwords(Auth::user()->name)}}</h3>
							  </div>
							</div>
		                </div>
			            <hr>
		            	<div class="row">
		            		<div class="col-md-12">
		            			<h3>Account Info</h3>
	           					<div class="row">
	           						<div class="col-md-6">
	           							<h3 class="mt-10 mb-10" style="font-weight: 400">Change Password</h3>
	           							<form action="{{route('change.pass')}}" method="POST" class="bs_form">
	           								@csrf
		           							 <div class="row">
		           							 	 <div class="col-md-12">
		           							 	 	<div class="form-group">
		           							 	 		 <label for="current_password">Current Password</label>
		           							 	 		 <input type="password" name="current_password" id="current_password" class="form-control" required>
		           							 	 		 @if($errors->has('current_password'))
								                            @foreach($errors->get('current_password') as $message)
								                              <span style="color:red">{{$message}}</span>
								                            @endforeach
								                         @endif
		           							 	 	</div>
		           							 	 </div>
		           							 	 <div class="col-md-12">
		           							 	 	<div class="form-group">
		           							 	 		 <label for="new_password">Current Password</label>
		           							 	 		 <input type="password" name="password" id="new_password" class="form-control" required>
		           							 	 		 @if($errors->has('password'))
								                            @foreach($errors->get('password') as $message)
								                              <span style="color:red">{{$message}}</span>
								                            @endforeach
								                         @endif
		           							 	 	</div>
		           							 	 </div>
		           							 	 <div class="col-md-12">
		           							 	 	<div class="form-group">
		           							 	 		 <label for="password_confirmation">Current Password</label>
		           							 	 		 <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
		           							 	 		 @if($errors->has('password_confirmation'))
								                            @foreach($errors->get('password_confirmation') as $message)
								                              <span style="color:red">{{$message}}</span>
								                            @endforeach
								                         @endif
		           							 	 	</div>
		           							 	 </div>
		           							 	 <div class="col-md-12">
		           							 	 	<div class="form-group text-right">
					           							<button type="submit" class="ps-btn btn btn-primary mt-20 bs_form_btn">Change Password</button>
					           						</div>
		           							 	 </div>
		           							 </div>
	           							</form>
	           						</div>
	           						<div class="col-md-6">
	           							<h3 class="mt-10 mb-10" style="font-weight: 400">Change Email</h3>
	           							@if(session()->has('email_changed'))
	           							<div class="alert alert-success">
	           								{{session()->get('email_changed')}}
	           							</div>
	           							@else
	           							<form action="{{route('change_user_email')}}" method="POST">
	           								@csrf
		           							<div class="row">
		           							 	 <div class="col-md-12">
		           							 	 	<div class="form-group">
		           							 	 		 <label for="email">Email</label>
		           							 	 		 <input type="email" name="email" id="current_password" class="form-control" value="{{Auth::user()->email}}" required>
		           							 	 		 @if($errors->has('email'))
								                            @foreach($errors->get('email') as $message)
								                              <span style="color:red">{{$message}}</span>
								                            @endforeach
								                         @endif
		           							 	 	</div>
		           							 	 </div>
		           							 	 <div class="col-md-12">
		           							 	 	<div class="form-group text-right">
					           							<button type="submit" class="ps-btn btn btn-primary mt-20">Change Email</button>
					           						</div>
		           							 	 </div>
		           							</div>
	           							</form>
	           							@endif
	           						</div>
	           					</div>
		        			</div>
		            	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection