@extends('layouts.navber')
@section('head')
    @include('sweetalert::alert')
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/2.1.99/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.0/css/swiper.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.0/js/swiper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    {{--<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">--}}
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        .ui-autocomplete {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1510 !important;
            float: left;
            display: none;
            min-width: 160px;
            width: 160px;
            padding: 4px 0;
            margin: 2px 0 0 0;
            list-style: none;
            background-color: #ffffff;
            border-color: #ccc;
            border-color: rgba(0, 0, 0, 0.2);
            border-style: solid;
            border-width: 1px;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            -webkit-background-clip: padding-box;
            -moz-background-clip: padding;
            background-clip: padding-box;
            *border-right-width: 2px;
            *border-bottom-width: 2px;
        }
        .ui-menu-item > a.ui-corner-all {
            display: block;
            padding: 3px 15px;
            clear: both;
            font-weight: normal;
            line-height: 18px;
            color: #555555;
            white-space: nowrap;
            text-decoration: none;
        }
        .ui-state-hover, .ui-state-active {
            color: #ffffff;
            text-decoration: none;
            background-color: #0088cc;
            border-radius: 0px;
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            background-image: none;
        }
        /*#modalIns{*/
            /*width: 500px;*/
        /*}*/

        /* Button */
        .btn-circle.btn-xl {
            width: 70px;
            height: 70px;
            padding: 10px 16px;
            border-radius: 35px;
            font-size: 24px;
            line-height: 1.33;
        }

        .btn-circle {
            width: 30px;
            height: 30px;
            padding: 6px 0px;
            border-radius: 15px;
            text-align: center;
            font-size: 12px;
            line-height: 1.42857;
        }
    </style>
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
                                    <a class="btn btn-warning w-100 mt-2" href="{{ url('chat') }}"><i class='far fa-comment-dots'></i> ส่งข้อความ</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <h3>อนุมัติโครงการ</h3>
                            <hr>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="font-weight-bold">ชื่อโครงการ</label>
                                </div>
                                <div class="form-group col-md-8">
                                    {!!  $approve_work->title !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="font-weight-bold">ราคา</label>
                                </div>
                                <div class="form-group col-md-8">
                                    {!!  $approve_work->price !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="font-weight-bold">รายละเอียด ขอบเขตงาน</label>
                                </div>
                                <div class="form-group col-md-8">
                                    {!!  $approve_work->detail_scope !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="font-weight-bold">ระยะเวลา</label>
                                </div>
                                <div class="form-group col-md-8">
                                    {{ $approve_work->start_date }} ถึง {{ $approve_work->end_date }}
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="font-weight-bold">ผู้อนุมัติ</label>
                                </div>
                                <div class="form-group col-md-8">
                                    {{ $p_owner->firstname }}  {{ $p_owner->lastname }}
                                </div>
                                <hr>
                            </div>
                            <br>
                            @if($approve_work->status == 1)
                                <form action="{{  URL::to('approve/work/') }}" method="POST" enctype="multipart/form-data">
                                    <div class="form-row">
                                        {{--<input name="_method" type="hidden" value="POST">--}}
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="wp_id" value="{{ $wpID }}">
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <input type="hidden" name="user_id_send" value="{{ $user_id_send }}">
                                        <input type="hidden" name="user_id_to" value="{{ $user_id_to }}">
                                        <input type="hidden" name="title" value="{{  $approve_work->title }}">
                                        <div class="form-group col-md-4">
                                            <label class="font-weight-bold">อนุมัติงาน</label>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <select name="approve" id="approve" class="form-control" required>
                                                <option selected="selected" disabled="disabled" value="">กรุณาเลือก</option>
                                                <option value="3">อนุมัติ</option>
                                                <option value="2">ไม่อนุมัติ</option>
                                            </select>
                                        </div>
                                        <div class="form-group  col-md-4"></div>
                                        <div class="form-group  col-md-4">
                                            <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                                        </div>
                                        <div class="form-group  col-md-4"></div>
                                    </div>
                                </form>
                            @else
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label class="font-weight-bold">สถานะ</label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        @if($approve_work->status == 1) รออนุมัติ
                                        @elseif($approve_work->status == 2)
                                        <h6><span class="badge badge-danger font-weight-light"> ไม่อนุมัติ</span></h6>
                                        @elseif($approve_work->status == 3)
                                        <h6><span class="badge badge-info font-weight-light"> เริ่มงาน</span></h6>
                                        @elseif($approve_work->status == 4)
                                        <h6><span class="badge badge-success font-weight-light"> เสร็จสิ้น</span></h6>
                                        @elseif($approve_work->status == 5)
                                            <h6><span class="badge badge-danger font-weight-light"> ยกเลิกงาน</span></h6>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @if($approve_work->status == 4)
                                <br>
                                <br>
                                @if (!Auth::guest())
                                    @if ($comment == 'yes')
                                        <div id="app">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card border-warning">
                                                        <div class="card-body">
                                                            <review-comment id="{{ $wpID }}"></review-comment>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- end #รายละเอียด ประกาศหางาน --}}
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
                timer: 3000
            })
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $( "#search" ).autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{url('autocomplete/user')}}",
                        data: {
                            term : request.term
                        },
                        dataType: "json",
                        success: function(data){
                            var resp = $.map(data,function(obj){
                                // console.log(obj);
                                $('#user_id_to').val(obj.id);
                                return "Username : "+obj.name+" - "+obj.firstname+' '+obj.lastname;

                            });
                            response(resp);
                        }
                    });
                },
                minLength: 1
            });
        });
    </script>
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
@endsection