@php
$homeUrl = route('frontend.web.index');
@endphp
@push('js')
<script>
    $(function () {
        var $menuXs = $('#menu-xs');
        $('#btn-toggle').click(function(){
            $menuXs.toggle();
        });
    })
</script>
@endpush
<nav class="nav{!! isset($normalPage)?' small':'' !!}" id="nav">
    <div class="container">
        <div class="logo">
            <a href="{!! $homeUrl !!}">{{ setting('site_name') }}</a>
        </div>
        <ul class="menu">
            <li><a href="{!! $homeUrl !!}">首页</a></li>
            <li><a href="{!! $homeUrl !!}#case">案例</a></li>
            <li><a href="{!! $homeUrl !!}#news">新闻</a></li>
            <li><a href="{!! $homeUrl !!}#team">团队</a></li>
            <li><a href="{!! $homeUrl !!}#skill">技术栈</a></li>
            <li><a href="{!! $homeUrl !!}#contact">联系我们</a></li>
            <li><a href="{!! $homeUrl !!}#join">加入我们</a></li>
        </ul>
        <button type="button" id="btn-toggle" class="navbar-toggle collapsed">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <ul id="menu-xs" class="menu-xs">
            <li><a href="{!! $homeUrl !!}">首页</a></li>
            <li><a href="{!! $homeUrl !!}#case">案例</a></li>
            <li><a href="{!! $homeUrl !!}#news">新闻</a></li>
            <li><a href="{!! $homeUrl !!}#team">团队</a></li>
            <li><a href="{!! $homeUrl !!}#skill">技术栈</a></li>
            <li><a href="{!! $homeUrl !!}#contact">联系我们</a></li>
            <li><a href="{!! $homeUrl !!}#join">加入我们</a></li>
        </ul>
    </div>
    <div class="mask"></div>
</nav>
