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
                        <h4 style="color:#8B0900;">ADD A JOB DESCRIPTION</h4>
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

                                <form method="POST" action="{{ url('job_store') }}" id="searchForm"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="type" value="job">
                                    <input type="hidden" name="job_id" value="{{ @$data->id }}">

                                    <div class="form-group">
                                        <label for="position">ตำแหน่ง</label>
                                        <input type="text" class="form-control" required id="position"
                                            value="{{ @$data->position }}" name="position">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="level">ระดับประสบการณ์</label>
                                            <input name="level" type="text" required class="form-control"
                                                value="{{ @$data->level }}" id="level">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="number_emp">จำนวนที่รับสมัคร</label>
                                            <input name="number_emp" type="text" required class="form-control"
                                                value="{{ @$data->number_emp }}" id="number_emp">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="location">สถานที่ทำงาน</label>
                                            {{-- <select class="form-control">
                                            <option value="">กรุณาเลือก</option>
                                            <option value="">Hybrid</option>
                                           </select> --}}
                                            <input name="location" type="text" value="{{ @$data->location }}" required
                                                class="form-control" id="location">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="employment_type">ประเภทการจ้างงาน</label>
                                            <select class="form-control" name="employment_type" required>
                                                <option value="">กรุณาเลือก</option>
                                                <option <?php if (@$data->employment_type == 1) {
                                                    echo 'selected';
                                                } ?> value="1">เต็มเวลา</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="job_detail">เพิ่มรายละเอียดของงาน</label>
                                        <textarea type="text" class="form-control" name="job_detail">{{ @$data->job_detail }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="skill_detail">Skill ที่ต้องการ</label>
                                        <textarea type="text" class="form-control" name="skill_detail">{{ @$data->skill_detail }}</textarea>
                                    </div>

                                    {{-- <div class="form-group">
                                        <label for="exampleInputEmail1">คอร์สเรียนที่ควรผ่านการเรียนรู้มาก่อน</label>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <select name="" class="form-control select2">
                                                    <option value="">กรุณาเลือกคอร์สเรียน</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                        id="inlineRadio1" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1">Certificate</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                        id="inlineRadio2" value="option2">
                                                    <label class="form-check-label" for="inlineRadio2">No
                                                        Certificate</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-sm btn-outline-primary">+ เพิ่มคอร์สเรียน</button> --}}

                                    <div class="form-group">
                                        <br>
                                        <label for="exampleInputEmail1">เงินเดือน</label>
                                        <br>
                                        <div class="col-md-6">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" <?php if (@$data->salary_type == 1) {
                                                    echo 'checked="checked"';
                                                } ?> type="radio"
                                                    name="salary_type" id="salary_type1" value="1">
                                                <label class="form-check-label" for="salary_type1">กำหนด</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" <?php if (@$data->salary_type == 2) {
                                                    echo 'checked="checked"';
                                                } ?> type="radio"
                                                    name="salary_type" id="salary_type2" value="2">
                                                <label class="form-check-label" for="salary_type2">No รอเจรจา</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input name="salary" value="{{ @$data->salary }}" type="text"
                                            placeholder="จำนวนเงิน" class="form-control" id="salary">
                                    </div>

                                    <div class="form-group">
                                        <label for="payment_period">งวดการจ่ายเงิน</label>
                                        <select class="form-control" required name="payment_period">
                                            <option value="">กรุณาเลือก</option>
                                            <option <?php if (@$data->employment_type == 1) {
                                                echo 'selected';
                                            } ?> value="1">รายเดือน</option>
                                            <option <?php if (@$data->employment_type == 2) {
                                                echo 'selected';
                                            } ?> value="2">รายวัน</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-success w-100"
                                            onclick="return confirm('ยืนยันการทำรายการ?')">บันทึกตำแหน่งงาน</button>
                                    </div>

                                    @if(@$data)
                                        <div class="form-group">
                                            <a href="{{ url('job_delete/' . $data->id) }}"
                                                class="btn btn-outline-danger w-100"
                                                onclick="return confirm('ยืนยันการลบรายการ?')">ยกเลิก</a>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <a href="{{ url('register_company_detail/job') }}"
                                            class="btn btn-outline-secondary w-100">ย้อนกลับ</a>
                                    </div>

                                    {{-- <div class="form-group" >
                                        <button type="submit" style="background-color: #8B0900; color:white;" class="btn  w-100">Submit</button>
                                     </div> --}}
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

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
