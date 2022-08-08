@extends('layouts.nevber-admin')
@section('head')
    @include('sweetalert::alert')
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('assets/plugins/DataTables/css/data-table.css') }}" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="active">อบรมและสาระ</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header"><i class="fa fa-picture-o"></i> อบรมและสาระ</h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="row">
                    <!-- begin col-12 -->
                    <div class="col-md-12">
                        <div class="panel panel-warning" data-sortable-id="table-basic-7">
                            <div class="panel-heading">
                                <h4 class="panel-title">อบรมและสาระ</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! Form::open(['url' => 'admin/training_update' , 'files'=>true , 'data-parsley-required' => 'true' ]) !!}
                                        {{csrf_field()}}
                                        <div class="modal-body">
                                            <div id="app">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">ชื่อหัวข้อ</label>
                                                    {!!  Form::text('title',$training->title,['id' => 'title','class' => 'form-control' , 'required']) !!}
                                                    <input type="hidden" name="training_id" value="{{ $training->id }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">หมวดหมู่</label>
                                                    <br>
                                                    @if($trainingTag->count()==0)
                                                    <div v-for="(row , index) in rows" :row="row">
                                                        <select name="tags[]" id="tags[]" class="form-control" required>
                                                            <option selected disabled value="">กรุณาเลือก</option>
                                                            @foreach($tags2 as $data)
                                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @else
                                                    @foreach($trainingTag as $t_tag)
                                                    <div v-for="(row , index) in rows" :row="row">
                                                        <select name="tags[]" id="tags[]" class="form-control" required>
                                                            <option selected disabled value="">กรุณาเลือก</option>
                                                            @foreach($tags2 as $data)
                                                                <option value="{{ $data->id }}" <?php if($data->id==$t_tag->tag_id){echo 'selected';} ?>>{{ $data->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <button v-on:click="addRow(1)" type="button" class="btn btn-outline-secondary"><i
                                                                class='fa fa-plus'></i></button>
                                                    <button v-on:click="removeRow(0)" type="button" class="btn btn-outline-secondary"><i
                                                                class='fa fa-minus'></i></button>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlFile1">ภาพประกอบ</label>
                                                    <input type="file" name="image_training" class="form-control-file" >
                                                    <img src="{{ asset('/images/training/image/'.$training->image_training) }}" class="mw-100 w-100">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">รูปอัมบั้ม</label>
                                                    <input type="file" name="galley[]" id="galley[]" multiple>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlFile1">วิดีโอประกอบ</label>
                                                    <input type="file" name="video_training" class="form-control-file"
                                                           id="exampleFormControlFile1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">รายละเอียด</label>
                                                    <textarea class="form-control" name="details" id="exampleInputEmail1"
                                                              rows="10" required>
                                                            {{ $training->details }}
                                                            </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button> --}}
                                            <button type="submit" class="btn btn-success">ยืนยัน</button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">

                                    </div>
                                </div>
                                @foreach($trainingCM as $com)
                   <div class="form-group">
                    <label for="exampleFormControlFile1">Comment by {{ $com->actby }} <a href="{{ url('admin/training_com_delete/'.$com->id) }}" style="color:red;">ลบ</a></label>
                    <input type="text" name="comment_detail" class="form-control" readonly value="{{ $com->details }}">
                    <input type="hidden" name="comment_id" class="form-control" value="{{ $com->id }}">
                   </div>
                   @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <!-- end col-12 -->
                </div>
                <!-- end panel -->
            </div>
        </div>
        <!-- end row -->
    </div>



    {{--<script src="/js/app.js" charset="utf-8"></script>--}}
    <script src="{{ asset('js/app.js') }}" ></script>
@endsection
@section('script')
    <script src="{{ asset('assets/js/ui-modal-notification.demo.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/parsley/dist/parsley.js') }}"></script>
    <script src="{{ asset('assets/plugins/DataTables/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/DataTables/js/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('assets/js/table-manage-responsive.demo.min.js') }}"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

    <script>
        $(document).ready(function () {
            App.init();
            Notification.init();
            TableManageResponsive.init();
            CKEDITOR.replace('details');
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

    @if(session()->has('error'))
    <script>
        Swal({
            type: 'error',
            title: "<?php echo session()->get('error'); ?>",
            showConfirmButton: false,
            timer: 6000
        })
    </script>
@endif


@endsection