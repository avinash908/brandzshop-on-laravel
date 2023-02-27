@extends('layouts.master')
@section('canonical', url("/","checkout"))
@section('meta-description', 'Order now branded shoes all over Pakistan original internaltional branded products')
@section('meta-keywords', 'Checkout with brandzshop' )
@section('title', 'Brandzshop - Checkout & Order now and get original branded products in all over Pakistan')
@section('content')
<div class="ps-checkout pt-80 pb-80">
  <div class="ps-container">
     {{ Breadcrumbs::render('checkout') }}
    <form class="ps-checkout__form bs_form" action="{{route('order.store')}}" method="post">
      @csrf
      <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
              <div class="ps-checkout__billing">
                <h3>Address Detail</h3>
                  <div class="form-group form-group--inline">
                    <label for="firstname">First Name<span>*</span>
                    </label>
                    <input class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{Auth::user()->info->first_name}}" id="firstname" type="text" required>
                    @if($errors->has('first_name'))
                      @foreach($errors->get('first_name') as $message)
                        <span style="color:red">{{$message}}</span>
                      @endforeach
                    @endif
                  </div>
                  <div class="form-group form-group--inline">
                    <label for="lastname">Last Name<span>*</span>
                    </label>
                    <input class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{Auth::user()->info->last_name}}" id="lastname" type="text" required>
                    @if($errors->has('last_name'))
                      @foreach($errors->get('last_name') as $message)
                        <span style="color:red">{{$message}}</span>
                      @endforeach
                    @endif
                  </div>
                  <div class="form-group form-group--inline">
                    <label for="phone">Phone<span>*</span>
                    </label>
                    <input class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ Auth::user()->info->phone }}" type="tele" id="phone" required>
                    @if($errors->has('phone'))
                      @foreach($errors->get('phone') as $message)
                        <span style="color:red">{{$message}}</span>
                      @endforeach
                    @endif
                  </div>
                  <div class="form-group form-group--inline">
                    <label for="email">Email Address<span>*</span>
                    </label>
                    <span class="form-control bs_disabled_email">{{Auth::user()->email}} <a href="{{url('my-account/settings')}}">Change</a></span> 
                    @if($errors->has('email'))
                      @foreach($errors->get('email') as $message)
                        <span style="color:red">{{$message}}</span>
                      @endforeach
                    @endif
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group form-group--inline">
                        <label for="state">State</label>
                        <select name="state_id" id="state" class="form-control bs_states" required>
                          <option value="">Select State</option>
                          @foreach(App\State::all() as $state)
                            @if($state->id == Auth::user()->info->state_id)
                              <option value="{{$state->id}}" selected>{{ucwords($state->state_name)}}</option>
                            @else
                              <option value="{{$state->id}}">{{ucwords($state->state_name)}}</option>
                            @endif
                          @endforeach
                        </select>
                        @if($errors->has('state_id'))
                            @foreach($errors->get('state_id') as $message)
                              <span style="color:red">{{$message}}</span>
                            @endforeach
                         @endif
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group form-group--inline">
                        <label for="city">City</label>
                        <select name="city_id" id="city" class="form-control bs_cities" required>
                        </select>
                        @if($errors->has('city_id'))
                            @foreach($errors->get('city_id') as $message)
                              <span style="color:red">{{$message}}</span>
                            @endforeach
                         @endif
                      </div>
                    </div>
                  </div>
                  <div class="form-group form-group--inline">
                    <label for="address">Address<span>*</span>
                    </label>
                     <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="5" id="address" placeholder="Write your full address please..." required>{{ Auth::user()->info->address }}</textarea>
                     @if($errors->has('address'))
                      @foreach($errors->get('address') as $message)
                        <span style="color:red">{{$message}}</span>
                      @endforeach
                    @endif
                  </div>
                  <div class="form-group">
                    <div class="ps-checkbox">
                      <input class="form-control" type="checkbox" id="cb01" name="policy_check" value="accept" required>
                      <label for="cb01">Check here to indicate that you have read and agree to the <a href="#" class="terms_policy_link" data-toggle="modal" data-target="#PolicyModal">Terms and Policy</a> of Brandzshop</label>
                    </div>
                    @if($errors->has('policy_check'))
                      @foreach($errors->get('policy_check') as $message)
                        <span style="color:red">{{$message}}</span>
                      @endforeach
                    @endif
                  </div>
                  <h3 class="mt-40"> Addition information</h3>
                  <div class="form-group form-group--inline textarea">
                    <label>Order Notes</label>
                    <textarea class="form-control" name="customer_note" rows="5" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                  </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
              <div class="ps-checkout__order">
                <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                  <h3>Your Order</h3>
                </header>
                <div class="content" id="total_details">
                  <table class="table ps-checkout__products">
                    <thead>
                      <tr>
                        <th class="text-uppercase">Product</th>
                        <th class="text-uppercase">Total <span class="badge badge-success">{{Cart::count()}} Item</span></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $cartItems = Cart::content();
                        $delivery_charges = 0;
                      ?>
                      @foreach($cartItems as $item)
                      <tr>
                        <td><span class="label label-success">{{$item->qty}}</span> {{ucwords($item->name)}} </td>
                        <td>Rs: {{number_format($item->total,2)}}</td>
                      </tr>
                        <?php  
                          $delivery_charges += $item->options->delivery_charges * $item->qty;
                        ?>
                      @endforeach
                      <tr>
                        <td>Delivery Charges</td>
                        <td>Rs: {{number_format($delivery_charges,2)}}</td>
                      </tr>
                      <tr>
                        <?php 
                          $cart_total = Cart::total();
                          $total = str_replace(',','',$cart_total) + $delivery_charges;
                        ?>
                        <td>Subtotal</td>
                        <td>Rs: {{$cart_total}}</td>
                      </tr>
                      <tr>
                        <td>Order Total</td>
                        <td>Rs: {{number_format($total,2)}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <footer>
                  <div class="form-group paypal">
                    <div class="ps-radio ps-radio--inline">
                      <h3>Advance Payment</h3>
                      <ul class="advance_payment">
                        <li>03342661545</li>
                      </ul> 
                      <p>For advance payment methods contact on above number</p>
                    </div>
                  </div>
                  <div class="form-group cheque">
                    <div class="ps-radio">
                      <h3>Cash On Delivery</h3>
                      <p>For cash on delivery order two hundered rupees will charged on per product</p>
                    </div>
                    <br>
                    @if($errors->has('payment_method'))
                      @foreach($errors->get('payment_method') as $message)
                        <span style="color:red">{{$message}}</span>
                      @endforeach
                    @endif
                    <button type="submit" class="ps-btn ps-btn--fullwidth bs_form_btn">Place Order<i class="fa fa-long-arrow-right"></i></button>
                  </div>
                </footer>
              </div>
              <div class="ps-shipping">
                <h3>Note</h3>
                <p>SELECT YOUR PRODUCT SIZES VERY CAREFULY!</p>
              </div>
            </div>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="PolicyModal" tabindex="-1" role="dialog" aria-labelledby="PolicyModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:  #2AC37D;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #000;">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" style="color: white;">Brandzshop Policy</h5>
      </div>
      <div class="modal-body">
        <p class="policy_p">Brandzshop purchases these products from Auctions, so Minor Cosmetic Imperfections can be seen which can be neglected if compared to it's current retail price that Brandzshop is offering.</p>
        <p class="policy_p">Brandzshop doesn't take responsibility regarding the durability of products because we have mentioned the manufacturing years in the description.</p>
        <p class="policy_p">No Refund or exchange on the basis of size. You have to select your sizes very carefully. only due to size variation there is no refund/ exchange/ return once the item is sold. That's because we are already selling products at a very low margin of profits. Our main focus is to provide you branded shoes at the lowest possible price.</p>
        <p class="policy_p">The product must be returned in undamaged and original packaging or box that is delivered to you. Customer must return the product in the same condition and in the same packing protocol as the way customer has received.</p>
        <p class="policy_p">It is highly recommended to not put tap on the box, but instead cover the box with the shopper first and then cover it with tap.</p>
        <p class="policy_p">Customer can contact us within tow days if the product delivered to you is defective, damaged, incomplete and incorrect.</p>
        <p class="policy_p">Customer's product will be eligible for refund or replacement depending on the category and condition of the product.</p>
        <p class="policy_p">After two days of the delivery refund policy will not be served.</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-default" data-dismiss="modal" aria-label="Close" >Close</a>
      </div>
    </div>
  </div>
</div>
@endsection