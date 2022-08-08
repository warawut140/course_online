@extends('layouts.navber')
@section('head')

@endsection
@section('content')
    {{-- begin # เลือก --}}
    <div id="work-section1" class="bg-orange">
        <div class="container py-5">
            <h4 class="text-white">เลือก</h4>
            <form action="#">
                <div class="form-row">
                    <div class="form-group col-md">
                        <label for="category" class="text-white">หน้าแสดงผล</label>
                        <select id="category" class="form-control">
                            <option selected>อบรม</option>
                            <option>คอร์สออนไลน์</option>
                        </select>
                    </div>
                    <div class="form-group col-md">
                        <label for="typework" class="text-white">ประเภทผู้ใช้</label>
                        <select id="typework" class="form-control">
                            <option selected>ทั้งหมด</option>
                            <option>ผู้ว่าจ้าง</option>
                            <option>ผู้รับจ้าง</option>
                            <option>ผู้รับเหมา</option>
                        </select>
                    </div>
                    <div class="form-group col-md">
                        <label for="price" class="text-white">หมวดหมู่</label>
                        {!!  Form::select('tags', $tags, null, ['id' => 'tags_id','class' => 'form-control' , 'placeholder' => 'ทั้งหมด' ]) !!}
                    </div>
                    <div class="form-group col-md">
                        <label for="inputPassword4">&nbsp;</label>
                        <a href="{{ url('training') }}" class="btn btn-dark w-100"><i
                                    class='fas fa-arrow-alt-circle-right'></i></a>
                        {{--<button class="btn btn-dark w-100" type="submit"><i class='fas fa-arrow-alt-circle-right'></i></button>--}}
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- end # เลือก --}}

    {{-- begin # คอร์สออนไลน์ --}}
    <div id="traning-section1" class="bg-light">
        <div class="container py-5 text-center">
            <h2>คอร์สออนไลน์</h2>
        </div>
    </div>
    <div id="traning-section2" class="bg-light">
        <div class="container-fluid">
            <div class="card-deck">
                @foreach($course as $value)
                    <div class="col-sm-3">
                        <div class="card border-warning rounded-0 test-articlebox" style="margin-bottom: 5px;">
                            <a href="{{ url('course2/'.$value->id) }}">
                                <div class="card-body">
                                    <div class=" img-cover-testarticle">
                                        <img src="{{ asset('images/course/banner/'.$value->image) }}" class="mw-100 img-article2">
                                        <div class="date-articletest">
                                            {{--เม.ย. 21, 2561--}}
                                            <?php
                                            list($year, $month, $day) = explode('-', date('Y-m-d', strtotime($value->created_at)));
                                            if ($day < 10) {
                                                $day = substr($day, 1, 1);
                                            }
                                            $thMonth = array("ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.",
                                                "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
                                            if ($month < 10) {
                                                $month = substr($month, 1, 1);
                                            }
                                            $year += 543;
                                            echo $thMonth[$month - 1]."&nbsp;".$day."&nbsp;".$year;
                                            ?>

                                        </div>
                                    </div>
                                    <h5 class="card-title">{{ $value->name }}</h5>
                                    {{--                                    <small><i class="fab fa-blogger"></i>--}}
                                    {{--                                        <span>--}}
                                    {{--                                       {{ $value->name }}--}}
                                    {{--                                    </span>--}}
                                    {{--                                    </small>--}}
                                    <p class="card-text text-des-test">
                                        {!! $value->detail  !!}
                                    </p>
                                    <div class="">
                                        <i class="fa fa-money"></i> {{ $value->price }} บาท
{{--                                        <i class="material-icons">&#xe0ca;</i> 0--}}
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach



            </div>
        </div>
    </div>

    <div id="traning-section3" class="bg-light">
        <div class="container-fluid py-5 text-center middle">
            <div class="row">

            </div>
        </div>
    </div>
    {{-- end # คอร์สออนไลน์ --}}

@endsection
@section('script')

@endsection
