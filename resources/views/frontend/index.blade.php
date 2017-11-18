@extends('frontend.layouts.default')

@section('keywords'){{ setting('default_keywords') }}@endsection

@section('description'){{ setting('default_description') }}@endsection

@section('title'){{ setting('site_name') }}@endsection

@section('content')
    @include('frontend.layouts.particals.navigation_bar')
    <header class="big-pic" style="background-image: url({{cdn('static/images/big_image.jpg')}})" id="big-pic">
        <div class="zm-txt">
            <div class="zm-work">
                Web Design - Web Development - UX Design
                <div class="line"></div>
            </div>
            <h2 class="zm-title">
                一群有趣的年轻人,<br/>
                追寻开发中的乐趣
            </h2>
        </div>
        <div class="mouse-icon">
            <div class="wheel"></div>
        </div>
    </header>
    <section class="zm-introduce zm-wrap">
        <div class="container">
            <header class="zm-title">
                <h3>{{ setting('site_name') }}</h3>
                <div class="line"></div>
                <p>创造不息，交付不止</p>
            </header>
            <p class="text">{{ setting('intro') }}</p>
        </div>
    </section>
    @php
        $categoryRepository = app(App\Repositories\CategoryRepository::class);
        $projectCaseCategory = $categoryRepository->findByCateName('项目案例');
    @endphp
    <section data-id="case" class="zm-case zm-wrap">
        <div class="container">
            <header class="zm-title">
                <h3>{!! $projectCaseCategory->cate_name !!}</h3>
                <div class="line"></div>
                <p>{!! $projectCaseCategory->description !!}</p>
            </header>
            @foreach(Facades\App\Widgets\PostList::mergeConfig(['category'=>$projectCaseCategory])->getData()['posts'] as $post)
                <div class="col-md-4 col-lg-3 col-sm-6 col-xs-6 case-item">
                    <div class="main">
                        <div class="img-wrap">
                            <img lazy src="{!! image_url($post->cover, 'case_cover') !!}">
                        </div>
                        <div class="body">
                            <h4>{!! $post->getPresenter()->suitedTitle() !!}</h4>
                            <p>{!! $post->excerpt !!}</p>
                            <div class="footer">
                                @foreach($post->tags as $tag)
                                    <span class="tag">{!! $tag->name !!}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    @php
        $newsCategory = $categoryRepository->findByCateName('新闻中心');
    @endphp
    <section data-id="news" class="zm-news zm-wrap">
        <div class="container">
            <header class="zm-title">
                <h3>{!! $newsCategory->cate_name !!}</h3>
                <div class="line"></div>
                <p>{!! $newsCategory->description !!}</p>
            </header>
            @foreach(Facades\App\Widgets\PostList::mergeConfig(['category'=>$newsCategory])->getData()['posts'] as $post)
                <div class="col-md-4 col-lg-4 col-sm-6 col-xs-6 news-item">
                    <div class="news-main">
                        <a href="{!! $post->getPresenter()->url() !!}" target="_blank" title="{!! $post->title !!}">
                            <div class="img-wrap">
                                <img lazy src="{!! image_url($post->cover, 'news_cover') !!}">
                            </div>
                        </a>
                        <a href="{!! $post->getPresenter()->url() !!}" target="_blank" class="title"
                           title="{!! $post->title !!}">
                            <h4>{!! $post->getPresenter()->suitedTitle() !!}</h4>
                        </a>
                        <div class="line"></div>
                        <p>{!! $post->excerpt !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="button_wrap">
            <a class="btn more_btn"{!! $newsCategory->getPresenter()->linkAttribute() !!}>查看更多<i
                        class="glyphicon glyphicon-chevron-right"></i></a>
        </div>
    </section>

    @php
        $teamCategory = $categoryRepository->findByCateName('我们的团队');
    @endphp
    <section data-id="team" class="zm-team zm-wrap">
        <div class="container">
            <header class="zm-title white">
                <h3>{!! $teamCategory->cate_name !!}</h3>
                <div class="line"></div>
                <p>{!! $teamCategory->description !!}</p>
            </header>
            <div id="teams">
                @foreach(Facades\App\Widgets\PostList::mergeConfig(['category'=>$teamCategory])->getData()['posts'] as $post)
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
                @endforeach
            </div>
        </div>
        <div class="button_wrap">
            <a class="btn more_btn"{!! $teamCategory->getPresenter()->linkAttribute() !!}>查看更多<i class="glyphicon glyphicon-chevron-right"></i></a>
        </div>
    </section>

    <section data-id="skill" class="zm-skill zm-wrap">
        <header class="zm-title">
            <h3>WE GOT SKILLS</h3>
        </header>
        <div class="container skills">
            @foreach(Facades\App\Widgets\Link::mergeConfig(['type'=>'skill'])->getData()['links'] as $link)
                <a href="{!! $link->url !!}" title="{!! $link->name !!}" target="_blank"><img
                            lazy src="{!! image_url($link->logo) !!}" alt="{!! $link->name !!}"></a>
            @endforeach
        </div>
    </section>

    <section data-id="contact" class="zm-contact zm-wrap">
        <header class="zm-title">
            <h3>联系我们</h3>
            <div class="line"></div>
        </header>
        <div class="container">
            <p class="contact-item">邮箱：{{ setting('email') }}</p>
            <p class="contact-item">QQ：{{ setting('qq') }}</p>
            <p class="contact-item">地址：{{ setting('address') }}</p>
            <div class="contact-link">
                @foreach(Facades\App\Widgets\Link::mergeConfig(['type'=>'contact_us', 'limit'=>5])->getData()['links'] as $link)
                    <a href="{!! $link->url !!}" title="{!! $link->name !!}" target="_blank"><img
                                lazy src="{!! image_url($link->logo, 'avatar_xs') !!}"
                                alt="{!! $link->name !!}"><span>{!! $link->name !!}</span></a>
                @endforeach
            </div>
        </div>
    </section>


    @widget('link', ['type' => 'friendship_link'])

    <section data-id="join">
        <div class="zm-join" id="particles-js">
            <div class="text">
                <h3>加入我们</h3>
                <p>如果你喜欢这样的我们，请发送简历到 {{ setting('hr_email') }}</p>
            </div>
            <footer class="copy">&copy;{!! date('Y') !!} {{ setting('site_name') }} 版权所有 [{{ setting('record_number') }}]</footer>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(function () {
            var $bigPic = $('#big-pic');
            var $window = $(window);
            $window.resize(function () {
                $bigPic.height($(this).height());
            });
            $window.resize();
            var $nav = $('#nav');
            $window.scroll(function () {
                if ($window.scrollTop() > $bigPic.height()) {
                    $nav.addClass('small')
                } else {
                    $nav.removeClass('small')
                }
            });
            var $htmlBody = $('html,body');
            window.addEventListener('hashchange', function(e) {
                var target = $('[data-id=' + location.hash.substr(1) + ']');
                if (target.length != 0) {
                  $htmlBody.animate({
                      scrollTop: target.offset().top - 60
                  }, 300);
                }
            });
            if (location.hash.length > 0) {
              var target = $('[data-id=' + location.hash.substr(1) + ']');
              if(target.length != 0) {
                $htmlBody.scrollTop(target.offset().top - 60);
              }
            }
        });
        $(function () {
            $teams = $('#teams');
            if ($teams.children().length == 0)
                return;
            $teams.slick({
                dots: true,
                infinite: true,
                centerMode: true,
                variableWidth: true,
                autoplay: true,
                autoplaySpeed: 5000,
                slidesToShow: 3,
                slidesToScroll: 3,
                arrows: true
            });
        })
        $(function () {
            particlesJS('particles-js', {
                "particles": {
                    "number": {
                        "value": 80,
                        "density": {
                            "enable": true,
                            "value_area": 800
                        }
                    },
                    "color": {
                        "value": "#ffffff"
                    },
                    "shape": {
                        "type": "polygon",
                        "stroke": {
                            "width": 0,
                            "color": "#000000"
                        },
                        "polygon": {
                            "nb_sides": 5
                        },
                        "image": {
                            "src": "img/github.svg",
                            "width": 100,
                            "height": 100
                        }
                    },
                    "opacity": {
                        "value": 0.5,
                        "random": false,
                        "anim": {
                            "enable": false,
                            "speed": 1,
                            "opacity_min": 0.1,
                            "sync": false
                        }
                    },
                    "size": {
                        "value": 3,
                        "random": true,
                        "anim": {
                            "enable": false,
                            "speed": 40,
                            "size_min": 0.1,
                            "sync": false
                        }
                    },
                    "line_linked": {
                        "enable": true,
                        "distance": 150,
                        "color": "#ffffff",
                        "opacity": 0.4,
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": 3,
                        "direction": "none",
                        "random": false,
                        "straight": false,
                        "out_mode": "out",
                        "bounce": false,
                        "attract": {
                            "enable": false,
                            "rotateX": 600,
                            "rotateY": 1200
                        }
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": true,
                            "mode": "repulse"
                        },
                        "onclick": {
                            "enable": true,
                            "mode": "push"
                        },
                        "resize": true
                    },
                    "modes": {
                        "grab": {
                            "distance": 400,
                            "line_linked": {
                                "opacity": 1
                            }
                        },
                        "bubble": {
                            "distance": 400,
                            "size": 40,
                            "duration": 2,
                            "opacity": 8,
                            "speed": 3
                        },
                        "repulse": {
                            "distance": 200,
                            "duration": 0.4
                        },
                        "push": {
                            "particles_nb": 4
                        },
                        "remove": {
                            "particles_nb": 2
                        }
                    }
                },
                "retina_detect": false
            });
        });
    </script>
@endsection
