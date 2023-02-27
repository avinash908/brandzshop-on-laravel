<a class="ps-cart__toggle" href="javascript:void(0)">
        @if(Cart::count()> 0)
        <span><i>{{Cart::count()}}</i></span>
        @endif
        <i class="ps-icon-shopping-cart"></i>
</a>
<div class="ps-cart__listing">
  <div class="ps-cart__content">
<?php 
  $top_cartcontents = Cart::content();
?>
@foreach($top_cartcontents as $top)
    <div class="ps-cart-item">
      <a class="ps-cart-item__close remove_item" data-route="{{url('removeCartItem?item='.$top->rowId)}}" href="javascript:void(0)"></a>
      <div class="ps-cart-item__thumbnail">
        <a href="{{url('/'.$top->model->slug)}}" title="{{ucwords($top->name)}}"></a>
        <img src="{{url('/',$top->model->image->url)}}" alt="{{$top->name}}">
      </div>
      <div class="ps-cart-item__content"><a class="ps-cart-item__title" href="{{url('/'.$top->model->slug)}}" title="{{$top->name}}">{{$top->name}}</a>
        <p><span>Quantity:<i>{{$top->qty}}</i></span><span>Total:<i>{{$top->total}}</i></span></p>
      </div>
    </div>
@endforeach
  </div>
  <div class="ps-cart__total">
    <p>Number of items:<span>{{Cart::count()}}</span></p>
    <p>Item Total:<span>{{Cart::total()}}</span></p>
  </div>
  <div class="ps-cart__footer">
    <a class="ps-btn" href="{{url('/cart')}}">Cart<i class="ps-icon-arrow-left"></i></a>
  </div>
</div>