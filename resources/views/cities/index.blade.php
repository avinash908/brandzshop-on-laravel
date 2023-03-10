@extends('layouts.app')
@section('title', 'Dashboard - Cities')
@section('content')
<div class="content container-fluid">

	<!-- Page Header -->
	<div class="page-header">
		<div class="row">
			<div class="col">
				<h3 class="page-title">Cities</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
					<li class="breadcrumb-item active">Cities</li>
				</ul>
			</div>
			@permission('view.deleted.cities')
			<div class="col">
				<a href="{{route('cities.deleted')}}" class="btn btn-dark bs_dashboard_btn float-right">Deleted Cities</a>
			</div>
			@endpermission
		</div>
	</div>
	<!-- /Page Header -->
	
	<div class="row">
		@permission('create.cities')
		<div class="col-sm-6">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">City Details</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<form action="{{route('cities.store')}}" method="post">
								@csrf
								<div class="form-group">
									<label>City Name </label>
									<div class="input-group">
										<input type="text" name="city_name" value="{{old('city')}}" class="form-control @error('city') is-invalid @enderror" required>
										@if($errors->has('city'))
											@foreach($errors->get('city') as $message)
											<span style="color:red">{{$message}}</span>
											@endforeach
										@endif
									</div>
								</div>
								<div class="form-group">
									<label>State</label>
									<select class="form-control" name="state" required>
										@foreach(App\State::all() as $state)
										<option value="{{$state->id}}">{{ucwords($state->state_name)}}</option>
										@endforeach
									</select>
								</div>
								<div>
									<button class="btn btn-success bs_dashboard_btn bs_btn_color float-right" style="border-radius: 0px;">Add</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endpermission
		@permission('view.cities')
		<div class="col-sm-6">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Cities</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table datatable">
									<thead>
										<tr>
											<th>Count</th>
											<th>State</th>
											<th>City</th>
											<th>Users</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>	
										<?php $count = 1; ?>
										@foreach($cities as $city)
											<tr>
												<td><?=$count++?></td>
												<td>{{ucwords($city->state->state_name)}}</td>
												<td>{{ucwords($city->city_name)}}</td>
												<td>{{$city->users->count()}}</td>
												<td>
													<div class="btn-group btn-group-sm">
														@permission('edit.cities')
														<a href="javascript:void(0)" class="btn btn-sm bg-success-light mr-2 bs_edit" data-id="{{$city->id}}" data-route="{{route('cities.edit',$city->id)}}"><i class="fa fa-edit"></i></a>
														@endpermission
														@permission('delete.cities')
														<a href="javascript:void(0)" class="btn btn-sm bg-danger-light bs_delete" data-route="{{route('cities.destroy',$city->id)}}"><i class="fa fa-trash"></i></a>
														@endpermission
													</div>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endpermission
	</div>

</div>
@include('partials.attr_modal')
@endsection