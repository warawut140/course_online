@extends('layouts.navber')
@section('head')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    {{-- <script src="https://rawgit.com/vuejs/vue/dev/dist/vue.js"></script> --}}
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet">
    {{-- <script>
        function checkTypeUser(id) {
            if (id == 2) {
                $('#typeUser').show();
            } else {
                $('#typeUser').hide();
            }
        }
    </script> --}}
    <style>
        body {}

        .main {
            background-image: url("{{ asset('images/bgco.png') }}");
            background-repeat: no-repeat;
            background-size: auto;

            margin-right: 200px;
            margin-left: 200px;
        }

        .bg-light2 {
            /* background-color: #8B0900;
                                                                                                        background-image: url("{{ asset('image/bg.png') }}"); */
            /* clear: both; */
        }


        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            border-left: 15px solid #8B0900;
            background-color: white;
            color: black;
        }

        .gray {
            color: #fff;
            background-color: #8B0900;
        }

        .nav-pills a.nav-link {
            color: black;
            border-bottom: 1px solid #d9d9d9;
        }

        .select2-container .select2-selection--single {
            height: 30px;
        }

        .input-group-text {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding: 0.375rem 0.75rem;
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #ffffff;
            text-align: center;
            white-space: nowrap;
            background-color: #8B0900;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .input-group-text2 {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding: 0.375rem 0.75rem;
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #ffffff;
            text-align: center;
            white-space: nowrap;
            background-color: #f8f8f8;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .circlered {
            background-color: #8B0900;
            border-radius: 50%;
            border: 1px solid #8B0900;
            padding: 10px;
        }

        .circlegreen {
            background-color: green;
            border-radius: 50%;
            border: 1px solid green;
            padding: 10px;
        }

        .left {
            text-align: left;

            margin-left: 280px;
            margin-Right: 20px;
        }

        . {
            text-align: left;

            margin-left: 20px;
            margin-Right: 20px;
        }

        .right {
            text-align: right;

            margin-Right: 80px;
            margin-left: 20px;
        }
    </style>
@endsection
@section('content')
    <div id="app" class="main">


        <br>
        <div class="">
            @if (@$type == 'check')
                <a href="{{ url('profile_company/workshop') }}" style="background-color: #8B0900; color:white;"
                    class="btn "><i class="fa fa-chevron-left" aria-hidden="true"></i> ย้อนกลับ </a>
            @else
                <a href="{{ url('course_online_view/' . $course->id) }}" style="background-color: #8B0900; color:white;"
                    class="btn "><i class="fa fa-chevron-left" aria-hidden="true"></i> ย้อนกลับ </a>
            @endif
        </div>
        <br>
        @if (!$pro_quest_detail)
            <form method="POST" action="{{ url('workshop_inside_store') }}" id="searchForm" enctype="multipart/form-data">
                @csrf
        @endif

        @if (@$type == 'check')
            <form method="POST" action="{{ url('workshop_inside_store') }}" id="searchForm" enctype="multipart/form-data">
                @csrf
        @endif

        <input type="hidden" name="question_detail_id" value="{{ $question_detail->id }}">
        <input type="hidden" name="course_id" value="{{ $course->id }}">
        <input type="hidden" name="type" value="{{ @$type }}">

        @if (@$type == 'check')
            <input type="hidden" name="user_id" value="{{ @$pro_quest_detail->user_id }}">
            <input type="hidden" name="pro_quest_detail_id" value="{{ @$pro_quest_detail->id }}">
        @endif


        <div class="col-xl-12 offset-xl-12 col-lg-12 offset-lg-12 col-md-12 offset-md-12">


            <h4 style="color:#8B0900;"><i class="fa fa-file-text circlered " aria-hidden="true" style="color:white;"></i>
                แบบทดสอบ/WORKSHOP</h4>
            <br><br>
            {{-- begin #header --}}
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <h3>{{ $question_detail->name }} </h3>
                        </div>
                        <div class="form-group col-md-12">
                            <h5 style="color:gray;">{{ $question_detail->details }}</h5>
                        </div> <br><br>
                        <div class="form-group col-md-12">
                            <h5 style="color:gray;"> จำนวนทั้งหมด {{ $question_count }} ข้อ</h5>
                        </div>
                        <div class="form-group col-md-12">
                            <h5 style="color:gray;"> คะแนนทั้งหมด {{ $question_score_sum }} คะแนน</h5>
                        </div>
                        <div class="form-group col-md-12">
                            <h5 style="color:gray;"> ผ่านที่ {{ $question_detail->score_success }} คะแนน</h5>
                        </div>
                    </div>
                    @if ($pro_quest_detail)
                        <div class="right">
                            <?php
                            $color = 'green';
                            $status = '';
                            if ($pro_quest_detail->status == 0) {
                                $status = 'รอผลตรวจ';
                                $color = 'orange';
                            }
                            if ($pro_quest_detail->status == 1) {
                                $status = 'ผ่าน';
                                $color = 'green';
                            }
                            if ($pro_quest_detail->status == 2) {
                                $status = 'ไม่ผ่าน';
                                $color = 'red';
                            }

                            ?>
                            <h4 style="color:{{ $color }};"> {{ $status }} <i
                                    class="fa fa-check-circle circlegreed " aria-hidden="true"
                                    style="color:{{ $color }};"></i></h4>
                            <div class="form-group col-md-12">
                                <h4 style="color:green;"> {{ $pro_quest_detail->score }} /
                                    {{ $question_detail->score_success }} คะแนน
                                </h4>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            {{-- end #header --}}

            <?php
            $disable = '';
            if ($pro_quest_detail) {
                if ($pro_quest_detail->status == 2) {
                    $disable = '';
                } else {
                    $disable = 'disabled';
                }
            }
            ?>



            @foreach ($question as $key => $quest)
                {{-- begin #ข้อกา --}}

                <?php
                if ($pro_quest_detail) {
                    if ($pro_quest_detail->status != 2) {
                        $ans_data = DB::table('answers')
                            ->where('question_id', $quest->id)
                            ->first();
                    } else {
                        if (@$type == 'check') {
                            $ans_data = DB::table('answers')
                                ->where('question_id', $quest->id)
                                ->first();
                        } else {
                            $ans_data = '';
                        }
                    }
                } else {
                    $ans_data = '';
                }

                ?>

                @if ($quest->option_type_id == 2)
                    <?php

                    $oq1 = \DB::table('options')
                        ->select('name', 'id', 'correct_answer')
                        ->where('question_id', $quest->id)
                        ->where('position', 1)
                        ->first();
                    $oq2 = \DB::table('options')
                        ->select('name', 'id', 'correct_answer')
                        ->where('question_id', $quest->id)
                        ->where('position', 2)
                        ->first();
                    $oq3 = \DB::table('options')
                        ->select('name', 'id', 'correct_answer')
                        ->where('question_id', $quest->id)
                        ->where('position', 3)
                        ->first();
                    $oq4 = \DB::table('options')
                        ->select('name', 'id', 'correct_answer')
                        ->where('question_id', $quest->id)
                        ->where('position', 4)
                        ->first();

                    ?>

                    <br><br>
                    <h1 style="color:#8B0900;"> {{ $key + 1 }}</h1>

                    <div class="card">

                        <div class="card-body">

                            <div class="form-row">
                                <div class="form-group col-md-12"><br>
                                    <h5 style="color:gray;">{{ $quest->name }} </h5>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12 ">
                                        <h5 style="color:gray;"> <input {{ $disable }} type="radio" id="html"
                                                <?php if (@$ans_data->option_id == $oq1->id) {
                                                    echo 'checked';
                                                } ?> required name="option_ans[{{ $quest->id }}]"
                                                value="{{ $oq1->id }}">
                                            <label for="html">{{ $oq1->name }}</label><br>
                                        </h5>
                                    </div>

                                    <div class="form-group col-md-12 ">
                                        <h5 style="color:gray;"> <input {{ $disable }} type="radio" id="html"
                                                required <?php if (@$ans_data->option_id == $oq2->id) {
                                                    echo 'checked';
                                                } ?> name="option_ans[{{ $quest->id }}]"
                                                value="{{ $oq2->id }}">
                                            <label for="html">{{ $oq2->name }}</label><br>
                                        </h5>
                                    </div>

                                    <div class="form-group col-md-12 ">
                                        <h5 style="color:gray;"> <input {{ $disable }} type="radio" id="html"
                                                required <?php if (@$ans_data->option_id == $oq3->id) {
                                                    echo 'checked';
                                                } ?> name="option_ans[{{ $quest->id }}]"
                                                value="{{ $oq3->id }}">
                                            <label for="html">{{ $oq3->name }}</label><br>
                                        </h5>
                                    </div>
                                    <div class="form-group col-md-12 ">
                                        <h5 style="color:gray;"> <input {{ $disable }} type="radio" id="html"
                                                required <?php if (@$ans_data->option_id == $oq4->id) {
                                                    echo 'checked';
                                                } ?> name="option_ans[{{ $quest->id }}]"
                                                value="{{ $oq4->id }}">
                                            <label for="html">{{ $oq4->name }}</label><br>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end #ข้อกา --}}
                @elseif($quest->option_type_id == 1)
                    {{-- begin #ข้อขียน --}}
                    <br><br>
                    <h1 style="color:#8B0900;"> {{ $key + 1 }}</h1>
                    <div class="card">
                        <div class="card-body">

                            <div class="form-row">
                                <div class="form-group col-md-12"><br>
                                    <h5 style="color:gray;">{{ $quest->name }} </h5>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12 ">
                                        <textarea class="form-control" {{ $disable }} name="text_ans[{{ $quest->id }}]" required rows="5"> {{ @$ans_data->option_text }} </textarea>
                                    </div>

                                    @if ($ans_data)
                                        @if ($ans_data->ans_file != '')
                                            <div class="form-group col-md-12">
                                                <a href="{{ url('getDownload/ans/' . $ans_data->ans_file) }}">
                                                    <h5> <i class="fa fa-file"></i> มีไฟล์คำตอบ ดาวโหลดคลิก</h5>
                                                </a>
                                            </div>
                                            <br>
                                        @endif
                                    @endif

                                    <div class="form-group col-md-12">
                                        <input type="file" name="ans_file[{{ $quest->id }}]" class="form-control">
                                    </div>



                                    <div class="form-group col-md-3">
                                        <div class="card">
                                            <div class="card-body">

                                                <h5 style="color:#8B0900; text-align: center;"> {{ $quest->score }}
                                                    คะแนน
                                                </h5>
                                            </div>
                                        </div>
                                    </div>

                                    @if (@$type == 'check')
                                        <div class="form-group col-md-6 ">
                                            <select class="form-control" required
                                                name="text_ans_check[{{ @$ans_data->id }}]">
                                                <option value="">กรุณาเลือกผลตรวจ</option>
                                                <option @if(@$ans_data->pass == 1) selected @endif value="1">ถูก</option>
                                                <option @if(@$ans_data->pass == 2) selected @endif value="2">ผิด</option>
                                            </select>
                                        </div>
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end #ข้อขียน --}}
                @endif
            @endforeach

            <br><br>

            <?php
            if (@$type == 'check') {
                $disable = '';
            }
            ?>
            @if (@$type == 'check')
                <div class="form-group">
                    <button type="submit" {{ $disable }} class="btn btn-outline-success w-100"
                        onclick="return confirm('ยืนยันการทำรายการ?')">ยืนยันผล</button>
                </div>
            @else
                @if (!$pro_quest_detail)
                    <div class="form-group">
                        <button type="submit" {{ $disable }} class="btn btn-outline-success w-100"
                            onclick="return confirm('ยืนยันการทำรายการ?')">ส่งคำตอบ</button>
                    </div>
                @else
                    @if ($pro_quest_detail->status == 2)
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-success w-100"
                                onclick="return confirm('ยืนยันการทำรายการ?')">แก้ไขคำตอบ</button>
                        </div>
                    @endif
                @endif
            @endif

            <br><br>

        </div>

        </form>

    </div>
    {{-- </div>
    </div> --}}

    <!-- Modal ข้อตกลงและเงื่อนไข-->
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ข้อตกลงและเงื่อนไข</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                        </button>
                    </div>
                    <div class="modal-body text-justify">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                        anim id est laborum
                    </div>
                </div>
            </div>
        </div> --}}
    {{-- end #register --}}
    {{-- </div> --}}
    {{-- <script src="/js/app.js" charset="utf-8"></script> --}}
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
@endsection
@section('script')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('select2/select2.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // $('#typeUser').hide();
            $('.select2').select2({
                width: '100%',
            });
            // CKEDITOR.replace('detail_scope');

            setTimeout(function() {
                $('.success').hide()
            }, 2000);
            setTimeout(function() {
                $('.error').hide()
            }, 2000);

        });



        $(function() {
            $(":checkbox[name=i_accept]").on("click", function() {
                var i_check = $(this).prop("checked");
                console.log(i_check);
                if (i_check == true) {
                    $("button[name=btn_send]").attr("disabled", false);
                } else {
                    $("button[name=btn_send]").attr("disabled", true);
                }
            });
        });
    </script>
    <script>
        $('.bg-light').css({
            'min-height': $(window).height() - $('.navbar').height() - $('#section-footer').height()
        });
    </script>
@endsection
