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
            <li class="active">อบรมและสาระ</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header"><i class="fa fa-picture-o"></i> อบรมและสาระ</h1>
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
                                <h4 class="panel-title">อบรมและสาระ</h4>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                        <thead>
                                        <tr>
                                            <th>วันที่โพส</th>
                                            <th>รูปภาพ</th>
                                            <th>หัวข้อเรื่อง</th>
                                            <th>ยอด View / Comment</th>
                                            <th>โพสโดย</th>
                                            <th>ดูรายละเอียด</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($training as $value)
                                            <tr>
                                                <td>
                                                    <?php
                                                    list($year, $month, $day) = explode('-', date('Y-m-d', strtotime($value->created_at)));
                                                    if ($day < 10) {
                                                        $day = substr($day, 1, 1);
                                                    }

                                                    $thMonth = array("ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.",
                                                        "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
                                                    if ($month < 10) {
                                                        $month = substr($month, 1, 1);
                                                    }
                                                    $year += 543;
                                                    echo $day."/&nbsp;".$thMonth[$month - 1]."/&nbsp;".$year;
                                                    ?>
                                                </td>
                                                <td>
                                                    <img src="{{ asset('/images/training/image/'.$value->image_training) }}" style="width: 40%" class="mw-100 w-100">
                                                </td>
                                                <td>
                                                    {{ $value->title }}
                                                </td>
                                                <td>
                                                    <i class="fa  fa-eye"></i> {{ $value->total }}
                                                    <i class="fa  fa-comment"></i> {{ $value->commentTotal }}
                                                </td>
                                                <td>
                                                    {{ $value->firstname }} {{ $value->lastname }}
                                                </td>
                                                <td>
                                                    <a href="{{ url('training/'.$value->id) }}" target="_blank" title="ดูข้อมูล" class="btn btn-info  btn-icon btn-circle btn-sm">
                                                        <i class="fa fa-laptop"></i>
                                                    </a>
                                                
                                                    <a href="{{ url('admin/training_edit/'.$value->id) }}" title="แก้ไขข้อมูล" class="btn btn-warning  btn-icon btn-circle btn-sm">
                                                        <i class="fa fa-gear"></i>
                                                    </a>

                                                    <a href="{{ url('admin/training_delete/'.$value->id) }}" title="ลบ" class="btn btn-danger  btn-icon btn-circle btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    {{-- <a href="{{ url('admin/training_comment/'.$value->id) }}" title="คอมเม้น" class="btn btn-warning  btn-icon btn-circle btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                    </a> --}}
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



    {{--<script src="/js/app.js" charset="utf-8"></script>--}}
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


@endsection