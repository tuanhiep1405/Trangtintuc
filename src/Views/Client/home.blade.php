@extends('layouts.master')
@section('content')
    <!-- Page Title Start -->
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="active">Home</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page title end -->
    <!-- Feature start 1 -->
    <section class="utf_featured_post_area pt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 pad-r">
                    <div id="utf_featured_slider" class="owl-carousel owl-theme utf_featured_slider content-bottom">
                        @foreach ($top3HotOnSocial as $item)
                            <div class="item"
                                style="
                                    background-image: url(/assets/{{ $item['image'] }});
                                ">
                                <div class="utf_featured_post">
                                    <div class="utf_post_content">
                                        <a
                                            class="utf_post_cat"
                                            href="/detail-category/{{ $item['idCategory'] }}"
                                        >
                                            {{ $item['nameCategory'] }}
                                        </a>
                                        <h2 class="utf_post_title title-extra-large">
                                            <a href="/detail-post/{{ $item['id'] }}">{{ $item['title'] }}</a>
                                        </h2>
                                        <span class="utf_post_author"><i class="fa fa-user"></i>
                                            <a href="#!">{{ $item['nameAuthor'] }}</a></span>
                                        <span class="utf_post_date">
                                            <i class="fa fa-clock-o"></i>
                                            {{ $item['date'] }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 pad-l">
                    <div class="row">
                        @foreach ($top2Hot as $item)
                            <div class="col-md-12">
                                <div class="utf_post_overaly_style text-center first clearfix">
                                    <div class="utf_post_thumb">
                                        <a href="#!"><img class="img-fluid" src="/assets/{{ $item['image'] }}" alt="image new" /></a>
                                    </div>
                                    <div class="utf_post_content">
                                        <a
                                            class="utf_post_cat"
                                            href="/detail-category/{{ $item['idCategory'] }}"
                                        >
                                            {{ $item['nameCategory'] }}
                                        </a>
                                        <h2 class="utf_post_title title-medium">
                                            <a href="/detail-post/{{ $item['id'] }}">{{ $item['title'] }}</a>
                                        </h2>
                                        <div class="utf_post_meta">
                                            <span class="utf_post_author"><i class="fa fa-user"></i>
                                                <a href="#!">{{ $item['nameAuthor'] }}</a></span>
                                            <span class="utf_post_date"><i class="fa fa-clock-o"></i>{{ $item['date'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Feature area end -->

    <!-- 3rd Block Wrapper Start -->
    <section class="utf_block_wrapper p-bottom-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="utf_more_news block color-default">
                        <h3 class="utf_block_title"><span>News Of The Day</span></h3>
                        <div id="utf_more_news_slide" class="owl-carousel owl-theme utf_more_news_slide">
                            {{-- mỗi item là 1 trang --}}
                            @foreach ($newsOfTheDay as $items)
                                <div class="item">
                                    @foreach ($items as $item)
                                        <div class="utf_post_block_style utf_post_float_half clearfix">
                                            <div class="utf_post_thumb">
                                                <a href="!#">
                                                    <img
                                                        class="img-fluid"
                                                        src="/assets/{{ $item['image'] }}"
                                                        alt="image new"
                                                    />
                                                </a>
                                            </div>
                                            <a class="utf_post_cat" href="#!">{{ $item['nameCategory'] }}</a>
                                            <div class="utf_post_content">
                                                <h2 class="utf_post_title">
                                                    <a href="/detail-post/{{ $item['id'] }}">{{ $item['title'] }}</a>
                                                </h2>
                                                <div class="utf_post_meta">
                                                    <span class="utf_post_author">
                                                        <i class="fa fa-user"></i>
                                                        <a href="#!">{{ $item['nameAuthor'] }}</a>
                                                    </span>
                                                    <span class="utf_post_date"><i class="fa fa-clock-o"></i>{{ $item['date'] }}</span>
                                                </div>
                                                <p>{{ $item['description'] }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="sidebar utf_sidebar_right">
                        <div class="widget color-default">
                            <h3 class="utf_block_title"><span>Popular News</span></h3>
                                @php
                                    $newViewHighest = array_shift($top9NewPopular);
                                @endphp
                                <div class="utf_post_overaly_style clearfix">
                                    <div class="utf_post_thumb">
                                        <a href="!#">
                                            <img
                                                class="img-fluid"
                                                src="/assets/{{ $newViewHighest['image'] }}"
                                                alt="image new"
                                            />
                                        </a>
                                    </div>
                                    <div class="utf_post_content">
                                        <a
                                            class="utf_post_cat"
                                            href="/detail-category/{{ $newViewHighest['idCategory'] }}"
                                        >
                                            {{ $newViewHighest['nameCategory'] }}
                                        </a>
                                        <h2 class="utf_post_title">
                                            <a href="/detail-post/{{ $newViewHighest['id'] }}">{{ $newViewHighest['title'] }}</a>
                                        </h2>
                                        <div class="utf_post_meta">
                                            <span class="utf_post_author"><i class="fa fa-user"></i>
                                                <a href="!#">{{ $newViewHighest['nameAuthor'] }}</a></span>
                                            <span class="utf_post_date">
                                                <i class="fa fa-clock-o"></i>
                                                {{ $newViewHighest['date'] }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            <div class="utf_list_post_block">
                                <ul class="utf_list_post">
                                    @foreach ($top9NewPopular as $item)
                                        <li class="clearfix">
                                            <div class="utf_post_block_style post-float clearfix">
                                                <div class="utf_post_thumb">
                                                    <a href="!#">
                                                        <img
                                                            class="img-fluid"
                                                            src="/assets/{{ $item['image'] }}"
                                                            alt="image new"
                                                        />
                                                    </a>
                                                    <a
                                                        class="utf_post_cat"
                                                        href="/detail-category/{{ $item['idCategory'] }}"
                                                    >
                                                        {{ $item['nameCategory'] }}
                                                    </a>
                                                </div>
                                                <div class="utf_post_content">
                                                    <h2 class="utf_post_title title-small">
                                                        <a href="/detail-post/{{ $item['id'] }}">{{ $item['title'] }}</a>
                                                    </h2>
                                                    <div class="utf_post_meta">
                                                        <span class="utf_post_author">
                                                            <i class="fa fa-user"></i>
                                                            <a href="!#">{{ $item['nameAuthor'] }}</a>
                                                        </span>
                                                        <span class="utf_post_date">
                                                            <i class="fa fa-clock-o"></i>
                                                            {{ $item['date'] }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- 3rd Block Wrapper End -->
@endsection

@section('js')

    <script>
        const thongBao =
        `@php
            echo isset($_GET['thongbao']) ? $_GET['thongbao'] : false
        @endphp`;

        if(thongBao) {
            window.addEventListener('load', function() {
                alert(thongBao);
                
                setTimeout(() => {
                    const url = new URL(window.location);
                    url.searchParams.delete('thongbao');
                    window.history.pushState(null, '', url);
                }, 1);
            });
        }
    </script>
    
@endsection
