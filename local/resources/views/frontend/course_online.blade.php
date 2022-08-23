@extends('layouts.navber')
@section('head')
    {{-- @include('sweetalert::alert') --}}
@endsection
@section('content')
    <style>
        .main {
            width: 90%;
            margin-right: 20px;
            margin-left: 20px;
        }

        img.center {
            display: block;
            margin: 0 auto;
        }

        .opcenter {
            text-align: center;
            padding: 10px;
            margin: auto;
        }

        .optop {
            text-align: center;
            padding: 10px;

        }

        .left {
            text-align: left;
            margin-left: 80px;
            margin-Right: 20px;
        }

        .right {
            text-align: right;
            margin-top: 10px;
            margin-Right: 80px;
            margin-left: 20px;
        }

        .op2center {
            text-align: center;
            padding: 10px;
            margin: auto;
            color: white;
            background-color: #8B0900;
            font-size: 18px;
            font-style: normal;
        }

        .op3center {
            text-align: center;
            padding: 10px;
            margin: auto;
            color: #8B0900;


            font-style: normal;
        }

        .circle {
            border: 1px solid black;
            border-radius: 50%;

            padding: 5px;
        }

        .circlered {
            border: 1px solid red;
            background-color: #8B0900;
            border-radius: 50%;
            font-size: 2em;
            padding: 30px;
        }

        .button3:hover {
            background-color: #f44336;
            color: white;
        }

        .blockop {
            display: block;
            width: 100%;
            color: white;
            border: none;
            background-color: #8B0900;
            padding: 14px 28px;
            font-size: 18px;
            cursor: pointer;
            text-align: center;
        }

        .icon_bg {
            background-color: #808080;
            border-radius: 50px;
            -moz-box-shadow: 0 5px 14px -1px rgba(55, 65, 67, 0.2);
            -webkit-box-shadow: 0 5px 14px -1px rgb(55 65 67 / 20%);
            box-shadow: 0 5px 14px -1px rgb(55 65 67 / 20%);
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
        }
    </style>
    {{-- begin #Profile --}}


    <img src="{{ asset('images/bannermockup2.png') }}" style="  width: 100%;"><br>

    <div class="main opcenter">

        <div class="row">
            <div class="col-lg-12 optop">
                <style>
                    .memberlink li {
                        list-style: none;
                        padding-bottom: 10px;
                        font-size: 0.9em;
                    }

                    .memberlink li a {
                        color: #6a5753;
                    }

                    table {
                        border-collapse: collapse;
                        width: 100%;
                    }

                    th,
                    td {
                        text-align: left;
                        padding: 8px;
                    }

                    tr:nth-child(even) {
                        background-color: #eed6d6;
                    }

                    .buttonop {
                        display: block;
                        width: 70%;
                        color: #808080;
                        border: none;
                        background-color: #e7e7e7;
                        padding: 3px 3px;
                        font-size: 14px;
                        cursor: pointer;
                        text-align: center;
                        border-radius: 15px;
                    }
                </style>

                <br>
                <h4 class="left" style="color: black;">เนื้อหาหลักสูตร</h4>

                <br>
                <div class="opcenter">
                    <div id="accordion">
                        @foreach($chapter as $key => $chap)
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <div class="mb-0 ">
                                    <div class="row">
                                        <div class="col-4 left">
                                            <h5>บทเรียนที่ {{$chap->order}} {{$chap->name}}
                                                <button class="btn btn-link" data-toggle="collapse"
                                                    data-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    <i class="fa fa-chevron-down circle" style="color: black;"
                                                        aria-hidden="true"></i> </button>
                                            </h5>
                                        </div>
                                        <div class="col-6 right">
                                            <i class="fa fa-play-circle " style="color: black;" aria-hidden="true"></i>
                                            วิดีโอ {{$chap->video_number}} &nbsp;&nbsp; <i class="fa fa-clock-o" style="color: black;"
                                                aria-hidden="true"></i> {{$chap->time_number}} ชั่วโมง
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div id="collapseOne" class="collapse <?php if($key==0){echo 'show';} ?>" aria-labelledby="headingOne"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <?php
                                           $list = \App\Models\CourseList::where('course_id',$chap->course_id)->where('chapter_id',$chap->id)->get();
                                           $question_detail = \App\Models\QuestionsDetail::where('chapter_id',$chap->id)->get();
                                        ?>
                                    @foreach($list as $key2 => $l)
                                    {{-- start #course --}}
                                    <div class="row">
                                        <div class="col-1">
                                            <h5>{{$l->course_order}}</h5>
                                        </div>
                                        <div class="col-2">
                                            <a href="{{ url('course_online_inside_view/'.$l->id) }}">
                                                <img src="{{ asset('images/profile/'.$l->course_image) }}" class="mw-100 mb-3">
                                            </a>
                                        </div>
                                        <div class="col-7">
                                            <div class="row">
                                                <div class="col-12 left">
                                                    <h5>{{$l->course_name}}</h5>
                                                </div>
                                                <div class="col-12 left">
                                                    <p>
                                                        {{$l->course_detail}}
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            {{$l->course_time}} นาที
                                        </div>
                                    </div>
                                    {{-- end #course --}}
                                    @endforeach

                                    @foreach($question_detail as $key3 => $q)
                                    <?php
                                       $question_count = \App\Models\Questions::where('question_detail_id',$q->id)->count();
                                    ?>
                                    {{-- start #test --}} <br>
                                    <div class="row">

                                        <div class="col-1">
                                            <h5></h5>
                                        </div>
                                        <div class="col-2">
                                            <h5> <i class="fa fa-file-text circlered" style="color: white;"
                                                    aria-hidden="true"></i></h5>
                                        </div>
                                        <div class="col-7">
                                            <div class="row">
                                                <div class="col-12 left">
                                                    <h5>{{$q->name}}</h5>
                                                </div>
                                                <div class="col-12 left">
                                                    <p> จำนวนทั้งหมด {{$question_count}} ข้อ </p>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">

                                            <h5> <i class="fa fa-check-circle" style="color: green;" aria-hidden="true"></i>
                                            </h5>

                                        </div>
                                    </div>
                                    <br>{{-- end #test --}}
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>

        </div> {{-- end #main --}}


        {{-- end #Profile --}}
        <script src="{{ asset('js/app.js') }}"></script>
    @endsection
    @section('script')
        <script type="text/javascript">
            function showHideDiv() {
                var srcElement = document.getElementById('divBoxComment');
                if (srcElement != null) {
                    if (srcElement.style.display == "block") {
                        // console.log(1);
                        document.getElementById('divBoxComment').style.display = 'none';
                    } else {
                        // console.log(2);
                        document.getElementById('btnComment').style.display = 'none';
                        document.getElementById('divBoxComment').style.display = 'block';
                    }
                    return false;
                }
            }
        </script>
        @if (session()->has('status'))
            <script>
                Swal({
                    type: 'success',
                    title: "<?php echo session()->get('status'); ?>",
                    showConfirmButton: false,
                    timer: 1500
                })
            </script>
        @endif
        @if (session()->has('gb_success'))
            <script>
                Swal({
                    position: 'top-end',
                    type: 'success',
                    title: "<?php echo session()->get('gb_success'); ?>",
                    showConfirmButton: false,
                    timer: 1500
                })
            </script>
        @endif
        @if (session()->has('gb_error'))
            <script>
                Swal({
                    position: 'top-end',
                    type: 'error',
                    title: "<?php echo session()->get('gb_error'); ?>",
                    showConfirmButton: false,
                    timer: 1500
                })
            </script>
        @endif
    @endsection
