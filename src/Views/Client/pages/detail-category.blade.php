@extends('layouts.master')

@section('content')
    <!-- Page Title Start -->
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li class="active">{{ $category['nameCategory'] }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page title end -->
    <!-- 1rd Block Wrapper Start -->
    <section class="utf_block_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="block category-listing category-style2">
                        <h3 class="utf_block_title"><span>{{ $title }}</span></h3>
                        
                        @foreach ($postsInCategory as $post)
                            <div class="utf_post_block_style post-list clearfix">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="utf_post_thumb thumb-float-style">
                                            <a href="#!">
                                                <img class="img-fluid" src="/assets/{{ $post['image'] }}" alt="image new" />
                                            </a>
                                            <a
                                                class="utf_post_cat"
                                                href="/detail-category/{{ $item['idCategory'] }}"
                                            >
                                                {{ $post['nameCategory'] }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-6">
                                        <div class="utf_post_content">
                                            <h2 class="utf_post_title title-large">
                                                <a href="/detail-post/{{ $post['id'] }}">
                                                    {{ $post['title'] }}
                                                </a>
                                            </h2>
                                            <div class="utf_post_meta">
                                                <span class="utf_post_author"><i class="fa fa-user"></i>
                                                    <a href="#!">{{ $post['nameAuthor'] }}</a></span>
                                                <span class="utf_post_date">
                                                    <i class="fa fa-clock-o"></i>
                                                    {{ $post['date'] }}
                                                </span>
                                                <span class="post-comment pull-right">
                                                    <i class="fa fa-comments-o"></i>
                                                    <a href="/detail-post/{{ $post['id'] }}" class="comments-link">
                                                        <span>
                                                            {{ $post['sumCommentInPost'] ? $post['sumCommentInPost'] : 0  }}
                                                        </span>
                                                    </a>
                                                </span>
                                            </div>
                                            <p>{{ $post['description'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>

                    {{-- Phân trang  --}}
                    <div class="paging">
                        <ul class="pagination">
                            @foreach (array_fill(1, $totalPagePosts, NULL) as $index => $item)
                                <li class="{{ $page == $index ? 'active' : '' }}"><a href="?page={{ $index }}">{{ $index }}</a></li>
                            @endforeach
                            @if (!($totalPagePosts == $page))
                                <li><a href="?page={{ $page + 1 }}">»</a></li>
                            @endif
                        </ul>
                    </div>

                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="sidebar utf_sidebar_right">
                        {{-- FOLLOW US  --}}
                        @include('components.static.follow-us')

                        @include('components.static.popular-news')

                        @include('components.static.ads')

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- 1rd Block Wrapper End -->
@endsection
