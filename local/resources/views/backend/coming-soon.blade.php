@extends('layouts.nevber-admin')
@section('head')

@endsection
@section('content')
    <div id="content" class="content">

        <!-- begin row -->
        <div class="row">
            <img src="{{ asset('image/web_under_construction1.png') }}" style="width: 100%;margin-top: 30px;">
        </div>
    {{--</div>--}}
    <!-- end row -->
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            App.init();

        });
    </script>
@endsection