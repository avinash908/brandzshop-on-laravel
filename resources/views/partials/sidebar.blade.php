<aside class="ps-widget--sidebar">
  <div class="ps-widget__header">
    <h3>Brands</h3>
  </div>
  <div class="ps-widget__content">
    <ul class="ps-list--arrow">
      @foreach(App\Brand::all() as $brand)
      <li><a href="{{url('/shop/'. $brand->category->slug .'?brand=' . $brand->slug)}}" title="{{ucwords($brand->title)}} Shoes">{{ucwords($brand->title)}}</a></li>
      @endforeach
    </ul>
  </div>
</aside>
<aside class="ps-widget--sidebar">
  <div class="ps-widget__header">
    <h3>Recent Products</h3>
  </div>
  <div class="ps-widget__content">
   @foreach(App\Product::latest()->limit(3)->get() as $p)
      <div class="ps-shoe--sidebar">
          <div class="ps-shoe__thumbnail"><a href="{{url('/'.$p->slug)}}" title="{{ucwords($p->name)}} latest style"></a><img src="{{url('/',$p->image->url)}}" alt="{{$p->name}} new trend"></div>
          <div class="ps-shoe__content"><a class="ps-shoe__title" href="{{url('/'.$p->slug)}}" title="{{$p->name}} new style">{{ucwords(Str::limit($p->name,20))}}</a>
            <p><del>Rs: {{ ($p->old_price) ? number_format($p->old_price) : '' }} </del>Rs: {{number_format($p->price)}}</p>
          </div>
      </div>
  @endforeach
  </div>
</aside>