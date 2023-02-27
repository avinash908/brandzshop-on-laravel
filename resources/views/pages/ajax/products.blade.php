<div class="ps-product-action">
  <!-- $products->withPath(Request::getRequestUri()); -->
  {{ $products->onEachSide(3)->links('partials.pagination') }}
</div>
<div class="ps-product__columns">
@foreach($products as $product)
<div class="ps-product__column">
  <div class="ps-shoe mb-30">
    <div class="ps-shoe__thumbnail">
        <div class="ps-shoe__actions">
            <a class="ps-shoe__favorite wishlist" href="#"><i class="fa fa-heart"></i></a>
            <a rel="nofollow" href="#" class="ps-shoe__favorite product-item-cart button product_type_simple add_to_cart_button ajax_add_to_cart"><i class="fa fa-shopping-cart"></i></a>
        </div>
      @if($product->is_new)
        <div class="ps-badge"><span>New</span></div>
      @endif
      @if($product->percent_off)
        <div class="ps-badge ps-badge--sale ps-badge--2nd">
          <span>-{{$product->percent_off}}%</span>
        </div>
      @endif
      <img alt="{{$product->name}} original product only for pakistanis" src="{{url('public/images/product',$product->image->name)}}" />
      <a class="ps-shoe__overlay" href="{{url('/'.$product->slug)}}" title="{{ucwords($product->name)}} original buy online"></a>
    </div>
    <div class="ps-shoe__content">
      <div class="ps-shoe__detail">
        <a class="ps-shoe__name" href="{{$product->slug}}" title="{{ucwords($product->name)}} Brand New Product">{{ucwords(Str::limit($product->name,26))}}</a>
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
                <a href="{{url('brand',$product->brand->slug)}}" title="{{ucwords($product->brand->brand )}} New Shoes">
                  {{ ucwords($product->brand->brand )}}
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
</div>
@endforeach
@if(!count($products) > 0)
    <h1 align="center" style="margin-top: 5%;font-family: Montserrat, sans-serif;font-weight: 400;">No Products Available</h1>
@endif
</div>
