@extends('english.layouts.default')
@section('content')
<!-- 头部 -->
@widget('navigation_bar')
@widget('pic_text')
<div class="content">
    <div class="container">
        @widget('navigation_sidebar')
        <div class="content-right hidden-xs col-lg-9 col-sm-9 col-md-9 ">
            <div class="right-header">
                {{ Breadcrumbs::render('category', $category) }}
            </div>
            <div class="right-main">
               <ul class="main-list">
                   @forelse($posts as $post)
                       <li>
                           <a href="{!! $post->getPresenter()->url() !!}">
                               <img src="{!! image_url($post->cover) !!}" alt="{!! $post->title !!}">
                               <h2>{!! $post->title !!}</h2>
                           </a>
                       </li>
                       @empty
                           <p class="no_data">暂无数据</p>
                       @endforelse
               </ul>
                {!! $posts->fragment('list')->links() !!}

            </div>
        </div>
    </div>

</div>
@endsection