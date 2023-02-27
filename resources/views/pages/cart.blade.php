@extends('layouts.master')
@section('canonical', url("/","cart"))
@section('meta-description', 'Brandzshop have shoes, tshirts, sandals, slippers etc.. Keep your cart full with brandzshop products')
@section('meta-keywords', 'brandzshop cart' )
@section('title', 'Brandzshop - Cart branded products')
@section('content')         
	<div class="ps-content pt-80 pb-80">
        <div class="ps-container">
          {{ Breadcrumbs::render('cart') }}
          @if(Cart::count() < 1)
          <div class="alert alert-success">Your cart is currently empty. </div>
           <a href="{{url('/')}}" class="ps-btn ps-btn--gray" title="Continue shopping with brandzshop">Continue Shopping</a>
          @else
          <div class="ps-cart-listing cartdata">
             <div class="ps-cart-listing">
                <table class="table table ps-cart__table">
                  <thead>
                    <tr>
                      <th>Products</th>
                      <th>Price</th>
                      <th>Size Available</th>
                      <th>Quantity</th>
                      <th>Total</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $cartcontent = Cart::content();
                    ?>
                    @foreach($cartcontent as $item)
                    <tr>
                      <form action="{{url('updateItem')}}" method="post" class="bs_form">
                        @csrf
                      <td><a class="ps-product__preview" href="{{$item->model->slug}}">
                        <img class="mr-15" src="{{url('/',$item->model->image->url)}}" width="85" height="85" alt="{{$item->model->image->name}}" title="{{ucwords($item->name)}}">{{ucwords($item->name)}}</a></td>
                      <td>{{number_format($item->price)}}</td>
                      <td>
                        <!-- <span class="size_msg"></span> -->
                        <select class="form-control choose_size" name="size" required>
                          @if(!$item->options->size)
                            <option value="">Choose Size</option>
                            <script type="text/javascript">
                              var x = document.getElementsByClassName("choose_size");
                              var i;
                              for (i = 0; i < x.length; i++) {
                                if(!x[i].value){
                                  x[i].style.border = "1px solid red";
                                }
                              }
                            </script>
                          @endif
                          @foreach($item->model->sizes as $size)
                            @if($item->options->size == $size->size)
                              <option value="{{$size->size}}" selected>{{$size->size}}</option>
                            @else
                              <option value="{{$size->size}}">{{$size->size}}</option>
                            @endif
                          @endforeach
                        </select>
                      </td>
                      <td>
                        <input type="number" name="qty" min="1" max="10" value="{{$item->qty}}" class="form-control bs_product_qty">
                      </td>
                      <td>{{number_format($item->total)}}</td>
                      <td>
                        <input type="hidden" name="itemId" value="{{$item->rowId}}">
                        <div class="btn btn-grroup"> 
                        <button type="submit" class="btn btn-default bs_form_btn">Update</button>
                        <a href="{{url('removeCartItem?item='.$item->rowId)}}" class="btn btn-default">Remove</a>
                        </div>
                      </td>
                      </form>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="ps-cart__actions">
                  <div class="ps-cart__promotion">
                    <div class="form-group">
                      <a href="{{url('/')}}" class="ps-btn ps-btn--gray" title="buy latest style shoes online">Continue Shopping</a>
                    </div>
                    <div class="form-group">
                      <a href="{{url('/removeCart')}}" class="ps-btn ps-btn--gray" title="buy latest style shoes online">Empty Cart</a>
                    </div>
                  </div>
                  <div class="ps-cart__total">
                  	<h3>Total Items: <span> {{Cart::count() }}</span></h3>
                    <h3>Total Price: <span>Rs: {{Cart::total()}}</span></h3>
                    <a class="ps-btn" id="checkout" href="{{url('/checkout')}}">Process to checkout<i class="fa fa-long-arrow-right"></i></a>
                  </div>
                </div>
              </div>
          </div>
          @endif
        </div>
      </div>
@endsection