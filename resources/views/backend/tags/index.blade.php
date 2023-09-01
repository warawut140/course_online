@extends('layouts.nevber-admin')
@section('head')
    @include('sweetalert::alert')
    <link href="{{ asset('assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />

@endsection
@section('content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="active">Brand Product</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header"><i class="fa fa fa-tags"></i> Tag งานของระบบ</h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
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
                        <h4 class="panel-title">Tag งานของระบบ</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>ชื่อ Tag ของระบบงาน</th>
                                    <th>วันที่โพส</th>
                                    <th>วันที่อัพเดท</th>
                                    <th>การจัดการ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tags as $key => $data)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ date('d/m/Y', strtotime($data->created_at)) }}</td>
                                        <td>@if($data->updated_at != "")
                                                {{ date('d/m/Y', strtotime($data->updated_at)) }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#modal-dialog" class="btn btn-sm btn-primary" data-toggle="modal"><i class="fa fa-edit"></i> แก้ไขข้อมูล</a>
                                            <a href="{{url('admin/tags/delete/'.$data->id)}}"  class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i> ลบข้อมูล</a>
{{--                                            {!! Form::open(['url' => ['admin/tags/'. $data->id],'method' => 'delete' , 'style' => 'margin-top: -31px' ]) !!}--}}
                                            {{--{!! csrf_field() !!}--}}
                                            {{--<a href="#modal-dialog" class="btn btn-sm btn-danger" data-toggle="modal"><i class="fa fa-edit"></i> แก้ไขข้อมูล</a>--}}
                                            {{--<button type="submit" class="btn btn-sm btn-danger" style="margin-left: 100px;"><i class="glyphicon glyphicon-trash"></i> ลบข้อมูล</button>--}}
{{--                                            {!! Form::close() !!}--}}
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
        <!-- end row -->
    </div>

    <!-- Add #modal-dialog -->
    <div class="modal fade" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i>  เพิ่มข้อมูล : Tag</h4>
                </div>
                {!! Form::open(['url' => '/admin/tags' , 'files'=>true,'class'=>'form-horizontal','data-parsley-validate'=>'true']) !!}
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::label('name', 'ชื่อ Tag ระบบงาน&nbsp; * &nbsp;:',['class' => 'control-label col-md-4 col-sm-4'])!!}
                        <div class="col-md-6 col-sm-6">
                            {!!  Form::text('name',null,['class' => 'form-control' ,'placeholder' => 'กรุณาใส่ชื่อ Tag ระบบงาน' , 'data-parsley-required' => 'true']) !!}
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
    <script src="{{ asset('assets/js/ui-modal-notification.demo.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/parsley/dist/parsley.js') }}"></script>
    <script>
        $(document).ready(function() {
            App.init();
            Notification.init();
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