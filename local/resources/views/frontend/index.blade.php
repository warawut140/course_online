@extends('layouts.navber')
@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick-theme.css') }}"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<style>
    .slick-slide img {
    display: block;
    height: 350px;
    object-fit: cover;
}
</style>
@endsection
@section('content')
    <a data-fancybox data-src="#hidden-content-b" href="javascript:" class="btnpopup"></a>
    <div style="display: none;max-width:100%" id="hidden-content-b">
        <h1 class="mb-3 text-center">แนะนำ<span class="text-orange">ผึ้งงาน</span></h1>
        <div class="row text-center">
            <div class="col-xl-6 col-md-6">
                <a href="{{ url('projectauction') }}">
                    <div class="card mb-3 card-popup1">
                        <div class="card-body">
                            <img src="{{ asset('image/index-auction.png') }}" class="mw-100 mb-3">
                            <h4 class="text-orange">ประมูลงานระบบ</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-6 col-md-6">
                <a href="{{ url('work') }}">
                    <div class="card  mb-3 card-popup2">
                        <div class="card-body">
                            <img src="{{ asset('image/index-findjob.png') }}" class="mw-100 mb-3">
                            <h4 class="text-orange">หางาน</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-6 col-md-6">
                <a href="{{ url('training') }}">
                    <div class="card  mb-3 card-popup3">
                        <div class="card-body">
                            <img src="{{ asset('image/index-knowledge.png') }}" class="mw-100 mb-3">
                            <h4 class="text-orange">อบรม หาความรู้</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-6 col-md-6">
                <a href="{{ url('erp-home') }}">
                    <div class="card  mb-3 card-popup4">
                        <div class="card-body">
                            <img src="{{ asset('image/index-knowledge.png') }}" class="mw-100 mb-3">
                            <h4 class="text-orange">ผู้ซื้อ</h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    @if($search == null)
        <?php
        // check cookie ครั้งแรกจะไม่มี ก็ให้แสดง
        if(!isset($_COOKIE["cookie1"])){ // เช็คว่ามีตัวแปรนี้อยู่ก่อนแล้วหรือไม่
            setcookie("cookie1", "ทดสอบ",time()+3600,"/");  // กำหนดตัวแปร
        }
        ?>
        <?php
        // เปิดมาครั้งแรกจะไม่มี  ก็เข้าไปทำงานในเงื่อนไข
        if(!isset($_COOKIE["cookie1"])){ // ทำงานแสดงครั้งแรก ?>
        <script>
            $('[data-src="hidden-content-b"]').fancybox({
                // toolbar : false
            });
            $( ".btnpopup" ).trigger( "click" );
        </script>
        <!--โค้ด javascript-->
        <?php } ?>
     @endif
    {{-- begin #banner--}}
    <div id="index-banner" class="bg-white">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @if($home_gellery != "")
                    <?php $active = 'active'; $class = 'class="active"'?>
                    @for($i = 0 ; $i < count($home_gellery);$i++)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}" {{ $class }}></li>
                    @endfor
                @endif
            </ol>
            <div class="carousel-inner">
                @if($home_gellery != "")
                    @foreach($home_gellery as $data)
                        <div class="carousel-item {{ $active }}">
                            <img src="{{ asset('images/banner/'.$data->filename) }}" class="d-block w-100" alt="...">
                        </div>
                        <?php $active = ''?>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    {{-- end #banner--}}

    {{-- begin #content 1--}}
    <div id="index-section1" class="bg-white">
        <div class="container text-center py-4">
            <h1 class="mb-3"><span class="text-orange">ผึ้งงาน</span> มีอะไร?</h1>
            <div class="row">
                <div class="col-sm my-2 col-3">
                    <a href="{{ url('projectauction') }}">
                        <img src="{{ asset('image/index-auction.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange">ประมูลงานระบบ</h4>
                </div>
                <div class="col-sm my-2 col-3">
                    <a href="{{ url('work') }}">
                        <img src="{{ asset('image/index-findjob.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange">หางาน</h4>
                </div>
                <div class="col-sm my-2 col-3">
                    <a href="{{ url('training') }}">
                        <img src="{{ asset('image/index-knowledge.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange">อบรม หาความรู้</h4>
                </div>
                <div class="col-sm my-2 col-3">
                    <a href="{{ url('#') }}">
                        <img src="{{ asset('image/index-knowledge.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange">ผู้ซื้อ</h4>
                </div>
            </div>
        </div>
    </div>
    {{-- end #content 1--}}

    {{-- begin #work 1--}}
    <div id="index-section2" class="bg-light">
        <div class="container py-4">
            <h1 class="text-center">ค้นหางาน, หาผู้รับจ้าง, หาผู้รับเหมา</h1>
            <form action="search" method="POST" role="search">
                {{ csrf_field() }}
                <div class="input-group mb-5">
                    <input type="text"
                           name="q"
                           class="form-control"
                           placeholder="ค้นหางาน, ค้นหาผู้รับจ้าง, ค้นหาผู้รับเหมา..."
                           aria-label="Recipient's username" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-form" type="button" id="button-addon2"><i class='fas fa-search text-orange'></i></button>
                    </div>
                </div>
            </form>

            @if(count($works1) > 0)
                <div class="title1">ประกาศจากผู้ว่าจ้างล่าสุด</div>
                <div class="responsive">
                   @foreach($works1 as $key => $value)
                    <div>
                        <a href="{{ url('work/'.$data->id) }}" class="box-link">
                            <div class="p-2">
                                <div class="slide-announcement1">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <span class="h4">{{ $value->title }}</span>
                                            <span class="float-right" id="text{{$key}}"></span>
                                            <script type="text/javascript">
                                                function getNumberOfDays(year, month) {
                                                    var isLeap = ((year % 4) == 0 && ((year % 100) != 0 || (year % 400) == 0));
                                                    return [31, (isLeap ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
                                                }
                                                var timeA = new Date(); // วันเวลาปัจจุบัน
                                                var timeB = new Date("{{ $value->created_at }}"); // วันเวลาสิ้นสุด รูปแบบ เดือน/วัน/ปี ชั่วโมง:นาที:วินาที
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
                                                    }else if(hour >= 0 && hour < 24){
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
                                                @foreach($value->tags as $tag)
                                                    <span class="badge badge-info font-weight-light">{{ $tag->name }}</span>
                                                @endforeach
                                                <span class="text-secondary"><i class="material-icons">&#xe417;</i> {{ $value->sum }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 py-1">
                                            <span class="p">
                                                @if(strlen($value->detail_data) > 205)
                                                    {!! iconv_substr((trim($value->detail_data)),0,205,"UTF-8").' >> อ่านต่อ' !!}
                                                @else
                                                    {!! $value->detail_data !!}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 text-right">
                                            <span class="text-secondary font-italic">ราคา {{ $value->price }} บาท</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                   @endforeach
                </div>
            @endif

            @if(count($works2) > 0)
                <div class="title3">ประกาศจากผู้รับเหมาล่าสุด</div>
                <div class="responsive">
                    @foreach($works2 as $key => $value)
                        <div>
                            <a href="{{ url('work/'.$data->id) }}" class="box-link">
                                <div class="p-2">
                                    <div class="slide-announcement3">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <span class="h4">{{ $value->title }}</span>
                                                <span class="float-right" id="text{{$key}}"></span>
                                                <script type="text/javascript">
                                                    function getNumberOfDays(year, month) {
                                                        var isLeap = ((year % 4) == 0 && ((year % 100) != 0 || (year % 400) == 0));
                                                        return [31, (isLeap ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
                                                    }
                                                    var timeA = new Date(); // วันเวลาปัจจุบัน
                                                    var timeB = new Date("{{ $value->created_at }}"); // วันเวลาสิ้นสุด รูปแบบ เดือน/วัน/ปี ชั่วโมง:นาที:วินาที
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
                                                        }else if(hour >= 0 && hour < 24){
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
                                                    @foreach($value->tags as $tag)
                                                        <span class="badge badge-info font-weight-light">{{ $tag->name }}</span>
                                                    @endforeach
                                                    <span class="text-secondary"><i class="material-icons">&#xe417;</i> {{ $value->sum }}</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 py-1">
                                            <span class="p">
                                                @if(strlen($value->detail_data) > 205)
                                                    {!! iconv_substr((trim($value->detail_data)),0,205,"UTF-8").' >> อ่านต่อ' !!}
                                                @else
                                                    {!! $value->detail_data !!}
                                                @endif
                                            </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 text-right">
                                                <span class="text-secondary font-italic">ราคา {{ $value->price }} บาท</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif

            @if(count($works3) > 0)
                <div class="title2">ประกาศจากผู้รับจ้างล่าสุด</div>
                <div class="responsive">
                    @foreach($works3 as $key => $value)
                        <div>
                            <a href="{{ url('work/'.$data->id) }}" class="box-link">
                                <div class="p-2">
                                    <div class="slide-announcement2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <span class="h4">{{ $value->title }}</span>
                                                <span class="float-right" id="text{{$key}}"></span>
                                                <script type="text/javascript">
                                                    function getNumberOfDays(year, month) {
                                                        var isLeap = ((year % 4) == 0 && ((year % 100) != 0 || (year % 400) == 0));
                                                        return [31, (isLeap ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
                                                    }
                                                    var timeA = new Date(); // วันเวลาปัจจุบัน
                                                    var timeB = new Date("{{ $value->created_at }}"); // วันเวลาสิ้นสุด รูปแบบ เดือน/วัน/ปี ชั่วโมง:นาที:วินาที
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
                                                        }else if(hour >= 0 && hour < 24){
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
                                                    @foreach($value->tags as $tag)
                                                        <span class="badge badge-info font-weight-light">{{ $tag->name }}</span>
                                                    @endforeach
                                                    <span class="text-secondary"><i class="material-icons">&#xe417;</i> {{ $value->sum }}</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 py-1">
                                            <span class="p">
                                                @if(strlen($value->detail_data) > 205)
                                                    {!! iconv_substr((trim($value->detail_data)),0,205,"UTF-8").' >> อ่านต่อ' !!}
                                                @else
                                                    {!! $value->detail_data !!}
                                                @endif
                                            </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 text-right">
                                                <span class="text-secondary font-italic">ราคา {{ $value->price }} บาท</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
    {{-- end #work 1--}}

    {{-- begin #recommend  ประมูลงานระบบ--}}
    <div id="index-section3" class="bg-consult">
        <div class="container py-5">
            <div class="center-parallax text-center">
                <img src="{{ asset('images/icon-index.png') }}" class="mw-100"><br>
                <a href="{{ url('projectauction') }}" class="btn-thick btn-lg btn-outline-white my-5">ประมูลงานระบบ</a>
            </div>
        </div>
    </div>
    {{-- end #recommend  ประมูลงานระบบ--}}

    {{-- begin # จำนวนผู้ใช้ระบบ ทั้งหมด--}}
    <div id="index-section4" class="bg-light">
        <div class="container py-5">
            <div class="row">
                <div class="col-sm">
                    <div class="media mb-3">
                        <img class="mr-3 mw-100" src="{{ asset('images/index-team.png') }}" alt="Generic placeholder image">
                        <div class="media-body">
                            <h1 class="mt-0">{{ $user_count_1->usertype1 }}</h1>
                            <h3 class="mt-0">ผู้ว่าจ้าง</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="media mb-3">
                        <img class="mr-3 mw-100" src="{{ asset('images/index-workers.png') }}" alt="Generic placeholder image">
                        <div class="media-body">
                            <h1 class="mt-0">{{ $user_count_2->usertype2 }}</h1>
                            <h3 class="mt-0">ผู้รับจ้าง</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="media mb-3">
                        <img class="mr-3 mw-100" src="{{ asset('images/index-worker.png') }}" alt="Generic placeholder image">
                        <div class="media-body">
                            <h1 class="mt-0">{{ $user_count_3->usertype3 }}</h1>
                            <h3 class="mt-0">ผู้รับเหมา</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end # จำนวนผู้ใช้ระบบ ทั้งหมด--}}

    {{-- begin #แนะนำ ผู้รับเหมา--}}
    @if($recoommend != null)
        <div id="index-section5" class="bg-brick">
            <div class="container py-5">
                <h1 class="text-white text-center mb-5">แนะนำ</h1>
                <div class="recommend-slide">
                    @foreach($recoommend as $value)
                        <div>
                            <a href="" class="box-link">
                                <div class="p-2">
                                    <div class="bg-white p-2">
                                        <div class="media">
                                            <img class="mr-3 rounded-circle display-rec" src="{{ asset('images/profile/'.$value->image_profile) }}"
                                                 alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-0 font-weight-normal">{{ $value->firstname }}</h6>
                                                <h6 class="mt-0 font-weight-normal">{{ $value->lastname }}</h6>
                                                <h6 class="mt-0">
                                                    @if($value->type_user_id_2 == 2)
                                                        <span class="badge badge-info font-weight-light">งานผู้รับจ้าง</span>
                                                    @endif
                                                    @if($value->type_user_id_3 == 3)
                                                        <span class="badge badge-info font-weight-light">งานผู้รับเหมา</span>
                                                    @endif
                                                    <i class='fas fa-check-circle text-success'></i>
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="text-des-rec">
                                            @if($value->details != null)
                                                {!! $value->details !!}
                                            @else

                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    {{-- end #แนะนำ ผู้รับเหมา--}}

    {{-- begin # บทความ--}}
    @if($training!=null || $course_list != null )
        <div id="index-section6" class="bg-light">
            <div class="container py-5">
                <h1 class="text-center text-center mb-5">อบรมและสาระ</h1>
                <div class="training-slide">
                    @foreach($training as $value)
                        <div>
                            <a href="{{ url('training/'.$value->id) }}" class="box-link">
                                <div class="p-2">
                                    <div class="box-train">
                                        <img src="{{ asset('/images/training/image/'.$value->image_training) }}" class="mw-100" style="margin: auto;">
                                        <h4>{{ $value->title }}</h4>
                                        <div class="text-justify text-des-article">
                                            {!! $value->details !!}
                                        </div>
                                        <div class="">
                                            <i class="material-icons">&#xe417;</i> {{ $value->total }}
                                            <i class="material-icons">&#xe0ca;</i> {{ $value->commentTotal }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    @foreach($course_list as $value)
                        <div>
                            <a href="{{ url('course/'.$value->id) }}" class="box-link">
                                <div class="p-2">
                                    <div class="box-train">
                                        <img src="{{ asset('/images/course/image/'.$value->course_image) }}" class="mw-100" style="margin: auto;">
                                        <h4>{{ $value->course_name }}</h4>
                                        <div class="text-justify text-des-article">
                                            {!! $value->course_detail  !!}
                                        </div>
                                        <div class="">
                                            <i class="material-icons">&#xe417;</i> {{ $value->total }}
                                            <i class="material-icons">&#xe0ca;</i> {{ $value->commentTotal }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    {{-- end # บทความ--}}

    {{-- begin # รีวิวจากผู้ใช้งาน--}}
    @if($review != null)
        <div id="index-section7" class="bg-work">
            <div class="container py-5">
                <h1 class="text-white text-center mb-3">รีวิวจากผู้ใช้งาน</h1>
                <div class="card-deck py-5">
                    @foreach($review as $key => $item)
                        <div class="card">
                            <img class="card-img-top mx-auto rounded-circle img-profile" src="{{ asset('images/profile/'.$item->image_profile) }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $item->firstname }} {{ $item->lastname }}</h5>
                                <div class="mini-divider"></div>
                                <p class="card-text text-center">
                                    @if($item->details != null)
                                        {!! $item->details !!}
                                    @else

                                    @endif
                                </p>
                                <div class="text-center">
                                    <span class="fa fa-star @if($item->review_profile >= 1) checked @endif"></span>
                                    <span class="fa fa-star @if($item->review_profile >= 2) checked @endif"></span>
                                    <span class="fa fa-star @if($item->review_profile >= 3) checked @endif"></span>
                                    <span class="fa fa-star @if($item->review_profile >= 4) checked @endif"></span>
                                    <span class="fa fa-star @if($item->review_profile >= 5) checked @endif"></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- end # รีวิวจากผู้ใช้งาน--}}

    {{--<script src="/js/app.js" charset="utf-8"></script>--}}
    <script src="{{ asset('js/app.js') }}" ></script>


@endsection
@section('script')
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('slick/slick.min.js') }}"></script>
    <script>
        $('.responsive').slick({
            dots: false,
            arrows: true,
            infinite: false,
            speed: 300,
            slidesToShow: 2,
            slidesToScroll: 2,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
        $('.recommend-slide').slick({
            dots: false,
            arrows: true,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
        $('.training-slide').slick({
            dots: false,
            arrows: true,
            infinite: false,
            speed: 300,
            slidesToShow: 2,
            slidesToScroll: 2,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    </script>
    <script>
        FontAwesomeConfig = { searchPseudoElements: true };
    </script>
    <script>
        // $('.nav-item').eq(2).find('a').addClass('active');
    </script>
    <style>
        .card-popup1:hover, .card-popup2:hover, .card-popup3:hover, .card-popup4:hover {
            background-color: #f2a32f;
            color:#fff;
        }
        .card-popup1:hover h4, .card-popup2:hover h4, .card-popup3:hover h4, .card-popup4:hover h4 {
            color:#fff;
        }
        .card-popup1:hover img{
            content: url({{ asset('image/index-auction - Copy.png') }});
        }
        .card-popup2:hover img{
            content: url({{ asset('image/index-findjob - Copy.png')}});
        }
        .card-popup3:hover img{
            content: url({{ asset('image/index-knowledge - Copy.png')}});
        }
        .card-popup4:hover img{
            content: url({{ asset('image/index-store - Copy.png')}});
        }
    </style>
@endsection
