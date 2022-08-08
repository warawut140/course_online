@extends('layouts.navber')
@section('head')

@endsection
@section('content')
    {{-- begin #title --}}
        <div id="traning-section1" class="bg-light">
            <div class="container py-5 text-center">
                <h2>ปรึกษาและแนะนำ</h2>
                @if (!Auth::guest())
                <button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#exampleModal">ตั้งกระทู้</button>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ตั้งกระทู้</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                        </button>
                    </div>
                    {!! Form::open(['url' => 'suggest' , 'files'=>true  , 'enctype' => 'multipart/form-data' ]) !!}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">ชื่อหัวข้อ</label>
                            <input type="text" class="form-control" name="title" id="exampleInputEmail1"
                                   aria-describedby="emailHelp" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">ประเภทหัวข้อ</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type_suggest_id" id="type_suggest_id"
                                       value="1" checked>
                                <label class="form-check-label" for="inlineRadio1">ปรึกษา</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type_suggest_id" id="type_suggest_id"
                                       value="2">
                                <label class="form-check-label" for="inlineRadio2">แนะแนว</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">รายละเอียด</label>
                            {!!  Form::textarea('details',null,['id' => 'editor','rows'=>10 ,'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">รูปอัมบั้ม</label>
                            <input type="file" name="galley[]" id="galley[]" multiple>
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
        {{-- end #title --}}

    {{-- begin #contact --}}
    <div id="traning-section2" class="bg-light">
        <div class="container">
            <div class="row">
                @foreach($suggests as $suggest)
                    <div class="col-sm-6">
                        <div class="card border-warning rounded-0 test-articlebox mb-4">
                            <a href="{{ url('suggest/'.$suggest->id) }}">
                                <div class="card-body p-2">
                                    <h5 class="card-title mb-0">
                                <span class="fa-stack">
                                    <i class="fas fa-square fa-stack-2x text-warning"></i>
                                    <i class="fas fa-question fa-inverse fa-stack-1x"></i>
                                </span>
                                        {{ $suggest->title }}
                                    </h5>
                                    <small class="text-secondary pl-2"><i class='fas fa-calendar-alt'></i>
                                        <span>
                                        <?php
                                            list($year, $month, $day) = explode('-', date('Y-m-d', strtotime($suggest->created_at)));
                                            if ($day < 10) {
                                                $day = substr($day, 1, 1);
                                            }

                                            $thMonth = array("ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.",
                                                "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
                                            if ($month < 10) {
                                                $month = substr($month, 1, 1);
                                            }
                                            $year += 543;
                                            echo $thMonth[$month - 1] . "&nbsp;" . $day . "&nbsp;" . $year;
                                            ?>
                                    </span> โดย <i class='fas fa-user-circle'></i> {{ $suggest->username }} </small>
                                    <hr class="my-2">
                                    {{--<p class="card-text text-des-test" style="height: 100px;overflow: hidden;text-align: justify;">--}}
                                    {{--{!! $suggest->details !!}--}}
                                    {{--</p>--}}
                                    <div class="text-des-projectauc">
                                        {!! $suggest->details !!}
                                    </div>
                                    <br>
                                    <div class="">
                                        <i class="material-icons">&#xe417;</i> {{ $suggest->total }}
                                        <i class="material-icons">&#xe0ca;</i> {{ $suggest->commentTotal }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @if($suggests!=null)
        <div id="traning-section3" class="bg-light">
            <div class="container-fluid py-5 text-center middle">
                <div class="row">
                    <div>
                        {!! $suggests->links()!!}
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- end #contact --}}
@endsection
@section('script')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('editor');
    </script>
@endsection