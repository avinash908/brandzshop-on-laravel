@extends('layouts.master')
@section('canonical', url("/","blog"))
@section('meta-description', 'How to buy original branded shoes in pakistan ...  just go for www.brandzshop.com.pk')
@section('meta-keywords', 'Buy internationla original branded products in pakistan')
@section('title', 'Brandzshop - Help how to buy original brandz shoes in pakistan')
@section('content')
<div class="ps-blog-grid pt-80 pb-80">
    <div class="ps-container">
      {{ Breadcrumbs::render('post',$post) }}
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
          <div class="ps-post--detail">
            <div class="ps-post__thumbnail">
            	<img src="{{url($post->image->url)}}" alt="">
            </div>
            <div class="ps-post__header">
              <h3 class="ps-post__title">{{ucwords($post->title)}}</h3>
             <p class="ps-post__meta">Posted by <a href="javascript:void(0)">{{ucfirst($post->user->name)}}</a> {{$post->created_at->format('M d, Y')}}</p>
            </div>
            <div class="ps-post__content">
              {!! $post->content !!}
            </div>
          </div>
          <div class="ps-comments">
            <h3>Comment({{$post->comments->count()}})</h3>
            @foreach($post->comments as $comment)
            <div class="ps-comment">
              <div class="ps-comment__thumbnail"><img src="{{url('images/user/',$comment->user->avatar)}}" alt=""></div>
              <div class="ps-comment__content">
                <header>
                  <h4>{{ucwords($comment->user->name)}} <span>{{($comment->created_at->format('h:i M d, Y'))}}</span></h4>
                </header>
                <p>{{$comment->body}}</p>
              </div>
            </div>
            @endforeach
          </div>
          <form class="ps-form--comment bs_form" action="{{route('comment.store',$post->id)}}" method="post">
            @csrf
            <h3>LEAVE A COMMENT</h3>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="form-group">
                  <textarea class="form-control" name="comment" rows="6" placeholder="Text your message here..." required></textarea>
                  @if($errors->has('comment'))
                    @foreach($errors->get('comment') as $message)
                      <span style="color:red">{{$message}}</span>
                    @endforeach
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group">
               @guest
                  <button type="button" class="ps-btn ps-btn--sm bs_form_btn bs_login_btn" >Submit<i class="ps-icon-next"></i></button>
              @else
                <button type="submit" class="ps-btn ps-btn--sm bs_form_btn">Submit<i class="ps-icon-next"></i></button>
              @endguest
            </div>
          </form>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
            <aside class="ps-widget--sidebar">
              <div class="ps-widget__header">
                <h3>Latest Posts</h3>
              </div>
              @foreach(App\Post::where('id','!=',$post->id)->latest()->limit(12)->get() as $p)
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