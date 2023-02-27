@extends('layouts.app')
@section('title', 'Dashboard - Products')
@section('content')
<div class="content container-fluid">

	<!-- Page Header -->
	<div class="page-header">
		<div class="row">
			<div class="col">
				<h3 class="page-title">Deleted Products</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
					<li class="breadcrumb-item active">Deleted Products</li>
				</ul>
			</div>
			<div class="col">
				@if($deleted_products->count() > 0)
					@permission('restore.deleted.products')
						<a href="{{route('products.restoreAll')}}" class="btn btn-success bs_dashboard_btn bs_btn_color float-right">Restore All</a>
					@endpermission
					@permission('delete.forever.products')
						<a href="javascript:void(0)" class="btn btn-dark bs_dashboard_btn float-right" onclick="var check = confirm('Are you sure want to delete!');
						if(check){
							document.getElementById('deleteAllForever').submit();
						}">Delete All Forever</a>
						<form action="{{route('products.forceDeleteAll')}}" method="POST" id="deleteAllForever">
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
					<h4 class="card-title">Deleted Products</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="datatable table table-stripped">
							<thead>
								<tr>
									<th>Count</th>
									<th>Name</th>
									<th>Category</th>
									<th>Brand</th>
									<th>Price</th>
									<th>Old Price</th>
									<th>Deleted On</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $count = 1; ?>
								@foreach($deleted_products as $product)
								<tr>
									<td><?=$count++?></td>
									<td>
										<a href="{{url('/'.$product->slug)}}" target="_blank">{{ucwords($product->name)}}</a>
									</td>
									<td>
										@foreach($product->categories as $category)
											{{ucwords($category->title)}}
										@endforeach
									</td>
									<td>
										{{($product->brand) ? ucwords($product->brand->title) : "---" }}
									</td>
									<td>Rs: {{$product->price}}</td>
									<td>
										{{($product->old_price) ? 'Rs: '.$product->old_price : '---' }}
									</td>
									<td>{{$product->deleted_at->format('d-m-Y')}}</td>
									<td>
										<div class="actions">
											@permission('restore.deleted.products')
											<a href="{{route('products.restoreSingle',$product->id)}}" class="btn btn-sm bg-success-light mr-2">
												<i class="fe fe-check-circle"></i> Restore
											</a>
											@endpermission
											@permission('delete.forever.products')
											<a href="javascript:void(0)" class="btn btn-sm bg-danger-light bs_delete" data-route="{{route('products.forceDeleteSingle',$product->id)}}">
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