@extends('layouts.nevber-admin')
@section('head')
    @include('sweetalert::alert')
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('assets/plugins/isotope/isotope.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/lightbox/css/lightbox.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/powerange/powerange.min.css') }}" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="active">โปรโมชั่น</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header"><i class="fa fa-gift"></i> โปรโมชั่น</h1>
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
                            <br>
                            <br>
                            <!-- begin panel -->
                            <div class="panel panel-warning" data-sortable-id="table-basic-7">
                                <div class="panel-heading">
                                    <div class="panel-heading-btn">
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                    </div>
                                    <h4 class="panel-title">โปรโมชั่น</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>โปรโมชั่น</th>
                                                    <th>ประจำเดือน / ปี</th>
                                                    <th>วันที่โพส</th>
                                                    <th>วันที่อัพเดท</th>
                                                    <th>โพสโดย</th>
                                                    <th>การจัดการ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               @foreach($promotion as $key => $data)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td style="width: 40%">{{ $data->title }}</td>
                                                    <td>
                                                        @if($data->month == 1)January
                                                        @elseif($data->month == 2)February
                                                        @elseif($data->month == 3)March
                                                        @elseif($data->month == 4)April
                                                        @elseif($data->month == 5)May
                                                        @elseif($data->month == 6)June
                                                        @elseif($data->month == 7)July
                                                        @elseif($data->month == 8)August
                                                        @elseif($data->month == 9)September
                                                        @elseif($data->month == 10)October
                                                        @elseif($data->month == 11)November
                                                        @elseif($data->month == 12)December
                                                        @endif / {{ $data->year }}
                                                    </td>
                                                    <td>{{ date('d/m/Y', strtotime($data->created_at)) }}</td>
                                                    <td>
                                                        @if($data->updated_at == "")
                                                            -
                                                        @else
                                                            {{ date('d/m/Y', strtotime($data->updated_at)) }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $data->name }}</td>
                                                    <td>
                                                        {{--<a href="{{ url('admin/suggest/'.$data->id.'/') }}" class="btn btn-default btn-icon btn-circle" title="ดูข้อมูล"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;--}}
                                                        <a href="#modal-dialog" class="btn btn-default  btn-icon btn-circle btn-sm" data-toggle="modal" title="ดูข้อมูล"><i class="fa fa-eye"></i></a>
                                                        <a href="#modal-dialog" class="btn btn-primary  btn-icon btn-circle btn-sm" data-toggle="modal" title="แก้ไขข้อมูล"><i class="fa fa-edit"></i></a>
                                                        <a href="{{url('admin/promotion/delete/'.$data->id)}}" class="btn btn-danger btn-icon btn-circle btn-sm" title="ลบข้อมูล"><i class="fa fa-times"></i></a>
                                                    </td>
                                                </tr>
                                               @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- end panel -->
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
                    <h4 class="modal-title"><i class="fa fa-plus"></i>  เพิ่มข้อมูล : โปรโมชั่น</h4>
                </div>
                {!! Form::open(['url' => '/admin/promotion' , 'files'=>true,'class'=>'form-horizontal','data-parsley-validate'=>'true' ]) !!}
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::label('title', 'ชื่อโปรโมชั่น *',['class' => 'control-label col-md-4 col-sm-4'])!!}
                        <div class="col-md-8 col-sm-8">
                            {!!  Form::text('title',null,['class' => 'form-control' ,'placeholder' => 'กรุณาใส่ชื่อ โปรโมชั่น' , 'data-parsley-required' => 'true']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('details', 'รายละเอียด *',['class' => 'control-label col-md-4 col-sm-4'])!!}
                        <div class="col-md-8 col-sm-8">
                            {{--<textarea name="editor1" id="editor1" rows="10"></textarea>--}}
                            {!!  Form::textarea('details',null,['id' => 'editor1','rows'=>10 ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('month', 'โปรโมชั่น ประจำเดือน *',['class' => 'control-label col-md-4 col-sm-4'])!!}
                        <div class="col-md-8 col-sm-8">
                            <select name="month" id="month" class="form-control" data-parsley-required="true">
                                <option selected="selected" value="">เลือกเดือน</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('year', 'ปี *',['class' => 'control-label col-md-4 col-sm-4'])!!}
                        <div class="col-md-8 col-sm-8">
                            {!!  Form::text('year',null,['class' => 'form-control' ,'placeholder' => 'กรุณาใส่ชื่อ ปี' , 'data-parsley-required' => 'true']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('startdate', 'วันเริ่มต้น &nbsp; * &nbsp;:',['class' => 'control-label col-md-4 col-sm-4'])!!}
                        <div class="col-md-8 col-sm-8">
                            {!!  Form::date('startdate', null ,['class' => 'form-control', 'data-parsley-required' => 'true' ]); !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('enddate', 'วันสิ้นสุด &nbsp; * &nbsp;:',['class' => 'control-label col-md-4 col-sm-4'])!!}
                        <div class="col-md-8 col-sm-8">
                            {!!  Form::date('enddate', null ,['class' => 'form-control', 'data-parsley-required' => 'true' ]); !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('image', 'รูปภาพ โปรโมชั่น *',['class' => 'control-label col-md-4 col-sm-4'])!!}
                        <div class="col-md-8 col-sm-8">
                            {!!  Form::file('image',['class' => 'form-control' , 'data-parsley-required' => 'true' ]) !!}
                            {{--<p>* ขนาด size รูป ( 1600 × 495 pixels ) </p>--}}
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
    <script src="{{ asset('assets/plugins/parsley/dist/parsley.js') }}"></script>


    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
{{--    <script src="{{ asset('templateEditor/ckeditor/ckeditor.js') }}"></script>--}}

    <script>
        CKEDITOR.replace('editor1');
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
    @if(session()->has('alert'))
        <script>
            Swal({
                type: 'error',
                title: "<?php echo session()->get('alert'); ?>",
                text: "กรุณาลองใหม่อีกครั้ง",
            })
        </script>
    @endif

@endsection