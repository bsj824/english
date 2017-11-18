<div class="friendship-link">
    <h2 class="footer-content-title">友情链接</h2>
    @foreach($links as $link)
    <ul class="friendship-link-content">
        <li><a href="{!! $link->url !!}" target="_blank">{!! $link->name !!}</a></li>
    </ul>
    @endforeach
</div>