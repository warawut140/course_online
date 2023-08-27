<!doctype html>
<html lang="th">

<head>
    @include('frontend_new.header')
</head>

<body>


    @include('frontend_new.menu')

    <div class="mb-8 sk-thumbnail img-ratio-7">
        <img src="{{ asset('assets/img/covers/cover-20.jpg') }}" alt="..." class="img-fluid">
    </div>

    <div class="container">

        @if(session('success'))
        <div class="p-3 mb-2 bg-success text-white success text-center">{{session('success')}}</div>
        @endif

        @if(session('error'))
        <div class="p-3 mb-2 bg-danger text-white error text-center">{{session('error')}}</div>
        @endif

        <div class="row mb-8">
            <div class="col-lg-12 mb-12 mb-lg-0 position-relative">

                {{-- <div class="d-md-flex align-items-center mb-5">
                    <div class="border rounded-circle d-inline-block mb-4 mb-md-0 me-md-6 me-lg-4 me-xl-6">
                        <div class="p-2">
                            <img src="{{ asset('images/profile/' . $data->image_profile) }}" alt="..."
                                class="rounded-circle" width="68" height="68">
                        </div>
                    </div>

                    <div class="mb-4 mb-md-0 me-md-8 me-lg-4 me-xl-8">
                        <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                        <a href="#" class="font-size-sm text-gray-800">- {{ $data->title_me }}</a>
                    </div>

                    <div class="mb-4 mb-md-0 me-md-8 me-lg-4 me-xl-8">
                        <h6 class="mb-0">{{ @$work_exp->position }}</h6>
                        <a href="#" class="font-size-sm text-gray-800">- บริษัท {{ @$work_exp->name }}</a>
                    </div>

                    <div class="mb-4 mb-md-0 me-md-8 me-lg-4 me-xl-8">
                        <h6 class="mb-0">{{ $data->title_about_me }}</h6>
                        <a href="#" class="font-size-sm text-gray-800">- {{ $data->detail_about_me }}</a>
                    </div>

                    <div class="mb-4 mb-md-0 me-md-8 me-lg-4 me-xl-8">
                        <h6 class="mb-0">Location</h6>
                        <a href="#" class="font-size-sm text-gray-800">
                            - {{ $data->company_address }}
                        </a>
                    </div>

                </div> --}}

                <!-- COURSE INFO TAB
                ================================================== -->
                <div class="border rounded shadow p-3 mb-6">
                    <ul id="pills-tab" class="nav nav-pills course-tab-v2 h5 mb-0 flex-nowrap overflow-auto"
                        role="tablist">
                        <li class="nav-item">
                            <a class="nav-link <?php if ($type == '') {
                                echo 'active';
                            } ?>" id="pills-overview-tab"
                                href="{{ url('register_user_detail') }}" role="tab" aria-controls="pills-overview"
                                aria-selected="true">BASIC INFORMATION</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($type == 'web') {
                                echo 'active';
                            } ?>" id="pills-overview-tab2"
                                href="{{ url('register_user_detail/web') }}" role="tab"
                                aria-controls="pills-overview2" aria-selected="true">ON THE WEB</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($type == 'job') {
                                echo 'active';
                            } ?>" id="pills-overview-tab3"
                                href="{{ url('register_user_detail/job') }}" role="tab"
                                aria-controls="pills-overview3" aria-selected="true">ABOUT ME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($type == 'education') {
                                echo 'active';
                            } ?>" id="pills-overview-tab4"
                                href="{{ url('register_user_detail/education') }}" role="tab"
                                aria-controls="pills-overview4" aria-selected="true">Education</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($type == 'work_exp') {
                                echo 'active';
                            } ?>" id="pills-overview-tab5"
                                href="{{ url('register_user_detail/work_exp') }}" role="tab"
                                aria-controls="pills-overview5" aria-selected="true">WORK EXPERIENCE</a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content" id="pills-tabContent">

                    @if ($type == '')
                        @include('auth.usertab.basic')
                    @endif
                    @if ($type == 'web')
                        @include('auth.usertab.on_web')
                    @endif
                    @if ($type == 'job')
                        @include('auth.usertab.job')
                    @endif
                    @if ($type == 'education')
                        @include('auth.usertab.education')
                    @endif

                    @if ($type == 'work_exp')
                        @include('auth.usertab.work_exp')
                    @endif

                </div>

            </div>
        </div>

    </div>


    </div>

    @include('frontend_new.footer')

</body>

</html>
