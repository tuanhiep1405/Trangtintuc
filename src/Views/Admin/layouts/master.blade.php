<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from themesdesign.in/drixo/vertical/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 19 May 2024 15:07:33 GMT -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui" />
    <title>{{ $_SESSION['settings']['name'] }} - Admin</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="/assets/{{ $_SESSION['settings']['icon'] }}" />
    @yield('css')
    <link href="/assets/admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/admin/assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="/assets/admin/assets/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body class="fixed-left">
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- Begin page -->
    <div id="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        @include('layouts.components.sidebar')
        <!-- Left Sidebar End -->
        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <!-- Top Bar Start -->
                @include('layouts.components.header')
                <!-- Top Bar End -->
                
                <!-- Page content Wrapper -->
                <div class="page-content-wrapper">
                    <!-- Content -->
                    @yield('content')
                    <!-- End content -->
                </div>
                <!-- Page content Wrapper -->
            </div>
            <!-- Footer -->
            @include('layouts.components.footer')
            <!-- End Footer -->
        </div>
        <!-- End Right content here -->
    </div>
    <!-- END wrapper --><!-- jQuery  -->
    <script src="/assets/admin/assets/js/jquery.min.js"></script>
    <script src="/assets/admin/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/admin/assets/js/modernizr.min.js"></script>
    <script src="/assets/admin/assets/js/detect.js"></script>
    <script src="/assets/admin/assets/js/fastclick.js"></script>
    <script src="/assets/admin/assets/js/jquery.slimscroll.js"></script>
    <script src="/assets/admin/assets/js/jquery.blockUI.js"></script>
    <script src="/assets/admin/assets/js/waves.js"></script>
    <script src="/assets/admin/assets/js/jquery.nicescroll.js"></script>
    <script src="/assets/admin/assets/js/jquery.scrollTo.min.js"></script>
    @yield('js')
    <!-- App js -->
    <script src="/assets/admin/assets/js/app.js"></script>
</body>
<!-- Mirrored from themesdesign.in/drixo/vertical/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 19 May 2024 15:07:56 GMT -->

</html>
