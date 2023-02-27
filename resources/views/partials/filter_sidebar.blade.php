<?php 
    $webview = new App\WebView;
?>
@if($webview->isMobile())
<div id="filter_tray" class="filter_tray">
  <a href="#" id="close_tray" style="float: right;cursor: pointer;"><i class="fa fa-close"></i></a>
@else
<div class="ps-sidebar">
@endif
  <form method="get" id="filter_form">
    <aside class="ps-widget--sidebar ps-widget--category">
      <div class="ps-widget__header">
        <h3>Category</h3>
      </div>
      <div class="ps-widget__content">
        <ul class="ps-list--checked cat_filters_list">
          <?php
            $subcategory = $major_category->subcategories;
          ?>
          @foreach($subcategory as $subcat)
              <li>
                  <label class="filter_p" onclick="document.getElementById('filter_form').submit()">
                    <i class="fa fa-check tick"></i>
                    <input type="checkbox" name="subcategory[{{$subcat->slug}}]" value="{{$subcat->slug}}" class="filter_checkbox" {{(request()->filled('subcategory.'.$subcat->slug)) ? 'checked' : ''}}> {{ucwords($subcat->title)}} ({{$subcat->products->count()}})
                  </label>
              </li>
          @endforeach
        </ul>
         @if(count($subcategory) > 5)
          <a id="more_cat_list" style="cursor: pointer;">See More</a>
        @endif
      </div>
    </aside>
    <aside class="ps-widget--sidebar">
      <div class="ps-widget__header">
        <h3>Select Size</h3>
      </div>
      <div class="ps-widget__content">
            <?php 
              $sizes = $major_category->sizes;
            ?>
            @foreach($sizes->chunk(5) as $chunk)
                @foreach($chunk as $size)
                  <label class="filter_p filter_size_p {{(request()->size == $size->size) ? 'current_filter' : ''}}" onclick="document.getElementById('filter_form').submit()" >
                      <input type="radio" name="size" value="{{$size->slug}}" style="visibility: hidden;" {{(request()->size == $size->slug) ? 'checked' : ''}}>{{ucwords($size->size)}}
                  </label>
                @endforeach
                <br>
            @endforeach
      </div>
    </aside>
    <aside class="ps-widget--sidebar ps-widget--filter">
      <div class="ps-widget__header">
        <h3>Price</h3>
      </div>
      <div class="ps-widget__content">
        <div class="ac-slider ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-default-min="0" data-default-max="20000" data-max="20000" data-step="50" data-unit="">
          <div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 91.3043%;"></div>
          <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span>
          <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 91.3043%;"></span>
        </div>
        <p class="ac-slider__meta">Price: Rs
          <span class="ac-slider__value ac-slider__min">0</span>
          -<span class="ac-slider__value ac-slider__max">20000</span>
          <input type="hidden" value="" id="price_min">
          <input type="hidden" value="" id="price_max">
        </p>
        <a class="ac-slider__filter ps-btn filter_p" onclick="
        document.getElementById('price_min').setAttribute('name', 'price_min');
        document.getElementById('price_max').setAttribute('name', 'price_max');
        document.getElementById('filter_form').submit();
        ">Filter</a>
      </div>
    </aside>
    <aside class="ps-widget--sidebar ps-widget--category">
      <div class="ps-widget__header">
        <h3>{{ucwords($major_category->title)}} Brand</h3>
      </div>
      <div class="ps-widget__content">
        
        <ul class="ps-list--checked brand_filters_list">
          <?php 
            $brands = $major_category->brands;
          ?>
          @foreach($brands as $brand)
              <li>
                <label class="filter_p" onclick="document.getElementById('filter_form').submit()">
                  <i class="fa fa-check tick"></i>
                  <input type="radio" name="brand" value="{{$brand->slug}}" class="filter_checkbox" {{(request()->brand == $brand->slug) ? 'checked' : ''}}> {{ucwords($brand->title)}}
                  ({{$brand->products->count()}})
                </label>
              </li>
          @endforeach 
        </ul>
        @if(count($brands) > 5)
           <a id="more_brand_list" style="cursor: pointer;">See More</a>
        @endif
      </div>
    </aside>
    <div class="ps-sticky" style="top: 0px;">
      <aside class="ps-widget--sidebar">
          <div class="ps-widget__header">
            <h3>Color</h3>
          </div>
          <div class="ps-widget__content">
            <ul class="ps-list--color">
              <?php  $colors = App\Color::all(); ?>
              @foreach($colors as $color)
                <li>
                  <label class="filter_p color" onclick="document.getElementById('filter_form').submit()">
                  <a class="color_link {{(request()->color == $color->slug) ? 'active_color' : ''}}" title="{{ucwords($major_category->title)}} in {{$color->color}} color" style="background-color: <?=$color->code?> !important;" >
                    <input type="radio" name="color" value="{{$color->slug}}" style="visibility: hidden;" {{(request()->color == $color->slug) ? 'checked' : ''}}>
                  </a>
                </li>
                </label>
              @endforeach
            </ul>
          </div>
      </aside>
      <div id="search_content" style="display: none;">
        <input type="hidden" id="bs_search_with_filter">
      </div>
       <aside class="ps-widget--sidebar">
        <a href="{{url('shop/'.$major_category->slug)}}" class="btn btn-default"><i class="fa fa-recycle"></i> Reset Filter</a>
      </aside>
    </div>
  </form>
</div>
@if($webview->isMobile())
  <div id="trigger"><i class="fa fa-filter"></i></div>
@endif