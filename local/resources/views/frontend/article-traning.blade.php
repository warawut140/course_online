@extends('layouts.navber')
@section('head')

@endsection
@section('content')
    {{-- begin # --}}
    <div id="article-section1" class="bg-light">
        <div class="container py-5">
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <h4>{{ $training->title }}</h4>
                        <small>โดย
                            <span><a href=""><i class='fas fa-user-circle'></i> {{ $training->username }}</a></span>
                            สร้างเมื่อ <span>
                                <?php
                                list($year, $month, $day) = explode('-', date('Y-m-d', strtotime($training->created_at)));
                                $year += 543;
                                echo $day . "/" . $month . '/' . $year;
                                ?>,{{ date('H:i:s',strtotime($training->created_at)) }}
                            </span>
                        </small>
                        <hr>
                        <div class="text-justify">
                            {!! $training->details !!}
                            <br><br>
                            <div class="row">
                                @if($training->video_training != null)
                                    <div class="col-sm-12">
                                        <video controls class="mw-100 w-100">
                                            <source src="{{ asset('images/training/video/'.$training->video_training) }}" type="video/mp4">
                                            {{--<source src="mov_bbb.ogg" type="video/ogg">--}}
                                        </video>
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                @if($trainingGallery != null)
                                    <br><hr>
                                    @foreach($trainingGallery as $value)
                                        <div class="col-sm-4">
                                            <img src="{{ asset('/images/training/gallery/'.$value->filename) }}" class="mw-100 mb-3">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        @if (!Auth::guest())
                            <br><hr>
                            <div class="row">
                                <div class="col-md-6 offset-md-3">
                                    <div class="card border-warning">
                                        <div class="card-body">
                                            <h5>แสดงความคิดเห็น</h5>
                                            {!! Form::open(['url' => 'training/storeComment' , 'enctype' => 'multipart/form-data' ]) !!}
                                            <input type="hidden" name="training_id" id="training_id" value="{{ $id }}">
                                            <textarea class="form-control" rows="5" name="details" required></textarea>
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-dark mt-2">ส่งความคิดเห็น</button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if($trainingComment != null)
                            <div class="container-fluid py-3 text-center middle">
                                <div class="row">
                                    <div>
                                        {!! $trainingComment->links()!!}
                                    </div>
                                </div>
                            </div>
                            <?php $i = 0 ?>
                            @foreach($trainingComment as $key => $value)
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card border-warning mb-2">
                                            <div class="card-header">
                                                <h5 class="mb-0">ความคิดเห็น #{{ $key+1 }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <p>{{ $value->details }}</p>
                                            </div>
                                            <div class="card-footer text-right">
                                                <small>
                                                    <?php
                                                    list($year, $month, $day) = explode('-', date('Y-m-d', strtotime($value->created_at)));
                                                    $year += 543;
                                                    echo $day . "/" . $month . '/' . $year;
                                                    ?>,{{ date('H:i:s',strtotime($value->created_at)) }}
                                                    โดย <span><a href=""><i
                                                                    class='fas fa-user-circle'></i> {{ $value->actby }}</a> </span>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <?php $i++ ?>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end # --}}

@endsection
@section('script')
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