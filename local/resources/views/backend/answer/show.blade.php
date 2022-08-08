@extends('layouts.nevber-admin')
@section('head')
    @include('sweetalert::alert')
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('assets/plugins/DataTables/css/data-table.css') }}" rel="stylesheet"/>

    <!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="{{ url('/admin/answers') }}">ตรวจข้อสอบออนไลน์</a></li>
            <li class="active">ดูข้อมูล</li>
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
                        <div class="col-md-12 ui-sortable">
                            <!-- begin panel -->
                            <div class="panel panel-warning" data-sortable-id="form-validation-1">
                                <div class="panel-heading">
                                    <h4 class="panel-title">ตรวจข้อสอบออนไลน์</h4>
                                </div>
                                <div class="panel-body panel-form">
                                    {{--<form class="form-horizontal form-bordered" action="">--}}
                                    {!! Form::open(['url' => '/admin/answers' , 'class'=>'form-horizontal form-bordered']) !!}
                                    <input type="hidden" name="idcheck" id="idcheck" value="{{ $idcheck }}">
                                    @foreach($answers as $answer)
                                        @if($answer->option_type_id == 1)
                                            {{-- TEXT --}}
                                            @if($answer->pass === null)
                                                <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-4">{{ $answer->q_name }}</label>
                                                    <div class="col-md-6 col-sm-6">
                                                        <p>{!! $answer->option_text !!}</p>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="option_text[{{ $answer->id }}]" value="0" required> ผ่าน
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="option_text[{{ $answer->id }}]" value="1"> ไม่ผ่าน
                                                        </label>
                                                    </div>
                                                </div>
                                            @elseif($answer->pass == 0)
                                                <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-4">{{ $answer->q_name }}</label>
                                                    <div class="col-md-4 col-sm-4">
                                                        <p>{!! $answer->option_text !!}</p>
                                                    </div>
                                                    <div class="col-md-2 col-sm-2">
                                                        <label class="label label-success">ตอบถูก</label>
                                                    </div>
                                                </div>
                                            @elseif($answer->pass == 1)
                                                <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-4">{{ $answer->q_name }}</label>
                                                    <div class="col-md-4 col-sm-4">
                                                        <p>{!! $answer->option_text !!}</p>
                                                    </div>
                                                    <div class="col-md-2 col-sm-2">
                                                        <label class="label label-danger">ตอบผิด</label>
                                                    </div>
                                                </div>
                                            @endif
                                        @elseif($answer->option_type_id == 2)
                                            {{-- Radio --}}
                                            @if($answer->pass == 0)
                                                <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-4">{{ $answer->q_name }}</label>
                                                    <div class="col-md-4 col-sm-4">
                                                        {{ $answer->option_name }}
                                                    </div>
                                                    <div class="col-md-2 col-sm-2">
                                                        <label class="label label-success">ตอบถูก</label>
                                                    </div>
                                                </div>
                                            @elseif($answer->pass == 1)
                                                <div class="form-group">
                                                    <label class="control-label col-md-4 col-sm-4">{{ $answer->q_name }}</label>
                                                    <div class="col-md-4 col-sm-4">
                                                        {{ $answer->option_name }}
                                                    </div>
                                                    <div class="col-md-2 col-sm-2">
                                                        <label class="label label-danger">ตอบผิด</label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4"></label>
                                        <div class="col-md-6 col-sm-6">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="{{ url('admin/answers') }}" class="btn btn-warning">กลับ >></a>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                    {{--</form>--}}
                                </div>
                            </div>
                            <!-- end panel -->
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
