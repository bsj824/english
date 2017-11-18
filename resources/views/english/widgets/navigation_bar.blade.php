<div class="head-nav">
    <div class="container">
        <div class="header">
            <div class="head-left">
                <a href="{!! route('frontend.web.index')!!}">
                <img src="{{cdn('images/footer-logo.png')}}">
                </a>
                <h3>外国语学院语言实践中心</h3>
                <p>Language Practice Center</p>
            </div>
            <div class="head-right">
                <div class="search">
                    <form action="{{route('frontend.web.search')}}" id="search-form">
                        <input type="text" name="keywords" id="search-input" placeholder="请输入关键字搜索...">
                        <i id="icon" ></i>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="nav">
    <div class="container">
        <div class="container-nav">
            <ul>
                <li {!! is_null($navigation->getActiveTopNav())?' class="active"':'' !!}>
                    <a href="{!! route('frontend.web.index')!!}">网站首页</a>
                </li>
                @foreach($allNav as $category)
                <li {!! $category->equals($navigation->getActiveTopNav()) ?' class="active"':'' !!} >
                    <a {!! $category->getPresenter()->linkAttribute() !!} >{!! $category->cate_name !!}</a>
                    @if($category->hasChildren())
                    <ul class="content">
                        @foreach($category->children as $children)
                        <li><a {!! $children->getPresenter()->linkAttribute() !!}>{!! $children->cate_name !!}</a></li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
