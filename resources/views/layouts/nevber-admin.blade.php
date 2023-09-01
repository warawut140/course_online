<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    {{--<meta charset="utf-8" />--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Phungngan') }}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
{{--    <link type="image/ico" rel="shortcut icon" href="{{ asset('image/logo-color.svg') }}" sizes="32x32">--}}
    <link type="image/ico" rel="shortcut icon" href="{{ asset('image/favicon.ico') }}" sizes="32x32">

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style-responsive.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/theme/orange.css') }}" rel="stylesheet" />
    <!-- ================== END BASE CSS STYLE ================== -->

    @yield('head')

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->


    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ asset('assets/plugins/pace/pace.min.js') }}"></script>
</head>
<body>
{{--<!-- begin #page-loader -->--}}
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
        <!-- begin #header -->
            <div id="header" class="header navbar navbar-default navbar-fixed-top">
            <!-- begin container-fluid -->
                <div class="container-fluid">
                <!-- begin mobile sidebar expand / collapse button -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset("image/logo-color.svg") }}" class="img-responsive logo-nav" alt="" style="width: 60%">
                    </a>
                    <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- end mobile sidebar expand / collapse button -->

                <!-- begin header navigation right -->
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown navbar-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset("image/Admin-icon.png") }}" alt="" />
                            <span class="hidden-xs">{{ Auth::user()->name }}</span> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu animated fadeInLeft">

                            <li>
                                <a href="{{ route('admin.logout.submit') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('admin.logout.submit') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- end header navigation right -->
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end #header -->

        <!-- begin #sidebar -->
        <!-- begin #sidebar -->
        <div id="sidebar" class="sidebar">
            <!-- begin sidebar scrollbar -->
            <div data-scrollbar="true" data-height="100%">
                <!-- begin sidebar user -->
                <ul class="nav">
                    <li class="nav-profile">
                        <div class="image">
                            <a href="javascript:;"><img src="{{ asset("image/Admin-icon.png") }}" alt="" /></a>
                        </div>
                        <div class="info">
                            {{ Auth::user()->name }}
                            <small>
                                ผู้ดูแลระบบ (Admin)
                            </small>
                        </div>
                    </li>
                </ul>
                <!-- end sidebar user -->
                <!-- begin sidebar nav -->
                <ul class="nav">
                    <li class="nav-header">จัดการข้อมูลของ phungngan</li>
                    <li class="{{ Request::segment(2) === 'home' ||  Request::segment(2) == ''? 'active' : null }}">
                        <a href="{{ url('/admin') }}"><i class="fa fa-dashboard (alias)"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="has-sub
                            {{ Request::segment(2) === 'air-conditioning' ||  Request::segment(2) == 'approve-air'? 'active' : null }}">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <i class="fa fa-gavel"></i>
                            <span>ข้อมูลโครงการ (ผึ้งงานตามงาน)</span>
                        </a>
                        <ul class="sub-menu">
                            <li class="{{ Request::segment(2) === 'air-conditioning' ||  Request::segment(2) == 'approve-air'? 'active' : null }}">
                                <a href="{{ url('/admin/approve-air') }}">AIR Condition System</a>
                            </li>
                            {{--<li><a href="{{ url('/admin/') }}">อื่น ๆ</a></li>--}}
                        </ul>
                    </li>
                    <li class="{{ Request::segment(2) === 'work' ? 'active' : null }}">
                        <a href="{{ url('/admin/work') }}"><i class="fa fa-bullhorn"></i> <span>ประกาศงาน</span></a>
                    </li>
                    <li class="{{ Request::segment(2) === 'training' ? 'active' : null }}">
                        <a href="{{ url('/admin/training') }}"><i class="fa fa-file-movie-o (alias)"></i>
                            <span>อบรมและสาระ</span></a>
                    </li>
                    <li class="{{ Request::segment(2) === 'course' ? 'active' : null }}">
                        <a href="{{ url('/admin/course') }}"><i class="fa fa-file-text-o"></i> <span>สอบออนไลน์</span></a>
                    </li>
                    <li class="{{ Request::segment(2) === 'answers' ? 'active' : null }}">
                        <a href="{{ url('/admin/answers') }}"><i class="fa fa-file-text-o"></i> <span>ตรวจข้อสอบออนไลน์</span></a>
                    </li>
                    <li class="{{ Request::segment(2) === 'suggest' ? 'active' : null }}">
                        <a href="{{ url('/admin/suggest') }}"><i class="fa fa-newspaper-o"></i> <span>ปรึกษาและแนะนำ</span></a>
                    </li>
                    <li class="{{ Request::segment(2) === 'slide-banner' ? 'active' : null }}">
                        <a href="{{ url('/admin/slide-banner') }}"><i class="fa fa-picture-o"></i> <span>รูปปก Silde Banner</span></a>
                    </li>
                    <li class="{{ Request::segment(2) === 'promotion' ? 'active' : null }}">
                        <a href="{{ url('/admin/promotion') }}"><i class="fa fa-gift"></i> <span>โปรโมชั่น</span></a>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <i class="fa fa-group (alias)"></i>
                            <span>แนะนำการใช้ระบบ</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="{{ url('/admin/training') }}">คู่มือการใช้งาน</a></li>
                            <li><a href="{{ url('/admin/training') }}">ช่องทางการชำระเงิน</a></li>
                        </ul>
                    </li>

                    <li class="nav-header">จัดการข้อมูลของ มาตรฐาน (ราคากลาง)</li>
                    <li class="{{ Request::segment(2) === 'brands' ? 'active' : null }}">
                        <a href="{{ url('/admin/brands') }}"><i class="fa fa-shopping-cart"></i> <span>Brand Product</span></a>
                    </li>
                    <li class="has-sub
                            {{ Request::segment(2) === 'air-product' ? 'active' : null }}
                            {{ Request::segment(2) === 'wire' ? 'active' : null }}
                            {{ Request::segment(2) === 'air-cleaners' ? 'active' : null }}
                            {{ Request::segment(2) === 'pipe-wire' ? 'active' : null }}
                            {{ Request::segment(2) === 'pvc' ? 'active' : null }}
                            {{ Request::segment(2) === 'fiberglass-insulation' ? 'active' : null }}
                            {{ Request::segment(2) === 'black-rubber-insulation' ? 'active' : null }}
                            {{ Request::segment(2) === 'pvc-water-pipe' ? 'active' : null }}
                            {{ Request::segment(2) === 'hdpe-waterwork' ? 'active' : null }}
                            {{ Request::segment(2) === 'hdpe-electrical-work' ? 'active' : null }}
                            {{ Request::segment(2) === 'copper-tube' ? 'active' : null }}
                            {{ Request::segment(2) === 'flexible-duct' ? 'active' : null }}
                            {{ Request::segment(2) === 'product-all' ? 'active' : null }}
                            ">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <i class="fa fa-shopping-cart"></i>
                            <span>Standard Price List</span>
                        </a>
                        <ul class="sub-menu">
                            <li class="{{ Request::segment(2) === 'air-product' ? 'active' : null }}">
                                <a href="{{ url('/admin/air-product') }}"> Air Product</a>
                            </li>
                            <li class="{{ Request::segment(2) === 'wire' ? 'active' : null }}">
                                <a href="{{ url('/admin/wire') }}"> สายไฟ </a>
                            </li>
                            <li class="{{ Request::segment(2) === 'air-cleaners' ? 'active' : null }}">
                                <a href="{{ url('/admin/air-cleaners') }}"> น้ำยาแอร์ </a>
                            </li>
                            <li class="{{ Request::segment(2) === 'pipe-wire' ? 'active' : null }}">
                                <a href="{{ url('/admin/pipe-wire') }}"> ท่อร้อย สายไฟ </a>
                            </li>
                            <li class="{{ Request::segment(2) === 'pvc' ? 'active' : null }}">
                                <a href="{{ url('/admin/pvc') }}"> PVC </a>
                            </li>
                            <li class="{{ Request::segment(2) === 'fiberglass-insulation' ? 'active' : null }}">
                                <a href="{{ url('/admin/fiberglass-insulation') }}"> ฉนวนใยแก้ว </a>
                            </li>
                            <li class="{{ Request::segment(2) === 'black-rubber-insulation' ? 'active' : null }}">
                                <a href="{{ url('/admin/black-rubber-insulation') }}"> ฉนวนยางดำ </a>
                            </li>
                            <li class="{{ Request::segment(2) === 'pvc-water-pipe' ? 'active' : null }}">
                                <a href="{{ url('/admin/pvc-water-pipe') }}"> PVC ท่อน้ำทิ้ง </a>
                            </li>
                            <li class="{{ Request::segment(2) === 'hdpe-waterwork' ? 'active' : null }}">
                                <a href="{{ url('/admin/hdpe-waterwork') }}"> HDPE งานประปา </a>
                            </li>
                            <li class="{{ Request::segment(2) === 'hdpe-electrical-work' ? 'active' : null }}">
                                <a href="{{ url('/admin/hdpe-electrical-work') }}"> HDPE งานไฟฟ้า </a>
                            </li>
                            <li class="{{ Request::segment(2) === 'copper-tube' ? 'active' : null }}">
                                <a href="{{ url('/admin/copper-tube') }}"> ท่อทองแดง / Copper Tube </a>
                            </li>
                            <li class="{{ Request::segment(2) === 'flexible-duct' ? 'active' : null }}">
                                <a href="{{ url('/admin/flexible-duct') }}"> Flexible duct </a>
                            </li>
                            <li class="{{ Request::segment(2) === 'product-all' ? 'active' : null }}">
                                <a href="{{ url('/admin/product-all') }}"> รายการวัสดุ อื่นๆ </a>
                            </li>
                        </ul>
                    {{--<li class="{{ Request::segment(2) === 'percents' ? 'active' : null }}">--}}
                    {{--<a href="{{ url('/admin/percents') }}"><i class="fa fa-shopping-cart"></i> <span>(%)</span></a>--}}
                    {{--</li>--}}
                    <li class="has-sub
                    {{ Request::segment(2) === 'data-standard' ? 'active' : null }}
                    {{ Request::segment(2) === 'percents' ? 'active' : null }}
                    {{ Request::segment(2) === 'install-machine' ? 'active' : null }}
                    {{ Request::segment(2) === 'piping' ? 'active' : null }}
                    {{ Request::segment(2) === 'control' ? 'active' : null }}
                    {{ Request::segment(2) === 'duct-piping' ? 'active' : null }}
                    {{ Request::segment(2) === 'main' ? 'active' : null }}
                            ">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <i class="fa fa-gavel"></i>
                            <span>มาตรฐาน (ราคากลาง) ข้อมูลโครงการ</span>
                        </a>
                        <ul class="sub-menu">
                            <li class="{{ Request::segment(2) === 'data-standard' ? 'active' : null }}">
                                <a href="{{ url('/admin/data-standard') }}">Data Standard (BOQ)</a>
                            </li>
{{--                            <li class="has-sub--}}
                        {{--{{ Request::segment(2) === 'percents' ? 'active' : null }}--}}
{{--                            {{ Request::segment(2) === 'install-machine' ? 'active' : null }}--}}
{{--                            {{ Request::segment(2) === 'piping' ? 'active' : null }}--}}
{{--                            {{ Request::segment(2) === 'control' ? 'active' : null }}--}}
{{--                            {{ Request::segment(2) === 'duct-piping' ? 'active' : null }}--}}
{{--                            {{ Request::segment(2) === 'main' ? 'active' : null }}--}}
{{--                                    ">--}}
{{--                                <a href="javascript:;">--}}
{{--                                    <b class="caret pull-right"></b>--}}
{{--                                    AIR Condition System--}}
{{--                                </a>--}}
{{--                                <ul class="sub-menu">--}}
                                    {{--<li class="{{ Request::segment(2) === 'percents' ? 'active' : null }}">--}}
                                        {{--<a href="{{ url('/admin/percents') }}">(%)</a>--}}
                                    {{--</li>--}}
                                    {{--<li><a href="{{ url('/admin/standard') }}">มาตรฐาน (ราคากลาง)</a></li>--}}
{{--                                    <li class="{{ Request::segment(2) === 'install-machine' ? 'active' : null }}">--}}
{{--                                        <a href="{{ url('/admin/install-machine') }}">Install Machine</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="{{ Request::segment(2) === 'piping' ? 'active' : null }}">--}}
{{--                                        <a href="{{ url('/admin/piping') }}">Piping</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="{{ Request::segment(2) === 'control' ? 'active' : null }}">--}}
{{--                                        <a href="{{ url('/admin/control') }}">Control</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="{{ Request::segment(2) === 'duct-piping' ? 'active' : null }}">--}}
{{--                                        <a href="{{ url('/admin/duct-piping') }}">Duct piping</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="{{ Request::segment(2) === 'main' ? 'active' : null }}">--}}
{{--                                        <a href="{{ url('/admin/main') }}">Main  Electrical</a>--}}
{{--                                    </li>--}}
                                    {{--<li>--}}
                                        {{--<a href="{{ url('/admin/') }}">Preliminarie</a>--}}
                                    {{--</li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
                            {{--<li class="has-sub">--}}
                                {{--<a href="javascript:;">--}}
                                    {{--<b class="caret pull-right"></b>--}}
                                    {{--Menu 1.2--}}
                                {{--</a>--}}
                                {{--<ul class="sub-menu">--}}
                                    {{--<li><a href="{{ url('/admin/') }}">(%)</a></li>--}}
                                    {{--<li><a href="{{ url('/admin/') }}">มาตรฐาน(ราคากลาง)</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li class="has-sub">--}}
                                {{--<a href="javascript:;">--}}
                                    {{--<b class="caret pull-right"></b>--}}
                                    {{--Menu 1.3--}}
                                {{--</a>--}}
                                {{--<ul class="sub-menu">--}}
                                    {{--<li><a href="{{ url('/admin/') }}">(%)</a></li>--}}
                                    {{--<li><a href="{{ url('/admin/') }}">มาตรฐาน(ราคากลาง)</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                        </ul>
                    </li>
                    <li class="{{ Request::segment(2) === 'tags' ? 'active' : null }}">
                        <a href="{{ url('/admin/tags') }}"><i class="fa fa-tags"></i> <span>Tag งานของระบบ</span></a>
                    </li>

                    <li class="nav-header">จัดการข้อมูลของ สมาชิกระบบ</li>
                    <li class="has-sub {{ Request::segment(2) === 'user-member' ? 'active' : null }}">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <i class="fa fa-group (alias)"></i>
                            <span>จัดการข้อมูลสมาชิกระบบ</span>
                        </a>
                        <ul class="sub-menu  {{ Request::segment(2) === 'user-member' ? 'active' : null }}">
                            {{--<li><a href="{{ url('/admin/training') }}">ข้อมูลผู้ดูแลระบบ</a></li>--}}
                            <li class="{{ Request::segment(2) === 'user-member' ? 'active' : null }}">
                                <a href="{{ url('/admin/user-member') }}">ข้อมูลสมาชิก</a>
                                <a href="{{ url('/admin/user-member') }}">ข้อมูลผู้ดูแลระบบ</a>
                            </li>
                        </ul>
                    </li>
                    <!-- begin sidebar minify button -->
                {{--<li class="sidebar-minify-btn" ></li>--}}
                <!-- end sidebar minify button -->
                </ul>
                <!-- end sidebar nav -->
            </div>
            <!-- end sidebar scrollbar -->
        </div>
        <div class="sidebar-bg"></div>
        <!-- end #sidebar -->
        <!-- end #sidebar -->

        <!-- begin #content -->
        @yield('content')
        <!-- end #content -->

        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        <!-- end scroll to top btn -->
    </div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="{{ asset('assets/plugins/jquery/jquery-1.9.1.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery/jquery-migrate-1.1.0.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

{{--<script src="{{ asset('assets/crossbrowserjs/html5shiv.js') }}"></script>--}}
{{--<script src="{{ asset('assets/crossbrowserjs/respond.min.js"') }}"></script>--}}
{{--<script src="{{ asset('assets/crossbrowserjs/excanvas.min.js') }}"></script>--}}

<script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-cookie/jquery.cookie.js') }}"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{ asset('assets/js/apps.min.js') }}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

@yield('script')

</body>
</html>
