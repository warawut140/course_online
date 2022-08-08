@extends('layouts.nevber-admin')
@section('head')
    @include('sweetalert::alert')`
    <style>
        .tableFixHead    { overflow-y: auto; height: 500px; }
        .tableFixHead th {  top: 0; }
        table {
            border-collapse: collapse;
        }
        th{
            text-align:center;
            vertical-align:middle;
        }
        td, th {
            border: 1px solid Black;
            padding: 5px 15px;
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
            background-color: Gold;
        }

    </style>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

@endsection
@section('content')
    <div id="app">
        <div id="content" class="content">
            <!-- begin breadcrumb -->
            <ol class="breadcrumb pull-right">
                <li class="active">%</li>
            </ol>
            <!-- end breadcrumb -->
            <!-- begin page-header -->
            <h1 class="page-header"> <i class="fa fa-gavel"></i> %</h1>
            <!-- end page-header -->

            <!-- begin row -->
            <div class="row">
                <!-- begin col-12 -->
                <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-warning" data-sortable-id="table-basic-7">
                        <div class="panel-heading">
                            <h4 class="panel-title">Brand Product</h4>
                        </div>
                        <div class="panel-body">
                            <tb-percents></tb-percents>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}" ></script>
@endsection
@section('script')

    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
@endsection
