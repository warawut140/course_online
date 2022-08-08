@extends('layouts.navber')
@section('head')
    @include('sweetalert::alert')
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script src="{{ asset('js/modernizr.js') }}"></script>

@endsection
@section('content')
    <div id="app">
        <div class="wrapper-erp">
            <!-- Sidebar Holder -->
        @include('layouts.sidebar-erp')
        <!-- Page Content Holder -->
            <div id="content-erp">
                <div class="row">
                    <div class="col-sm-12">
                        <nav class="navbar navbar-default mb-3">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <button type="button" id="sidebarCollapse-erp" class="btn btn-orange navbar-btn">
                                        <i class='fas fa-bars'></i>
                                    </button>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <erp-other :auth_id="{{ $auth_id }}"></erp-other>

            </div>
        </div>
    </div>
    {{--<script src="/js/app.js" charset="utf-8"></script>--}}
    <script src="{{ asset('js/app.js') }}" ></script>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse-erp').on('click', function () {
                $('#sidebar-erp').toggleClass('active');
                myFunction();
            });
            myFunction();
        });
    </script>

    <script>
        $('.sidenav-item').eq(3).find('a').addClass('active');
    </script>
    <script>
        function myFunction(x) {
            if (Modernizr.mq('(max-width: 767px)')) {
                if ($('#sidebar-erp').hasClass('active')){

                    $('#content-erp').css({"width": $(window).width() - 160});
                } else {
                    $('#content-erp').css({"width": "100%"});

                }
            }else {
                if ($('#sidebar-erp').hasClass('active')){
                    $('#content-erp').css({"width": "100%"});
                } else {
                    $('#content-erp').css({"width": $(window).width() - 250});
                }
            }
        }
    </script>
@endsection