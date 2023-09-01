@extends('layouts.navber')
@section('head')

@endsection
@section('content')
    <div id="app">
        {{-- begin #รายละเอียด --}}
        <div id="topicA-section1" class="bg-black">
            <div class="container py-5">
                <div class="row">
                    <div class="col-sm-2">
                        <img src="{{ asset('images/profile/'.$projectAuction->image_profile) }}"
                             class="rounded-circle border-warning mx-auto mb-2"
                             style="width:140px;height:140px;object-fit:cover;border:3px solid #000">
                        <h6 class="text-white font-weight-medium">{{$projectAuction->username }}</h6>
                        <h6 class="text-white font-weight-light">ผู้ว่าจ้าง</h6>
{{--                        <h6 class="text-orange"><span class="fa fa-star"></span> 4.8</h6>--}}
                    </div>
                    <div class="col-sm-10">
                        <h5 class="text-white">{{ $projectAuction->project_name }}</h5>
                        <h5><span class="badge badge-warning">ประเภทงาน: {{ $projectAuction->type_project }}</span></h5>
                        <div class="row">
                            <div class="col-sm">
                                <h6 class="text-orange">ขอบเขตงาน</h6>
                                <ul class="text-white">
                                    @if($projectAuction->type_project_id == 1)
                                        @foreach($projectAuctionWorks as $data)
                                            <li>{{ $data->work_name }}</li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="col-sm">
                                <h6 class="text-orange">ขอบเขตงานย่อย</h6>
                                <ul class="text-white">
                                    @if($projectAuction->type_project_id == 1)
                                        @if($projectAuctionWorks[0]->install_machine != null)
                                            <li>Install machine</li>@endif
                                        @if($projectAuctionWorks[0]->piping != null)
                                            <li>Piping</li>@endif
                                        @if($projectAuctionWorks[0]->control != null)
                                            <li>Control</li>@endif
                                        @if($projectAuctionWorks[0]->main != null)
                                            <li>Control</li>@endif
                                        @if($projectAuctionWorks[0]->duct_piping != null)
                                            <li>Duct piping</li>@endif
                                    @endif
                                </ul>
                            </div>
                            <div class="col-sm">
                                <h6 class="text-orange">วันและเวลาปิดประมูล</h6>
                                <ul class="text-white">
                                    <li>
                                        <?php
                                        list($year, $month, $day) = explode('-', date('Y-m-d', strtotime($projectAuction->date_end)));
                                        if ($day < 10) {
                                            $day = substr($day, 1, 1);
                                        }

                                        $thMonth = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
                                            "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                                        if ($month < 10) {
                                            $month = substr($month, 1, 1);
                                        }
                                        $year += 543;
                                        echo $day . "&nbsp;" . $thMonth[$month - 1] . "&nbsp;" . $year;
                                        ?>
                                    </li>
                                    <li>{{ date('H:i',strtotime($projectAuction->time_end)) }}</li>
                                </ul>
                            </div>
                            <div class="col-sm">
                                <h6 class="text-orange">งบประมาณ</h6>
                                <ul class="text-white">
                                    <li>{{ $projectAuction->price }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <h6 class="text-orange">สถานที่ปฏิบัติงาน</h6>
                                <ul class="text-white">
                                    <li>{{ $projectAuction->districts }},{{ $projectAuction->amphures }}
                                        , {{ $projectAuction->provinces }}</li>
                                </ul>
                            </div>
                            <div class="col-sm">
                                <h6 class="text-orange">วันเริ่มงาน</h6>
                                <ul class="text-white">
                                    <li>
                                        <?php
                                        list($year, $month, $day) = explode('-', date('Y-m-d', strtotime($projectAuction->startdate)));
                                        if ($day < 10) {
                                            $day = substr($day, 1, 1);
                                        }

                                        $thMonth = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
                                            "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                                        if ($month < 10) {
                                            $month = substr($month, 1, 1);
                                        }
                                        $year += 543;
                                        echo $day . "&nbsp;" . $thMonth[$month - 1] . "&nbsp;" . $year;
                                        ?> ถึง
                                        <?php
                                        list($year, $month, $day) = explode('-', date('Y-m-d', strtotime($projectAuction->enddate)));
                                        if ($day < 10) {
                                            $day = substr($day, 1, 1);
                                        }

                                        $thMonth = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
                                            "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                                        if ($month < 10) {
                                            $month = substr($month, 1, 1);
                                        }
                                        $year += 543;
                                        echo $day . "&nbsp;" . $thMonth[$month - 1] . "&nbsp;" . $year;
                                        ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm">
                                <h6 class="text-orange">ระยะเวลาปฏิบัติงาน</h6>
                                <ul class="text-white">
                                    <li>{{ $projectAuction->period }}</li>
                                </ul>
                            </div>
                            <div class="col-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="topicA-section2" class="bg-gray">
            <div class="container py-4">
                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="text-white text-center">ระยะเวลาที่เหลือ</h5>
                    </div>
                </div>
                <div class="row">
                    <day date="{{ $projectAuction->date_end }} {{ $projectAuction->time_end }}"></day>

                    <div class="col-sm-3 align-items-center">
                        <h6 class="text-white"><i class='fas fa-users text-oranger fa-lg'></i> จำนวนผู้เข้าชม 
                            <span>{{ $Logview }}</span> คน</h6>
                        <h6 class="text-white"><i class='fas fa-tag text-oranger fa-lg'></i> เสนอราคาต่ำสุด <span>{{ $low }}</span>
                            บาท</h6>
                    </div>
                    <div class="col-sm-3 align-items-center">
                        @if (!Auth::guest())
                            @if ($projectAuction->countDown == 0)
{{--                                <button class="btn btn-light w-100 mb-2"><i class='fas fa-bookmark'></i> ติดตาม</button>--}}
                                @if ($projectAuction->user_id == $AuthId)
                                    <a class="btn btn-warning w-100 mb-2"
                                       href="{{ url('quotation/dashboard/'.$id) }}">
                                       {{--href="{{ url('quotationPercentage/'.$id) }}">--}}
                                        <i class='fas fa-comment-dollar'></i> ดูการเสนอราคา</a>
                                @else
                                    <a class="btn btn-warning w-100 mb-2"
                                       href="{{ url('quotation/'.$id) }}">
                                        {{--href="{{ url('quotationPercentage/'.$id) }}">--}}
                                        <i class='fas fa-comment-dollar'></i> เสนอราคา </a>
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
            </div>

        </div>
        <div id="topicA-section3" class="bg-light">
            <div class="container py-5">
                <h3>รายละเอียด</h3>
                <div class="card">
                    <div class="card-body">
                        <p class="text-justify">
                            {!! $projectAuction->details !!}
                        </p>
                        <br>
                        <div class="row">
                            @if($projectAuctionGalleries != null)
                                @foreach($projectAuctionGalleries as $data)
                                    <div class="col-sm-4">
                                        <img src="{{ asset('images/gallery-projectauction/'.$data->filename) }}"
                                             class="mw-100 mb-3">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    {{--<div class="align-items-center">--}}
                    {{--<button class="btn btn-light w-100 mb-2"><i class='fas fa-edit'></i> แก้ไข</button>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
        {{-- end #รายละเอียด --}}
    </div>
    {{--<script src="/js/app.js" charset="utf-8"></script>--}}
    <script src="{{ asset('js/app.js') }}" ></script>

@endsection
@section('script')
    @if(session()->has('warning'))
        <script>
            Swal({
                type: 'warning',
                title: "<?php echo session()->get('warning'); ?>",
                showConfirmButton: false,
                timer: 3000
            })
        </script>
    @endif
    <script>

        var countDownClock = function countDownClock() {
            var number = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 100;
            var format = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'seconds';
            var d = document;
            var daysElement = d.querySelector('.days');
            var hoursElement = d.querySelector('.hours');
            var minutesElement = d.querySelector('.minutes');
            var secondsElement = d.querySelector('.seconds');
            var countdown = void 0;
            convertFormat(format);


            function convertFormat(format) {
                switch (format) {
                    case 'seconds':
                        return timer(number);
                    case 'minutes':
                        return timer(number * 60);
                    case 'hours':
                        return timer(number * 60 * 60);
                    case 'days':
                        return timer(number * 60 * 60 * 24);
                }

            }

            function timer(seconds) {
                var current_timestamp = '<?php echo $current_timestamp ?>';
                var now = Date.now();
                var then = now + seconds * 1000;
                var then2 = now + current_timestamp * 1000;

                console.log("seconds " + seconds);
                console.log("then " + then);
                console.log("current_timestamp " + current_timestamp);

                countdown = setInterval(function () {
                    var secondsLeft = Math.round((then2 - Date.now()) / 1000);
                    console.log("secondsLeft " + secondsLeft);
                    console.log("Date.now() " + Date.now());

                    if (secondsLeft <= 0) {
                        clearInterval(countdown);
                        return;
                    }
                    displayTimeLeft(secondsLeft);

                }, 1000);
            }

            function displayTimeLeft(seconds) {
                // console.log("displayTimeLeft "+seconds);
                daysElement.textContent = Math.floor(seconds / 86400);
                hoursElement.textContent = Math.floor(seconds % 86400 / 3600);
                minutesElement.textContent = Math.floor(seconds % 86400 % 3600 / 60);
                secondsElement.textContent = seconds % 60 < 10 ? '0' + seconds % 60 : seconds % 60;
            }
        };


        /*
             start countdown
             enter number and format
             days, hours, minutes or seconds
           */
        // countDownClock(5, 'seconds');
        // countDownClock(1, 'days');
    </script>
@endsection
