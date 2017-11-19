// 导航
	$('.hid').hover(function(){
		$(this).find('.sub-nav').stop().slideToggle(300);
	}, function(){
		$(this).find('.sub-nav').stop().slideToggle(300);
	})
//  返回顶部
	 var $backToTopTxt = "返回顶部", $backToTopEle = $('<div class="backToTop"></div>').appendTo($("body"))
        .text($backToTopTxt).attr("title", $backToTopTxt).click(function() {
            $("html, body").animate({ scrollTop: 0 }, 1000);
    }), $backToTopFun = function() {
        var st = $(document).scrollTop(), winh = $(window).height();
        (st > 0)? $backToTopEle.show(): $backToTopEle.hide();
        //IE6下的定位
        if (!window.XMLHttpRequest) {
            $backToTopEle.css("top", st + winh - 166);
        }
    };
    $(window).bind("scroll", $backToTopFun);
    $(function() { $backToTopFun(); });

// 首页通知公告滚动
	var $notice=$('#listbox')
		setInterval(function(){
			$notice.animate({
				top:'-40px'
			},300,function(){
				$notice.append($notice.children().first());
				$notice.css('top',0);
			})
		},2000)