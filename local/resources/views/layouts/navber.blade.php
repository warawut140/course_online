<!doctype html>
<html lang="th">
<style>
    .vl {
        border-left: 2px solid gray;
        height: 30px;
    }

    .buttonred {
        background-color: while;
        border: 1px solid red;
        font-size: 0.9em;
        padding: 8px 10px;

        border-radius: 50px;

    }

    .loader {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
        -moz-transform: translate(-50%, -50%);
        -o-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        z-index: 9999;

        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid rgb(190, 33, 33);
        border-bottom: 16px solid rgb(196, 47, 47);
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<head>

    <link rel="icon" href="">
    <title>{{ config('app.title', 'ครอบครัวเพื่อไทย') }}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link type="image/ico" rel="shortcut icon" href="{{ asset('image/faviconx.ico') }}" sizes="32x32">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <!--JS-->

    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <!--FONT-->
    <link href="https://fonts.googleapis.com/css?family=Kanit:300,400,500" rel="stylesheet">

    <!--ICON-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css'
        integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>


    {{-- @include('sweetalert::alert') --}}
    @yield('head')

</head>

<body>

    <div class="loader"></div>



    {{-- begin z#navber --}}
    <nav class="navbar navbar-expand-md navbar-light bg-white">
        <h3 class="my-auto"><a class="navbar-brand" href="{{ url('index') }}">
                <img src="{{ asset('images/logowutco2.png') }}"  class="img-fluid" alt="Responsive image"></a>
        </h3>

        <a class="nav-link py-1" href="{{ url('index') }}">
            <font style="color:black"> คอร์สการเรียนรู้</font>
        </a>

        <a class="nav-link py-1" href="{{ url('worklist') }}">
            <font style="color:black">การรับสมัครงาน</font>
        </a>
        <!-- <a class="nav-link py-1" href="{{ url('work') }}"><font style="color:black">การรับสมัครงาน</font></a> -->

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-md-column" id="navbarCollapse">
            <!-- <ul class="navbar-nav ml-auto small mb-2" style="background-color:#efefef">
                <li class="nav-item {{ Request::segment(1) === 'howtouse' ? 'active' : null }}">
                    <a class="nav-link py-1" href="{{ url('howtouse') }}">คู่มือการใช้งาน</a>
                </li>
                <li class="nav-item {{ Request::segment(1) === 'payment' ? 'active' : null }}">
                    <a class="nav-link py-1" href="{{ url('payment') }}">ช่องทางการชำระเงิน</a>
                </li>
            </ul> -->
            <ul class="navbar-nav ml-auto  mb-2 mb-md-0">
                <!-- <li class="nav-item {{ Request::segment(1) === 'index' ? 'active' : null }}{{ Request::segment(1) === 'search' ? 'active' : null }}" >
                    <a class="nav-link py-1" href="{{ url('index') }}">หน้าแรก</a>
                </li>
                <li class="nav-item {{ Request::segment(1) === 'work' ? 'active' : null }}{{ Request::segment(1) === 'searchWork' ? 'active' : null }}">
                    <a class="nav-link py-1" href="{{ url('work') }}">ประกาศงาน</a>
                </li>
                <li class="nav-item {{ Request::segment(1) === 'projectauction' ? 'active' : null }}">
                    <a class="nav-link py-1" href="{{ url('projectauction') }}">ประมูลงานระบบ</a>
                </li>
                <li class="nav-item {{ Request::segment(1) === 'training' ? 'active' : null }}
                                    {{ Request::segment(1) === 'course' ? 'active' : null }}">
                    <a class="nav-link py-1" href="{{ url('training') }}">อบรมและสาระ</a>
                </li> -->
                <li class="nav-item {{ Request::segment(1) === 'suggest' ? 'active' : null }}">
                    <div class="nav-link py-1">เข้าร่วมเลย</div>
                </li>
                <div class="vl"></div>

                @if (Auth::guest())
                    <li class="nav-item {{ Request::segment(1) === 'register' ? 'active' : null }}">
                        <a class="nav-link py-1 buttonred redd" href="{{ url('register') }}">
                            <font style="color:red">ลงชื่อเข้าใช้</font>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-1 btn-danger" href="{{ url('login') }}">
                            <font style="color:white"> ผู้ประกอบการเข้าสู่ระบบ</font>
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown {{ Request::segment(1) === 'profile' ? 'active' : null }}">
                        <a class="nav-link py-1 dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class='fas fa-user-circle'></i> {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            {{-- <a class="dropdown-item" href="{{ url('erp-home') }}"><i class='fas fa-shopping-cart'></i> ผู้จัดชื้อ / ร้านค้า</a> --}}
                            @if (Auth::user()->profile->type_user_id == 1)
                                <a class="dropdown-item" href="{{ url('profile_student') }}"><i
                                        class='fas fa-user-alt'></i> ข้อมูลโปรไฟล์</a>
                            @elseif(Auth::user()->profile->type_user_id_2 == 2)
                                <a class="dropdown-item" href="{{ url('profile_company') }}"><i
                                        class='fas fa-user-alt'></i> ข้อมูลโปรไฟล์</a>
                            @endif
                            <a class="dropdown-item" href="{{ url('profile') }}"><i class='fa fa-bars'></i>
                                 ตั้งค่าข้อมูล</a>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class='fas fa-sign-out-alt'></i> ออกจากระบบ</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div id="count"></div>
                        <!-- Modal -->
                        <div class="modal fade" id="noti" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="notification"></div>
                                        {{-- <div class="card mb-2"> --}}
                                        {{-- <div class="row no-gutters"> --}}
                                        {{-- <div class="col-md-7"> --}}
                                        {{-- <div class="card-body p-2"> --}}
                                        {{-- <p class="card-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> --}}
                                        {{-- </div> --}}
                                        {{-- </div> --}}
                                        {{-- <div class="col-md-3"> --}}
                                        {{-- <div class="card-body p-2"> --}}
                                        {{-- <button type="button" class="btn btn-sm btn-outline-success">ส่งงาน</button> --}}
                                        {{-- </div> --}}
                                        {{-- </div> --}}
                                        {{-- <div class="col-md-2"> --}}
                                        {{-- <div class="card-body p-2"> --}}
                                        {{-- <p class="card-text"><small class="text-muted">3 mins ago</small></p> --}}
                                        {{-- </div> --}}
                                        {{-- </div> --}}
                                        {{-- </div> --}}
                                        {{-- </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </nav>

    {{-- end #navber --}}
    <!-- begin #content -->
    @yield('content')
    <!-- end #content -->
    {{-- begin #Footer --}}
    {{-- <div id="section-footer" class="bg-black">
        <div class="container py-4">
            <div class="row">
                <div class="col-sm-4">
                    <img src="{{ asset('images/logo-white.svg') }}" class="mw-100">
                    <ul>
                        <li>บริษัทxxxxxxxxxxx</li>
                        <li>เลขที่ผู้เสียภาษี: xxxxxxxxxx</li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <ul>
                        <li>โทร: xxx-xxx-xxxx, xx-xxx-xxxx</li>
                        <li>อีเมล์: xxxxx@xxxxxxxx.xxx</li>
                        <li>
                            <a href=""><i class='fab fa-facebook-square fa-lg'></i></a>
                            <a href=""><i class='fab fa-line fa-lg'></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <ul>
                        <li><a href="{{ url('work') }}">ประกาศงาน</a></li>
                        <li><a href="{{ url('promotion') }}">โปรโมชั่น</a></li>
                        <li><a href="{{ url('condition') }}">เงื่อนไขการใช้บริการ</a></li>
                        <li><a href="{{ url('privacy-policy') }}">นโยบายความเป็นส่วนตัว</a></li>
                        <li><a href="{{ url('faq') }}">คำถามที่เจอบ่อย</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="" class="text-white text-center bg-gray p-2">
        <span class="font-weight-light small">© Copyright. All Right Reserved 2018 by Phungngan</span>
    </div> --}}
    {{-- end #Footer --}}

    @yield('script')
    @if (!Auth::guest())
        <script type="text/javascript">
            $(document).ready(function() {
                countNotification();
                notification();
            });

            function countNotification() {
                $.ajax({
                    url: '{{ url('/api/count/notification') }}',
                    type: "GET",
                    data: {
                        user_id: '{{ Auth::user()->id }}'
                    },
                    success: function(data) {
                        // console.log(data);
                        $('#count').html(data);
                    }
                });
            }

            function notification() {
                $.ajax({
                    url: '{{ url('/api/notification') }}',
                    type: "GET",
                    data: {
                        user_id: '{{ Auth::user()->id }}'
                    },
                    success: function(data) {
                        // console.log(data);
                        var myHTML = '';
                        for (var i = 0; i < data.length; i++) {
                            myHTML += '    <div class="card mb-2">\n' +
                                '                                            <div class="row no-gutters">\n' +
                                '                                                <div class="col-md-7">\n' +
                                '                                                    <div class="card-body p-2">\n' +
                                '                                                        <p class="card-text">' +
                                data[i].detail + '</p>\n' +
                                '                                                    </div>\n' +
                                '                                                </div>\n' +
                                '                                                <div class="col-md-3">\n' +
                                '                                                    <div class="card-body p-2">\n' +
                                '                                                        <a href="/phungngan2/path/' +
                                data[i].id + '" class="btn btn-sm btn-outline-success">' + data[i].btn_name +
                                '</a>\n' +
                                '                                                    </div>\n' +
                                '                                                </div>\n' +
                                '                                                <div class="col-md-2">\n' +
                                '                                                    <div class="card-body p-2">\n' +
                                '                                                        <p class="card-text"><small class="text-muted">' +
                                data[i].date + '</small></p>\n' +
                                '                                                    </div>\n' +
                                '                                                </div>\n' +
                                '                                            </div>\n' +
                                '                                        </div>';
                        }

                        $('#notification').html(myHTML);
                    }
                });
            }
        </script>
    @endif
</body>

</html>
