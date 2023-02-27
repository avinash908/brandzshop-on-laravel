@extends('layouts.master')
@section('canonical', url("/shop/".$major_category->slug))
<?php
$meta_keywords = '';
$meta_brandx = 'Brandzshop has variety of international branded shoes such as : ';
foreach(App\Brand::all() as $meta_brand ){
  $meta_brandx   .= $meta_brand->title.' ';
  $meta_keywords .= $meta_brand->title;
}
$meta_brandx .= 'now available in Paskistan at very low prices.';
?>
@section('meta-description',  $meta_brandx)
@section('meta-keywords', $meta_keywords)
@section('title', 'Brandzshop - Shop original brands shoes in pakistan')
@section('content')
<div class="ps-products-wrap pt-40 pb-80 latest-products">

{{ Breadcrumbs::render('shop',$major_category) }}
  <div class="ps-products" id="products">
   <!-- top pagination -->
   <div class="bs_top_search_bar">
    <input type="text" id="keyword" value="<?=(isset(request()->keyword)) ? request()->keyword : '' ?>" class="top_search_input" placeholder="Search.." required>
    <button class="bs_form_btn top_search_input bs_top_search_btn"><i class="fa fa-search"></i></button>
  </div>
    <div class="ps-product__columns">
      @foreach($products as $product)
      <div class="ps-product__column">
        <div class="ps-shoe mb-30">
          <div class="ps-shoe__thumbnail">
              <div class="ps-shoe__actions">
                  @guest
                  <a class="ps-shoe__favorite bs_login_btn" href="javascript:void(0)"><i class="ps-icon-heart"></i></a>
                  @else
                  <a class="ps-shoe__favorite add_to_wishlist" data-product_id="{{$product->slug}}" href="javascript:void(0)"><i class="ps-icon-heart"></i></a>
                  @endguest
                  <a rel="nofollow" href="javascript:void(0)"  class="ps-shoe__favorite add_to_compare" data-product_id="{{$product->slug}}"><i class="ps-icon-share"></i></a>
                  <a rel="nofollow" href="javascript:void(0)" data-product_quantity="1" data-product_id="{{$product->slug}}" data-product_size="" class="ps-shoe__favorite add_to_cart"><i class="ps-icon-shopping-cart"></i></a>
              </div>
            @if($product->is_new)
              <div class="ps-badge"><span>New</span></div>
            @endif
            @if($product->percent_off)
              <div class="ps-badge ps-badge--sale ps-badge--2nd">
                <span>-{{$product->percent_off}}%</span>
              </div>
            @endif
            <img alt="{{$product->name}} original product only for pakistanis" src="{{url('/',$product->image->url)}}" />
            <a class="ps-shoe__overlay" href="{{url('/'.$product->slug)}}" title="{{ucwords($product->name)}} original buy online"></a>
          </div>
          <div class="ps-shoe__content">
            <div class="ps-shoe__detail">
              <a class="ps-shoe__name" href="{{url('/').$product->slug}}" title="{{ucwords($product->name)}}">{{ucwords(Str::limit($product->name,26))}}</a>
                <p>
                    @for($i=1; $i<=$product->averageRating; $i++)
                        <i class="fa fa-star bg-yellow ps-rating-stars rated-stars"></i>
                    @endfor
                    @for($i=$product->averageRating; $i < 5; $i++)
                         <i class="fa fa-star bg-yellow br-current ps-rating-stars"></i>
                    @endfor
                </p>
                <p class="ps-shoe__categories">
                  @if($product->brand)
                      <a href="{{url('/shop/'. $product->brand->category->slug .'?brand=' . $product->brand->slug)}}" title="{{ucwords($product->brand->title )}}">
                        {{ ucwords($product->brand->title )}}
                       </a>
                  @endif
                </p>
                <span class="ps-shoe__price"> 
                    @if($product->old_price)
                    <small><del>Rs:{{number_format($product->old_price)}}</del></small>
                    <br>
                    @endif
                    Rs: {{number_format($product->price)}}
                </span>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      @if(!count($products) > 0)
          <h1 align="center" style="margin-top: 5%;font-family: Montserrat, sans-serif;font-weight: 400;">No Products Available</h1>
      @endif
    </div>
      {{ $products->links('partials.pagination') }}
  </div>
  @include('partials.filter_sidebar')
</div>
<div style="clear: both;"><br></div>
@endsection
@section('javascript')
<script type="text/javascript">
$(document).ready(function(){

  $(document).on('click','.bs_top_search_btn',function () {
    set_search_data();
    document.getElementById('filter_form').submit();
  });
  $(document).on('keyup','.top_search_input',function () {
    set_search_data();
  });
  function set_search_data() {
    var value = document.getElementById('keyword').value;
    if (value != "") {
      $("#bs_search_with_filter").attr('name','keyword');
      $("#bs_search_with_filter").attr('value',value);
    }else{
      $("#bs_search_with_filter").removeAttr('name');
      $("#bs_search_with_filter").removeAttr('value');
    }
  }
  set_search_data();

  $("#close_tray").click(function(){
      $("#filter_tray").toggleClass("active");
    });
  $("#trigger").click(function() {
        $("#filter_tray").toggleClass("active");
      });
  $("#trigger").click(function() {
      $("#trigger").toggleClass("active");
  });
});
</script>
@endsection()