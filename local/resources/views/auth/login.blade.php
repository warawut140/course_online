@extends('layouts.navber')
@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick-theme.css') }}"/>
    <style>
        /* Shared */
        .loginBtn {
            box-sizing: border-box;
            position: relative;
            /* width: 13em;  - apply for fixed size */
            margin: 0.2em;
            padding: 0 15px 0 46px;
            border: none;
            text-align: left;
            line-height: 34px;
            white-space: nowrap;
            border-radius: 0.2em;
            font-size: 16px;
            color: #FFF;
        }
        .loginBtn:before {
            content: "";
            box-sizing: border-box;
            position: absolute;
            top: 0;
            left: 0;
            width: 34px;
            height: 100%;
        }
        .loginBtn:focus {
            outline: none;
        }
        .loginBtn:active {
            box-shadow: inset 0 0 0 32px rgba(0,0,0,0.1);
        }


        /* Facebook */
        .loginBtn--facebook {
            background-color: #4C69BA;
            background-image: linear-gradient(#4C69BA, #3B55A0);
            /*font-family: "Helvetica neue", Helvetica Neue, Helvetica, Arial, sans-serif;*/
            text-shadow: 0 -1px 0 #354C8C;
        }
        .loginBtn--facebook:before {
            border-right: #364e92 1px solid;
            background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/14082/icon_facebook.png') 6px 6px no-repeat;
        }
        .loginBtn--facebook:hover,
        .loginBtn--facebook:focus {
            background-color: #5B7BD5;
            background-image: linear-gradient(#5B7BD5, #4864B1);
        }


        /* Google */
        .loginBtn--google {
            /*font-family: "Roboto", Roboto, arial, sans-serif;*/
            background: #DD4B39;
        }
        .loginBtn--google:before {
            border-right: #BB3F30 1px solid;
            background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/14082/icon_google.png') 6px 6px no-repeat;
        }
        .loginBtn--google:hover,
        .loginBtn--google:focus {
            background: #E74B37;
        }
    </style>
@endsection
@section('content')
    <div id="login-section1" class="bg-light">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">เข้าสู่ระบบ</h5>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class='fas fa-user-alt'></i></span>
                                    </div>
                                    {{--<input type="text" class="form-control" placeholder="อีเมล์" aria-label="Email" aria-describedby="basic-addon1">--}}
                                    <input type="text"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ old('email') }}"
                                           id="text"
                                           placeholder="อีเมล์"
                                           aria-label="Email" aria-describedby="basic-addon1"
                                           required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                         </span>
                                    @endif
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                    class='fas fa-key'></i></span>
                                    </div>
                                    {{--<input type="password" class="form-control" placeholder="รหัสผ่าน" aria-label="Password" aria-describedby="basic-addon1">--}}
                                    <input type="password"
                                           id="password" name="password"
                                           placeholder="รหัสผ่าน" aria-label="Password" aria-describedby="basic-addon1"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-link" data-toggle="modal"
                                            data-target="#exampleModal">ลืมรหัสผ่าน?
                                    </button>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-warning w-100">เข้าสู่ระบบ</button>
                                </div>
                                <div class="form-group loginBtn loginBtn--google w-100">
                                    <a href="{{ url('/auth/redirect') }}" style="color: #f8f9fa;">
                                        {{--<button type="button" class="loginBtn loginBtn--google w-100">--}}
                                            <center>Login with Google</center>
                                        {{--</button>--}}
                                    </a>
                                </div>
                                {{--<div class="form-group">--}}
                                    {{--<button type="button" class="loginBtn loginBtn--facebook w-100">--}}
                                        {{--<center>Login with Facebook</center>--}}
                                    {{--</button>--}}
                                {{--</div>--}}
                                <div class="form-group text-center">
                                    <p>ยังไม่มีบัญชี? <a href="{{ route('register') }}">สมัครสมาชิก</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ลืมรหัสผ่าน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                    </button>
                </div>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">กรอกอีเมล์</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                   placeholder="อีเมล์ที่ใช้สมัคร">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">ยืนยันส่ง</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $('.bg-light').css({
            'min-height': $(window).height() - $('.navbar').height() - $('#section-footer').height()
        });
    </script>
@endsection


{{--@extends('layouts.app')--}}
{{--@section('content')--}}
    {{--<div class="container">--}}
        {{--<div class="row justify-content-center">--}}
            {{--<div class="col-md-8">--}}
                {{--<div class="card">--}}
                    {{--<div class="card-header">{{ __('Login') }}</div>--}}

                    {{--<div class="card-body">--}}
                        {{--<form method="POST" action="{{ route('login') }}">--}}
                            {{--@csrf--}}

                            {{--<div class="form-group row">--}}
                                {{--<label for="email"--}}
                                       {{--class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="email" type="email"--}}
                                           {{--class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"--}}
                                           {{--name="email" value="{{ old('email') }}" required autofocus>--}}

                                    {{--@if ($errors->has('email'))--}}
                                        {{--<span class="invalid-feedback" role="alert">--}}
{{--<strong>{{ $errors->first('email') }}</strong>--}}
{{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group row">--}}
                                {{--<label for="password"--}}
                                       {{--class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="password" type="password"--}}
                                           {{--class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"--}}
                                           {{--name="password" required>--}}

                                    {{--@if ($errors->has('password'))--}}
                                        {{--<span class="invalid-feedback" role="alert">--}}
{{--<strong>{{ $errors->first('password') }}</strong>--}}
{{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group row">--}}
                                {{--<div class="col-md-6 offset-md-4">--}}
                                    {{--<div class="form-check">--}}
                                        {{--<input class="form-check-input" type="checkbox" name="remember"--}}
                                               {{--id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

                                        {{--<label class="form-check-label" for="remember">--}}
                                            {{--{{ __('Remember Me') }}--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group row mb-0">--}}
                                {{--<div class="col-md-8 offset-md-4">--}}
                                    {{--<button type="submit" class="btn btn-primary">--}}
                                        {{--{{ __('Login') }}--}}
                                    {{--</button>--}}

                                    {{--@if (Route::has('password.request'))--}}
                                        {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                            {{--{{ __('Forgot Your Password?') }}--}}
                                        {{--</a>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--@endsection--}}
