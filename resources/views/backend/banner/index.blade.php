
@extends('layouts.nevber-admin')
@section('head')
    @include('sweetalert::alert')
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('assets/plugins/isotope/isotope.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/lightbox/css/lightbox.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/powerange/powerange.min.css') }}" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="active">รูปปก Silde Banner</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header"><i class="fa fa-picture-o"></i> รูปปก Silde Banner</h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="row">
                    <!-- begin col-12 -->
                    <div class="col-md-12">
                    @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="btn-group-vertical">
                            <a href="#modal-dialog" class="btn btn-sm btn-success" data-toggle="modal"><i class="fa fa-plus"></i> เพิ่มข้อมูล</a>
                        </div>
                        @if($galleries != null)
                            <div id="gallery" class="gallery">
                                @foreach($galleries as $data)
                                    <div class="image gallery-group-1">
                                        <div class="image-inner">
                                            <a href="{{ asset('images/banner/'.$data->filename) }}" data-lightbox="gallery-group-1">
                                                <img src="{{ asset('images/banner/'.$data->filename) }}" alt="" />
                                            </a>
                                            <p class="image-caption">
                                                #slide banner
                                            </p>
                                        </div>
                                        <div class="image-info">
                                            <div class="pull-right">
                                                <small>by</small> <a href="javascript:;">{{ $data->actby }}</a>
                                            </div>
                                            <br>
                                            <br>
                                            <p>
                                                {!! Form::open(['url' => ['admin/slide-banner/'. $data->id],'method' => 'delete']) !!}
                                                {!! csrf_field() !!}
                                                <button type="submit" class="btn btn-danger btn-block"><i class="glyphicon glyphicon-trash"></i> ลบข้อมูล</button>
                                                {!! Form::close() !!}
                                                @if($data->isActive != 1)
                                                    {!! Form::open(['url' => ['admin/slide-banner/update/'. $data->id],'method' => 'put']) !!}
                                                    {!! csrf_field() !!}
                                                    <br>
                                                    <input type="hidden" id="id" name="id" value="{{ $data->id }}">
                                                    <button type="submit" class="btn btn-warning btn-block" title="โชว์ข้อมูล"><i
                                                                class="fa fa-star"></i> โชว์ข้อมูล
                                                    </button>
                                                    {!! Form::close() !!}
                                                @else
                                                    {!! Form::open(['url' => ['admin/slide-banner/update/hide/'. $data->id],'method' => 'put']) !!}
                                                    {!! csrf_field() !!}
                                                    <br>
                                                    <input type="hidden" id="id" name="id" value="{{ $data->id }}">
                                                    <button type="submit" class="btn btn-white  ng btn-block" title="โชว์ข้อมูล"><i
                                                                class="fa fa-star"></i> ซ่อนข้อมูล
                                                    </button>
                                                    {!! Form::close() !!}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {!! $galleries->render()!!}
                        @endif
                    </div>
                    <!-- end col-12 -->
                </div>
                <!-- end panel -->
            </div>
        </div>
        <!-- end row -->
    </div>

    <!-- Add #modal-dialog -->
    <div class="modal fade" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i>  เพิ่มข้อมูล : Brand Product</h4>
                </div>
                {!! Form::open(['url' => '/admin/slide-banner' , 'files'=>true,'class'=>'form-horizontal','data-parsley-validate'=>'true' ]) !!}
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::label('image', 'รูปภาพ *',['class' => 'control-label col-md-4 col-sm-4'])!!}
                        <div class="col-md-6 col-sm-6">
                            {!!  Form::file('image',['class' => 'form-control' , 'data-parsley-required' => 'true' ]) !!}
                            <p>* ขนาด size รูป ( 1600 × 495 pixels ) </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                    {{--<a href="javascript:;" class="btn btn-sm btn-success">Action</a>--}}
                    <?=  Form::submit('Save', ['class' => 'btn btn-sm btn-success']);?>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/plugins/isotope/jquery.isotope.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/lightbox/js/lightbox-2.6.min.js') }}"></script>
    <script src="{{ asset('assets/js/gallery.demo.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/powerange/powerange.min.js') }}"></script>
    <script src="{{ asset('assets/js/form-slider-switcher.demo.min.js') }}"></script>


    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{ asset('assets/plugins/gritter/js/jquery.gritter.js') }}"></script>
    <script src="{{ asset('assets/js/ui-modal-notification.demo.min.js') }}"></script>
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->


    <script>
        $(document).ready(function() {
            App.init();
            Gallery.init();
            FormSliderSwitcher.init();
            Notification.init();
            // TableManageFixedColumns.init();
        });
    </script>
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


@endsection