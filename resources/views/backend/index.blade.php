@extends('layouts.nevber-admin')
@section('head')
    <style>
        @import 'https://code.highcharts.com/css/highcharts.css';

        #container {
            height: 400px;
            max-width: 800px;
            margin: 0 auto;
        }

        /* Link the series colors to axis colors */
        .highcharts-color-0 {
            fill: #7cb5ec;
            stroke: #7cb5ec;
        }

        .highcharts-axis.highcharts-color-0 .highcharts-axis-line {
            stroke: #7cb5ec;
        }

        .highcharts-axis.highcharts-color-0 text {
            fill: #7cb5ec;
        }

        .highcharts-color-1 {
            fill: #90ed7d;
            stroke: #90ed7d;
        }

        .highcharts-axis.highcharts-color-1 .highcharts-axis-line {
            stroke: #90ed7d;
        }

        .highcharts-axis.highcharts-color-1 text {
            fill: #90ed7d;
        }

        .highcharts-yaxis .highcharts-axis-line {
            stroke-width: 2px;
        }
    </style>
@endsection
@section('content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="active">โครงการ</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Phungngan</h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-3 -->
            <div class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-green">
                    <div class="stats-icon"><i class="fa fa-bullhorn"></i></div>
                    <div class="stats-info">
                        <h4>ประกาศงาน ทั้งหมด</h4>
                        <p>@if($count_work != ""){{ $count_work }}@else - @endif</p>
                    </div>
                    <div class="stats-link">
                        {{--<a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>--}}
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-blue">
                    <div class="stats-icon"><i class="fa fa-gavel"></i></div>
                    <div class="stats-info">
                        <h4>ประมูลงานระบบ ทั้งหมด</h4>
                        <p>@if($count_project_auctions != ""){{ $count_project_auctions }}@else - @endif</p>
                    </div>
                    <div class="stats-link">
                        {{--<a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>--}}
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-purple">
                    <div class="stats-icon"><i class="fa fa-user"></i></div>
                    <div class="stats-info">
                        <h4>สมาชิก ผึ้งงาน</h4>
                        <p>@if($count_profile != ""){{ $count_profile }}@else - @endif</p>
                    </div>
                    <div class="stats-link">
                        {{--<a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>--}}
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-red">
                    <div class="stats-icon"><i class="fa fa-newspaper-o"></i></div>
                    <div class="stats-info">
                        <h4>ปรึกษาและนำ</h4>
                        <p>@if($count_suggest != ""){{ $count_suggest }}@else - @endif</p>
                    </div>
                    <div class="stats-link">
                        {{--<a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>--}}
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
            <div class="col-md-12">
                <div class="col-md-12">
                    <div class="panel panel-inverse" data-sortable-id="index-7" style="">
                        <div class="panel-heading">
                            <h4 class="panel-title">สถานะผู้ใช้งาน ของ USER</h4>
                        </div>
                        <div class="panel-body">
                            <div id="chart-user"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="panel panel-inverse" data-sortable-id="index-7" style="">
                        <div class="panel-heading">
                            <h4 class="panel-title">ประมูลงานระบบ</h4>
                        </div>
                        <div class="panel-body">
                            <div id="chart-project" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
@endsection
@section('script')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>


    <script src="https://code.highcharts.com/modules/export-data.js"></script>


    <script>
        $(document).ready(function () {
            App.init();

            Highcharts.chart('chart-user', {

                chart: {
                    type: 'column',
                    styledMode: true
                },

                title: {
                    text: 'ข้อมูลประเภทผู้ใช้งาน ทั้งหมด : 6'
                },

                yAxis: [{
                    className: 'highcharts-color-1',
                    // opposite: true,
                    min: 0,
                    title: {
                        text: 'จำนวนสมาชิก'
                    }
                }],

                plotOptions: {
                    column: {
                        borderRadius: 5
                    }
                },
                xAxis: {
                    type: 'category',
                    labels: {
                        // rotation: -35,
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
                series: [
                    {
                        name: 'สมาชิก',
                        data: [
                            ['ผู้ว่าจ้าง', {{ $count_profile1 }}],
                            ['ผู้รับจ้าง', {{ $count_profile2 }}],
                            ['ผู้รับเหมา',  {{ $count_profile3 }}],
                        ],
                        // yAxis: 1
                    },
                ]

            });

            Highcharts.chart('chart-project', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: ' โครงการเปิดประมูลของปี {{ $year }}'
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                yAxis: {
                    title: {
                        text: 'จำนวนโครงการที่เปิดประมูล'
                    }
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: false
                    }
                },
                series: [{
                    name: 'งานแอร์',
                    data: [{{ $month[1] }}, {{ $month[2] }}, {{ $month[3] }}, {{ $month[4] }}, {{ $month[5] }}, {{ $month[6] }}, {{ $month[7] }}, {{ $month[8] }}, {{ $month[9] }}, {{ $month[10] }}, {{ $month[11] }}, {{ $month[12] }}]
                }, {
                    name: 'ประปา',
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                }, {
                    name: 'ไฟฟ้า',
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                }, {
                    name: 'งานสุขา',
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                }
                ]
            });
        });
    </script>
@endsection