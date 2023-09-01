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
            <li class="active">ข้อมูลสมาชิก</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header"><i class="fa fa-newspaper-o"></i> ข้อมูลสมาชิก</h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <div class="panel panel-warning" data-sortable-id="table-basic-7">
                    <div class="panel-heading">
                        <h4 class="panel-title">ข้อมูลสมาชิก</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ชื่อผู้ใช้</th>
                                        <th>Email</th>
                                        <th>ชื่อ - นามสกุล</th>
                                        <th>การจัดการ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($member as $key => $data)
                                        <tr class="gradeA">
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->firstname }} - {{ $data->lastname }}</td>
                                            <td>
                                                <p>
                                                    <a href="{{ url('#') }}" class="btn btn-default btn-icon btn-circle" title="ดูข้อมูล"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
                                                    <a href="{{ url('#') }}" class="btn btn-danger btn-icon btn-circle" title="แบนผู้ใช้"><i class="fa fa-minus-circle"></i></a>&nbsp;&nbsp;
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

    <script src="{{ asset('js/app.js') }}" ></script>
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
