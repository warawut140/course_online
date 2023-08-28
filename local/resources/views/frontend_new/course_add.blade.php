<!doctype html>
<html lang="th">

<head>
    @include('frontend_new.header')
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
</head>

<body>


    @include('frontend_new.menu')

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
                        <div class="left">
                            <a href="{{ url('register_company_detail/course') }}"
                                style="background-color: #8B0900; color:white;" class="btn "><i
                                    class="fa fa-chevron-left" aria-hidden="true"></i> ย้อนกลับ </a>
                        </div>
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
                                <form method="POST" action="{{ url('course_store') }}" id="searchForm"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="border shadow rounded p-6 p-md-9">

                                        <input type="hidden" name="course_id" value="{{ @$data->id }}">

                                        <h5>ข้อมูลคอร์สเรียน</h5>

                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="status">สถานะ</label>
                                                <select class="form-control placeholder-1" required name="status">
                                                    <option value="">กรุณาเลือก</option>
                                                    <option <?php if (@$data->status == 0) {
                                                        echo 'selected';
                                                    } ?> value="0">ปิด</option>
                                                    <option <?php if (@$data->status == 1) {
                                                        echo 'selected';
                                                    } ?> value="1">เปิด</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="name">ชื่อคอร์ส</label>
                                                <input type="text" required class="form-control placeholder-1"
                                                    value="{{ @$data->name }}" id="name" name="name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label for="detail">เพิ่มรายละเอียดของคอร์ส</label>
                                                <textarea type="text" class="form-control placeholder-1 detail_ck" name="detail">{{ @$data->detail }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="video_number">วิดิโอทั้งหมด</label>
                                                <input type="text" class="form-control placeholder-1"
                                                    value="{{ @$data->video_number }}" id="video_number"
                                                    name="video_number">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="time_number">ชั่วโมงเรียนทั้งหมด (ชั่วโมง)</label>
                                                <input type="text" class="form-control placeholder-1"
                                                    id="time_number" value="{{ @$data->time_number }}"
                                                    name="time_number">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="status">คอร์สที่ต้องสำเร็จก่อน</label>
                                            </div>
                                            <div class="col-md-12">
                                                <?php
                                                @$c_arr = explode(',', @$data->befor_course);
                                                ?>
                                                @foreach ($courses as $key => $c)
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" <?php
                                                        if (in_array($c->id, $c_arr)) {
                                                            echo 'checked';
                                                        }
                                                        ?>
                                                            type="checkbox" id="inlineCheckbox{{ $key }}"
                                                            name="befor_course[]" value="{{ $c->id }}">
                                                        <label class="form-check-label"
                                                            for="inlineCheckbox{{ $key }}">{{ $c->name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <label for="certificate_file">File Certificate</label>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="file" class="form-control placeholder-1"
                                                        id="certificate_file" name="certificate_file">
                                                    @if (@$data->certificate_file != '')
                                                        <img src="{{ asset('images/profile/' . @$data->certificate_file) }}"
                                                            width="300px" height="250px">
                                                        {{-- <br><a href="{{url('certificate_dowload')}}">Certificate download</a> --}}
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" required <?php if (@$data->certificate_status == 1) {
                                                            echo 'checked="checked"';
                                                        } ?>
                                                            type="radio" name="certificate_status" id="inlineRadio1"
                                                            value="1">
                                                        <label class="form-check-label"
                                                            for="inlineRadio1">Certificate</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" required <?php if (@$data->certificate_status == 2) {
                                                            echo 'checked="checked"';
                                                        } ?>
                                                            type="radio" name="certificate_status" id="inlineRadio2"
                                                            value="2">
                                                        <label class="form-check-label" for="inlineRadio2">No
                                                            Certificate</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="">ภาพหน้าปกคอร์สเรียน</label>
                                                <input type="file" class="form-control placeholder-1"
                                                    id="image" name="image">
                                                @if (@$data->image != '')
                                                    <div class="row row-cols-lg-2 mb-8">
                                                        <img src="{{ asset('images/profile/' . @$data->image) }}">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-outline-primary w-100"
                                                    onclick="return confirm('ยืนยันการทำรายการ?')">บันทึก</button>
                                            </div>
                                        </div>

                                        {{-- <div class="form-group">
                                        <a href="{{ url('register_company_detail/course') }}"
                                            class="btn btn-outline-secondary w-100">ย้อนกลับ</a>
                                    </div> --}}

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

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">บทเรียน</label>
                                                @foreach ($chapter as $c)
                                                    <div class="input-group mb-3">
                                                        <input type="text" value="{{ @$c->name }}"
                                                            class="form-control form-control-sm"
                                                            placeholder="Recipient's username" readonly
                                                            aria-label="Recipient's username"
                                                            aria-describedby="basic-addon2">
                                                        <div class="input-group-append">
                                                            <a href="{{ url('chapter_view/' . @$c->id) }}"><span
                                                                    class="input-group-text"
                                                                    id="basic-addon2">ตั้งค่าบทเรียน &nbsp;<i
                                                                        class="fa fa-gear"></i></span></a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {{-- <button type="submit" class="btn btn-outline-success w-100">บันทึก</button> --}}
                                            {{-- <button class="btn btn-outline-primary">+ เพิ่มคอร์สเรียน</button> --}}
                                            <a class="btn btn-outline-primary"
                                                href="{{ url('chapter_add/' . @$data->id) }}">+ เพิ่มบทเรียน</a>
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

            @endif

            <br>


        </div>


    </div>


    @include('frontend_new.footer')

    <script>
           ClassicEditor
            .create(document.querySelector('.detail_ck'))
            .catch(error => {
                console.error(error);
            });

    </script>

</body>

</html>
