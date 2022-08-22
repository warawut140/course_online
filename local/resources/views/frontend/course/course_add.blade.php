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

        {{-- begin #register --}}
        <div id="register-section1" class="bg-light2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <br>
                        <h4 style="color:#8B0900;">ADD NEW COURSE</h4>
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
                                <form method="POST" action="{{ url('course_store') }}"
                                    id="searchForm" enctype="multipart/form-data">
                                    @csrf

                                    <h5>ข้อมูลคอร์สเรียน</h5>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="status">สถานะ</label>
                                            <select class="form-control" required name="status">
                                                <option value="">กรุณาเลือก</option>
                                                <option <?php if (@$data->status == 1) {
                                                    echo 'selected';
                                                } ?> value="0">ปิด</option>
                                                <option <?php if (@$data->status == 2) {
                                                    echo 'selected';
                                                } ?> value="1">เปิด</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="name">ชื่อคอร์ส</label>
                                            <input type="text" required class="form-control" id="name"
                                                name="name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="detail">เพิ่มรายละเอียดของคอร์ส</label>
                                            <textarea type="text" class="form-control" name="detail"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="video_number">วิดิโอทั้งหมด</label>
                                            <input type="text" class="form-control" id="video_number"
                                                name="video_number">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="time_number">ชั่วโมงเรียนทั้งหมด (ชั่วโมง)</label>
                                            <input type="text" class="form-control" id="time_number" name="time_number">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="exampleInputEmail1">File Certificate</label>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                                    name="imageProfile">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="certificate_status"
                                                        id="inlineRadio1" value="1">
                                                    <label class="form-check-label" for="inlineRadio1">Certificate</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="certificate_status"
                                                        id="inlineRadio2" value="2">
                                                    <label class="form-check-label" for="inlineRadio2">No
                                                        Certificate</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="">ภาพหน้าปกคอร์สเรียน</label>
                                            <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                                name="imageProfile">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-outline-success w-100"
                                                onclick="return confirm('ยืนยันการทำรายการ?')">บันทึก</button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <a href="{{ url('register_company_detail/course') }}"
                                            class="btn btn-outline-secondary w-100">ย้อนกลับ</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>



            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <br>
                        <h4 style="color:#8B0900;">เนื้อหาหลักสูตร</h4>
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
                                <form method="POST" action="{{ url('register_company_detail_basic_store') }}"
                                    id="searchForm" enctype="multipart/form-data">
                                    @csrf

                                    <h5>บทเรียน</h5>

                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <label for="exampleInputEmail1">ลำดับบทเรียน</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                name="tel">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="exampleInputEmail1">ชื่อบทเรียน</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                name="tel">
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">วิดิโอ</label>
                                            <input type="text" class="form-control" id="" name="tel">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">ชั่วโมงเรียนทั้งหมด (ชั่วโมง)</label>
                                            <input type="text" class="form-control" id="" name="tel">
                                        </div>

                                    </div>

                                    <hr>

                                    <h5>ข้อมูลหัวเรื่องในบท</h5>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="exampleInputEmail1">ชื่อเรื่อง</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                name="tel">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">เพิ่มรายละเอียดของเรื่อง</label>
                                            <textarea type="text" class="form-control" name="ssxx"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="">อัพโหลดไฟล์วิดิโอ</label>
                                            <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                                name="imageProfile">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-outline-success w-100">บันทึก</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

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
