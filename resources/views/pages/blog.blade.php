@extends('layouts.master')
@section('canonical', url("/","blog"))
@section('meta-description', 'How to buy original branded shoes in pakistan ...  just go for www.brandzshop.com.pk')
@section('meta-keywords', 'Buy internationla original branded products in pakistan')
@section('title', 'Brandzshop - Help how to buy original brandz shoes in pakistan')
@section('content')
<div class="ps-blog-grid pt-80 pb-80">
  <div class="ps-container">
    {{ Breadcrumbs::render('blog') }}
    <div class="row">
          <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
            @foreach($posts as $post)
            <div class="ps-post--2">
              <div class="ps-post__thumbnail">
                <a class="ps-post__overlay" href="{{url('post/'.$post->slug)}}"></a>
                <img src="{{url($post->image->url)}}" alt="">
              </div>
              <div class="ps-post__container">
                <header class="ps-post__header"><a class="ps-post__title" href="{{url('post/'.$post->slug)}}">{{ucwords($post->title)}}</a>
                  <p>Posted by <a href="javascript:void(0)">{{ucfirst($post->user->name)}}</a> {{$post->created_at->format('M d, Y')}}</p>
                </header>
                <div class="ps-post__content bs_post_short_desc bs_post_text">
                  {{ str_replace('&nbsp;', ' ', str_limit(strip_tags($post->content),200,'...')) }}
                </div>
                <footer class="ps-post__footer"><a class="ps-post__morelink" href="{{url('post/'.$post->slug)}}">READ MORE<i class="ps-icon-arrow-left"></i></a>
                  <div class="ps-post__actions"><span><i class="fa fa-comments"></i> {{$post->comments->count()}} Comments</span>
                  </div>
                </footer>
              </div>
            </div>
            @endforeach
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
            <aside class="ps-widget--sidebar">
              <div class="ps-widget__header">
                <h3>Popular Posts</h3>
              </div>
              @foreach(App\Post::orderByViews()->get() as $p)
              <div class="ps-widget__content">
                <div class="ps-post--sidebar">
                  <div class="ps-post__thumbnail"><a href="{{url('/post',$p->slug)}}"></a><img src="{{url('/',$p->image->url)}}" alt=""></div>
                  <div class="ps-post__content"><a class="ps-post__title" href="{{url('/post',$p->slug)}}">{{$p->title}}</a><span>{{$p->created_at->format('M d, Y')}}</span></div>
                </div>
              @endforeach
              </div>
            </aside>
          </div>
    </div>
  </div>
</div>
@endsection