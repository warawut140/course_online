@extends('layouts.nevber-admin')
@section('head')
    @include('sweetalert::alert')
    <link href="{{ asset('assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('assets/plugins/fullcalendar/fullcalendar/fullcalendar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/DataTables/css/data-table.css') }}" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="active">ประกาศ</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header"><i class="fa fa-bullhorn"></i> ประกาศ</h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                {{--<div class="btn-group-vertical">--}}
                    {{--<a class="btn btn-sm btn-success"  data-toggle="modal" data-target="#createArticleWork">--}}
                        {{--<i class="fa fa-plus"></i> เพิ่มข้อมูล</a>--}}
                {{--</div>--}}
                {{--<br>--}}
                {{--<br>--}}
                <!-- begin panel -->
                <div class="panel panel-warning" data-sortable-id="table-basic-7">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        </div>
                        <h4 class="panel-title">ประกาศ</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ชื่องาน</th>
                                        <th>ราคา</th>
                                        <th>หมวดหมู่</th>
                                        <th>ประเภทประกาศ</th>
                                        <th>สถานที่ปฏิบัติงาน</th>
                                        {{--<th>วันที่โพส</th>--}}
                                        {{--<th>วันที่อัพเดท</th>--}}
                                        <th>สร้างโดย</th>
                                        <th>การจัดการ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($works as $key => $data)
                                        <tr class="gradeA">
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $data->title }}</td>
                                            <td>{{ $data->price }}</td>
                                            <td>
                                                @foreach($data->tags as $keyB => $dataB)
                                                    <span class="label label-primary f-s-10">{{ $dataB->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->PROVINCE_NAME }}</td>
                                            {{--<td>{{ date('d/m/Y', strtotime($data->calender_date)) }}</td>--}}
                                            {{--<td>{{ date('d/m/Y', strtotime($data->created_at)) }}</td>--}}
                                            {{--<td>@if($data->updated_at == "")---}}
                                                {{--@else--}}
                                                    {{--{{ date('d/m/Y', strtotime($data->updated_at)) }}--}}
                                                {{--@endif--}}
                                            {{--</td>--}}
                                            <td>{{ $data->firstname }} {{ $data->lastname }}</td>
                                            <td>
                                                <p>
                                                    <a href="{{ url('work/'.$data->id.'/') }}" class="btn btn-default btn-icon btn-circle" title="ดูข้อมูล" target="_blank"><i class="fa fa-eye"></i></a>
                                                    {{--@if($data->source == 2)--}}
                                                        {{--<a data-toggle="modal" data-target="#createArticleWork" class="btn btn-info btn-icon btn-circle" title="แก้ไขข้อมูล"><i class="fa fa-edit"></i></a>--}}
                                                        {{--<a href="#" class="btn btn-danger btn-icon btn-circle" title="ลบข้อมูล"><i class="fa fa-times"></i></a>--}}
                                                    {{--@endif--}}
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-12 -->
        </div>
        <!-- end row -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createArticleWork" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="exampleModalLabel">ตั้งกระทู้</h5>
                </div>
                <div id="app">
                    {!! Form::open(['url' => 'admin/work' , 'files'=>true , 'data-parsley-required' => 'true' ]) !!}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputPassword1">ชื่อกระทู้</label>
                            {!!  Form::text('title',null,['id' => 'title','class' => 'form-control' , 'data-parsley-required' => 'true']) !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">ประเภทกระทู้</label>
                            <div class="form-check form-check-inline">
                                {{ Form::radio('type_wp_id', 1,false,['class' => 'form-check-input','id' => 'type_wp_id']) }}
                                {{--<input class="form-check-input" type="radio" name="type_wp_id" id="type_wp_id" value="1">--}}
                                <label class="form-check-label" for="inlineCheckbox1">หาผู้รับจ้าง</label>
                            </div>
                            <div class="form-check form-check-inline">
                                {{ Form::radio('type_wp_id', 2,false,['class' => 'form-check-input','id' => 'type_wp_id']) }}
                                {{--<input class="form-check-input" type="radio" name="type_wp_id" id="type_wp_id" value="2">--}}
                                <label class="form-check-label" for="inlineCheckbox2">หาผู้รับเหมา</label>
                            </div>
                            <div class="form-check form-check-inline">
                                {{ Form::radio('type_wp_id', 3 ,false,['class' => 'form-check-input','id' => 'type_wp_id']) }}
                                {{--<input class="form-check-input" type="radio" name="type_wp_id" id="type_wp_id" value="3">--}}
                                <label class="form-check-label" for="inlineCheckbox2">หางาน</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">หมวดหมู่</label>
                            <br>
                            <div v-for="(row , index) in rows" :row="row">
                                <select name="tags[]" id="tags[]" class="form-control">
                                    <option selected>ทั้งหมด</option>
                                    @foreach($tags2 as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <button v-on:click="addRow(1)" type="button" class="btn btn-outline-secondary"><i
                                        class='fa fa-plus'></i></button>
                            <button v-on:click="removeRow(0)" type="button" class="btn btn-outline-secondary"><i
                                        class='fa fa-minus'></i></button>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">รายละเอียดข้อมูล</label>
                            <textarea class="form-control" rows="3" name="detail_data"
                                      id="detail_data"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">ภาพผลงาน
                                <small>หลายภาพ</small>
                            </label>
                            {!!  Form::file('work_gallery[]',['class' => 'form-control' ,  'multiple' => 'multiple']) !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">รายละเอียดการให้บริการ</label>
                            <div v-for="(row , index) in rows2" :row="row">
                                <input type="text" class="form-control" name="work_procedures[]"
                                       id="listService[]">
                            </div>
                        </div>
                        <div class="form-group">
                            <button v-on:click="addRow2(1)" type="button" class="btn btn-outline-secondary"><i
                                        class='fa fa-plus'></i></button>
                            <button v-on:click="removeRow2(0)" type="button" class="btn btn-outline-secondary">
                                <i class='fa fa-minus'></i></button>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">ระยะเวลาในการทำงาน</label>
                                {!!  Form::text('time_work',null,['id' => 'time_work','class' => 'form-control' , 'data-parsley-required' => 'true']) !!}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">ราคาเริ่มต้น</label>
                                {!!  Form::select('price_range', $priceRange, null, ['id' => 'price_range_id','class' => 'form-control' , 'placeholder' => 'ทั้งหมด' ]) !!}
                                {{--<input type="text" class="form-control" id="inputPassword4" >--}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">รายละเอียดราคาเพิ่มเติม</label>
                            <textarea class="form-control" rows="4" name="detail_price"
                                      id="detail_price"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">ขั้นตอนการทำงาน</label>
                            <div v-for="(row , index) in rows3" :row="row">
                                <input type="text" class="form-control" name="listService[]" id="listService[]">
                            </div>
                        </div>
                        <div class="form-group">
                            <button v-on:click="addRow3(1)" type="button" class="btn btn-outline-secondary"><i
                                        class='fa fa-plus'></i></button>
                            <button v-on:click="removeRow3(0)" type="button" class="btn btn-outline-secondary">
                                <i class='fa fa-minus'></i></button>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">สถานที่ปฏิบัติงาน</label>
                            {!!  Form::select('provinces_id', $provinces, null, ['id' => 'provinces_id','class' => 'form-control' , 'placeholder' => 'ทั้งหมด' ]) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">ยืนยันสร้าง</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    {{--<script src="/js/app.js" charset="utf-8"></script>--}}
    <script src="{{ asset('js/app.js') }}" ></script>
@endsection
@section('script')
    <script src="{{ asset('assets/js/ui-modal-notification.demo.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/parsley/dist/parsley.js') }}"></script>
    <script src="{{ asset('assets/plugins/DataTables/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/DataTables/js/dataTables.fixedColumns.js') }}"></script>
    <script src="{{ asset('assets/js/table-manage-fixed-columns.demo.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            App.init();
            Notification.init();
            TableManageFixedColumns.init();
        });
    </script>
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
@endsection