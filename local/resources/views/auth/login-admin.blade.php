<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name', 'Phungngan (Administrator)') }}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="{{ asset('assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style-responsive.min.cs') }}s" rel="stylesheet" />
    <link href="{{ asset('assets/css/theme/default.css') }}" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ asset('assets/plugins/pace/pace.min.js') }}"></script>
    <!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top bg-white">
<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade">
    <!-- begin login -->
    <div class="login login-with-news-feed">
        <!-- begin news-feed -->
        <div class="news-feed">
            <div class="news-image">
                <img src="{{ asset('assets/img/login-bg/bg-7.jpg') }}" data-id="login-cover-image" alt="" />
            </div>
            <div class="news-caption">
                <h4 class="caption-title"><i class="fa fa-diamond text-success"></i> Announcing the Color Admin app</h4>
                <p>
                    Download the Color Admin app for iPhone®, iPad®, and Android™. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </p>
            </div>
        </div>
        <!-- end news-feed -->
        <!-- begin right-content -->
        <div class="right-content">
            <!-- begin login-header -->
            <div class="login-header">
                <div class="brand">
                    <span class="logo"></span>  ระบบจัดการฐานข้อมูล (Admin)
                    <small>Login Phungngan</small>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-in"></i>
                </div>
            </div>
            <!-- end login-header -->
            <!-- begin login-content -->
            <div class="login-content">
                <form method="POST" action="{{ route('admin.login.submit') }}"  aria-label="{{ __('login') }}" class="margin-bottom-0">
                    @csrf
                    <div class="form-group m-b-15">
                        <input type="email"
                               name="email"
                               id="email"
                               class="form-control input-lg{{ $errors->has('email') ? ' is-invalid' : '' }}"
                               value="{{ old('email') }}"
                               placeholder="Email Address"
                               required autofocus/>
                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group m-b-15">
                        <input type="password"
                               name="password"
                               id="password"
                               class="form-control input-lg{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               placeholder="Password" required/>
                    </div>
                    <div class="checkbox m-b-30">
                        <label>
                            <input type="checkbox" /> Remember Me
                        </label>
                    </div>
                    <div class="login-buttons">
                        <button type="submit" class="btn btn-success btn-block btn-lg">Login</button>
                    </div>
                    <div class="m-t-20 m-b-40 p-b-40">
                        {{--Not a member yet? Click <a href="register_v3.html" class="text-success">here</a> to register.--}}
                    </div>
                    <hr />
                    <p class="text-center text-inverse">
                        &copy; Color Admin All Right Reserved 2015
                    </p>
                </form>
            </div>
            <!-- end login-content -->
        </div>
        <!-- end right-container -->
    </div>
    <!-- end login -->

</div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="{{ asset('assets/plugins/jquery/jquery-1.9.1.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery/jquery-migrate-1.1.0.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<!--[if lt IE 9]>
<!--<script src="assets/crossbrowserjs/html5shiv.js"></script>-->
<!--<script src="assets/crossbrowserjs/respond.min.js"></script>-->
<!--<script src="assets/crossbrowserjs/excanvas.min.js"></script>-->
<![endif]-->
<script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-cookie/jquery.cookie.js') }}"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{ asset('assets/js/apps.min.js') }}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script>
    $(document).ready(function() {
        App.init();
    });
</script>
</body>
</html>
