<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="canonical" href="{{ URL::current() }}" />
    <link href="{{asset('favicon.png')}}" rel="apple-touch-icon" />
    <link href="{{asset('favicon.png')}}" rel="icon" />
    <meta name="description" content="@yield('meta-description')">
    <meta name="keywords" content="@yield('meta-keywords')">
    <title>@yield('title')</title>
    <!-- Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Archivo+Narrow:300,400,700%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet" />
    <link href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/ps-icon/style.css')}}" rel="stylesheet" /><!-- CSS Library-->
    <link href="{{asset('plugins/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/owl-carousel/assets/owl.carousel.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/slick/slick/slick.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/Magnific-Popup/dist/magnific-popup.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" />
    <!-- <link href="{{asset('plugins/ubislider/ubislider.css')}}" rel="stylesheet" /> -->
    <link href="{{asset('plugins/revolution/css/settings.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/revolution/css/layers.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/revolution/css/navigation.css')}}" rel="stylesheet" />
    <link href="{{asset('css/star-rating.css')}}" rel="stylesheet" />
    <link href="{{asset('css/noty.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/style.css')}}" rel="stylesheet" />
    <style type="text/css">
    #trigger {
        background-color: white;
        text-align: center;
        color: #000;
        font-size: 1em;
        display: block;
        position: fixed;
        width: 32px;
        height: 26px;
        top: 200px;
        left: 0px;
        border: 0px;
        border-radius: 0px 2px 3px 0px;
        box-shadow: 0 0 2px 1px #0000002e;
    }

#filter_tray {
    top: 0px;
    left: 0px;
    position: fixed;
    height: 100vh;
    width: 70%;
    overflow: scroll;
    padding: 15px;
    background: white;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.4);
    z-index: 100000;
    transform: translate(-150%, 0px);
    transition: all 0.75s ease-in-out;
}

#filter_tray.active {
  -webkit-transform: translate(0%, 0px);
  transform: translate(0%, 0px);
  transition: all 0.75s ease-in-out;
}

    </style>
</head>

<body class="ps-loading">
<div class="header--sidebar"></div>

<header class="header">
    <div class="header__top">
        <div class="container-fluid">
          <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-6 col-xs-12 ">
                  <p>Brandzshop provides 100% guaranteed original branded shoes</p>
                </div>
                <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12 ">
                @guest
                  <div class="header__actions">
                    <a href="{{url('register')}}" title="Create your account on brandzshop"><i class="fa fa-user-plus"></i> Regiser</a>
                  </div>
                  <div class="header__actions">
                    <a href="{{url('login')}}" title="Login"><i class="fa fa-sign-in"></i> Login</a>
                  </div>
                @else
                    @role(['admin','editor','employe'])
                    <div class="header__actions">
                        <a href="{{url('/dashboard')}}" title="Dashboard"><i class="fa fa-home"></i> Dashboard</a>
                    </div>
                    @else
                    <div class="header__actions">
                        <a href="{{url('/my-account/dashboard')}}" title="My Account"><i class="fa fa-user"></i> My Account</a>
                    </div>
                    @endrole
                    <div class="header__actions">
                        <a href="{{url('/my-account/wishlist')}}" title="Wishlist"><i class="fa fa-heart"></i> Wishlist</a>
                    </div>
                @endguest
                  <div class="header__actions">
                    <a href="{{url('/compare')}}" title="Compare"><i class="fa fa-balance-scale"></i> Compare</a>
                  </div>
                  <div class="header__actions">
                    <div id="google_translate_element"></div>  
                  </div>
                </div>
          </div>
        </div>
      </div>
    <nav class="navigation">
        <div class="container-fluid">
            <div class="navigation__column left">
                <div class="header__logo">
                <a class="ps-logo" href="{{url('/')}}" title="Brandzshop - Logo">
                    <img alt="Brandzshop - Logo" src="{{asset('images/logo.svg')}}"  />
                </a>
                </div>
            </div>
            <div class="navigation__column center">
                <ul class="main-menu menu">
                    <li class="menu-item {{ (request()->is('/')) ? 'current-menu-item' : '' }}"><a href="{{url('/')}}" title="Home">Home</a>
                    </li>
                    <li class="menu-item menu-item-has-children dropdown" id="shop">
                    <a href="javascript:void(0)" title="Brandzshop - Shop">Shop</a>
                    <ul class="sub-menu shop_cat_list">
                        <?php 
                        $categories = App\Category::all();
                        ?>
                        @foreach($categories as $category)
                        <li class="menu-item"><a href="{{url('/shop',$category->slug)}}" title="{{ucwords(str_replace('-',' ',$category->slug))}}">{{ucwords($category->title)}}</a></li>
                        @endforeach
                    </ul>
                </li>
                    <li class="menu-item "><a href="{{url('/blog')}}" title="Brandzshop - Blog">Blog</a></li>
                    <li class="menu-item {{ (request()->is('help')) ? 'current-menu-item' : '' }}"><a href="{{url('/help')}}" title="Brandzshop - Help">Help</a></li>
                    <li class="menu-item {{ (request()->is('contact')) ? 'current-menu-item' : '' }}"><a href="{{url('/contact')}}" title="Brandzshop - Contact">Contact</a></li>
                    </li>
                    <li class="menu-item"><a href="javascript:void(0)" onclick="openSearch()" title="Brandzshop - Search">Search</a></li>
                    </li>
                </ul>
            </div>

            <div class="navigation__column right">
                <div class="ps-cart" id="top_cart">
                    @include('partials.top_cart')
                </div>
                <div class="menu-toggle"></div>
            </div>
        </div>
    </nav>
</header>
<main class="ps-main">
    @include('partials.header_note')
    @yield('content')
    @include('layouts.footer')
    <div class="popup-icons">
        <a href="https://wa.me/923184251545" class="chat-popup-icon whatsapp-icon" title="Contact on Whatsapp" target="_blank">
        <i class="fa fa-whatsapp chat-inner-icon"></i>
        </a>
        <a href="https://m.me/103395707790337" class="chat-popup-icon messenger-icon" title="Contact on Messenger" target="_blank">
            <img src="{{asset('images/icon/messenger-icon.png')}}">
        </a>
    </div>
</main>
@guest
    @include('partials.login_modal')
@endguest
<div id="bs_searchOverlay" class="bs_overlay bs_form">
  <span class="closebtn" onclick="closeSearch()" title="Close Overlay">x</span>
  <div class="bs_overlay-content">
    <form action="#" method="GET" id="bs_search_form">
    <select class="bs_search_input" id="bs_searchCategory" required>
        @foreach($categories as $category)
        <option value="{{$category->slug}}">{{ucwords($category->title)}}</option>
        @endforeach
    </select>
    <input type="text" name="keyword" class="bs_search_input" placeholder="Search.." required>
    <button type="submit" class="bs_form_btn"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>
<!-- JS Library-->
<script type="text/javascript" src="{{asset('plugins/email-decode.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/jquery/dist/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/owl-carousel/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/imagesloaded.pkgd.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/isotope.pkgd.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/jquery.matchHeight-min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/slick/slick/slick.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/elevatezoom/jquery.elevatezoom.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/Magnific-Popup/dist/jquery.magnific-popup.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/star-rating.js')}}"></script>
<script src="{{asset('js/noty.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/main.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/jquery.themepunch.tools.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/extensions/revolution.extension.video.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/extensions/revolution.extension.migration.min.js')}}"></script>

<script>
    function googleTranslateElementInit() {
        new google.translate.TranslateElement(
            {pageLanguage: 'en'},
            'google_translate_element'
        );
    }
</script>
<script src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
@include('partials.success')
@include('partials.error')
@yield('javascript')
<script type="text/javascript">
$(document).ready(function () {
    $(document).on('click','.add_to_cart',function(){
        var this_item  = $(this).children('i');
        start_spinner(this_item);
        var bs_product = $(this).attr('data-product_id');
    	var bs_size = $(this).attr('data-product_size');
        var bs_qty = $(this).attr('data-product_quantity');
        $.ajax({
            url:'<?=url("addToCart")?>',
            method:'POST',
            data: {product:bs_product,qty:bs_qty,size:bs_size,"_token": "<?=csrf_token()?>"},
            success:function(data){
               notify(data);
               top_cart();
               stop_spinner(this_item);
            }
        });
    });
    $(document).on('click','.add_to_compare',function () {
        var this_item  = $(this).children('i');
        start_spinner(this_item);
        var bs_product = $(this).attr('data-product_id');
        $.ajax({
            url:'<?=url("addToCompare")?>',
            method:'POST',
            data:{product:bs_product,"_token": "<?=csrf_token()?>"},
            success:function(data){
                notify(data);
                stop_spinner(this_item);
            }
        });
    });
    $(document).on('click','.add_to_wishlist',function () {
        var this_item  = $(this).children('i');
        start_spinner(this_item);
        var bs_product = $(this).attr('data-product_id');
        $.ajax({
            url:'<?=url("addToWishlist")?>',
            method:'POST',
            data:{product:bs_product,"_token": "<?=csrf_token()?>"},
            success:function(data){
                notify(data);
                stop_spinner(this_item);
            }
        });
    });
    $(document).on('click','.remove_item',function(){
        var route = $(this).attr('data-route');
        $.ajax({
            url:route,
            method:'GET',
            success:function(data){
                notify(data);
                top_cart();
            }
        })
    });
    $(document).on('click','.bs_login_btn',function(){
        $("#LoginModal").modal("show");
    });
    $(document).on('submit','.bs_form',function() {
        $('.bs_form_btn').attr('disabled','true');
    });
    
    $(document).on('change','#bs_searchCategory',function () {
        search_action();
    })
    function search_action() {
        var bs_cat = $("#bs_searchCategory option:selected").val();
        $("#bs_search_form").attr('action','<?=url("/shop")?>/'+bs_cat);
    }
    search_action();

    $(document).on('change','.bs_states',function () {
        var bs_st  = $(this).val();
        state_cities(bs_st);
    });
    function state_cities(bs_st) {
        if(bs_st != "" && bs_st != null){
            $.ajax({
                url:"<?=url('bs_state_cites')?>",
                method:'POST',
                data:{state:bs_st,'_token':'<?=csrf_token()?>'},
                success:function(data){
                    $('.bs_cities').html(data.html);
                }
            });
        }
    }
    state_cities($("#state").val());
    function top_cart() {
        $.ajax({
            url:'<?=url("show_topCart")?>',
            method:'POST',
            data:{"_token": "<?=csrf_token()?>"},
            success:function(data){
                $("#top_cart").html(data.html)
            }
        });
    }
    function notify(data) {
        new Noty({
           type: data.message_type,
           layout: 'centerRight',
           theme: 'nest',
           text: data.message,
           timeout: '4000',
           progressBar: true,
           killer: true,
        }).show();
    }
    function start_spinner(this_item) {
        this_item.attr('class','');
        this_item.addClass('fa fa-spinner fa-spin bs_spinner');
    }
    function stop_spinner(this_item) {
        this_item.attr('class','');
        this_item.addClass('fa fa-check');
    }
});
    $(".bs_product_qty").keypress(function (evt) {
          evt.preventDefault();
    });
    $(document).on('click','.cart__toggle',function () {
       $('.ps-cart__listing').fadeIn('slow');
    })
    $(window).on('load', function() {
        $('.ps-loading').addClass('loaded');
    });
    $("#input-id").rating();
    function openSearch() {
      document.getElementById("bs_searchOverlay").style.display = "block";
    }

    // Close the full screen search box
    function closeSearch() {
      document.getElementById("bs_searchOverlay").style.display = "none";
    }
</script>
</body>
</html>