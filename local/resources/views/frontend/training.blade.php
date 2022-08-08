@extends('layouts.navber')
@section('head')

@endsection
@section('content')
    {{-- begin # เลือก --}}
    <div id="work-section1" class="bg-orange">
        <div class="container py-5">
            <h4 class="text-white">เลือก</h4>
            <form action="searchTraining"  method="POST" role="search">
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="form-group col-md">
                        <label for="category" class="text-white">หน้าแสดงผล</label>
                        <select id="category" class="form-control" name="type_page">
                            <option value="1" selected>อบรม</option>
                            <option value="2" >คอร์สออนไลน์</option>
                        </select>
                    </div>
                    <div class="form-group col-md">
                        <label for="price" class="text-white">หมวดหมู่</label>
                        {!!  Form::select('tags', $tags, null, ['id' => 'tags_id','class' => 'form-control' , 'placeholder' => 'ทั้งหมด' ]) !!}
                    </div>
                    <div class="form-group col-md">
                        <label for="inputPassword4">&nbsp;</label>
                        {{--<a href="{{ url('course') }}" class="btn btn-dark w-100"><i--}}
                                    {{--class='fas fa-arrow-alt-circle-right'></i></a>--}}
                        <button class="btn btn-dark w-100" type="submit"><i class='fas fa-arrow-alt-circle-right'></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- end # เลือก --}}

    {{-- begin # อบรมและสาระ --}}
    {{--title--}}
    <div id="traning-section1" class="bg-white">
        <div class="container py-5 text-center">
            <h2>อบรมและสาระ</h2>
            @if (!Auth::guest())
                <div class="text-right">
                    <button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#exampleModal" id="btn_post">ตั้งกระทู้</button>
                </div>
            @endif
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ตั้งกระทู้อบรม</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                        </button>
                    </div>
                    {!! Form::open(['url' => 'training' , 'files'=>true , 'data-parsley-required' => 'true' ]) !!}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div id="app">
                            <div class="form-group">
                                <label for="exampleInputEmail1">ชื่อหัวข้อ</label>
                                {!!  Form::text('title',null,['id' => 'title','class' => 'form-control' , 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">หมวดหมู่</label>
                                <br>
                                <div v-for="(row , index) in rows" :row="row">
                                    <select name="tags[]" id="tags[]" class="form-control" required>
                                        <option selected disabled value="">กรุณาเลือก</option>
                                        @foreach($tags2 as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button v-on:click="addRow(1)" type="button" class="btn btn-outline-secondary"><i
                                            class='fas fa-plus'></i></button>
                                <button v-on:click="removeRow(0)" type="button" class="btn btn-outline-secondary"><i
                                            class='fas fa-minus'></i></button>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">ภาพประกอบ</label>
                                <input type="file" name="image_training" class="form-control-file" required>
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
                                          rows="10" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-success">ยืนยันตั้งกระทู้</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    {{--content--}}
    <div id="traning-section2" class="bg-white">
        <div class="container">
            @if($training!=null)
                @foreach($training as $value)
                    <div class="box-articleTraining">
                        <a href="{{ url('training/'.$value->id) }}">
                            <div class="row">
                                <div class="col-sm-1 col-2 px-xl-0">
                                    <?php
                                    list($year, $month, $day) = explode('-', date('Y-m-d', strtotime($value->created_at)));
                                    if ($day < 10) {
                                        $day = substr($day, 1, 1);
                                    }

                                    $thMonth = array("ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.",
                                        "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
                                    if ($month < 10) {
                                        $month = substr($month, 1, 1);
                                    }
                                    $year += 543;
    //                                echo $thMonth[$month - 1] . "&nbsp;" . $day . "&nbsp;" . $year;
                                    ?>
                                    <div class="h1 text-orange text-center mb-0"><?php echo $day ;?></div>
                                    <div class="text-center text-secondary"><?php echo $thMonth[$month - 1] ;?><br><?php echo $year ;?></div>
                                </div>
                                <div class="col-sm-5 col-10">
                                    <img src="{{ asset('/images/training/image/'.$value->image_training) }}" class="mw-100 w-100">
                                </div>
                                <div class="col-sm-6 pt-2">
                                    <h4>{{ $value->title }}</h4>
                                    <div class="text-justify text-des-article">
                                        {!! $value->details !!}
                                    </div>
                                    <div class="text-right"><i class="material-icons">&#xe417;</i> {{ $value->total }}
                                        <i class="material-icons">&#xe0ca;</i> {{ $value->commentTotal }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                 @endforeach
            @endif
        </div>
    </div>

    @if($training!=null)
        <div id="traning-section3" class="bg-light">
            <div class="container-fluid py-5 text-center middle">
                <div class="row">
                    <div>
                        {!! $training->links()!!}
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- end # อบรมและสาระ --}}

    {{--<script src="/js/app.js" charset="utf-8"></script>--}}
    <script src="{{ asset('js/app.js') }}" ></script>

@endsection
@section('script')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        // $(document).ready(function(){
        //     CKEDITOR.replace('editor');
        // });

        $(document).on('click', '#btn_post', function(){
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
@endsection