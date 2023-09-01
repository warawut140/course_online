@extends('layouts.navber')
@section('head')
    @include('sweetalert::alert')
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/2.1.99/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.0/css/swiper.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.0/js/swiper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
@endsection
@section('content')
    {{-- begin #รายละเอียด ประกาศหางาน --}}
    <div id="article-section1" class="bg-light">
        <div class="container py-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body p-2 text-center">
                                    <img class="card-img-top rounded-circle"
                                         src="{{ asset('images/profile/'.$works->image_profile) }}"
                                         alt="Card image cap" style="width:100px;height:100px;object-fit:cover;">
                                    <h6 class="card-title">{{ $works->firstname }} {{ $works->lastname }} <i class='fas fa-check-circle text-success'></i></h6>
                                    <div class="row">
                                        <div class="col-sm-4 text-center">
                                            <img src="{{ asset('images/icon-eye.png') }}">
                                            <p class="mb-1">เข้าชม</p>
                                            <h5>{{ $view }}</h5>
                                        </div>
                                        <div class="col-sm-4 text-center border-left border-right">
                                            <img src="{{ asset('images/icon-boxindex.png') }}">
                                            <p class="mb-1">งานที่ได้</p>
                                            <h5>{{ $portfolio_all }}</h5>
                                        </div>
                                        <div class="col-sm-4 text-center">
                                            <img src="{{ asset('images/icon-like.png') }}">
                                            <p class="mb-1">สำเร็จ</p>
                                            <h5>{{ round($percent) }}%</h5>
                                        </div>
                                    </div>
                                    @if($edit == "edit")
                                        <a class="btn btn-warning w-100 mt-2" href="{{ url('chat') }}"><i class='far fa-comment-dots'></i> ดูข้อความ</a>
                                    @else
                                        <a class="btn btn-warning w-100 mt-2" href="{{ url('chat/'.$works->user_id) }}"><i class='far fa-comment-dots'></i> ส่งข้อความ</a>
                                    @endif

                                    @if($edit == "edit")
                                        <a class="btn btn-dark w-100 mt-2" href="{{ url('mgmt-work/'.$id) }}"><span class="fa fa-briefcase"></span> การจัดการงาน</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <h3>{!! $works->title !!}
                               @if($edit == "edit")
                                    <a href="{{ url('work/'.$id.'/edit') }}"><i class='fas fa-edit'></i></a>
                               @endif
                            </h3>
                            <hr>
                            <h6>หมวดหมู่:
                                @foreach($works->tags as $keyB => $dataB)
                                    <span class="badge badge-primary">{{ $dataB->name }}</span>
                                @endforeach
                            </h6>

                            <p class="text-justify">.
                                {!! $works->detail_data !!}
                            </p>

                            <!--Carousel Gallery-->
                            @if($work_gallery != null)
                            <div class="carousel-gallery">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        @foreach($work_gallery as $data)
                                            <div class="swiper-slide">
                                                <a href="{{ asset('images/gallery-work/'.$data->filename) }}" data-fancybox="gallery">
                                                    <div class="image" style="background-image: url({{ asset('images/gallery-work/'.$data->filename) }})">
                                                        <div class="overlay">
                                                            <em class="mdi mdi-magnify-plus"></em>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                            @endif
                            <h4>รายละเอียดการให้บริการ</h4>
                            <div class="card mb-3">
                                <div class="card-body">
                                    @if($services != null)
                                        <ul>
                                            @foreach($services as $data)
                                                <li>{{ $data->detail }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6">
                                        <span class="fa-stack fa-2x">
                                          <i class="far fa-circle fa-stack-2x text-warning"></i>
                                          <i class="fas fa-calendar-alt fa-stack-1x text-warning"></i>
                                        </span>
                                            ระยะเวลาในการทำงาน {{ $works->time_work }} วัน
                                        </div>
                                        <div class="col-sm-6">
                                        <span class="fa-stack fa-2x">
                                          <i class="far fa-circle fa-stack-2x text-warning"></i>
                                          <i class="fas fa-dollar-sign fa-stack-1x text-warning"></i>
                                        </span>
                                            ราคา THB {{ $works->price }}
                                        </div>
                                    </div>
                                    <hr>
                                    <h4>รายละเอียดราคาเพิ่มเติม</h4>
                                    <p><b>เพิ่มเติม : </b> {{ $works->detail_price }}</p>
                                </div>
                            </div>

                            @if($procedures != null)
                                <div class="mb-5">
                                    <h4>ขั้นตอนการทำงาน</h4>
                                    @foreach($procedures as $key => $value)
                                        <h6 class="text-oranger">ขั้นตอนที่ {{ $key+1 }}</h6>
                                        <p>{!! $value->detail !!}</p>
                                    @endforeach
                                </div>
                            @endif

                            @if(count($comments) > 0)
                                <div class="">
                                    <h4>ความคิดเห็น <span class="text-muted h6">
                                         @if($wp_comment != null)
                                                ({{ $wp_comment }})
                                            @else
                                               (0)
                                            @endif
                                    </span></h4>
                                    <h6 class="text-orange"><span class="fa fa-star"></span>
                                        @if($review_comment != null)
                                            ({{ $review_comment }})
                                        @else
                                           (0)
                                        @endif
                                    </h6>
                                    <div class="card">
                                        <ul class="list-group list-group-flush">
                                            @foreach($comments_limit as $key => $item)
                                                <li class="list-group-item">
                                                    <div class="media mb-2">
                                                        <img src="{{ asset('images/profile/'.$item->image_profile) }}"  style="width: 50px;height: 50px"  class="img-fluid rounded-circle mr-2" alt="Responsive image">
                                                        <div class="media-body">
                                                            <h6 class="mt-0 mb-0 font-weight-light"><b>{{ $item->username }}</b>
                                                                <span class="text-muted small" id="text{{$key}}">
                                                            <script type="text/javascript">
                                                                function getNumberOfDays(year, month) {
                                                                    var isLeap = ((year % 4) == 0 && ((year % 100) != 0 || (year % 400) == 0));
                                                                    return [31, (isLeap ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
                                                                }
                                                                var timeA = new Date(); // วันเวลาปัจจุบัน
                                                                var timeB = new Date("{{ $item->created_at }}"); // วันเวลาสิ้นสุด รูปแบบ เดือน/วัน/ปี ชั่วโมง:นาที:วินาที
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
                                                                    // console.log("wan "+wan+" hour "+hour+" minute "+minute+" second "+second);
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
                                                        </span>
                                                            </h6>
                                                            <span class="fa fa-star @if($item->rate >= 1) checked @endif"></span>
                                                            <span class="fa fa-star @if($item->rate >= 2) checked @endif"></span>
                                                            <span class="fa fa-star @if($item->rate >= 3) checked @endif"></span>
                                                            <span class="fa fa-star @if($item->rate >= 4) checked @endif"></span>
                                                            <span class="fa fa-star @if($item->rate >= 5) checked @endif"></span>
                                                        </div>
                                                    </div>
                                                    {{ $item->details }}
                                                </li>
                                            @endforeach
                                            @if(count($comments_skip) > 0)
                                                <li class="list-group-item text-center" id="btnComment">
                                                    <a   class="text-oranger h5" onClick="showHideDiv()">อ่านความคิดเห็นเพิ่มเติม</a>
                                                </li>
                                             @endif
                                        </ul>
                                        <ul id="divBoxComment" style="display:none;" class="list-group list-group-flush">
                                            @foreach($comments_skip as $key => $item)
                                                <li class="list-group-item">
                                                    <div class="media mb-2">
                                                        <img src="{{ asset('images/profile/'.$item->image_profile) }}" style="width: 50px;height: 50px" class="img-fluid rounded-circle mr-2" alt="Responsive image">
                                                        <div class="media-body">
                                                            <h6 class="mt-0 mb-0 font-weight-light"><b>{{ $item->username }}</b>
                                                                <span class="text-muted small" id="skip{{$key}}"> {{ $item->created_at }}
                                                                    <script type="text/javascript">
                                                                var timeA = new Date(); // วันเวลาปัจจุบัน
                                                                var timeB = new Date("{{ $item->created_at }}"); // วันเวลาสิ้นสุด รูปแบบ เดือน/วัน/ปี ชั่วโมง:นาที:วินาที
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
                                                                    var showDate = document.getElementById('skip{{$key}}');
                                                                    // console.log("wan "+wan+" hour "+hour+" minute "+minute+" second "+second);
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
                                                        </span></h6>
                                                            <span class="fa fa-star @if($item->rate >= 1) checked @endif"></span>
                                                            <span class="fa fa-star @if($item->rate >= 2) checked @endif"></span>
                                                            <span class="fa fa-star @if($item->rate >= 3) checked @endif"></span>
                                                            <span class="fa fa-star @if($item->rate >= 4) checked @endif"></span>
                                                            <span class="fa fa-star @if($item->rate >= 5) checked @endif"></span>
                                                        </div>
                                                    </div>
                                                    {{ $item->details }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- end #รายละเอียด ประกาศหางาน --}}
@endsection
@section('script')
    <script type="text/javascript">
        function showHideDiv() {
            var srcElement = document.getElementById('divBoxComment');
            if (srcElement != null) {
                if (srcElement.style.display == "block") {
                    // console.log(1);
                    document.getElementById('divBoxComment').style.display = 'none';
                } else {
                    // console.log(2);
                    document.getElementById('btnComment').style.display = 'none';
                    document.getElementById('divBoxComment').style.display = 'block';
                }
                return false;
            }
        }
    </script>
    <script>
        $(function(){

            var swiper = new Swiper('.carousel-gallery .swiper-container', {
                effect: 'slide',
                speed: 900,
                slidesPerView: 3,
                spaceBetween: 20,
                simulateTouch: true,
                autoplay: {
                    delay: 5000,
                    stopOnLastSlide: false,
                    disableOnInteraction: false
                },
                pagination: {
                    el: '.carousel-gallery .swiper-pagination',
                    clickable: true
                },
                breakpoints: {
                    // when window width is <= 320px
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 5
                    },
                    // when window width is <= 480px
                    425: {
                        slidesPerView: 2,
                        spaceBetween: 10
                    },
                    // when window width is <= 640px
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    }
                }
            }); /*http://idangero.us/swiper/api/*/

        });
    </script>
    @if(session()->has('status'))
        <script>
            Swal({
                type: 'success',
                title: "<?php echo session()->get('status'); ?>",
                showConfirmButton: false,
                timer: 3000
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
@endsection