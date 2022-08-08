@extends('layouts.nevber-admin')
@section('head')
    @include('sweetalert::alert')
    <link href="{{ asset('assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet"/>
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('assets/plugins/DataTables/css/data-table.css') }}" rel="stylesheet"/>
    <!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')

    <div id="app">
        <div id="content" class="content">
            @if($view == 1)
                    <ol class="breadcrumb pull-right">
                        <li class="active">Air Product</li>
                    </ol>
                    <!-- begin page-header -->
                    <h1 class="page-header">
                        <i class="fa fa-shopping-cart"></i> Standard Price List
                    </h1>
                    <!-- end page-header -->
                    <div class="row">
                        <air-product-component
                                :brands="{{ json_encode($brands) }}"
                                :group="{{ json_encode($airGroup) }}"
                                :btu="{{ json_encode($airBTU) }}"
                        ></air-product-component>
                    </div>
                    <!-- end row -->
                @elseif($view == 2)
                    <ol class="breadcrumb pull-right">
                        <li class="active">สายไฟ</li>
                    </ol>
                    <!-- begin page-header -->
                    <h1 class="page-header">
                        <i class="fa fa-shopping-cart"></i> Standard Price List
                    </h1>
                    <!-- end page-header -->
                    {{--  --}}
                    <div class="row">
                        <wire-component
                                :brands="{{ json_encode($brands) }}"
                        ></wire-component>
                    </div>
                @elseif($view == 3)
                    <ol class="breadcrumb pull-right">
                        <li class="active">น้ำยาแอร์</li>
                    </ol>
                    <!-- begin page-header -->
                    <h1 class="page-header">
                        <i class="fa fa-shopping-cart"></i> Standard Price List
                    </h1>
                    <!-- end page-header -->
                    <div class="row">
                        <air-cleaners-component
                                :brands="{{ json_encode($brands) }}"
                        ></air-cleaners-component>
                    </div>
                @elseif($view == 4)
                    <ol class="breadcrumb pull-right">
                        <li class="active">ท่อร้อย สายไฟ</li>
                    </ol>
                    <!-- begin page-header -->
                    <h1 class="page-header">
                        <i class="fa fa-shopping-cart"></i> Standard Price List
                    </h1>
                    <!-- end page-header -->
                    <div class="row">
                        <pipe-wire-component
                                :brands="{{ json_encode($brands) }}"
                        ></pipe-wire-component>
                    </div>
                @elseif($view == 5)
                    <ol class="breadcrumb pull-right">
                        <li class="active">PVC</li>
                    </ol>
                    <!-- begin page-header -->
                    <h1 class="page-header">
                        <i class="fa fa-shopping-cart"></i> Standard Price List
                    </h1>
                    <!-- end page-header -->
                    <div class="row">
                        {{--<red-dong-pipes-component--}}
                                {{--:brands="{{ json_encode($brands) }}"--}}
                        {{--></red-dong-pipes-component>--}}
                        <pvc-component
                                :brands="{{ json_encode($brands) }}"
                        ></pvc-component>
                    </div>
                @elseif($view == 6)
                    <ol class="breadcrumb pull-right">
                        <li class="active">ฉนวนใยแก้ว</li>
                    </ol>
                    <!-- begin page-header -->
                    <h1 class="page-header">
                        <i class="fa fa-shopping-cart"></i> Standard Price List
                    </h1>
                    <!-- end page-header -->
                    <div class="row">
                        <fiberglass-insulation-component
                                :brands="{{ json_encode($brands) }}"
                        ></fiberglass-insulation-component>
                    </div>
                @elseif($view == 7)
                    <ol class="breadcrumb pull-right">
                        <li class="active">ฉนวนยางดำ</li>
                    </ol>
                    <!-- begin page-header -->
                    <h1 class="page-header">
                        <i class="fa fa-shopping-cart"></i> Standard Price List
                    </h1>
                    <!-- end page-header -->
                    <div class="row">
                        <black-rubber-insulation-component
                                :brands="{{ json_encode($brands) }}"
                        ></black-rubber-insulation-component>
                    </div>
                @elseif($view == 8)
                    <ol class="breadcrumb pull-right">
                        <li class="active">PVC ท่อน้ำ</li>
                    </ol>
                    <!-- begin page-header -->
                    <h1 class="page-header">
                        <i class="fa fa-shopping-cart"></i> Standard Price List
                    </h1>
                    <!-- end page-header -->
                    <div class="row">
                        <pvc-water-pipe-component
                                :brands="{{ json_encode($brands) }}"
                        ></pvc-water-pipe-component>
                    </div>
                @elseif($view == 9)
                    <ol class="breadcrumb pull-right">
                        <li class="active">HDPE งานประปา</li>
                    </ol>
                    <!-- begin page-header -->
                    <h1 class="page-header">
                        <i class="fa fa-shopping-cart"></i> Standard Price List
                    </h1>
                    <!-- end page-header -->
                    <div class="row">
                        <hdpe-waterwork-component
                                :brands="{{ json_encode($brands) }}"
                        ></hdpe-waterwork-component>
                    </div>
                @elseif($view == 10)
                    <ol class="breadcrumb pull-right">
                        <li class="active">HDPE งานไฟฟ้า</li>
                    </ol>
                    <!-- begin page-header -->
                    <h1 class="page-header">
                        <i class="fa fa-shopping-cart"></i> Standard Price List
                    </h1>
                    <!-- end page-header -->
                    <div class="row">
                        <hdpe-electrical-work-component
                                :brands="{{ json_encode($brands) }}"
                        ></hdpe-electrical-work-component>
                    </div>
                @elseif($view == 11)
                    <ol class="breadcrumb pull-right">
                        <li class="active">Copper Tube</li>
                    </ol>
                    <!-- begin page-header -->
                    <h1 class="page-header">
                        <i class="fa fa-shopping-cart"></i> Standard Price List
                    </h1>
                    <!-- end page-header -->
                    <div class="row">
                        <copper-tube-component
                                :brands="{{ json_encode($brands) }}"
                        ></copper-tube-component>
                    </div>
                @elseif($view == 12)
                    <ol class="breadcrumb pull-right">
                        <li class="active">Flexible duct</li>
                    </ol>
                    <!-- begin page-header -->
                    <h1 class="page-header">
                        <i class="fa fa-shopping-cart"></i> Standard Price List
                    </h1>
                    <!-- end page-header -->
                    <div class="row">
                        <aeroduct-component
                                :brands="{{ json_encode($brands) }}"
                        ></aeroduct-component>
                    </div>
                @elseif($view == 13)
                    <ol class="breadcrumb pull-right">
                        <li class="active">รวม Product</li>
                    </ol>
                    <!-- begin page-header -->
                    <h1 class="page-header">
                        <i class="fa fa-shopping-cart"></i> Standard Price List
                    </h1>
                    <!-- end page-header -->
                    <div class="row">
                        <product-all-component
                                :brands="{{ json_encode($brands) }}"
                        ></product-all-component>
                    </div>
            @endif
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
@section('script')
    {{--    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>--}}
    {{--<script>--}}
    {{--CKEDITOR.replace('editor');--}}
    {{--var editor  = CKEDITOR.replace('editor2');--}}
    {{--editor.on( 'change', function( evt ) {--}}
    {{--// getData() returns CKEditor's HTML content.--}}
    {{--console.log( 'Total bytes: ' + evt.editor.getData().length );--}}
    {{--});--}}
    {{--// CKEDITOR.instances.editor2.getData();--}}
    {{--</script>--}}
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

        $(document).ready(function () {
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