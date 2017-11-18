<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>
        外国语学院语言实践中心
    </title>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{cdn('lib/es5/es5-sham.min.js')}}"></script>
    <script type="text/javascript" src="{{cdn('lib/es5/es5-shim.min.js')}}"></script>
    <script type="text/javascript" src="{{cdn('lib/respond/respond.min.js')}}"></script>
    <script type="text/javascript" src="{{cdn('lib/html5shiv/html5.min.js')}}"></script>
    <![endif]-->
    <link rel="stylesheet" href="{{cdn('lib/slick/slick.min.css')}}">
    <link rel="stylesheet" href="{{cdn('lib/slick/slick-theme.min.css')}}">
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{cdn('css/comm.css')}}" rel="stylesheet">
</head>
<body>
<!-- 头部 -->

<!-- 导航栏 -->

@yield('content')
<div class="footer">
    <div class="container">
        <div class="footer-container">
            @widget('link', ['type' => 'friendship_links'])
            <div class="contact-us">
                <h2 class="footer-content-title">联系我们</h2>
                <ul class="contact-us-content">
                    <li>{!! setting('school_name') !!}</li>
                    <li>联系人：{!! setting('link_man') !!}</li>
                    <li>联系方式：{!! setting('link_phone') !!}</li>
                    <li>E-mail：{!! setting('e_mail') !!}</li>
                </ul>
            </div>
            <img src="{{cdn('images/footer-logo.png')}}" >
        </div>
    </div>
</div>
<div id="buttom">
    <div class="container">
        <span>Powered by E8网络工作室</span>
    </div>
</div>

<script src="{{cdn('lib/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{cdn('lib/slick/slick.min.js')}}"></script>
@yield('js')
<script type="text/javascript">
    // 轮播图
    $(function () {
        var $banner = $("#banner");
        if($banner.children().length == 0)
            return;
        $banner.slick({
            dots: true,
            infinite: true,
            centerMode: true,
            variableWidth: true,
            autoplay: true,
            autoplaySpeed: 5000,
            slidesToShow: 3,
            slidesToScroll: 3,
            arrows: false
        });
    })

    var headNavListItem = $('.container-nav>ul>li');
    headNavListItem.hover(function(){
        var child = $(this).find('.content');
        child.show();
        child.stop().animate({
            top: 60,
            opacity: 1
        }, 100)
    }, function(){
        var child = $(this).find('.content');
        child.stop().animate({
            top: 90,
            opacity: 0
        }, 100, function(){
            if(child.css('top') == '90px'){
                child.css('display', 'none');
            }
        });
        //通知公告
    })
    $(function (){
        var $notice = $('#notice_bg');
        setInterval(function () {
            $notice.animate({
                top: '-70px'
            }, 500, function () {
                $notice.append($notice.children().first());
                $notice.css('top', 0);
            })
        }, 3000)
    });
</script>
</body>
</html>