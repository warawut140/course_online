<!doctype html>
<html lang="th">

<head>
    @include('frontend_new.header')
</head>

<body>


    @include('frontend_new.menu')

    <!-- PAGE TITLE
    ================================================== -->
    <header class="py-8 py-md-11" style="background-image: none;">
        <div class="container text-center py-xl-2">
            <h1 class="display-4 fw-semi-bold mb-0">เข้าสู่ระบบ</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-scroll justify-content-center">
                    {{-- <li class="breadcrumb-item">
                        <a class="text-gray-800" href="#">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item text-gray-800 active" aria-current="page">
                        Login
                    </li> --}}
                </ol>
            </nav>
        </div>
        <!-- Img -->
        <img class="d-none img-fluid" src="..." alt="...">
    </header>


    <!-- LOGIN
    ================================================== -->
    <div class="container mb-11">
        <div class="row gx-0">
            <div class="col-md-7 col-xl-4 mx-auto">
                <!-- Login -->
                <h3 class="mb-6">Welcome to
                    Online education & job</h3>

                <!-- Form Login -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email -->
                    <div class="form-group mb-5">
                        <label for="modalSigninEmail1">
                            Email
                        </label>
                        <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            name="email" value="{{ old('email') }}" id="text" placeholder="อีเมล์"
                            aria-label="Email" aria-describedby="basic-addon1" required autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <!-- Password -->
                    <div class="form-group mb-5">
                        <label for="modalSigninPassword1">
                            Password
                        </label>
                        <input type="password" id="password" name="password" placeholder="**********"
                            aria-label="Password" aria-describedby="basic-addon1"
                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="d-flex align-items-center mb-5 font-size-sm">
                        <div class="form-check">
                            <input class="form-check-input text-gray-800" type="checkbox" id="autoSizingCheck1">
                            <label class="form-check-label text-gray-800" for="autoSizingCheck1">
                                Remember me
                            </label>
                        </div>

                        <div class="ms-auto">
                            <button class="btn btn-link" type="button" data-bs-toggle="modal"
                                data-bs-target="#modalExample2">
                                ลืมรหัสผ่าน?
                            </button>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button class="btn btn-block btn-primary" type="submit">
                        เข้าสู่ระบบ
                    </button>
                </form>

                <!-- Text -->
                <p class="mb-0 font-size-sm text-center">
                    ยังไม่มีบัญชี? <a class="text-underline" href="{{ route('register') }}">สมัครสมาชิก</a>
                </p>
            </div>
        </div>
    </div>



    <div class="modal fade" id="modalExample2" tabindex="-1" aria-labelledby="modalExampleTitle" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ลืมรหัสผ่าน</h5>
                </div>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">กรอกอีเมล์</label>
                            <input type="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="อีเมล์ที่ใช้สมัคร">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">ยืนยันส่ง</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @include('frontend_new.footer')

</body>

</html>
