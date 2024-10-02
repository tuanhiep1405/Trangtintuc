<div class="widget color-default">
    <h3 class="utf_block_title"><span>Popular News</span></h3>
    <div class="utf_list_post_block">
        <ul class="utf_list_post">
            {{-- Post-sidebar  --}}
            @foreach ($topPostPopular as $item)
                <li class="clearfix">
                    <div class="utf_post_block_style post-float clearfix">
                        <div class="utf_post_thumb">
                            <a href="!#">
                                <img class="img-fluid" src="/assets/{{ $item['image'] }}" alt="image new" />
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