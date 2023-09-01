@extends('layouts.navber')
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
                @if($type_page == 1)
                    <a data-fancybox data-src="#hidden-content-b" href="javascript:;" class="btnpopup"></a>
                    <div style="display: none;max-width:100%" id="hidden-content-b">
                        <h1 class="mb-3 text-center">ผึ้งงาน<span class="text-orange">ติดตามงาน</span></h1>
                        <div class="row text-center">
                            <div class="col-xl-6 col-md-6">
                                <a href="{{ url('mgmtContract/follow/'.$budding_air_user->id.'/'.$id.'/2') }}">
                                    <div class="card mb-3 card-popup1">
                                        <div class="card-body">
                                            <img src="{{ asset('image/index-auction.png') }}" class="mw-100 mb-3">
                                            <h4 class="text-orange">ติดตาม</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <a href="{{ url('mgmtContract/follow/'.$budding_air_user->id.'/'.$id.'/1') }}">
                                    <div class="card mb-3 card-popup1">
                                        <div class="card-body">
                                            <img src="{{ asset('image/index-auction.png') }}" class="mw-100 mb-3">
                                            <h4 class="text-orange">ไม่ติดตาม</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <script>
                        $('[data-src="hidden-content-b"]').fancybox({
                            // toolbar : false
                        });

                        $(".btnpopup").trigger("click");
                    </script>
                @else
                    @if($type_contract == 0)
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
                                                                {{--<a class="btn  btn-circle"--}}
                                                                   {{--title="เพิ่มเลขที่ ใบเสนอราคา" data-toggle="modal"--}}
                                                                   {{--data-target="#numberBOQ"><i--}}
                                                                            {{--class="fa fa-plus-circle"></i></a>--}}
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="card-body p-2">
                                                            <br>
                                                            <a href="{{ url('/quotation/excel/'.$budding_air_user->user_id.'/'.$budding_air_user->project_id) }}"
                                                               class="btn btn-default btn-circle btn-lg"
                                                               title="โหลดเอกสาร  BOQ Excel"
                                                               style="font-size:20px;color:green"><i
                                                                        class="fa fa-file-excel-o"></i></a>
                                                            {{--<a data-toggle="modal" data-target="#uploadBOQ"--}}
                                                               {{--class="btn btn-default btn-circle btn-lg"--}}
                                                               {{--title="เพิ่มเอกสาร ใบเสนอราคาเลขที่"--}}
                                                               {{--style="font-size:20px;"><i class="fa fa-plus"></i></a>--}}
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
                                                                        {{--<td>--}}
                                                                            {{--<a href="{{ url('mgmtContract/destroy/'.$item->id) }}">--}}
                                                                                {{--<i class="fa fa-trash" style="color:red;"></i>--}}
                                                                            {{--</a>--}}
                                                                        {{--</td>--}}
                                                                    </tr>
                                                                @endforeach
                                                                {{--<tr class="text-center">--}}
                                                                    {{--<td></td>--}}
                                                                    {{--<td align="left">เอกสารสัญญาว่าจ้าง จากผึ้งงาน</td>--}}
                                                                    {{--<td>1</td>--}}
                                                                    {{--<td>--}}
                                                                        {{--<a href="{{ url('/quotation/pdf/'.$budding_air_user->user_id.'/'.$budding_air_user->project_id) }}"  title="โหลดเอกสาร  ใบเสนอราคาเลขที่" style="color:red" download><i class="fa fa-file-pdf-o"></i></a>--}}
                                                                    {{--</td>--}}
                                                                    {{--<td></td>--}}
                                                                {{--</tr>--}}
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
                    @elseif($type_contract == 1)
                        {{-- สำหรับ ผู้รับเหมา --}}
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
                                                                <a class="btn  btn-circle"
                                                                   title="เพิ่มเลขที่ ใบเสนอราคา" data-toggle="modal"
                                                                   data-target="#numberBOQ"><i
                                                                            class="fa fa-plus-circle"></i></a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="card-body p-2">
                                                            <br>
                                                            <a href="{{ url('/quotation/excel/'.$budding_air_user->user_id.'/'.$budding_air_user->project_id) }}"
                                                               class="btn btn-default btn-circle btn-lg"
                                                               title="โหลดเอกสาร  BOQ Excel"
                                                               style="font-size:20px;color:green"><i
                                                                        class="fa fa-file-excel-o"></i></a>
                                                            <a data-toggle="modal" data-target="#uploadBOQ"
                                                               class="btn btn-default btn-circle btn-lg"
                                                               title="เพิ่มเอกสาร ใบเสนอราคาเลขที่"
                                                               style="font-size:20px;"><i class="fa fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                            <th>ลบไฟล์</th>
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
                                                            <td>
                                                                <a href="{{ url('mgmtContract/destroy/'.$item->id) }}">
                                                                    <i class="fa fa-trash" style="color:red;"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    {{--<tr class="text-center">--}}
                                                        {{--<td></td>--}}
                                                        {{--<td align="left">เอกสารสัญญาว่าจ้าง จากผึ้งงาน</td>--}}
                                                        {{--<td>1</td>--}}
                                                        {{--<td>--}}
                                                            {{--<a href="{{ url('/quotation/pdf/'.$budding_air_user->user_id.'/'.$budding_air_user->project_id) }}"  title="โหลดเอกสาร  ใบเสนอราคาเลขที่" style="color:red" download><i class="fa fa-file-pdf-o"></i></a>--}}
                                                        {{--</td>--}}
                                                        {{--<td></td>--}}
                                                    {{--</tr>--}}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                    @if($budding_air_user->numberBOQ != null)
                                        @if($budding_air_user->status_submit == 0)
                                            <div class="col-sm-12 text-center">
                                                <a href="{{ url('mgmtContract/'.$id) }}" class="btn btn-outline-success">ยืนยันส่งเอกสาร
                                                </a>
                                            </div>
                                        @else
                                            <div class="col-sm-12 text-center">
                                                <a href="{{ url('planner/'.$id) }}" class="btn btn-outline-success">วางตารางวางแผนงาน
                                                </a>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                        <div class="modal fade" id="numberBOQ" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            {!! Form::open(['url' => 'mgmtContract' , 'files'=>true  ]) !!}
                            {{csrf_field()}}
                            <div class="modal-dialog" role="document">
                                <input type="hidden" name="type_add" value="1">
                                <input type="hidden" name="project_id" value="{{ $id }}">
                                <input type="hidden" name="user_id" value="{{ $user_id }}">
                                <input type="hidden" name="owner_id" value="{{ $projectAuction->user_id }}">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">ใบเสนอราคาเลขที่</label>
                                            <input type="text" class="form-control" id="boq_number" name="boq_number" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">วันที่เริ่มทำสัญญา</label>
                                            <input type="date" class="form-control" id="boq_date" name="boq_date" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">กำหนดยืนราคา</label>
                                            <input type="text" class="form-control" id="boq_deadline" name="boq_deadline"
                                                   placeholder="กำหนดยืนราคา จำนวนกี่วัน" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">บันทึก</button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>

                        <div class="modal fade" id="uploadBOQ" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            {!! Form::open(['url' => 'mgmtContract' , 'files'=>true  ]) !!}
                            {{csrf_field()}}
                            <input type="hidden" name="type_add" value="2">
                            <input type="hidden" name="project_id" value="{{ $id }}">
                            <input type="hidden" name="user_id" value="{{ $user_id }}">
                            <input type="hidden" name="owner_id" value="{{ $projectAuction->user_id }}">
                            <input type="hidden" name="budding_boq_id" value="{{ $budding_air_user->numberBOQ_id }}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div v-for="(row , index) in rows" :row="row">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">ชื่อเอกสาร</label>
                                                <input type="text" class="form-control" name="file_title[]" id="file_title[]" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">จำนวนเอกสาร</label>
                                                <input type="number" class="form-control" name="file_count[]" id="file_count[]"  required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">ใบเสนอราคาเลขที่ เอกสาร BOQ</label>
                                                <input type="file" class="form-control-file" name="file_name[]" id="file_name[]" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button v-on:click="addRow(1)" type="button" class="btn btn-outline-secondary"><i
                                                        class='fas fa-plus'></i></button>
                                            <button v-on:click="removeRow(0)" type="button" class="btn btn-outline-secondary"><i
                                                        class='fas fa-minus'></i></button>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">บันทึก</button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                @endif
            </div>
        </div>



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