<section class="zm-link zm-wrap">
    <header class="zm-title">
        <h3>友情链接</h3>
        <div class="line"></div>
    </header>
    <div class="container">
        @foreach($links as $link)
            <a class="link-item col-md-2 col-lg-2 col-sm-6 col-xs-6" href="{!! $link->url !!}"  title="{!! $link->name !!}" target="_blank"><img src="{!! image_url($link->logo) !!}" alt="{!! $link->name !!}"></a>
        @endforeach
    </div>
</section>