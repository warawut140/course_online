@extends('layouts.nevber-admin')
@section('head')
    @include('sweetalert::alert')
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('assets/plugins/DataTables/css/data-table.css') }}" rel="stylesheet" />

    <!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="active">ตรวจข้อสอบออนไลน์</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header"><i class="fa fa-picture-o"></i> ตรวจข้อสอบออนไลน์</h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="row">
                    <!-- begin col-12 -->
                    <div class="col-md-12">
                        <div class="panel panel-warning" data-sortable-id="table-basic-7">
                            <div class="panel-heading">
                                <h4 class="panel-title">ตรวจข้อสอบออนไลน์</h4>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>ชื่อผุ้สอบ</th>
                                            <th>ประเภทคอร์ด</th>
                                            <th>คอร์ดออนไลน์</th>
                                            <th>วันที่สอบ เวลาเริ่มสอบ</th>
                                            <th>ตรวจข้อสอบ</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($answers as $key => $answer)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $answer->firstname }} {{ $answer->lastname }}</td>
                                                <td>{{ $answer->course_name }}</td>
                                                <td>{{ $answer->name }}</td>
                                                <td>{{ date('d/m/Y H:i:s', strtotime($answer->answer_start_date)) }} ถึง {{ date('d/m/Y H:i:s', strtotime($answer->answer_end_date)) }}</td>
                                                <td>
                                                    <a  href="{{ url('admin/answers/'.$answer->id) }}" class="btn btn-sm btn-success"
                                                            title="ตรวจข้อสอบ"><i class="fa fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col-12 -->
                </div>
                <!-- end panel -->
            </div>
        </div>
        <!-- end row -->
    </div>

    <script src="{{ asset('js/app.js') }}" ></script>
@endsection
@section('script')
    <script src="{{ asset('assets/js/ui-modal-notification.demo.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/parsley/dist/parsley.js') }}"></script>
    <script src="{{ asset('assets/plugins/DataTables/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/DataTables/js/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('assets/js/table-manage-responsive.demo.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            App.init();
            Notification.init();
            TableManageResponsive.init();
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
