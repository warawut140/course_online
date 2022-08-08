@extends('layouts.navber')
@section('head')
    @include('sweetalert::alert')
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script src="{{ asset('js/modernizr.js') }}"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

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
                <erp-preorder :auth_id="{{ $auth_id }}" :provinces="{{ json_encode($provinces) }}"
                ></erp-preorder>
            </div>
        </div>
    </div>
    {{--<script src="/js/app.js" charset="utf-8"></script>--}}
    <script src="{{ asset('js/app.js') }}" ></script>

@endsection
@section('script')

    <style>
        .typeScope {
            display:none;
        }
    </style>
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
         function popup(id) {
             if(id == 1){
                 alert("ไว้ก่อน");
             }else{
                 alert("รับโปร");
             }
         }
         function changeAddress(id_address, type_address) {
             $.ajax({
                 url: '{{ url("/api/address") }}',
                 type: "GET",
                 data: {id: id_address, type: type_address ,_token: '{{ csrf_field() }}'},
                 success: function (data) {
                     $('#' + type_address + '').html(data);
                 }
             });
         }
         function pageRequired(page) {
             if (page == 1){
                 $('#product_brand').val('');
             }
         }
         function showDiv(id) {
             if (id == 1 || id == 2 || id == 3 ){
                 $('.typeScope').show();
             }else{
                 $('.typeScope').hide();
             }
         }
    </script>
    <script type="text/javascript">
        $('.btn-stepNext').click(function() {
            $('.nav-pills .active').parent().next('li').find('a').trigger('click');
        });

        $('.btn-stepPrevious').click(function() {
            $('.nav-pills .active').parent().prev('li').find('a').trigger('click');
        });
    </script>
    <script>
        $('.sidenav-item').eq(1).find('a').addClass('active');

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
    <style>
        .card-popup1:hover, .card-popup2:hover, .card-popup3:hover, .card-popup4:hover {
            background-color: #f2a32f;
            color:#fff;
        }
        .card-popup1:hover h4, .card-popup2:hover h4, .card-popup3:hover h4, .card-popup4:hover h4 {
            color:#fff;
        }
        .card-popup1:hover img{
            content: url({{ asset('image/index-auction - Copy.png') }});
        }
        .card-popup2:hover img{
            content: url({{ asset('image/index-findjob - Copy.png')}});
        }
        .card-popup3:hover img{
            content: url({{ asset('image/index-knowledge - Copy.png')}});
        }
        .card-popup4:hover img{
            content: url({{ asset('image/index-store - Copy.png')}});
        }
    </style>
@endsection