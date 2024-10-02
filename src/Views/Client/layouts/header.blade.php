 <!-- Start Pre Loader -->
<div id="preloader">
    <div id="ctn-preloader" class="ctn-preloader">
        <div class="animation-preloader">
            <div class="spinner"></div>
            <div class="txt-loading">
                <span data-text-preloader="A" class="letters-loading">A</span>
                <span data-text-preloader="L" class="letters-loading">L</span>
                <span data-text-preloader="T" class="letters-loading">T</span>
                <span data-text-preloader="R" class="letters-loading">R</span>
                <span data-text-preloader="O" class="letters-loading">O</span>
                <span data-text-preloader="Z" class="letters-loading">Z</span>
                <span data-text-preloader="&nbsp;" class="letters-loading">&nbsp;</span>
                <span data-text-preloader="N" class="letters-loading">N</span>
                <span data-text-preloader="E" class="letters-loading">E</span>
                <span data-text-preloader="W" class="letters-loading">W</span>
                <span data-text-preloader="S" class="letters-loading">S</span>
            </div>
        </div>
        <div class="loader">
            <div class="row">
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Pre Loader -->

<div class="body-inner">
    <!-- Topbar Start -->
    <div id="top-bar" class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="unstyled top-nav">
                        @if (isset($_SESSION['user']))
                            <li style="color: #fff; font-weight: 600;">Welcome, {{ $_SESSION['user']['name'] }}</li>
                        @else
                            <li><a href="/auth">Login & Signup</a></li>
                        @endif
                    </ul>
                </div>
                <div class="col-md-4 top-social text-lg-right text-md-center">
                    <ul class="unstyled">
                        <li>
                            @if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 1)
                                <a title="Admin Manager" href="/admin/">
                                    <span class="social-icon"><i class="fa fa-cogs"></i></span>
                                </a>
                                <a title="Logout" href="/auth/logout" onclick="return confirm('You want logout ?')">
                                    <span class="social-icon"><i class="fa fa-sign-out"></i></span>
                                </a>
                            @endif
                            
                            @if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 0)
                                <a title="My Profile" href="/profile">
                                    <span class="social-icon"><i class="fa fa-user"></i></span>
                                </a>
                                <a title="Logout" href="/auth/logout" onclick="return confirm('You want logout ?')">
                                    <span class="social-icon"><i class="fa fa-sign-out"></i></span>
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Header start -->
    <header id="header" class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 text-center">
                    <div class="logo">
                        <a href="/">
                            <img src="/assets/{{ $_SESSION['settings']['logo'] }}" alt="" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    <!-- Main Nav Start -->
    <div class="utf_main_nav_area clearfix utf_sticky">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-expand-lg col">
                    <div class="utf_site_nav_inner float-left">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="true" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div id="navbarSupportedContent" class="collapse navbar-collapse navbar-responsive-collapse">
                            <!-- menu -->
                            <ul class="nav navbar-nav">
                                <li class="nav-item">
                                    <a href="/" class="nav-link" >Home</a>
                                </li>
                                {{-- active --}}
                                @php
                                    $categories = (new Assignment\Php2News\Models\Categories)->getByStatus(1);
                                @endphp
                                @foreach ($categories as $category)
                                    <li class="nav-item">
                                        <a href="/detail-category/{{ $category['id'] }}">{{ $category['nameCategory'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="utf_nav_search">
                    <span id="search"><i class="fa fa-search"></i></span>
                </div>
                <div class="utf_search_block" style="display: none">
                    <input type="text" class="form-control" placeholder="Type what you want and enter" />
                    <span class="utf_search_close">&times;</span>
                </div>
            </div>
        </div>
    </div>
    <!-- menu end-->
