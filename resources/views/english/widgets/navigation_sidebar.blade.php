<div class="content-left hidden-xs col-lg-3 col-sm-3 col-md-3 ">
    <h2>{!! $navigation->getActiveTopNav()->cate_name !!}</h2>
    <ul>
        @foreach($navigation->getActiveChildrenNav() as $childNav)
            <li><a {!! $childNav->getPresenter()->linkAttribute() !!} @if($childNav->is($navigation->getActiveNav())) class="active" @endif class="one">{!! $childNav->cate_name !!}</a></li>
        @endforeach
    </ul>
</div>