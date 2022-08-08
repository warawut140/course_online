@extends('layouts.navber')
@section('head')

@endsection
@section('content')
    {{-- begin #ช่องทางเติมเงิน/ชำระเงิน --}}
    <div id="con-banner" class="bg-payment">
        <div class="container py-5">
            <div class="text-headbanner">ช่องทางเติมเงิน/ชำระเงิน</div>
        </div>
    </div>
    <div id="con-section1" class="bg-light">
        <div class="container py-5">
            <div class="card">
                <div class="card-body text-center">
                    <div class="row">
                        <div class="col-sm-6">
                            <img src="{{ asset('images/transfer.png') }}" class="mw-100 mb-3">
                            <h4>โอนเงิน</h4>
                            <p>Lorem ipsum dolor sit amet, praesent lectus volutpat potenti, fusce curabitur pharetra
                                dictum.</p>
                        </div>
                        <div class="col-sm-6">
                            <img src="{{ asset('images/credit-card.png') }}" class="mw-100 mb-3">
                            <h4>บัตรเครดิต</h4>
                            <p>Fringilla ut eleifend tincidunt, maxime ipsum felis molestie vestibulum, id placerat
                                litora lectus, lacus hac leo wisi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container pb-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <form id="my-form" action="https://api.gbprimepay.com/v1/tokens/3d_secured" method="post">
                                @csrf
                                <input type="text" name="gbpReferenceNo" value="{{$gbpReferenceNo}}">
                                <input type="text" name="publicKey" value="3zqYYH1KvFuvDJDILiZXCMVB5e3JjD8r">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end #ช่องทางเติมเงิน/ชำระเงิน --}}

@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#my-form').submit();
        });
    </script>
@endsection
