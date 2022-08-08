@extends('layouts.navber')
@section('head')
    @include('sweetalert::alert')
    <link href="{{ asset('assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
@endsection
@section('content')
    <div id="projectauction-banner" class="bg-projectauction">
        <div class="container py-5">
            <div class="text-headbanner">ประมูลงานระบบ</div>
        </div>
    </div>
    <div id="projectauction-section1" class="bg-white">
        <div class="container text-center py-4">
            <h1 class="mb-5">ประมูลงานระบบ ยังไง?</h1>
            <div class="row">
                <div class="col-sm my-2">
                    <img src="{{ asset('images/aucproject-icon01.png') }}" class="mw-100 mb-3">
                    <p>สร้างกระทู้ พร้อมรายละเอียดงาน พร้อมทั้งราคางบประมาณ และระยะเวลา</p>
                </div>
                <div class="col-sm my-2">
                    <img src="{{ asset('images/aucproject-icon02.png') }}" class="mw-100 mb-3">
                    <p>ผู้รับเหมาต่างๆ เข้ามาในกระทู้พร้อมทั้งเขียนแจกแจงงานที่จะทำ รวมถึงงบประมาณราคา</p>
                </div>
                <div class="col-sm my-2">
                    <img src="{{ asset('images/aucproject-icon03.png') }}" class="mw-100 mb-3">
                    <p>เจ้าของกระทู้งานเข้าตรวจดูตารางเปรียบเทียบที่ผู้รับเหมากรอกมาในกระทู้</p>
                </div>
                <div class="col-sm my-2">
                    <img src="{{ asset('images/aucproject-icon04.png') }}" class="mw-100 mb-3">
                    <p>จากนั้นตัวเจ้าของโครงการเลือกผู้รับเหมาที่ตนต้องการให้รับผิดชอบงาน</p>
                </div>
            </div>
        </div>
    </div>

    {{-- begin #ประมูลโครงการ --}}
    <div id="app">
        @if($projectAuction != null)
            <div id="projectauction-section2" class="bg-light">
                <div class="container py-4">
                    <h1 class="text-center mb-5">ประมูลโครงการ</h1>
                    <div class="row">
                        @foreach($projectAuction as $data)
                            <div class="col-lg-6">
                                <div class="card border-warning rounded-0 test-articlebox mb-4">
                                    <a href="{{ url('projectauction/'.$data->id) }}">
                                        <div class="card-body p-2">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <h5 class="card-title mb-0">{{ $data->project_name }}</h5>
                                                    {{--<small class="text-secondary">สร้างเมื่อ <span>13 ธันวาคม 2561</span> เวลา <span>14.56</span></small>--}}
                                                    <small class="text-secondary">สร้างเมื่อ
                                                        <?php
                                                        list($year, $month, $day) = explode('-', date('Y-m-d', strtotime($data->created_at)));
                                                        if ($day < 10) {
                                                            $day = substr($day, 1, 1);
                                                        }

                                                        $thMonth = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
                                                            "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                                                        if ($month < 10) {
                                                            $month = substr($month, 1, 1);
                                                        }
                                                        $year += 543;
                                                        echo $day . "&nbsp;" . $thMonth[$month - 1] . "&nbsp;" . $year;
                                                        ?>
                                                        เวลา <span>{{ date('H:i',strtotime($data->created_at)) }}</span>
                                                    </small>
                                                    <div class="text-des-projectauc">รายละเอียดงาน :
                                                        {!! $data->details !!}
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 border-left border-warning">
                                                    <p>
                                                        <span class="badge badge-warning">ประเภทงาน: <span>{{ $data->type_project }}</span></span>
                                                    </p>
                                                    <ul class="fa-ul">
                                                        <li><span class="fa-li"><i
                                                                        class="fas fa-coins text-warning"></i></span>{{ $data->price }}
                                                        </li>
                                                        <li><span class="fa-li"><i
                                                                        class="fas fa-map-marked-alt text-warning"></i></span>{{ $data->districts }}
                                                            ,{{ $data->amphures }}, {{ $data->provinces }}</li>
                                                        <li><span class="fa-li"><i
                                                                        class="far fa-calendar-alt text-warning"></i></span>{{ $data->period }}
                                                        </li>
                                                        <li><span class="fa-li"><i
                                                                        class="fas fa-stopwatch text-warning"></i></span>{{ $data->startdate }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    {{--<countdown name="{{$data->username }}" project_id="{{ $data->id }}" date="2019-04-04 23:06:00"></countdown>--}}
                                                    <countdown name="{{$data->username }}" project_id="{{ $data->id }}"
                                                               date="{{ $data->date_end }} {{ $data->time_end }}"></countdown>
                                                </div>
                                                <div class="col-lg-4 text-right">
                                                    <span class="text-secondary">
                                                        <i class="fas fa-comment-dollar"></i> <span>{{ $data->sum }}</span>
                                                        <i class='fas fa-eye'></i> <span>{{ $data->view }}</span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="container-fluid py-5 text-center middle">
                        <div class="row">
                            <div class="pagination">
                                {!! $projectAuction->links()!!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    {{-- end #ประมูลโครงการ --}}

    @if (!Auth::guest())
        @if ($profile->type_user_id != null)
            {{-- type_user_id : เฉพาะ ผู้ว่าจ้าง  --}}
            {{-- begin # สร้างประมูลโครงการ --}}
            <div id="projectauction-section4" class="bg-orange">
                <div class="container py-5">
                    <h1 class="text-center mb-3">สร้างโครงการ</h1>
                    <div class="row">
                        <div class="col-sm-12 py-2">
                            <div class="bg-white p-2">
                                <div class="media">
                                    <img src="{{ asset('images/profile/'.$profile->image_profile) }}"
                                         class="img-fluid mr-3" alt="Responsive image"
                                         style="width:50px;height:50px;object-fit:cover">
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-0">Username : {{ Auth::user()->name }}</h5>
                                        ผู้ว่าจ้าง : {{ $profile->firstname }} {{ $profile->lastname }}
                                    </div>
                                </div>
                                <hr>
                                {!! Form::open(['url' => 'projectauction' , 'files'=>true , 'data-parsley-required' => 'true' , 'enctype' => 'multipart/form-data' ]) !!}
                                <input type="hidden" id="profile_id" name="profile_id" value="{{ $profile->id }}">
                                <div class="form-group">
                                    <label for="inputEmail4">ชื่องาน</label>
                                    <input type="text" class="form-control" id="inputEmail4"
                                           placeholder="กรุณากรอกชื่องาน" name="project_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword4">งานประเภท</label>
                                    {!!  Form::select('type_project_id', $typeProjectAuctions, null, ['id' => 'type_project_id','class' => 'form-control' , 'placeholder' => 'กรุณาเลือก','onchange'=>'typeProjectAuctions(this.value);' ,'required' ]) !!}
                                </div>

                                <div id="air" class="typeScope">
                                    <div class="form-group">
                                        <label for="inputAddress">ขอบเขตงาน</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                   name="work[]" value="1">
                                            <label class="form-check-label" for="inlineCheckbox1">VRV/VRF system</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                                   name="work[]" value="2">
                                            <label class="form-check-label" for="inlineCheckbox2">Sprit type
                                                system</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox3"
                                                   name="work[]" value="3">
                                            <label class="form-check-label" for="inlineCheckbox3">Ventilation
                                                system</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox4"
                                                   name="work[]" value="4">
                                            <label class="form-check-label" for="inlineCheckbox3">Chiller system</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress">ขอบเขตงานย่อย</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                   name="subject_work1" value="1">
                                            <label class="form-check-label" for="inlineCheckbox1">Install
                                                machine</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                                   name="subject_work2" value="2">
                                            <label class="form-check-label" for="inlineCheckbox2">Piping</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox3"
                                                   name="subject_work3" value="3">
                                            <label class="form-check-label" for="inlineCheckbox3">Control</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox4"
                                                   name="subject_work4" value="4">
                                            <label class="form-check-label" for="inlineCheckbox3">Main</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox5"
                                                   name="subject_work5" value="5">
                                            <label class="form-check-label" for="inlineCheckbox3">Duct piping</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="plumbing" class="typeScope">
                                     @if(count($master_work_piumbling) > 0)
                                        <label for="inputAddress">ขอบเขตงาน</label><br>
                                        <div class="form-group">
                                            @foreach($master_work_piumbling as $value)
                                               <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                       name="work[]" value="{{ $value->id }}">
                                                <label class="form-check-label" for="inlineCheckbox1">{{ $value->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    <label for="inputAddress">ขอบเขตงานย่อย</label><br>
                                    <div class="form-row">
                                        @foreach($master_sub_piumbling as $value)
                                        <div class="form-group col-md-4">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox"  name="subject_work[]"
                                                       id="inlineCheckbox2" value="{{ $value->id }}">
                                                <label class="form-check-label" for="inlineCheckbox2">{{ $value->name }}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div id="electricity" class="typeScope">
                                     @if(count($master_work_electrical) > 0)
                                    <label for="inputAddress">ขอบเขตงาน</label><br>
                                    <div class="form-group">
                                        @foreach($master_work_electrical as $value)
                                           <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                   name="work[]" value="{{ $value->id }}">
                                            <label class="form-check-label" for="inlineCheckbox1">{{ $value->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                     @endif
                                    <label for="inputAddress">ขอบเขตงานย่อย</label><br>
                                    <div class="form-row">
                                        @foreach($master_sub_electrical as $value)
                                            <div class="form-group col-md-4">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox"  name="subject_work[]"
                                                           id="inlineCheckbox2" value="{{ $value->id }}">
                                                    <label class="form-check-label" for="inlineCheckbox2">{{ $value->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div id="fire" class="typeScope">
                                    @if(count($master_work_fire) > 0)
                                        <label for="inputAddress">ขอบเขตงาน</label><br>
                                        <div class="form-group">
                                            @foreach($master_work_fire as $value)
                                               <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                       name="work[]" value="{{ $value->id }}">
                                                <label class="form-check-label" for="inlineCheckbox1">{{ $value->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    <label for="inputAddress">ขอบเขตงานย่อย</label><br>
                                    <div class="form-row">
                                        @foreach($master_sub_fire as $value)
                                            <div class="form-group col-md-4">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox"  name="subject_work[]"
                                                           id="inlineCheckbox2" value="{{ $value->id }}">
                                                    <label class="form-check-label" for="inlineCheckbox2">{{ $value->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputCity">วันและเวลาปิดประมูล</label>
                                        <input type="date" class="form-control" id="date_end" name="date_end" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputState">&nbsp;</label>
                                        <input type="time" class="form-control" id="time_end" name="time_end" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputState">งบประมาณ</label>
                                    {!!  Form::select('price_ranges_id', $price_ranges, null, ['id' => 'price_ranges_id','class' => 'form-control' , 'placeholder' => 'กรุณาเลือก' ,'required' ]) !!}
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputCity">สถานที่ปฏิบัติงาน จังหวัด</label>
                                        {!!  Form::select('provinces', $provinces, null, ['id' => 'provinces_id','class' => 'form-control' , 'placeholder' => '-กรุณาเลือกจังหวัด-' ,'onchange'=>'changeAddress(this.value,"amphures")' ,'required']) !!}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputCity">สถานที่ปฏิบัติงาน เขต/อำเภอ</label>
                                        <select class="form-control" id="amphures"
                                                onchange="changeAddress(this.value,'districts')"
                                                name="amphures" required>
                                            <option value="">-กรุณาเลือก เขต/อำเภอ-</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputCity">สถานที่ปฏิบัติงาน ตำบล</label>
                                        <select class="form-control" id="districts" name="districts" required>
                                            <option value="">-กรุณาเลือกตำบล-</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputState">วันที่เริ่มงาน</label>
                                        <input type="date" class="form-control" id="startdate" name="startdate"
                                               onchange="dateDiff()" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputState">วันที่สิ้นสุด</label>
                                        <input type="date" class="form-control" id="enddate" name="enddate"
                                               onchange="dateDiff()" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputZip">ระยะเวลาปฏิบัติงาน</label>
                                        <input type="text" class="form-control" id="period" name="period" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress2">รายละเอียดงานเพิ่มเติม</label>
                                    <textarea class="form-control" id="details" name="details" rows="4"
                                              required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail4">ภาพประกอบ</label>
                                    {!!  Form::file('gallery[]',['class' => 'form-control' ,  'multiple' => 'multiple' ,'required']) !!}
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="i_accept" id="i_accept">
                                        <label class="form-check-label" for="exampleCheck1">ยอมรับ
                                            <a class="text-primary pointer" data-toggle="modal"
                                               data-target="#exampleModal">
                                                เงื่อนไข</a> การสร้างโครงการ
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <hr>
                                    <button type="submit" name="btn_send" id="btn_send"
                                            class="btn btn-success btn-lg mb-2" disabled="disabled">ยืนยันสร้างโครงการ
                                    </button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal ข้อตกลงและเงื่อนไข-->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
            </div>
            {{-- end # สร้างประมูลโครงการ --}}
        @endif
    @endif
    {{--<div id="showRemain"></div>--}}

    {{--<script src="/js/app.js" charset="utf-8"></script>--}}
    <script src="{{ asset('js/app.js') }}" ></script>

@endsection
@section('script')
    <style>
        .typeScope {
            display:none;
        }
    </style>
    <script type="text/javascript">
        function countDown() {
            var timeA = new Date(); // วันเวลาปัจจุบัน
            var timeB = new Date("April 3,2019 14:41:00"); // วันเวลาสิ้นสุด รูปแบบ เดือน/วัน/ปี ชั่วโมง:นาที:วินาที
            //  var timeB = new Date(2012,1,24,0,0,1,0);
            // วันเวลาสิ้นสุด รูปแบบ ปี,เดือน;วันที่,ชั่วโมง,นาที,วินาที,,มิลลิวินาที    เลขสองหลักไม่ต้องมี 0 นำหน้า
            // เดือนต้องลบด้วย 1 เดือนมกราคมคือเลข 0
            var timeDifference = timeB.getTime() - timeA.getTime();
            if (timeDifference >= 0) {
                timeDifference = timeDifference / 1000;
                timeDifference = Math.floor(timeDifference);
                var wan = Math.floor(timeDifference / 86400);
                var l_wan = timeDifference % 86400;
                var hour = Math.floor(l_wan / 3600);
                var l_hour = l_wan % 3600;
                var minute = Math.floor(l_hour / 60);
                var second = l_hour % 60;
                var showPart = document.getElementById('showRemain');
                showPart.innerHTML = "เหลือเวลา " + wan + " วัน " + hour + " ชั่วโมง "
                    + minute + " นาที " + second + " วินาที";
                if (wan == 0 && hour == 0 && minute == 0 && second == 0) {
                    clearInterval(iCountDown); // ยกเลิกการนับถอยหลังเมื่อครบ
                    // เพิ่มฟังก์ชันอื่นๆ ตามต้องการ
                    alert("ปิดประมูล")
                }
            }
        }

        // การเรียกใช้
        var iCountDown = setInterval("countDown()", 1000);
    </script>
    <script src="{{ asset('assets/plugins/parsley/dist/parsley.js') }}"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        // CKEDITOR.replace('details');
        $(function () {
            $(":checkbox[name=i_accept]").on("click", function () {
                var i_check = $(this).prop("checked");
                // console.log(i_check);
                if (i_check == true) {
                    $("button[name=btn_send]").attr("disabled", false);
                } else {
                    $("button[name=btn_send]").attr("disabled", true);
                }
            });
        });

        function typeProjectAuctions(id) {
            $('.typeScope').hide();
            if (id == 1) {
                $('#air').show();
            } else if (id == 2){
                $('#plumbing').show();
            }else if (id == 3){
                $('#electricity').show();
            }else if (id == 4){
                $('#fire').show();
            }
        }

        function changeAddress(id_address, type_address) {
            $.ajax({
                url: '{{ url("/api/address") }}',
                type: "GET",
                data: {id: id_address, type: type_address},
                success: function (data) {
                    $('#' + type_address + '').html(data);
                }
            });
        }

        function dateDiff() {
            var startdate = document.getElementById('startdate').value;
            var enddate = document.getElementById('enddate').value;
            // console.log(startdate)
            // console.log(enddate)

            if (startdate != null && enddate != null) {
                var first_date = Date.parse(startdate);
                var last_date = Date.parse(enddate);
                var diff_date = first_date - last_date;
                var num_years = diff_date / 31536000000;
                var num_months = (diff_date % 31536000000) / 2628000000;
                var num_days = ((diff_date % 31536000000) % 2628000000) / 86400000;

                var result = "";

                result += (" " + Math.floor(num_years) + " ปี\n");
                result += (" " + Math.floor(num_months) + " ดือน\n");
                result += (" " + Math.floor(num_days) + " วัน");
                // alert(result);
                // console.log(result);
            }

        }
    </script>
    @if(session()->has('status'))
        <script>
            Swal({
                type: 'success',
                title: "<?php echo session()->get('status'); ?>",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @if(session()->has('alert'))
        <script>
            Swal({
                type: 'error',
                title: "<?php echo session()->get('alert'); ?>",
                text: "เติมเงินเข้าสู่ระบบ หรือ กรุณาติดต่อเจ้าหน้า",
                showConfirmButton: false,
                timer: 3500
            })
        </script>
    @endif
@endsection
