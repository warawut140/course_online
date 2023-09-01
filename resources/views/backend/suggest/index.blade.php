@extends('layouts.nevber-admin')
@section('head')
    @include('sweetalert::alert')
    <link href="{{ asset('assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('assets/plugins/fullcalendar/fullcalendar/fullcalendar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/DataTables/css/data-table.css') }}" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="active">ปรึกษาและแนะนำ</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header"><i class="fa fa-newspaper-o"></i> ปรึกษาและแนะนำ</h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
            {{--<div class="btn-group-vertical">--}}
            {{--<a href="#modal-dialog" class="btn btn-sm btn-success" data-toggle="modal"><i class="fa fa-plus"></i> เพิ่มข้อมูล</a>--}}
            {{--</div>--}}
            {{--<br>--}}
            {{--<br>--}}
            <!-- begin panel -->
                <div class="panel panel-warning" data-sortable-id="table-basic-7">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        </div>
                        <h4 class="panel-title">ปรึกษาและแนะนำ</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ชื่องาน</th>
                                        <th>ประเภท</th>
                                        <th>วันที่โพส</th>
                                        <th>อัพเดทล่าสุด</th>
                                        <th>สร้างโดย</th>
                                        <th>การจัดการ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($suggests as $key => $data)
                                        <tr class="gradeA">
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $data->title }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ date('d/m/Y', strtotime($data->created_at)) }}</td>
                                            <td>@if($data->updated_at == "")-
                                            @else
                                            {{ date('d/m/Y', strtotime($data->updated_at)) }}
                                            @endif
                                            </td>
                                            <td>{{ $data->firstname }} {{ $data->lastname }}</td>
                                            <td>
                                                <p>
                                                    <a href="{{ url('admin/suggest/'.$data->id.'/') }}" class="btn btn-default btn-icon btn-circle" title="ดูข้อมูล"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-12 -->
        </div>
        <!-- end row -->
    </div>


@endsection
@section('script')
    <script src="{{ asset('assets/js/ui-modal-notification.demo.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/parsley/dist/parsley.js') }}"></script>
    <script src="{{ asset('assets/plugins/DataTables/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/DataTables/js/dataTables.fixedColumns.js') }}"></script>
    <script src="{{ asset('assets/js/table-manage-fixed-columns.demo.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            App.init();
            Notification.init();
            TableManageFixedColumns.init();
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