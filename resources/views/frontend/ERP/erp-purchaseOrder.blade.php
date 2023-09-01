@extends('layouts.navber')
@section('head')
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script src="{{ asset('js/modernizr.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvJji6UAeoyj5LslVa4uo1bpNbycAOCXc&v=3.2&sensor=false&language=th&callback=initMap" async defer></script>

    <style>
        div.zabuto_calendar .table tr:last-child {
            border-bottom: 0;
        }

        div.zabuto_calendar .table tr.calendar-month-header td {
            background-color: #400202;
        }

        div.zabuto_calendar .table tr.calendar-dow-header th {
            background-color: #400202;
            letter-spacing: 1px;
        }

        div.zabuto_calendar .table tr th, div.zabuto_calendar .table tr td {
            background-color: #400202;
        }

        div.zabuto_calendar .table tr td div.day {
            background-color: white;
            color: black;
            font-weight: bold;
        }

        div.zabuto_calendar .table tr.calendar-month-header td span {
            letter-spacing: 1px;
        }

        div.zabuto_calendar .table tr td.event div.day, div.zabuto_calendar ul.legend li.event {
            background-color: #b95454;
            color: white;
        }

        div.zabuto_calendar .table th, div.zabuto_calendar .table td {
            padding: 4px
        }

        div#map_canvas{
            margin:auto;
            width:600px;
            height:500px;
            overflow:hidden;
        }
    </style>
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        /*html {*/
        /*height: 100%;*/
        /*margin: 0;*/
        /*padding: 0;*/
        /*text-align: center;*/
        /*}*/

        #map {
            margin:auto;
            height: 500px;
            width: 600px;
            overflow:hidden;
        }
    </style>
@endsection
@section('content')
    <div id="app">
        <div class="wrapper-erp">
            <!-- Sidebar Holder -->
        @include('layouts.sidebar-erp')
        <!-- Page Content Holder -->
            <div id="content-erp">
                <div class="row">
                    <div class="col-sm-12">
                        <nav class="navbar navbar-default mb-3">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <button type="button" id="sidebarCollapse-erp" class="btn btn-orange navbar-btn">
                                        <i class='fas fa-bars'></i>
                                    </button>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <erp-purchase-order :auth_id="{{ $auth_id }}"></erp-purchase-order>
            </div>
        </div>
    </div>
    {{--<script src="/js/app.js" charset="utf-8"></script>--}}
    <script src="{{ asset('js/app.js') }}" ></script>

@endsection
@section('script')
    {{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvJji6UAeoyj5LslVa4uo1bpNbycAOCXc&v=3.2&sensor=false&language=th&callback=initMap" async defer></script>--}}

    {{--<script type="text/javascript">--}}
        {{--$(function(){--}}
            {{--$("<script/>", {--}}
                {{--"type": "text/javascript",--}}
                {{--src: "https://maps.googleapis.com/maps/api/js?key=AIzaSyDvJji6UAeoyj5LslVa4uo1bpNbycAOCXc&v=3.2&sensor=false&language=th&callback=initMap"--}}
            {{--}).appendTo("body");--}}
        {{--});--}}
    {{--</script>--}}
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse-erp').on('click', function () {
                $('#sidebar-erp').toggleClass('active');
                myFunction();
            });
            myFunction();
        });
    </script>
    <script>
        $('#pageSubmenu').addClass('show');
        $('.sidenav-item').eq(6).find('a').addClass('active');
    </script>
    <script>
        function myFunction(x) {
            if (Modernizr.mq('(max-width: 767px)')) {
                if ($('#sidebar-erp').hasClass('active')){

                    $('#content-erp').css({"width": $(window).width() - 160});
                } else {
                    $('#content-erp').css({"width": "100%"});

                }
            }else {
                if ($('#sidebar-erp').hasClass('active')){
                    $('#content-erp').css({"width": "100%"});
                } else {
                    $('#content-erp').css({"width": $(window).width() - 250});
                }
            }
        }
    </script>
@endsection