@extends('layouts.nevber-admin')
@section('head')
    @include('sweetalert::alert')
    <link href="{{ asset('assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet"/>
    <style>
        .text-oranger {
            color: #f2a22f;
            font-size: 15px;
        }

    </style>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

@endsection
@section('content')
    <div id="app">
        <div id="content" class="content">
            <!-- begin breadcrumb -->
            <ol class="breadcrumb pull-right">
                <li><a href="{{ url('/admin/suggest') }}">ปรึกษาและแนะนำ</a></li>
                <li class="active">ดูข้อมูล</li>
            </ol>
            <!-- end breadcrumb -->
            <!-- begin page-header -->
            <h1 class="page-header"><i class="fa fa-bullhorn"></i> ปรึกษาและแนะนำ</h1>
            <!-- end page-header -->

            <!-- begin row -->
            <div class="row">
                <!-- begin col-12 -->
                <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-warning" data-sortable-id="table-basic-7">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                                   data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                                   data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            </div>
                            <h4 class="panel-title">ดูข้อมูล : ปรึกษาและแนะนำ</h4>
                        </div>
                        <div class="panel-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="card">
                                            <div class="card-body p-2 text-center">

                                                <img class="card-img-top rounded-corner"
                                                     src="{{ asset('images/profile/'.$suggests->image_profile) }}"
                                                     alt="Card image cap"
                                                     style="width:100px;height:100px;object-fit:cover;">
                                                <h5 class="card-title">{{ $suggests->firstname }} {{ $suggests->lastname }}
                                                    <i class="fa fa-check-square"></i></h5>
                                                <div class="row">
                                                    <div class="col-sm-4 text-center"></div>
                                                    <div class="col-sm-4 text-center">
                                                        <img src="{{ asset('image/icon-eye.png') }}">
                                                        <p class="mb-1">เข้าชม</p>
                                                        <h5>{{ (count($suggestsCount) > 0)?$suggestsCount[0]->total:0  }}</h5>
                                                    </div>
                                                    <div class="col-sm-4 text-center"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <h3>{!! $suggests->title !!}</h3>
                                        <hr>
                                        <p class="text-justify">.
                                            {!! $suggests->details !!}
                                        </p>

                                        <!--Gallery-->
                                        @if($suggestsGallery != null)

                                            <hr>
                                            <h4 class="media-heading"><i class="fa fa-file-photo-o"></i> &nbsp;อัมบั้มรูป
                                            </h4>
                                            <br>
                                            <!-- begin superbox -->
                                            <div class="superbox" data-offset="54">
                                                @foreach($suggestsGallery as $data)
                                                    <div class="superbox-list">
                                                        <img src="{{ asset('images/suggest/'.$data->filename) }}"
                                                             data-img="{{ asset('images/suggest/'.$data->filename) }}"
                                                             alt="" class="superbox-img"/>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                        <hr>
                                        <div id="list">
                                            <h4>ความคิดเห็นทั้งหมด <span class="text-muted h6">(10)</span></h4>
                                            <div class="card">
                                                <example-component></example-component>
                                                {{--<ul class="list-group list-group-flush">--}}
                                                {{--<li class="list-group-item">--}}
                                                {{--<div class="media mb-2">--}}
                                                {{--<img src="//placehold.it/50x50?text=Img"--}}
                                                {{--class="img-fluid rounded-corner mr-2"--}}
                                                {{--alt="Responsive image">--}}
                                                {{--<div class="media-body">--}}
                                                {{--<h6 class="mt-0 mb-0 font-weight-light"><b>Username</b>--}}
                                                {{--<span class="text-muted small"> 2 สัปดาห์ที่แล้ว</span>--}}
                                                {{--</h6>--}}
                                                {{--<span class="fa fa-star checked"></span>--}}
                                                {{--<span class="fa fa-star checked"></span>--}}
                                                {{--<span class="fa fa-star checked"></span>--}}
                                                {{--<span class="fa fa-star"></span>--}}
                                                {{--<span class="fa fa-star"></span>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--Lorem ipsum dolor sit amet, vestibulum ac, cras placerat.--}}
                                                {{--</li>--}}
                                                {{--<li class="list-group-item">--}}
                                                {{--<div class="media mb-2">--}}
                                                {{--<img src="//placehold.it/50x50?text=Img"--}}
                                                {{--class="img-fluid rounded-corner mr-2"--}}
                                                {{--alt="Responsive image">--}}
                                                {{--<div class="media-body">--}}
                                                {{--<h6 class="mt-0 mb-0 font-weight-light"><b>Username</b>--}}
                                                {{--<span class="text-muted small"> 2 สัปดาห์ที่แล้ว</span>--}}
                                                {{--</h6>--}}
                                                {{--<span class="fa fa-star checked"></span>--}}
                                                {{--<span class="fa fa-star checked"></span>--}}
                                                {{--<span class="fa fa-star checked"></span>--}}
                                                {{--<span class="fa fa-star"></span>--}}
                                                {{--<span class="fa fa-star"></span>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--Lorem ipsum dolor sit amet, vestibulum ac, cras placerat.--}}
                                                {{--</li>--}}
                                                {{--<li class="list-group-item">--}}
                                                {{--<div class="media mb-2">--}}
                                                {{--<img src="//placehold.it/50x50?text=Img"--}}
                                                {{--class="img-fluid rounded-corner mr-2"--}}
                                                {{--alt="Responsive image">--}}
                                                {{--<div class="media-body">--}}
                                                {{--<h6 class="mt-0 mb-0 font-weight-light"><b>Username</b>--}}
                                                {{--<span class="text-muted small"> 2 สัปดาห์ที่แล้ว</span>--}}
                                                {{--</h6>--}}
                                                {{--<span class="fa fa-star checked"></span>--}}
                                                {{--<span class="fa fa-star checked"></span>--}}
                                                {{--<span class="fa fa-star checked"></span>--}}
                                                {{--<span class="fa fa-star"></span>--}}
                                                {{--<span class="fa fa-star"></span>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--Lorem ipsum dolor sit amet, vestibulum ac, cras placerat.--}}
                                                {{--</li>--}}
                                                {{--<li class="list-group-item">--}}
                                                {{--<div class="media mb-2">--}}
                                                {{--<img src="//placehold.it/50x50?text=Img"--}}
                                                {{--class="img-fluid rounded-corner mr-2"--}}
                                                {{--alt="Responsive image">--}}
                                                {{--<div class="media-body">--}}
                                                {{--<h6 class="mt-0 mb-0 font-weight-light"><b>Username</b>--}}
                                                {{--<span class="text-muted small"> 2 สัปดาห์ที่แล้ว</span>--}}
                                                {{--</h6>--}}
                                                {{--<span class="fa fa-star checked"></span>--}}
                                                {{--<span class="fa fa-star checked"></span>--}}
                                                {{--<span class="fa fa-star checked"></span>--}}
                                                {{--<span class="fa fa-star"></span>--}}
                                                {{--<span class="fa fa-star"></span>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--Lorem ipsum dolor sit amet, vestibulum ac, cras placerat.--}}
                                                {{--</li>--}}
                                                {{--<li class="list-group-item text-center">--}}
                                                {{--<a href="" class="text-oranger h5">อ่านความคิดเห็นเพิ่มเติม</a>--}}
                                                {{--</li>--}}
                                                {{--</ul>--}}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ url('admin/suggest') }}" class="btn btn-warning"><i class="fa fa-arrow-circle-o-left"></i>
                        ย้อนกลับ</a>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
        </div>
    </div>

    <script src="../../../js/app.js" charset="utf-8"></script>

@endsection
@section('script')
    <script src="{{ asset('assets/plugins/superbox/js/superbox.js') }}"></script>
    <script src="{{ asset('assets/js/gallery-v2.demo.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/superbox/js/superbox.js') }}"></script>
    <script src="{{ asset('assets/js/gallery-v2.demo.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            App.init();
            Gallery.init();
        });
    </script>

@endsection