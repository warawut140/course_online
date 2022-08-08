@extends('layouts.navber')
@section('head')
    <style>
        #gb {
            display: none;
        }
    </style>
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
                            @if($page == 1)
                                <h3 class="mb-3 text-center">การเติมเงินในระบบ</h3>
                                <p class="text-justify" style="text-indent:50px;">Lorem ipsum dolor sit amet, modi enim
                                    a
                                    quam. Sed curabitur vivamus mollis arcu donec libero, neque congue euismod, blandit
                                    phasellus lorem id penatibus, non lacinia adipiscing. Quam donec morbi turpis a,
                                    ipsum
                                    vivamus nullam vulputate molestie, nec faucibus at leo sodales lectus pede. Suscipit
                                    magna, a orci commodo est magnam nisl, quisque facilisis odio ut donec convallis ad,
                                    aut
                                    donec lacinia ac et. Ultrices eu rhoncus, eros hac ac et</p>

                                <div class="accordion" id="accordionExample">
                                    <div class="card border-warning">
                                        <div class="card-header bg-orange" id="headingOne">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link text-white" type="button"
                                                        data-toggle="collapse"
                                                        data-target="#collapseOne" aria-expanded="true"
                                                        aria-controls="collapseOne">
                                                    Collapsible Group Item #1 <i
                                                        class='fas fa-chevron-circle-right'></i>
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                             data-parent="#accordionExample">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry
                                                richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                                dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                moon
                                                tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                                                assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer
                                                labore
                                                wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur
                                                butcher
                                                vice lomo. Leggings occaecat craft beer farm-to-table, raw denim
                                                aesthetic
                                                synth nesciunt you probably haven't heard of them accusamus labore
                                                sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card border-warning">
                                        <div class="card-header bg-orange" id="headingTwo">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link collapsed text-white" type="button"
                                                        data-toggle="collapse" data-target="#collapseTwo"
                                                        aria-expanded="false" aria-controls="collapseTwo">
                                                    Collapsible Group Item #2 <i
                                                        class='fas fa-chevron-circle-right'></i>
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                             data-parent="#accordionExample">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry
                                                richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                                dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                moon
                                                tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                                                assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer
                                                labore
                                                wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur
                                                butcher
                                                vice lomo. Leggings occaecat craft beer farm-to-table, raw denim
                                                aesthetic
                                                synth nesciunt you probably haven't heard of them accusamus labore
                                                sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card border-warning">
                                        <div class="card-header bg-orange" id="headingThree">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link collapsed text-white" type="button"
                                                        data-toggle="collapse" data-target="#collapseThree"
                                                        aria-expanded="false" aria-controls="collapseThree">
                                                    Collapsible Group Item #3 <i
                                                        class='fas fa-chevron-circle-right'></i>
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                             data-parent="#accordionExample">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry
                                                richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                                dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                moon
                                                tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                                                assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer
                                                labore
                                                wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur
                                                butcher
                                                vice lomo. Leggings occaecat craft beer farm-to-table, raw denim
                                                aesthetic
                                                synth nesciunt you probably haven't heard of them accusamus labore
                                                sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (!Auth::guest())
                                    <div class="text-center py-5">
                                        <a href="{{ url('payment-credit') }}"
                                           class="btn btn-warning btn-lg">เติมเงิน</a>
                                    </div>
                                @endif
                            @else
                                <h3 class="mb-3 text-center">เติมเงินเข้าระบบ</h3>
                                <div id="form_price" class="text-center">
                                    <div class="form-group">
                                        <div class="sm-6">
                                            <label> จำนวนเงินเติม Coins</label>
                                            <center>
                                                <input class="form-control col-sm-3" type="number" name="price_input"
                                                       id="price_input" value="0">
                                            </center>
                                            <br>
                                            <br>
                                            <button type="button" id="show" class="btn btn-outline-success">เติมเงิน</button>
                                        </div>
{{--                                        <div class="col-sm-3"></div>--}}
                                    </div>
                                </div>
                                <div id="gb">
                                    <form id="checkout-form" action="{{ url('payment') }}" method="post">
                                        @csrf
                                        <div id="gb-form" style="height: 600px;">
                                            <input type="hidden" name="auth_id" value="{{$auth_id}}">
                                            <input type="hidden" name="price" id="price">
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end #ช่องทางเติมเงิน/ชำระเงิน --}}

@endsection
@section('script')
    <script src="{{ asset('GBPrimePay.js') }}"></script>
    <script>
        $(document).ready(function(){
            $("#show").click(function(){
                var price = $('#price_input').val();
                if(price != '' && price != 0){
                    $("#gb").show();
                    $("#form_price").hide();
                    $('#price').val = price;
                    document.getElementById("price").value = price;
                }else{
                    Swal({
                        type: 'warning',
                        title: "กรุณาระบุ  จำนวนเงินเติม Coins !",
                        showConfirmButton: false,
                        timer: 1200
                    })
                }
            });
        });
        new GBPrimePay({
            amount: $('#price').val(),
            publicKey: '3zqYYH1KvFuvDJDILiZXCMVB5e3JjD8r',
            gbForm: '#gb-form',
            merchantForm: '#checkout-form',
            // amount: price,
            customStyle: {
                backgroundColor: '#eaeaea'
            },
            env: 'prd' // default prd | optional: test, prd
        });
    </script>
    <script>

    </script>
@endsection
