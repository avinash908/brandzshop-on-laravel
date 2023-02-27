@extends('layouts.master')
@section('canonical', url("/","search"))
@section('meta-description', 'Search branded products on brandzshop likes shoes, tshirts, slippers etc...')
@section('meta-keywords', 'Search with brandzshop')
@section('title', 'Brandzshop - Search original branded shoes, tshirts, pants etc..')
@section('content')
<div class="ps-blog-grid pt-80 pb-80 latest-products">
  <div class="ps-container">
    <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
          <div class="ps-section__header mb-50">
              <form class="ps-search--widget bs_form" action="" method="get">
                <input type="text" name="keyword" id="search" value="{{$keyword}}" class="form-control">
                <button type="button" class="bs_form_btn"><i class="ps-icon-search"></i></button>
              </form>
              <h3 class="ps-section__title" data-mask="Search">- Search</h3>
          </div>
          <div id="products">     
              <div class="row"> 
  @foreach($products as $product)
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="ps-post mb-30">
        <div class="ps-post__thumbnail">
            <a class="ps-post__overlay" href="{{$product->slug}}" title="{{ucwords($product->name)}} buy online"></a>
            <img src="{{url('public/images/product',$product->image->name)}}" alt="">
        </div>
        <div class="ps-post__content">
            <a class="ps-post__title" href="{{$product->slug}}" title="{{ucwords($product->name)}} shop online now">{{Str::limit(ucwords($product->name),22)}}</a>
          <p class="ps-post__meta">
              <span>Rs:</span>{{number_format($product->price)}} 
                <span class="ml-5">
                  <del>{{($product->old_price) ? 'Rs:'.number_format($product->old_price) : '' }}
                  </del>
                </span>
            </p>
          <a class="ps-morelink" href="{{$product->slug}}">Read more<i class="fa fa-long-arrow-right"></i></a>
          <div itemtype="http://schema.org/Product" itemscope>
            <meta itemprop="mpn" content="{{rand().strtotime('now')}}" />
            <meta itemprop="name" content="{{ucwords($product->name)}}" />
            <link itemprop="image" href="{{url('public/images/product',$product->image->name)}}" />
            <meta itemprop="description" content="{!!Str::limit($product->description, 200)!!}" />
            <div itemprop="offers" itemtype="http://schema.org/Offer" itemscope>
                <link itemprop="url" href="{{url('/'.$product->slug)}}" />
                <meta itemprop="availability" content="https://schema.org/InStock" />
                <meta itemprop="priceCurrency" content="PKR" />
                <meta itemprop="price" content="{{$product->price}}" />
                <meta itemprop="priceValidUntil" content="2030-12-05" />
                <div itemprop="seller" itemtype="http://schema.org/Organization" itemscope>
                    <meta itemprop="name" content="{{ config('app.name') }}" />
                </div>
            </div>
            <div itemprop="aggregateRating" itemtype="http://schema.org/AggregateRating" itemscope>
              <meta itemprop="reviewCount" content="{{count($product->reviews)}}" />
              <meta itemprop="ratingValue" content="{{$product->averageRating}}" />
            </div>
            @foreach($product->reviews as $review)
            <div itemprop="review" itemtype="http://schema.org/Review" itemscope>
              <div itemprop="author" itemtype="http://schema.org/Person" itemscope>
                <meta itemprop="name" content="{{ucwords($review->name)}}" />
              </div>
              <div itemprop="reviewRating" itemtype="http://schema.org/Rating" itemscope>
                <?php 
                    $ratings = DB::table('ratings')->where('id','=',$review->rating_id)->count();
                ?>
                <meta itemprop="ratingValue" content="{{$ratings}}" />
              </div>
            </div>
            @endforeach
            <meta itemprop="sku" content="{{strtotime('now').rand()}}" />
            <div itemprop="brand" itemtype="http://schema.org/Thing" itemscope>
              <meta itemprop="name" content="{{ucwords($product->brand->brand )}}" />
            </div>
        </div>
        </div>
      </div>
    </div>
  @endforeach
</div>
          </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        @include('partials.sidebar')
      </div>
    </div>
  </div>
</div>
@endsection