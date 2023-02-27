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
		           				<form  action="{{route('update.account',Auth::user()->slug)}}" method="POST" class="bs_form">
		           					@csrf
		           					<input type="hidden" name="_method" value="put">
		           					<div class="row">
		           						<div class="col-md-6">
				           					<div class="form-group">
				           						<label for="displayname">Display Name</label>
				           						<input type="text" id="displayname" name="name" class="form-control" value="{{ucwords(Auth::user()->name)}}" required>
				           						 @if($errors->has('name'))
						                            @foreach($errors->get('name') as $message)
						                              <span style="color:red">{{$message}}</span>
						                            @endforeach
						                         @endif
				           					</div>
		           						</div>
		           						<div class="col-md-6">
				           					<div class="form-group">
				           						<label>Email</label>
				           						<span class="form-control bs_disabled_email">{{Auth::user()->email}} <a href="{{url('my-account/settings')}}">Change</a></span>
				           					</div>
		           						</div>
		           						<div class="col-md-6">
				           					<div class="form-group">
				           						<label for="firstname">First Name</label>
				           						<input type="text" id="firstname" name="first_name" class="form-control" value="{{ucwords(Auth::user()->info->first_name)}}" required>
				           						@if($errors->has('first_name'))
						                            @foreach($errors->get('first_name') as $message)
						                              <span style="color:red">{{$message}}</span>
						                            @endforeach
						                         @endif
				           					</div>
		           						</div>	
		           						<div class="col-md-6">
				           					<div class="form-group">
				           						<label for="lastname">Last Name</label>
				           						<input type="text" id="lastname" name="last_name" class="form-control" value="{{ucwords(Auth::user()->info->last_name)}}" required>
				           						@if($errors->has('last_name'))
						                            @foreach($errors->get('last_name') as $message)
						                              <span style="color:red">{{$message}}</span>
						                            @endforeach
						                         @endif
				           					</div>
		           						</div>
		           						<div class="col-md-6">
				           					<div class="form-group">
				           						<label for="phone">Phone</label>
				           						<input type="tele" name="phone" id="phone" class="form-control" value="{{Auth::user()->info->phone}}" required>
				           						@if($errors->has('phone'))
						                            @foreach($errors->get('phone') as $message)
						                              <span style="color:red">{{$message}}</span>
						                            @endforeach
						                         @endif
				           					</div>
		           						</div>
		           						<div class="col-md-3">
				           					<div class="form-group">
				           						<label for="state">State</label>
				           						<select name="state_id" id="state" class="form-control bs_states" required>
				           							<option value="">Select State</option>
				           							@foreach(App\State::all() as $state)
					           							@if($state->id == Auth::user()->info->state_id)
					           								<option value="{{$state->id}}" selected>{{ucwords($state->state_name)}}</option>
					           							@else
					           								<option value="{{$state->id}}">{{ucwords($state->state_name)}}</option>
					           							@endif
				           							@endforeach
				           						</select>
				           						@if($errors->has('state_id'))
						                            @foreach($errors->get('state_id') as $message)
						                              <span style="color:red">{{$message}}</span>
						                            @endforeach
						                         @endif
				           					</div>
		           						</div>
		           						<div class="col-md-3">
				           					<div class="form-group">
				           						<label for="city">City</label>
				           						<select name="city_id" id="city" class="form-control bs_cities" required>
				           							<option value="">Select City</option>
				           							@foreach(App\City::all() as $city)
					           							@if($city->id == Auth::user()->info->city_id)
					           								<option value="{{$city->id}}" selected>{{ucwords($city->city_name)}}</option>
					           							@else
					           								<option value="{{$city->id}}">{{ucwords($city->city_name)}}</option>
					           							@endif
				           							@endforeach
				           						</select>
				           						@if($errors->has('city_id'))
						                            @foreach($errors->get('city_id') as $message)
						                              <span style="color:red">{{$message}}</span>
						                            @endforeach
						                         @endif
				           					</div>
		           						</div>
		           						<div class="col-md-12">
		           							<label for="address">Address</label>
		           							<textarea name="address" id="address" class="form-control" 
		           							required>{{Auth::user()->info->address}}</textarea>
		           							@if($errors->has('address'))
					                            @foreach($errors->get('address') as $message)
					                              <span style="color:red">{{$message}}</span>
					                            @endforeach
					                         @endif
		           						</div>
		           						<div class="col-md-12">
		           							<div class="form-group text-right">
		           							<button type="submit" class="ps-btn btn btn-primary mt-20 bs_form_btn">Update</button>
		           							</div>
		           						</div>
		           					</div>
		           				</form>
		        			</div>
		            	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection