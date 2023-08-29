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

                                <div class="border shadow rounded p-6 p-md-9">

                                    <form method="POST" action="{{ url('job_store') }}" id="searchForm"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="type" value="job">
                                        <input type="hidden" name="job_id" value="{{ @$data->id }}">

                                        <div class="form-group">
                                            <label for="position">ตำแหน่ง</label>
                                            <input type="text" class="form-control placeholder-1" required
                                                id="position" value="{{ @$data->position }}" name="position">
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="level">ระดับประสบการณ์</label>
                                                <input name="level" type="text" required
                                                    class="form-control placeholder-1" value="{{ @$data->level }}"
                                                    id="level">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="number_emp">จำนวนที่รับสมัคร</label>
                                                <input name="number_emp" type="text" required
                                                    class="form-control placeholder-1" value="{{ @$data->number_emp }}"
                                                    id="number_emp">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="location">สถานที่ทำงาน</label>
                                                {{-- <select class="form-control placeholder-1">
                                            <option value="">กรุณาเลือก</option>
                                            <option value="">Hybrid</option>
                                           </select> --}}
                                                <input name="location" type="text" value="{{ @$data->location }}"
                                                    required class="form-control placeholder-1" id="location">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="employment_type">ประเภทการจ้างงาน</label>
                                                <select class="form-control placeholder-1" name="employment_type"
                                                    required>
                                                    <option value="">กรุณาเลือก</option>
                                                    <option <?php if (@$data->employment_type == 1) {
                                                        echo 'selected';
                                                    } ?> value="1">เต็มเวลา</option>
                                                    <option <?php if (@$data->employment_type == 2) {
                                                        echo 'selected';
                                                    } ?> value="2">Part-time</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="job_detail">เพิ่มรายละเอียดของงาน</label>
                                            <textarea type="text" class="form-control detail_ck" name="job_detail">{{ @$data->job_detail }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="skill_detail">Skill ที่ต้องการ</label>
                                            <textarea type="text" class="form-control detail_ck2" name="skill_detail">{{ @$data->skill_detail }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label
                                                for="exampleInputEmail1">คอร์สเรียนที่ควรผ่านการเรียนรู้มาก่อน</label>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <select name="course_id_for_job[]" multiple="multiple"
                                                        class="form-control select2">
                                                        @foreach ($courses as $c)
                                                            <?php
                                                            $arr_c = [];
                                                            $arr_course_id_for_job = [];
                                                            if (@$data->course_id_for_job) {
                                                                $arr_course_id_for_job = explode(',', @$data->course_id_for_job);
                                                            }
                                                            foreach ($arr_course_id_for_job as $arr) {
                                                                $arr_c[$arr] = $arr;
                                                            }
                                                            ?>
                                                            <option <?php if (isset($arr_c[$c->id])) {
                                                                echo 'selected';
                                                            } ?> value="{{ $c->id }}">
                                                                {{ $c->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                {{-- <div class="col-md-6">
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
                                            </div> --}}
                                            </div>
                                        </div>

                                        {{-- <button class="btn btn-sm btn-outline-primary">+ เพิ่มคอร์สเรียน</button> --}}

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
                                                    <label class="form-check-label" for="salary_type2">No
                                                        รอเจรจา</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="salary" value="{{ @$data->salary }}" type="text"
                                                placeholder="จำนวนเงิน" class="form-control placeholder-1"
                                                id="salary">
                                        </div>

                                        <div class="form-group">
                                            <label for="payment_period">งวดการจ่ายเงิน</label>
                                            <select class="form-control placeholder-1" required name="payment_period">
                                                <option value="">กรุณาเลือก</option>
                                                <option <?php if (@$data->employment_type == 1) {
                                                    echo 'selected';
                                                } ?> value="1">รายเดือน</option>
                                                <option <?php if (@$data->employment_type == 2) {
                                                    echo 'selected';
                                                } ?> value="2">รายวัน</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-outline-primary w-100"
                                                onclick="return confirm('ยืนยันการทำรายการ?')">บันทึกตำแหน่งงาน</button>
                                        </div>


                                        <br>
                                        <div class="form-group">
                                            <a href="{{ url('register_company_detail/job') }}"
                                                class="btn btn-outline-secondary w-100">ย้อนกลับ</a>
                                        </div>

                                        @if (@$data)
                                            <br>
                                            <div class="form-group">
                                                <a href="{{ url('job_delete/' . $data->id) }}"
                                                    class="btn btn-outline-danger w-100"
                                                    onclick="return confirm('ยืนยันการลบรายการ?')">ลบ</a>
                                            </div>
                                        @endif

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


    </div>


    @include('frontend_new.footer')

    <script>
        ClassicEditor
         .create(document.querySelector('.detail_ck'))
         .catch(error => {
             console.error(error);
         });

         ClassicEditor
         .create(document.querySelector('.detail_ck2'))
         .catch(error => {
             console.error(error);
         });

 </script>


</body>

</html>