@extends('english.layouts.default')
@section('content')
    @widget('navigation_bar')
    <!-- 头部 -->
<!-- 导航栏 -->
<!-- list -->
<div class="bg-tp">
    <div class="bg-text">
        <div class="mask"></div>
        <div class="text">
            <h2>学院概况</h2>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        @widget('navigation_sidebar')
        <div class="content-right hidden-xs col-lg-9 col-sm-9 col-md-9 ">
            <div class="right-header">
                    <ol class="breadcrumb">
                        {{ Breadcrumbs::render('category', $category) }}
                    </ol>
            </div>
            <div class="right-main">
                <p style="margin-top: 10px">
                    {!! $page->postContent->content !!}
                </p>
            </div>
        </div>
    </div>

</div>
<!-- 底部 -->
@endsection
@section('js')
    <script type="text/javascript" src="{{cdn('lib/respond/respond.min.js')}}"></script>
    <script type="text/javascript" src="{{cdn('lib/es5/es5-sham.min.js')}}"></script>
    <script type="text/javascript" src="{{cdn('lib/es5/es5-shim.min.js')}}"></script>
    <script type="text/javascript" src="{{cdn('lib/html5shiv/html5.min.js')}}"></script>
@endsection