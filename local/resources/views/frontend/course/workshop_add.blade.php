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
        .bg-light2 {
            /* background-color: #8B0900;
                              background-image: url("{{ asset('image/bg.png') }}"); */
            /* clear: both; */
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
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
    </style>
@endsection
@section('content')
    <div id="app">

        @if (session('success'))
            <div class="p-3 mb-2 bg-success text-white success text-center">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="p-3 mb-2 bg-danger text-white error text-center">{{ session('error') }}</div>
        @endif

        {{-- begin #register --}}
        <div id="register-section1" class="bg-light2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <br>
                        <h4 style="color:#8B0900;">เพิ่มแบบทดสอบ/Workshop ของ {{ @$course->name }}</h4>
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title text-center">สมัครสมาชิก</h5> --}}
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="POST" action="{{ url('workshop_store') }}" id="searchForm"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="course_id" value="{{ @$course->id }}">
                                    <input type="hidden" name="chapter_id" value="{{ @$chapter->id }}">
                                    <input type="hidden" name="workshop_id" value="{{ @$data->id }}">

                                    <h5>แบบทดสอบ/Workshop</h5>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="type">แบบทดสอบ/Workshop</label>
                                            <select class="form-control" required name="type">
                                                {{-- <option value="">กรุณาเลือก</option> --}}
                                                <option <?php if (@$data->type == 1) {
                                                    echo 'selected';
                                                } ?> value="1">Workshop</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="name">ชื่อแบบทดสอบ/Workshop</label>
                                            <input type="text" required class="form-control" required
                                                value="{{ @$data->name }}" id="name" name="name">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="course_list_id">เรื่องที่เรียน</label>
                                            <select class="form-control" required name="course_list_id">
                                                <option value="">กรุณาเลือก</option>
                                                @foreach ($list as $l)
                                                    <option <?php if (@$data->course_list_id == @$l->id) {
                                                        echo 'selected';
                                                    } ?> value="{{ @$l->id }}">
                                                        {{ @$l->course_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="time_test">เวลาที่ใช้สอบ</label>
                                            <input type="time" class="form-control time_test" required name="time_test"
                                                value="{{ @$data->time_test }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="details">คำอธิบายเพิ่มเติม</label>
                                            <textarea type="text" class="form-control" name="details">{{ @$data->details }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-outline-success w-100">บันทึก</button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <a href="{{ url('chapter_view/' . $chapter->id) }}"
                                            class="btn btn-outline-secondary w-100">ย้อนกลับ</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            @if (@$data)

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <br>
                            <div class="card">
                                <div class="card-body">
                                    {{-- <h5 class="card-title text-center">สมัครสมาชิก</h5> --}}
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <strong>Whoops!</strong> There were some problems with your input.
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">คำถาม</label>
                                            @foreach ($question as $c)
                                            <?php
                                                $oq1 = DB::table('options')->select('name','id','correct_answer')->where('question_id',$c->id)->where('position',1)->first();
                                                $oq2 = DB::table('options')->select('name','id','correct_answer')->where('question_id',$c->id)->where('position',2)->first();
                                                $oq3 = DB::table('options')->select('name','id','correct_answer')->where('question_id',$c->id)->where('position',3)->first();
                                                $oq4 = DB::table('options')->select('name','id','correct_answer')->where('question_id',$c->id)->where('position',4)->first();
                                                $corr = 0;
                                                if(@$oq1->correct_answer==1){
                                                    $corr = 1;
                                                }
                                                if(@$oq2->correct_answer==1){
                                                    $corr = 2;
                                                }
                                                if(@$oq3->correct_answer==1){
                                                    $corr = 3;
                                                }
                                                if(@$oq4->correct_answer==1){
                                                    $corr = 4;
                                                }
                                            ?>
                                                <div class="input-group mb-3">
                                                    <input type="text"
                                                        value="ข้อที่ {{ @$c->position }} . {{ @$c->name }}"
                                                        class="form-control form-control-sm"
                                                        placeholder="Recipient's username" readonly
                                                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                    <div class="input-group-append">
                                                        <a href="javascript:;" class="question_view"
                                                            q_id="{{ @$c->id }}"
                                                            q_name="{{ @$c->name }}"
                                                            position="{{ @$c->position }}"
                                                            option_type_id="{{ @$c->option_type_id }}"
                                                            course_list_id="{{ @$c->course_list_id }}"
                                                            question_detail_id="{{ @$c->question_detail_id }}"
                                                            ans="{{ @$c->ans }}"
                                                            op1="{{@$oq1->name}}"
                                                            op2="{{@$oq2->name}}"
                                                            op3="{{@$oq3->name}}"
                                                            op4="{{@$oq4->name}}"
                                                            corr="{{@$corr}}"
                                                            ><span
                                                                class="input-group-text" id="basic-addon2">ตั้งค่า
                                                                &nbsp;<i class="fa fa-gear"></i></span></a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a class="btn btn-outline-primary add_question" href="javascript:;">+
                                    เพิ่มคำถามข้อต่อไป</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal ข้อตกลงและเงื่อนไข-->
                <form method="POST" action="{{ url('question_store') }}" id="searchForm"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="modal fade" id="add_course_list_modal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">

                        <input type="hidden" name="course_id" value="{{ @$course->id }}" class="course_id">
                        <input type="hidden" name="chapter_id" value="{{ @$chapter->id }}" class="chapter_id">
                        <input type="hidden" name="question_detail_id" value="{{ @$data->id }}"
                            class="question_detail_id">
                            <input type="hidden" name="question_id" value=""
                            class="question_id">

                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มคำถาม</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                                    </button>
                                </div>
                                <div class="modal-body text-justify">
                                    <div class="course_list">
                                        <div class="items">


                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="option_type_id">ประเภทคำถาม</label>
                                                    <select class="form-control option_type_id" required
                                                        name="option_type_id">
                                                        <option value="">กรุณาเลือก</option>
                                                        <option value="1">คำตอบสั้นๆ</option>
                                                        <option value="2">หลายตัวเลือก</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label for="name">คำถาม</label>
                                                    <input type="text" class="form-control name" required
                                                        name="name">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label for="position">ลำดับ</label>
                                                    <input type="text" class="form-control position" required
                                                        name="position">
                                                </div>
                                            </div>

                                            <div class="display_choice_1">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <label for="ans">คำตอบสั้นๆ</label>
                                                        <textarea type="text" maxlength="254" class="form-control ans" name="ans"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="display_choice_2">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <label for="ans">ตัวเลือก</label>
                                                        <input type="text" placeholder="ตัวเลือกที่ 1"
                                                            class="form-control option_name1" value=""
                                                            id="option_name1" name="option_name1">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="ตัวเลือกที่ 2"
                                                            class="form-control option_name2" value=""
                                                            id="option_name2" name="option_name2">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="ตัวเลือกที่ 3"
                                                            class="form-control option_name3" value=""
                                                            id="option_name3" name="option_name3">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="ตัวเลือกที่ 4"
                                                            class="form-control option_name4" value=""
                                                            id="option_name4" name="option_name4">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <label for="">คำตอบที่ถูกต้อง</label>
                                                        <div class="col-md-12">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input option_correct" type="radio"
                                                                    name="option_correct" id="inlineRadio1"
                                                                    value="1">
                                                                <label class="form-check-label"
                                                                    for="inlineRadio1">ตัวเลือกที่
                                                                    1</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input option_correct" type="radio"
                                                                    name="option_correct" id="inlineRadio2"
                                                                    value="2">
                                                                <label class="form-check-label"
                                                                    for="inlineRadio2">ตัวเลือกที่
                                                                    2</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input option_correct" type="radio"
                                                                    name="option_correct" id="inlineRadio3"
                                                                    value="3">
                                                                <label class="form-check-label"
                                                                    for="inlineRadio3">ตัวเลือกที่
                                                                    3</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input option_correct" type="radio"
                                                                    name="option_correct" id="inlineRadio4"
                                                                    value="4">
                                                                <label class="form-check-label"
                                                                    for="inlineRadio4">ตัวเลือกที่
                                                                    4</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger"
                                        style="background-color: #8B0900; border-color: #8B0900;">Save changes</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                {{-- end #register --}}


            @endif




            <br>


        </div>


    </div>



    {{-- <script src="/js/app.js" charset="utf-8"></script> --}}
    <script src="{{ asset('js/app.js') }}"></script>
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

        $(document).on('click', '.add_question', function() {

            $('#add_course_list_modal .question_id').val('');
            $('#add_course_list_modal .name').val('');
            $('#add_course_list_modal .position').val('');
            $('#add_course_list_modal .option_type_id').val('');
            $('#add_course_list_modal .ans').val('');

            $('#add_course_list_modal .option_name1').val('');
            $('#add_course_list_modal .option_name2').val('');
            $('#add_course_list_modal .option_name3').val('');
            $('#add_course_list_modal .option_name4').val('');

            $('#add_course_list_modal .display_choice_1').hide();
            $('#add_course_list_modal .display_choice_2').hide();
            $('#add_course_list_modal').modal('show');
        });

        $(document).on('change', '.option_type_id', function() {
            var option_type_id = $(this).val();
            if (option_type_id == '1') {
                $('#add_course_list_modal .display_choice_1').show();
            } else {
                $('#add_course_list_modal .display_choice_1').hide();
            }
            if (option_type_id == '2') {
                $('#add_course_list_modal .display_choice_2').show();
            } else {
                $('#add_course_list_modal .display_choice_2').hide();
            }

        });

        $(document).on('click', '.question_view', function() {

            var q_id = $(this).attr('q_id');
            var q_name = $(this).attr('q_name');
            var position = $(this).attr('position');
            var option_type_id = $(this).attr('option_type_id');
            var course_list_id = $(this).attr('course_list_id');
            var question_detail_id = $(this).attr('question_detail_id');
            var ans = $(this).attr('ans');

            var op1 = $(this).attr('op1');
            var op2 = $(this).attr('op2');
            var op3 = $(this).attr('op3');
            var op4 = $(this).attr('op4');
            var corr = $(this).attr('corr');

            $('#add_course_list_modal .question_id').val(q_id);
            $('#add_course_list_modal .name').val(q_name);
            $('#add_course_list_modal .position').val(position);
            $('#add_course_list_modal .option_type_id').val(option_type_id);
            $('#add_course_list_modal .course_list_id').val(course_list_id);
            $('#add_course_list_modal .question_detail_id').val(question_detail_id);
            $('#add_course_list_modal .ans').val(ans);

            $('#add_course_list_modal .option_name1').val(op1);
            $('#add_course_list_modal .option_name2').val(op2);
            $('#add_course_list_modal .option_name3').val(op3);
            $('#add_course_list_modal .option_name4').val(op4);
            var $radios = $('input:radio[name=option_correct]');

            if(corr==1){
                 $radios.filter('[value=1]').prop('checked', true);
            }
            if(corr==2){
                 $radios.filter('[value=2]').prop('checked', true);
            }
            if(corr==3){
                 $radios.filter('[value=3]').prop('checked', true);
            }
            if(corr==4){
                 $radios.filter('[value=4]').prop('checked', true);
            }

            if (option_type_id == '1') {
                $('#add_course_list_modal .display_choice_1').show();
            } else {
                $('#add_course_list_modal .display_choice_1').hide();
            }
            if (option_type_id == '2') {
                $('#add_course_list_modal .display_choice_2').show();
            } else {
                $('#add_course_list_modal .display_choice_2').hide();
            }


            $('#add_course_list_modal').modal('show');
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
