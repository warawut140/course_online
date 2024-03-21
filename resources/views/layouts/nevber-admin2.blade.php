<!DOCTYPE html>
<!--
Template Name: Enigma - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en" class="light">
<!-- BEGIN: Head -->

<head>
    {{-- <meta charset="utf-8" /> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <link href="{{ asset('image/logo.jpg') }}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="author" content="LEFT4CODE">
    <title>{{ config('app.title', 'กองมาตรฐานราคากลาง') }}</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />
    <!-- END: CSS Assets-->

    <link href="https://fonts.googleapis.com/css?family=Kanit:300,400,500" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ asset('assets/plugins/pace/pace.min.js') }}"></script>

    <style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 14px;
        }
    </style>

    @yield('head')

</head>

<!-- END: Head -->

<body class="py-5 md:py-0" style=" font-family: 'Kanit', sans-serif;">

    <!-- END: Top Bar -->
    <div class="flex overflow-hidden">
        <!-- BEGIN: Side Menu -->
        <nav class="side-nav">
            <ul>
                {{-- <li>
                    <a href="{{ url('admin') }}"
                        class="side-menu {{ Request::segment(2) === 'index' || Request::segment(2) == '' ? 'side-menu--active' : null }} ">
                        <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                        <div class="side-menu__title"> Dashboard </div>
                    </a>
                </li> --}}
                <li>
                    <a href="javascript:;"
                        class="side-menu {{ Request::segment(2) === 'student' || Request::segment(2) == 'company' ? 'side-menu--active' : null }}">
                        <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                        <div class="side-menu__title">
                            ข้อมูลผู้ใช้
                            <div
                                class="side-menu__sub-icon {{ Request::segment(2) === 'student' || Request::segment(2) == 'company' ? 'transform rotate-180' : null }}">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul
                        class="side-menu__sub{{ Request::segment(2) === 'student' || Request::segment(2) == 'company' ? '-open' : null }}">
                        <li>
                            <a href="{{ url('admin/student') }}"
                                class="side-menu {{ Request::segment(2) === 'student' ? 'side-menu--active' : null }}">
                                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="side-menu__title"> จัดการข้อมูลนักเรียน </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/company') }}"
                                class="side-menu {{ Request::segment(2) === 'company' ? 'side-menu--active' : null }}">
                                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="side-menu__title"> จัดการข้อมูลผู้ประกอบการ </div>
                            </a>
                        </li>

                        {{-- <li>
                            <a href="javascript:;" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="side-menu__title">
                                    Table
                                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                                </div>
                            </a>
                            <ul class="">
                                <li>
                                    <a href="side-menu-light-regular-table.html" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                        <div class="side-menu__title">Regular Table</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="side-menu-light-tabulator.html" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="zap"></i> </div>
                                        <div class="side-menu__title">Tabulator</div>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}


                    </ul>
                </li>
                <li>
                    <a href="javascript:;"
                        class="side-menu {{ Request::segment(2) === 'a' || Request::segment(2) == 'b' ? 'side-menu--active' : null }}">
                        <div class="side-menu__icon"> <i data-lucide="globe"></i> </div>
                        <div class="side-menu__title">
                            ข้อมูลเว็บไซต์
                            <div
                                class="side-menu__sub-icon {{ Request::segment(2) === 'a' || Request::segment(2) == 'b' ? 'transform rotate-180' : null }}">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul
                        class="side-menu__sub{{ Request::segment(2) === 'banner' || Request::segment(2) == 'display_course' || Request::segment(2) == 'display_work' ? '-open' : null }}">
                        <li>
                            <a href="{{ url('admin/banner') }}"
                                class="side-menu {{ Request::segment(2) === 'banner' ? 'side-menu--active' : null }}">
                                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="side-menu__title"> ตั้งค่าแบรนเนอร์ </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/display_course') }}"
                                class="side-menu {{ Request::segment(2) === 'display_course' ? 'side-menu--active' : null }}">
                                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="side-menu__title"> ตั้งค่าแสดงหลักสูตร </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/display_work') }}"
                                class="side-menu {{ Request::segment(2) === 'display_work' ? 'side-menu--active' : null }}">
                                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="side-menu__title"> ตั้งค่าแสดงงาน </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;"
                        class="side-menu {{ Request::segment(2) === 'a' || Request::segment(2) == 'b' ? 'side-menu--active' : null }}">
                        <div class="side-menu__icon"> <i data-lucide="hash"></i> </div>
                        <div class="side-menu__title">
                            ข้อมูลประเภท
                            <div
                                class="side-menu__sub-icon {{ Request::segment(2) === 'a' || Request::segment(2) == 'b' ? 'transform rotate-180' : null }}">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul
                        class="side-menu__sub{{ Request::segment(2) === 'course_type' || Request::segment(2) == 'work_type' ? '-open' : null }}">
                        <li>
                            <a href="{{ url('admin/course_type') }}"
                                class="side-menu {{ Request::segment(2) === 'course_type' ? 'side-menu--active' : null }}">
                                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="side-menu__title"> จัดการประเภทคอร์ส </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/work_type') }}"
                                class="side-menu {{ Request::segment(2) === 'work_type' ? 'side-menu--active' : null }}">
                                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="side-menu__title"> จัดการประเภทงาน </div>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li>
                    <a href="{{ url('admin') }}"
                        class="side-menu {{ Request::segment(2) === 'a' || Request::segment(2) == 'b' ? 'side-menu--active' : null }} ">
                        <div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
                        <div class="side-menu__title"> จัดการคอร์สเรียน </div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin') }}"
                        class="side-menu {{ Request::segment(2) === 'a' || Request::segment(2) == 'b' ? 'side-menu--active' : null }} ">
                        <div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
                        <div class="side-menu__title"> จัดการงาน </div>
                    </a>
                </li> --}}

            </ul>
        </nav>
        <!-- END: Side Menu -->

        {{-- Content --}}
        @yield('content')

    </div>

    <!-- BEGIN: Top Bar -->
    <div
        class="top-bar-boxed h-[70px] md:h-[65px] z-[51] border-b border-white/[0.08] -mt-7 md:mt-0 -mx-3 sm:-mx-8 md:-mx-0 px-3 md:border-b-0 relative md:fixed md:inset-x-0 md:top-0 sm:px-8 md:px-10 md:pt-10 md:bg-gradient-to-b md:from-slate-100 md:to-transparent dark:md:from-darkmode-700">
        <div class="h-full flex items-center">
            <!-- BEGIN: Logo -->
            <a href="" class="logo -intro-x hidden md:flex xl:w-[180px] block">
                <img alt="Midone - HTML Admin Template" class="logo__image w-6"
                    src="{{ asset('dist/images/logo.svg') }}">
                <span class="logo__text text-white text-lg ml-3"> กองมาตรฐานราคากลาง </span>
            </a>
            <!-- END: Logo -->
            <!-- BEGIN: Breadcrumb -->
            <nav aria-label="breadcrumb" class="-intro-x h-[45px] mr-auto">
                <ol class="breadcrumb breadcrumb-light">
                    {{-- <li class="breadcrumb-item"><a href="#">Application</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li> --}}
                </ol>
            </nav>
            <!-- BEGIN: Notifications -->
            <div class="intro-x dropdown mr-4 sm:mr-6">
                <div class="dropdown-toggle notification notification--bullet cursor-pointer" role="button"
                    aria-expanded="false" data-tw-toggle="dropdown"> <i data-lucide="bell"
                        class="notification__icon dark:text-slate-500"></i> </div>
                <div class="notification-content pt-2 dropdown-menu">
                    <div class="notification-content__box dropdown-content">
                        <div class="notification-content__title">Notifications</div>

                        {{-- <div class="cursor-pointer relative flex items-center ">
                                <div class="w-12 h-12 flex-none image-fit mr-1">
                                    <img alt="Midone - HTML Admin Template" class="rounded-full" src="dist/images/profile-4.jpg">
                                    <div class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                                </div>
                                <div class="ml-2 overflow-hidden">
                                    <div class="flex items-center">
                                        <a href="javascript:;" class="font-medium truncate mr-5">Brad Pitt</a>
                                        <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">06:05 AM</div>
                                    </div>
                                    <div class="w-full truncate text-slate-500 mt-0.5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500</div>
                                </div>
                            </div> --}}

                    </div>
                </div>
            </div>
            <!-- END: Notifications -->
            <!-- BEGIN: Account Menu -->
            <div class="intro-x dropdown w-8 h-8">
                <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110"
                    role="button" aria-expanded="false" data-tw-toggle="dropdown">
                    <img alt="Midone - HTML Admin Template" src="{{ asset('image/Admin-icon.png') }}">
                </div>
                <div class="dropdown-menu w-56">
                    <ul
                        class="dropdown-content bg-primary/80 before:block before:absolute before:bg-black before:inset-0 before:rounded-md before:z-[-1] text-white">
                        <li class="p-2">
                            <div class="font-medium">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-white/60 mt-0.5 dark:text-slate-500">DevOps Engineer</div>
                        </li>
                        {{-- <li>
                                <hr class="dropdown-divider border-white/[0.08]">
                            </li>
                            <li>
                                <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="user" class="w-4 h-4 mr-2"></i> Profile </a>
                            </li>
                            <li>
                                <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="edit" class="w-4 h-4 mr-2"></i> Add Account </a>
                            </li>
                            <li>
                                <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Reset Password </a>
                            </li>
                            <li>
                                <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="help-circle" class="w-4 h-4 mr-2"></i> Help </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider border-white/[0.08]">
                            </li> --}}
                        <li>
                            <a href="{{ route('admin.logout.submit') }}" class="dropdown-item hover:bg-white/5"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                            <form id="logout-form" action="{{ route('admin.logout.submit') }}" method="POST"
                                style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- END: Account Menu -->
        </div>
    </div>

    <!-- BEGIN: Dark Mode Switcher-->
    {{-- <div data-url="side-menu-dark-tabulator.html"
        class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box dark:bg-dark-2 border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">
        <div class="mr-4 text-gray-700 dark:text-gray-300">Dark Mode</div>
        <div class="dark-mode-switcher__toggle border"></div>
    </div> --}}
    <!-- END: Dark Mode Switcher-->

    <!-- BEGIN: JS Assets-->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ asset('assets/plugins/jquery/jquery-1.9.1.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery/jquery-migrate-1.1.0.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    {{-- <script src="{{ asset('assets/crossbrowserjs/html5shiv.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/crossbrowserjs/respond.min.js"') }}"></script> --}}
    {{-- <script src="{{ asset('assets/crossbrowserjs/excanvas.min.js') }}"></script> --}}

    <script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-cookie/jquery.cookie.js') }}"></script>
    <!-- ================== END BASE JS ================== -->

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{ asset('assets/js/apps.min.js') }}"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=[" your-google-map-api"]&libraries=places"></script>
    <script src="{{ asset('dist/js/app.js') }}"></script>
    <!-- END: JS Assets-->

    <script>
        setTimeout(function() {
            $('.success').hide()
        }, 2000);
        setTimeout(function() {
            $('.error').hide()
        }, 2000);
    </script>

    @yield('script')
</body>

</html>
