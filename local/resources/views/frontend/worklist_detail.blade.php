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
        .circlered {
            background-color: #8B0900;
            border-radius: 50%;
            border: 1px solid #8B0900;
            padding: 10px;
        }

        .main {
            background-image: url("{{ asset('images/bgco3.png') }}");
            background-repeat: no-repeat;
            background-size: auto;
            background-color: #8B0900;

        }

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
    </style>
@endsection
@section('content')
    {{-- begin #banner --}}
    <div class="main">
        <div id="index-banner" class="bg-white">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">

                    <li data-target="#carouselExampleIndicators" data-slide-to=""></li>

                </ol>
                <div class="carousel-inner">

                    <div class="carousel-item">

                        <img src="{{ asset('images/bannermockup.png') }}" class="d-block w-100" alt="...">

                    </div>

                </div>
            </div>
        </div>
        {{-- end #banner --}}

        {{-- begin #content 1 --}}


    </div>
    {{-- end #content 1 --}}
    <div class="container text-center py-4">
        <h1 class="mb-3 text-left">
            <font style="color:black">UX/UI Designer</font>
        </h1>

        <h5 class=" text-left">
            <font style="color:black">13 งานใน เชียงใหม่, เชียงใหม่, ประเทศไทย (3 ใหม่)</font>
        </h5>
        <br> <br>
        <div class="row">

            <div class="col-6">{{-- start #แบ่งครึ่ง1 --}}
                <br> <br>



                <div class="row">

                    @foreach ($jobs as $j)
                        <div class="col-12">
                            <div class="row">
                                <div class="col-4">
                                    <img src="{{ asset('images/profile/' . $j->Profile->image_profile) }}"
                                        class="mw-100 mb-3" width="150px" height="150px">
                                </div>
                                <div class="col-8">
                                    <h5 class="mb-3 text-left">
                                        <font style="color:black">{{ $j->position }}</font>
                                    </h5>
                                    <p class="mb-3 text-left">
                                        <font style="color:gray">{{ $j->location }}</font>
                                    </p>
                                    <p class="mb-3 text-left">
                                        <font style="color:gray"> มาเป็นหนึ่งในผู้สมัคร 25 คนแรก</font>
                                    </p>
                                    <p class="mb-3 text-left">
                                        <font style="color:gray"><i class="fa fa-clock" aria-hidden="true"
                                                style="color:green;"></i> {{ $j->created_at }} </font>
                                    </p>
                                    <p class="mb-3 text-left"> <i class='fas fa-user-circle fa-lg'></i>
                                        <font style="color:black">โปรไฟล์ของคุณเข้ากับงานนี้</font>
                                    </p>

                                    <a href="{{ url('worklist_detail/' . $j->id) }}"
                                        style="background-color:#374291; color:white;" class="btn "> ดูข้อมูล
                                    </a>
                                </div>
                            </div>
                        </div>{{-- end #work --}}
                    @endforeach

                </div>


            </div>{{-- end #แบ่งครึ่ง1 --}}
            <div class="col-6" style= "border: 1px solid #ccc!important;    border-radius: 16px; border-radius: 16px;">{{-- start #แบ่งครึ่ง2 --}}
                <br> <br>
                <h5 class="mb-3 text-left"> <i class='fas fa-user-circle fa-lg' style="color:black"></i>
                    <font style="color:black">โปรไฟล์ของคุณเข้ากับงานนี้</font>
                </h5>
                <br>
                <div class="row">
                    <div class="col-6">
                        <img src="{{ asset('images/profile/' . $job->Profile->company_img1) }}" width="300px"
                            height="250px" class="mw-100 mb-3">
                        {{-- <img src="{{ asset('images/imgup.png') }}" class="mw-100 mb-3"> --}}
                    </div>
                    <div class="col-6">
                        {{-- <img src="{{ asset('images/imgup.png') }}" class="mw-100 mb-3"> --}}
                        <img src="{{ asset('images/profile/' . $job->Profile->company_img2) }}" width="300px"
                            height="250px" class="mw-100 mb-3">
                    </div>
                </div>
                <br> <br>
                <div class="row">
                    <div class="col-12">{{-- start #work --}}
                        <div class="row">
                            <div class="col-4">
                                {{-- <img src="{{ asset('images/logoup.png') }}" class="mw-100 mb-3"> --}}
                                <img src="{{ asset('images/profile/' . $j->Profile->image_profile) }}" class="mw-100 mb-3"
                                    width="150px" height="150px">
                            </div>
                            <div class="col-8">
                                <h5 class="mb-3 text-left">
                                    <font style="color:black">{{ $job->position }}</font>
                                </h5>
                                <p class="mb-3 text-left">
                                    <font style="color:gray">{{ $job->location }}</font>
                                </p>
                                <p class="mb-3 text-left">
                                    <font style="color:gray"> มาเป็นหนึ่งในผู้สมัคร 25 คนแรก</font>
                                </p>
                                <p class="mb-3 text-left">
                                    <font style="color:gray"><i class="fa fa-clock" aria-hidden="true"
                                            style="color:green;"></i> {{ $j->created_at }} </font>
                                </p>
                                <p class="mb-3 text-left"> <a href="{{url('worklist_detail_register/'.$j->id)}}"
                                        style="background-color:#374291; color:white;" class="btn">สมัครงาน &nbsp;<i
                                            class="fa fa-briefcase"></i></a></p>

                                <br>
                            </div>
                        </div>
                    </div>{{-- end #work --}}
                    <div class="col-12">{{-- start #work --}}
                        <div class="row">
                            <br> <br>
                            <div class="col-12">
                                <h5 class="mb-3 text-left">
                                    <font style="color:black">ข้อมูลบริษัท</font>
                                </h5>
                                <p class="mb-3 text-left">
                                    <font style="color:gray">{{ $job->Profile->detail_about_me }}</font>
                                </p>
                                <p class="mb-3 text-left">
                                    <font style="color:gray">
                                        {{ $job->Profile->company_address }}

                                    </font>
                                </p>
                                <br> <br>
                                <p class="mb-3 text-left">
                                    <font style="color:black">ลักษณะการทำงาน - บริหารงาน ประชุม อมรม</font>
                                </p>

                                <p class="mb-3 text-left">
                                    <font style="color:gray"><i class="fa fa-circle" aria-hidden="true"></i>
                                        ขยายการตลาด ประสานงานขาย</font>
                                </p>
                                <p class="mb-3 text-left">
                                    <font style="color:gray"><i class="fa fa-circle" aria-hidden="true"></i>ฝึกอบรม
                                        พัฒนาตนเองและบุคคลากร
                                    </font>
                                </p>
                                <p class="mb-3 text-left">
                                    <font style="color:gray"><i class="fa fa-circle" aria-hidden="true"></i>
                                        ออกตลาด พบปะกลุ่มลูกค้า</font>
                                </p>

                            </div>
                            <div class="col-6">
                                <br> <br>
                                <p class="mb-3 text-left">
                                    <font style="color:black">ระดับประสบการณ์</font>
                                </p>

                                <p class="mb-3 text-left">
                                    <font style="color:#374291;"><i class="fa fa-briefcase" aria-hidden="true"></i>
                                        {{ $j->level }}</font>
                                </p>

                            </div>
                            <div class="col-6">
                                <br> <br>
                                <p class="mb-3 text-left">
                                    <font style="color:black">ประเภทการจ้างงาน</font>
                                </p>

                                <p class="mb-3 text-left">
                                    <font style="color:#374291;"><i class="fa fa-calendar-check" aria-hidden="true"></i>
                                        {{ $j->get_employment_type() }}</font>
                                </p>

                            </div>
                            <div class="col-12">
                                <br> <br>
                                <p class="mb-3 text-left">
                                    <font style="color:black">เงินเดือน</font>
                                </p>

                                <p class="mb-3 text-left">
                                    <font style="color:#374291;"><i class="fa fa-credit-card" aria-hidden="true"></i>
                                        {{ $j->salary }} รายเดือน</font>
                                </p>

                                {{-- <div class="col-12">
                                    <br> <br>
                                    <p class="mb-3 text-left">
                                        <font style="color:black">Skill ที่ต้องการ</font>
                                    </p>

                                    <p class="mb-3 text-left">
                                        <font style="color:#374291;"><i class="fa fa-circle" aria-hidden="true"></i>
                                            ขยายการตลาด ประสานงานขาย</font>
                                    </p>
                                    <p class="mb-3 text-left">
                                        <font style="color:#374291;"><i class="fa fa-circle" aria-hidden="true"></i>
                                            ฝึกอบรม พัฒนาตนเองและบุคคลากร
                                        </font>
                                    </p>
                                    <p class="mb-3 text-left">
                                        <font style="color:#374291;"><i class="fa fa-circle" aria-hidden="true"></i>
                                            ทักษะการพูดชั้นเชิง</font>
                                    </p>
                                </div> --}}
                                <div class="col-12">
                                    <br> <br>
                                    <p class="mb-3 text-left">
                                        <font style="color:black">คอร์สเรียนที่ควรผ่านการเรียนรู้มาก่อน</font>
                                    </p>

                                    <?php
                                    if($j->course_id_for_job!=''){
                                        $arr_course_id_for_job = explode(',',$j->course_id_for_job);
                                    }else{
                                        $arr_course_id_for_job = [];
                                    }

                                    ?>
                                    @foreach($arr_course_id_for_job as $arr)
                                    <?php
                                        $c_data = \DB::table('courses')->where('id',$arr)->first();
                                    ?>

                                    <p class="mb-3 text-left">
                                        <font style="color:#374291;"><i class="fa fa-check" aria-hidden="true"></i>
                                            <a href="{{url('course_online_view/'.@$c_data->id)}}">{{@$c_data->name}}</a></font>&nbsp; &nbsp;&nbsp; &nbsp;
                                        {{-- <font style="color:blue;">Certificate</font> --}}
                                    </p>
                                    @endforeach
                                    {{-- <p class="mb-3 text-left">
                                        <font style="color:gray;"><i class="fa fa-times" aria-hidden="true"></i> ฝึกอบรม
                                            พัฒนาตนเองและบุคคลากร
                                        </font>&nbsp; &nbsp;&nbsp; &nbsp;<font style="color:gray;">Not Certificate</font>
                                    </p>
                                    </p>
                                    <p class="mb-3 text-left">
                                        <font style="color:#374291;"><i class="fa fa-check" aria-hidden="true"></i>
                                            ผ่านการเรียนคอร์ส พัฒนาตัวเอง</font>&nbsp; &nbsp;&nbsp; &nbsp;<font
                                            style="color:blue;">Certificate</font>
                                    </p>
                                    </p> --}}
                                </div>
                            </div>
                        </div>{{-- end #work --}}


                    </div>


                </div>{{-- end #แบ่งครึ่ง2 --}}


            </div>

        </div>
    </div>

    {{-- begin #work 1 --}}



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
                    items:
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
                    items: 5
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
