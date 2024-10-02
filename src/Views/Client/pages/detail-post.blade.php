@extends('layouts.master') @section('content')
    <!-- Page Title Start -->
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li>
                            <a href="/detail-category/{{ $post['idCategory'] }}">
                                {{ $post['nameCategory'] }}
                            </a>
                        </li>
                        <li class="active">{{ $post['title'] }}</li>
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
                    <div class="single-post">
                        <div class="utf_post_title-area">
                            <a class="utf_post_cat" href="/detail-category/{{ $post['idCategory'] }}">
                                {{ $post['nameCategory'] }}
                            </a>
                            <h2 class="utf_post_title">{{ $post['title'] }}</h2>
                            <div class="utf_post_meta">
                                <span class="utf_post_author">
                                    By <a href="#!">{{ $post['nameAuthor'] }}</a>
                                </span>
                                <span class="utf_post_date">
                                    <i class="fa fa-clock-o"></i>
                                    {{ $post['date'] }}
                                </span>
                                <span class="post-hits">
                                    <i class="fa fa-eye"></i> {{ $post['views'] }}</span>
                                <span class="post-comment"><i class="fa fa-comments-o"></i>
                                    <a href="#utf_latest_news_slide" class="comments-link">
                                        <span>
                                            {{ $post['totalCommentInPost'] ? $post['totalCommentInPost'] : 0 }}
                                        </span>
                                    </a>
                                </span>
                            </div>
                        </div>

                        <div class="utf_post_content-area">
                            <div class="post-media post-audio">
                                <blockquote>{{ $post['description'] }}</blockquote>
                            </div>

                            <div class="entry-content">{!! $post['content'] !!}</div>

                            <div class="tags-area clearfix">
                                <div class="post-tags">
                                    @if (!empty($tagsInPost))
                                        <span>Tags:</span>
                                        @foreach ($tagsInPost as $tag)
                                            <a href="#!"># {{ $tag }}</a>
                                        @endforeach
                                    @else
                                        <span>No Tags</span>
                                    @endif
                                </div>
                            </div>

                            <div class="share-items clearfix">
                                <ul class="post-social-icons unstyled">
                                    <li class="facebook">
                                        <a href="#">
                                            <i class="fa fa-facebook"></i>
                                            <span class="ts-social-title">Facebook</span></a>
                                    </li>
                                    <li class="twitter">
                                        <a href="#">
                                            <i class="fa fa-twitter"></i>
                                            <span class="ts-social-title">Twitter</span></a>
                                    </li>
                                    <li class="gplus">
                                        <a href="#">
                                            <i class="fa fa-google-plus"></i>
                                            <span class="ts-social-title">Google +</span></a>
                                    </li>
                                    <li class="pinterest">
                                        <a href="#">
                                            <i class="fa fa-pinterest"></i>
                                            <span class="ts-social-title">Pinterest</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="related-posts block">
                        <h3 class="utf_block_title"><span>Bài viết liên quan</span></h3>
                        <div id="utf_latest_news_slide" class="owl-carousel owl-theme utf_latest_news_slide">
                            @foreach ($relatedPostsExceptThisPost as $item)
                                <div class="item">
                                    <div class="utf_post_block_style clearfix">
                                        <div class="utf_post_thumb">
                                            <a href="#">
                                                <img class="img-fluid" src="/assets/{{ $item['image'] }}"
                                                    alt="image new" />
                                            </a>
                                        </div>
                                        <a class="utf_post_cat" href="/detail-category/{{ $item['idCategory'] }}">
                                            Health
                                        </a>
                                        <div class="utf_post_content">
                                            <h2 class="utf_post_title title-medium">
                                                <a href="/detail-post/{{ $item['id'] }}">{{ $item['title'] }}</a>
                                            </h2>
                                            <div class="utf_post_meta">
                                                <span class="utf_post_date">
                                                    <i class="fa fa-clock-o"></i>
                                                    {{ $item['date'] }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Post comment start -->
                    <div id="comments" class="comments-area block">
                        <h3 class="utf_block_title">
                            <span>{{ $post['totalCommentInPost'] }} Bình luận</span>
                        </h3>

                        <ul class="comments-list">
                            @foreach ($commentsA as $A)
                                <li>
                                    <div class="comment">
                                        <img class="comment-avatar pull-left" alt=""
                                            src="{{ show_upload($A['avatar']) }}" />
                                        <div class="comment-body">
                                            <div class="meta-data">
                                                <span class="comment-author">{{ $A['name'] }} </span>
                                                {{-- Binh luận cha --}}
                                                <span class="comment-date pull-right">{{ $A['date'] }}</span>
                                            </div>
                                            <div class="comment-content">
                                                <p>
                                                    {{ $A['content'] }}
                                                </p>
                                            </div>

                                            {{-- @include('components.alert') --}}
                                            <div class="comments-form">
                                                <form action="{{ $post['id'] }}" method="POST">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">

                                                                <input type="text" name="replyContent" id=""
                                                                    style="width: 100%">

                                                                <input type="hidden" name="idPost"
                                                                    value="{{ $post['id'] }}">{{-- id bài post  --}}
                                                                <input type="hidden" name="idReplyUser"
                                                                    value="{{ $A['idUser'] }}">{{-- id user bình luận cha --}}
                                                                <input type="hidden"
                                                                    name="idComment"value="{{ $A['id'] }}">{{-- id bình luận cha  --}}

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-left">
                                                        <button class="comment-reply" type="submit"><i
                                                                class="fa fa-share"></i> Trả lời</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                    {{-- reply --}}
                                    <ul class="comments-reply">
                                        @foreach ($A['totalReply'] as $b)
                                            <li>

                                                <div class="comment">
                                                    <img class="comment-avatar pull-left" alt=""
                                                        src="{{ show_upload($b['avatar']) }}" />
                                                    <div class="comment-body">
                                                        <div class="meta-data">
                                                            <span class="comment-author">
                                                                {{ $b['name'] }}
                                                                @if (!($b['idReplyUser'] == $b['idUser']))
                                                                    <i class="fa fa-caret-right mx-1"></i>
                                                                    {{ $b['rpName'] }}
                                                                @endif
                                                            </span>
                                                            <span class="comment-date pull-right">
                                                                {{ $b['date'] }}</span>
                                                        </div>
                                                        <div class="comment-content">
                                                            <p>
                                                                {{ $b['content'] }}
                                                            </p>
                                                        </div>

                                                        {{-- x2 Reply --}}
                                                        {{-- @include('components.alert') --}}
                                                        <div class="comments-form">
                                                            <form action="{{ $post['id'] }}" method="POST">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">

                                                                            <input type="text" name="replyContent"
                                                                                id="" style="width: 100%">

                                                                            <input type="hidden" name="idPost"
                                                                                value="{{ $post['id'] }}">{{-- id bài post  --}}
                                                                            <input type="hidden" name="idReplyUser"
                                                                                value="{{ $b['idUser'] }}">{{-- id user bình luận cha --}}
                                                                            <input type="hidden"
                                                                                name="idComment"value="{{ $A['id'] }}">{{-- id bình luận cha  --}}

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="text-left">
                                                                    <button class="comment-reply" type="submit"><i
                                                                            class="fa fa-share"></i> Trả lời</button>
                                                                </div>
                                                            </form>
                                                        </div>


                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach

                                    </ul>
                                </li>
                            @endforeach






                        </ul>

                    </div>
                    <!-- Post comment end -->

                    <!-- Comment Form Start -->
                    <div class="comments-form">
                        @include('components.alert')
                        <h3 class="title-normal">Bình luận</h3>
                        <form action="{{ $post['id'] }}" method="POST">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control required-field" id="message" placeholder="Your Comment" rows="10" required
                                            name="content"></textarea>
                                        <input type="hidden" name="idPost" value="{{ $post['id'] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">
                                <button class="comments-btn btn btn-primary" type="submit">
                                    Gửi bình luận
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- Comments form end -->
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="sidebar utf_sidebar_right">
                        {{-- follow us --}} @include('components.static.follow-us')
                        @include('components.static.popular-news')
                        @include('components.static.ads')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- 1rd Block Wrapper End -->
@endsection
