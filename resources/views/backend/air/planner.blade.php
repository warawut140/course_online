@extends('layouts.navber2')
@section('head')
    @include('sweetalert::alert')
    <link href="{{ asset('assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet"/>

@endsection
@section('content')
    <div id="app">
        {{-- begin #รายละเอียด --}}
        @include('frontend.head.head-budding')
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
    </div>

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