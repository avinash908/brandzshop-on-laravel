@extends('layouts.master')
@section('canonical', url("/","sitemap"))
@section('meta-description', 'How to buy original branded products at brandzshop links will help you')
@section('meta-keywords', 'brandzshop original products links')
@section('title', 'Brandzshop - Sitemap')
@section('content')
<style type="text/css">
	ul.sitemap {
	list-style-type: none; 
	margin-left: 0.5cm;
	padding-left: 0;
	list-style-type: disc;
	}
	ul.sitemap li { 
	padding-left: 1.1em;
	}
	ul{
		list-style-type: circle;
	}
	a{
		text-decoration: underline;
	}
</style>
<div class="ps-section--features-product ps-section masonry-root pt-100 pb-100" >
 <div class="ps-container">
    {{ Breadcrumbs::render('sitemap') }}
    <div class="ps-section__header mb-50">
        <h3 class="ps-section__title" data-mask="Sitemap">- Brandzshop Sitemap</h3>
    </div>
    <div class="ps-section__content pb-50">
    	<ul class="sitemap">
    		<li><a href="{{url('/')}}" title="Buy online shoes">Home</a></li>
    		<li><a href="{{url('/shoes')}}" title="Buy online products">Shop</a></li>
    		@foreach(App\Brand::all() as $brand)
    			<li><a href="{{url('brand/'.$brand->slug)}}" title="{{ucwords($brand->brand)}} Shoes latest new">{{ucwords($brand->brand)}} ({{$brand->products->count()}})</a>
    				<ul>
    					@foreach($brand->products as $product)
    						<li><a href="{{url('brand/'.$product->slug)}}" title="{{ucwords($product->name)}} Buy online original available in pakistan">{{ucwords($product->name)}}</a></li>
    					@endforeach
    				</ul>
    			</li>
    		@endforeach
    		<li><a href="{{url('/help')}}" title="how to buy original brands latest shoes">Help</a></li>
    		<li><a href="{{url('/contact')}}" title="contact us to buy original shoes in pakistan">Contact</a></li>
    		<li><a href="{{url('/cart')}}" title="add to cart your original brand">Cart</a></li>
    		<li><a href="{{url('/checkout')}}" title="checkout with original brand">Checkout</a></li>
    	</ul>
   	</div>
 </div>
</div>
@endsection