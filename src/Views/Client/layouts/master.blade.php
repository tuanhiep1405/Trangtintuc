<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from utouchdesign.com/themes/envato/altroznews/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 18 May 2024 08:53:20 GMT -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="" />
    <meta name="theme-color" content="#ec0000" />
    <meta name="description" content="News Magazine HTML Template" />
    <meta name="keywords"
        content="Article, Blog, Business, Fashion, Magazine, Music, News, News Magazine, Newspaper, Politics, Travel" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> {{ $_SESSION['settings']['name'] }} - Top 1 VN </title>

    <!--Favicon-->
    <link rel="icon" href="/assets/{{ $_SESSION['settings']['icon'] }}" type="image/x-icon" />

    <!-- CSS -->
    <link rel="stylesheet" href="/assets/client/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/assets/client/assets/css/style.css" />
    <link rel="stylesheet" href="/assets/client/assets/css/responsive.css" />
    <link rel="stylesheet" href="/assets/client/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/assets/client/assets/css/animate.css" />
    <link rel="stylesheet" href="/assets/client/assets/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="/assets/client/assets/css/owl.theme.default.min.css" />
    <link rel="stylesheet" href="/assets/client/assets/css/colorbox.css" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,500,600,700,800&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,500,600,700,800&amp;display=swap"
        rel="stylesheet" />
    
    @yield('css')
</head>

<body>
    <!-- Header -->
    @include('layouts.header')
    <!-- Header  end -->


    <!-- Main start  -->
    @yield('content')
    <!-- Main end -->



    <!-- Ad Content Area Start -->
    <div class="utf_ad_content_area text-center utf_banner_area">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <img class="img-fluid" src="/assets/client/assets/images/banner-ads/ad-content-two.png"
                        alt="" />
                </div>
            </div>
        </div>
    </div>
    <!-- Ad Content Area end -->

    <!-- Footer Start -->
    @include('layouts.footer')

    <!-- Footer End -->


    </div>

    <!-- Javascript Files -->
    <script src="/assets/client/assets/js/jquery-3.2.1.min.js"></script>
    <script src="/assets/client/assets/js/bootstrap.min.js"></script>
    <script src="/assets/client/assets/js/owl.carousel.min.js"></script>
    <script src="/assets/client/assets/js/jquery.colorbox.js"></script>
    <script src="/assets/client/assets/js/smoothscroll.js"></script>
    <script src="/assets/client/assets/js/custom_script.js"></script>
    <script>
        /* Loading Js*/
        $(window).on("load", function() {
            setTimeout(function() {
                $(".preloader").delay(700).fadeOut(700).addClass("loaded");
            }, 800);
        });
    </script>
    @yield('js')
</body>

<!-- Mirrored from utouchdesign.com/themes/envato/altroznews/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 18 May 2024 08:53:20 GMT -->

</html>
