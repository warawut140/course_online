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
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet">
    <style>
        /*.ui-autocomplete-input {*/
            /*border: none;*/
            /*font-size: 14px;*/
            /*width: 300px;*/
            /*height: 24px;*/
            /*margin-bottom: 5px;*/
            /*padding-top: 2px;*/
            /*border: 1px solid #DDD !important;*/
            /*padding-top: 0px !important;*/
            /*z-index: 1511;*/
            /*position: relative;*/
        /*}*/
        /*.ui-menu .ui-menu-item a {*/
            /*font-size: 12px;*/
        /*}*/
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
                            <h3>การจัดการงาน
                                <button class="btn btn-sm btn-dark" data-toggle="modal" data-target="#createMgmtWork">
                                    สร้างโครงการงาน
                                </button>
                            </h3>

                            <div class="modal fade" id="createMgmtWork" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">สร้างโครงการงาน</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                                            </button>
                                        </div>
                                        {!! Form::open(['url' => 'add/mgmt-work' , 'files'=>true , 'data-parsley-required' => 'true' ]) !!}
                                        {{csrf_field()}}
                                        <input type="hidden" name="wp_id" value="{{ $id }}">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <h6>{!! $works->title !!}</h6>
                                                <input id="work_title" name="work_title" type="hidden" value="{!! $works->title !!}"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">ระบุผู้จ้างงาน หรือ รับงาน</label>
                                                {{-- <input id="search" name="search" type="text" class="form-control" placeholder="Search : Username or FirstName or LastName" required/>
                                                <input id="user_id_to" name="user_id_to" type="hidden" /> --}}
                                                <select required name="user_id_to" class="form-control select2">
                                                    <option value="">กรุณาเลือก</option>
                                                    @foreach ($users as $u)
                                                    <option value="{{ $u->id }}">Username : {{ $u->name }} - {{ $u->firstname }} {{ $u->lastname }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">ชื่อโครงการ</label>
                                                {!!  Form::text('title',null,['id' => 'title','class' => 'form-control','required']) !!}
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">ราคาที่ตกลง</label>
                                                {!!  Form::text('price',null,['id' => 'price','class' => 'form-control' , 'required']) !!}
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">รายละเอียดของงาน (ขอบเขตงาน)</label>
                                                {!!  Form::textarea('detail_scope',null,['id' => 'detail_scope','class' => 'form-control' ,'rows' => '3']) !!}
                                                {{--<textarea class="form-control" rows="4" name="detail_scope" id="detail_scope"></textarea>--}}
                                            </div>
                                            <div class="form-group">
                                                <label for="inputCity">วันเริ่มงาน</label>
                                                {!!  Form::date('start_date',null,['id' => 'start_end','class' => 'form-control' , 'required']) !!}
                                            </div>
                                            <div class="form-group">
                                                <label for="inputCity">วันปิดงาน</label>
                                                {!!  Form::date('end_date',null,['id' => 'end_date','class' => 'form-control' ,'required']) !!}
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
                            <hr>
                            <div id="app">
                                <mgmt-work :id="{{ $id }}"></mgmt-work>
                            </div>
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
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('select2/select2.min.js') }}"></script>
    <script>
            $(document).ready(function() {
                $('.select2').select2({
                width: '100%',
                });
        CKEDITOR.replace('detail_scope');
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
    @if(session()->has('error'))
    <script>
        Swal({
            type: 'error',
            title: "<?php echo session()->get('error'); ?>",
            showConfirmButton: false,
            timer: 6000
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
                                console.log(obj);
                                $('#user_id_to').val(obj.id);
                                return "Username : "+obj.name+" - "+obj.firstname+' '+obj.lastname+' id '+obj.id;

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