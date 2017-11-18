@extends('frontend.layouts.default')

@section('keywords'){!! $category->getKeywords() !!}@endsection

@section('description'){!! $category->getDescription() !!}@endsection

@section('title'){{ Breadcrumbs::pageTitle(' - ', 'category', $category) }}@endsection

@section('content')
    @include('frontend.layouts.particals.navigation_bar', ['normalPage'=>true])
    <div class="list-content">
        @forelse($posts as $post)
            <div class="news-item{!! $post->isTop()?' top':'' !!}">
                <a href="{!! $post->getPresenter()->url() !!}" target="_blank">
                    <div class="left">
                        <div class="time">{!! $post->published_at->format('Y 年 m 月 d 日') !!}</div>
                        <h3>{!! $post->title !!}</h3>
                        <span class="author">
                            <img lazy class="avatar"
                                 src="{!! image_url($post->user->avatar, 'avatar_xs', cdn('static/images/default_avatar.jpg')) !!}">
                            {!! isset($post->user->nick_name)?$post->user->nick_name:$post->user->user_name !!}
                        </span>
                    </div>
                    @if(!is_null($post->cover))
                        <div class="img-wrap" style="background-image: url('{!! image_url($post->cover, 'list_news_cover') !!}');"></div>
                    @endif
                </a>
            </div>
        @empty
            <div class="no-data">暂无文章</div>
        @endforelse
    </div>
    {{--分页--}}
    {!! $posts->fragment('list')->links() !!}
    @include('frontend.layouts.particals.footer')
@endsection
