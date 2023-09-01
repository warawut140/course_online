@extends('layouts.nevber-admin')
@section('head')
    @include('sweetalert::alert')
    <link href="{{ asset('assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet"/>
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('assets/plugins/DataTables/css/data-table.css') }}" rel="stylesheet"/>
    <!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
    <div id="app">
        <div id="content" class="content">

            @if(isset($course))
                 <!-- begin breadcrumb -->
                 <ol class="breadcrumb pull-right">
                    <li><a href="{{ url('admin/course') }}">Course</a></li>
                    <li class="active">Course Chapter</li>
                </ol>
                <!-- end breadcrumb -->
                <!-- begin page-header -->
                <h1 class="page-header"><i class="fa fa fa-gavel"></i>Course {{ $course->name }}</h1>
                <!-- end page-header -->
            <div class="row"> 
                <!-- begin col-12 -->
                <div class="col-md-12">
                   <!-- begin panel -->
                   <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Course {{ $course->name }}
                        <a onclick="getModelAdd2()" class="btn btn-success  btn-icon btn-circle btn-sm"
                           data-toggle="modal" title="เพิ่มข้อมูล"><i class="fa fa-plus"></i></a>
                    </h4>
                </div>
    
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">ชื่อบท</th>
                                    <th class="text-center">ลำดับ</th>
                                    <th class="text-center">สร้างโดย</th>
                                    <th class="text-center">การจัดการ</th>    
                                </tr>
                                </thead>
                                <tbody>
                                        @foreach($chapter as $num => $c)
                                        <tr class="gradeA">
                                            <td class="text-center">{{ $num+1 }}</td>
                                            <td class="text-left"><a href="{{ url('admin/course/'.$c->id.'/') }}">{{ $c->name }}</a></td>
                                            <td class="text-left">{{ $c->order }}</td>
                                            <td class="text-left">{{ $c->actby }}</td>
                                             <td class="text-center">   
                                                <a class="btn btn-primary btn-icon btn-circle btn-sm btn_edit" 
                                                data_url="{{ url("admin/course_chapter/".$c->id."/view") }}"
                                                title="แก้ไขข้อมูล" data_id="{{ $c->id }}"><i class="fa fa-edit"></i></a>
                                             <a class="btn btn-danger btn-icon btn-circle btn-sm btn_delete"
                                                title="ลบข้อมูล" data_name="{{ $c->name }}" data_id="{{ $c->id }}"
                                                data_url="{{ url("admin/course_chapter/".$c->id."/delete") }}"
                                                ><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                </table>
                        </div>
                                {!! Form::close() !!}   
    
    
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
            @endif
        </div>
    </div>

    
    
  <!-- Add #modal-dialog -->
  <div class="modal fade" id="modal-dialog2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button  class="close" data-dismiss="modal" aria-hidden="true">×
                </button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> เพิ่มข้อมูล : Chapter </h4>
            </div>
            <form class="form-horizontal" method="post" id="form_add" data-parsley-validate="true" enctype="multipart/form-data">
                <?php echo csrf_field();?>
                <input type="hidden" name="type" value="1">
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4">ชื่อ Chapter&nbsp; * &nbsp;:</label>
                        <div class="col-md-6 col-sm-6">
                            <input type="text" class="form-control" placeholder="ชื่อ Chapter" name="name" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4">ลำดับบท&nbsp; * &nbsp;:</label>
                        <div class="col-md-6 col-sm-6">
                            <input type="number" step="0.1" min="0" max="9999" class="form-control" placeholder="ลำดับบท" name="order" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                    <button class="btn btn-sm btn-success btn_submit_add">เพิ่มข้อมูล</button>
                </div>
            </form>
        </div>
    </div>
</div>  

 <!-- Add #modal-dialog -->
 <div class="modal fade" id="modal-dialog_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button  class="close" data-dismiss="modal" aria-hidden="true">×
                </button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> แก้ไขข้อมูล : Chapter </h4>
            </div>
            <form class="form-horizontal" method="post" id="form_edit" data-parsley-validate="true" enctype="multipart/form-data">
                <?php echo csrf_field();?>
                <input type="hidden" id="type" name="type" value="1">
                <input type="hidden" id="action" name="action" value="update">
                <input type="hidden" id="id" name="id" value="">
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4">ชื่อ Chapter&nbsp; * &nbsp;:</label>
                        <div class="col-md-6 col-sm-6">
                            <input type="text" class="form-control" placeholder="ชื่อ Chapter" name="name" id="name" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4">ลำดับบท&nbsp; * &nbsp;:</label>
                        <div class="col-md-6 col-sm-6">
                            <input type="number" step="0.1" min="0" max="9999" class="form-control" placeholder="ลำดับบท" name="order" id="order" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                    <button class="btn btn-sm btn-success btn_submit_add">แก้ไขข้อมูล</button>
                </div>
            </form>
        </div>
    </div>
</div>  

    {{-- <script src="{{ asset('js/app.js') }}" ></script> --}}
@endsection
@section('script')
{{--    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>--}}
    {{--<script>--}}
        {{--CKEDITOR.replace('editor');--}}
        {{--var editor  = CKEDITOR.replace('editor2');--}}
        {{--editor.on( 'change', function( evt ) {--}}
            {{--// getData() returns CKEditor's HTML content.--}}
            {{--console.log( 'Total bytes: ' + evt.editor.getData().length );--}}
        {{--});--}}
        {{--// CKEDITOR.instances.editor2.getData();--}}
    {{--</script>--}}
    <script src="{{ asset('assets/js/ui-modal-notification.demo.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/parsley/dist/parsley.js') }}"></script>

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{ asset('assets/plugins/DataTables/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/DataTables/js/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('assets/js/table-manage-responsive.demo.min.js') }}"></script>

    <script src="{{ asset('assets/js/email-inbox-v2.demo.min.js') }}"></script>
    <script src="{{ asset('assets/js/apps.min.js') }}"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

    <script>

        $(document).ready(function () {
            App.init();
            Notification.init();
            InboxV2.init();
            TableManageResponsive.init();
        });

        function getModelAdd2() {
                $('#modal-dialog2').modal('show');
        }

 $("#form_add").submit(function(e) {
    e.preventDefault();    
    var formData = new FormData(this);
    var course_id = $(this).find('#course_id').val();
    $.ajax({
        url: '{{ url("admin/course_chapter/store") }}',
        type: 'POST',
        data: formData,
        success:function(data){
                if(data.success=='success'){
                    Swal.fire(
                                    'บันทึกสำเร็จ!',
                                    'คุณบันทึกรายการเรียบร้อย.',
                                    'success'
                                );
                                setTimeout(function(){
                                    location.reload();
                                }, 1505);
                }else{
                    alert('ไม่สามารถทำรายการได้ กรุณาลองใหม่อีกครั้ง');
                }
            },
        cache: false,
        contentType: false,
        processData: false
    });
});

$("#form_edit").submit(function(e) {
    e.preventDefault();    
    var formData = new FormData(this);
    $.ajax({
        url: '{{ url("admin/course_chapter/store") }}',
        type: 'POST',
        data: formData,
        success:function(data){
                if(data.success=='success'){
                    Swal.fire(
                                    'บันทึกสำเร็จ!',
                                    'คุณบันทึกรายการเรียบร้อย.',
                                    'success'
                                );
                                setTimeout(function(){
                                    location.reload();
                                }, 1505);
                }else{
                    alert('ไม่สามารถทำรายการได้ กรุณาลองใหม่อีกครั้ง');
                }
            },
        cache: false,
        contentType: false,
        processData: false
    });
});

        $(document).on('click','.btn_edit',function(){
            var id = $(this).attr('data_id');
            var url = $(this).attr('data_url');
            $.ajax({
            type:'GET',
            url:url,
            // data:{
            //     'type':1,
            //     'action':'save',
            //     'name':name,
            //     'price':price,
            //     'detail':detail,
            //     'image':image,
            //     "_token": "{{ csrf_token() }}",
            // },
            success:function(data){
                $("#modal-dialog_edit #name").val(data.data.name);
                $("#modal-dialog_edit #order").val(data.data.order);
                $("#modal-dialog_edit #id").val(data.data.id);
                $('#modal-dialog_edit').modal('show');
            }
            });
        });

        $(document).on('click','.btn_delete',function(){
            var id = $(this).attr('data_id');
            var name = $(this).attr('data_name');
            var url = $(this).attr('data_url');
            Swal.fire({
                    title: 'คุณต้องการลบข้อมูลนี้?',
                    text: "รายการข้อมูลของ : "+name,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
            type:'GET',
            url:url,
            success:function(data){
                            if (data.success == "success"){
                                Swal.fire(
                                    'Deleted!',
                                    'คุณลบข้อมูลเรียบร้อย.',
                                    'success'
                                );
                                setTimeout(function(){
                                    location.reload();
                                }, 1505);
                            }
            }
            });

                    }
                })
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