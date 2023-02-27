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
	           					<h3>Orders</h3>
	           					<div class="table-responsive">
	           						<table class="table table-bordered">
	           							<thead>
	           								<tr>
	           									<th>Product</th>
	           									<th>Size</th>
	           									<th>Quantity</th>
	           									<th>Total Price</th>
	           									<th>Order Date</th>
	           									<th>Payment Status</th>
	           									<th>Due Date</th>
	           									<th>Invoice</th>
	           								</tr>

	           								@php
											   $rowid = 0;
											   $rowspan = 0;
											   $orders = Auth::user()->orders()->latest()->paginate(5);
											@endphp
											@foreach($orders as $key => $order)
											  @php
											     $rowid += 1
											  @endphp
											  <tr>
											     <td>{{$order->product->name}}</td>
											     <td>{{$order->size}}</td>
											     <td>{{$order->quantity}}</td>
											     <td>{{$order->amount}}</td>
											     @if ($key == 0 || $rowspan == $rowid)
											         @php
											             $rowid = 0;
											             $rowspan = $order->invoice->orders->count();
											         @endphp
											  	 	<td rowspan="{{ $rowspan }}">{{$order->invoice->created_at->format('d-m-Y')}}</td>
											         <td rowspan="{{ $rowspan }}">
											         	@if($order->invoice->status == 1)
														 	<span class="badge badge-success bg-success float-left">Paid</span>
														@else
														 	<span class="badge badge-danger float-left">UnPaid</span>
														@endif
											         </td>
											         <td rowspan="{{ $rowspan }}">
											         	@if($order->invoice->due_date)
															{{$order->invoice->due_date->format('d-m-Y')}}</td>
														@else
															--.--.--
														@endif
											         </td>
											         <td rowspan="{{ $rowspan }}">
											         	<a href="{{url('my-account/invoice/'.$order->invoice->invoice_no)}}" class="btn btn-sm bg-dark btn-default">
											         		 {{$order->invoice->invoice_no}}
											         	</a>
											         </td>
											     @endif
											  </tr>
											@endforeach
	           							</thead>
	           						</table>
	           					</div>
	           					{{ $orders->links('partials.pagination') }}
		        			</div>
		            	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection