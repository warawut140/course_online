@extends('layouts.navber')
@section('head')
    @include('sweetalert::alert')
    <link href="{{ asset('assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet"/>

@endsection
@section('content')
    <div id="app">
        {{-- begin #รายละเอียด --}}
        @include('frontend.head.head-budding')

        @if($type_contract == 0)
            <div id="topicA-section2" class="bg-light">
                <div class="container-fluid py-4">
                    <h4 class="text-center">ตารางแผนงาน</h4>
                    <br>
                    <div class="text-center">
                        <h5 class="font-weight-normal">Schedule For Install Air condition System  Project UNIQLO LASALLE</h5>
                    </div>
                    <ul class="timeline">
                        @foreach($planner_data as $datum)
                            @if($datum->type_data == 2)
                                {{--ลงวันที่น่าจะเป็น--}}
                                <li>
                                    <div class="direction-r">
                                        <div class="flag-wrapper">
                                            @if($datum->planner_name  == null)
                                                <span class="flag">{{ $datum->planner_type }}</span>
                                            @else
                                                <span class="flag">{{ $datum->planner_name }}</span>
                                            @endif
                                        </div>
                                        {{--<br>--}}
                                        {{--<span class="time" style="font-size: 1em;color: orange;">--}}
                                        {{--{{ date('d/m/Y',strtotime($datum->planner_startdate)) }} - {{ date('d/m/Y',strtotime($datum->planner_enddate)) }}--}}
                                        {{--</span>--}}
                                        {{--                                        <div class="desc">{{ $datum->is_date }}</div>--}}
                                    </div>
                                </li>
                            @else
                                {{--ลงวันที่ทำงานจริง--}}
                                <li>
                                    <div class="direction-l">
                                        <div class="flag-wrapper">
                                            @if($datum->planner_update == 0)
                                                <a href="{{ url('plannerUpdate/'.$datum->id.'/'.$id) }}"><i class="fa fa-check" style="color: green;" title="ยืนยันส่งงาน"></i></a>
                                            @endif
                                                @if($datum->planner_name  == null)
                                                    <span class="flag">{{ $datum->planner_type }}</span>
                                                @else
                                                    <span class="flag">{{ $datum->planner_name }}</span>
                                                @endif
                                        </div>
                                        <div class="desc">
                                            <span class="time" style="font-size: 1em;color: orange;">
                                               {{ date('d/m/Y',strtotime($datum->planner_startdate)) }} - {{ date('d/m/Y',strtotime($datum->planner_enddate)) }}
                                            </span>
                                            <br>
                                            {{ $datum->is_date }}
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="text-center py-5 bg-light">
                @if($budding_success->budding_success == 0)
                    <a href="{{ url('jobUpdate/'.$id) }}"  class="btn btn-outline-info" >ยืนยันปิดงาน</a>
                @else
                    <button class="btn btn-outline-success">ปิดงานสมบูรณ์</button>
                @endif
            </div>
        @elseif($type_contract == 1)
            <div id="topicA-section2" class="bg-light">
                <div class="container-fluid py-4">
                    <h4 class="text-center">ตารางแผนงาน</h4>
                    <br>
                    <div class="text-center">
                        <h5 class="font-weight-normal">Schedule For Install Air condition System  Project UNIQLO LASALLE</h5>
                    </div>
                    <ul class="timeline">
                        @foreach($planner_data as $datum)
                            @if($datum->type_data == 2)
                                {{--ลงวันที่น่าจะเป็น--}}
                                <li>
                                    <div class="direction-r">
                                        <div class="flag-wrapper">
                                            <span class="flag">{{ $datum->planner_name }}</span>
                                        </div>
                                        {{--<br>--}}
                                        {{--<span class="time" style="font-size: 1em;color: orange;">--}}
                                               {{--{{ date('d/m/Y',strtotime($datum->planner_startdate)) }} - {{ date('d/m/Y',strtotime($datum->planner_enddate)) }}--}}
                                        {{--</span>--}}
{{--                                        <div class="desc">{{ $datum->is_date }}</div>--}}
                                    </div>
                                </li>
                            @else
                                {{--ลงวันที่ทำงานจริง--}}
                                <li>
                                    <div class="direction-l">
                                        <div class="flag-wrapper">
                                            @if($datum->planner_update == 0)
                                            <a href="{{ url('plannerUpdate/'.$datum->id.'/'.$id) }}"><i class="fa fa-check" style="color: green;" title="ยืนยันส่งงาน"></i></a>
                                            @endif
                                            <span class="flag">{{ $datum->planner_name }}</span>
                                        </div>
                                        <div class="desc">
                                            <span class="time" style="font-size: 1em;color: orange;">
                                               {{ date('d/m/Y',strtotime($datum->planner_startdate)) }} - {{ date('d/m/Y',strtotime($datum->planner_enddate)) }}
                                            </span>
                                            <br>
                                            {{ $datum->is_date }}
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="text-center py-5 bg-light">
                @if($check_pp1 == 0)
                    <button class="btn btn-outline-success" data-toggle="modal" data-target="#workdayModal">ลงวันที่ทำงานจริง</button>
                @endif
                @if($check_pp2 == 0)
                    <button class="btn btn-outline-warning" data-toggle="modal" data-target="#predictdayModal">ลงวันที่น่าจะเป็น</button>
                @endif

            </div>

            <!-- workdayModal ลงวันที่ทำงานจริง-->
            <div class="modal fade" id="workdayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ลงวันที่ทำงานจริง</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                            </button>
                        </div>
                        {!! Form::open(['url' => 'planner' , 'files'=>true  ]) !!}
                        {{csrf_field()}}
                        <div class="modal-body">
                            <input type="hidden" name="type_planner" value="1">
                            <input type="hidden" name="project_id" value="{{ $id }}">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">A.1 Material Approve & combine</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[1]" id="startdate[1]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[1]" id="enddate[1]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">A.2 Shop Approve & combine</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[2]" id="startdate[2]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[2]" id="enddate[2]">
                                </div>
                            </div>
                            <h6>1. Air Conditioning</h6>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">1.1 FCU ONSITE AND INSTALL</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[3]" id="startdate[3]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[3]" id="enddate[3]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">1.2 SUPPORT AND HANGER FCU</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[4]" id="startdate[4]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[4]" id="enddate[4]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">1.3 OPENNING CEILING  AND INSTALL DECORATE PANEL FCU</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[5]" id="startdate[5]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[5]" id="enddate[5]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">1.4 MARK SERVICE PANEL POSITION FOR MAINTAINANCE</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[6]" id="startdate[6]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[6]" id="enddate[6]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">1.5 CDU  ONSITE AND INSTALL</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[7]" id="startdate[7]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[7]" id="enddate[7]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">1.6 SUPPORT AND HANGER  CDU</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[8]" id="startdate[8]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[8]" id="enddate[8]">
                                </div>
                            </div>
                            <h6>2. Piping</h6>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">2.1 REFRIGERANT PIPE</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[9]" id="startdate[9]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[9]" id="enddate[9]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">2.2 DRAIN  PIPE</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[10]" id="startdate[10]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[10]" id="enddate[10]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">2.3 CONTROL PIPE</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[11]" id="startdate[11]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[11]" id="enddate[11]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">2.4 SUPPORT AND HANGER</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[12]" id="startdate[12]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[12]" id="enddate[12]">
                                </div>
                            </div>
                            <h6>3. Main Electrical For System</h6>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">3.1 REFRIGERANT PIPE</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[13]" id="startdate[13]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[13]" id="enddate[13]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">3.2 DRAIN  PIPE</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[14]" id="startdate[14]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[14]" id="enddate[14]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm"><h6>4. Test System</h6></label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[15]" id="startdate[15]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[15]" id="enddate[15]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm"><h6>5. Test Run Commissioning</h6></label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[16]" id="startdate[16]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[16]" id="enddate[16]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm"><h6>6. Inspect</h6></label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[17]" id="startdate[17]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[17]" id="enddate[17]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm"><h6>7. Training</h6></label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[18]" id="startdate[18]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[18]" id="enddate[18]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm"><h6>8. Hand over</h6></label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[19]" id="startdate[19]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[19]" id="enddate[19]">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>


            <!-- predictdayModal ลงวันที่น่าจะเป็น-->
            <div class="modal fade" id="predictdayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ลงวันที่น่าจะเป็นในการทำงาน</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                            </button>
                        </div>
                        {!! Form::open(['url' => 'planner' , 'files'=>true  ]) !!}
                        {{csrf_field()}}
                        <div class="modal-body">
                            <input type="hidden" name="type_planner" value="2">
                            <input type="hidden" name="project_id" value="{{ $id }}">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">A.1 Material Approve & combine</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[1]" id="startdate[1]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[1]" id="enddate[1]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">A.2 Shop Approve & combine</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[2]" id="startdate[2]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[2]" id="enddate[2]">
                                </div>
                            </div>
                            <h6>1. Air Conditioning</h6>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">1.1 FCU ONSITE AND INSTALL</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[3]" id="startdate[3]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[3]" id="enddate[3]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">1.2 SUPPORT AND HANGER FCU</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[4]" id="startdate[4]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[4]" id="enddate[4]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">1.3 OPENNING CEILING  AND INSTALL DECORATE PANEL FCU</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[5]" id="startdate[5]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[5]" id="enddate[5]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">1.4 MARK SERVICE PANEL POSITION FOR MAINTAINANCE</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[6]" id="startdate[6]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[6]" id="enddate[6]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">1.5 CDU  ONSITE AND INSTALL</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[7]" id="startdate[7]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[7]" id="enddate[7]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">1.6 SUPPORT AND HANGER  CDU</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[8]" id="startdate[8]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[8]" id="enddate[8]">
                                </div>
                            </div>
                            <h6>2. Piping</h6>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">2.1 REFRIGERANT PIPE</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[9]" id="startdate[9]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[9]" id="enddate[9]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">2.2 DRAIN  PIPE</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[10]" id="startdate[10]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[10]" id="enddate[10]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">2.3 CONTROL PIPE</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[11]" id="startdate[11]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[11]" id="enddate[11]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">2.4 SUPPORT AND HANGER</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[12]" id="startdate[12]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[12]" id="enddate[12]">
                                </div>
                            </div>
                            <h6>3. Main Electrical For System</h6>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">3.1 REFRIGERANT PIPE</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[13]" id="startdate[13]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[13]" id="enddate[13]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm">3.2 DRAIN  PIPE</label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[14]" id="startdate[14]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[14]" id="enddate[14]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm"><h6>4. Test System</h6></label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[15]" id="startdate[15]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[15]" id="enddate[15]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm"><h6>5. Test Run Commissioning</h6></label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[16]" id="startdate[16]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[16]" id="enddate[16]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm"><h6>6. Inspect</h6></label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[17]" id="startdate[17]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[17]" id="enddate[17]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm"><h6>7. Training</h6></label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[18]" id="startdate[18]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[18]" id="enddate[18]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label col-form-label-sm"><h6>8. Hand over</h6></label>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="startdate[19]" id="startdate[19]">
                                </div>
                                <div class="col-sm">
                                    <input type="date" class="form-control form-control-sm" name="enddate[19]" id="enddate[19]">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        @endif
    </div>
    {{--<script src="/js/app.js" charset="utf-8"></script>--}}
    <script src="{{ asset('js/app.js') }}" ></script>
@endsection
@section('script')

    <script src="{{ asset('assets/plugins/parsley/dist/parsley.js') }}"></script>
    @if(session()->has('status'))
        <script>
            Swal({
                type: 'success',
                title: "<?php echo session()->get('status'); ?>",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
    <script src="{{ asset('js/jquery.stickyheader.js') }}"></script>

@endsection