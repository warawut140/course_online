@extends('layouts.navber')
@section('head')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <link href="{{ asset('assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet"/>
@endsection
@section('content')
    {{--<div id="app">--}}
    {{-- begin # ตัวกรองการค้นหา --}}
    <div id="work-section1" class="bg-orange">
        <div class="container py-5">
            <h4 class="text-white">ตัวกรองการค้นหา</h4>
            <form action="searchWork" method="POST" role="search">
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="form-group col-md">
                        <label for="tags" class="text-white">หมวดหมู่</label>
                        {!!  Form::select('tags', $tags, null, ['id' => 'tags_id','class' => 'form-control' , 'placeholder' => 'ทั้งหมด' ]) !!}
                    </div>
                    <div class="form-group col-md">
                        <label for="typework" class="text-white">ประเภทประกาศ</label>
                        {!!  Form::select('type_wp', $typeWP, null, ['id' => 'type_wp_id','class' => 'form-control' , 'placeholder' => 'ทั้งหมด' ]) !!}
                    </div>
                    <div class="form-group col-md">
                        <label for="price" class="text-white">ราคา</label>
                        {!!  Form::select('price_range', $priceRange, null, ['id' => 'price_range_id','class' => 'form-control' , 'placeholder' => 'ทั้งหมด' ]) !!}
                    </div>
                    <div class="form-group col-md">
                        <label for="place" class="text-white">สถานที่ปฏิบัติงาน</label>
                        {!!  Form::select('provinces', $provinces, null, ['id' => 'provinces_id','class' => 'form-control' , 'placeholder' => 'ทั้งหมด' ]) !!}
                    </div>
                    <div class="form-group col-md">
                        <label for="inputPassword4">&nbsp;</label>
                        <button class="btn btn-dark w-100">กรอง</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- end # ตัวกรองการค้นหา --}}

    {{-- begin # ประกาศหางาน --}}

    <div id="traning-section2" class="bg-light">
        <div class="container py-5">
            <h1 class="text-center">ประกาศหางาน</h1>
            @if (!Auth::guest())
                <div class="row">
                    <div class="col-sm-12 text-center pb-3">
                        <button class="btn btn-sm btn-dark" data-toggle="modal" data-target="#createArticleWork">
                            ตั้งกระทู้
                        </button>
                    </div>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <!-- Modal -->
            <div class="modal fade" id="createArticleWork" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ตั้งกระทู้</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                            </button>
                        </div>
                        <div id="app">
                            {!! Form::open(['url' => 'work' , 'files'=>true , 'data-parsley-required' => 'true' ]) !!}
                            {{csrf_field()}}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">ชื่อกระทู้</label>
                                    {!!  Form::text('title',null,['id' => 'title','class' => 'form-control' , 'data-parsley-required' => 'true']) !!}
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">ประเภทกระทู้</label>
                                    <div class="form-check form-check-inline">
                                        {{ Form::radio('type_wp_id', 1,false,['class' => 'form-check-input','id' => 'type_wp_id']) }}
                                        {{--<input class="form-check-input" type="radio" name="type_wp_id" id="type_wp_id" value="1">--}}
                                        <label class="form-check-label" for="inlineCheckbox1">หาผู้รับจ้าง</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        {{ Form::radio('type_wp_id', 2,false,['class' => 'form-check-input','id' => 'type_wp_id']) }}
                                        {{--<input class="form-check-input" type="radio" name="type_wp_id" id="type_wp_id" value="2">--}}
                                        <label class="form-check-label" for="inlineCheckbox2">หาผู้รับเหมา</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        {{ Form::radio('type_wp_id', 3 ,false,['class' => 'form-check-input','id' => 'type_wp_id']) }}
                                        {{--<input class="form-check-input" type="radio" name="type_wp_id" id="type_wp_id" value="3">--}}
                                        <label class="form-check-label" for="inlineCheckbox2">หางาน</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">หมวดหมู่</label>
                                    <br>
                                    <div v-for="(row , index) in rows" :row="row">
                                        {{--                                            {!!  Form::select('tags[]', $tags, null, ['id' => 'tags_id[]','class' => 'form-control' , 'placeholder' => 'ทั้งหมด' ]) !!}--}}
                                        <select name="tags[]" id="tags[]" class="form-control">
                                            <option selected disabled value="">กรุณาเลือก</option>
                                            @foreach($tags2 as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button v-on:click="addRow(1)" type="button" class="btn btn-outline-secondary"><i
                                                class='fas fa-plus'></i></button>
                                    <button v-on:click="removeRow(0)" type="button" class="btn btn-outline-secondary"><i
                                                class='fas fa-minus'></i></button>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">รายละเอียดข้อมูล</label>
                                    <textarea class="form-control" rows="3" name="detail_data"
                                              id="detail_data"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">ภาพผลงาน
                                        <small>หลายภาพ</small>
                                    </label>
                                    {!!  Form::file('work_gallery[]',['class' => 'form-control' ,  'multiple' => 'multiple']) !!}
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">รายละเอียดการให้บริการ</label>
                                    <div v-for="(row , index) in rows2" :row="row">
                                        <input type="text" class="form-control" name="work_procedures[]"
                                               id="work_procedures[]">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button v-on:click="addRow2(1)" type="button" class="btn btn-outline-secondary"><i
                                                class='fas fa-plus'></i></button>
                                    <button v-on:click="removeRow2(0)" type="button" class="btn btn-outline-secondary">
                                        <i class='fas fa-minus'></i></button>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">ระยะเวลาในการทำงาน</label>
                                        {!!  Form::text('time_work',null,['id' => 'time_work','class' => 'form-control' , 'data-parsley-required' => 'true']) !!}
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">ราคาเริ่มต้น</label>
                                        {!!  Form::select('price_range', $priceRange, null, ['id' => 'price_range_id','class' => 'form-control' , 'placeholder' => 'ทั้งหมด' ]) !!}
                                        {{--<input type="text" class="form-control" id="inputPassword4" >--}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">รายละเอียดราคาเพิ่มเติม</label>
                                    <textarea class="form-control" rows="4" name="detail_price"
                                              id="detail_price"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">ขั้นตอนการทำงาน</label>
                                    <div v-for="(row , index) in rows3" :row="row">
                                        <input type="text" class="form-control" name="listService[]" id="listService[]">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button v-on:click="addRow3(1)" type="button" class="btn btn-outline-secondary"><i
                                                class='fas fa-plus'></i></button>
                                    <button v-on:click="removeRow3(0)" type="button" class="btn btn-outline-secondary">
                                        <i class='fas fa-minus'></i></button>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">สถานที่ปฏิบัติงาน</label>
                                    {!!  Form::select('provinces_id', $provinces, null, ['id' => 'provinces_id','class' => 'form-control' , 'placeholder' => 'ทั้งหมด' ]) !!}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">ยืนยันสร้าง</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @if($works!=null)
                    @foreach($works as $key => $data)
                        @if($data->tpye_wp_id == 3)
                            <div class="col-sm-6">
                                <a href="{{ url('work/'.$data->id) }}" class="box-link">
                                    <div class="p-2">
                                        <div class="slide-announcement1">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <span class="h4">{{ $data->title }}</span>
                                                    <span class="float-right" id="text{{$key}}"></span>
                                                    <script type="text/javascript">
                                                        function getNumberOfDays(year, month) {
                                                            var isLeap = ((year % 4) == 0 && ((year % 100) != 0 || (year % 400) == 0));
                                                            return [31, (isLeap ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
                                                        }
                                                        var timeA = new Date(); // วันเวลาปัจจุบัน
                                                        var timeB = new Date("{{ $data->created_at }}"); // วันเวลาสิ้นสุด รูปแบบ เดือน/วัน/ปี ชั่วโมง:นาที:วินาที
                                                        // var day_count = getNumberOfDays(timeB.getFullYear() , timeB.getMonth());
                                                        // console.log(day_count);
                                                        var timeDifference = timeA.getTime() - timeB.getTime();
                                                        if (timeDifference >= 0) {
                                                            timeDifference = timeDifference / 1000;
                                                            timeDifference = Math.floor(timeDifference);
                                                            var wan = Math.floor(timeDifference / 86400);
                                                            var l_wan = timeDifference % 86400;
                                                            var hour = Math.floor(l_wan / 3600);
                                                            var l_hour = l_wan % 3600;
                                                            var minute = Math.floor(l_hour / 60);
                                                            var second = l_hour % 60;
                                                            var showDate = document.getElementById('text{{$key}}');
                                                            if(wan >= 365){
                                                                //Year
                                                                var show_year = wan / 365;
                                                                showDate.innerHTML = show_year.toFixed(0)+" ปีที่ผ่านมา";
                                                            }else if(wan >= 30 && wan < 365){
                                                                //month
                                                                var show_month = wan / 30;
                                                                showDate.innerHTML = show_month.toFixed(0)+" เดือนที่ผ่านมา";
                                                            }else if(wan >=  7 && wan < 30){
                                                                //week
                                                                var show_week = wan / 7;
                                                                showDate.innerHTML = show_week.toFixed(0)+" สัปดาห์ทีผ่านมา";
                                                            }else if(hour >= 24 && wan <  7){
                                                                //date
                                                                var show_day = (wan * 24)/24;
                                                                showDate.innerHTML = show_day.toFixed(0)+" วันทีผ่านมา";
                                                            }else if(hour > 0 && hour < 24){
                                                                //hour
                                                                showDate.innerHTML = hour+" ชั่วโมงผ่านมา";
                                                            }else if(minute > 0 && 0 <= hour){
                                                                //minute
                                                                showDate.innerHTML = minute+" นาทีผ่านมา";
                                                            }else if(second > 0 && 0 <= minute){
                                                                //second
                                                                showDate.innerHTML = second+" วินาทีผ่านมา";
                                                            }
                                                        }
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <p class="h6">
                                                        @foreach($data->tags as $tag)
                                                        <span class="badge badge-info font-weight-light">{{ $tag->name }}</span>
                                                        @endforeach
                                                        <span class="text-secondary">
                                                            <i class="material-icons">&#xe417;</i> {{ $data->sum }}
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 py-1">
                                                    <span class="p">
                                                        @if(strlen($data->detail_data) > 205)
                                                            {!! iconv_substr((trim($data->detail_data)),0,205,"UTF-8").' >> อ่านต่อ' !!}
                                                        @else
                                                            {!! $data->detail_data !!}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 text-right">
                                                    <span class="text-secondary font-italic">ราคา {{ $data->price }} บาท</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @else
                            <div class="col-sm-6">
                                <a href="{{ url('work/'.$data->id) }}" class="box-link">
                                    <div class="p-2">
                                        <div class="slide-announcement2">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <span class="h4">{{ $data->title }}</span>
                                                    <span class="float-right" id="text{{$key}}"></span>
                                                    <script type="text/javascript">
                                                        function getNumberOfDays(year, month) {
                                                            var isLeap = ((year % 4) == 0 && ((year % 100) != 0 || (year % 400) == 0));
                                                            return [31, (isLeap ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
                                                        }
                                                        var timeA = new Date(); // วันเวลาปัจจุบัน
                                                        var timeB = new Date("{{ $data->created_at }}"); // วันเวลาสิ้นสุด รูปแบบ เดือน/วัน/ปี ชั่วโมง:นาที:วินาที
                                                        // var day_count = getNumberOfDays(timeB.getFullYear() , timeB.getMonth());
                                                        // console.log(day_count);
                                                        var timeDifference = timeA.getTime() - timeB.getTime();
                                                        if (timeDifference >= 0) {
                                                            timeDifference = timeDifference / 1000;
                                                            timeDifference = Math.floor(timeDifference);
                                                            var wan = Math.floor(timeDifference / 86400);
                                                            var l_wan = timeDifference % 86400;
                                                            var hour = Math.floor(l_wan / 3600);
                                                            var l_hour = l_wan % 3600;
                                                            var minute = Math.floor(l_hour / 60);
                                                            var second = l_hour % 60;
                                                            var showDate = document.getElementById('text{{$key}}');
                                                            if(wan >= 365){
                                                                //Year
                                                                var show_year = wan / 365;
                                                                showDate.innerHTML = show_year.toFixed(0)+" ปีที่ผ่านมา";
                                                            }else if(wan >= 30 && wan < 365){
                                                                //month
                                                                var show_month = wan / 30;
                                                                showDate.innerHTML = show_month.toFixed(0)+" เดือนที่ผ่านมา";
                                                            }else if(wan >=  7 && wan < 30){
                                                                //week
                                                                var show_week = wan / 7;
                                                                showDate.innerHTML = show_week.toFixed(0)+" สัปดาห์ทีผ่านมา";
                                                            }else if(hour >= 24 && wan <  7){
                                                                //date
                                                                var show_day = (wan * 24)/24;
                                                                showDate.innerHTML = show_day.toFixed(0)+" วันทีผ่านมา";
                                                            }else if(hour > 0 && hour < 24){
                                                                //hour
                                                                showDate.innerHTML = hour+" ชั่วโมงผ่านมา";
                                                            }else if(minute > 0 && 0 <= hour){
                                                                //minute
                                                                showDate.innerHTML = minute+" นาทีผ่านมา";
                                                            }else if(second > 0 && 0 <= minute){
                                                                //second
                                                                showDate.innerHTML = second+" วินาทีผ่านมา";
                                                            }
                                                        }
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <p class="h6">
                                                        @foreach($data->tags as $tag)
                                                            <span class="badge badge-info font-weight-light">{{ $tag->name }}</span>
                                                        @endforeach
                                                        <span class="text-secondary">
                                                            <i class="material-icons">&#xe417;</i> {{ $data->sum }}
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 py-1">
                                                    <span class="p">
                                                        @if(strlen($data->detail_data) > 205)
                                                            {!! iconv_substr((trim($data->detail_data)),0,205,"UTF-8").' >> อ่านต่อ' !!}
                                                        @else
                                                            {!! $data->detail_data !!}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 text-right">
                                                    <span class="text-secondary font-italic">ราคา {{ $data->price }} บาท</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    {{-- end #  ประกาศหางาน --}}

    {{-- begin # pagination --}}
    @if($works!=null)
    <div id="traning-section3" class="bg-light">
        <div class="container-fluid py-5 text-center middle">
            <div class="row">
                <div>
                    {{--<ul>--}}
                        {!! $works->links()!!}
                    {{--</ul>--}}
                </div>
            </div>
        </div>
    </div>
    @endif
    {{-- end #  pagination--}}

    {{--</div>--}}

    {{--<script src="/js/app.js" charset="utf-8"></script>--}}
    <script src="{{ asset('js/app.js') }}" ></script>
@endsection
@section('script')
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
    @if(session()->has('warning'))
        <script>
            Swal({
                type: 'warning',
                title: "<?php echo session()->get('warning'); ?>",
                showConfirmButton: false,
                timer: 3000
            })
        </script>
    @endif
    <script src="{{ asset('assets/plugins/parsley/dist/parsley.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $("#addRow").click(function () {
                $("#myBox").append($("#firstBox").clone());
            });
            $("#removeRow").click(function () {
                if ($("#myBox tr").size() > 1) {
                    $("#myBox tr:last").remove();
                } else {
                    alert("ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ");
                }
            });
        });
        // $('.nav-item').eq(1).find('a').addClass('active');
    </script>
@endsection