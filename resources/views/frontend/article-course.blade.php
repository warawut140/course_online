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
                            <h4>{{ $course_list->course_name }}</h4>
                            <small><i class="fab fa-blogger"></i>
                                <span>{{ $course_list->name }}</span>
                            </small>
                            <br>
                            <small>โดย <span><a href=""><i class='fas fa-user-circle'></i> {{ $course_list->actby }}</a> </span>สร้างเมื่อ
                                <span>
                                    <?php
                                    list($year, $month, $day) = explode('-', date('Y-m-d', strtotime($course_list->created_at)));
                                    $year += 543;
                                    echo $day . "/" . $month . '/' . $year;
                                    ?>,{{ date('H:i:s',strtotime($course_list->created_at)) }}
                            </span>
                            </small>
                            <hr>
                        </div>
                    </div>
                    <div class="{{ $d_none1 }}">
                        <div class="row">
                            <div class="col-sm-12">
                                <video controls class="mw-100 w-100">
                                    <source src="{{ asset('images/course/video/'.$course_list->course_video) }}"
                                            type="video/mp4">
                                </video>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-justify">
                                    @if (!Auth::guest())
                                        @if ($course_check == true)
                                            <div class="row">
                                                <div class="col-sm-12 text-center">
                                                    <a class="btn btn-warning"
                                                       href="{{ url('article-test/'.$id) }}">สอบ</a>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                    <hr>
                                    {!!  $course_list->course_detail !!}
                                </div>
                                @if (!Auth::guest())
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6 offset-md-3">
                                            <div class="card border-warning">
                                                <div class="card-body">
                                                    <h5>แสดงความคิดเห็น</h5>
                                                    {!! Form::open(['url' => 'course' , 'enctype' => 'multipart/form-data' ]) !!}
                                                    <input type="hidden" name="course_list_id" id="course_list_id"
                                                           value="{{ $id }}">
                                                    <textarea class="form-control" rows="5" name="details"
                                                              required></textarea>
                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-dark mt-2">ส่งความคิดเห็น
                                                        </button>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if($course_listComment != null)
                                    <div class="container-fluid py-3 text-center middle">
                                        <div class="row">
                                            <div>
                                                {!! $course_listComment->links()!!}
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i = 0 ?>
                                    @foreach($course_listComment as $key => $value)
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card border-warning mb-2">
                                                    <div class="card-header">
                                                        <h5 class="mb-0">ความคิดเห็น #{{ $key+1 }}</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <p>{{ $value->details }}</p>
                                                    </div>
                                                    <div class="card-footer text-right">
                                                        <small>
                                                            <?php
                                                            list($year, $month, $day) = explode('-', date('Y-m-d', strtotime($value->created_at)));
                                                            $year += 543;
                                                            echo $day . "/" . $month . '/' . $year;
                                                            ?>,{{ date('H:i:s',strtotime($value->created_at)) }}
                                                            โดย <span><a href=""><i
                                                                            class='fas fa-user-circle'></i> {{ $value->actby }}</a> </span>
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <?php $i++ ?>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="text-center {{ $d_none2 }}" id="">
                            <span class="fa-stack fa-10x text-orange ">
                              <i class="fas fa-circle fa-stack-2x"></i>
                              <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
                            </span>
                        <h5 class="my-5">คอร์สนี้ยังไม่สามารถดูได้ กรุณาทำแบบทดสอบของคอร์สก่อนหน้า</h5>
                        <a href="{{ url('course/'.$last_id) }}" class="btn btn-dark btn-lg">กลับไปคอร์สก่อนหน้า</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- end #คอร์ส --}}

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
@endsection
