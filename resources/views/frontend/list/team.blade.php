@extends('frontend.layouts.default')

@section('keywords'){!! $category->getKeywords() !!}@endsection

@section('description'){!! $category->getDescription() !!}@endsection

@section('title'){{ Breadcrumbs::pageTitle(' - ', 'category', $category) }}@endsection

@section('content')
    @include('frontend.layouts.particals.navigation_bar', ['normalPage'=>true])
    <div class="container zm-team team-list">
        @forelse($posts as $post)
            @if($loop->index % 4 == 0)
                <div class="col">
            @endif
            <div class="team-item">
                <div class="team-main">
                    <div class="avatar">
                        <img lazy src="{!! image_url($post->cover, 'avatar_md') !!}">
                    </div>
                    <h4>{!! $post->title !!}</h4>
                    <div class="tags">
                        @foreach($post->tags as $tag)
                            <span class="tag">{!! $tag->name !!}</span>
                        @endforeach
                    </div>
                    <p class="info">{!! $post->excerpt !!}</p>
                </div>
            </div>
            @if($loop->index % 4 == 3||$loop->last)
                </div>
            @endif
        @empty
            <div class="no-data">暂无文章</div>
        @endforelse

    </div>
@endsection