<!doctype html>
<html lang="th">

<head>
    @include('frontend_new.header')


</head>

<body>


    @include('frontend_new.menu')

    <img src="{{ asset('images/profile/' . $course->image) }}" style="  width: 100%;"><br>

    <div class="container">
        <div id="Curriculum" class="mb-8">
            <ul class="nav course-tab-v1 border-bottom h4 mb-8">
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#Overview" data-bs-toggle="smooth-scroll" data-bs-offset="0">Overview</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link active" href="#Curriculum" data-bs-toggle="smooth-scroll"
                        data-bs-offset="0">เนื้อหาหลักสูตร</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#Instructor" data-bs-toggle="smooth-scroll"
                        data-bs-offset="0">Instructor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Reviews" data-bs-toggle="smooth-scroll" data-bs-offset="0">Reviews</a>
                </li> --}}
            </ul>

            <div class="container">
                <h3 class="">{{ $course->name }}</h3>
                <p class="mb-6 line-height-md">{!! $course->detail !!}</p>
            </div>

            <div id="accordionCurriculum">

                @foreach ($chapter as $key => $chap)
                    <div class="border rounded shadow mb-6 overflow-hidden">
                        <div class="d-flex align-items-center" id="curriculumheadingOne{{ $key }}">
                            <h5 class="mb-0 w-100">
                                <button
                                    class="d-flex align-items-center p-5 min-height-80 text-dark fw-medium collapse-accordion-toggle line-height-one"
                                    type="button" data-bs-toggle="collapse"
                                    data-bs-target="#CurriculumcollapseOne{{ $key }}" aria-expanded="true"
                                    aria-controls="CurriculumcollapseOne{{ $key }}">
                                    <span class="me-4 text-dark d-flex">
                                        <!-- Icon -->
                                        <svg width="15" height="2" viewBox="0 0 15 2" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect width="15" height="2" fill="currentColor" />
                                        </svg>

                                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 7H15V9H0V7Z" fill="currentColor" />
                                            <path d="M6 16L6 8.74228e-08L8 0L8 16H6Z" fill="currentColor" />
                                        </svg>

                                    </span>

                                    บทเรียนที่ {{ $chap->order }} {{ $chap->name }}
                                </button>
                            </h5>
                        </div>

                        <?php
                        $list = \App\Models\CourseList::where('course_id', $chap->course_id)
                            ->where('chapter_id', $chap->id)
                            ->get();
                        ?>

                        @foreach ($list as $key2 => $l)
                            <div id="CurriculumcollapseOne{{ $key }}" class="collapse show"
                                aria-labelledby="curriculumheadingOne{{ $key }}"
                                data-parent="#accordionCurriculum">
                                <div class="border-top px-5 py-4 min-height-70 d-md-flex align-items-center">
                                    <div class="d-flex align-items-center me-auto mb-4 mb-md-0">
                                        <div class="text-secondary d-flex">
                                            <svg width="14" height="18" viewBox="0 0 14 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.5717 0H4.16956C4.05379 0.00594643 3.94322 0.0496071 3.85456 0.124286L0.413131 3.57857C0.328167 3.65957 0.280113 3.77191 0.280274 3.88929V16.8514C0.281452 17.4853 0.794988 17.9988 1.42885 18H12.5717C13.1981 17.9989 13.7086 17.497 13.7203 16.8707V1.14857C13.7191 0.514714 13.2056 0.00117857 12.5717 0ZM8.18099 0.857143H10.6988V4.87714L9.80527 3.45214C9.76906 3.39182 9.71859 3.3413 9.65827 3.30514C9.45529 3.18337 9.19204 3.24916 9.07027 3.45214L8.18099 4.87071V0.857143ZM3.7367 1.46786V2.66143C3.73552 3.10002 3.38029 3.45525 2.9417 3.45643H1.74813L3.7367 1.46786ZM12.8546 16.86C12.8534 17.0157 12.7274 17.1417 12.5717 17.1429H1.42885C1.42665 17.1429 1.42445 17.143 1.42226 17.143C1.26486 17.1441 1.13635 17.0174 1.13527 16.86V4.32214H2.9417C3.85793 4.31979 4.60006 3.57766 4.60242 2.66143V0.857143H7.31527V5.23286C7.31345 5.42593 7.37688 5.61391 7.49527 5.76643C7.67533 5.99539 7.98036 6.08561 8.25599 5.99143L8.28813 5.98071C8.49272 5.89484 8.66356 5.7443 8.77456 5.55214L9.44099 4.48071L10.1074 5.55214C10.2184 5.7443 10.3893 5.89484 10.5938 5.98071C10.8764 6.0922 11.1987 6.00509 11.3867 5.76643C11.5051 5.61391 11.5685 5.42593 11.5667 5.23286V0.857143H12.5717C12.7266 0.858268 12.8523 0.982982 12.8546 1.13786V16.86Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M10.7761 14.3143H3.22252C2.98584 14.3143 2.79395 14.5062 2.79395 14.7429C2.79395 14.9796 2.98584 15.1715 3.22252 15.1715H10.7761C11.0128 15.1715 11.2047 14.9796 11.2047 14.7429C11.2047 14.5062 11.0128 14.3143 10.7761 14.3143Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M10.7761 12.2035H3.22252C2.98584 12.2035 2.79395 12.3954 2.79395 12.6321C2.79395 12.8687 2.98584 13.0606 3.22252 13.0606H10.7761C11.0128 13.0606 11.2047 12.8687 11.2047 12.6321C11.2047 12.3954 11.0128 12.2035 10.7761 12.2035Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M10.7761 10.0928H3.22252C2.98584 10.0928 2.79395 10.2847 2.79395 10.5213C2.79395 10.758 2.98584 10.9499 3.22252 10.9499H10.7761C11.0128 10.9499 11.2047 10.758 11.2047 10.5213C11.2047 10.2847 11.0128 10.0928 10.7761 10.0928Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M10.7761 7.98218H3.22252C2.98584 7.98218 2.79395 8.17407 2.79395 8.41075C2.79395 8.64743 2.98584 8.83932 3.22252 8.83932H10.7761C11.0128 8.83932 11.2047 8.64743 11.2047 8.41075C11.2047 8.17407 11.0128 7.98218 10.7761 7.98218Z"
                                                    fill="currentColor" />
                                            </svg>

                                        </div>

                                        <div class="ms-4">
                                            {{ $l->course_name }}
                                        </div>
                                    </div>

                                    <div
                                        class="d-flex align-items-center overflow-auto overflow-md-visible flex-shrink-all">
                                        {{-- <div class="badge text-dark-70 bg-orange-40 me-5 font-size-sm fw-normal py-2">3
                                            question
                                        </div> --}}
                                        <div class="badge btn-blue-soft me-5 font-size-sm fw-normal py-2">
                                            {{ $l->course_time }} นาที</div>
                                        <a href="{{ url('course_online_inside_view/' . $l->id) }}"
                                            class="text-secondary d-flex">
                                            <!-- Icon -->
                                            <svg width="14" height="16" viewBox="0 0 14 16"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.8704 6.15374L3.42038 0.328572C2.73669 -0.0923355 1.9101 -0.109836 1.20919 0.281759C0.508282 0.673291 0.0898438 1.38645 0.0898438 2.18929V13.7866C0.0898438 15.0005 1.06797 15.9934 2.27016 16C2.27344 16 2.27672 16 2.27994 16C2.65563 16 3.04713 15.8822 3.41279 15.6591C3.70694 15.4796 3.79991 15.0957 3.62044 14.8016C3.44098 14.5074 3.05697 14.4144 2.76291 14.5939C2.59188 14.6982 2.42485 14.7522 2.27688 14.7522C1.82328 14.7497 1.33763 14.3611 1.33763 13.7866V2.18933C1.33763 1.84492 1.51713 1.53907 1.81775 1.3711C2.11841 1.20314 2.47294 1.21064 2.76585 1.39098L12.2159 7.21615C12.4999 7.39102 12.6625 7.68262 12.6618 8.01618C12.6611 8.34971 12.4974 8.64065 12.2118 8.81493L5.37935 12.9983C5.08548 13.1783 4.9931 13.5623 5.17304 13.8562C5.35295 14.1501 5.73704 14.2424 6.03092 14.0625L12.8625 9.87962C13.5166 9.48059 13.9081 8.78496 13.9096 8.01868C13.9112 7.25249 13.5226 6.55524 12.8704 6.15374Z"
                                                    fill="currentColor" />
                                            </svg>

                                        </a>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $question_detail = \App\Models\QuestionsDetail::where('chapter_id', $chap->id)
                                ->where('course_list_id', $l->id)
                                ->get();
                            ?>

                            @foreach ($question_detail as $key3 => $q)
                                <?php
                                $question_count = \App\Models\Questions::where('question_detail_id', $q->id)->count();
                                $pro_quest_detail = \App\Models\ProfileQuestionDetail::where('questions_detail_id', $q->id)
                                    ->where('user_id', Auth::guard('web')->user()->id)
                                    ->first();
                                ?>
                                <div id="CurriculumcollapseOne{{ $key }}" class="collapse show"
                                    aria-labelledby="curriculumheadingOne{{ $key }}"
                                    data-parent="#accordionCurriculum">
                                    <div class="border-top px-5 py-4 min-height-70 d-md-flex align-items-center">
                                        <div class="d-flex align-items-center me-auto mb-4 mb-md-0">
                                            <div class="text-secondary d-flex">
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

                                            <div class="ms-4">
                                                Workshop
                                            </div>
                                        </div>

                                        <div
                                            class="d-flex align-items-center overflow-auto overflow-md-visible flex-shrink-all">
                                            <div
                                                class="badge text-dark-70 bg-orange-40 me-5 font-size-sm fw-normal py-2">
                                                จำนวนทั้งหมด {{ $question_count }} ข้อ
                                            </div>
                                            @if ($q->unlock_certificate == 1)
                                                <div
                                                    class="badge text-dark-70 bg-orange-40 me-5 font-size-sm fw-normal py-2">
                                                    จะได้รับ Certificate หลังทำแบบทดสอบผ่าน
                                                </div>
                                            @endif
                                            <div class="badge btn-blue-soft me-5 font-size-sm fw-normal py-2">
                                                @if ($pro_quest_detail)
                                                    @if ($pro_quest_detail->status == 0)
                                                        <b style="color: orange;">
                                                            รอผลตรวจ
                                                        </b>
                                                    @elseif($pro_quest_detail->status == 1)
                                                        <b style="color: green;">
                                                            <i class="fa fa-check-circle" style="color: green;"
                                                                aria-hidden="true"></i>
                                                            ผ่าน
                                                        </b>
                                                    @elseif($pro_quest_detail->status == 2)
                                                        <b style="color: red;">
                                                            <i class="fa fa-check-circle" style="color: red;"
                                                                aria-hidden="true"></i>
                                                            ไม่ผ่าน
                                                        </b>
                                                    @endif
                                                @endif

                                            </div>
                                            <a href="{{ url('workshop_inside_view/' . $course->id . '/' . $q->id) }}"
                                                class="text-secondary d-flex">
                                                <!-- Icon -->
                                                <svg width="14" height="16" viewBox="0 0 14 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12.8704 6.15374L3.42038 0.328572C2.73669 -0.0923355 1.9101 -0.109836 1.20919 0.281759C0.508282 0.673291 0.0898438 1.38645 0.0898438 2.18929V13.7866C0.0898438 15.0005 1.06797 15.9934 2.27016 16C2.27344 16 2.27672 16 2.27994 16C2.65563 16 3.04713 15.8822 3.41279 15.6591C3.70694 15.4796 3.79991 15.0957 3.62044 14.8016C3.44098 14.5074 3.05697 14.4144 2.76291 14.5939C2.59188 14.6982 2.42485 14.7522 2.27688 14.7522C1.82328 14.7497 1.33763 14.3611 1.33763 13.7866V2.18933C1.33763 1.84492 1.51713 1.53907 1.81775 1.3711C2.11841 1.20314 2.47294 1.21064 2.76585 1.39098L12.2159 7.21615C12.4999 7.39102 12.6625 7.68262 12.6618 8.01618C12.6611 8.34971 12.4974 8.64065 12.2118 8.81493L5.37935 12.9983C5.08548 13.1783 4.9931 13.5623 5.17304 13.8562C5.35295 14.1501 5.73704 14.2424 6.03092 14.0625L12.8625 9.87962C13.5166 9.48059 13.9081 8.78496 13.9096 8.01868C13.9112 7.25249 13.5226 6.55524 12.8704 6.15374Z"
                                                        fill="currentColor" />
                                                </svg>

                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach


                    </div>
                @endforeach

            </div>
        </div>
    </div>

    @include('frontend_new.footer')

</body>

</html>
