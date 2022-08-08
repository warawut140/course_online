@extends('layouts.navber')
@section('head')
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script src="{{ asset('js/modernizr.js') }}"></script>
    @include('sweetalert::alert')
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
                @if($page == 1)
                    <erp-price-setup
                            :auth_id="{{ $auth_id }}"
                            :btu="{{ json_encode($airBTU) }}"
                    ></erp-price-setup>
                @elseif($page == 2)
                    <erp-list-order :auth_id="{{ $auth_id }}"></erp-list-order>
                @endif
            </div>
        </div>
    </div>
    {{--<script src="/js/app.js" charset="utf-8"></script>--}}
    <script src="{{ asset('js/app.js') }}" ></script>
@endsection
@section('script')
    <script>
        $('#pageSubmenu').addClass('show');
        $('.sidenav-item').eq(4).find('a').addClass('active');
    </script>
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
        function dropdownBrand(id) {
            $('.typeScope').hide();

            if (id == 0) {
                // $('#product_brand').val('');
                // $('#product_series').val('');
                // $('#product_btu').val('');
                $("#product_brand").attr('required', '');
                $("#product_series").attr('required', '');
                $("#product_btu").attr('required', '');
                $("#product_air_id").removeAttr('required');
                $("#product_series1").removeAttr('required');
                $("#product_btu1").removeAttr('required');
                $('#content-product1').show();
                $('#content-product2').hide();
            }else{
                // $('#series').val('');
                $("#product_brand").removeAttr('required');
                $("#product_series").removeAttr('required');
                $("#product_btu").removeAttr('required');
                $("#product_air_id").attr('required', '');
                $('#content-product2').show();
                $.ajax({
                    url: '{{ url("/api/getBrandSeries") }}',
                    type: "GET",
                    data: {id: id, _token: '{{ csrf_field() }}'},
                    success: function (data) {
                        $('#product_air_id').html(data);
                    }
                });
            }
            if(id == ""){
                $('#content-product2').hide();
            }
        }
        function dropdownSeries(id) {
            if (id == 0) {
                $('#product_price1').val('');
                $("#product_series1").attr('required', '');
                $("#product_btu1").attr('required', '');
                $('#content-product3').show();
                $("#product_price1").removeAttr('required', '');
            }else {
                $('#context-price').show();
                $.ajax({
                    url: '{{ url("/api/getPriceAir") }}',
                    type: "GET",
                    data: {id: id, _token: '{{ csrf_field() }}'},
                    success: function (data) {
                        $('#product_price1').val(data);
                        $("#product_price1").attr('required', '');
                    }
                });

                $("#product_series1").removeAttr('required');
                $("#product_btu1").removeAttr('required');
                $('#product_series1').val('');
                $('#product_btu1').val('');
                $('#content-product3').hide();
            }
        }
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