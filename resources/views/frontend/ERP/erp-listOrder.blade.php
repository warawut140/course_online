@extends('layouts.navber')
@section('head')
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script src="{{ asset('js/modernizr.js') }}"></script>

@endsection
@section('content')
    <div id="app">
        <div class="wrapper-erp">
            <!-- Sidebar Holder -->
        @include('layouts.sidebar-erp')
        <!-- Page Content Holder -->
            <div id="content-erp">
                <div class="row">
                    <div class="col-sm-12">
                        <nav class="navbar navbar-default mb-3">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <button type="button" id="sidebarCollapse-erp" class="btn btn-orange navbar-btn">
                                        <i class='fas fa-bars'></i>
                                    </button>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h3>รายการสั่งซื้อ</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr class="text-center">
                                    <th scope="col" style="min-width:20px">#</th>
                                    <th scope="col" style="min-width:200px">รายการ</th>
                                    <th scope="col" style="min-width:200px">รายละเอียดสินค้า</th>
                                    <th scope="col" style="min-width:80px">ร้านค้า</th>
                                    <th scope="col" style="min-width:100px">วันที่สั่งซื้อ</th>
                                    <th scope="col" style="min-width:100px">วันที่ติดตั้ง</th>
                                    <th scope="col" style="min-width:100px">ข้อมูลติดต่อ</th>
                                    <th scope="col" style="min-width:100px">ตรวจสอบ</th>
                                    <th scope="col" style="min-width:100px">สถานะ</th>
                                    <th scope="col" style="min-width:100px">การชำระเงิน</th>
                                    <th scope="col" style="min-width:60px">ยกเลิก</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>&&&&&&&&</td>
                                    <td class="text-center"><button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#detailOrderModal"><i class='fas fa-list'></i> ดูรายละเอียด</button></td>
                                    <td>mdo</td>
                                    <td>dd/mm/yyyy</td>
                                    <td>dd/mm/yyyy</td>
                                    <td class="text-center"><button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#detailContactModal"><i class='fas fa-address-book'></i> ดูข้อมูลติดต่อ</button></td>
                                    <td class="text-center"><h6><span class="badge badge-secondary font-weight-light">รอตรวจสอบ</span></h6></td>
                                    <td class="text-center"><h6><span class="badge badge-secondary font-weight-light">-</span></h6></td>
                                    <td>Visa/Cash</td>
                                    <td class="text-center"><button class="btn btn-danger btn-sm"><i class='fas fa-trash-alt'></i></button></td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>&&&&&&&&</td>
                                    <td class="text-center"><button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#detailOrderModal"><i class='fas fa-list'></i> ดูรายละเอียด</button></td>
                                    <td>mdo</td>
                                    <td>dd/mm/yyyy</td>
                                    <td>dd/mm/yyyy</td>
                                    <td class="text-center"><button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#detailContactModal"><i class='fas fa-address-book'></i> ดูข้อมูลติดต่อ</button></td>
                                    <td class="text-center"><h6><span class="badge badge-secondary font-weight-light">รอตรวจสอบ</span></h6></td>
                                    <td class="text-center"><h6><span class="badge badge-secondary font-weight-light">-</span></h6></td>
                                    <td>Visa/Cash</td>
                                    <td class="text-center"><button class="btn btn-danger btn-sm"><i class='fas fa-trash-alt'></i></button></td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>&&&&&&&&</td>
                                    <td class="text-center"><button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#detailOrderModal"><i class='fas fa-list'></i> ดูรายละเอียด</button></td>
                                    <td>mdo</td>
                                    <td>dd/mm/yyyy</td>
                                    <td>dd/mm/yyyy</td>
                                    <td class="text-center"><button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#detailContactModal"><i class='fas fa-address-book'></i> ดูข้อมูลติดต่อ</button></td>
                                    <td class="text-center"><h6><span class="badge badge-secondary font-weight-light">รอตรวจสอบ</span></h6></td>
                                    <td class="text-center"><h6><span class="badge badge-secondary font-weight-light">-</span></h6></td>
                                    <td>Visa/Cash</td>
                                    <td class="text-center"><button class="btn btn-danger btn-sm"><i class='fas fa-trash-alt'></i></button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- detailOrderModal -->
        <div class="modal fade" id="detailOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">รายละเอียดสินค้า - &&&&&&&&</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label font-weight-bold">ยี่ห้อ</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="xxxxxxxxxxx">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label font-weight-bold">รุ่น</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="xxxxxxxxxxx">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label font-weight-bold">ขนาด</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="xxxxxxxxxxx">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label font-weight-bold">อุปกรณ์ติดตั้ง</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="xxxxxxxxxxx">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">ok</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Contact-->
        <div class="modal fade" id="detailContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ข้อมูลติดต่อ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label font-weight-bold">ชื่อ</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="xxxxxxxxxxx">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label font-weight-bold">อีเมล์</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="xxxxxxxxxxx">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label font-weight-bold">เบอร์โทร</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="xxxxxxxxxxx">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label font-weight-bold">ID Line</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="xxxxxxxxxxx">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">ok</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{--<script src="/js/app.js" charset="utf-8"></script>--}}
    <script src="{{ asset('js/app.js') }}" ></script>

@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse-erp').on('click', function () {
                $('#sidebar-erp').toggleClass('active');
                myFunction();
            });
            myFunction();
        });
    </script>

    <script>
        $('.sidenav-item').eq(2).find('a').addClass('active');
    </script>
    <script>
        function myFunction(x) {
            if (Modernizr.mq('(max-width: 767px)')) {
                if ($('#sidebar-erp').hasClass('active')){

                    $('#content-erp').css({"width": $(window).width() - 160});
                } else {
                    $('#content-erp').css({"width": "100%"});

                }
            }else {
                if ($('#sidebar-erp').hasClass('active')){
                    $('#content-erp').css({"width": "100%"});
                } else {
                    $('#content-erp').css({"width": $(window).width() - 250});
                }
            }
        }
    </script>
@endsection