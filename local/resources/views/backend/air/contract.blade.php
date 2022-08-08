@extends('layouts.navber2')
@section('head')
    @include('sweetalert::alert')
    <link href="{{ asset('assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet"/>
    <style>
        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }
    </style>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"/>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

@endsection
@section('content')
    <div id="app">
        {{-- begin #รายละเอียด --}}
        @include('frontend.head.head-budding')
        <div id="topicA-section2" class="bg-light">
            <div class="container py-5">
                {{-- สำหรับ ผู้ว่าจ้าง --}}
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="bg-white p-2 mb-3">
                                    <div class="card mb-2">
                                        <div class="row no-gutters">
                                            <div class="col-md-4">
                                                <div class="card-body p-2">
                                                    <h6>บริษัท {{ $budding_air_user->company }}</h6>
                                                    <p style="font-size: 17px">
                                                        <small><i class="material-icons"></i> ชื่อ ผู้รับเหมา
                                                            : {{ $budding_air_user->fullname }} <br>
                                                            เบอร์ผู้รับเหมา : {{ $budding_air_user->tel }}
                                                        </small>

                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card-body p-2">
                                                    <br>
                                                    วันที่ประมูลเสร็จ : <span>{{ $budding_air_user->budding_date }}</span><br>
                                                    เบอร์ผู้ว่าจ้าง : <span>{{ $budding_air_user->tel }}</span><br>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card-body p-2">
                                                    <br>
                                                    ราคาทั้งหมด :
                                                    <span>{{ number_format($budding_air_user->total,2) }}</span>
                                                    <br>
                                                    ใบเสนอราคาเลขที่ :
                                                    @if($budding_air_user->numberBOQ != null)
                                                        <span>{{ $budding_air_user->numberBOQ }}</span>
                                                    @else
                                                        -
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="card-body p-2">
                                                    <br>
                                                    <a href="{{ url('/quotation/excel/'.$budding_air_user->user_id.'/'.$budding_air_user->project_id) }}"
                                                       class="btn btn-default btn-circle btn-lg"
                                                       title="โหลดเอกสาร  BOQ Excel" target="_blank"
                                                       style="font-size:20px;color:green"><i
                                                                class="fa fa-file-excel-o"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($budding_air_user->numberBOQ != null)
                                    @if($budding_air_user->status_submit == 2)
                                        <div class="col-sm-12 text-center">
                                            <h1 class="text-center">รอยืนยันการส่งเอกสาร</h1>
                                        </div>
                                    @else
                                        @if($budding_file != null)
                                            <div class="col-xl-12 col-lg-12">
                                                <p>- เอกสารประกอบทั้งหมด</p>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                        <tr class="text-center">
                                                            <th>#</th>
                                                            <th>เอกสารประกอบ</th>
                                                            <th>จำนวน</th>
                                                            <th>ไฟล์</th>
                                                            {{--<th>ลบไฟล์</th>--}}
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($budding_file as $key => $item)
                                                            <tr class="text-center">
                                                                <td>{{ $key+1 }}</td>
                                                                <td align="left">{{ $item->file_title }}</td>
                                                                <td>{{ $item->file_count }}</td>
                                                                <td>
                                                                    @if($item->file_name != null)
                                                                        <a href="{{ asset('budding/'.$item->budding_boq_id.'/'.$item->file_name) }}" download>
                                                                            <i class="fa fa-file-pdf-o" style="color:red;"></i>
                                                                        </a>
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-sm-12 text-center">
                                            <a href="{{ url('planner/'.$id) }}" class="btn btn-outline-success">ดูตารางวางแผนงาน
                                            </a>
                                        </div>
                                    @endif
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
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
    <style>
        .card-popup1:hover, .card-popup2:hover, .card-popup3:hover, .card-popup4:hover {
            background-color: #f2a32f;
            color: #fff;
        }

        .card-popup1:hover h4, .card-popup2:hover h4, .card-popup3:hover h4, .card-popup4:hover h4 {
            color: #fff;
        }

        .card-popup1:hover img {
            content: url({{ asset('image/index-auction - Copy.png') }});
        }

        .card-popup2:hover img {
            content: url({{ asset('image/index-findjob - Copy.png')}});
        }

        .card-popup3:hover img {
            content: url({{ asset('image/index-knowledge - Copy.png')}});
        }

        .card-popup4:hover img {
            content: url({{ asset('image/index-store - Copy.png')}});
        }
    </style>
@endsection