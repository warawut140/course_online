@extends('layouts.nevber-admin')
@section('head')
    @include('sweetalert::alert')
    <link href="{{ asset('assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('assets/plugins/DataTables/css/data-table.css') }}" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')

    <div id="app">
        <div id="content" class="content content-full-width">
            <!-- begin vertical-box -->
            <div class="vertical-box">
                @if($view == 1)
                    <air-component></air-component>
                @else
                    {{--<approve-air-component></approve-air-component>--}}
                    <div>
                        <!-- begin vertical-box-column -->
                        <div class="vertical-box-column width-250">
                            <!-- begin wrapper -->
                            <!-- end wrapper -->
                            <!-- begin wrapper -->
                            <div class="wrapper">
                                <p><b>AIR CONDITION SYSTEM</b></p>
                                <ul class="nav nav-pills nav-stacked nav-sm">
                                    <!--<li><a href="/admin/air-conditioning/"><i class="fa fa-gavel fa-fw m-r-5"></i> โครงการทั้งหมด </a></li>-->
                                    <li class="active"><a href="/admin/approve-air"><i class="fa fa-flag fa-fw m-r-5"></i> ผึ้งงานตามงาน <span class="badge pull-right">3</span></a></li>
                                </ul>
                                <p><b>ขอบเขตงาน</b></p>
                                <ul class="nav nav-pills nav-stacked nav-sm m-b-0">
                                    <li><a href="javascript:;"><i class="fa fa-fw m-r-5 fa-circle text-inverse"></i> VRV/VRF system</a></li>
                                    <li><a href="javascript:;"><i class="fa fa-fw m-r-5 fa-circle text-primary"></i> Sprit type system</a></li>
                                    <li><a href="javascript:;"><i class="fa fa-fw m-r-5 fa-circle text-success"></i> Ventilation system</a></li>
                                    <li><a href="javascript:;"><i class="fa fa-fw m-r-5 fa-circle text-warning"></i> Chiller system</a></li>
                                    <li><a href="javascript:;"><i class="fa fa-fw m-r-5 fa-circle text-danger"></i> 2 ขอบเขตงานขึ้นไป</a></li>
                                </ul>
                                <p><b>ขอบเขตงาน</b></p>
                                <ul class="nav nav-pills nav-stacked nav-sm m-b-0">
                                    <li> <span class="label label-inverse f-s-10">Install machine</span></li>
                                    <li> <span class="label label-primary f-s-10">Piping</span></li>
                                    <li> <span class="label label-success f-s-10">Control</span></li>
                                    <li> <span class="label label-warning f-s-10">Main</span></li>
                                    <li> <span class="label label-danger f-s-10">Duct piping</span></li>

                                </ul>
                            </div>
                            <!-- end wrapper -->
                        </div>
                        <!-- end vertical-box-column -->
                        <!-- begin vertical-box-column -->
                        <div class="vertical-box-column" style="width: 75%">
                            <!-- begin wrapper -->
                            <div class="wrapper bg-silver-lighter">
                                <!-- begin btn-toolbar -->
                                <div class="btn-toolbar">
                                    <!-- begin btn-group -->
                                    <div class="btn-group pull-right">
                                        <button class="btn btn-white btn-sm">
                                            <i class="fa fa-chevron-left"></i>
                                        </button>
                                        <button class="btn btn-white btn-sm">
                                            <i class="fa fa-chevron-right"></i>
                                        </button>
                                    </div>
                                    <!-- end btn-group -->

                                    <!-- end btn-group -->
                                    <!-- begin btn-group -->
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-white hide" data-email-action="archive"><i class="fa fa-check m-r-3"></i> <span class="hidden-xs">Approve</span></button>
                                        <button class="btn btn-sm btn-white hide" data-email-action="delete"><i class="fa fa-times m-r-3"></i> <span class="hidden-xs">No Approve</span></button>
                                    </div>
                                    <!-- end btn-group -->
                                </div>
                                <!-- end btn-toolbar -->
                            </div>
                            <!-- end wrapper -->
                            <!-- begin list-email -->
                            <ul class="list-group list-group-lg no-radius list-email">
                                @foreach($projectFollow as $key => $value)
                                    @if($value->type_pj_work == 1)
                                        <li class="list-group-item inverse">
                                    @elseif($value->type_pj_work == 2)
                                        <li class="list-group-item primary">
                                    @elseif($value->type_pj_work == 3)
                                        <li class="list-group-item success">
                                    @elseif($value->type_pj_work == 4)
                                        <li class="list-group-item warning">
                                    @elseif($value->type_pj_work == 5)
                                        <li class="list-group-item danger">
                                    @endif
                                        <div class="email-checkbox">
                                            <label>
                                                <i class="fa fa-check-square-o"></i>
                                                <!--<input type="checkbox" data-checked="email-checkbox" />-->
                                            </label>
                                        </div>
                                        <a href="#" class="email-user">
                                            <img src="{{ asset('images/profile/'.$value->image_profile) }}" alt="" />
                                        </a>
                                        <div class="email-info">
                                            {{--<span class="email-time">Today</span>--}}
                                            <span class="email-time">{{ (date('d/m/Y H:i:s', strtotime($value->created_at))) }}</span>
                                            <h5 class="email-title">
                                                <a href="{{ url('projectauction/'.$value->id) }}" target="_blank">{{ $value->project_name }}</a>
                                                @if($value->pj_work[0]->install_machine != null)
                                                <span class="label label-inverse f-s-10">Install machine</span>
                                                @endif
                                                @if($value->pj_work[0]->piping != null)
                                                <span class="label label-primary f-s-10">Piping</span>
                                                @endif
                                                @if($value->pj_work[0]->control != null)
                                                <span class="label label-success f-s-10">Control</span>
                                                @endif
                                                @if($value->pj_work[0]->main != null)
                                                <span class="label label-warning f-s-10">Main</span>
                                                @endif
                                                @if($value->pj_work[0]->duct_piping != null)
                                                <span class="label label-danger f-s-10">Duct piping</span>
                                                @endif
                                            </h5>
                                            <p class="email-desc">
                                                @if(strlen($value->details) < 500)
                                                    {!! $value->details !!}
                                                @else
                                                    {!! iconv_substr((trim($value->details)),0,300,"UTF-8").' ...  >> อ่านต่อ' !!}
                                                @endif
                                            </p>
                                            <a href="{{ url('admin/contract/'.$value->id) }}" class="btn btn-white btn-sm" target="_blank"><i class="fa fa-file"></i> สัญญา จ้างงาน</a>
                                            <a href="{{ url('admin/planner/'.$value->id) }}" class="btn btn-white btn-sm" target="_blank"><i class="fa fa-file"></i> ตารางแผนงาน</a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <!-- end list-email -->
                            <!-- begin wrapper -->
                            <div class="wrapper bg-silver-lighter clearfix">
                                <div class="btn-group pull-right">
                                    <button class="btn btn-white btn-sm">
                                        <i class="fa fa-chevron-left"></i>
                                    </button>
                                    <button class="btn btn-white btn-sm">
                                        <i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- end wrapper -->
                        </div>
                        <!-- end vertical-box-column -->
                    </div>
                @endif
            </div>
            <!-- end vertical-box -->
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}" ></script>
@endsection
@section('script')
    <script src="{{ asset('assets/js/ui-modal-notification.demo.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/parsley/dist/parsley.js') }}"></script>

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{ asset('assets/plugins/DataTables/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/DataTables/js/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('assets/js/table-manage-responsive.demo.min.js') }}"></script>

    <script src="{{ asset('assets/js/email-inbox-v2.demo.min.js') }}"></script>
    <script src="{{ asset('assets/js/apps.min.js') }}"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    <script>
        $(document).ready(function() {
            App.init();
            Notification.init();
            InboxV2.init();
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