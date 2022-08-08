@extends('layouts.navber')
@section('head')

@endsection
@section('content')
    {{-- begin # --}}
    <div class="jumbotron jumbotron-fluid mb-0">
        <div class="container">
            <h1 class="display-4">Promotion</h1>
            <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
        </div>
    </div>

    <div id="con-section1" class="bg-light">
        <div class="container py-5">
            <div class="card mb-5">
                <div class="card-header bg-orangeY h2">Promotions</div>
                @foreach($promotions as $pro)
                <div class="card-body">
                    <h5>{{ $pro->title }}</h5>
                    <small class="text-muted">วันที่ {{ $pro->startdate }} - {{ $pro->enddate }}</small>
              {!! $pro->details !!}
                    <img src="{{ asset('images/promotion/'.$pro->filename) }}" class="mw-100">
                    <hr>
                    {{-- <h5>Interdum sollicitudin sapien parturient diam, vestibulum dolor posuere enim, ac ultrices pede gravida amet et.</h5>
                    <small class="text-muted">วันที่ dd/mm/yyyy - dd/mm/yyyy</small>
                    <p>Lorem ipsum dolor sit amet, suspendisse scelerisque ducimus malesuada ac dui, sed dictumst augue sed nec vel, viverra ut ullamcorper hendrerit maecenas sed rutrum. Lorem ipsum dolor sit amet, suspendisse scelerisque ducimus malesuada ac dui, sed dictumst augue sed nec vel, viverra ut ullamcorper hendrerit maecenas sed rutrum.</p>
                    <img src="{{ asset('images/banner-promotion-sample02.png') }}" class="mw-100"> --}}
                </div>
                @endforeach
            </div>
            {{-- <div class="card mb-5">
                <div class="card-header bg-orangeY h2">Febuary 2019</div>
                <div class="card-body">
                    <h5>Interdum sollicitudin sapien parturient diam, vestibulum dolor posuere enim, ac ultrices pede gravida amet et.</h5>
                    <small class="text-muted">วันที่ dd/mm/yyyy - dd/mm/yyyy</small>
                    <p>Lorem ipsum dolor sit amet, suspendisse scelerisque ducimus malesuada ac dui, sed dictumst augue sed nec vel, viverra ut ullamcorper hendrerit maecenas sed rutrum. Lorem ipsum dolor sit amet, suspendisse scelerisque ducimus malesuada ac dui, sed dictumst augue sed nec vel, viverra ut ullamcorper hendrerit maecenas sed rutrum.</p>
                    <img src="{{ asset('images/banner-promotion-sample02.png') }}" class="mw-100">
                </div>
            </div> --}}

        </div>
    </div>
    {{-- end # --}}

@endsection
@section('script')

@endsection