@extends('layouts.navber')
@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
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
    </style>
@endsection
@section('content')
    {{-- begin #คอร์ส --}}
    <div id="article-section1" class="bg-light">
        <div class="container py-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4>{{ $course->name  }}</h4>
                            <small>โดย <span><a href=""><i class='fas fa-user-circle'></i> {{ $course->actby }}</a> </span>สร้างเมื่อ
                                <span>
                                    <?php
                                    list($year, $month, $day) = explode('-', date('Y-m-d', strtotime($course->created_at)));
                                    $year += 543;
                                    echo $day . "/" . $month . '/' . $year;
                                    ?>,{{ date('H:i:s',strtotime($course->created_at)) }}
                            </span>
                            </small>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <img src="{{ asset('images/course/banner/'.$course->image) }}" class="mw-100 mb-3">
                            @if($unlock == 0)
                            <h3><span class="text-primary">{{ number_format($course->price) }}</span> บาท </h3>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#buyCourseModal">เข้าเรียน / ซื้อคอร์ส</button>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 pb-5">
                            <div class="text-justify">
                                <hr>
                                <h6 class="text-secondary font-weight-blod">รายละเอียด</h6>
                                <div class="read-more">
                                    <div class="content">
                                        <p>
                                            {{ $course->detail }}
                                        </p>
                                    </div>
                                    <span class="trigger" onclick="this.parentElement.classList.add('expanded')">อ่านเพิ่มเติม</span>
                                    <span class="collapse" onclick="this.parentElement.classList.remove('expanded')">ย่อเนื้อหา</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 px-1">
                            <h5 class="mb-2 font-weight-bold">เนื้อหาของคอร์สนี้</h5>
                            <table class="table table-sm">
                                <thead class="bg-warning">
                                <tr>
                                    <th colspan="2" class="align-top">เนื้อหา</th>
                                    <th class="text-center align-middle column-time">คลิปยาว (นาที)</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (!Auth::guest())
                                    @foreach($course_video_list as $value)
                                        <tr>
                                            <td>
                                                {{ $value->course_name }}
                                                @if($value->answer == 1)
                                                    <span class="badge badge-success font-weight-light">{{ $value->sum_answer }}</span>
                                                @elseif($value->answer == 2)
                                                    <span class="badge badge-danger font-weight-light">{{ $value->sum_answer }}</span>
                                                @endif
                                            </td>
                                            <td class="column-btn" style="width: 150px;">
                                                @if($unlock == 1)
                                                    <a class="btn btn-success btn-sm btn-small text-white"
                                                       data-fancybox href="{{ asset('images/course/video/'.$value->course_video) }}"> ดูวิดีโอ </a>
                                                    @if($value->course_check == true)
                                                    <a href="{{ url('article-test/'.$value->id) }}" target="_blank" class="btn btn-warning btn-sm btn-small text-white"> สอบ</a>
                                                    @endif
                                                @else
                                                    @if ($value->course_free == 0)
                                                        <a class="btn btn-dark btn-sm btn-small text-white"
                                                           data-fancybox href="{{ asset('images/course/video/'.$value->course_video) }}"> ดูฟรี</a>
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-center align-middle">{{ $value->course_time }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    @foreach($course_video_list as $value)
                                        <tr>
                                            <td>{{ $value->course_name }}</td>
                                            <td class="column-btn">
                                                @if ($value->course_free == 0)
                                                    <a class="btn btn-dark btn-sm btn-small text-white"
                                                       data-fancybox href="{{ asset('images/course/video/'.$value->course_video) }}">ดูฟรี</a>
                                                @endif
                                            </td>
                                            <td class="text-center align-middle">{{ $value->course_time }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- end #คอร์ส --}}

    <div class="modal fade" id="buyCourseModal" tabindex="-1" role="dialog" aria-labelledby="buyCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buyCourseModalLabel">ซื้อคอร์สเรียน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                    </button>
                </div>
                @if (!Auth::guest())
                    <div class="modal-body">
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{ asset('images/transfer.png') }}" class="mw-100 mb-3">
                                    <h4 class="text-orange">{{ $course->name  }}</h4>
                                    <h5> จำนวนเงิน Coins
                                        <i class='fas fa-coins'></i> <span> {{ number_format($coin) }}</span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">ยกเลิก</button>
                        @if ($coin >= $course->price)
                        <a href="{{ url('unLockCourse/'.$id) }}" class="btn btn-success">จ่าย {{ number_format($course->price) }} บาท</a>
                        @else
                        <a href="{{ url('payment-credit') }}" class="btn btn-warning">เติมเงิน</a>
                        @endif
                    </div>
                @else
                    <div class="modal-body">
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <a href="{{ url('login') }}" class="btn btn-warning w-100">เข้าสู่ระบบ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
@section('script')
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
@endsection
