@extends('layouts.app')

@section('title', 'Dashboard - Subsubcategories')
@section('content')
<div class="content container-fluid">

	<!-- Page Header -->
	<div class="page-header">
		<div class="row">
			<div class="col">
				<h3 class="page-title">Deleted Subcategories</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
					<li class="breadcrumb-item active">Deleted Subcategories</li>
				</ul>
			</div>
			<div class="col">
				@if($deleted_subcategories->count() > 0)
					@permission('restore.deleted.subcategories')
						<a href="{{route('subcategories.restoreAll')}}" class="btn btn-success bs_dashboard_btn bs_btn_color float-right">Restore All</a>
					@endpermission
					@permission('delete.forever.subcategories')

						<a href="javascript:void(0)" class="btn btn-dark bs_dashboard_btn float-right" onclick="var check = confirm('Are you sure want to delete!');
						if(check){
							document.getElementById('deleteAllForever').submit();
						}">Delete All Forever</a>
						<form action="{{route('subcategories.forceDeleteAll')}}" method="POST" id="deleteAllForever">
							@csrf
						</form>
					@endpermission
				@endif
			</div>
		</div>
	</div>
	<!-- /Page Header -->
	
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Deleted subcategories</h4>
				</div>
				<div class="card-body">

					<div class="table-responsive">
						<table class="datatable table table-stripped">
							<thead>
								<tr>
									<th>Count</th>
									<th>Parent Category</th>
									<th>SubCategory</th>
									<th>Products</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $count = 1; ?>
								@foreach($deleted_subcategories as $sb_category)
								<tr>
									<td><?=$count++?></td>
									<td>{{ucwords($sb_category->category->title)}}</td>
									<td>{{ucwords($sb_category->title)}}</td>
									<td>{{$sb_category->products->count()}}</td>
									<td>
										<div class="actions">
											@permission('restore.deleted.subcategories')
											<a href="{{route('subcategories.restoreSingle',$sb_category->id)}}" class="btn btn-sm bg-success-light mr-2">
												<i class="fe fe-check-circle"></i> Restore
											</a>
											@endpermission
											@permission('delete.forever.subcategories')
											<a href="javascript:void(0)" class="btn btn-sm bg-danger-light bs_delete" data-route="{{route('subcategories.forceDeleteSingle',$sb_category->id)}}">
												<i class="fe fe-trash"></i> Delete
											</a>
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
@include('partials.attr_modal')
@endsection