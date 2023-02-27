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
	           					<div class="ps-cart-listing ps-table--whishlist">
							        <table class="table ps-cart__table">
							          <thead>
							            <tr>
							              <th>All Products</th>
							              <th>Price</th>
							              <th>View</th>
							              <th></th>
							            </tr>
							          </thead>
							          <tbody>
							          	@foreach($products as $product)
							            <tr>
							              <td><a class="ps-product__preview" href="{{url('/').$product->slug}}"><img class="mr-15" src="{{url('/',$product->image->url)}}" width="100" alt="">{{$product->name}}</a></td>
							              <td>Rs: {{$product->price}}</td>
							              <td><a class="ps-product-link" href="{{url('/').$product->slug}}">View Product</a></td>
							              <td>
							                <a href="{{url('remove_from_wishlist',$product->slug)}}"><div class="ps-remove"></div></a>
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
	</div>
</div>
@endsection