@extends('layouts.nevber-admin')
@section('head')
    @include('sweetalert::alert')
    <link href="{{ asset('assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet"
          xmlns:v-on="http://www.w3.org/1999/xhtml"/>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

@endsection
@section('content')
    <div id="app">
        <div id="content" class="content">
            <!-- begin breadcrumb -->
            <ol class="breadcrumb pull-right">
                <li class="active">Brand Product</li>
            </ol>
            <!-- end breadcrumb -->
            <!-- begin page-header -->
            <h1 class="page-header"><i class="fa fa-shopping-cart"></i> Brand Product</h1>
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
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <br>
                @endif
                <!-- begin panel -->
                    <div class="panel panel-warning" data-sortable-id="table-basic-7">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            </div>
                            <h4 class="panel-title">Brand Product</h4>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>รูปภาพ 100x50 pixels</th>
                                        <th>ชื่อ  Brands Product</th>
                                        <th>วันที่โพส</th>
                                        <th>วันที่อัพเดท</th>
                                        <th>โพสโดย</th>
                                        <th>การจัดการ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($brands as $key => $data)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>
                                                @if($data->filename != null)
                                                    <img src="{{ asset('images/brand/'.$data->filename) }}" style="width: 100px;height: 50px">
                                                @else
                                                    <img src="{{ asset('images/brand/100x50.png') }}">
                                                @endif
                                            </td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ date('d/m/Y', strtotime($data->created_at)) }}</td>
                                            <td>@if($data->updated_at != "")
                                                    {{ date('d/m/Y', strtotime($data->updated_at)) }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $data->actby }}</td>
                                            <td>
                                                {{--<modal-edit-brand id="{{ $data->id }}" v-on:click="myFunction({{ $data->id }})"></modal-edit-brand>--}}
                                                {{--<a v-on:click="sentID({{ $data->id }})" class="btn btn-success w-100" >แก้ไขข้อมูล</a>--}}
                                                <button v-on:click="sentID({{ $data->id }})" type="button" class="btn btn-sm btn-success" title="แก้ไขข้อมูล"><i class="fa fa-edit blue"></i></button>

                                                {{--<button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#modalEdit">แก้ไขข้อมูล</button>--}}

                                                {!! Form::open(['url' => ['admin/brands/'. $data->id],'method' => 'delete' , 'style' => 'margin-top: -31px' ]) !!}
                                                {!! csrf_field() !!}
                                                <button type="submit" class="btn btn-sm btn-danger" style="margin-left: 40px;" title="ลบข้อมูล"><i class="glyphicon glyphicon-trash"></i></button>
                                                {!! Form::close() !!}
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
                        <h4 class="modal-title"><i class="fa fa-plus"></i>  เพิ่มข้อมูล : Brand Product</h4>
                    </div>
                    {!! Form::open(['url' => '/admin/brands' , 'files'=>true,'class'=>'form-horizontal','data-parsley-validate'=>'true']) !!}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            {!! Form::label('name', 'ชื่อ Brand Product&nbsp; * &nbsp;:',['class' => 'control-label col-md-4 col-sm-4'])!!}
                            <div class="col-md-6 col-sm-6">
                                {!!  Form::text('name',null,['class' => 'form-control' ,'placeholder' => 'กรุณาใส่ชื่อ Brand Product' , 'data-parsley-required' => 'true']) !!}
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                {!! Form::label('image', 'รูปภาพ *',['class' => 'control-label col-md-4 col-sm-4'])!!}
                                <div class="col-md-6 col-sm-6">
                                    {!!  Form::file('image',['class' => 'form-control' , 'data-parsley-required' => 'true' ]) !!}
                                    <p>* ขนาด size รูป ( 100 × 50 pixels ) </p>
                                </div>
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

        <div class="modal fade" id="modalEdit">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title"><i class="fa fa-plus"></i>  แก้ไขข้อมูล : Brand Product</h4>
                    </div>
                    <form @submit="formSubmit" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" id="id" name="id" v-model="id"/>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4">ชื่อ Brand Product</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" class="form-control" data-parsley-required="true" v-model="name"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4">รูปภาพ</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="file" class="form-control" v-on:change="onImageChange">
                                    <p>* ขนาด size รูป ( 100 × 50 pixels ) </p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                            <button class="btn btn-sm btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}" ></script>
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
