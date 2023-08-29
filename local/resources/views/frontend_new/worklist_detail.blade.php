<!doctype html>
<html lang="th">

<head>
    @include('frontend_new.header')
</head>

<body>


    @include('frontend_new.menu')

    <!-- BLOG-SINGLE
    ================================================== -->
    <div class="container py-8 pt-lg-11">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <h1 class="text-capitalize">{{ $job->position }}</h1>

                <p class="me-xl-12"></p>

                <div class="d-md-flex align-items-center">
                    <div class="border rounded-circle d-inline-block mb-4 mb-md-0 me-4">
                        <div class="p-1">
                            <img src="{{ asset('images/profile/' . $job->Profile->image_profile) }}" alt="..."
                                class="rounded-circle" width="52" height="52">
                        </div>
                    </div>

                    <div class="mb-4 mb-md-0">
                        <a href="#" class="d-block">
                            <h6 class="mb-0">{{ $job->Profile->company }}</h6>
                        </a>
                        <span class="font-size-sm">{{ $job->created_at }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-8 sk-thumbnail img-ratio-7">
        <img src="{{ asset('assets/img/covers/cover-20.jpg') }}" alt="..." class="img-fluid">
    </div>

    <div class="container">
        <div class="row mb-8 mb-md-12">
            <div class="col-xl-8 mx-auto">

                @if ($job->Profile->company_img1 != '')
                    <img src="{{ asset('images/profile/' . $job->Profile->company_img1) }}" alt="..."
                        class="img-fluid rounded mb-8">
                @endif

                <h3 class="">
                    <font style="color:black">ข้อมูลบริษัท</font>
                </h3>
                <p class="">
                    <font style="color:gray">{!! $job->Profile->detail_about_me !!}</font>
                </p>
                <p class="">
                    <font style="color:gray">
                        {!! $job->Profile->company_address !!}

                    </font>
                </p>

                @if ($job->Profile->company_img2 != '')
                    <img src="{{ asset('images/profile/' . $job->Profile->company_img2) }}" alt="..."
                        class="img-fluid rounded mb-8">
                @endif

                @if ($job->Profile->company_img3 != '')
                    <img src="{{ asset('images/profile/' . $job->Profile->company_img3) }}" alt="..."
                        class="img-fluid rounded mb-8">
                @endif


                <h3 class="">รายละเอียดงาน</h3>
                <p class="mb-6 line-height-md">

                    {!! $job->job_detail !!}

                </p>

                {{-- <blockquote>
                    <p>Aliquam hendrerit sollicitudin purus, quis rutrum mi accumsan nec. Quisque bibendum orci ac nibh facilisis, at malesuada orci congue.
                        <cite>Luis Pickford</cite>
                    </p>
                </blockquote> --}}

                <h3 class="mb-5">ทักษะที่ต้องการ</h3>
                <div class="row row-cols-lg-2 mb-8">

                    {!! $job->skill_detail !!}
                    {{-- <div class="col-md">
                        <ul class="list-style-v1 list-unstyled">
                            <li>Become a UI/UX designer.</li>
                            <li>You will be able to start earning money skills.</li>
                            <li>    </li>
                        </ul>
                    </div>

                    <div class="col-md">
                        <ul class="list-style-v1 list-unstyled ms-xl-6">
                            <li>Build & test a complete mobile app.</li>
                            <li>Learn to design mobile apps & websites.</li>
                        </ul>
                    </div> --}}



                </div>

                <div class="row row-cols-lg-2 mb-8">
                    <div class="col-md">
                        <h5 class="">
                            <font>ระดับประสบการณ์</font>
                        </h5>

                        <p class="mb-3 text-left">
                            <font style="color:#374291;"><i class="fa fa-briefcase" aria-hidden="true"></i>
                                {{ $job->level }}</font>
                        </p>

                    </div>
                    <div class="col-md">
                        <h5 class="">
                            <font>ประเภทการจ้างงาน</font>
                        </h5>

                        <p class="mb-3 text-left">
                            <font style="color:#374291;"><i class="fa fa-calendar-check" aria-hidden="true"></i>
                                {{ $job->get_employment_type() }}</font>
                        </p>
                    </div>

                    <div class="col-md">
                        <h5 class="">
                            <font>เงินเดือน</font>
                        </h5>

                        <p class="mb-3 text-left">
                            <font style="color:#374291;"><i class="fa fa-credit-card" aria-hidden="true"></i>
                                {{ $job->salary }} รายเดือน</font>
                        </p>
                    </div>
                </div>

                {{-- <img src="{{ asset('assets/img/covers/cover-21.jpg') }}" alt="..." class="img-fluid rounded mb-8"> --}}

                <h3 class="mb-5">คอร์สเรียนที่ควรผ่านการเรียนรู้มาก่อน</h3>
                <ul class="list-style-v2 list-unstyled mb-10">
                    <?php
                    $course = \DB::table('courses')
                        ->where('id', $job->course_id_for_job)
                        ->first();
                    ?>
                    @if ($course)
                        <li><a href="{{ url('course_online_view/' . $course->id) }}">{{ $course->name }}</a></li>
                    @else
                        <li>-</li>
                    @endif

                </ul>

                {{-- <div class="row mb-6 mb-md-10 align-items-center">
                    <div class="col-md-4 mb-5 mb-md-2">
                        <a href="#" class="text-teal fw-medium d-flex align-items-center">
                            <!-- Icon -->
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.0283 6.25C14.3059 6.25 12.9033 4.84833 12.9033 3.125C12.9033 1.40167 14.3059 0 16.0283 0C17.7509 0 19.1533 1.40167 19.1533 3.125C19.1533 4.84833 17.7509 6.25 16.0283 6.25ZM16.0283 1.25C14.995 1.25 14.1533 2.09076 14.1533 3.125C14.1533 4.15924 14.995 5 16.0283 5C17.0616 5 17.9033 4.15924 17.9033 3.125C17.9033 2.09076 17.0616 1.25 16.0283 1.25Z"
                                    fill="currentColor" />
                                <path
                                    d="M16.0283 20C14.3059 20 12.9033 18.5983 12.9033 16.875C12.9033 15.1517 14.3059 13.75 16.0283 13.75C17.7509 13.75 19.1533 15.1517 19.1533 16.875C19.1533 18.5983 17.7509 20 16.0283 20ZM16.0283 15C14.995 15 14.1533 15.8408 14.1533 16.875C14.1533 17.9092 14.995 18.75 16.0283 18.75C17.0616 18.75 17.9033 17.9092 17.9033 16.875C17.9033 15.8408 17.0616 15 16.0283 15Z"
                                    fill="currentColor" />
                                <path
                                    d="M3.94531 13.125C2.22275 13.125 0.820312 11.7233 0.820312 10C0.820312 8.27667 2.22275 6.875 3.94531 6.875C5.66788 6.875 7.07031 8.27667 7.07031 10C7.07031 11.7233 5.66788 13.125 3.94531 13.125ZM3.94531 8.125C2.91199 8.125 2.07031 8.96576 2.07031 10C2.07031 11.0342 2.91199 11.875 3.94531 11.875C4.97864 11.875 5.82031 11.0342 5.82031 10C5.82031 8.96576 4.97864 8.125 3.94531 8.125Z"
                                    fill="currentColor" />
                                <path
                                    d="M6.12066 9.39154C5.90307 9.39154 5.69143 9.27817 5.57729 9.0766C5.40639 8.77661 5.51061 8.39484 5.8106 8.22409L13.5431 3.81568C13.8422 3.64325 14.2247 3.74823 14.3947 4.04914C14.5656 4.34912 14.4614 4.73075 14.1614 4.90164L6.42888 9.30991C6.33138 9.36484 6.22564 9.39154 6.12066 9.39154Z"
                                    fill="currentColor" />
                                <path
                                    d="M13.8524 16.2665C13.7475 16.2665 13.6416 16.2398 13.5441 16.1841L5.81151 11.7757C5.51152 11.6049 5.40745 11.2231 5.5782 10.9232C5.74818 10.6224 6.12996 10.5182 6.42994 10.6899L14.1623 15.0981C14.4623 15.269 14.5665 15.6506 14.3958 15.9506C14.2807 16.1531 14.0691 16.2665 13.8524 16.2665Z"
                                    fill="currentColor" />
                            </svg>

                            <span class="ms-3">Share This Post</span>
                        </a>
                    </div>

                    <div class="col-md-8">
                        <a href="#" class="btn btn-sm btn-light text-gray-800 px-5 fw-normal me-1 mb-2">Course</a>
                        <a href="#"
                            class="btn btn-sm btn-light text-gray-800 px-5 fw-normal me-1 mb-2">Timeline</a>
                        <a href="#" class="btn btn-sm btn-light text-gray-800 px-5 fw-normal me-1 mb-2">Moodle</a>
                        <a href="#" class="btn btn-sm btn-light text-gray-800 px-5 fw-normal me-1 mb-2">Best</a>
                        <a href="#" class="btn btn-sm btn-light text-gray-800 px-5 fw-normal me-1 mb-2">Info</a>
                    </div>
                </div>

                <h3 class="mb-6">Comment</h3>
                <ul class="list-unstyled pt-2">
                    <li class="media d-flex">
                        <div class="avatar avatar-xxl me-3 me-md-6 flex-shrink-0">
                            <img src="{{ asset('assets/img/avatars/avatar-1.jpg') }}" alt="..."
                                class="avatar-img rounded-circle">
                        </div>
                        <div class="media-body flex-shrink-1">
                            <div class="d-md-flex align-items-center mb-5">
                                <div class="me-auto mb-4 mb-md-0">
                                    <h5 class="mb-0">Oscar Cafeo</h5>
                                    <p class="font-size-sm font-italic">Beautiful courses</p>
                                </div>
                                <div class="star-rating">
                                    <div class="rating" style="width:100%;"></div>
                                </div>
                            </div>
                            <p class="mb-6 line-height-md">This course was well organized and covered a lot more details
                                than any other Figma courses. I really enjoy it. One suggestion is that it can be much
                                better if we could complete the prototype together. Since we created 24 frames, I really
                                want to test it on Figma mirror to see all the connections. Could you please let me take
                                a look at the complete prototype?</p>
                        </div>
                    </li>
                    <li class="media d-flex">
                        <div class="avatar avatar-xxl me-3 me-md-6 flex-shrink-0">
                            <img src="assets/img/avatars/avatar-2.jpg" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="media-body flex-shrink-1">
                            <div class="d-md-flex align-items-center mb-5">
                                <div class="me-auto mb-4 mb-md-0">
                                    <h5 class="mb-0">Alex Morgan</h5>
                                    <p class="font-size-sm font-italic">Beautiful courses</p>
                                </div>
                                <div class="star-rating">
                                    <div class="rating" style="width:100%;"></div>
                                </div>
                            </div>
                            <p class="mb-6 line-height-md">This course was well organized and covered a lot more
                                details than any other Figma courses. I really enjoy it. One suggestion is that it can
                                be much better if we could complete the prototype together. Since we created 24 frames,
                                I really want to test it on Figma mirror to see all the connections. Could you please
                                let me take a look at the complete prototype?</p>
                        </div>
                    </li>
                </ul> --}}

                <div class="border shadow rounded p-6 p-md-9">
                    <h3 class="mb-2">สมัครงาน {{ $job->position }}</h3>
                    <div class=""></div>
                    <form method="POST" action="{{ url('worklist_detail_register_store') }}" id="searchForm"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="job_description_id" value="{{ $job->id }}">

                        <div class="form-group mb-6">
                            <label for="exampleInputTitle1">E-mail</label>
                            <input type="text" class="form-control placeholder-1" name="email" required
                                id="exampleInputTitle1" placeholder="กรุณาระบุ">
                        </div>
                        <div class="form-group mb-6">
                            <label for="exampleInputTitle1">โทรศัพท์</label>
                            <input type="text" class="form-control placeholder-1" name="tel" required
                                id="exampleInputTitle1" placeholder="กรุณาระบุ">
                        </div>
                        <div class="form-group mb-6">
                            <label for="exampleInputTitle1">Resume</label>
                            <input type="file" class="form-control placeholder-1" name="resume" required
                                id="exampleInputTitle1" placeholder="กรุณาระบุ">
                        </div>


                        {{-- <div class="form-group mb-6">
                            <label for="exampleFormControlTextarea1">Review Content</label>
                            <textarea class="form-control placeholder-1" id="exampleFormControlTextarea1" rows="6" placeholder="Content"></textarea>
                        </div> --}}

                        <button type="submit" class="btn btn-primary btn-block mw-md-300p"
                            onclick="return confirm('ยืนยันการทำรายการ?')">ส่งใบสมัคร</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @include('frontend_new.footer')

</body>

</html>
