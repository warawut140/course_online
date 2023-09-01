@extends('layouts.navber')
@section('head')
    @include('sweetalert::alert')
    <link href="{{ asset('assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet"/>
@endsection
@section('content')
    <div id="app">
        {{-- begin # --}}
        <div id="topicA-section1" class="bg-black">
            <div class="container py-5">
                <div class="row">
                    <div class="col-sm-2">
                        <img src="{{ asset('images/profile/'.$projectAuction->image_profile) }}"
                             class="rounded-circle border-warning mx-auto mb-2"
                             style="width:140px;height:140px;object-fit:cover;border:3px solid #000">
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
                            <span>76</span> คน</h6>
                        <h6 class="text-white"><i class='fas fa-tag text-oranger fa-lg'></i> เสนอราคาต่ำสุด <span>2,500,000</span>
                            บาท</h6>
                    </div>
                    <div class="col-sm-3 align-items-center">
                        @if (!Auth::guest())
                            @if ($projectAuction->countDown == 0)
                                <button class="btn btn-light w-100 mb-2"><i class='fas fa-bookmark'></i> ติดตาม</button>
                                {{--<a class="btn btn-warning w-100 mb-2" href="{{ url('quotation/'.$id) }}"><i--}}
                                {{--class='fas fa-comment-dollar'></i> เสนอราคา</a>--}}
                            @endif
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <div id="topicA-section2" class="bg-light">
            <div class="container py-4">
                <h2 class="text-center">เสนอราคา</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="media">
                            <img src="{{ asset('images/profile/'.$profile->image_profile) }}"
                                 class="img-fluid mr-3" alt="Responsive image"
                                 style="width:50px;height:50px;object-fit:cover">
                            <div class="media-body">
                                <h5 class="mt-0 mb-0">ชื่อผู้รับเหมา
                                    : {{ $profile->firstname }} {{ $profile->lastname }}</h5>
                                {{--บริษัท....................--}}
                            </div>
                        </div>
                        <hr>
                        {!! Form::open(['url' => 'quotationPercentage' , 'files'=>true , 'data-parsley-required' => 'true' , 'enctype' => 'multipart/form-data' ]) !!}
                        <input type="hidden" id="profile_id" name="profile_id" value="{{ $profile->id }}">
                        <input type="hidden" id="project_auctions_id" name="project_auctions_id" value="{{ $id }}">

                        <h5>ค่าเครื่องปรับอากาศ</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[1][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[1][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[1][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[1][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>ค่าพัดลมระบายอากาศ</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[2][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[2][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[2][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[2][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>ค่าท่อทองแดง</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[3][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[3][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[3][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[3][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>CRANE</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[4][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[4][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[4][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[4][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>ค่าท่อ PVC</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[5][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[5][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[5][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[5][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>ค่าฉนวนยางดำ</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[6][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[6][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[6][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[6][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>สายไฟ</h5>
                        <h5>- VCT</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[8][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[8][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[8][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[8][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>- THW</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[9][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[9][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[9][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[9][]" data-parsley-required="true">
                            </div>
                        </div>


                        <h5>ค่าท่อ CONDUIT</h5>
                        <h5>- EMT</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[11][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[11][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[11][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[11][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>- IMC</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[12][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[12][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[12][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[12][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>- U-PVC</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[13][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[13][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[13][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[13][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>WIRE WAY</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[14][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[14][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[14][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[14][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>MDB</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[15][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[15][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[15][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[15][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>LP</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[16][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[16][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[16][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[16][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>CIRCUIT BREKER</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[17][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[17][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[17][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[17][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>SAFETY SWITCH</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[18][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[18][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[18][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[18][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>ISOLATE SWITCH</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[19][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[19][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[19][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[19][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>GALVANIZED STEEL SHEET</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[20][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[20][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[20][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[20][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>INSULATION FIBERGLASS FRK</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[21][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[21][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[21][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[21][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>INSULATION ELASTOMER SHEET</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[22][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[22][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[22][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[22][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>GRILL</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[23][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[23][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[23][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[23][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>CHAMBER</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[24][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[24][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[24][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[24][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>SERVICE PANEL</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[25][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[25][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[25][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[25][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>FITTINGS</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[26][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[26][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[26][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[26][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>SUPPORT & HANGER</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[27][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[27][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[27][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[27][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>ACCESSORRIES</h5>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าของ</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[28][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[28][]"
                                       data-parsley-required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 col-4">
                                <h6>ค่าแรง</h6>
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputEmail4">เสนอ(%)</label>
                                <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[28][]"
                                       data-parsley-required="true">
                            </div>
                            <div class="form-group col-md-5 col-4">
                                <label for="inputPassword4">ทุน(%)</label>
                                <input type="number" class="form-control" id="inputPassword4"
                                       name="labor_cost_invest[28][]" data-parsley-required="true">
                            </div>
                        </div>

                        <h5>OTHER</h5>
                        <div v-for="(row , index) in rows" :row="row">
                            <div class="form-row">
                                <div class="form-group col-md-2 col-4">
                                    <h6>ระบุ อื่นๆ</h6>
                                </div>
                                <div class="form-group col-md-10 col-8">
                                    <input type="text" class="form-control" id="inputEmail4" name="other[29][]"
                                           data-parsley-required="true">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2 col-4">
                                    <h6>ค่าของ</h6>
                                </div>
                                <div class="form-group col-md-5 col-4">
                                    <label for="inputEmail4">เสนอ(%)</label>
                                    <input type="number" class="form-control" id="inputEmail4" name="cost_of_offer[29][]"
                                           data-parsley-required="true">
                                </div>
                                <div class="form-group col-md-5 col-4">
                                    <label for="inputPassword4">ทุน(%)</label>
                                    <input type="number" class="form-control" id="inputPassword4" name="cost_of_invest[29][]"
                                           data-parsley-required="true">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2 col-4">
                                    <h6>ค่าแรง</h6>
                                </div>
                                <div class="form-group col-md-5 col-4">
                                    <label for="inputEmail4">เสนอ(%)</label>
                                    <input type="number" class="form-control" id="inputEmail4" name="labor_cost_offer[29][]"
                                           data-parsley-required="true">
                                </div>
                                <div class="form-group col-md-5 col-4">
                                    <label for="inputPassword4">ทุน(%)</label>
                                    <input type="number" class="form-control" id="inputPassword4"
                                           name="labor_cost_invest[29][]" data-parsley-required="true">
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="form-group" style="text-align:center;vertical-align:middle">
                            <button v-on:click="addRow(1)" type="button" class="btn btn-outline-secondary"><i
                                        class='fas fa-plus'></i></button>
                            <button v-on:click="removeRow(0)" type="button" class="btn btn-outline-secondary"><i
                                        class='fas fa-minus'></i></button>
                        </div>
                        <div>
                            <hr>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-dark" type="submit">Next <i class='fas fa-chevron-circle-right'></i>
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        {{-- end # --}}
    </div>
    {{--<script src="/js/app.js" charset="utf-8"></script>--}}
    <script src="{{ asset('js/app.js') }}" ></script>
@endsection
@section('script')
    <script src="{{ asset('assets/plugins/parsley/dist/parsley.js') }}"></script>
@endsection