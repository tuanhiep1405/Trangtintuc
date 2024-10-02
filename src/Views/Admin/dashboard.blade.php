@extends('layouts.master')

@section('css')
    <!-- C3 charts css -->
    <link href="/assets/admin/assets/plugins/c3/c3.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Drixo</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <h5 class="page-title">Dashboard</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-xl-8">
                <div class="row mb-2">
                    @include('components.statistic.mini-stat', [
                        'title' => 'Total Category',
                        'quantity' => $cateSum,
                    ])
                    @include('components.statistic.mini-stat', [
                        'title' => 'Total Post',
                        'icon' => 'mdi mdi-newspaper ',
                        'quantity' => $postSum,
                    ])
                    @include('components.statistic.mini-stat', [
                        'title' => 'Total Hot Post',
                        'icon' => 'ion-flame ',
                        'quantity' => $postHotSum,
                    ])
                    @include('components.statistic.mini-stat', [
                        'title' => 'Total Comment',
                        'icon' => 'mdi mdi-comment-processing ',
                        'quantity' => $commentSum,
                    ])
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="d-flex justify-content-between" style="margin-bottom: 50px">
                                    <h4 class="mt-0 header-title">Statistic All Post In Category</h4>
                                    <form class="statisticViewOfPost" method="GET">
                                        <select name="statisticBy" class="form-control">
                                            <option value="7day"   {{ $statisticBy === "7day"   ? 'selected' : '' }} >7 Day Lastest</option>
                                            <option value="1month" {{ $statisticBy === "1month" ? 'selected' : '' }} >1 Month Lastest</option>
                                            <option value="6month" {{ $statisticBy === "6month" ? 'selected' : '' }} >6 Month Lastest</option>
                                        </select>
                                    </form>
                                </div>
                                <div id="combine-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card bg-primary m-b-20 text-white weather-box">
                            <div class="card-body">
                                <div class="text-center">
                                    <div>
                                        <canvas id="rain" width="56" height="56"></canvas>
                                    </div>
                                    <div>
                                        <h3>28° c</h3>
                                        <h6>Heavy rain</h6>
                                        <h4 class="mt-4">Ha Noi</h4>
                                    </div>
                                </div>
                                <div class="weather-icon">
                                    <i class="mdi mdi-weather-pouring"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-warning m-b-20 text-white weather-box">
                            <div class="card-body">
                                <div class="text-center">
                                    <div>
                                        <canvas id="partly-cloudy-day" width="56" height="56"></canvas>
                                    </div>
                                    <div>
                                        <h3>32° c</h3>
                                        <h6>Partly cloudy</h6>
                                        <h4 class="mt-4">Ho Chi Minh</h4>
                                    </div>
                                </div>
                                <div class="weather-icon">
                                    <i class="mdi mdi-weather-partlycloudy"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">Categories Statistic</h4>
                                        <div id="pie-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- skycons -->
    <script src="/assets/admin/assets/plugins/skycons/skycons.min.js"></script>
    <!-- skycons -->
    <script src="/assets/admin/assets/plugins/peity/jquery.peity.min.js"></script>
    <!-- dashboard -->
    <script src="/assets/admin/assets/pages/dashboardd.js"></script>

    <!--C3 Chart-->
    <script src="/assets/admin/assets/plugins/d3/d3.min.js"></script>
    <script src="/assets/admin/assets/plugins/c3/c3.min.js"></script>

    <script>
        let categoriesAndTotalPost = JSON.parse('{!! json_encode($categoriesAndTotalPost) !!}').map((category) => [category.nameCategory, category.totalPost]);
        let dataStatistic = JSON.parse('{!! json_encode($dataStatistic) !!}');

        console.log(dataStatistic);

        !(function(e) {
            "use strict";
            var a = function() {};

            (a.prototype.init = function() {
                    c3.generate({
                        bindto: "#combine-chart",
                        data: {
                            columns: dataStatistic.data,
                            type: 'bar'
                        },
                        axis: {
                            x: {
                                type: 'category',
                                categories: dataStatistic.date
                            },
                            y: {
                                label: {
                                    text: 'Total Post',
                                    position: 'outer-top'
                                }
                            }
                        },
                    }),
                    c3.generate({
                        bindto: "#pie-chart",
                        data: {
                            columns: categoriesAndTotalPost,
                            type: "pie",
                        },
                        pie: {
                            label: {
                                show: !1
                            }
                        },
                    });
            }),
            (e.ChartC3 = new a()),
            (e.ChartC3.Constructor = a);
        })(window.jQuery),
        (function(e) {
            "use strict";
            window.jQuery.ChartC3.init();
        })();

        let statisticViewOfPost = document.querySelector('.statisticViewOfPost');

        statisticViewOfPost.addEventListener('change', function() {
            statisticViewOfPost.submit();
        })
    </script>
@endsection
