@extends('layouts.navber')
@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick-theme.css') }}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

    <!--  video css start -->
    <link rel="stylesheet" type="text/css" href="assets/fontend/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="assets/fontend/css/layout.css?v=218&time=1660202862" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">




    <link rel="stylesheet" href="assets/fontend/css/jquery.fancybox.css" />




    <link rel="stylesheet" href="assets/fontend/css/aos.css">



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="assets/fontend/js/jquery.min.js"></script>

    <script src="assets/fontend/js/bootstrap.bundle.min.js"></script>

    <script src="assets/fontend/js/modernizr.js"></script>

    <script defer src="https://use.fontawesome.com/releases/v5.12.0/js/all.js"></script>



    <script src="assets/fontend/js/jquery.fancybox.min.js"></script>

    <script src="assets/fontend/js/aos.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/fontend/OwlCarousel/dist/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="assets/fontend/OwlCarousel/dist/assets/owl.carousel.min.css">

    <link rel="stylesheet" href="assets/fontend/OwlCarousel/dist/assets/owl.theme.default.min.css">
    <!--  video css end -->
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".loader-wrapper").fadeOut("slow");
        });
    </script>



    <style>
        .movie-carousel {
            padding: 30px 0px;
        }

        .myfanclass {
            display: none;
            background-color: transparent;
            cursor: unset;
            width: max-content;
            height: max-content;
            align-items: center;
            justify-content: center;
        }

        .video-js-dimensions {
            max-width: 100% !important;
            height: unset !important;
        }

        .myvideo_1-dimensions,
        .myvideo_2-dimensions,
        .myvideo_3-dimensions,
        .myvideo_4-dimensions,
        .myvideo_5-dimensions,
        .myvideo_6-dimensions,
        .myvideo_7-dimensions,
        .myvideo_8-dimensions {
            max-width: 100%;
        }

        @media (max-width: 480px) {

            .myvideo_1-dimensions,
            .myvideo_2-dimensions,
            .myvideo_3-dimensions,
            .myvideo_4-dimensions,
            .myvideo_5-dimensions,
            .myvideo_6-dimensions,
            .myvideo_7-dimensions,
            .myvideo_8-dimensions {
                height: 360px !important;
            }
        }

        #myVideotest1,
        #myVideotest2 {
            width: 100% !important;
            position: absolute;
        }

        .vjs-volume-unmute,
        .vjs-volume-unmute-overlay {
            display: none !important;
        }

        #mypromotevideo,
        #mypromotevideo2 {
            display: block !important;
        }

        .video-responsive {
            position: relative;
            width: 100%;
            overflow: hidden;
            padding-bottom: 44%;
        }

        .canvas,
        .video {
            height: auto;
            left: 0;
            position: absolute;
            bottom: 0;
            width: 100%;
            background: #FFF;
            z-index: 5;
        }

        .video-pc {
            position: absolute;
            height: auto;
            top: 0;
            left: -1px;
            bottom: 0;
            width: 102%;
            background: #FFF;
            z-index: 5;
        }

        @media (max-width: 1199px) {
            .video-responsive {
                position: relative;
                width: 100%;
                overflow: hidden;
                padding-bottom: 0;
            }

            .video-responsive,
            #mypromotevideo2 {
                position: relative;
                width: 100%;
                max-width: 100%;
                overflow: hidden;
                padding-bottom: 50%;
            }
        }

        #mypromotevideo_html5_api,
        #mypromotevideo2_html5_api {
            width: 100% !important;
        }
    </style>
    <style>
        .slick-slide img {
            display: block;
            width: 200;
            height: 100px;
            object-fit: cover;
        }

        /* Container holding the image and the text */
        .container {
            position: relative;
            text-align: center;
            color: white;
        }

        .buttonblack {
            background-color: while;
            border: 1px solid grey;
            font-size: 1.0em;
            padding: 8px 10px;

            border-radius: 50px;

        }

        /* Bottom left text */
        .bottom-left {
            position: absolute;
            bottom: 8px;
            left: 16px;
        }

        /* Top left text */
        .top-left {
            position: absolute;
            top: 8px;
            left: 16px;
        }

        /* Top right text */
        .top-right {
            position: absolute;
            top: 8px;
            right: 16px;
        }

        /* Bottom right text */
        .bottom-right {
            position: absolute;
            bottom: 8px;
            right: 16px;
        }

        /* Centered text */
        .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .horizontal-scroll-wrapper {
            width: 100px;
            height: 300px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .horizontal-scroll-wrapper>div {
            width: 100px;
            height: 100px;
        }

        .horizontal-scroll-wrapper {
            ... transform: rotate(-90deg);
            transform-origin: right top;
        }

        .horizontal-scroll-wrapper>div {
            ... transform: rotate(90deg);
            transform-origin: right top;
        }

        .row {
            --bs-gutter-x: 0rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(-1 * var(--bs-gutter-y));
            margin-right: calc(-.5 * var(--bs-gutter-x));
            margin-left: calc(-.5 * var(--bs-gutter-x));
        }

        <style>a:link {
            text-decoration: underline;
        }

        a:hover {
            text-decoration: none;
        }
        .containerbanner {
  position: relative;
  width: 100%;
}

/* Make the image responsive */
.containerbanner img {
  width: 100%;

}

/* Style the button and place it in the middle of the containerbanner/image */
.containerbanner .btn {
  position: absolute;
  top: 75%;
  left: 10%;
  transform: translate(-10%, -10%);
  -ms-transform: translate(-10%, -10%);
  background-color: white;
  color: black;
  font-size: 26px;
  padding: 12px 24px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
}
.containerbanner .buttontop {
  position: absolute;
  top: 10%;
  left: 10%;
  transform: translate(-10%, -10%);
  -ms-transform: translate(-10%, -10%);
  
  color: black;
  font-size: 24px;
  
}
.containerbanner .text0 {
  position: absolute;
  top: 33%;
  left: 10%;
  transform: translate(-10%, -10%);
  -ms-transform: translate(-10%, -10%);
  
  color: white;
  font-size: 36px;
  
}
.containerbanner .text1 {
  position: absolute;
  top: 40%;
  left: 10%;
  transform: translate(-10%, -10%);
  -ms-transform: translate(-10%, -10%);
  
  color: white;
  font-size: 26px;
  
}
.containerbanner .text2 {
  position: absolute;
  top: 65%;
  left: 10%;
  transform: translate(-10%, -10%);
  -ms-transform: translate(-10%, -10%);
  
  color: white;
  font-size: 26px;
  
}
.containerbanner .btnterm {
  position: absolute;
  top: 75%;
  left: 20%;
  transform: translate(-10%, -10%);
  -ms-transform: translate(-10%, -10%);
  background-color: grey;
  color: white;
  font-size: 26px;
  padding: 12px 24px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
}
.containerbanner .cer {
  position: absolute;
  top: 85%;
  left: 10%;
  transform: translate(-10%, -10%);
  -ms-transform: translate(-10%, -10%);

 
  font-size: 26px;
  padding: 12px 24px;

}


    </style>

    </style>
@endsection
@section('content')
    {{-- ป็อปอัพ --}}
    <a data-fancybox data-src="#hidden-content-b" href="javascript:" class="btnpopup"></a>
    <div style="display: none;max-width:100%" id="hidden-content-b">
        <h1 class="mb-3 text-center">แนะนำหลักสูตร</span></h1>
        <div class="row text-center">

            @foreach ($courses_recom as $c)
                <div class="col-xl-6 col-md-6">
                    <a href="{{ url('course_online_view/' . $c->id) }}">
                        <div class="card mb-3 card-popup1">
                            <div class="card-body">
                                <img src="{{ asset('images/profile/' . $c->image) }}" class="mw-100 mb-2">
                                <h4 class="text-orange"></h4>
                                {{-- <h6 class="text-orange text-left">{{ $c->name }}</h6> --}}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            {{-- <div class="col-xl-6 col-md-6">
                <a href="#">
                    <div class="card  mb-3 card-popup2">
                        <div class="card-body">
                            <img src="{{ asset('images/1c.png') }}" class="mw-100 mb-3">
                            <h4 class="text-orange"></h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-6 col-md-6">
                <a href="#">
                    <div class="card  mb-3 card-popup3">
                        <div class="card-body">
                            <img src="{{ asset('images/1c.png') }}" class="mw-100 mb-3">
                            <h4 class="text-orange"></h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-6 col-md-6">
                <a href="#">
                    <div class="card  mb-3 card-popup4">
                        <div class="card-body">
                            <img src="{{ asset('images/1c.png') }}" class="mw-100 mb-3">
                            <h4 class="text-orange"></h4>
                        </div>
                    </div>
                </a>
            </div> --}}

        </div>
    </div>

    @if ($search == null)
        <?php
        // check cookie ครั้งแรกจะไม่มี ก็ให้แสดง
        if (!isset($_COOKIE['cookie1'])) {
            // เช็คว่ามีตัวแปรนี้อยู่ก่อนแล้วหรือไม่
            setcookie('cookie1', 'ทดสอบ', time() + 3600, '/'); // กำหนดตัวแปร
        }
        ?>
        <?php
        // เปิดมาครั้งแรกจะไม่มี  ก็เข้าไปทำงานในเงื่อนไข
     if(!isset($_COOKIE["cookie1"])){ // ทำงานแสดงครั้งแรก ?>
        <script>
            $('[data-src="hidden-content-b"]').fancybox({
                // toolbar : false
            });
            $(".btnpopup").trigger("click");
        </script>
        <!--โค้ด javascript-->
        <?php } ?>
    @endif

    {{-- begin #banner --}}

    <div id="index-banner" class="bg-white bg-banner containerbanner">
      <img src="{{ asset('images/bannermockup.png') }}" class="d-block w-100">
       <div class="buttontop">
  <select style="background-color:whtie;
  color: black;
    border: none;
  cursor: pointer;
  border-radius: 30px;
  font-size: 26px;
  padding: 14px 35px;">
    <option value="0">Course / Program</option>
    <option value="1">Program1</option>
    <option value="2">Program2</option>
    <option value="3">Program3</option>
    <option value="4">Program4</option>
    
  </select> &nbsp;&nbsp;&nbsp;
  <select style="background-color:whtie;
  color: black;
    border: none;
  cursor: pointer;
  border-radius: 30px;
  font-size: 26px;
  padding: 14px 35px;">
    <option value="0">Level</option>
    <option value="1">Level1</option>
    <option value="2">Level2</option>
    <option value="3">Level3</option>
    <option value="4">Level4</option>
    
  </select> &nbsp;&nbsp;&nbsp;
  <select style="background-color:whtie;
  color: black;
    border: none;
  cursor: pointer;
  border-radius: 30px;
  font-size: 26px;
  padding: 14px 35px;">
    <option value="0">Type</option>
    <option value="1">Type1</option>
    <option value="2">Type2</option>
    <option value="3">Type3</option>
    <option value="4">Type4</option>
    
  </select>&nbsp;&nbsp;&nbsp;

  <input type="text" placeholder="Search transactions,invoices or help" style="background-color:whtie;
  color: black;
    border: none;
  cursor: pointer;
  border-radius: 30px;
  font-size: 26px;
  padding: 14px 35px;">
</div>

       <b class="text0">Leadership and Management</b>
        <div class="text1">Leadership is a skill for any role-not <br>a more successful leader, improve <br>manage conflict, and lead others through</div>
          <div class="text2"><i class="fa fa-play-circle "> </i>   วิดีโอ 30  &nbsp;&nbsp;&nbsp;<i class="fa fa-clock"> </i>  05:28 นาที  &nbsp;&nbsp;&nbsp;<i class="fa fa-calendar"> </i>  ระยะเวลาทั้งหมด 6 เดือน</div>
  <button class="btn"><i class="fa fa-play"> </i>   เริ่มเรียน</button>
 <button class="btnterm"><i class="fa fa-exclamation-circle"> </i>   รายละเอียดเพิ่มเติม</button>
<div class="cer"><img src="{{ asset('images/cer1.png') }}" style="width:10%;" > <button style="background-color: #FD6464;
  color: black;
    border: none;
  cursor: pointer;
  border-radius: 5px;
  font-size: 26px;
  padding: 5px 14px;">  ได้รับใบรับรอง Certificate</button>   </div>
    </div>
    
    {{-- end #banner --}}

    {{-- begin #content 1 --}}

    <div class="row">
        <div class="col-1">
        </div>
        <div class="col-8">
            <div class="container text-center py-4">
                <br> <br>

                <h1 class=" text-left">
                    <font style="color:black">หลักสูตรที่กำลังเป็นกระแส</font>
                </h1>
                <br> <br>
                <div class="col-10">
                    <div class="hotclass_slide owl-carousel owl-theme">
                        @foreach ($courses_trending as $c)
                            <div class="item">
                                <h6 class="text-orange text-left">{{ $c->name }}</h6>
                                <a href="{{ url('course_online_view/' . $c->id) }}">
                                    {{-- <img src="{{ asset('images/1c.png') }}"  width="220px" hight="210px" class="mw-100 mb-2"> --}}
                                    <img src="{{ asset('images/profile/' . $c->image) }}" class="mw-100 mb-2">
                                </a>

                            </div>
                        @endforeach
                        {{-- <div class="item">
                    <a href="{{ url('work') }}">
                        <img src="{{ asset('images/1c.png') }}"width="220px" hight="210px" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="item">
                    <a href="{{ url('training') }}">
                        <img src="{{ asset('images/1c.png') }}"width="220px" hight="210px" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="item">
                    <a href="{{ url('#') }}">
                        <img src="{{ asset('images/1c.png') }}"width="220px" hight="210px" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                  <div class="item">
                    <a href="{{ url('#') }}">
                        <img src="{{ asset('images/1c.png') }}"width="220px" hight="210px" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                  <div class="item">
                    <a href="{{ url('#') }}">
                        <img src="{{ asset('images/1c.png') }}" width="220px" hight="210px"class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div> --}}

                    </div>
                </div>
                <br> <br>

                <h1 class="mb-3 text-left">
                    <font style="color:black">คอร์สเรียนของคุณเรียนต่อเลย :-)</font>
                </h1>
                <br> <br>
                   <div class="col-10">

                <div class="hotclass_slide owl-carousel owl-theme">
                    <div class="item">
                        <a href="javascript:;">
                            <img src="{{ asset('images/2c.png') }}"  width="220px" hight="210px" class="mw-100 mb-3">
                        </a>
                        <h4 class="text-orange"></h4>
                    </div>

                    
                     <div class="item">
                        <a href="javascript:;">
                            <img src="{{ asset('images/2c.png') }}"  width="220px" hight="210px" class="mw-100 mb-3">
                        </a>
                        <h4 class="text-orange"></h4>
                    </div>


                     <div class="item">
                        <a href="javascript:;">
                            <img src="{{ asset('images/2c.png') }}"  width="220px" hight="210px" class="mw-100 mb-3">
                        </a>
                        <h4 class="text-orange"></h4>
                    </div>
                    
                </div>



                
                  </div>
            </div>
        </div>
        <div class="col-2">


            <div class="container text-center py-4">
                <br> <br> <br>

                <h5 class="mb-3 text-left">
                    <font style="color:grey">หัวข้อหลักสูตรน่าสนใจ</font>
                </h5>
                <br>

                <div class="row">

                    <a class="nav-link py-1 buttonblack " style="margin-right: 20px;margin-top: 20px;"
                        href="{{ url('register') }}">
                        <font style="color:grey">Business</font>
                    </a>
                    <a class="nav-link py-1 buttonblack" style="margin-right: 20px;margin-top: 20px;"
                        href="{{ url('register') }}">
                        <font style="color:grey">CRM Software</font>
                    </a
                    <a class="nav-link py-1 buttonblack"
                        style="margin-right: 20px;margin-top: 20px;"href="{{ url('register') }}">
                        <font style="color:grey">Customer Service</font>
                    </a>
                    <a class="nav-link py-1 buttonblack"
                        style="margin-right: 20px;margin-top: 20px;"href="{{ url('register') }}">
                        <font style="color:grey">Communication</font>
                    </a>
                    <a class="nav-link py-1 buttonblack"
                        style="margin-right: 20px;margin-top: 20px;"href="{{ url('register') }}">
                        <font style="color:grey">Marketing</font>
                    </a>
                    <a class="nav-link py-1 buttonblack"
                        style="margin-right: 20px;margin-top: 20px;"href="{{ url('register') }}">
                        <font style="color:grey">Customer Service</font>
                    </a>
                    <a class="nav-link py-1 buttonblack"
                        style="margin-right: 20px;margin-top: 20px;"href="{{ url('register') }}">
                        <font style="color:grey">Web Marketing Analytics</font>
                    </a>
                    <a class="nav-link py-1 buttonblack"
                        style="margin-right: 20px;margin-top: 20px;"href="{{ url('register') }}">
                        <font style="color:grey">Google Analytics</font>
                    </a>
                    <a class="nav-link py-1 buttonblack"
                        style="margin-right: 20px;margin-top: 20px;"href="{{ url('register') }}">
                        <font style="color:grey">Data Analysis</font>
                    </a>
                    <a class="nav-link py-1 buttonblack"
                        style="margin-right: 20px;margin-top: 20px;"href="{{ url('register') }}">
                        <font style="color:grey">Leadership and Management</font>
                    </a>
                    <a class="nav-link py-1 buttonblack"
                        style="margin-right: 20px;margin-top: 20px;"href="{{ url('register') }}">
                        <font style="color:grey">Leadership Skills</font>
                    </a>

                </div>
            </div>
        </div>

    </div>
    <div class="col-1">
    </div>
    </div>

    </div>
    {{-- end #content 1 --}}

    {{-- begin #work 1 --}}

    <div class="col-12">
        <div class="container text-center py-4">

            <br> <br>

            <h1 class="mb-3 text-left">
                <font style="color:black">10 หลักสูตรที่มีการซื้อสูงสุด</font>
            </h1>
            <br> <br>
            <div class="hotclass_slide owl-carousel owl-theme">

                @foreach ($courses_trending as $key => $c)
                    <div class="item">
                        <h6 class="text-orange text-left">{{ $c->name }}</h6>
                        <a href="{{ url('course_online_view/' . $c->id) }}">
                            <span class="numberHot"> <img
                                    data-src="assets/fontend/images/number_hot/number{{ $key + 1 }}.png"
                                    alt="" class="lazy"></span>
                            <img src="{{ asset('images/profile/' . $c->image) }}"  width="220px" hight="210px" class="mw-100 mb-2">
                        </a>
                        <span class="numberHot"></span>
                    </div>
                    
                @endforeach


                {{-- <div class="item">
                    <a href="{{ url('work') }}">
                        <span class="numberHot"> <img data-src="assets/fontend/images/number_hot/number2.png"
                                alt="" class="lazy"></span>
                        <img src="{{ asset('images/3c.png') }}"  width="220px" hight="210px"class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div> --}}
                {{-- <div class="item">
                    <a href="{{ url('training') }}">
                          <span class="numberHot">   <img data-src="assets/fontend/images/number_hot/number3.png" alt="" class="lazy"></span>
                        <img src="{{ asset('images/3c.png') }}" width="220px" hight="210px" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="item">
                    <a href="{{ url('#') }}">
                          <span class="numberHot">   <img data-src="assets/fontend/images/number_hot/number4.png" alt="" class="lazy"></span>
                        <img src="{{ asset('images/3c.png') }}"width="220px" hight="210px"  class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                      <div class="item" >

                    <a href="{{ url('projectauction') }}">
                     <span class="numberHot">   <img data-src="assets/fontend/images/number_hot/number5.png" alt="" class="lazy"></span>
                        <img src="{{ asset('images/3c.png') }}" width="220px" hight="210px" class="mw-100 mb-3">
                    </a>
                     <span class="numberHot"></span>
                    <h4 class="text-orange"></h4>

                </div>
                <div class="item">
                    <a href="{{ url('work') }}">
                          <span class="numberHot">   <img data-src="assets/fontend/images/number_hot/number6.png" alt="" class="lazy"></span>
                        <img src="{{ asset('images/3c.png') }}" width="220px" hight="210px" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="item">
                    <a href="{{ url('training') }}">
                          <span class="numberHot">   <img data-src="assets/fontend/images/number_hot/number7.png" alt="" class="lazy"></span>
                        <img src="{{ asset('images/3c.png') }}"  width="220px" hight="210px" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="item">
                    <a href="{{ url('#') }}">
                          <span class="numberHot">   <img data-src="assets/fontend/images/number_hot/number8.png" alt="" class="lazy"></span>
                        <img src="{{ asset('images/3c.png') }}"  width="220px" hight="210px" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                      <div class="item" >

                    <a href="{{ url('projectauction') }}">
                     <span class="numberHot">   <img data-src="assets/fontend/images/number_hot/number9.png" alt="" class="lazy"></span>
                        <img src="{{ asset('images/3c.png') }}" width="220px" hight="210px" class="mw-100 mb-3">
                    </a>
                     <span class="numberHot"></span>
                    <h4 class="text-orange"></h4>

                </div>
                <div class="item">
                    <a href="{{ url('work') }}">
                          <span class="numberHot">   <img data-src="assets/fontend/images/number_hot/number10.png" alt="" class="lazy"></span>
                        <img src="{{ asset('images/3c.png') }}" width="220px" hight="210px" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div> --}}

            </div>
            <br> <br>

            <h1 class="mb-3 text-left">
                <font style="color:black">หลักสูตรแนะนำ</font>
            </h1>
            <br>
            <h1 class="mb-3 text-left">
                <font style="color:black">Leadership and Management</font>
            </h1>
            <h5 class="mb-3 text-left">
                <font style="color:grey">Leadership is a skill for any role—not just managers. Learn how to become a more
                    successful leader,
                    improve communication, make better decisions, manage conflict, and lead others through times of change.
                </font>
            </h5> <br>
            <div class="hotclass_slide owl-carousel owl-theme">
                @foreach ($courses_trending as $c)
                    <div class="item">
                        <h6 class="text-orange text-left">{{ $c->name }}</h6>
                        <a href="{{ url('course_online_view/' . $c->id) }}">
                            <img src="{{ asset('images/profile/' . $c->image) }}"width="220px" hight="210px" class="mw-100 mb-2">
                        </a>

                    </div>
                @endforeach
                {{-- <div class="item">
                    <a href="{{ url('work') }}">
                        <img src="{{ asset('images/4c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="item">
                    <a href="{{ url('training') }}">
                        <img src="{{ asset('images/4c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="item">
                    <a href="{{ url('#') }}">
                        <img src="{{ asset('images/4c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="item">
                    <a href="{{ url('#') }}">
                        <img src="{{ asset('images/4c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="item">
                    <a href="{{ url('#') }}">
                        <img src="{{ asset('images/4c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div> --}}
                <br>

            </div> <br>

            <h1 class="mb-3 text-left">
                <font style="color:black">Data Science</font>
            </h1>
            <h5 class="mb-3 text-left">
                <font style="color:grey">Data science is one of today's top careers. Get the training you need to get
                    ahead—or stay on top—in fields such as data analysis,
                    mining, visualization, and big data, using tools like Excel, R, Hadoop, and Python.</font>
            </h5> <br>
            <div class="hotclass_slide owl-carousel owl-theme">

                @foreach ($courses_trending as $c)
                    <div class="item">
                        <h6 class="text-orange text-left">{{ $c->name }}</h6>
                        <a href="{{ url('course_online_view/' . $c->id) }}">
                            <img src="{{ asset('images/profile/' . $c->image) }}"width="220px" hight="210px"  class="mw-100 mb-2">
                        </a>

                    </div>
                @endforeach

                {{-- <div class="item">
                    <a href="{{ url('projectauction') }}">
                        <img src="{{ asset('images/4c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="item">
                    <a href="{{ url('work') }}">
                        <img src="{{ asset('images/4c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="item">
                    <a href="{{ url('training') }}">
                        <img src="{{ asset('images/4c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="item">
                    <a href="{{ url('#') }}">
                        <img src="{{ asset('images/4c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>

                <div class="item">
                    <a href="{{ url('#') }}">
                        <img src="{{ asset('images/4c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="item">
                    <a href="{{ url('#') }}">
                        <img src="{{ asset('images/4c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div> --}}
            </div>

        </div>
    </div>

    {{-- end #work 1 --}}





    {{-- <script src="/js/app.js" charset="utf-8"></script> --}}
    <script src="{{ asset('js/app.js') }}"></script>


@endsection
@section('script')
    <script>
        $('.owl-carousel2').owlCarousel({
            nav: false,
            loop: false,

            margin: 10,
            arrows: false,
            infinite: false,
            dots: false,
            autoHeight: true,

            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })
        $('.owl-carousel').owlCarousel({
            loop: false,

            margin: 10,
            nav: true,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items:4
                }
            }
        })
        $('.owl-carousel3').owlCarousel({
            loop: false,
            margin: 10,
            nav: true,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })
    </script>
    <script>
        FontAwesomeConfig = {
            searchPseudoElements: true
        };
    </script>
    <script type="text/javascript">
        $(document).ready(function() {


            $("body").on("mouseover", ".hotclass_slide .owl-item,.movie-carousel .owl-item", function() {
                $(this).parent().find(".owl-item.active").addClass("hov");
                $(this).removeClass("hov");
            });

            $("body").on("mouseleave", ".hotclass_slide .owl-item,.movie-carousel .owl-item", function() {
                $(this).parent().find(".owl-item.hov").removeClass("hov");
            });

            $(".movie-carousel").owlCarousel({
                loop: false,
                rewind: true,
                margin: 10,
                nav: true,
                lazyLoad: true,
                navText: ['<img src="assets/fontend/images/arrow_left.png">',
                    '<img src="assets/fontend/images/arrow_right.png">'
                ],
                autoplayHoverPause: false,
                dots: false,
                autoplay: false,
                autoplayTimeout: 7000,
                smartSpeed: 1000,
                stagePadding: 0,
                slideBy: 1,
                responsive: {
                    0: {
                        items: 2,
                        center: true,
                        loop: false,
                        margin: 30,
                        startPosition: 1
                    },
                    500: {
                        items: 2,
                        center: true,
                        loop: true,
                        margin: 40
                    },
                    768: {
                        margin: 50,
                        items: 3,
                        center: true,
                        loop: true
                    },
                    992: {
                        margin: 20,
                        items: 3
                    },
                    1201: {
                        margin: 25,
                        items: 4
                    }
                },
            });

            $(".introLearnm ").owlCarousel({
                loop: false,
                rewind: true,
                margin: 10,
                nav: true,
                lazyLoad: true,
                navText: ['<img src="assets/fontend/images/arrow_left.png">',
                    '<img src="assets/fontend/images/arrow_right.png">'
                ],
                autoplayHoverPause: false,
                dots: false,
                autoplay: false,
                autoplayTimeout: 7000,
                smartSpeed: 1000,
                stagePadding: 0,
                slideBy: 1,
                responsive: {
                    0: {
                        items: 1
                    },
                    500: {
                        items: 1
                    },
                    768: {
                        margin: 20,
                        items: 1
                    },
                    992: {
                        margin: 20,
                        items: 1
                    },
                    1201: {
                        margin: 25,
                        items: 1
                    }
                }
            });

            $(".hotclass_slide").owlCarousel({
                loop: false,
                rewind: true,
                margin: 10,
                nav: true,
                lazyLoad: true,
                navText: ['<img src="assets/fontend/images/arrow_left.png">',
                    '<img src="assets/fontend/images/arrow_right.png">'
                ],
                autoplayHoverPause: false,
                dots: false,
                autoplay: false,
                autoplayTimeout: 7000,
                smartSpeed: 1000,
                stagePadding: 0,
                slideBy: 1,
                responsive: {
                    0: {
                        items: 2,
                        center: true,
                        loop: true,
                        nav: true,
                        margin: 30
                    },
                    500: {
                        items: 2,
                        center: true,
                        loop: true,
                        nav: true,
                        margin: 40
                    },
                    768: {
                        margin: 50,
                        items: 3,
                        center: true,
                        loop: true,
                        nav: true
                    },
                    992: {
                        margin: 20,
                        items: 3
                    },
                    1201: {
                        margin: 25,
                        items: 5
                    }
                }
            });

            $('.myslider').owlCarousel({
                items: 1,
                nav: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 10000,
                smartSpeed: 1000,
                lazyLoad: true,
                navText: ['<img src="assets/fontend/images/BN_left.png">',
                    '<img src="assets/fontend/images/BN_right.png">'
                ],
                dotsSpeed: 500,
                dotsData: true,
                responsive: {
                    0: {
                        items: 1,
                        slideBy: 1,
                        autoplay: true,
                        margin: 10,
                        nav: true,
                        // dotsData: false,
                        dots: false,
                    },
                    600: {
                        items: 1,
                        slideBy: 1,
                        nav: true,
                        autoplay: true,
                        // dotsData: false,
                        dots: false,
                    },
                    1024: {
                        items: 1,
                        slideBy: 1
                    },
                    1200: {
                        items: 1,
                        slideBy: 1
                    }
                },
            });

            $('.myslider').on('changed.owl.carousel', function(e) {
                let index = e.relatedTarget.relative(e.relatedTarget.current());
                if (index == 0) {
                    if (mobilesize.matches) {
                        //if (isIphone) { player2.currentTime = 0; }else{ player2.currentTime(0); }
                        player2.play();
                        player.pause();
                    } else {
                        //if (isIphone) { player.currentTime = 0; }else{ player.currentTime(0); }
                        //if (mobilesize.matches) { player2.pause(); }
                        player2.pause();
                        player.play();
                    }
                } else {
                    if (mobilesize.matches) {
                        // $('#mypromotevideo2').get(0).pause();
                        /* if (!player2.paused) {
                            player2.paused = false;
                            //player2.pause();
                        } */
                        player2.pause();
                    } else {
                        player.pause();
                    }
                    // player.pause();
                }
            })

            function moved() {
                var owl = $(".movie-carousel").data('owlCarousel');
                //alert(owl.currentItem );
                /* if (owl.currentItem + 1 === owl.itemsAmount) {
                    alert('THE END');
                } */
            }
        });
    </script>
    <script type="text/javascript">
        $(".tovideo").on("click", function() {
            var value = $(this).attr("data-id");
            window.location.href = "learn/" + value;
        })
    </script>
    <!-- lazy for IOS -->
    <script type="text/javascript">
        let images = document.querySelectorAll('source, img');

        if ('IntersectionObserver' in window) {
            // IntersectionObserver Supported
            let config = {
                root: null,
                rootMargin: '0px',
                threshold: 0.5
            };

            let observer = new IntersectionObserver(onChange, config);
            images.forEach(function(img) {
                observer.observe(img)
            });

            function onChange(changes, observer) {
                changes.forEach(function(change) {
                    if (change.intersectionRatio > 0) {
                        // Stop watching and load the image
                        loadImage(change.target);
                        observer.unobserve(change.target);
                    }
                });
            }

        } else {
            // IntersectionObserver NOT Supported
            images.forEach(function(image) {
                loadImage(image)
            });
        }

        function loadImage(image) {
            image.classList.add('fade-in');
            if (image.dataset && image.dataset.src) {
                image.src = image.dataset.src;
            }

            if (image.dataset && image.dataset.srcset) {
                image.srcset = image.dataset.srcset;
            }
        }
    </script>


    <!-- Lazy Load -->
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            var lazyloadImages = document.querySelectorAll("img.lazy");
            var lazyloadThrottleTimeout;

            function lazyload() {
                if (lazyloadThrottleTimeout) {
                    clearTimeout(lazyloadThrottleTimeout);
                }

                lazyloadThrottleTimeout = setTimeout(function() {
                    var scrollTop = window.pageYOffset;
                    lazyloadImages.forEach(function(img) {
                        if (img.offsetTop < (window.innerHeight + scrollTop)) {
                            img.src = img.dataset.src;
                            img.classList.remove('lazy');
                        }
                    });
                    if (lazyloadImages.length == 0) {
                        document.removeEventListener("scroll", lazyload);
                        window.removeEventListener("resize", lazyload);
                        window.removeEventListener("orientationChange", lazyload);
                    }
                }, 20);
            }

            document.addEventListener("scroll", lazyload);
            window.addEventListener("resize", lazyload);
            window.addEventListener("orientationChange", lazyload);
        });
    </script>
    <style>
        .card-popup1:hover,
        .card-popup2:hover,
        .card-popup3:hover,
        .card-popup4:hover {
            background-color: #8B0900;
            color: #fff;
        }

        .card-popup1:hover h4,
        .card-popup2:hover h4,
        .card-popup3:hover h4,
        .card-popup4:hover h4 {
            color: #fff;
        }

        .card-popup1:hover img {
            content: url({{ asset('image/index-auction - Copy.png') }});
        }

        .card-popup2:hover img {
            content: url({{ asset('image/index-findjob - Copy.png') }});
        }

        .card-popup3:hover img {
            content: url({{ asset('image/index-knowledge - Copy.png') }});
        }

        .card-popup4:hover img {
            content: url({{ asset('image/index-store - Copy.png') }});
        }
    </style>
@endsection
