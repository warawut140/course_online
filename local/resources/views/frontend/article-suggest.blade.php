@extends('layouts.navber')
@section('head')
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">--}}
@endsection
@section('content')
    {{-- begin # --}}
    <div id="article-section1" class="bg-light">
        <div class="container py-5">
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <h4>{{ $suggests->title }}</h4>
                        <small><i class="fab fa-blogger"></i>
                            <span>{{ $suggests->name }}</span>
                        </small>
                        <small>โดย <span><a href=""><i
                                            class='fas fa-user-circle'></i> {{ $suggests->username }}</a> </span>สร้างเมื่อ
                            <span>
                                       <?php
                                list($year, $month, $day) = explode('-', date('Y-m-d', strtotime($suggests->created_at)));
                                $year += 543;
                                echo $day . "/" . $month . '/' . $year;
                                ?>,{{ date('H:i:s',strtotime($suggests->created_at)) }}
                            </span>
                        </small>
                        {{--@if($edit == "edit")--}}
                            {{--<a href="{{ url('suggest/delete/'.$id) }}"><i class='fa fa-trash-o'></i></a>--}}
                        {{--@endif--}}
                        <hr>
                        <div class="text-justify">
                            {!! $suggests->details !!}
                            <div class="row">
                                @if($suggestsGallery != null)
                                    @foreach($suggestsGallery as $value)
                                        <div class="col-sm-4">
                                            <img src="{{ asset('images/suggest/'.$value->filename) }}" class="mw-100 mb-3">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <hr>

                        @if (!Auth::guest())
                            <div class="row">
                                <div class="col-md-6 offset-md-3">
                                    <div class="card border-warning">
                                        <div class="card-body">
                                            <h5>แสดงความคิดเห็น</h5>
                                            {!! Form::open(['url' => 'suggest/storeComment' , 'enctype' => 'multipart/form-data' ]) !!}
                                            <input type="hidden" name="suggest_id" id="suggest_id" value="{{ $id }}">
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

                        @if($suggestsComment != null)
                            <div class="container-fluid py-3 text-center middle">
                                <div class="row">
                                    <div>
                                        {!! $suggestsComment->links()!!}
                                    </div>
                                </div>
                            </div>
                            <?php $i = 0 ?>
                            @foreach($suggestsComment as $key => $value)
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
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('editor');
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