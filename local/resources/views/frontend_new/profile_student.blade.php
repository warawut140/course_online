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
        <div class="row mb-8">
            <div class="col-lg-12 mb-12 mb-lg-0 position-relative">

                <div class="d-md-flex align-items-center mb-5">
                    <div class="border rounded-circle d-inline-block mb-4 mb-md-0 me-md-6 me-lg-4 me-xl-6">
                        <div class="p-2">
                            <img src="{{ asset('images/profile/' . $profile->image_profile) }}" alt="..."
                                class="rounded-circle" width="68" height="68">
                        </div>
                    </div>

                    <div class="mb-4 mb-md-0 me-md-8 me-lg-4 me-xl-8">
                        <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                        <a href="#" class="font-size-sm text-gray-800">{{ $profile->title_me }}</a>
                    </div>

                    <div class="mb-4 mb-md-0 me-md-8 me-lg-4 me-xl-8">
                        <h6 class="mb-0">{{ @$work_exp->position }}</h6>
                        <a href="#" class="font-size-sm text-gray-800">{{ @$work_exp->name }}</a>
                    </div>

                    <div class="mb-4 mb-md-0 me-md-8 me-lg-4 me-xl-8">
                        <h6 class="mb-0">{{ $profile->title_about_me }}</h6>
                        <a href="#" class="font-size-sm text-gray-800">{{ $profile->detail_about_me }}</a>
                    </div>

                    <div class="mb-4 mb-md-0 me-md-8 me-lg-4 me-xl-8">
                        <h6 class="mb-0">Location</h6>
                        <a href="#" class="font-size-sm text-gray-800">
                            {{ $profile->company_address }}
                        </a>
                    </div>

                </div>

                <!-- COURSE INFO TAB
                ================================================== -->
                <div class="border rounded shadow p-3 mb-6">
                    <ul id="pills-tab" class="nav nav-pills course-tab-v2 h5 mb-0 flex-nowrap overflow-auto"
                        role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-overview-tab" data-bs-toggle="pill"
                                href="#pills-overview" role="tab" aria-controls="pills-overview"
                                aria-selected="true">CV/RASUME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="pills-overview-tab2" data-bs-toggle="pill" href="#pills-overview2"
                                role="tab" aria-controls="pills-overview2" aria-selected="true">PORTFOLIO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="pills-overview-tab3" data-bs-toggle="pill" href="#pills-overview3"
                                role="tab" aria-controls="pills-overview3" aria-selected="true">WORK</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="pills-overview-tab4" data-bs-toggle="pill" href="#pills-overview4"
                                role="tab" aria-controls="pills-overview4" aria-selected="true">COURSE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="pills-overview-tab5" data-bs-toggle="pill" href="#pills-overview5"
                                role="tab" aria-controls="pills-overview5" aria-selected="true">CERTIFICATE</a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade show active" id="pills-overview" role="tabpanel"
                        aria-labelledby="pills-overview-tab">
                        @include('auth.profile.tab.student.rasume')
                    </div>

                    <div class="tab-pane fade show" id="pills-overview2" role="tabpanel"
                        aria-labelledby="pills-overview-tab2">
                        @include('auth.profile.tab.student.portfolio')
                    </div>

                    <div class="tab-pane fade show" id="pills-overview3" role="tabpanel"
                        aria-labelledby="pills-overview-tab3">
                        @include('auth.profile.tab.student.work')
                    </div>

                    <div class="tab-pane fade show" id="pills-overview4" role="tabpanel"
                        aria-labelledby="pills-overview-tab4">
                        @include('auth.profile.tab.student.course')
                    </div>

                    <div class="tab-pane fade show" id="pills-overview5" role="tabpanel"
                        aria-labelledby="pills-overview-tab5">
                        {{-- @include('auth.profile.tab.student.rasume') --}}
                    </div>



                </div>

            </div>
        </div>

    </div>


    </div>

    @include('frontend_new.footer')

</body>

</html>
