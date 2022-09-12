@extends('layouts.navber')
@section('head')
    {{-- @include('sweetalert::alert') --}}
@endsection
@section('content')
    <style>
        .main {
            width: 90%;
            margin-right: 20px;
            margin-left: 20px;
        }

        img.center {
            display: block;
            margin: 0 auto;
        }

        .opcenter {
            text-align: center;
            padding: 10px;
            margin: auto;
        }

        .optop {
            text-align: center;
            padding: 10px;

        }

        .left {
            text-align: left;
            margin-left: 80px;
            margin-Right: 20px;
        }

        .right {
            text-align: right;
            margin-Right: 80px;
            margin-left: 20px;
        }

        .op2center {
            text-align: center;
            padding: 10px;
            margin: auto;
            color: white;
            background-color: #8B0900;
            font-size: 18px;
            font-style: normal;
        }

        .op3center {
            text-align: center;
            padding: 10px;
            margin: auto;
            color: #8B0900;


            font-style: normal;
        }

        .button3:hover {
            background-color: #f44336;
            color: white;
        }

        .blockop {
            display: block;
            width: 100%;
            color: white;
            border: none;
            background-color: #8B0900;
            padding: 14px 28px;
            font-size: 18px;
            cursor: pointer;
            text-align: center;
        }

        .icon_bg {
            background-color: #808080;
            border-radius: 50px;
            -moz-box-shadow: 0 5px 14px -1px rgba(55, 65, 67, 0.2);
            -webkit-box-shadow: 0 5px 14px -1px rgb(55 65 67 / 20%);
            box-shadow: 0 5px 14px -1px rgb(55 65 67 / 20%);
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
        }
    </style>
    {{-- begin #Profile --}}
    <div id="traning-section" class="" style="color: #D3D3D3; ">
        <img src="{{ asset('image/user_bg.png') }}" class="center" width="100%" height="100%"><br>
    </div>
    <div class="main">

        <div class="row">
            <div class="col-lg-3 optop">
                <style>
                    .memberlink li {
                        list-style: none;
                        padding-bottom: 10px;
                        font-size: 0.9em;
                    }

                    .memberlink li a {
                        color: #6a5753;
                    }

                    table {
                        border-collapse: collapse;
                        width: 100%;
                    }

                    th,
                    td {
                        text-align: left;
                        padding: 8px;
                    }

                    tr:nth-child(even) {
                        background-color: #eed6d6;
                    }

                    .buttonop {
                        display: block;
                        width: 70%;
                        color: #808080;
                        border: none;
                        background-color: #e7e7e7;
                        padding: 3px 3px;
                        font-size: 14px;
                        cursor: pointer;
                        text-align: center;
                        border-radius: 15px;
                    }
                </style>

                <img src="{{ asset('images/profile/' . $profile->image_profile) }}" class="rounded-circle mb-2 mw-100"
                    width="200" height="200"><br>
                <h4 class="center" style="color: #8B0900;">{{Auth::user()->name}}</h4>
                <p class="center" style="color: #808080;">{{$profile->company}}</p><br>

                <h4 class="left" style="color: #8B0900;">ABOUT ME</h4>
                <p class="left" style="color: #808080;"><b>{{$profile->title_about_me}}</b></p>
                <p class="left" style="color: #808080;">{{$profile->detail_about_me}} </p>
                <br>

                <h5 class="left" style="color: #808080;"><img src="{{ asset('images/icon/location.png') }}"
                        height="30"></h5>
                <h5 class="left" style="color: #808080;">Location</h5>
                <p class="left" style="color: #808080;">{{$profile->company_address}}
                </p>
                <br>
                <div class="row">
                    <div class="col-1">
                        <img class="left" src="{{ asset('images/icon/fb.png') }}" height="35"
                            style="margin-right: 5px;">
                    </div>
                    <div class="col-11">

                        <button class=" left buttonop" style="margin-right: 5px;margin-top: 5px;">{{$profile->link_1}}</button>
                    </div>
                    <div class="col-1">
                        <img class="left" src="{{ asset('images/icon/gg.png') }}" style="margin-right: 5px;"
                            height="35">
                    </div>
                    <div class="col-11">
                        <button class=" left buttonop" style="margin-right: 5px;margin-top: 5px;">{{$profile->link_2}}</button>
                    </div>
                    <div class="col-1">
                        <img class="left" src="{{ asset('images/icon/in.png') }}" style="margin-right: 5px;"
                            height="35">
                    </div>
                    <div class="col-11">
                        <button class=" left buttonop" style="margin-right: 5px;margin-top: 5px;">{{$profile->link_3}}</button>
                    </div>
                    <div class="col-1">
                        <img class="left" src="{{ asset('images/icon/tw.png') }}" style="margin-right: 5px;"
                            height="35">
                    </div>
                    <div class="col-11">
                        <button class=" left buttonop" style="margin-right: 5px;margin-top: 5px;">{{$profile->link_4}}</button>
                    </div>

                </div>
                <br><br>
                <div class="row">
                    <div class="col-6">
                        <p class="left" style="color: #808080;">กดถูกใจ</p>
                    </div>
                    <div class="col-6">
                        <p class="right" style="color: #808080;">0</p>
                    </div>
                    <div class="col-6">
                        <p class="left" style="color: #808080;">ยื่นสมัครงาน</p>
                    </div>
                    <div class="col-6">
                        <p class="right" style="color: #808080;">0</p>
                    </div>
                    <div class="col-6">
                        <p class="left" style="color: #808080;">การเข้าถึง</p>
                    </div>
                    <div class="col-6">
                        <p class="right" style="color: #808080;">0</p>
                    </div>

                </div>
            </div>
            <div class="col-lg-9" >
                <table>
                    <th class="op2center"> <a href="{{url('profile_company/work')}}" class="blockop button3">WORK</a></th>
                    <th class="op2center"> <a href="{{url('profile_company/applicant')}}" class="blockop button3">APPLICANT</a></th>
                    <th class="op2center"> <a href="{{url('profile_company/course')}}" class="blockop button3">COURSE</a></th>
                    <th class="op2center"> <a href="{{url('profile_company/workshop')}}" class="blockop button3">แบบทดสอบ/WORKSHOP</a></th>
                </table>

                {{-- @if(@$page=='rasume')
                @include('auth.profile.tab.company.work')
                @endif --}}

                @if(@$page=='work')
                @include('auth.profile.tab.company.work')
                @endif


                @if(@$page=='applicant')
                @include('auth.profile.tab.company.applicant')
                @endif

                @if(@$page=='course')
                @include('auth.profile.tab.company.course')
                @endif

                @if(@$page=='workshop')
                @include('auth.profile.tab.company.workshop')
                @endif


            </div>
        </div>

    </div> {{-- end #main --}}


    {{-- end #Profile --}}
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
@section('script')
    <script type="text/javascript">
        function showHideDiv() {
            var srcElement = document.getElementById('divBoxComment');
            if (srcElement != null) {
                if (srcElement.style.display == "block") {
                    // console.log(1);
                    document.getElementById('divBoxComment').style.display = 'none';
                } else {
                    // console.log(2);
                    document.getElementById('btnComment').style.display = 'none';
                    document.getElementById('divBoxComment').style.display = 'block';
                }
                return false;
            }
        }
    </script>
    @if (session()->has('status'))
        <script>
            Swal({
                type: 'success',
                title: "<?php echo session()->get('status'); ?>",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @if (session()->has('gb_success'))
        <script>
            Swal({
                position: 'top-end',
                type: 'success',
                title: "<?php echo session()->get('gb_success'); ?>",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @if (session()->has('gb_error'))
        <script>
            Swal({
                position: 'top-end',
                type: 'error',
                title: "<?php echo session()->get('gb_error'); ?>",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
@endsection
