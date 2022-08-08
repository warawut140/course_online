<div id="topicA-section1" class="bg-black">
    <div class="container py-5">
        <div class="row">
            <div class="col-sm-2">
                <img src="{{ asset('images/profile/'.$projectAuction->image_profile) }}" class="rounded-circle border-warning mx-auto mb-2" style="width:140px;height:140px;object-fit:cover;border:3px solid #000">
                <h6 class="text-white font-weight-medium">{{$projectAuction->username }}</h6>
                <h6 class="text-white font-weight-light">ผู้ว่าจ้าง</h6>
                <h6 class="text-orange"><span class="fa fa-star"></span> 4.8</h6>
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
                                @if($projectAuctionWorks[0]->install_machine != null)<li>Install machine</li>@endif
                                @if($projectAuctionWorks[0]->piping != null)<li>Piping</li>@endif
                                @if($projectAuctionWorks[0]->control != null)<li>Control</li>@endif
                                @if($projectAuctionWorks[0]->main != null)<li>main</li>@endif
                                @if($projectAuctionWorks[0]->duct_piping != null)<li>Duct piping</li>@endif
                            @endif
                        </ul>
                    </div>
                    <div class="col-sm">
                        <h6 class="text-orange">วันและเวลาปิดประมูล</h6>
                        <ul class="text-white">
                            <li>
                                <?php
                                list($year,$month,$day) = explode('-',date('Y-m-d',strtotime($projectAuction->date_end)));
                                if($day <10){
                                    $day = substr($day,1,1);
                                }

                                $thMonth = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน",
                                    "กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
                                if($month<10){
                                    $month = substr($month,1,1);
                                }
                                $year +=543;
                                echo $day."&nbsp;".$thMonth[$month-1]."&nbsp;".$year;
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
                            <li>{{ $projectAuction->districts }},{{ $projectAuction->amphures }}, {{ $projectAuction->provinces }}</li>
                        </ul>
                    </div>
                    <div class="col-sm">
                        <h6 class="text-orange">วันเริ่มงาน</h6>
                        <ul class="text-white">
                            <li>
                                <?php
                                list($year,$month,$day) = explode('-',date('Y-m-d',strtotime($projectAuction->startdate)));
                                if($day <10){
                                    $day = substr($day,1,1);
                                }

                                $thMonth = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน",
                                    "กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
                                if($month<10){
                                    $month = substr($month,1,1);
                                }
                                $year +=543;
                                echo $day."&nbsp;".$thMonth[$month-1]."&nbsp;".$year;
                                ?> ถึง
                                <?php
                                list($year,$month,$day) = explode('-',date('Y-m-d',strtotime($projectAuction->enddate)));
                                if($day <10){
                                    $day = substr($day,1,1);
                                }

                                $thMonth = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน",
                                    "กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
                                if($month<10){
                                    $month = substr($month,1,1);
                                }
                                $year +=543;
                                echo $day."&nbsp;".$thMonth[$month-1]."&nbsp;".$year;
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
            <day date="{{ $projectAuction->date_end }} {{ $projectAuction->time_end }}" ></day>

            <div class="col-sm-3 align-items-center">
                <h6 class="text-white"><i class='fas fa-users text-oranger fa-lg'></i> จำนวนผู้เข้าชม <span>76</span> คน</h6>
                <h6 class="text-white"><i class='fas fa-tag text-oranger fa-lg'></i> เสนอราคาต่ำสุด <span>2,500,000</span> บาท</h6>
            </div>
            <div class="col-sm-3 align-items-center">
                @if (!Auth::guest())
{{--                    <button class="btn btn-light w-100 mb-2"><i class='fas fa-bookmark'></i> ติดตาม</button>--}}
                @endif
            </div>
        </div>
    </div>
</div>
