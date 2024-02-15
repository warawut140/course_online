<!doctype html>
<html lang="th">

<head>
    @include('frontend_new.header')
</head>

<body>


    @include('frontend_new.menu')


    <!-- HERO
    ================================================== -->
    <section class="">
        <div class="flickity-button-outset-long flickity-page-dots-white flickity-page-dots-43"
            data-flickity='{"fade": true, "pageDots": true, "prevNextButtons": true, "cellAlign": "center", "wrapAround": true, "imagesLoaded": true}'>

            @foreach ($courses_recom as $c)
                <div class="w-100">
                    {{-- <div class="py-10 overlay overlay-custom-left"
                        style="background-image: url(assets/img/covers/cover-7.jpg)"> --}}
                    <div class="py-10 overlay overlay-custom-left"
                        style="background-image: url({{ asset('images/banner/' . $banner_index[0]->image) }})">
                        <div class="container">
                            <div class="row align-items-center py-md-12 gx-0">
                                <div class="col-md-6 mb-6 mb-md-0 col-lg-7">
                                    <!-- Heading -->
                                    <h1 class="display-5 fw-medium text-white mb-2 text-capitalize" data-aos="fade-left"
                                        data-aos-duration="150">
                                        {{ $c->name }}
                                    </h1>

                                    <!-- Text -->
                                    <p class="text-white-70 text-capitalize mb-6 mw-xl-75 pe-xl-6" data-aos="fade-up"
                                        data-aos-duration="200">
                                        {{ $c->detail }}
                                    </p>

                                    <!-- Buttons -->
                                    <a href="{{ url('course_online_view/' . $c->id) }}"
                                        class="btn text-white-alone btn-slide slide-white btn-wide shadow mb-4 mb-md-0 me-md-5"
                                        data-aos-duration="200" data-aos="fade-up">GET STARTED</a>
                                    <a href="{{ url('course_online_view/' . $c->id) }}"
                                        class="btn text-white-all btn-denim btn-wide d-none d-lg-inline-block"
                                        data-aos-duration="200" data-aos="fade-up">VIEW COURSES</a>
                                </div>

                                <div class="col-md-6 mb-6 mb-md-0 col-lg-auto mw-xl-350p ms-auto">
                                    <!-- Card -->
                                    <div class="card p-2 sk-fade">
                                        <!-- Image -->
                                        <div class="card-zoom position-relative">
                                            <div class="badge-float sk-fade-top top-0 right-0 mt-4 me-4">
                                                <a href="#"
                                                    class="btn btn-xs btn-dark text-white rounded-circle lift opacity-dot-7 me-1 p-2 d-inline-flex justify-content-center align-items-center w-36 h-36">
                                                    <!-- Icon -->
                                                    <svg width="18" height="18" viewBox="0 0 18 18"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M17.8856 8.64995C17.7248 8.42998 13.8934 3.26379 8.99991 3.26379C4.10647 3.26379 0.274852 8.42998 0.114223 8.64974C-0.0380743 8.85843 -0.0380743 9.14147 0.114223 9.35016C0.274852 9.57013 4.10647 14.7363 8.99991 14.7363C13.8934 14.7363 17.7248 9.5701 17.8856 9.35034C18.0381 9.14169 18.0381 8.85843 17.8856 8.64995ZM8.99991 13.5495C5.39537 13.5495 2.27345 10.1206 1.3493 8.99965C2.27226 7.87771 5.38764 4.4506 8.99991 4.4506C12.6043 4.4506 15.726 7.8789 16.6505 9.00046C15.7276 10.1224 12.6122 13.5495 8.99991 13.5495Z"
                                                            fill="currentColor" />
                                                        <path
                                                            d="M8.9999 5.43958C7.03671 5.43958 5.43945 7.03683 5.43945 9.00003C5.43945 10.9632 7.03671 12.5605 8.9999 12.5605C10.9631 12.5605 12.5603 10.9632 12.5603 9.00003C12.5603 7.03683 10.9631 5.43958 8.9999 5.43958ZM8.9999 11.3736C7.69103 11.3736 6.62629 10.3089 6.62629 9.00003C6.62629 7.6912 7.69107 6.62642 8.9999 6.62642C10.3087 6.62642 11.3735 7.6912 11.3735 9.00003C11.3735 10.3089 10.3088 11.3736 8.9999 11.3736Z"
                                                            fill="currentColor" />
                                                    </svg>

                                                </a>
                                                <a href="#"
                                                    class="btn btn-xs btn-dark text-white rounded-circle lift opacity-dot-7 p-2 d-inline-flex justify-content-center align-items-center w-36 h-36">
                                                    <!-- Icon -->
                                                    <svg width="16" height="16" viewBox="0 0 16 16"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M11.2437 1.20728C10.0203 1.20728 8.87397 1.66486 7.99998 2.48357C7.12598 1.66486 5.97968 1.20728 4.7563 1.20728C2.13368 1.20728 0 3.341 0 5.96366C0 7.2555 0.425164 8.52729 1.26366 9.74361C1.91197 10.6841 2.80887 11.5931 3.92937 12.4454C5.809 13.8753 7.66475 14.6543 7.74285 14.6867L7.99806 14.7928L8.25384 14.6881C8.33199 14.6562 10.1889 13.8882 12.0696 12.4635C13.1907 11.6142 14.0881 10.7054 14.7367 9.7625C15.575 8.54385 16 7.26577 16 5.96371C16 3.341 13.8663 1.20728 11.2437 1.20728ZM8.00141 13.3353C6.74962 12.7555 1.33966 10.0142 1.33966 5.96366C1.33966 4.07969 2.87237 2.54698 4.75634 2.54698C5.827 2.54698 6.81558 3.03502 7.46862 3.88598L8.00002 4.57845L8.53142 3.88598C9.18446 3.03502 10.173 2.54698 11.2437 2.54698C13.1276 2.54698 14.6604 4.07969 14.6604 5.96366C14.6603 10.0433 9.25265 12.7613 8.00141 13.3353Z"
                                                            fill="currentColor" />
                                                    </svg>

                                                </a>
                                            </div>

                                            <a href="#" class="card-img sk-thumbnail img-ratio-9 d-block">
                                                <img class="rounded shadow-light-lg"
                                                    src="{{ asset('images/profile/' . $c->image) }}"
                                                    style="
                                                    width: 337px;
                                                    height: 242px;
                                                    object-fit: cover;
                                                  "
                                                    alt="...">
                                            </a>

                                            <span
                                                class="badge sk-fade-bottom badge-lg badge-orange badge-pill badge-float bottom-0 left-0 mb-4 ms-4">
                                                <span class="text-white text-uppercase fw-bold font-size-xs">BEST
                                                    SELLER</span>
                                            </span>
                                        </div>

                                        <!-- Footer -->
                                        <div class="card-footer px-2 pb-2 mb-1 pt-4 position-relative">
                                            <a href="#" class="d-block">
                                                <div
                                                    class="avatar avatar-xl badge-float position-absolute top-0 right-0 mt-n6 me-5 rounded-circle shadow border border-white border-w-lg">
                                                    <img src="{{ asset('images/profile/' . $c->Profile->image_profile) }}"
                                                        alt="..." class="avatar-img rounded-circle">
                                                </div>
                                            </a>

                                            <!-- Preheading -->
                                            <a href="{{ url('course_online_view/' . $c->id) }}"><span
                                                    class="mb-1 d-inline-block text-gray-800">{{ @$c->CategoryCourse->name }}</span></a>


                                            <!-- Heading -->
                                            <div class="position-relative">
                                                <a href="{{ url('course_online_view/' . $c->id) }}"
                                                    class="d-block stretched-link">
                                                    <h4
                                                        class="line-clamp-2 h-md-48 h-lg-58 me-md-6 me-lg-10 me-xl-4 mb-2">
                                                        {{ $c->name }}</h4>
                                                </a>

                                                <div class="d-lg-flex align-items-end flex-wrap mb-n1">
                                                    <div class="star-rating mb-2 mb-lg-0 me-lg-3">
                                                        <div class="rating" style="width:50%;"></div>
                                                    </div>

                                                    <div class="font-size-sm">
                                                        <span>3 (1 reviews)</span>
                                                    </div>
                                                </div>

                                                <div class="row mx-n2 align-items-end">
                                                    <div class="col px-2">
                                                        <ul class="nav mx-n3">
                                                            <li class="nav-item px-3">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="me-2 d-flex icon-uxs text-secondary">
                                                                        <!-- Icon -->
                                                                        <svg width="20" height="20"
                                                                            viewBox="0 0 20 20" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M17.1947 7.06802L14.6315 7.9985C14.2476 7.31186 13.712 6.71921 13.0544 6.25992C12.8525 6.11877 12.6421 5.99365 12.4252 5.88303C13.0586 5.25955 13.452 4.39255 13.452 3.43521C13.452 1.54098 11.9124 -1.90735e-06 10.0197 -1.90735e-06C8.12714 -1.90735e-06 6.58738 1.54098 6.58738 3.43521C6.58738 4.39255 6.98075 5.25955 7.61414 5.88303C7.39731 5.99365 7.1869 6.11877 6.98502 6.25992C6.32752 6.71921 5.79178 7.31186 5.40787 7.9985L2.8447 7.06802C2.33612 6.88339 1.79688 7.26044 1.79688 7.80243V16.5178C1.79688 16.8465 2.00256 17.14 2.31155 17.2522L9.75312 19.9536C9.93073 20.018 10.1227 20.0128 10.2863 19.9536L17.7278 17.2522C18.0368 17.14 18.2425 16.8465 18.2425 16.5178V7.80243C18.2425 7.26135 17.704 6.88309 17.1947 7.06802ZM10.0197 1.5625C11.0507 1.5625 11.8895 2.40265 11.8895 3.43521C11.8895 4.46777 11.0507 5.30792 10.0197 5.30792C8.98866 5.30792 8.14988 4.46777 8.14988 3.43521C8.14988 2.40265 8.98866 1.5625 10.0197 1.5625ZM9.23844 18.1044L3.35938 15.9703V8.91724L9.23844 11.0513V18.1044ZM10.0197 9.67255L6.90644 8.54248C7.58164 7.51892 8.75184 6.87042 10.0197 6.87042C11.2875 6.87042 12.4577 7.51892 13.1329 8.54248L10.0197 9.67255ZM16.68 15.9703L10.8009 18.1044V11.0513L16.68 8.91724V15.9703Z"
                                                                                fill="currentColor" />
                                                                        </svg>

                                                                    </div>
                                                                    <div class="font-size-sm">5 lessons</div>
                                                                </div>
                                                            </li>
                                                            <li class="nav-item px-3">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="me-2 d-flex icon-uxs text-secondary">
                                                                        <!-- Icon -->
                                                                        <svg width="16" height="16"
                                                                            viewBox="0 0 16 16"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M14.3164 4.20996C13.985 4.37028 13.8464 4.76904 14.0067 5.10026C14.4447 6.00505 14.6667 6.98031 14.6667 8C14.6667 11.6759 11.6759 14.6667 8 14.6667C4.32406 14.6667 1.33333 11.6759 1.33333 8C1.33333 4.32406 4.32406 1.33333 8 1.33333C9.52328 1.33333 10.9543 1.83073 12.1387 2.77165C12.4259 3.00098 12.846 2.95296 13.0754 2.66471C13.3047 2.37663 13.2567 1.95703 12.9683 1.72803C11.5661 0.613607 9.8016 0 8 0C3.58903 0 0 3.58903 0 8C0 12.411 3.58903 16 8 16C12.411 16 16 12.411 16 8C16 6.77767 15.7331 5.60628 15.2067 4.51969C15.0467 4.18766 14.6466 4.04932 14.3164 4.20996Z"
                                                                                fill="currentColor" />
                                                                            <path
                                                                                d="M7.99967 2.66663C7.63167 2.66663 7.33301 2.96529 7.33301 3.33329V7.99996C7.33301 8.36796 7.63167 8.66663 7.99967 8.66663H11.333C11.701 8.66663 11.9997 8.36796 11.9997 7.99996C11.9997 7.63196 11.701 7.33329 11.333 7.33329H8.66634V3.33329C8.66634 2.96529 8.36768 2.66663 7.99967 2.66663Z"
                                                                                fill="currentColor" />
                                                                        </svg>

                                                                    </div>
                                                                    <div class="font-size-sm">8h 12m</div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="col-auto px-2 text-right">
                                                        <del class="font-size-sm"></del>
                                                        <ins class="h4 mb-0 d-block mb-lg-n1">Free</ins>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- <div class="w-100">
                <div class="py-10 overlay overlay-custom-left"
                    style="background-image: url(assets/img/covers/cover-4.jpg)">
                    <div class="container">
                        <div class="row align-items-center py-md-12 gx-0">
                            <div class="col-md-6 mb-6 mb-md-0 col-lg-7">
                                <!-- Heading -->
                                <h1 class="display-5 fw-medium text-white mb-2 text-capitalize" data-aos="fade-left"
                                    data-aos-duration="150">
                                    Self EducatIon Resources and Infos
                                </h1>

                                <!-- Text -->
                                <p class="text-white-70 text-capitalize mb-6 mw-xl-75 pe-xl-6" data-aos="fade-up"
                                    data-aos-duration="200">
                                    Technology is brining a massive wave of evolution on learning things on different
                                    ways.
                                </p>

                                <!-- Buttons -->
                                <a href="./course-list-v1.html"
                                    class="btn text-white-alone btn-slide slide-white btn-wide shadow mb-4 mb-md-0 me-md-5"
                                    data-aos-duration="200" data-aos="fade-up">GET STARTED</a>
                                <a href="./course-list-v1.html"
                                    class="btn text-white-all btn-denim btn-wide d-none d-lg-inline-block"
                                    data-aos-duration="200" data-aos="fade-up">VIEW COURSES</a>
                            </div>

                            <div class="col-md-6 mb-6 mb-md-0 col-lg-auto mw-xl-350p ms-auto">
                                <!-- Card -->
                                <div class="card p-2 sk-fade">
                                    <!-- Image -->
                                    <div class="card-zoom position-relative">
                                        <div class="badge-float sk-fade-top top-0 right-0 mt-4 me-4">
                                            <a href="./course-list-v1.html"
                                                class="btn btn-xs btn-dark text-white rounded-circle lift opacity-dot-7 me-1 p-2 d-inline-flex justify-content-center align-items-center w-36 h-36">
                                                <!-- Icon -->
                                                <svg width="18" height="18" viewBox="0 0 18 18"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M17.8856 8.64995C17.7248 8.42998 13.8934 3.26379 8.99991 3.26379C4.10647 3.26379 0.274852 8.42998 0.114223 8.64974C-0.0380743 8.85843 -0.0380743 9.14147 0.114223 9.35016C0.274852 9.57013 4.10647 14.7363 8.99991 14.7363C13.8934 14.7363 17.7248 9.5701 17.8856 9.35034C18.0381 9.14169 18.0381 8.85843 17.8856 8.64995ZM8.99991 13.5495C5.39537 13.5495 2.27345 10.1206 1.3493 8.99965C2.27226 7.87771 5.38764 4.4506 8.99991 4.4506C12.6043 4.4506 15.726 7.8789 16.6505 9.00046C15.7276 10.1224 12.6122 13.5495 8.99991 13.5495Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M8.9999 5.43958C7.03671 5.43958 5.43945 7.03683 5.43945 9.00003C5.43945 10.9632 7.03671 12.5605 8.9999 12.5605C10.9631 12.5605 12.5603 10.9632 12.5603 9.00003C12.5603 7.03683 10.9631 5.43958 8.9999 5.43958ZM8.9999 11.3736C7.69103 11.3736 6.62629 10.3089 6.62629 9.00003C6.62629 7.6912 7.69107 6.62642 8.9999 6.62642C10.3087 6.62642 11.3735 7.6912 11.3735 9.00003C11.3735 10.3089 10.3088 11.3736 8.9999 11.3736Z"
                                                        fill="currentColor" />
                                                </svg>

                                            </a>
                                            <a href="./course-list-v1.html"
                                                class="btn btn-xs btn-dark text-white rounded-circle lift opacity-dot-7 p-2 d-inline-flex justify-content-center align-items-center w-36 h-36">
                                                <!-- Icon -->
                                                <svg width="16" height="16" viewBox="0 0 16 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M11.2437 1.20728C10.0203 1.20728 8.87397 1.66486 7.99998 2.48357C7.12598 1.66486 5.97968 1.20728 4.7563 1.20728C2.13368 1.20728 0 3.341 0 5.96366C0 7.2555 0.425164 8.52729 1.26366 9.74361C1.91197 10.6841 2.80887 11.5931 3.92937 12.4454C5.809 13.8753 7.66475 14.6543 7.74285 14.6867L7.99806 14.7928L8.25384 14.6881C8.33199 14.6562 10.1889 13.8882 12.0696 12.4635C13.1907 11.6142 14.0881 10.7054 14.7367 9.7625C15.575 8.54385 16 7.26577 16 5.96371C16 3.341 13.8663 1.20728 11.2437 1.20728ZM8.00141 13.3353C6.74962 12.7555 1.33966 10.0142 1.33966 5.96366C1.33966 4.07969 2.87237 2.54698 4.75634 2.54698C5.827 2.54698 6.81558 3.03502 7.46862 3.88598L8.00002 4.57845L8.53142 3.88598C9.18446 3.03502 10.173 2.54698 11.2437 2.54698C13.1276 2.54698 14.6604 4.07969 14.6604 5.96366C14.6603 10.0433 9.25265 12.7613 8.00141 13.3353Z"
                                                        fill="currentColor" />
                                                </svg>

                                            </a>
                                        </div>

                                        <a href="#" class="card-img sk-thumbnail img-ratio-9 d-block">
                                            <img class="rounded shadow-light-lg"
                                                src="assets/img/products/product-7.jpg" alt="...">
                                        </a>

                                        <span
                                            class="badge sk-fade-bottom badge-lg badge-orange badge-pill badge-float bottom-0 left-0 mb-4 ms-4">
                                            <span class="text-white text-uppercase fw-bold font-size-xs">BEST
                                                SELLER</span>
                                        </span>
                                    </div>

                                    <!-- Footer -->
                                    <div class="card-footer px-2 pb-2 mb-1 pt-4 position-relative">
                                        <a href="#" class="d-block">
                                            <div
                                                class="avatar avatar-xl badge-float position-absolute top-0 right-0 mt-n6 me-5 rounded-circle shadow border border-white border-w-lg">
                                                <img src="assets/img/avatars/avatar-1.jpg" alt="..."
                                                    class="avatar-img rounded-circle">
                                            </div>
                                        </a>

                                        <!-- Preheading -->
                                        <a href="./course-list-v1.html"><span
                                                class="mb-1 d-inline-block text-gray-800">Photography</span></a>


                                        <!-- Heading -->
                                        <div class="position-relative">
                                            <a href="./course-list-v1.html" class="d-block stretched-link">
                                                <h4
                                                    class="line-clamp-2 h-md-48 h-lg-58 me-md-6 me-lg-10 me-xl-4 mb-2">
                                                    Fashion Photography From Professional</h4>
                                            </a>

                                            <div class="d-lg-flex align-items-end flex-wrap mb-n1">
                                                <div class="star-rating mb-2 mb-lg-0 me-lg-3">
                                                    <div class="rating" style="width:50%;"></div>
                                                </div>

                                                <div class="font-size-sm">
                                                    <span>5.45 (5.8k+ reviews)</span>
                                                </div>
                                            </div>

                                            <div class="row mx-n2 align-items-end">
                                                <div class="col px-2">
                                                    <ul class="nav mx-n3">
                                                        <li class="nav-item px-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-2 d-flex icon-uxs text-secondary">
                                                                    <!-- Icon -->
                                                                    <svg width="20" height="20"
                                                                        viewBox="0 0 20 20" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M17.1947 7.06802L14.6315 7.9985C14.2476 7.31186 13.712 6.71921 13.0544 6.25992C12.8525 6.11877 12.6421 5.99365 12.4252 5.88303C13.0586 5.25955 13.452 4.39255 13.452 3.43521C13.452 1.54098 11.9124 -1.90735e-06 10.0197 -1.90735e-06C8.12714 -1.90735e-06 6.58738 1.54098 6.58738 3.43521C6.58738 4.39255 6.98075 5.25955 7.61414 5.88303C7.39731 5.99365 7.1869 6.11877 6.98502 6.25992C6.32752 6.71921 5.79178 7.31186 5.40787 7.9985L2.8447 7.06802C2.33612 6.88339 1.79688 7.26044 1.79688 7.80243V16.5178C1.79688 16.8465 2.00256 17.14 2.31155 17.2522L9.75312 19.9536C9.93073 20.018 10.1227 20.0128 10.2863 19.9536L17.7278 17.2522C18.0368 17.14 18.2425 16.8465 18.2425 16.5178V7.80243C18.2425 7.26135 17.704 6.88309 17.1947 7.06802ZM10.0197 1.5625C11.0507 1.5625 11.8895 2.40265 11.8895 3.43521C11.8895 4.46777 11.0507 5.30792 10.0197 5.30792C8.98866 5.30792 8.14988 4.46777 8.14988 3.43521C8.14988 2.40265 8.98866 1.5625 10.0197 1.5625ZM9.23844 18.1044L3.35938 15.9703V8.91724L9.23844 11.0513V18.1044ZM10.0197 9.67255L6.90644 8.54248C7.58164 7.51892 8.75184 6.87042 10.0197 6.87042C11.2875 6.87042 12.4577 7.51892 13.1329 8.54248L10.0197 9.67255ZM16.68 15.9703L10.8009 18.1044V11.0513L16.68 8.91724V15.9703Z"
                                                                            fill="currentColor" />
                                                                    </svg>

                                                                </div>
                                                                <div class="font-size-sm">5 lessons</div>
                                                            </div>
                                                        </li>
                                                        <li class="nav-item px-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-2 d-flex icon-uxs text-secondary">
                                                                    <!-- Icon -->
                                                                    <svg width="16" height="16"
                                                                        viewBox="0 0 16 16"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M14.3164 4.20996C13.985 4.37028 13.8464 4.76904 14.0067 5.10026C14.4447 6.00505 14.6667 6.98031 14.6667 8C14.6667 11.6759 11.6759 14.6667 8 14.6667C4.32406 14.6667 1.33333 11.6759 1.33333 8C1.33333 4.32406 4.32406 1.33333 8 1.33333C9.52328 1.33333 10.9543 1.83073 12.1387 2.77165C12.4259 3.00098 12.846 2.95296 13.0754 2.66471C13.3047 2.37663 13.2567 1.95703 12.9683 1.72803C11.5661 0.613607 9.8016 0 8 0C3.58903 0 0 3.58903 0 8C0 12.411 3.58903 16 8 16C12.411 16 16 12.411 16 8C16 6.77767 15.7331 5.60628 15.2067 4.51969C15.0467 4.18766 14.6466 4.04932 14.3164 4.20996Z"
                                                                            fill="currentColor" />
                                                                        <path
                                                                            d="M7.99967 2.66663C7.63167 2.66663 7.33301 2.96529 7.33301 3.33329V7.99996C7.33301 8.36796 7.63167 8.66663 7.99967 8.66663H11.333C11.701 8.66663 11.9997 8.36796 11.9997 7.99996C11.9997 7.63196 11.701 7.33329 11.333 7.33329H8.66634V3.33329C8.66634 2.96529 8.36768 2.66663 7.99967 2.66663Z"
                                                                            fill="currentColor" />
                                                                    </svg>

                                                                </div>
                                                                <div class="font-size-sm">8h 12m</div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="col-auto px-2 text-right">
                                                    <del class="font-size-sm">$959</del>
                                                    <ins class="h4 mb-0 d-block mb-lg-n1">$415.99</ins>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-100">
                <div class="py-10 overlay overlay-custom-left"
                    style="background-image: url(assets/img/covers/cover-1.jpg)">
                    <div class="container">
                        <div class="row align-items-center py-md-12 gx-0">
                            <div class="col-md-6 mb-6 mb-md-0 col-lg-7">
                                <!-- Heading -->
                                <h1 class="display-5 fw-medium text-white mb-2 text-capitalize" data-aos="fade-left"
                                    data-aos-duration="150">
                                    Self EducatIon Resources and Infos
                                </h1>

                                <!-- Text -->
                                <p class="text-white-70 text-capitalize mb-6 mw-xl-75 pe-xl-6" data-aos="fade-up"
                                    data-aos-duration="200">
                                    Technology is brining a massive wave of evolution on learning things on different
                                    ways.
                                </p>

                                <!-- Buttons -->
                                <a href="./course-list-v1.html"
                                    class="btn text-white-alone btn-slide slide-white btn-wide shadow mb-4 mb-md-0 me-md-5"
                                    data-aos-duration="200" data-aos="fade-up">GET STARTED</a>
                                <a href="./course-list-v1.html"
                                    class="btn text-white-all btn-denim btn-wide d-none d-lg-inline-block"
                                    data-aos-duration="200" data-aos="fade-up">VIEW COURSES</a>
                            </div>

                            <div class="col-md-6 mb-6 mb-md-0 col-lg-auto mw-xl-350p ms-auto">
                                <!-- Card -->
                                <div class="card p-2 sk-fade">
                                    <!-- Image -->
                                    <div class="card-zoom position-relative">
                                        <div class="badge-float sk-fade-top top-0 right-0 mt-4 me-4">
                                            <a href="./course-list-v1.html"
                                                class="btn btn-xs btn-dark text-white rounded-circle lift opacity-dot-7 me-1 p-2 d-inline-flex justify-content-center align-items-center w-36 h-36">
                                                <!-- Icon -->
                                                <svg width="18" height="18" viewBox="0 0 18 18"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M17.8856 8.64995C17.7248 8.42998 13.8934 3.26379 8.99991 3.26379C4.10647 3.26379 0.274852 8.42998 0.114223 8.64974C-0.0380743 8.85843 -0.0380743 9.14147 0.114223 9.35016C0.274852 9.57013 4.10647 14.7363 8.99991 14.7363C13.8934 14.7363 17.7248 9.5701 17.8856 9.35034C18.0381 9.14169 18.0381 8.85843 17.8856 8.64995ZM8.99991 13.5495C5.39537 13.5495 2.27345 10.1206 1.3493 8.99965C2.27226 7.87771 5.38764 4.4506 8.99991 4.4506C12.6043 4.4506 15.726 7.8789 16.6505 9.00046C15.7276 10.1224 12.6122 13.5495 8.99991 13.5495Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M8.9999 5.43958C7.03671 5.43958 5.43945 7.03683 5.43945 9.00003C5.43945 10.9632 7.03671 12.5605 8.9999 12.5605C10.9631 12.5605 12.5603 10.9632 12.5603 9.00003C12.5603 7.03683 10.9631 5.43958 8.9999 5.43958ZM8.9999 11.3736C7.69103 11.3736 6.62629 10.3089 6.62629 9.00003C6.62629 7.6912 7.69107 6.62642 8.9999 6.62642C10.3087 6.62642 11.3735 7.6912 11.3735 9.00003C11.3735 10.3089 10.3088 11.3736 8.9999 11.3736Z"
                                                        fill="currentColor" />
                                                </svg>

                                            </a>
                                            <a href="./course-list-v1.html"
                                                class="btn btn-xs btn-dark text-white rounded-circle lift opacity-dot-7 p-2 d-inline-flex justify-content-center align-items-center w-36 h-36">
                                                <!-- Icon -->
                                                <svg width="16" height="16" viewBox="0 0 16 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M11.2437 1.20728C10.0203 1.20728 8.87397 1.66486 7.99998 2.48357C7.12598 1.66486 5.97968 1.20728 4.7563 1.20728C2.13368 1.20728 0 3.341 0 5.96366C0 7.2555 0.425164 8.52729 1.26366 9.74361C1.91197 10.6841 2.80887 11.5931 3.92937 12.4454C5.809 13.8753 7.66475 14.6543 7.74285 14.6867L7.99806 14.7928L8.25384 14.6881C8.33199 14.6562 10.1889 13.8882 12.0696 12.4635C13.1907 11.6142 14.0881 10.7054 14.7367 9.7625C15.575 8.54385 16 7.26577 16 5.96371C16 3.341 13.8663 1.20728 11.2437 1.20728ZM8.00141 13.3353C6.74962 12.7555 1.33966 10.0142 1.33966 5.96366C1.33966 4.07969 2.87237 2.54698 4.75634 2.54698C5.827 2.54698 6.81558 3.03502 7.46862 3.88598L8.00002 4.57845L8.53142 3.88598C9.18446 3.03502 10.173 2.54698 11.2437 2.54698C13.1276 2.54698 14.6604 4.07969 14.6604 5.96366C14.6603 10.0433 9.25265 12.7613 8.00141 13.3353Z"
                                                        fill="currentColor" />
                                                </svg>

                                            </a>
                                        </div>

                                        <a href="#" class="card-img sk-thumbnail img-ratio-9 d-block">
                                            <img class="rounded shadow-light-lg"
                                                src="assets/img/products/product-7.jpg" alt="...">
                                        </a>

                                        <span
                                            class="badge sk-fade-bottom badge-lg badge-orange badge-pill badge-float bottom-0 left-0 mb-4 ms-4">
                                            <span class="text-white text-uppercase fw-bold font-size-xs">BEST
                                                SELLER</span>
                                        </span>
                                    </div>

                                    <!-- Footer -->
                                    <div class="card-footer px-2 pb-2 mb-1 pt-4 position-relative">
                                        <a href="#" class="d-block">
                                            <div
                                                class="avatar avatar-xl badge-float position-absolute top-0 right-0 mt-n6 me-5 rounded-circle shadow border border-white border-w-lg">
                                                <img src="assets/img/avatars/avatar-1.jpg" alt="..."
                                                    class="avatar-img rounded-circle">
                                            </div>
                                        </a>

                                        <!-- Preheading -->
                                        <a href="./course-list-v1.html"><span
                                                class="mb-1 d-inline-block text-gray-800">Photography</span></a>


                                        <!-- Heading -->
                                        <div class="position-relative">
                                            <a href="./course-list-v1.html" class="d-block stretched-link">
                                                <h4
                                                    class="line-clamp-2 h-md-48 h-lg-58 me-md-6 me-lg-10 me-xl-4 mb-2">
                                                    Fashion Photography From Professional</h4>
                                            </a>

                                            <div class="d-lg-flex align-items-end flex-wrap mb-n1">
                                                <div class="star-rating mb-2 mb-lg-0 me-lg-3">
                                                    <div class="rating" style="width:50%;"></div>
                                                </div>

                                                <div class="font-size-sm">
                                                    <span>5.45 (5.8k+ reviews)</span>
                                                </div>
                                            </div>

                                            <div class="row mx-n2 align-items-end">
                                                <div class="col px-2">
                                                    <ul class="nav mx-n3">
                                                        <li class="nav-item px-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-2 d-flex icon-uxs text-secondary">
                                                                    <!-- Icon -->
                                                                    <svg width="20" height="20"
                                                                        viewBox="0 0 20 20" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M17.1947 7.06802L14.6315 7.9985C14.2476 7.31186 13.712 6.71921 13.0544 6.25992C12.8525 6.11877 12.6421 5.99365 12.4252 5.88303C13.0586 5.25955 13.452 4.39255 13.452 3.43521C13.452 1.54098 11.9124 -1.90735e-06 10.0197 -1.90735e-06C8.12714 -1.90735e-06 6.58738 1.54098 6.58738 3.43521C6.58738 4.39255 6.98075 5.25955 7.61414 5.88303C7.39731 5.99365 7.1869 6.11877 6.98502 6.25992C6.32752 6.71921 5.79178 7.31186 5.40787 7.9985L2.8447 7.06802C2.33612 6.88339 1.79688 7.26044 1.79688 7.80243V16.5178C1.79688 16.8465 2.00256 17.14 2.31155 17.2522L9.75312 19.9536C9.93073 20.018 10.1227 20.0128 10.2863 19.9536L17.7278 17.2522C18.0368 17.14 18.2425 16.8465 18.2425 16.5178V7.80243C18.2425 7.26135 17.704 6.88309 17.1947 7.06802ZM10.0197 1.5625C11.0507 1.5625 11.8895 2.40265 11.8895 3.43521C11.8895 4.46777 11.0507 5.30792 10.0197 5.30792C8.98866 5.30792 8.14988 4.46777 8.14988 3.43521C8.14988 2.40265 8.98866 1.5625 10.0197 1.5625ZM9.23844 18.1044L3.35938 15.9703V8.91724L9.23844 11.0513V18.1044ZM10.0197 9.67255L6.90644 8.54248C7.58164 7.51892 8.75184 6.87042 10.0197 6.87042C11.2875 6.87042 12.4577 7.51892 13.1329 8.54248L10.0197 9.67255ZM16.68 15.9703L10.8009 18.1044V11.0513L16.68 8.91724V15.9703Z"
                                                                            fill="currentColor" />
                                                                    </svg>

                                                                </div>
                                                                <div class="font-size-sm">5 lessons</div>
                                                            </div>
                                                        </li>
                                                        <li class="nav-item px-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-2 d-flex icon-uxs text-secondary">
                                                                    <!-- Icon -->
                                                                    <svg width="16" height="16"
                                                                        viewBox="0 0 16 16"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M14.3164 4.20996C13.985 4.37028 13.8464 4.76904 14.0067 5.10026C14.4447 6.00505 14.6667 6.98031 14.6667 8C14.6667 11.6759 11.6759 14.6667 8 14.6667C4.32406 14.6667 1.33333 11.6759 1.33333 8C1.33333 4.32406 4.32406 1.33333 8 1.33333C9.52328 1.33333 10.9543 1.83073 12.1387 2.77165C12.4259 3.00098 12.846 2.95296 13.0754 2.66471C13.3047 2.37663 13.2567 1.95703 12.9683 1.72803C11.5661 0.613607 9.8016 0 8 0C3.58903 0 0 3.58903 0 8C0 12.411 3.58903 16 8 16C12.411 16 16 12.411 16 8C16 6.77767 15.7331 5.60628 15.2067 4.51969C15.0467 4.18766 14.6466 4.04932 14.3164 4.20996Z"
                                                                            fill="currentColor" />
                                                                        <path
                                                                            d="M7.99967 2.66663C7.63167 2.66663 7.33301 2.96529 7.33301 3.33329V7.99996C7.33301 8.36796 7.63167 8.66663 7.99967 8.66663H11.333C11.701 8.66663 11.9997 8.36796 11.9997 7.99996C11.9997 7.63196 11.701 7.33329 11.333 7.33329H8.66634V3.33329C8.66634 2.96529 8.36768 2.66663 7.99967 2.66663Z"
                                                                            fill="currentColor" />
                                                                    </svg>

                                                                </div>
                                                                <div class="font-size-sm">8h 12m</div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="col-auto px-2 text-right">
                                                    <del class="font-size-sm">$959</del>
                                                    <ins class="h4 mb-0 d-block mb-lg-n1">$415.99</ins>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>

    <!-- ICON BLOCKS
    ================================================== -->
    <section class="py-5 pt-md-11 pb-md-12 bg-white-ice text-center">
        <div class="container">
            <div class="mb-md-8 mb-4">
                <h1 class="mb-1">ทำไมต้องเรียนกับ Eduflix</h1>
                <p class="font-size-lg mb-0 text-capitalize">ค้นหาบทเรียนที่ตรงกับงานของคุณ</p>
            </div>

            <div class="row row-cols-md-3">
                <div class="col-md mb-4 mb-md-0">
                    <div class="p-5 d-inline-block rounded-circle mb-6" style="border: 1px solid #F8C994;">
                        <div class="icon-circle icon-circle-lg" style="background-color: #f5debc; color: #EE8E00;">
                            <!-- Icon -->
                            <svg width="50" height="42" viewBox="0 0 50 42"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M40.7772 24.0457L34.8852 20.873C33.9687 20.3794 32.8878 20.4035 31.9939 20.9373C31.1 21.4711 30.5664 22.4115 30.5664 23.4525V30.7043C30.5664 31.7975 31.168 32.7919 32.1364 33.2993C32.5655 33.5241 33.0321 33.6353 33.4971 33.6353C34.0813 33.6353 34.6631 33.4595 35.1637 33.113L41.0558 29.0338C41.9005 28.4491 42.3706 27.4876 42.3133 26.4618C42.2561 25.436 41.6817 24.5328 40.7772 24.0457ZM33.4961 30.7037V23.4526L39.3879 26.6254L33.4961 30.7037Z"
                                    fill="currentColor" />
                                <path
                                    d="M17.1875 19.5352H7.8125C7.00352 19.5352 6.34766 20.191 6.34766 21C6.34766 21.809 7.00352 22.4648 7.8125 22.4648H17.1875C17.9965 22.4648 18.6523 21.809 18.6523 21C18.6523 20.191 17.9965 19.5352 17.1875 19.5352Z"
                                    fill="currentColor" />
                                <path
                                    d="M17.1875 25.7852H7.8125C7.00352 25.7852 6.34766 26.441 6.34766 27.25C6.34766 28.059 7.00352 28.7148 7.8125 28.7148H17.1875C17.9965 28.7148 18.6523 28.059 18.6523 27.25C18.6523 26.441 17.9965 25.7852 17.1875 25.7852Z"
                                    fill="currentColor" />
                                <path
                                    d="M17.1875 32.0352H7.8125C7.00352 32.0352 6.34766 32.691 6.34766 33.5C6.34766 34.309 7.00352 34.9648 7.8125 34.9648H17.1875C17.9965 34.9648 18.6523 34.309 18.6523 33.5C18.6523 32.691 17.9965 32.0352 17.1875 32.0352Z"
                                    fill="currentColor" />
                                <path
                                    d="M45.6055 0.00390625H4.39453C1.97139 0.00390625 0 1.97529 0 4.39844V37.6016C0 40.0247 1.97139 41.9961 4.39453 41.9961H45.6055C48.0286 41.9961 50 40.0247 50 37.6016V4.39844C50 1.97529 48.0286 0.00390625 45.6055 0.00390625ZM4.39453 2.93359H45.6055C46.4132 2.93359 47.0703 3.59072 47.0703 4.39844V12.5039H2.92969V4.39844C2.92969 3.59072 3.58682 2.93359 4.39453 2.93359ZM45.6055 39.0664H4.39453C3.58682 39.0664 2.92969 38.4093 2.92969 37.6016V15.4336H47.0703V37.6016C47.0703 38.4093 46.4132 39.0664 45.6055 39.0664Z"
                                    fill="currentColor" />
                                <path
                                    d="M7.8125 9.18359C8.62151 9.18359 9.27734 8.52776 9.27734 7.71875C9.27734 6.90974 8.62151 6.25391 7.8125 6.25391C7.00349 6.25391 6.34766 6.90974 6.34766 7.71875C6.34766 8.52776 7.00349 9.18359 7.8125 9.18359Z"
                                    fill="currentColor" />
                                <path
                                    d="M14.0625 9.18372C14.8715 9.18372 15.5273 8.52788 15.5273 7.71887C15.5273 6.90986 14.8715 6.25403 14.0625 6.25403C13.2535 6.25403 12.5977 6.90986 12.5977 7.71887C12.5977 8.52788 13.2535 9.18372 14.0625 9.18372Z"
                                    fill="currentColor" />
                                <path
                                    d="M20.3125 9.18359C21.1215 9.18359 21.7773 8.52776 21.7773 7.71875C21.7773 6.90974 21.1215 6.25391 20.3125 6.25391C19.5035 6.25391 18.8477 6.90974 18.8477 7.71875C18.8477 8.52776 19.5035 9.18359 20.3125 9.18359Z"
                                    fill="currentColor" />
                            </svg>

                        </div>
                    </div>

                    <h4>เรียนรู้อะไรก็ได้</h4>
                    <p class="px-lg-7 px-xl-8">เรามีบทเรียนมากมายให้คุณได้เลือก</p>
                </div>

                <div class="col-md mb-4 mb-md-0">
                    <div class="p-5 d-inline-block rounded-circle mb-6" style="border: 1px solid #B7B3F8;">
                        <div class="icon-circle icon-circle-lg" style="background-color: #d3d8f8; color: #5066F5;">
                            <!-- Icon -->
                            <svg width="50" height="50" viewBox="0 0 50 50"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M42.6777 7.32231C37.9558 2.60048 31.6777 0 25 0C18.3223 0 12.0442 2.60048 7.32231 7.32231C2.60038 12.0441 0 18.3223 0 25C0 31.6777 2.60048 37.9558 7.32231 42.6777C12.0441 47.3996 18.3223 50 25 50C31.6777 50 37.9558 47.3995 42.6777 42.6777C47.3996 37.9559 50 31.6777 50 25C50 18.3223 47.3995 12.0442 42.6777 7.32231ZM41.6253 39.5856L40.2162 38.1764C39.4842 37.4445 39.3028 36.3304 39.7647 35.404L41.0257 32.875C42.2388 30.4418 42.88 27.7188 42.88 25C42.88 22.2812 42.2388 19.5581 41.0257 17.125L39.7647 14.596C39.3028 13.6696 39.4842 12.5555 40.2162 11.8236L41.6253 10.4144C45.1758 14.4502 47.1154 19.5763 47.1154 25C47.1154 30.4237 45.1758 35.5498 41.6253 39.5856ZM12.8168 34.1168L11.5559 31.5878C9.49914 27.4627 9.49914 22.5372 11.5559 18.4121L12.8168 15.8831C13.2154 15.0838 13.3953 14.2209 13.3707 13.3701C13.4213 13.3715 13.4719 13.3738 13.5227 13.3738C14.3238 13.3738 15.1315 13.1914 15.8832 12.8167L18.4122 11.5558C22.5373 9.49894 27.4628 9.49904 31.5879 11.5558L34.1169 12.8167C34.9161 13.2152 35.7788 13.395 36.6293 13.3705C36.6048 14.2212 36.7847 15.0838 37.1832 15.883L38.4441 18.412C40.5009 22.5371 40.5009 27.4626 38.4441 31.5877L37.1832 34.1167C36.7847 34.916 36.6048 35.7786 36.6293 36.6291C35.7788 36.6046 34.9161 36.7845 34.1169 37.183L31.5879 38.4439C27.4627 40.5007 22.5372 40.5006 18.4122 38.4439L15.8832 37.183C15.0839 36.7845 14.2213 36.6046 13.3708 36.6291C13.3952 35.7788 13.2153 34.9161 12.8168 34.1168ZM25 2.88462C30.4237 2.88462 35.5498 4.82423 39.5856 8.37471L38.1764 9.78385C37.4446 10.5157 36.3305 10.6973 35.404 10.2353L32.875 8.97433C30.4418 7.76125 27.7188 7.12 25 7.12C22.2812 7.12 19.5581 7.76125 17.125 8.97433L14.596 10.2353C13.6695 10.6972 12.5556 10.5158 11.8236 9.78385L10.4144 8.37471C14.4502 4.82423 19.5763 2.88462 25 2.88462ZM8.37471 10.4144L9.78385 11.8236C10.5158 12.5555 10.6972 13.6696 10.2353 14.596L8.97433 17.125C7.76125 19.5582 7.12 22.2812 7.12 25C7.12 27.7188 7.76125 30.4419 8.97433 32.875L10.2353 35.404C10.6972 36.3304 10.5158 37.4445 9.78385 38.1764L8.37471 39.5856C4.82423 35.5498 2.88462 30.4237 2.88462 25C2.88462 19.5763 4.82423 14.4502 8.37471 10.4144ZM25 47.1154C19.5763 47.1154 14.4502 45.1758 10.4144 41.6253L11.8236 40.2162C12.5555 39.4844 13.6696 39.3028 14.596 39.7647L17.125 41.0257C19.5582 42.2388 22.2812 42.88 25 42.88C27.7188 42.88 30.4419 42.2388 32.875 41.0257L35.404 39.7647C36.3305 39.3029 37.4445 39.4842 38.1764 40.2162L39.5856 41.6253C35.5498 45.1758 30.4237 47.1154 25 47.1154Z"
                                    fill="currentColor" />
                            </svg>

                        </div>
                    </div>

                    <h4>การเรียนรู้ที่ยืดหยุ่น</h4>
                    <p class="px-lg-7 px-xl-8">สามารถเรียนและหยุดเรียนแบบไหนก็ได้</p>
                </div>

                <div class="col-md mb-4 mb-md-0">
                    <div class="p-5 d-inline-block rounded-circle mb-6" style="border: 1px solid #B2F4DC;">
                        <div class="icon-circle icon-circle-lg" style="background-color: #b2f4dc; color: #00C27C;">
                            <!-- Icon -->
                            <svg width="50" height="50" viewBox="0 0 50 50"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M36.7188 39.7461C36.7188 40.5552 36.063 41.2109 35.2539 41.2109C34.4448 41.2109 33.7891 40.5552 33.7891 39.7461C33.7891 38.937 34.4448 38.2812 35.2539 38.2812C36.063 38.2812 36.7188 38.937 36.7188 39.7461Z"
                                    fill="currentColor" />
                                <path
                                    d="M29.3945 17.7734H31.1108C33.3912 17.7734 35.5354 18.6615 37.1479 20.274C37.429 20.5555 37.8056 20.7031 38.184 20.7031C38.5735 20.7031 38.9503 20.5433 39.2193 20.274C40.1783 19.315 41.3261 18.6146 42.5781 18.2026V22.168C42.5781 22.9771 43.2339 23.6328 44.043 23.6328C44.8521 23.6328 45.5078 22.9771 45.5078 22.168V17.7734H46.9727C47.7818 17.7734 48.4375 17.1177 48.4375 16.3086V1.46484C48.4375 0.655746 47.7818 0 46.9727 0H45.2564C42.659 0 40.1939 0.857925 38.1836 2.4395C36.1732 0.857925 33.7082 0 31.1108 0H29.3945C28.5854 0 27.9297 0.655746 27.9297 1.46484V16.3086C27.9297 17.1177 28.5854 17.7734 29.3945 17.7734ZM45.5078 2.92969V14.8438H45.2564C43.2205 14.8438 41.3033 15.3725 39.6484 16.3033V5.03235C41.2033 3.67355 43.1721 2.92969 45.2564 2.92969H45.5078ZM30.8594 2.92969H31.1108C33.1944 2.92969 35.1643 3.67126 36.7188 5.0293V16.3029C35.025 15.3503 33.107 14.8438 31.1108 14.8438H30.8594V2.92969Z"
                                    fill="currentColor" />
                                <path
                                    d="M3.02734 50H46.9727C47.7818 50 48.4375 49.3443 48.4375 48.5352V33.8867C48.4375 33.0776 47.7818 32.4219 46.9727 32.4219H33.6418C32.9613 29.0829 30.0018 26.5625 26.4648 26.5625H22.0703V25.0675C23.896 23.6919 25 21.5286 25 19.2383V16.6222C25 12.8906 22.3755 9.64966 18.895 9.08356C14.397 8.3519 10.3516 11.7859 10.3516 16.3086V19.2383C10.3516 21.5286 11.4555 23.6919 13.2812 25.0675V26.5625H8.88672C4.8481 26.5625 1.5625 29.8481 1.5625 33.8867V48.5352C1.5625 49.3443 2.21825 50 3.02734 50ZM45.5078 47.0703H25V35.3516H45.5078V47.0703ZM13.2812 16.3086C13.2812 13.6845 15.6109 11.5177 18.4246 11.9755C20.5029 12.3135 22.0703 14.3112 22.0703 16.6222V19.2383C22.0703 20.8031 21.2471 22.2164 19.8685 23.019C19.418 23.2811 19.1406 23.7633 19.1406 24.2851V27.4204L17.6758 28.8853L16.2109 27.4204V24.2851C16.2109 23.7637 15.9336 23.2811 15.4831 23.019C14.1045 22.2164 13.2812 20.8031 13.2812 19.2383V16.3086ZM4.49219 33.8867C4.49219 31.4636 6.46362 29.4922 8.88672 29.4922H14.1392L16.6401 31.9927C16.9258 32.2788 17.3008 32.4219 17.6758 32.4219C18.0508 32.4219 18.4258 32.2788 18.7115 31.9927L21.2124 29.4922H26.4648C28.3745 29.4922 30.0026 30.7167 30.6076 32.4219H23.5352C22.7261 32.4219 22.0703 33.0776 22.0703 33.8867V42.6796C20.8454 41.758 19.3233 41.2109 17.6758 41.2109H10.3516V33.8867C10.3516 33.0776 9.69582 32.4219 8.88672 32.4219C8.07762 32.4219 7.42188 33.0776 7.42188 33.8867V42.6758C7.42188 43.4849 8.07762 44.1406 8.88672 44.1406H17.6758C19.5858 44.1406 21.2147 45.3652 21.8193 47.0703H4.49219V33.8867Z"
                                    fill="currentColor" />
                            </svg>

                        </div>
                    </div>

                    <h4>เรียนรู้กับผู้เชี่ยวชาญ</h4>
                    <p class="px-lg-7 px-xl-8">ผู้สอนเป็นผู้เชี่ยวชาญที่ผ่านงานจริงมาแล้ว</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURED PRODUCT
    ================================================== -->
    <section class="pt-5 pb-9 py-md-11 bg-white">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-md mb-2 mb-md-0">
                    <h1 class="mb-1">หลักสูตรแนะนำ</h1>
                    <p class="font-size-lg text-capitalize"></p>
                </div>
                <div class="col-md-auto">
                    {{-- <select class="form-select form-select-sm text-primary fw-medium shadow" data-choices>
                        <option>All Subjects</option>
                    </select> --}}
                </div>
            </div>

            <div class="row row-cols-md-2 row-cols-xl-3 mb-2">
                @foreach ($courses_trending as $c)
                    <div class="col-md pb-4 pb-md-7">
                        <!-- Card -->
                        <div class="card border shadow lift sk-fade">
                            <!-- Image -->
                            <div class="card-zoom position-relative rounded-bottom-0">
                                <div class="badge-float sk-fade-top top-0 right-0 mt-4 me-4">
                                    <a href="{{ url('course_online_view/' . $c->id) }}"
                                        class="btn btn-xs btn-dark text-white rounded-circle lift opacity-dot-7 me-1 p-2 d-inline-flex justify-content-center align-items-center w-36 h-36">
                                        <!-- Icon -->
                                        <svg width="18" height="18" viewBox="0 0 18 18"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.8856 8.64995C17.7248 8.42998 13.8934 3.26379 8.99991 3.26379C4.10647 3.26379 0.274852 8.42998 0.114223 8.64974C-0.0380743 8.85843 -0.0380743 9.14147 0.114223 9.35016C0.274852 9.57013 4.10647 14.7363 8.99991 14.7363C13.8934 14.7363 17.7248 9.5701 17.8856 9.35034C18.0381 9.14169 18.0381 8.85843 17.8856 8.64995ZM8.99991 13.5495C5.39537 13.5495 2.27345 10.1206 1.3493 8.99965C2.27226 7.87771 5.38764 4.4506 8.99991 4.4506C12.6043 4.4506 15.726 7.8789 16.6505 9.00046C15.7276 10.1224 12.6122 13.5495 8.99991 13.5495Z"
                                                fill="currentColor" />
                                            <path
                                                d="M8.9999 5.43958C7.03671 5.43958 5.43945 7.03683 5.43945 9.00003C5.43945 10.9632 7.03671 12.5605 8.9999 12.5605C10.9631 12.5605 12.5603 10.9632 12.5603 9.00003C12.5603 7.03683 10.9631 5.43958 8.9999 5.43958ZM8.9999 11.3736C7.69103 11.3736 6.62629 10.3089 6.62629 9.00003C6.62629 7.6912 7.69107 6.62642 8.9999 6.62642C10.3087 6.62642 11.3735 7.6912 11.3735 9.00003C11.3735 10.3089 10.3088 11.3736 8.9999 11.3736Z"
                                                fill="currentColor" />
                                        </svg>

                                    </a>
                                    <a href="{{ url('course_online_view/' . $c->id) }}"
                                        class="btn btn-xs btn-dark text-white rounded-circle lift opacity-dot-7 p-2 d-inline-flex justify-content-center align-items-center w-36 h-36">
                                        <!-- Icon -->
                                        <svg width="16" height="16" viewBox="0 0 16 16"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.2437 1.20728C10.0203 1.20728 8.87397 1.66486 7.99998 2.48357C7.12598 1.66486 5.97968 1.20728 4.7563 1.20728C2.13368 1.20728 0 3.341 0 5.96366C0 7.2555 0.425164 8.52729 1.26366 9.74361C1.91197 10.6841 2.80887 11.5931 3.92937 12.4454C5.809 13.8753 7.66475 14.6543 7.74285 14.6867L7.99806 14.7928L8.25384 14.6881C8.33199 14.6562 10.1889 13.8882 12.0696 12.4635C13.1907 11.6142 14.0881 10.7054 14.7367 9.7625C15.575 8.54385 16 7.26577 16 5.96371C16 3.341 13.8663 1.20728 11.2437 1.20728ZM8.00141 13.3353C6.74962 12.7555 1.33966 10.0142 1.33966 5.96366C1.33966 4.07969 2.87237 2.54698 4.75634 2.54698C5.827 2.54698 6.81558 3.03502 7.46862 3.88598L8.00002 4.57845L8.53142 3.88598C9.18446 3.03502 10.173 2.54698 11.2437 2.54698C13.1276 2.54698 14.6604 4.07969 14.6604 5.96366C14.6603 10.0433 9.25265 12.7613 8.00141 13.3353Z"
                                                fill="currentColor" />
                                        </svg>

                                    </a>
                                </div>

                                <a href="{{ url('course_online_view/' . $c->id) }}"
                                    class="card-img sk-thumbnail d-block rounded-bottom-0">
                                    <img class="shadow-light-lg" src="{{ asset('images/profile/' . $c->image) }}"
                                        alt="..."
                                        style="
                                width: 337px;
                                height: 242px;
                                object-fit: cover;
                              ">
                                </a>

                                <span
                                    class="badge sk-fade-bottom badge-lg badge-orange badge-pill badge-float bottom-0 left-0 mb-4 ms-4">
                                    <span class="text-white text-uppercase fw-bold font-size-xs">BEST SELLER</span>
                                </span>
                            </div>

                            <!-- Footer -->
                            <div class="card-footer p-4 position-relative">
                                <a href="#" class="d-block">
                                    <div
                                        class="avatar avatar-xl badge-float position-absolute top-0 right-0 mt-n6 me-5 rounded-circle shadow border border-white border-w-lg">
                                        <img src="{{ asset('images/profile/' . $c->Profile->image_profile) }}"
                                            alt="..." class="avatar-img rounded-circle">
                                    </div>
                                </a>

                                <!-- Preheading -->
                                <a href="{{ url('course_online_view/' . $c->id) }}"><span
                                        class="mb-1 d-inline-block text-gray-800">{{ @$c->CategoryCourse->name }}</span></a>


                                <!-- Heading -->
                                <div class="position-relative">
                                    <a href="{{ url('course_online_view/' . $c->id) }}"
                                        class="d-block stretched-link">
                                        <h4 class="line-clamp-2 h-md-48 h-lg-58 me-md-6 me-lg-10 me-xl-4">
                                            {{ $c->name }}</h4>
                                    </a>

                                    <div class="row mx-n2 align-items-end">
                                        <div class="col px-2">
                                            <div class="d-lg-flex align-items-end mb-4">
                                                <div class="star-rating mb-2 mb-lg-0">
                                                    <div class="rating" style="width:50%;"></div>
                                                </div>

                                                <div class="font-size-sm ms-lg-3">
                                                    <span>3 (1 reviews)</span>
                                                </div>
                                            </div>

                                            <ul class="nav mx-n3">
                                                <li class="nav-item px-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="me-2 d-flex">
                                                            <!-- Icon -->
                                                            <svg width="20" height="20" viewBox="0 0 20 20"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M17.1947 7.06802L14.6315 7.9985C14.2476 7.31186 13.712 6.71921 13.0544 6.25992C12.8525 6.11877 12.6421 5.99365 12.4252 5.88303C13.0586 5.25955 13.452 4.39255 13.452 3.43521C13.452 1.54098 11.9124 -1.90735e-06 10.0197 -1.90735e-06C8.12714 -1.90735e-06 6.58738 1.54098 6.58738 3.43521C6.58738 4.39255 6.98075 5.25955 7.61414 5.88303C7.39731 5.99365 7.1869 6.11877 6.98502 6.25992C6.32752 6.71921 5.79178 7.31186 5.40787 7.9985L2.8447 7.06802C2.33612 6.88339 1.79688 7.26044 1.79688 7.80243V16.5178C1.79688 16.8465 2.00256 17.14 2.31155 17.2522L9.75312 19.9536C9.93073 20.018 10.1227 20.0128 10.2863 19.9536L17.7278 17.2522C18.0368 17.14 18.2425 16.8465 18.2425 16.5178V7.80243C18.2425 7.26135 17.704 6.88309 17.1947 7.06802ZM10.0197 1.5625C11.0507 1.5625 11.8895 2.40265 11.8895 3.43521C11.8895 4.46777 11.0507 5.30792 10.0197 5.30792C8.98866 5.30792 8.14988 4.46777 8.14988 3.43521C8.14988 2.40265 8.98866 1.5625 10.0197 1.5625ZM9.23844 18.1044L3.35938 15.9703V8.91724L9.23844 11.0513V18.1044ZM10.0197 9.67255L6.90644 8.54248C7.58164 7.51892 8.75184 6.87042 10.0197 6.87042C11.2875 6.87042 12.4577 7.51892 13.1329 8.54248L10.0197 9.67255ZM16.68 15.9703L10.8009 18.1044V11.0513L16.68 8.91724V15.9703Z"
                                                                    fill="currentColor" />
                                                            </svg>

                                                        </div>
                                                        <div class="font-size-sm">5 lessons</div>
                                                    </div>
                                                </li>
                                                <li class="nav-item px-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="me-2 d-flex text-secondary">
                                                            <!-- Icon -->
                                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M14.3164 4.20996C13.985 4.37028 13.8464 4.76904 14.0067 5.10026C14.4447 6.00505 14.6667 6.98031 14.6667 8C14.6667 11.6759 11.6759 14.6667 8 14.6667C4.32406 14.6667 1.33333 11.6759 1.33333 8C1.33333 4.32406 4.32406 1.33333 8 1.33333C9.52328 1.33333 10.9543 1.83073 12.1387 2.77165C12.4259 3.00098 12.846 2.95296 13.0754 2.66471C13.3047 2.37663 13.2567 1.95703 12.9683 1.72803C11.5661 0.613607 9.8016 0 8 0C3.58903 0 0 3.58903 0 8C0 12.411 3.58903 16 8 16C12.411 16 16 12.411 16 8C16 6.77767 15.7331 5.60628 15.2067 4.51969C15.0467 4.18766 14.6466 4.04932 14.3164 4.20996Z"
                                                                    fill="currentColor" />
                                                                <path
                                                                    d="M7.99967 2.66663C7.63167 2.66663 7.33301 2.96529 7.33301 3.33329V7.99996C7.33301 8.36796 7.63167 8.66663 7.99967 8.66663H11.333C11.701 8.66663 11.9997 8.36796 11.9997 7.99996C11.9997 7.63196 11.701 7.33329 11.333 7.33329H8.66634V3.33329C8.66634 2.96529 8.36768 2.66663 7.99967 2.66663Z"
                                                                    fill="currentColor" />
                                                            </svg>

                                                        </div>
                                                        <div class="font-size-sm">8h 12m</div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="col-auto px-2 text-right">
                                            <del class="font-size-sm"></del>
                                            <ins class="h4 mb-0 d-block mb-lg-n1">Free</ins>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- TESTIMONIAL
    ================================================== -->
    {{-- <section class="py-8 py-md-11 pb-xl-12 position-relative bg-white-ice">
        <div class="container position-relative">
            <div class="text-center mb-md-10 mb-5 text-capitalize">
                <h1 class="mb-1">What Our Students Have To Say</h1>
                <p class="font-size-lg mb-0">Discover your perfect program in our courses.</p>
            </div>

            <div class="tab-content text-center mb-md-11 mb-8 w-xl-75 mx-auto" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                    aria-labelledby="pills-home-tab">
                    <div class="position-relative">
                        <div class="card-float top-0 left-0 mt-n6 ms-n11 text-dark-10 icon">
                            <!-- Icon -->
                            <svg width="36" height="23" viewBox="0 0 36 23"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.5 23L15.5 -4.76837e-06H10L2.98023e-08 23H9.5ZM29.5 23L35.5 -4.76837e-06H30L20 23H29.5Z"
                                    fill="currentColor" />
                            </svg>

                        </div>
                        <p class="mb-0 text-capitalize h4 text-gray-800 fw-normal ">I believe in lifelong learning and
                            Skola is a great place to learn from experts. I've learned a lot and recommend it to all my
                            friends.Programs are available in fall, spring, and summer semesters. Many fall and spring
                            programs offer similar shorter programs in the summer, and some may be combined for a full
                            academic year.</p>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="position-relative">
                        <div class="card-float top-0 left-0 mt-n6 ms-n11 text-dark-10 icon">
                            <!-- Icon -->
                            <svg width="36" height="23" viewBox="0 0 36 23"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.5 23L15.5 -4.76837e-06H10L2.98023e-08 23H9.5ZM29.5 23L35.5 -4.76837e-06H30L20 23H29.5Z"
                                    fill="currentColor" />
                            </svg>

                        </div>
                        <p class="mb-0 text-capitalize h4 text-gray-800 fw-normal ">I believe in lifelong learning and
                            Skola is a great place to learn from experts. I've learned a lot and recommend it to all my
                            friends.Programs are available in fall, spring, and summer semesters. Many fall and spring
                            programs offer similar shorter programs in the summer, and some may be combined for a full
                            academic year.</p>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="position-relative">
                        <div class="card-float top-0 left-0 mt-n6 ms-n11 text-dark-10 icon">
                            <!-- Icon -->
                            <svg width="36" height="23" viewBox="0 0 36 23"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.5 23L15.5 -4.76837e-06H10L2.98023e-08 23H9.5ZM29.5 23L35.5 -4.76837e-06H30L20 23H29.5Z"
                                    fill="currentColor" />
                            </svg>

                        </div>
                        <p class="mb-0 text-capitalize h4 text-gray-800 fw-normal ">I believe in lifelong learning and
                            Skola is a great place to learn from experts. I've learned a lot and recommend it to all my
                            friends.Programs are available in fall, spring, and summer semesters. Many fall and spring
                            programs offer similar shorter programs in the summer, and some may be combined for a full
                            academic year.</p>
                    </div>
                </div>
            </div>

            <ul class="nav row" id="pills-tab" role="tablist">
                <li class="nav-item col-md-4 mb-4 mb-md-0" role="presentation">
                    <a class="nav-link p-0 active" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home"
                        role="tab" aria-controls="pills-home" aria-selected="true">
                        <!-- Card -->
                        <div class="card border p-2 lift rounded-pill">
                            <div class="row gx-0 align-items-center">
                                <div class="col-auto">
                                    <div class="avatar avatar-custom">
                                        <img src="assets/img/avatars/avatar-1.jpg" alt="..."
                                            class="avatar-img rounded-circle img-fluid">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card-body p-0 ms-5">
                                        <h5 class="mb-0">Albert Cole</h5>
                                        <span class="text-gray-800">Designer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item col-md-4 mb-4 mb-md-0" role="presentation">
                    <a class="nav-link p-0" id="pills-profile-tab" data-bs-toggle="pill" href="#pills-profile"
                        role="tab" aria-controls="pills-profile" aria-selected="false">
                        <!-- Card -->
                        <div class="card border p-2 lift rounded-pill">
                            <div class="row gx-0 align-items-center">
                                <div class="col-auto">
                                    <div class="avatar avatar-custom">
                                        <img src="assets/img/avatars/avatar-2.jpg" alt="..."
                                            class="avatar-img rounded-circle img-fluid">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card-body p-0 ms-5">
                                        <h5 class="mb-0">Alison Dawn</h5>
                                        <span class="text-gray-800">WordPress Developer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item col-md-4 mb-4 mb-md-0" role="presentation">
                    <a class="nav-link p-0" id="pills-contact-tab" data-bs-toggle="pill" href="#pills-contact"
                        role="tab" aria-controls="pills-contact" aria-selected="false">
                        <!-- Card -->
                        <div class="card border p-2 lift rounded-pill">
                            <div class="row gx-0 align-items-center">
                                <div class="col-auto">
                                    <div class="avatar avatar-custom">
                                        <img src="assets/img/avatars/avatar-3.jpg" alt="..."
                                            class="avatar-img rounded-circle img-fluid">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card-body p-0 ms-5">
                                        <h5 class="mb-0">Daniel Parker</h5>
                                        <span class="text-gray-800">Front-end Developer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </section> --}}

    <!-- VIDEO
    ================================================== -->
    <section class="py-12 py-md-14 jarallax" data-jarallax data-speed=".8"
        style="background-image: url(assets/img/covers/cover-8.jpg);">
        <div class="container">
            <div class="rounded text-center">
                <h1 class="mb-1 text-white">ตัวอย่างของคอร์สเรียนของเรา</h1>
                <p class="font-size-lg mb-8 text-white-70">วิดิโอจากบทเรียนของเรา</p>
                <!-- Button -->
                <a href="https://www.youtube.com/watch?v=9I-Y6VQ6tyI"
                    class="btn h-90p w-90p size-30-all rounded-circle btn-white d-inline-flex align-items-center justify-content-center shadow lift"
                    data-fancybox>
                    <!-- Icon -->
                    <svg width="14" height="16" viewBox="0 0 14 16" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12.8704 6.15374L3.42038 0.328572C2.73669 -0.0923355 1.9101 -0.109836 1.20919 0.281759C0.508282 0.673291 0.0898438 1.38645 0.0898438 2.18929V13.7866C0.0898438 15.0005 1.06797 15.9934 2.27016 16C2.27344 16 2.27672 16 2.27994 16C2.65563 16 3.04713 15.8822 3.41279 15.6591C3.70694 15.4796 3.79991 15.0957 3.62044 14.8016C3.44098 14.5074 3.05697 14.4144 2.76291 14.5939C2.59188 14.6982 2.42485 14.7522 2.27688 14.7522C1.82328 14.7497 1.33763 14.3611 1.33763 13.7866V2.18933C1.33763 1.84492 1.51713 1.53907 1.81775 1.3711C2.11841 1.20314 2.47294 1.21064 2.76585 1.39098L12.2159 7.21615C12.4999 7.39102 12.6625 7.68262 12.6618 8.01618C12.6611 8.34971 12.4974 8.64065 12.2118 8.81493L5.37935 12.9983C5.08548 13.1783 4.9931 13.5623 5.17304 13.8562C5.35295 14.1501 5.73704 14.2424 6.03092 14.0625L12.8625 9.87962C13.5166 9.48059 13.9081 8.78496 13.9096 8.01868C13.9112 7.25249 13.5226 6.55524 12.8704 6.15374Z"
                            fill="currentColor" />
                    </svg>

                </a>
            </div>
        </div> <!-- / .container -->
    </section>


    <!-- BLOG
    ================================================== -->
    <section class="bg-white-ice py-5 py-md-11">
        <div class="container">
            <div class="row align-items-end mb-4 mb-md-7">
                <div class="col-md mb-4 mb-md-0">
                    <h1 class="mb-1">หลักสูตรล่าสุด</h1>
                    <p class="font-size-lg mb-0 text-capitalize">Discover your perfect program in our courses.</p>
                </div>
                <div class="col-md-auto">
                    <a href="./blog-list-v1.html" class="d-flex align-items-center fw-medium">
                        Browse All
                        <div class="ms-2 d-flex">
                            <!-- Icon -->
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.7779 4.6098L3.32777 0.159755C3.22485 0.0567475 3.08745 0 2.94095 0C2.79445 0 2.65705 0.0567475 2.55412 0.159755L2.2264 0.487394C2.01315 0.700889 2.01315 1.04788 2.2264 1.26105L5.96328 4.99793L2.22225 8.73895C2.11933 8.84196 2.0625 8.97928 2.0625 9.1257C2.0625 9.27228 2.11933 9.4096 2.22225 9.51269L2.54998 9.84025C2.65298 9.94325 2.7903 10 2.9368 10C3.0833 10 3.2207 9.94325 3.32363 9.84025L7.7779 5.38614C7.88107 5.2828 7.93774 5.14484 7.93741 4.99817C7.93774 4.85094 7.88107 4.71305 7.7779 4.6098Z"
                                    fill="currentColor" />
                            </svg>

                        </div>
                    </a>
                </div>
            </div>

            <div class="row row-cols-md-2 row-cols-lg-3">
                @foreach ($courses_lates as $c)
              <div class="col-md pb-4 pb-md-7">
                        <!-- Card -->
                        <div class="card border shadow lift sk-fade">
                            <!-- Image -->
                            <div class="card-zoom position-relative rounded-bottom-0">
                                <div class="badge-float sk-fade-top top-0 right-0 mt-4 me-4">
                                    <a href="{{ url('course_online_view/' . $c->id) }}"
                                        class="btn btn-xs btn-dark text-white rounded-circle lift opacity-dot-7 me-1 p-2 d-inline-flex justify-content-center align-items-center w-36 h-36">
                                        <!-- Icon -->
                                        <svg width="18" height="18" viewBox="0 0 18 18"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.8856 8.64995C17.7248 8.42998 13.8934 3.26379 8.99991 3.26379C4.10647 3.26379 0.274852 8.42998 0.114223 8.64974C-0.0380743 8.85843 -0.0380743 9.14147 0.114223 9.35016C0.274852 9.57013 4.10647 14.7363 8.99991 14.7363C13.8934 14.7363 17.7248 9.5701 17.8856 9.35034C18.0381 9.14169 18.0381 8.85843 17.8856 8.64995ZM8.99991 13.5495C5.39537 13.5495 2.27345 10.1206 1.3493 8.99965C2.27226 7.87771 5.38764 4.4506 8.99991 4.4506C12.6043 4.4506 15.726 7.8789 16.6505 9.00046C15.7276 10.1224 12.6122 13.5495 8.99991 13.5495Z"
                                                fill="currentColor" />
                                            <path
                                                d="M8.9999 5.43958C7.03671 5.43958 5.43945 7.03683 5.43945 9.00003C5.43945 10.9632 7.03671 12.5605 8.9999 12.5605C10.9631 12.5605 12.5603 10.9632 12.5603 9.00003C12.5603 7.03683 10.9631 5.43958 8.9999 5.43958ZM8.9999 11.3736C7.69103 11.3736 6.62629 10.3089 6.62629 9.00003C6.62629 7.6912 7.69107 6.62642 8.9999 6.62642C10.3087 6.62642 11.3735 7.6912 11.3735 9.00003C11.3735 10.3089 10.3088 11.3736 8.9999 11.3736Z"
                                                fill="currentColor" />
                                        </svg>

                                    </a>
                                    <a href="{{ url('course_online_view/' . $c->id) }}"
                                        class="btn btn-xs btn-dark text-white rounded-circle lift opacity-dot-7 p-2 d-inline-flex justify-content-center align-items-center w-36 h-36">
                                        <!-- Icon -->
                                        <svg width="16" height="16" viewBox="0 0 16 16"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.2437 1.20728C10.0203 1.20728 8.87397 1.66486 7.99998 2.48357C7.12598 1.66486 5.97968 1.20728 4.7563 1.20728C2.13368 1.20728 0 3.341 0 5.96366C0 7.2555 0.425164 8.52729 1.26366 9.74361C1.91197 10.6841 2.80887 11.5931 3.92937 12.4454C5.809 13.8753 7.66475 14.6543 7.74285 14.6867L7.99806 14.7928L8.25384 14.6881C8.33199 14.6562 10.1889 13.8882 12.0696 12.4635C13.1907 11.6142 14.0881 10.7054 14.7367 9.7625C15.575 8.54385 16 7.26577 16 5.96371C16 3.341 13.8663 1.20728 11.2437 1.20728ZM8.00141 13.3353C6.74962 12.7555 1.33966 10.0142 1.33966 5.96366C1.33966 4.07969 2.87237 2.54698 4.75634 2.54698C5.827 2.54698 6.81558 3.03502 7.46862 3.88598L8.00002 4.57845L8.53142 3.88598C9.18446 3.03502 10.173 2.54698 11.2437 2.54698C13.1276 2.54698 14.6604 4.07969 14.6604 5.96366C14.6603 10.0433 9.25265 12.7613 8.00141 13.3353Z"
                                                fill="currentColor" />
                                        </svg>

                                    </a>
                                </div>

                                <a href="{{ url('course_online_view/' . $c->id) }}"
                                    class="card-img sk-thumbnail d-block rounded-bottom-0">
                                    <img class="shadow-light-lg" src="{{ asset('images/profile/' . $c->image) }}"
                                        alt="..."
                                        style="
                                width: 337px;
                                height: 242px;
                                object-fit: cover;
                              ">
                                </a>

                                <span
                                    class="badge sk-fade-bottom badge-lg badge-orange badge-pill badge-float bottom-0 left-0 mb-4 ms-4">
                                    <span class="text-white text-uppercase fw-bold font-size-xs">BEST SELLER</span>
                                </span>
                            </div>

                            <!-- Footer -->
                            <div class="card-footer p-4 position-relative">
                                <a href="#" class="d-block">
                                    <div
                                        class="avatar avatar-xl badge-float position-absolute top-0 right-0 mt-n6 me-5 rounded-circle shadow border border-white border-w-lg">
                                        <img src="{{ asset('images/profile/' . $c->Profile->image_profile) }}"
                                            alt="..." class="avatar-img rounded-circle">
                                    </div>
                                </a>

                                <!-- Preheading -->
                                <a href="{{ url('course_online_view/' . $c->id) }}"><span
                                        class="mb-1 d-inline-block text-gray-800">{{ @$c->CategoryCourse->name }}</span></a>


                                <!-- Heading -->
                                <div class="position-relative">
                                    <a href="{{ url('course_online_view/' . $c->id) }}"
                                        class="d-block stretched-link">
                                        <h4 class="line-clamp-2 h-md-48 h-lg-58 me-md-6 me-lg-10 me-xl-4">
                                            {{ $c->name }}</h4>
                                    </a>

                                    <div class="row mx-n2 align-items-end">
                                        <div class="col px-2">
                                            <div class="d-lg-flex align-items-end mb-4">
                                                <div class="star-rating mb-2 mb-lg-0">
                                                    <div class="rating" style="width:50%;"></div>
                                                </div>

                                                <div class="font-size-sm ms-lg-3">
                                                    <span>3 (1 reviews)</span>
                                                </div>
                                            </div>

                                            <ul class="nav mx-n3">
                                                <li class="nav-item px-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="me-2 d-flex">
                                                            <!-- Icon -->
                                                            <svg width="20" height="20" viewBox="0 0 20 20"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M17.1947 7.06802L14.6315 7.9985C14.2476 7.31186 13.712 6.71921 13.0544 6.25992C12.8525 6.11877 12.6421 5.99365 12.4252 5.88303C13.0586 5.25955 13.452 4.39255 13.452 3.43521C13.452 1.54098 11.9124 -1.90735e-06 10.0197 -1.90735e-06C8.12714 -1.90735e-06 6.58738 1.54098 6.58738 3.43521C6.58738 4.39255 6.98075 5.25955 7.61414 5.88303C7.39731 5.99365 7.1869 6.11877 6.98502 6.25992C6.32752 6.71921 5.79178 7.31186 5.40787 7.9985L2.8447 7.06802C2.33612 6.88339 1.79688 7.26044 1.79688 7.80243V16.5178C1.79688 16.8465 2.00256 17.14 2.31155 17.2522L9.75312 19.9536C9.93073 20.018 10.1227 20.0128 10.2863 19.9536L17.7278 17.2522C18.0368 17.14 18.2425 16.8465 18.2425 16.5178V7.80243C18.2425 7.26135 17.704 6.88309 17.1947 7.06802ZM10.0197 1.5625C11.0507 1.5625 11.8895 2.40265 11.8895 3.43521C11.8895 4.46777 11.0507 5.30792 10.0197 5.30792C8.98866 5.30792 8.14988 4.46777 8.14988 3.43521C8.14988 2.40265 8.98866 1.5625 10.0197 1.5625ZM9.23844 18.1044L3.35938 15.9703V8.91724L9.23844 11.0513V18.1044ZM10.0197 9.67255L6.90644 8.54248C7.58164 7.51892 8.75184 6.87042 10.0197 6.87042C11.2875 6.87042 12.4577 7.51892 13.1329 8.54248L10.0197 9.67255ZM16.68 15.9703L10.8009 18.1044V11.0513L16.68 8.91724V15.9703Z"
                                                                    fill="currentColor" />
                                                            </svg>

                                                        </div>
                                                        <div class="font-size-sm">5 lessons</div>
                                                    </div>
                                                </li>
                                                <li class="nav-item px-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="me-2 d-flex text-secondary">
                                                            <!-- Icon -->
                                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M14.3164 4.20996C13.985 4.37028 13.8464 4.76904 14.0067 5.10026C14.4447 6.00505 14.6667 6.98031 14.6667 8C14.6667 11.6759 11.6759 14.6667 8 14.6667C4.32406 14.6667 1.33333 11.6759 1.33333 8C1.33333 4.32406 4.32406 1.33333 8 1.33333C9.52328 1.33333 10.9543 1.83073 12.1387 2.77165C12.4259 3.00098 12.846 2.95296 13.0754 2.66471C13.3047 2.37663 13.2567 1.95703 12.9683 1.72803C11.5661 0.613607 9.8016 0 8 0C3.58903 0 0 3.58903 0 8C0 12.411 3.58903 16 8 16C12.411 16 16 12.411 16 8C16 6.77767 15.7331 5.60628 15.2067 4.51969C15.0467 4.18766 14.6466 4.04932 14.3164 4.20996Z"
                                                                    fill="currentColor" />
                                                                <path
                                                                    d="M7.99967 2.66663C7.63167 2.66663 7.33301 2.96529 7.33301 3.33329V7.99996C7.33301 8.36796 7.63167 8.66663 7.99967 8.66663H11.333C11.701 8.66663 11.9997 8.36796 11.9997 7.99996C11.9997 7.63196 11.701 7.33329 11.333 7.33329H8.66634V3.33329C8.66634 2.96529 8.36768 2.66663 7.99967 2.66663Z"
                                                                    fill="currentColor" />
                                                            </svg>

                                                        </div>
                                                        <div class="font-size-sm">8h 12m</div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="col-auto px-2 text-right">
                                            <del class="font-size-sm"></del>
                                            <ins class="h4 mb-0 d-block mb-lg-n1">Free</ins>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

            </div>
        </div>
    </section>

    @include('frontend_new.footer')

</body>

</html>
