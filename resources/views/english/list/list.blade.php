@extends('english.layouts.default')
@section('content')
    @widget('navigation_bar')
    @widget('pic_text')
<div class="content">
    <div class="container">
        @widget('navigation_sidebar')
        <div class="content-right hidden-xs col-lg-9 col-sm-9 col-md-9 ">
            <div class="right-header">
                {{ Breadcrumbs::render('category', $category) }}
                <ul class="list">
                    @forelse($posts as $post)
                    <li>
                        @if(!is_null(image_url($post->cover)))
                            <a class="cover" href="{!! $post->getPresenter()->url() !!}">
                                 <img src="{!!image_url( $post->cover) !!}"/>
                            </a>
                        @endif
                            <div @if(!is_null(image_url($post->cover))) class="info" @else class="info no_img" @endif>
                                        <a href="{!! $post->getPresenter()->url() !!}">
                                            <h3>
                                                @if($post->isTop())
                                                <span class="label label-danger">置顶</span>
                                                @endif
                                                {!! $post->title !!}
                                            </h3>
                                        </a>
                            <p class="describe">{!! $post->excerpt !!}</p>
                            <div class="list-footer">
                                <p class="time">{!! $post->created_at !!}</p>
                            </div>
                        </div>

                    </li>

                        @empty
                        <p class="no_data">暂无数据</p>
                    @endforelse
                </ul>
            </div>
            {!! $posts->fragment('list')->links() !!}
        </div>
    </div>
</div>

<!-- 底部 -->
@endsection
@section('js')
    <script type="text/javascript" src="{{cdn('lib/slick/slick.min.js')}}"></script>
    <script type="text/javascript" src="{{cdn('lib/respond/respond.min.js')}}"></script>
    <script type="text/javascript" src="{{cdn('lib/es5/es5-sham.min.js')}}"></script>
    <script type="text/javascript" src="{{cdn('lib/es5/es5-shim.min.js')}}"></script>
    <script type="text/javascript" src="{{cdn('lib/html5shiv/html5.min.js')}}"></script>
    @endsection
