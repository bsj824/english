@extends('english.layouts.default')
@section('content')
<!-- 头部 -->
@widget('navigation_bar')
    <div class=" container content-body">
        <div class="head">
            {{ Breadcrumbs::render('post', $post) }}
        </div>
        <div class="title-container">
            <h1>{!! $post->title !!}</h1>
            <p>
                <span>{!! $post->published_at->format('Y年m月d日')!!}</span>
                <span>
                     上传:{!! isset($post->user->nick_name)?$post->user->nick_name:$post->user->user_name !!}
                </span>
                <span>{!! $post->views_count !!}人阅读</span>
            </p>
        </div>
        <div class="body">
            <div class="content">
                <img src="{!! image_url($post->cover)!!}">
                {!! $post->postContent->content !!}
            </div>
        </div>
    </div>
<!-- 底部 -->
@endsection