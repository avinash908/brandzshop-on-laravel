@extends('layouts.app')
@section('title', 'Dashboard - Messages')
@section('content')
<div class="content container-fluid">
	<!-- Page Header -->
	<div class="page-header">
		<div class="row">
			<div class="col">
				<h3 class="page-title">Deleted Messages</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
					<li class="breadcrumb-item active">Deleted Messages</li>
				</ul>
			</div>
			<div class="col">
				@if($deleted_messages->count() > 0)
					@permission('restore.deleted.messages')
						<a href="{{route('messages.restoreAll')}}" class="btn btn-success bs_dashboard_btn bs_btn_color float-right">Restore All</a>
					@endpermission
					@permission('delete.forever.messages')
						<a href="javascript:void(0)" class="btn btn-dark bs_dashboard_btn float-right" onclick="var check = confirm('Are you sure want to delete!');
						if(check){
							document.getElementById('deleteAllForever').submit();
						}">Delete All Forever</a>
						<form action="{{route('messages.forceDeleteAll')}}" method="POST" id="deleteAllForever">
							@csrf
						</form>
					@endpermission
				@endif
			</div>
		</div>
	</div>
	<!-- /Page Header -->
	<div class="row">
		<div class="col-lg-12 col-md-8">
			<div class="card">
				<div class="card-body">
					<div class="email-content">
						<div class="table-responsive">
							<table class="datatable table table-inbox table-hover">
								<thead>
									<tr>
										<th>Count</th>
										<th>Name</th>
										<th>Message</th>
										<th>Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $count = 1; ?>	
									@foreach($deleted_messages as $message)
									<tr class="{{($message->status == 0 ? 'unread' : '')}} clickable-row" data-href="javascript:void(0)">
										<td><?=$count++?></td>
										<td class="name">{{$message->name}}</td>
										<td class="subject">{{Str::limit($message->message, 80)}}</td>
										<td class="mail-date">{{$message->created_at->format('d-m-Y, H:m')}}</td>
										<td>
											@permission('restore.deleted.messages')
												<a href="{{route('messages.restoreSingle',$message->id)}}" class="btn btn-sm bg-success-light mr-2">
													<i class="fe fe-check-circle"></i> Restore
												</a>
											@endpermission
											@permission('delete.forever.messages')
												<a href="javascript:void(0)" class="btn btn-sm bg-danger-light bs_delete" data-route="{{route('messages.forceDeleteSingle',$message->id)}}">
													<i class="fe fe-trash"></i> Delete
												</a>
											@endpermission
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
</div>
@include('partials.attr_modal')
@endsection