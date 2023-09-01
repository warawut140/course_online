@extends('layouts.navber')
@section('head')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
        <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
        <!-- jQuery Custom Scroller CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <style>
        .read-more {
          position: relative;
          color: #34495e;
          text-decoration: none;
          cursor: text;
        }
        .read-more .trigger {
          display: block;
          position: absolute;
          bottom: 0;
          cursor: pointer;
          font-weight: 200;
          padding: 2px 10px;
          border-radius: 4px;
          color: #ffffff;
          background-color: #427bff;
        }
        .read-more .collapse {
          display: none;
        }
        .read-more .content {
          position: relative;
          overflow: hidden;
          max-height: 6.72em;
          -webkit-transition: max-height 300ms ease;
          transition: max-height 300ms ease;
        }
        .read-more .content::before {
          content: '';
          -webkit-transition: opactiy 300ms ease, visibility 300ms ease;
          transition: opactiy 300ms ease, visibility 300ms ease;
          background-image: -webkit-linear-gradient(rgba(0, 0, 0, 0), #ffffff, #ffffff);
          background-image: linear-gradient(rgba(0, 0, 0, 0), #ffffff, #ffffff);
          position: absolute;
          bottom: 0;
          width: 100%;
          height: 3.36em;
        }
        .read-more.expanded .content {
          max-height: 900px;
        }
        .read-more.expanded .content::before,
        .read-more.expanded .trigger {
          opacity: 0;
          visibility: hidden;
        }
        .read-more.expanded .collapse {
          display: block;
          bottom: -15px;
          cursor: pointer;
          position: absolute;
          font-weight: 200;
          padding: 2px 10px;
          border-radius: 4px;
          color: #ffffff;
          background-color: #427bff;
        }
        .column-btn{
            width:60px;
            padding: 5px 0!important;
        }    
        .btn-small {
            padding: 2px 15px;
        }
        .column-time{
            width: 120px;
        }

        @media screen and (max-width:767px){
            .column-time{
                width: 85px;
            }
        }
        /* ---------------------------------------------------
            SIDEBAR STYLE
        ----------------------------------------------------- */

        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #f8f9fb;
            color: #000;
            transition: all 0.3s;
        }

        #sidebar.active {
            margin-left: -250px;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: #6d7fcc;
        }

        #sidebar ul.components {
            padding: 0px 0 20px;
            border-bottom: 0;
        }

        #sidebar ul p {
            color: #000;
            font-size: 20px;
            padding: 10px;
        }
        #sidebar>ul>li>a {
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            color: #000;
        }
        #sidebar ul li a {
            padding: 10px;
            font-size: 1.1em;
            display: block;
        }

        #sidebar ul li a:hover {
            color: #000;
            background: #ffedb5;
        }
        #sidebar>ul>li.active>a{
            color: #000;
            background: #ffc107;
        }
        #sidebar ul li.active ul li.active>a,
        a[aria-expanded="true"] {
            color: #000;
            background: #ffedb5;
        }

        a[data-toggle="collapse"] {
            position: relative;
        }

        .dropdown-toggle::after {
            display: block;
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
        }

        #sidebar ul ul a {
            font-size: 0.9em !important;
            padding-left: 30px !important;
            background: #fff;
            color: #000;
        }

        #sidebar a.article,
        #sidebar a.article:hover {
            background: #6d7fcc !important;
            color: #fff !important;
        }
        .btn-black{
            background: #000;
            color: #fff;
        }
        .btn-black:hover{
            background: #000;
            color: #ddd;
        }
        /* ---------------------------------------------------
            CONTENT STYLE
        ----------------------------------------------------- */
        .videoSize{
            width:60%;
            height:450px;
            margin-bottom: 40px;
        }
        #content {
            width: 100%;
            padding: 40px 40px 0;
            min-height: 100vh;
            transition: all 0.3s;
        }
        #content .navbar{
            box-shadow: 0px 0px 0px #fff!important;
            padding-left: 0!important;
            padding-right: 0;
        }       
        #sidebar>ul>li.mustPay.active>a,#sidebar>ul>li.mustTest.active>a {
            color: #000;
            background: #fff;
        }
        .mustPay{
            position: relative;
        }  
        #sidebar>ul>li.mustPay.active .payCourse,#sidebar>ul>li.mustTest.active .testCourse{
            background: rgb(255,232,165,.7);
            width: 100%;
            height:100%;
            position: absolute;
            z-index: 1;
        }
        .payCourse{
            position: absolute;
            background: rgba(0,0,0,.5);
            width: 100%;
            height:100%;
            
        }
        .payCourse .iconB{
            background: var(--warning);
            width:40px;
            height:40px;
            border-radius: 100%;
            padding:8px;
            text-align: center;
            z-index: 3;
            position: absolute;
            top:50%;
            left:50%;
            transform: translate(-50%,-50%);
        }
        .mustTest{
            position: relative;
        }    
        .testCourse{
            position: absolute;
            background: rgba(0,0,0,.5);
            width: 100%;
            height:100%;
            
        }
        .testCourse .iconB{
            background: #000;
            color: #fff;
            width:40px;
            height:40px;
            border-radius: 100%;
            padding:8px;
            text-align: center;
            z-index: 3;
            position: absolute;
            top:50%;
            left:50%;
            transform: translate(-50%,-50%);
        }
    /* ---------------------------------------------------
        MEDIAQUERIES
    ----------------------------------------------------- */

    @media (max-width: 768px) {
        #sidebar {
            margin-left: -250px;
        }
        #sidebar.active {
            margin-left: 0;
        }
        #sidebarCollapse span {
            display: none;
        }
        .videoSize{
            width:100%;
            height:200px;
            margin-bottom: 40px;
        }
        #content {
            width: 100%;
            padding: 40px 20px 0;
            min-height: 100vh;
            transition: all 0.3s;
        }
    }
    </style>
@endsection
@section('content')
        <div class="wrapper">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <!--<div class="sidebar-header">
                    <h3>Bootstrap Sidebar</h3>
                </div>-->

                <ul class="list-unstyled components">
                    <li class="active">
                        <a href="{{ url('course2/'.$course->id) }}"><p class="mb-0">{{ $course->name }}</p></a>
                    </li>

                    @foreach($chapter as $key => $ch)

                    <li class="">
                        <a href="#homeSubmenu{{ $key }}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">{{ $ch->name }}<br><small></small></a>
                        <ul class="collapse list-unstyled" id="homeSubmenu{{ $key }}">
                            @foreach($ch->CourseList as $key2 => $cl)
                            {{-- <li class="active"> --}}
                                <li class="mustTest">
                                @if ($cl->course_free == 0 || $unlock == 1)
                                <a href="{{ url('course2/'.$course->id.'/'.$cl->id) }}">{{ $key2+1 }}. {{ $cl->course_name }}<br><small>{{ $cl->course_time }} นาที</small></a>
                               @else
                                <a href="javascript:;" data-toggle="modal" data-target="#buyCourseModal" style="
                                font-size: 0.9em !important;
                                padding-left: 30px !important;
                                background: #cccccc;
                                color: #000;">{{ $key2+1 }}. {{ $cl->course_name }}<br><small>{{ $cl->course_time }} นาที</small>
                                <span class="badge badge-danger" style="    
                                display: inline-block;
                                padding: .25em .4em;
                                font-size: 80%;
                                font-weight: 300;
                                line-height: 1;
                                text-align: center;
                                white-space: nowrap;
                                vertical-align: baseline;
                                border-radius: .25rem;">
                                <div class="iconB" style="color:white;"><i class="fas fa-coins" style="color:white;"></i> On Sale</div>
                                </span>
                            </a>
                                @endif
                            </li>
                            @endforeach
                            {{-- <li class="mustTest">
                                <a href="article-course.php">{{ $key2+1 }}. พื้นฐานไฟฟ้า 2<br><small>60 นาที</small></a>
                            </li> --}}
                        </ul>
                    </li>
                   
                    {{-- <li class="mustPay">
                        <a href="article-course-pay.php" class="payCourse"><div class="iconB"><i class="fas fa-coins"></i></div></a>
                        <a href="#test3Submenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle ">{{ $ch->name }}<br><small></small></a>
                        <ul class="collapse list-unstyled" id="test3Submenu">
                            <li>
                                <a href="#">1. การติดตั้ง, ล้าง 1<br><small>60 นาที</small></a>
                            </li>
                            <li>
                                <a href="#">2. การติดตั้ง, ล้าง 2<br><small>60 นาที</small></a>
                            </li>
                            <li>
                                <a href="#">3. การติดตั้ง, ล้าง 3<br><small>60 นาที</small></a>
                            </li>
                            <li>
                                <a href="#">4. การติดตั้ง, ล้าง 4<br><small>60 นาที</small></a>
                            </li>
                            <li>
                                <a href="#">5. การติดตั้ง, ล้าง 5<br><small>60 นาที</small></a>
                            </li>
                        </ul>
                    </li> --}}

                    @endforeach
                </ul>
            </nav>

            <!-- Page Content  -->
            <div id="content">

                <nav class="navbar navbar-expand-lg navbar-light bg-white mb-3 ">
                    <div class="container-fluid">
                        <button type="button" id="sidebarCollapse" class="btn btn-warning">
                            <i class="fas fa-bars"></i>
                        </button>
                        <a href="{{ url('course') }}" class="btn btn-outline-dark"><i class="fas fa-arrow-left"></i> กลับหน้ารวมคอร์ส</a>
                    </div>
                </nav>
                <div class="text-center">
                    <video class="videoSize" controls>
                      <source src="{{ asset('images/course/video/'.$data_list->course_video) }}" type="video/mp4">
                      <source src="{{ asset('images/course/video/'.$data_list->course_video) }}" type="video/ogg">
                    Your browser does not support the video tag.
                    </video>
                </div>
                <h2>{{ $data_list->course_name }}</h2>
                <p>โดย <span class="text-warning">{{ $data_list->actby }}</span> {{ $data_list->created_at }}</p>
                <hr>
                {!! $data_list->course_detail !!}
                <br>
                <hr>
                <br>
                <div class="bg-warning text-center py-5 mb-4">
                    <a href="{{ url('article-test/'.$data_list->id) }}" target="_blank" class="btn btn-black rounded-0 px-5 py-3">สอบออนไลน์</a>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="buyCourseModal" tabindex="-1" role="dialog" aria-labelledby="buyCourseModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="buyCourseModalLabel">ซื้อคอร์สเรียน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                </button>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-success">จ่าย</button>
              </div>
            </div>
          </div>
        </div>
        @endsection
        @section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>    
<script>

    $('.nav-item').eq(5).find('a').addClass('active');    
</script>   
<script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script> 

<script>
    $('#article-section1').css({
        'min-height': $(window).height() - $('.navbar').height() - $('#section-footer').height()
    });
    $('.content').css({
        'min-height': $(window).height() - $('.navbar').height() - $('.footerCopyright').height()
    });
</script>
@if(session()->has('status_course'))
    <script>
        Swal({
            type: 'success',
            title: "<?php echo session()->get('status_course'); ?>",
            showConfirmButton: false,
            timer: 1500
        })
    </script>
@endif
</html>