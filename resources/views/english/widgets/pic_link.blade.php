<div class="some-pic">
    <div class="container">
        <ul class="some-pic-box">
            @foreach($links as $link)
            <li class="col-md-4 col-lg-4 col-sm-4 col-xs-6">
                <a href="{!! $link->url !!}" class="img-wrapper">
                    <img src="{!! image_url($link->logo) !!}" alt="">
                    <div class="box">
                        <div class="mask"></div>
                        <div class="box2">
                            <h2>{!! $link->name !!}</h2>
                        </div>
                    </div>
                </a>
            </li>
                @endforeach
        </ul>
    </div>
</div>