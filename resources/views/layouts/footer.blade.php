<div class="ps-footer bg--cover" data-background="{{url('images/background/footer-testimonial.jpg')}}">
    <div class="ps-footer__content">
        <div class="ps-container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                    <aside class="ps-widget--footer ps-widget--info">
                        <header>
                            <a class="ps-logo" href="{{url('/')}}" title="buy online shoes">
                                <img alt="Brandzshop - logo" src="{{url('images/white-logo.png')}}" />
                            </a>
                            <h3 class="ps-widget__title">Address Office 1</h3>
                        </header>

                        <footer>
                            <p><strong>Main Naseem Nagar Qasimabad, Hyderabad</strong></p>
                            <p>Email: <a href="mailto:brandzshopweb@gmail.com">brandzshopweb@gmail.com</a></p>
                            <p>Phone1: +923184251545</p>
                        </footer>
                    </aside>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 ">
                    <aside class="ps-widget--footer ps-widget--link">
                    <header>
                        <h3 class="ps-widget__title">Get Help</h3>
                    </header>
                        <footer>
                            <ul class="ps-list--line">
                                <li><a href="{{url('help#how-to-order')}}">How to Order</a></li>
                                <li><a href="{{url('help#shipping-and-delivery')}}">Shipping and Delivery</a></li>
                                <li><a href="{{url('help#return-policy')}}">Returns</a></li>
                                <li><a href="{{url('help#payment-options')}}">Payment Options</a></li>
                                <li><a href="{{url('sitemap')}}">Sitemap</a></li>
                            </ul>
                        </footer>
                    </aside>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 ">
                    <aside class="ps-widget--footer ps-widget--link">
                        <header>
                            <h3 class="ps-widget__title">Brands</h3>
                        </header>
                        <footer>
                            <ul class="ps-list--line">
                                @foreach(App\Brand::limit(6)->get() as $brand)
                                    <li><a href="{{url('/shop/'. $brand->category->slug .'?brand=' . $brand->slug)}}">{{ucwords($brand->title)}}</a></li>
                                @endforeach
                            </ul>
                        </footer>
                    </aside>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 ">
                    <aside class="ps-widget--footer ps-widget--link">
                        <header>
                            <h3 class="ps-widget__title">Categories</h3>
                        </header>
                        <footer>
                            <ul class="ps-list--line">
                                 @foreach(App\Category::limit(6)->get() as $cat)
                                    <li><a href="{{url('/shop',$cat->slug)}}">{{ucwords($cat->title)}}</a></li>
                                @endforeach
                            </ul>
                        </footer>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <div class="ps-footer__copyright">
          <div class="ps-container">
            <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                    <p>© <a href="{{url('/')}}">Brandzshop </a>{{date('Y')}} All rights Resevered.</p>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                    <ul class="ps-social">
                      <li><a href="https://web.facebook.com/Brandz-Shop-103395707790337/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                      <li><a href="https://www.instagram.com/brandzshop.pk/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                      <li><a href="https://wa.me/923184251545"  target="_blank"><i class="fa fa-whatsapp"></i></a></li>
                      <li></li>
                    </ul>
                  </div>
            </div>
          </div>
        </div>
</div>