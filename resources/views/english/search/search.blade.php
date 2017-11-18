@extends('english.layouts.default')
@section('content')
    @widget('navigation_bar')
    <div class="bg-tp">
        <div class="bg-text">
            <div class="mask"></div>
            <div class="text">
                <h2>规章制度</h2>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="content-left hidden-xs col-lg-3 col-sm-3 col-md-3 ">
                <h2>搜索</h2>
            </div>
            <div class="content-right hidden-xs col-lg-9 col-sm-9 col-md-9 ">
                <div class="right-header">
                    <ol class="breadcrumb">
                        {{ Breadcrumbs::view('english.layouts.search_breadcrumbs', 'search', $keyword)}}
                    </ol>
                    <ul class="list">
                        @foreach($posts as $post)
                            <li>
                                <a class="cover" href="http://211.70.176.153/category/education-teach/post/537">
                                    <img src="http://211.70.176.153/pic/a301fbd23c6ced351605a1e5964afa0b_cover_sm"/>
                                </a>
                                <div class="info">
                                    <a href="http://211.70.176.153/category/education-teach/post/537">
                                        <h3>{!! sign_color($post->title, $keyword, config('tiny.keywords_color')) !!}</h3>
                                    </a>

                                    <p class="describe">{!! sign_color($post->excerpt, $keyword, config('tiny.keywords_color')) !!}</p>

                                    <div class="list-footer">
                                        <p class="time">{!! $post->created_at !!}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
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
