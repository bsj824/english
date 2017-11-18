@extends('frontend.layouts.default')

@section('keywords'){!! $post->getKeywords() !!}@endsection

@section('description'){{ $post->getDescription() }}@endsection

@section('title'){{ Breadcrumbs::pageTitle(' - ', 'post', $post) }}@endsection

@section('content')
    @include('frontend.layouts.particals.navigation_bar', ['normalPage'=>true])
    <div class="content">
        <div class="title-image">
            <img lazy src="{!! image_url($post->cover) !!}">
        </div>
        <h1 class="title">{!! $post->title !!}</h1>
        <div class="info">
            <span class="author">
                <img lazy class="avatar"
                     src="{!! image_url($post->user->avatar, 'avatar_xs', cdn('static/images/default_avatar.jpg')) !!}">
                {!! isset($post->user->nick_name)?$post->user->nick_name:$post->user->user_name !!}
            </span>
            <span class="time">{!! $post->published_at->format('Y 年 m 月 d 日') !!}</span>
        </div>
        <div class="body">{!! $post->postContent->content !!}</div>
    </div>
    @include('frontend.layouts.particals.footer', ['contentPage'=>true])
@endsection

@section('css')
    <style>
        body {
            background-color: #fff;
        }
    </style>
@endsection