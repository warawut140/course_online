@extends('layouts.navber')
@section('head')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    {{-- <script src="https://rawgit.com/vuejs/vue/dev/dist/vue.js"></script> --}}
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet">
    {{-- <script>
        function checkTypeUser(id) {
            if (id == 2) {
                $('#typeUser').show();
            } else {
                $('#typeUser').hide();
            }
        }
    </script> --}}
    <style>
        .bg-light2 {
            /* background-color: #8B0900;
                                                                                        background-image: url("{{ asset('image/bg.png') }}"); */
            /* clear: both; */
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #8B0900;
        }

        .nav-pills a.nav-link {
            color: black;
            border-bottom: 1px solid #d9d9d9;
        }

        .select2-container .select2-selection--single {
            height: 30px;
        }

        .input-group-text {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding: 0.375rem 0.75rem;
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #ffffff;
            text-align: center;
            white-space: nowrap;
            background-color: #8B0900;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }


    </style>
@endsection
@section('content')
    <div id="app">

        <?php
        // ini_set("upload_max_filesize","9999999M");
        // ini_set('post_max_size', '9999999M');
        set_time_limit(9999999);
        // phpinfo();
        ?>

        @if (session('success'))
            <div class="p-3 mb-2 bg-success text-white success text-center">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="p-3 mb-2 bg-danger text-white error text-center">{{ session('error') }}</div>
        @endif



        {{-- begin #register --}}
        <div id="register-section1" class="bg-light2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <br>
                        <div class="left">
                            <a href="{{ url('course_view/' . $course->id) }}" style="background-color: #8B0900; color:white;"
                                class="btn "><i class="fa fa-chevron-left" aria-hidden="true"></i> ย้อนกลับ </a>
                        </div>
                        <br>
                        <h4 style="color:#8B0900;">เพิ่มบทเรียน ของ {{ @$course->name }}</h4>
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title text-center">สมัครสมาชิก</h5> --}}
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="POST" action="{{ url('chapter_store') }}" id="searchForm"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="course_id" value="{{ @$course->id }}">
                                    <input type="hidden" name="chapter_id" value="{{ @$data->id }}">

                                    <h5>บทเรียน</h5>

                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <label for="order">ลำดับบทเรียน</label>
                                            <input type="text" class="form-control" id="order"
                                                value="{{ @$data->order }}" name="order">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="name">ชื่อบทเรียน</label>
                                            <input type="text" class="form-control" id="name"
                                                value="{{ @$data->name }}" name="name">
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">วิดิโอ (จำนวน)</label>
                                            <input type="text" class="form-control" id=""
                                                value="{{ @$data->video_number }}" name="video_number">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">ชั่วโมงเรียนทั้งหมด (ชั่วโมง)</label>
                                            <input type="text" class="form-control" id=""
                                                value="{{ @$data->time_number }}" name="time_number">
                                        </div>

                                    </div>

                                    {{-- <hr>

                                    <h5>ข้อมูลหัวเรื่องในบท</h5>
                                    <hr>

                                    <div class="course_list">
                                        <div class="items">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="c_course_name">ชื่อเรื่อง</label>
                                                    <input type="text" class="form-control c_course_name"
                                                        name="c_course_name[]">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label for="c_course_detail">เพิ่มรายละเอียดของเรื่อง</label>
                                                    <textarea type="text" class="form-control c_course_detail" name="c_course_detail[]"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="">อัพโหลดไฟล์วิดิโอ</label>
                                                    <input type="file" class="form-control-file c_course_video"
                                                        name="c_course_video[]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr> --}}

                                    {{-- <div class="form-group">
                                        <button type="button" class="btn btn-outline-primary add_course">+
                                            เพิ่มเนื้อหา</button>
                                    </div> --}}

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-outline-success w-100">บันทึก</button>
                                        </div>
                                    </div>

                                    {{-- <div class="form-group">
                                        <a href="{{ url('course_view/' . $course->id) }}"
                                            class="btn btn-outline-secondary w-100">ย้อนกลับ</a>
                                    </div> --}}
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            @if (@$data)

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <br>
                            <h4 style="color:#8B0900;">หัวเรื่องในบทเรียน</h4>
                            <div class="card">
                                <div class="card-body">
                                    {{-- <h5 class="card-title text-center">สมัครสมาชิก</h5> --}}
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <strong>Whoops!</strong> There were some problems with your input.
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">เรื่อง</label>
                                            @foreach ($list as $c)
                                                <div class="input-group mb-3">
                                                    <input type="text" value="{{ @$c->course_name }}"
                                                        class="form-control form-control-sm"
                                                        placeholder="Recipient's username" readonly
                                                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                    <div class="input-group-append">
                                                        <a href="javascript:;" class="list_view"
                                                            list_id="{{ @$c->id }}" course_id="{{ @$c->course_id }}"
                                                            course_name="{{ @$c->course_name }}"
                                                            course_detail="{{ @$c->course_detail }}"
                                                            course_video="{{ @$c->course_video }}"
                                                            course_free="{{ @$c->course_free }}"
                                                            course_time="{{ @$c->course_time }}"
                                                            course_image="{{ @$c->course_image }}"
                                                            course_order="{{ @$c->course_order }}"
                                                            chapter_id="{{ @$c->chapter_id }}"><span
                                                                class="input-group-text" id="basic-addon2">ตั้งค่า
                                                                &nbsp;<i class="fa fa-gear"></i></span></a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {{-- <button type="submit" class="btn btn-outline-success w-100">บันทึก</button> --}}
                                        {{-- <button class="btn btn-outline-primary">+ เพิ่มคอร์สเรียน</button> --}}
                                        <a class="btn btn-outline-primary add_course_list" href="javascript:;">+
                                            เพิ่มเนื้อหา</a>
                                    </div>

                                    {{-- <div class="form-group" >
                                <button type="submit" style="background-color: #8B0900; color:white;" class="btn  w-100">Submit</button>
                             </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <br>
                            <h4 style="color:#8B0900;">แบบทดสอบ/Workshop</h4>
                            <div class="card">
                                <div class="card-body">
                                    {{-- <h5 class="card-title text-center">สมัครสมาชิก</h5> --}}
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <strong>Whoops!</strong> There were some problems with your input.
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">ชื่อแบบทดสอบ</label>
                                            @foreach ($workshop as $c)
                                                <div class="input-group mb-3">
                                                    <input type="text" value="{{ @$c->name }}"
                                                        class="form-control form-control-sm"
                                                        placeholder="Recipient's username" readonly
                                                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                    <div class="input-group-append">
                                                        <a
                                                            href="{{ url('workshop_view/' . @$data->id . '/' . @$c->id) }}"><span
                                                                class="input-group-text" id="basic-addon2">ตั้งค่า
                                                                &nbsp;<i class="fa fa-gear"></i></span></a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {{-- <button type="submit" class="btn btn-outline-success w-100">บันทึก</button> --}}
                                        {{-- <button class="btn btn-outline-primary">+ เพิ่มคอร์สเรียน</button> --}}
                                        <a class="btn btn-outline-primary"
                                            href="{{ url('workshop_add/' . @$data->id) }}">+
                                            แบบทดสอบ/Workshop</a>
                                    </div>

                                    {{-- <div class="form-group" >
                                <button type="submit" style="background-color: #8B0900; color:white;" class="btn  w-100">Submit</button>
                             </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal ข้อตกลงและเงื่อนไข-->
                <form method="POST" action="{{ url('course_list_store') }}" id="fileUploadForm"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="modal fade" id="add_course_list_modal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">

                        <input type="hidden" name="course_id" value="{{ @$course->id }}" class="course_id">
                        <input type="hidden" name="chapter_id" value="{{ @$data->id }}" class="chapter_id">
                        <input type="hidden" name="list_id" value="" class="list_id">

                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มเนื้อหา</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                                    </button>
                                </div>
                                <div class="modal-body text-justify">
                                    <div class="course_list">
                                        <div class="items">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="course_name">ชื่อเรื่อง</label>
                                                    <input type="text" class="form-control course_name" required
                                                        name="course_name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label for="course_detail">เพิ่มรายละเอียดของเรื่อง</label>
                                                    <textarea type="text" class="form-control course_detail" name="course_detail"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="course_order">ลำดับ</label>
                                                    <input type="text" class="form-control course_order" required
                                                        name="course_order">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="">อัพโหลดไฟล์วิดิโอ</label>
                                                    <input type="file" class="form-control-file course_video"
                                                        name="course_video">
                                                    <br>
                                                    <div class="form-group">
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                                                role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                                                aria-valuemax="100" style="width: 0%"></div>
                                                        </div>
                                                    </div>
                                                    <video width="320" height="240" controls>
                                                        <source class="course_video_play" src=""
                                                            type="video/mp4">
                                                        {{-- <source src="{{asset('images/profile/'.$c->course_video)}}" type="video/mp4"> --}}
                                                        {{-- <source src="movie.ogg" type="video/ogg"> --}}
                                                    </video>
                                                    <button class="btn btn-sm btn-danger remove_video" type="button"
                                                        title="ลบวิดิโอ" onclick="return confirm('ยืนยันการลบวิดิโอ?')">
                                                        <i class="fa fa-trash"></i> </button>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="">ภาพหน้าปกวิดิโอ</label>
                                                    <input type="file" class="form-control-file course_image"
                                                        id="course_image" name="course_image">
                                                    <br>
                                                    <img class="course_image_img" src="" width="300px"
                                                        height="250px">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    <label for="course_free">สถานะ</label>
                                                    <select class="form-control course_free" required name="course_free">
                                                        <option value="">กรุณาเลือก</option>
                                                        <option value="0">ฟรี</option>
                                                        <option value="1">ไม่ฟรี</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="course_time">ความยาววิดีโอ</label>
                                                    <input type="text" class="form-control course_time" required
                                                        name="course_time">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                {{-- end #register --}}

            @endif

            <br>


        </div>


    </div>


    {{-- <div class="container mt-5" style="max-width: 900px">

        <div class="alert alert-primary mb-4 text-center">
           <h2 class="display-6">Laravel File Upload with Ajax Progress Bar Example - ItSolutionStuff.com</h2>
        </div>
        <form id="fileUploadForm" method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <input name="file" type="file" class="form-control">
            </div>
            <div class="form-group">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                </div>
            </div>
            <div class="d-grid mt-4">
                <input type="submit" value="Submit" class="btn btn-primary">
            </div>
        </form>
    </div> --}}




    {{-- <script src="/js/app.js" charset="utf-8"></script> --}}

    <script src="{{ asset('js/app.js') }}"></script>
@endsection
@section('script')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('select2/select2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
        integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous">
    </script>

    <script>
        $(function() {
            $(document).ready(function() {
                $('#fileUploadForm').ajaxForm({
                    beforeSend: function() {
                        var percentage = '0';
                        $('.loader').show();
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        var percentage = percentComplete;
                        $('.progress .progress-bar').css("width", percentage + '%', function() {
                            return $(this).attr("aria-valuenow", percentage) + "%";
                        })
                    },
                    complete: function(xhr) {
                        console.log('File has uploaded');
                        $('.loader').hide();
                        location.reload();
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            // $('#typeUser').hide();
            $('.select2').select2({
                width: '100%',
            });
            // CKEDITOR.replace('detail_scope');

            setTimeout(function() {
                $('.success').hide()
            }, 2000);
            setTimeout(function() {
                $('.error').hide()
            }, 2000);

        });

        $(document).on('click', '.remove_video', function() {
            var list_id = $('#add_course_list_modal .list_id').val();
            $.ajax({
                url: " {{ url('course_list_remove_video') }} ",
                method: "post",
                data: {
                    list_id: list_id,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    location.reload();
                }
            })
        });

        $(document).on('click', '.add_course_list', function() {
            $('#add_course_list_modal .list_id').val('');
            $('#add_course_list_modal .course_name').val('');
            $('#add_course_list_modal .course_detail').val('');
            $('#add_course_list_modal .course_free').val('');
            $('#add_course_list_modal .course_time').val('');
            $('#add_course_list_modal .course_order').val('');
            $('#add_course_list_modal .course_video_play').attr('src', "");
            $("#add_course_list_modal video")[0].load();
            $("#add_course_list_modal video").hide();
            $("#add_course_list_modal .course_image_img").hide();

            $('#add_course_list_modal').modal('show');
        });

        $(document).on('click', '.list_view', function() {
            var list_id = $(this).attr('list_id');
            // var course_id = $(this).attr('course_id');
            // var chapter_id = $(this).attr('chapter_id');
            var course_name = $(this).attr('course_name');
            var course_detail = $(this).attr('course_detail');
            var course_video = $(this).attr('course_video');
            var course_free = $(this).attr('course_free');
            var course_time = $(this).attr('course_time');
            var course_image = $(this).attr('course_image');
            var course_order = $(this).attr('course_order');

            $('#add_course_list_modal .list_id').val(list_id);
            $('#add_course_list_modal .course_name').val(course_name);
            $('#add_course_list_modal .course_detail').val(course_detail);
            $('#add_course_list_modal .course_free').val(course_free);
            $('#add_course_list_modal .course_time').val(course_time);
            $('#add_course_list_modal .course_order').val(course_order);

            $('#add_course_list_modal .course_video_play').attr('src', "{{ asset('images/profile') }}/" +
                course_video);
            $('#add_course_list_modal .course_image_img').attr('src', "{{ asset('images/profile') }}/" +
                course_image);
            $("#add_course_list_modal video")[0].load();
            $("#add_course_list_modal video").show();
            $("#add_course_list_modal .course_image_img").show();
            $('#add_course_list_modal').modal('show');
        });

        // $(document).on('click', '.add_course', function() {
        //     var p = '<div class="items">' +
        //         '<div class="form-group row">' +
        //         '<div class="col-md-6">' +
        //         '<label for="c_course_name">ชื่อเรื่อง</label>' +
        //         '<input type="text" class="form-control c_course_name"' +
        //         'name="c_course_name[]">' +
        //         '</div>' +
        //         '</div>' +
        //         '<div class="form-group row">' +
        //         '<div class="col-md-12">' +
        //         '<label for="c_course_detail">เพิ่มรายละเอียดของเรื่อง</label>' +
        //         '<textarea type="text" class="form-control c_course_detail" name="c_course_detail[]"></textarea>' +
        //         '</div>' +
        //         '</div>' +
        //         '<div class="form-group row">' +
        //         '<div class="col-md-6">' +
        //         '<label for="">อัพโหลดไฟล์วิดิโอ</label>' +
        //         '<input type="file" class="form-control-file c_course_video"' +
        //         'name="c_course_video[]">' +
        //         '</div>' +
        //         '</div>' +
        //         '</div>';

        //         $( ".course_list" ).append(p);
        // });


        $(function() {
            $(":checkbox[name=i_accept]").on("click", function() {
                var i_check = $(this).prop("checked");
                console.log(i_check);
                if (i_check == true) {
                    $("button[name=btn_send]").attr("disabled", false);
                } else {
                    $("button[name=btn_send]").attr("disabled", true);
                }
            });
        });
    </script>
    <script>
        $('.bg-light').css({
            'min-height': $(window).height() - $('.navbar').height() - $('#section-footer').height()
        });
    </script>
@endsection
