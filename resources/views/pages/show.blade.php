@extends('layouts.master')
@section('canonical', url("/",$product->slug))
@section('meta-description', 'Original '.$product->name.' available in pakistan with different sizes, colors and with 100% money back guarantee at very low price serves at your door')
@section('meta-keywords', $product->name)
@section('title', 'Brandzshop - '.ucwords($product->name).' original in pakistan')
@section('css')
    <link href="{{asset('plugins/ubislider/ubislider.css')}}" rel="stylesheet" />
    <link href="{{asset('css/star-rating.css')}}" rel="stylesheet" />
@endsection
@section('content')
<div class="ps-product--detail pt-60">
  <div class="ps-container">
    {{ Breadcrumbs::render('product',$product) }}
    <div class="row">
      <div class="col-lg-10 col-md-12 col-lg-offset-1">
        <div class="ps-product__thumbnail">
          <div class="ps-product__preview">
            <div class="ps-product__variants">
              @foreach($product->images as $image)
              <div class="item">
                <img src="{{asset('images/product/'.$product->slug.'/'.$image->name)}}" alt="{{str_replace ('-',' ',$image->name)}}">
              </div>
              @endforeach
            </div>
            <a class="popup-youtube ps-product__video" href="{{$product->video}}" title="{{ucwords($product->name)}} new style {{$product->brand->brand}}"><img src="{{asset('images/product/'.$product->slug.'/'.$product->image->name)}}" alt="{{ucwords($product->name)}} latest video"><i class="fa fa-play"></i></a>
          </div>
          <div class="ps-product__image">
            @foreach($product->images as $image)
            <div class="item">
              <img class="zoom" src="{{asset('images/product/'.$product->slug.'/'.$image->name)}}" alt="{{ucwords($product->name)}} original product buy in pakistan {{$image->name}}" data-zoom-image="{{asset('images/product/'.$product->slug.'/'.$image->name)}}">
            </div>
            @endforeach
          </div>
        </div>
        <div class="ps-product__thumbnail--mobile">
          <div class="ubislider-image-container" data-ubislider="#slider" id="mobileimageSlider"></div>
          <div class="ubislider" id="slider">
              <a class="arrow prev"></a>
              <a class="arrow next"></a>
              <ul class="ubislider-inner">
                @foreach($product->images as $image)
                  <li>
                    <img src="{{asset('images/product/'.$product->slug.'/'.$image->name)}}" alt="{{$product->brand->brand}} product">
                  </li>
                @endforeach
                 <li>
                     <a href="{{$product->video}}" class="html5lightbox popup-youtube ps-product__video" data-width="480" data-height="320" title="{{ucwords($product->name)}}" id="product_video_pop_link" style="width:100%;height:100%;border:0px;margin:0px;">
                         <img src="{{asset('images/product/'.$product->slug.'/'.$product->image->name)}}"><i class="fa fa-play"></i>
                    </a>
                </li>
              </ul>
          </div>
        </div>
        <div class="ps-product__info">
          <div class="ps-product__rating">
            <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $product->averageRating }}" data-size="xs" disabled="">
          </div>
          <h1>{{$product->name}}</h1>
          <p class="ps-product__category">
            <a href="{{url('brand/'.$product->brand->slug)}}" title="{{ucwords($product->brand->brand)}} shoes">{{ucwords($product->brand->brand)}}</a>
          </p>
          <h3 class="ps-product__price">Rs: {{number_format($product->price)}} 
            @if($product->old_price)
            <del>Rs {{number_format($product->old_price)}}</del>
            @endif
          </h3>
          <div class="ps-product__block ps-product__quickview">
            <h4>QUICK REVIEW</h4>
            <p>{!!Str::limit($product->description, 150)!!}</p>
          </div>
          @if($product->stock > 0)
          <p class="stock in-stock">{{$product->stock}} in stock</p>
          @else
          <span class="stock badge badge-danger bs_stock-out">Out of stock</span>
          @endif
            <div class="ps-product__block ps-product__size">
              <h4>CHOOSE SIZE</h4>
              <select class="ps-select selectpicker" name="size" id="product_size" required>
                <option value="">Select Size</option>
                @foreach($product->sizes as $size)
                  <option value="{{$size->size}}">{{$size->size}}</option>
                @endforeach
              </select>
                <div class="form-group">
                    <input class="form-control bs_product_qty" id="product_qty" type="number" min="1" max="10" value="1" required>
                </div>
            </div>
            <div class="ps-product__shopping">
              <button data-product_quantity="1" data-product_id="{{$product->slug}}" data-product_size="" class="ps-btn mb-10 add_to_cart" style="border-radius: 60px;">Add to cart<i class="ps-icon-next"></i></button>
              <div class="ps-product__actions">
                <a class="mr-10 wishlist" data-product_id="1745" href="#"><i class="ps-icon-heart"></i></a>
                <a class="compare" data-product_id="1745" href="#"><i class="ps-icon-share"></i></a>
                </div>
            </div>
        </div>
          <div itemtype="http://schema.org/Product" itemscope>
              <meta itemprop="mpn" content="{{rand().strtotime('now')}}" />
              <meta itemprop="name" content="{{ucwords($product->name)}}" />
              @foreach($product->images as $image)
              <link itemprop="image" href="{{url('images/product/'.$product->slug,$image->name)}}" />
              @endforeach
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
        <div class="clearfix"></div>
        <div class="ps-product__content mt-50">
          <ul class="tab-list" role="tablist">
            <li class="active"><a href="#tab_01" aria-controls="tab_01" role="tab" data-toggle="tab">Overview</a></li>
            <li><a href="#tab_02" aria-controls="tab_02" role="tab" data-toggle="tab">Review</a></li>
            <li><a href="#tab_03" aria-controls="tab_03" role="tab" data-toggle="tab">PRODUCT TAG</a></li>
          </ul>
        </div>
        <div class="tab-content mb-60">
          <div class="tab-pane active" role="tabpanel" id="tab_01">
            {!!$product->description!!}
          </div>
          <div class="tab-pane" role="tabpanel" id="tab_02">
            <p class="mb-20">{{count($product->reviews)}} review for <strong>{{ucwords($product->name)}}</strong></p>

              @foreach($product->reviews as $review)
                <div class="ps-review">
                  <div class="ps-review__thumbnail">
                    <img src="{{asset('images/user/avatar.png')}}" alt="brandzshop - avatar">
                  </div>
                  <div class="ps-review__content">
                    <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                    <?php 
                      $ratings = DB::table('ratings')->where('id','=',$review->rating_id)->get(); 
                    ?> 
                        @foreach($ratings as $rating)
                          @for($i=1; $i<=$rating->rating; $i++)
                           <i class="fa fa-star bg-yellow br-current" style="color: yellow"></i>
                          @endfor
                          @for($i=$rating->rating; $i < 5; $i++)
                           <i class="fa fa-star bg-yellow br-current"></i>
                          @endfor
                        @endforeach
                      <p>By<a> {{ucwords($review->user->name)}}</a> - {{$review->created_at->format('M - d - Y')}}</p>
                    </header>
                    <p>{{$review->review}}</p>
                  </div>
                </div>
              @endforeach
          <form class="ps-product__review bs_form" action="{{route('review.store',$product->id)}}" method="post">
            @csrf
            <h4>ADD YOUR REVIEW</h4>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                <div class="form-group">
                  <label>Your rating<span></span></label>
                  <div class="rating">
                    <input id="input" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $product->userAverageRating }}" data-size="xs" required>
                    @if($errors->has('rate'))
                      @foreach($errors->get('rate') as $message)
                        <span style="color:red">{{$message}}</span>
                      @endforeach
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 ">
                <div class="form-group">
                  <label>Your Review:</label>
                  <textarea class="form-control @error('review') is-invalid @enderror" name="review" rows="6" required>{{ old('review') }}</textarea>
                  @if($errors->has('review'))
                    @foreach($errors->get('review') as $message)
                      <span style="color:red">{{$message}}</span>
                    @endforeach
                  @endif
                </div>
                <div class="form-group">
                @guest
                  <button type="button" class="ps-btn ps-btn--sm bs_form_btn bs_login_btn" >Submit<i class="ps-icon-next"></i></button>
                @else
                  <button type="submit" class="ps-btn ps-btn--sm bs_form_btn">Submit<i class="ps-icon-next"></i></button>
                @endguest
                </div>
              </div>
            </div>
          </form>
          </div>
          <div class="tab-pane" role="tabpanel" id="tab_03">
            <ul class="ps-tags">
            @foreach($product->tags as $tag)
              <li><a href="#" title="{{$tag->name}}">{{$tag->name}}</a></li>
            @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="ps-section ps-section--top-sales ps-owl-root pt-40 pb-80">
  <div class="ps-container">
    <div class="ps-section__header mb-50">
      <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
              <h3 class="ps-section__title" data-mask="Related item">- YOU MIGHT ALSO LIKE</h3>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
              <div class="ps-owl-actions"><a class="ps-prev" href="#"><i class="ps-icon-arrow-right"></i>Prev</a><a class="ps-next" href="#">Next<i class="ps-icon-arrow-left"></i></a></div>
            </div>
      </div>
    </div>
    <div class="ps-section__content">
      <div class="ps-owl--colection owl-slider" data-owl-auto="true" data-owl-dots="false" data-owl-duration="1000" data-owl-gap="30" data-owl-item="4" data-owl-item-lg="4" data-owl-item-md="3" data-owl-item-sm="2" data-owl-item-xs="1" data-owl-loop="true" data-owl-mousedrag="on" data-owl-nav="false" data-owl-speed="5000">
              @foreach($related_products as $related_product)
              <div class="ps-shoes--carousel col-4">
                  <div class="ps-shoe">
                      <div class="ps-shoe__thumbnail">
                          @if($related_product->is_new)
                          <div class="ps-badge"><span>New</span></div>
                          @endif
                          @if($related_product->percent_off)
                          <div class="ps-badge ps-badge--sale ps-badge--2nd"><span>-{{$related_product->percent_off}}%</span></div>
                          @endif
                          <a href="{{url('/'.$related_product->slug)}}" title="{{$related_product->brand->brand}} shoe buy online">
                             <img alt="{{$related_product->name}}" src="{{url('images/product'.$product->slug,$related_product->image->name)}}" />
                          </a>
                      </div>

                      <div class="ps-shoe__content">
                          <div class="ps-shoe__detail">
                              <a class="ps-shoe__name" href="{{$related_product->slug}}" title="{{$related_product->brand->brand}} new style products shop online">{{Str::limit($related_product->name,22)}}</a>
                              <p>
                                  @for($i=1; $i<=$related_product->averageRating; $i++)
                                      <i class="fa fa-star bg-yellow ps-rating-stars rated-stars"></i>
                                  @endfor
                                  @for($i=$related_product->averageRating; $i < 5; $i++)
                                       <i class="fa fa-star bg-yellow br-current ps-rating-stars"></i>
                                  @endfor
                              </p>
                              <p class="ps-shoe__categories">
                                  @if($related_product->brand)
                                  <a href="{{url('brand',$related_product->brand->slug)}}" title="{{ ucwords($related_product->brand->brand)}} latest style shoes original buy now">
                                    {{ ucwords($related_product->brand->brand)}}
                                   </a>
                                  @endif
                              </p>
                              <span class="ps-shoe__price"> 
                                  @if($related_product->old_price)
                                  <small><del>Rs:{{number_format($related_product->old_price)}}</del></small>
                                  <br>
                                  @endif
                                  Rs: {{number_format($related_product->price)}}
                              </span>
                          </div>
                      </div>
                  </div>
              </div>
              @endforeach
      </div>
  </div>
  </div>
</div>

@endsection
@section('javascript')
<script src="{{asset('js/star-rating.js')}}"></script>
<script src="{{asset('js/html5lightbox.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/ubislider/ubislider.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $(document).on('change','#product_qty',function(){
        var qty = $("#product_qty").val();
        if(qty != "" || qty != null){
          $('.add_to_cart').attr('data-product_quantity',qty);
        }
      });
      $(document).on('change','#product_size',function(){
        var size = $("#product_size").val();
        if(check_size(size)){
          $('.add_to_cart').attr('data-product_size',size);
        }
      });
      var size = $("#product_size").val();
      function check_size(size) {
        if (size == "" || size == null) {
          $('.add_to_cart').attr('disabled','disabled');
          $('.add_to_cart').attr('title','Please select size!');
          $('.add_to_cart').addClass('bs_disabled_btn');
          return false;
        }else{
          $('.add_to_cart').removeAttr('disabled');
          $('.add_to_cart').attr('title','Add to cart');
          $('.add_to_cart').removeClass('bs_disabled_btn');
          return true;
        }
      }
      check_size(size);
       function ubislider() {
        $('#slider').ubislider({
            arrowsToggle: true,
            type: 'ecommerce',
            hideArrows: true,
            autoSlideOnLastClick: true,
            modalOnClick: true,
        });
    }
    ubislider();
    $("#input-id").rating();
    });
</script>
@endsection