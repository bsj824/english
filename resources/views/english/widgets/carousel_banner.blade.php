<!-- 轮播图 -->
@php
    //TODO 当banner小于4个时前端轮播图会出现问题，因此在这里手动复制一个banner
    $count = $banners->count();
    if($count < 4){
        for ($i = 1; $i <= 4-$count; $i++) {
            $banners->push($banners[$i-1]);
        }
    }
@endphp
<div class="banner" id="banner">
    @foreach($banners as $banner)
        <div>
            @if(is_null($banner->url))
            <a title="{{ $banner->title or '' }}"  target="_blank">
                <img lazy src="{!! image_url($banner->image) !!}">
            </a>
                @else
                    <a title="{{ $banner->title or '' }} " href="{!! $banner->url !!}"  target="_blank">
                        <img lazy src="{!! image_url($banner->image) !!}">
                    </a>
                        @endif
        </div>
    @endforeach
</div>