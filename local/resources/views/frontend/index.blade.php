@extends('layouts.navber')
@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick-theme.css') }}"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
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
.horizontal-scroll-wrapper > div {
  width: 100px;
  height: 100px;
}
.horizontal-scroll-wrapper {
  ...
  transform: rotate(-90deg);
  transform-origin: right top;
}
.horizontal-scroll-wrapper > div {
  ...
  transform: rotate(90deg);
  transform-origin: right top;
}
</style>
@endsection
@section('content')
<!-- <div class="container" s>
    
  <img src="{{ asset('images/bannermockup.png') }}" alt="Snow" style="width:100%;background-color:powderblue;">
  <div class="bottom-left">Bottom Left</div>
  <div class="top-left">Top Left</div>
  <div class="top-right">Top Right</div>
  <div class="bottom-right">Bottom Right</div>
  <div class="centered">Centered</div>
</div> -->
    <a data-fancybox data-src="#hidden-content-b" href="javascript:" class="btnpopup"></a>
    <div style="display: none;max-width:100%" id="hidden-content-b">
        <h1 class="mb-3 text-center">แนะนำหลักสูตร</span></h1>
        <div class="row text-center">
            <div class="col-xl-6 col-md-6">
                <a href="#">
                    <div class="card mb-3 card-popup1">
                        <div class="card-body">
                            <img src="{{ asset('images/1c.png') }}" class="mw-100 mb-3">
                            <h4 class="text-orange"></h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-6 col-md-6">
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
                            
                            <img src="{{ asset('images/bannermockup.png') }}" class="d-block w-100" alt="...">
                          
                        </div>
                        <?php $active = ''?>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    {{-- end #banner--}}

    {{-- begin #content 1--}}

 <div class="row">
         <div class="col-1">
        </div>
      <div class="col-8">
        <div class="container text-center py-4">
            <br>     <br>
 
            <h1 class=" text-left"><font style="color:black">หลักสูตรที่กำลังเป็นกระแส</font></h1>
                 <br>     <br>
    
            <div class="row">
                <div class="col-sm my-2 col-3">
                    <a href="{{ url('projectauction') }}">
                        <img src="{{ asset('images/1c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="col-sm my-2 col-3">
                    <a href="{{ url('work') }}">
                        <img src="{{ asset('images/1c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="col-sm my-2 col-3">
                    <a href="{{ url('training') }}">
                        <img src="{{ asset('images/1c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="col-sm my-2 col-3">
                    <a href="{{ url('#') }}">
                        <img src="{{ asset('images/1c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
            </div>
              <br>     <br>
 
            <h1 class="mb-3 text-left"><font style="color:black">คอร์สเรียนของคุณเรียนต่อเลย :-)</font></h1>
                 <br>     <br>
                      <div class="row">
                <div class="col-sm my-2 col-3">
                    <a href="{{ url('projectauction') }}">
                        <img src="{{ asset('images/2c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
             <div class="col-sm my-2 col-3">
               </div> 
                <div class="col-sm my-2 col-3">
               </div> 
                <div class="col-sm my-2 col-3">
               </div> 
                
            </div>
        </div>
    </div>
    <div class="col-2">

 
           <div class="container text-center py-4">
            <br>     <br>  <br> 
 
            <h5 class="mb-3 text-left"><font style="color:grey">หัวข้อหลักสูตรน่าสนใจ</font></h5>
                   <br>
    
            <div class="row">
                
                <a class="nav-link py-1 buttonblack " style="margin-right: 20px;margin-top: 20px;" href="{{ url('register') }}"><font style="color:grey">Business</font></a>
                <a class="nav-link py-1 buttonblack"  style="margin-right: 20px;margin-top: 20px;" href="{{ url('register') }}"><font style="color:grey">CRM Software</font></a>
                <br> <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="{{ url('register') }}"><font style="color:grey">Customer Service</font></a><br>
                 <br><a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="{{ url('register') }}"><font style="color:grey">Communication</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="{{ url('register') }}"><font style="color:grey">Marketing</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="{{ url('register') }}"><font style="color:grey">Customer Service</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="{{ url('register') }}"><font style="color:grey">Web Marketing Analytics</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="{{ url('register') }}"><font style="color:grey">Google Analytics</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="{{ url('register') }}"><font style="color:grey">Data Analysis</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="{{ url('register') }}"><font style="color:grey">Leadership and Management</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="{{ url('register') }}"><font style="color:grey">Leadership Skills</font></a>
        
            </div>
        </div>
    </div>
           
  </div>   <div class="col-1">
        </div>
  </div>

       </div> 
    {{-- end #content 1--}}

    {{-- begin #work 1--}}
    <div id="index-section2" class="row">
         <div class="col-12">
        <div class="container text-center py-4" >
          
              <br>     <br>
 
            <h1 class="mb-3 text-left"><font style="color:black">10 หลักสูตรที่มีการซื้อสูงสุด</font></h1>
                 <br>     <br>
                      <div class="row">
                <div class="col-sm my-2 col-3">
                    <a href="{{ url('projectauction') }}">
                        <img src="{{ asset('images/3c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="col-sm my-2 col-3">
                    <a href="{{ url('work') }}">
                        <img src="{{ asset('images/3c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="col-sm my-2 col-3">
                    <a href="{{ url('training') }}">
                        <img src="{{ asset('images/3c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="col-sm my-2 col-3">
                    <a href="{{ url('#') }}">
                        <img src="{{ asset('images/3c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
            </div>
             <br>     <br>
 
            <h1 class="mb-3 text-left"><font style="color:black">หลักสูตรแนะนำ</font></h1>
                 <br>  
                  <h1 class="mb-3 text-left"><font style="color:black">Leadership and Management</font></h1> 
                    <h5 class="mb-3 text-left"><font style="color:grey">Leadership is a skill for any role—not just managers. Learn how to become a more successful leader, 
improve communication, make better decisions, manage conflict, and lead others through times of change.</font></h5>  <br>  
                   <div class="row">
                <div class="col-sm my-2 col-3">
                    <a href="{{ url('projectauction') }}">
                        <img src="{{ asset('images/4c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="col-sm my-2 col-3">
                    <a href="{{ url('work') }}">
                        <img src="{{ asset('images/4c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="col-sm my-2 col-3">
                    <a href="{{ url('training') }}">
                        <img src="{{ asset('images/4c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="col-sm my-2 col-3">
                    <a href="{{ url('#') }}">
                        <img src="{{ asset('images/4c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                
                 <br>  
                  
            </div>    <br> 
            <h1 class="mb-3 text-left"><font style="color:black">Data Science</font></h1> 
                    <h5 class="mb-3 text-left"><font style="color:grey">Data science is one of today's top careers. Get the training you need to get ahead—or stay on top—in fields such as data analysis, 
mining, visualization, and big data, using tools like Excel, R, Hadoop, and Python.</font></h5>  <br>  
                   <div class="row">
                <div class="col-sm my-2 col-3">
                    <a href="{{ url('projectauction') }}">
                        <img src="{{ asset('images/4c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="col-sm my-2 col-3">
                    <a href="{{ url('work') }}">
                        <img src="{{ asset('images/4c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="col-sm my-2 col-3">
                    <a href="{{ url('training') }}">
                        <img src="{{ asset('images/4c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
                <div class="col-sm my-2 col-3">
                    <a href="{{ url('#') }}">
                        <img src="{{ asset('images/4c.png') }}" class="mw-100 mb-3">
                    </a>
                    <h4 class="text-orange"></h4>
                </div>
        </div>
           
    </div>
    </div>
    {{-- end #work 1--}}

 

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
            background-color: #504f4b;
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
