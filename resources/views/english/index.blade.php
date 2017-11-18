
@extends('english.layouts.default')
@section('content')
<!-- 列表 -->
@widget('navigation_bar')
@widget('carousel_banner',['type' => 'top_pic'])
<div class="container text-content">
    <div class="container">
        <div class="col-md-4 col-lg-4 col-sm-6  hidden-xs content-tz">
            <div class="content-tz-list">
                @php
                    $categoryRepository = app(App\Repositories\CategoryRepository::class);
                    $notice = $categoryRepository->findByCateName('通知公告');
                @endphp
                <div class="content-news-box">
                    <h2 class="title">
                        {!! $notice->cate_name !!}
                        <span>Notice</span>
                        <a {!! $notice->getPresenter()->linkAttribute() !!}>更多</a></h2>
                </div>
                <div class="notice-container">
                    <ul id="notice_bg" class="notice-list">
                        @forelse(Facades\App\Widgets\PostList::mergeConfig(['category'=>$notice])->getData()['posts'] as $post)
                        <li>
                            <a href="{!! $post->getPresenter()->url() !!}">{!! $post->title !!}</a>
                            <p>
                                <span><img src="{!! cdn('images/time.png') !!}"></span>
                                <span>{!! $post->created_at !!}</span>
                            </p>

                        </li>
                            @empty
                            <p class="no_data">暂无数据</p>
                            @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="container content-news col-md-8 col-lg-8 col-sm-l col-xs-12">
            @php
                $categoryRepository = app(App\Repositories\CategoryRepository::class);
                $new = $categoryRepository->findByCateName('学院要闻');
                $posts = Facades\App\Widgets\PostList::mergeConfig(['category'=>$new,'limit'=>4])->getData()['posts'];
            @endphp
            <div class="content-news-box">
                <h2 class="title">
                    {!! $new->cate_name !!}
                    <span>News</span>
                    <a {!! $new->getPresenter()->linkAttribute() !!}>更多</a></h2>
                <div class="content-news-main">
                    <div class="col-md-6 col-lg-6 hidden-sm hidden-xs content-news-right">
                        <ul class="content-list">
                            @forelse( $posts as $post)
                            <li><a href="{!! $post->getPresenter()->url() !!}">{!! $post->title !!}</a>
                                <p>
                                    <span><img src="{!! cdn('images/time.png') !!}"></span>
                                    <span>{!! $post->created_at !!}</span>
                                </p>
                            </li>
                            @empty
                                <p class="no_data">暂无数据</p>
                            @endforelse
                        </ul>
                    </div>
                    @if(count($posts)<1)
                        <p class="no_data">暂无数据</p>
                    @else
                        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 content-news-left">
                        <a href="{!! $posts->first()->getPresenter()->url() !!}"><img src="{!! image_url($posts->first()->cover) !!}" style="width: 100%;height: 170px;display: block"></a>
                        <a style="margin-top: 10px">{!! $posts->first()->title !!}</a>
                        <p class="desc">
                            {!! $posts->first()->excerpt !!}
                        </p>
                    </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 底部图片 -->
@widget('pic_link',['type' => 'friendship_links','limit'=>3])
<!-- 底部 -->
@endsection