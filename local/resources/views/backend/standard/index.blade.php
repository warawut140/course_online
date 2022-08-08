@extends('layouts.nevber-admin')
@section('head')
    @include('sweetalert::alert')
    <link href="{{ asset('assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />

    <style>
        .tableFixHead    { overflow-y: auto; height: 500px; }
        .tableFixHead th { position: sticky; top: 0; }

        /* Just common table stuff. Really. */
        table  {
            border-collapse: collapse;
            width: 100%;  }
        th, td {
            padding: 8px 16px;
        }
        th  {
            background:#eee;
            text-align:center;
            vertical-align:middle;
        }
        td, th {
            border: 1px solid Black;
            padding: 5px 15px;
        }
        .nav-pills > li.active > a, .nav-pills > li.active > a:focus, .nav-pills > li.active > a:hover {
            background: #d58512;
        }
        thead > tr:nth-child(1) > th:nth-child(1) {
            /*background-color: Orchid; */
        }
        thead > tr:nth-child(1) > th:nth-child(2) {
            /*background-color: YellowGreen;*/
        }
        thead > tr:nth-child(1) > th:nth-child(3) {
            /*background-color: Orange;*/
        }
        thead > tr:nth-child(2) > th              {
            /*background-color: Gold;*/
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

@endsection
@section('content')
    <div id="app">
        <div id="content" class="content">
            <!-- begin breadcrumb -->
            <ol class="breadcrumb pull-right">
                <li class="active">Data Standard</li>
            </ol>
            <!-- end breadcrumb -->
            <!-- begin page-header -->
{{--            <h1 class="page-header"><i class="fa fa fa-gavel"></i> Data Standard</h1>--}}
            <!-- end page-header -->

            <!-- begin row -->
            <div class="row">
                <!-- begin col-12 -->
                    <data-standard-component
                        :typeauctions="{{ json_encode($typeProjectAuctions) }}"
                        :brands="{{ json_encode($brands) }}"
                    ></data-standard-component>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
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
@endsection
