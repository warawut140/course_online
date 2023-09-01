@extends('layouts.navber')
@section('head')
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script src="{{ asset('js/modernizr.js') }}"></script>
    @include('sweetalert::alert')
    <style>
        div.zabuto_calendar .table tr:last-child {
            border-bottom: 0;
        }

        div.zabuto_calendar .table tr.calendar-month-header td {
            background-color: #400202;
        }

        div.zabuto_calendar .table tr.calendar-dow-header th {
            background-color: #400202;
            letter-spacing: 1px;
        }

        div.zabuto_calendar .table tr th, div.zabuto_calendar .table tr td {
            background-color: #400202;
        }

        div.zabuto_calendar .table tr td div.day {
            background-color: white;
            color: black;
            font-weight: bold;
        }

        div.zabuto_calendar .table tr.calendar-month-header td span {
            letter-spacing: 1px;
        }

        div.zabuto_calendar .table tr td.event div.day, div.zabuto_calendar ul.legend li.event {
            background-color: #b95454;
            color: white;
        }

        div.zabuto_calendar .table th, div.zabuto_calendar .table td {
            padding: 4px
        }

        div#map_canvas{
            margin:auto;
            width:600px;
            height:500px;
            overflow:hidden;
        }
    </style>
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        /*html {*/
        /*height: 100%;*/
        /*margin: 0;*/
        /*padding: 0;*/
        /*text-align: center;*/
        /*}*/

        #map {
            margin:auto;
            height: 500px;
            width: 600px;
            overflow:hidden;
        }
    </style>
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
                        <h3 class="mb-3">ข้อมูลร้านค้า</h3>
                        <div class="card mb-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="card">
                                            <div class="card-body p-2 text-center">
                                                <img class="card-img-top rounded-circle"
                                                     src="{{ asset('images/profile/'.$profile->image_profile) }}"
                                                     alt="Card image cap" style="width:100px;height:100px;object-fit:cover;">
                                                <h6 class="card-title">{{ $profile->firstname }} {{ $profile->lastname }} <i class='fas fa-check-circle text-success'></i></h6>
                                                <div class="row">
                                                    <div class="col-sm-6 text-center">
                                                        <img src="{{ asset('images/icon-eye.png') }}">
                                                        <p class="mb-1">ผู้ติดตาม</p>
                                                        <h5>0</h5>
                                                    </div>
                                                    <div class="col-sm-6 text-center border-left">
                                                        <img src="{{ asset('images/icon-like.png') }}">
                                                        <p class="mb-1">กำลังติดตาม</p>
                                                        <h5>0</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="card">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="card-body p-2 text-center border-right">
                                                        @if($profile->company_logo != null)
                                                        <img src="{{ asset('images/profile/company_logo/'.$profile->company_logo) }}"
                                                             class="mw-100" style="margin: auto;">
                                                        @else
                                                         <img src="{{ asset('image/Noimage_available.png') }}"
                                                               style="margin: auto;width: 60%">
                                                        @endif
                                                        <br>
                                                        <button data-toggle="modal" data-target="#editProfileModal" class="btn btn-sm btn-outline-secondary"><i class='fas fa-edit'></i> แก้ไขข้อมูล</>
                                                    </div>
                                                </div>
                                                <div class="col-sm-8">
                                                    <form>
                                                        <div class="form-group row">
                                                            <label for="staticEmail" class="col-sm-4 col-form-label">บริษัท</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $profile->company }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="staticEmail" class="col-sm-4 col-form-label">ที่อยู่</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{  $profile->company_address }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="staticEmail" class="col-sm-4 col-form-label">เบอร์โทรติดต่อ</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $profile->tel }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $profile->email }}">
                                                            </div>
                                                        </div>
                                                    </form>
                                                    @if($profile->latitude != null && $profile->longitude != null)
                                                        <button data-toggle="modal" data-target="#showMapModal" onclick="switchCallback('initMap')"
                                                                class="btn btn-sm btn-outline-secondary"><i class='fas fa fa-map-marker'></i> ดู Map ปัจจุบัน
                                                        </button>
                                                    @endif
                                                    <button data-toggle="modal" data-target="#editMapModal" onclick="switchCallback('initialize')"
                                                            class="btn btn-sm btn-outline-secondary"><i class='fas fa fa-map-marker'></i> แก้ไข Map
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <a href="{{ url('erp-priceSetup') }}" style="margin-bottom: 2px" class="btn btn-outline-warning col-md-4"><i class="fas fa fa-cogs text-success"></i> กำหนดราคาติดตั้ง</a>
                                                <button style="margin-bottom: 2px" class="btn btn-outline-warning col-md-3" data-toggle="modal" data-target="#createProductModal"><i class="fas fa-plus-circle text-success"></i> เพิ่มสินค้า</button>
                                                <a  href="{{ url('erp-airProduct') }}" style="margin-bottom: 2px" class="btn btn-outline-warning col-md-3"><i class="fas fa-plus-circle text-success"></i> เพิ่มสินค้าข้อมูลระบบ</a>
                                                {{-- ใบสั่งชื้อ --}}
                                                <a href="{{ url('erp-purchaseOrder') }}" style="margin-bottom: 2px" class="btn btn-outline-warning col-md-4"><i class="fas fa-list-alt text-success"></i> รายได้ / ใบสั่งชื้อ ของฉัน </a>
                                                {{-- งานติดตั้ง --}}
                                                <a  href="{{ url('erp-install') }}" style="margin-bottom: 2px" class="btn btn-outline-warning col-md-3"><i class="fas fa-truck text-success"></i> การจัดส่งของฉัน</a>
                                                <button style="margin-bottom: 2px" class="btn btn-outline-warning col-md-3"><i class="fas fa-star text-success"></i> ดูคะแนนร้าน</button>
                                                <a href="{{ url('erp-service') }}" style="margin-bottom: 2px" class="btn btn-outline-warning col-md-3"><i class="fas fa-shopping-cart text-success"></i> การขายของฉัน </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($type_page == 1)
                            <h3 class="mb-2">สินค้าของฉัน</h3>
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="card-body p-2 text-center">
                                                    @if($storeProduct->pa_image != null)
                                                        <img src="{{ asset('images/store-product/'.$storeProduct->pa_image) }}"
                                                             class="mw-100" style="margin: auto;">
                                                    @else
                                                        <img src="{{ asset('image/Noimage_available.png') }}"
                                                             style="margin: auto;width: 60%">
                                                    @endif
                                                    <br>
                                                    <br>
                                                    <a href="{{ url('erpEditStoreProduct/'.$id) }}" class="btn btn-sm btn-outline-secondary">
                                                        <i class='fas fa-edit'></i> แก้ไขข้อมูล</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <form>
                                                    <div class="form-group row">
                                                        <label for="staticEmail" class="col-sm-3 col-form-label"><b>ชื่อสินค้า</b></label>
                                                        <div class="col-sm-3">
                                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $storeProduct->pa_name }}">
                                                        </div>
                                                        <label for="staticEmail" class="col-sm-3 col-form-label"><b>ยีห้อ</b></label>
                                                        <div class="col-sm-3">
                                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{  $storeProduct->air_brand_name }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="staticEmail" class="col-sm-3 col-form-label"><b>ประเภทเอร์ ์</b></label>
                                                        <div class="col-sm-9">
                                                            @if($storeProduct->air_type_id == 1)
                                                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $storeProduct->air_type_name }} {{ $air_type_sub_name }}">
                                                            @else
                                                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $storeProduct->air_type_name }}">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="staticEmail" class="col-sm-3 col-form-label"><b>Group แอร์</b></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $storeProduct->air_group_details }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="staticEmail" class="col-sm-3 col-form-label"><b>รุ่น Model Indoor</b></label>
                                                        <div class="col-sm-3">
                                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{  $storeProduct->air_model_indoor }}">
                                                        </div>
                                                        <label for="staticEmail" class="col-sm-3 col-form-label"><b>รุ่น Model Outdoor</b></label>
                                                        <div class="col-sm-3">
                                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{  $storeProduct->air_model_outdoor }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="staticEmail" class="col-sm-2 col-form-label"><b>BTU</b></label>
                                                        <div class="col-sm-4">
                                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{  number_format($storeProduct->air_btu_detail,0) }}">
                                                        </div>
                                                        <label for="staticEmail" class="col-sm-2 col-form-label"><b>ราคาขายสินค้า </b></label>
                                                        <div class="col-sm-4">
                                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{  number_format($storeProduct->air_price_list,0) }} บาท">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="staticEmail" class="col-sm-4 col-form-label"><b>รายละเอียก</b></label>
                                                        <div class="col-sm-8">
                                                            <p>
                                                                @if($storeProduct->pa_detail != null)
                                                                    {!! $storeProduct->pa_detail !!}
                                                                @else
                                                                   -
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="staticEmail" class="col-sm-4 col-form-label"><b>ราคาขายสินค้ารวม ติดตั้งแบบปกติ , VAT</b></label>
                                                        <div class="col-sm-2">
                                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{  number_format($storeProduct->pa_sum_s_install,0) }} บาท">
                                                        </div>
                                                        <label for="staticEmail" class="col-sm-4 col-form-label"><b>ราคาขายสินค้ารวม ติดตั้งแบบพรีเมียร์ , VAT</b></label>
                                                        <div class="col-sm-2">
                                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{  number_format($storeProduct->pa_sum_p_install,0) }} บาท">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="staticEmail" class="col-sm-3 col-form-label"><b>สินค้าคงเหลือ ใน stock</b></label>
                                                        <div class="col-sm-3">
                                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{  number_format($storeProduct->pa_stock,0) }}">
                                                        </div>
                                                    </div>
                                                    @if($storeGift != null)
                                                        <div class="form-group row">
                                                            <table class="table table-hover">
                                                                <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">ของแถม</th>
                                                                    <th scope="col">จำนวน</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($storeGift as $key => $value)
                                                                    <tr>
                                                                        <th scope="row">{{ $key+1 }}</th>
                                                                        <td>{{ $value->gift_name }}</td>
                                                                        <td>{{ $value->gift_count }}</td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    @endif
                                                    @if($air_data_details != null)
                                                        <div class="form-group row">
                                                            <table class="table table-hover">
                                                                <thead>
                                                                <tr>
                                                                    <th scope="col">ลำดับ</th>
                                                                    <th scope="col">รายเอียดเพิ่มเติม</th>
                                                                    <th scope="col">ค่า รายเอียดเพิ่มเติม</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($air_data_details as $key => $value)
                                                                    <tr>
                                                                        <th scope="row">{{ $key+1 }}</th>
                                                                        <td>{{ $value->air_data_title }}</td>
                                                                        <td>{{ $value->air_data_value }}</td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    @endif
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($type_page == 2)
                            <h3 class="mb-2">แก้ไขสินค้าของฉัน</h3>
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <div class="card">
                                        <form action="{{  URL::to('erpInfoStore/'.$id) }}" method="POST" enctype="multipart/form-data">
                                            <div class="row" style="padding-top: 15px;padding-right: 15px;">
                                                <input name="_method" type="hidden" value="PUT">
                                                <input type="hidden" name="type" value="2">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="col-sm-4">
                                                    <div class="card-body p-2 text-center">
                                                        @if($storeProduct->product_image != null)
                                                            <img src="{{ asset('images/store-product/'.$storeProduct->product_image) }}"
                                                                 class="mw-100" style="margin: auto;">
                                                        @else
                                                            <img src="{{ asset('image/Noimage_available.png') }}"
                                                                 style="margin: auto;width: 60%">
                                                        @endif
                                                        <br>
                                                        <br>
                                                        {!!  Form::file('product_image',['class' => 'form-control' , 'placeholder' =>'กรุณาใส่ รุปภาพสินค้า']) !!}
                                                    </div>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label"><b>ชื่อสินค้า</b></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="product_name" id="product_name"  class="form-control" value="{{ $storeProduct->product_name }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label"><b>ยีห้อ</b></label>
                                                        <div class="col-sm-3">
                                                            <input type="text"  name="product_brand" id="product_brand" class="form-control" value="{{  $storeProduct->product_brand }}">
                                                        </div>
                                                        <label class="col-sm-3 col-form-label"><b>รุ่น</b></label>
                                                        <div class="col-sm-3">
                                                            <input type="text" name="product_series" id="product_series" class="form-control" value="{{  $storeProduct->product_series }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label"><b>รายละเอียก</b></label>
                                                        <div class="col-sm-9">
                                                            <textarea  class="form-control" name="product_details"  placeholder="กรุณาใส่ รายละเอียด" id="product_details" rows="5">
                                                                {!! $storeProduct->product_details !!}
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label"><b>ราคา</b></label>
                                                        <div class="col-sm-2">
                                                            <input type="text"  class="form-control" name="product_price" id="product_price" value="{{  $storeProduct->product_price }}">
                                                        </div>
                                                        <label class="col-sm-2 col-form-label"><b>BTU</b></label>
                                                        <div class="col-sm-2">
                                                            <input type="text"  class="form-control" name="product_btu" id="product_btu"  value="{{  $storeProduct->product_btu }}">
                                                        </div>
                                                        <label class="col-sm-2 col-form-label"><b>VAT %</b></label>
                                                        <div class="col-sm-2">
                                                            <input type="text"  class="form-control" name="product_vat" id="product_vat" value="{{  $storeProduct->product_vat }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label"><b>ค่าติดติ้ง ปกติ</b></label>
                                                        <div class="col-sm-3">
                                                            <input type="text"  class="form-control" name="product_setup" id="product_setup"  value="{{  $storeProduct->product_setup }}">
                                                        </div>
                                                        <label class="col-sm-3 col-form-label"><b>ค่าติดติ้ง พรีเมียม</b></label>
                                                        <div class="col-sm-3">
                                                            <input type="text"  class="form-control" name="product_setup2" id="product_setup2"  value="{{  $storeProduct->product_setup2 }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label  class="col-sm-3 col-form-label"><b>สินค้าคงเหลือ ใน stock</b></label>
                                                        <div class="col-sm-3">
                                                            <input type="text"  class="form-control" name="product_stock" id="product_stock"  value="{{ $storeProduct->product_stock }}">
                                                        </div>
                                                        <label class="col-sm-3 col-form-label"><b>ค่า ท่อเกินเมตรละ</b></label>
                                                        <div class="col-sm-3">
                                                            <input type="text"  class="form-control" name="product_piping" id="product_piping"  value="{{  $storeProduct->product_piping }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label  class="col-sm-3 col-form-label"><b>ลบสินค้า ของแถม</b></label>
                                                    </div>
                                                    <div class="form-group">
                                                        @if($storeGift != null)
                                                            @foreach($storeGift as $key => $data)
                                                                <input id="del_storeGift[{{ $key }}]" type="checkbox" name="del_storeGift[{{ $key }}]" value="{{ $data->id }}" /> {{ $data->gift_name }}  จำนวน {{ $data->gift_count }} <br>
                                                            @endforeach
                                                            <input type="hidden" name="count_storeGift" value="{{ count($storeGift) }}">
                                                        @endif
                                                    </div>
                                                    <div class="form-group row">
                                                        <label  class="col-sm-3 col-form-label"><b>ของแถม</b></label>
                                                    </div>
                                                    <div class="form-group">
                                                        <div v-for="(row , index) in rows" :row="row">
                                                            <div class="row" style="margin-bottom: 2px">
                                                                <div class="col-sm-6">
                                                                    {!!  Form::text('gift_name[]',null,['class' => 'form-control' , 'placeholder' =>'กรุณาใส่ ชื่อของแถม']) !!}
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    {!!  Form::text('gift_count[]',null,['class' => 'form-control' , 'placeholder' =>'กรุณาใส่ จำนวนของแถม']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" align="center">
                                                        <button v-on:click="addRow(1)" type="button" class="btn btn-outline-secondary"><i
                                                                    class='fas fa-plus'></i></button>
                                                        <button v-on:click="removeRow(0)" type="button" class="btn btn-outline-secondary"><i
                                                                    class='fas fa-minus'></i></button>
                                                    </div>
                                                    <div class="form-group" align="center">
                                                        <button type="submit" class="btn btn-primary">ยืนยัน</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!--edit Profile Modal -->
        <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลบริษัท</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                        </button>
                    </div>
                    {!! Form::model($profile,['url' => ['erpInfoStore/'.$profile->id],'method' => 'put' ,'files'=> true]) !!}
                        <div class="modal-body">
                            <input type="hidden" name="type" value="1">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Logo บริษัท</label>
                                <input type="file" class="form-control-file" id="company_logo" name="company_logo">
                                @if($profile->company_logo != null)
                                    <center>
                                        <img src="{{ asset('images/profile/company_logo/'.$profile->company_logo) }}"
                                             class="mw-100" style="margin: auto;;width: 40%;">
                                    </center>
                                @else
                                    <center>
                                        <img src="{{ asset('image/Noimage_available.png') }}"
                                             style="margin: auto;width: 40%;">
                                    </center>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">บริษัท<span class="text-danger">*</span></label>
                                {{--<input type="text" name="company" class="form-control" id="company" value="{{ $profile->company }}">--}}
                                {!!  Form::text('company',null,['class' => 'form-control' ]) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">ที่อยู่<span class="text-danger">*</span></label>
                                {{--<input type="text" name="company" class="form-control" id="company" value="{{ $profile->company_address }}">--}}
                                {!!  Form::text('company_address',null,['class' => 'form-control' ]) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">เบอร์โทรติดต่อ</label>
                                {!!  Form::text('tel',null,['class' => 'form-control' ]) !!}
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary">ยืนยัน</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!--create Product Modal -->
        <div class="modal fade bd-example-modal-lg" id="createProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">เพิ่มสินค้า</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                        </button>
                    </div>
                    {!! Form::open(['url' => 'erpInfoStore' , 'files'=>true]) !!}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleFormControlFile1">รุปภาพสินค้า</label>
                            {!!  Form::file('product_image',['class' => 'form-control' , 'placeholder' =>'กรุณาใส่ รุปภาพสินค้า', 'required']) !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">ชื่อสินค้า</label>
                            {!!  Form::text('product_name',null,['class' => 'form-control' , 'placeholder' =>'กรุณาใส่ ชื่อสินค้า', 'required']) !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">เลือกยีห้อ</label>
                            <select class="form-control" name="brand" onchange="dropdownBrand(this.value)" required>
                                <option selected>- กรุณาเลือก ยีห้อ -</option>
                                @foreach($dropdownBrand as $value)
                                    <option value="{{ $value->brand_id }}">{{ $value->name }}</option>
                                @endforeach
                                <option value="0">อื่นๆ</option>
                            </select>
                        </div>
                        {{-- ไม่ Brand --}}
                        <div id="content-product1" class="typeScope">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">ยี่ห้อ</label>
                                {!!  Form::text('product_brand',null,['class' => 'form-control' , 'id' =>'product_brand' , 'placeholder' =>'กรุณาใส่ ยี่ห้อ']) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">รุ่น</label>
                                {!!  Form::text('product_series',null,['class' => 'form-control' , 'id' =>'product_series' , 'placeholder' =>'กรุณาใส่ รุ่น']) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">btu</label>
                                {!!  Form::text('product_btu',null,['class' => 'form-control' , 'id' =>'product_btu' , 'placeholder' =>'กรุณาใส่ รุ่น']) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">ราคา</label>
                                <input type="number" class="form-control" id="product_price" name="product_price" />
                            </div>
                        </div>
                        {{-- มี Brand และ รุ่น --}}
                        <div id="content-product2" class="typeScope">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">รุ่น</label>
                                <select class="form-control" name="product_air_id"  id="product_air_id" onchange="dropdownSeries(this.value)" >
                                    <option value="" selected>- กรุณาเลือก รุ่น -</option>
                                </select>
                            </div>
                            <div class="form-group" id="context-price">
                                <label for="exampleFormControlFile1">ราคา</label>
                                <input type="number" class="form-control" id="product_price1" name="product_price1" />
                            </div>
                        </div>
                        {{-- ไม่มี รุ่น--}}
                        <div id="content-product3" class="typeScope">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">รุ่น</label>
                                {!!  Form::text('product_series1',null,['class' => 'form-control' , 'id' =>'product_series1' , 'placeholder' =>'กรุณาใส่ รุ่น']) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">btu</label>
                                {!!  Form::text('product_btu1',null,['class' => 'form-control' , 'id' =>'product_btu1' , 'placeholder' =>'กรุณาใส่ btu']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">รายละเอียด</label>
                            <textarea  class="form-control" name="product_details" placeholder="กรุณาใส่ รายละเอียด" id="product_details" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleFormControlFile1">ราคาขายไม่รวม Vat %</label>
                                    {!!  Form::number('product_vat',null,['class' => 'form-control' , 'placeholder' =>'กรุณาใส่ ราคาขายไม่รวม Vat']) !!}
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleFormControlFile1">สินค้าคงเหลือ ใน stock</label>
                                    {!!  Form::number('product_stock',null,['class' => 'form-control', 'placeholder' =>'กรุณาใส่ สินค้าคงเหลือ ใน stock', 'required']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="exampleFormControlFile1">ค่าติดติ้ง ปกติ</label>
                                    {{--<select class="form-control" name="product_setup" id="product_setup" required>--}}
                                    {{--<option value="" selected>- กรุณาเลือก ค่าติดติ้ง -</option>--}}
                                    {{--<option value="1">ปกติ 5000</option>--}}
                                    {{--<option value="2">พรีเมียม 8000</option>--}}
                                    {{--</select>--}}
                                    {!!  Form::number('product_setup',null,['class' => 'form-control' , 'placeholder' =>'กรุณาใส่ ค่าติดติ้ง ', 'required']) !!}
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleFormControlFile1">ค่าติดติ้ง พรีเมียม</label>
                                    {!!  Form::number('product_setup2',null,['class' => 'form-control' , 'placeholder' =>'กรุณาใส่ ค่าติดติ้ง', 'required']) !!}
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleFormControlFile1">ค่า ท่อเกินเมตรละ</label>
                                    {!!  Form::number('product_piping',null,['class' => 'form-control' , 'placeholder' =>'กรุณาใส่ ค่า ท่อเกินเมตรละ']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">ของแถม</label>
                            <br>
                            <div v-for="(row , index) in rows" :row="row">
                                <div class="row" style="margin-bottom: 2px">
                                    <div class="col-md-6">
                                        {!!  Form::text('gift_name[]',null,['class' => 'form-control' , 'placeholder' =>'กรุณาใส่ ชื่อของแถม']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!!  Form::text('gift_count[]',null,['class' => 'form-control' , 'placeholder' =>'กรุณาใส่ จำนวนของแถม']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button v-on:click="addRow(1)" type="button" class="btn btn-outline-secondary"><i
                                        class='fas fa-plus'></i></button>
                            <button v-on:click="removeRow(0)" type="button" class="btn btn-outline-secondary"><i
                                        class='fas fa-minus'></i></button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary">ยืนยัน</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="modal fade" id="editMapModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">แก้ไขที่อยู่</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                        </button>
                    </div>
                    {!! Form::model($profile,['url' => ['erpHome/'.$profile->id],'method' => 'put' ,'files'=> true]) !!}
                    <div class="modal-body">
                        <input type="hidden" name="type" value="2">
                        <div class="form-group">
                            <div class="row">
                                <div id="map_canvas"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="exampleInputPassword1">Latitude</label>
                                    <input class="form-control" type="text" name="lat_value"  id="lat_value" value="0" />
                                </div>
                                <div class="col-lg-4">
                                    <label for="exampleInputPassword1">Longitude</label>
                                    <input class="form-control" type="text" name="lon_value"  id="lon_value" value="0" />
                                </div>
                                <div class="col-lg-4">
                                    <label for="exampleInputPassword1">Zoom</label>
                                    <input class="form-control" type="text" name="zoom_value"  id="zoom_value" value="0" size="5"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary">ยืนยัน</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="modal fade" id="showMapModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ที่อยู่ปัจจุบัน</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="type" value="2">
                        <div class="form-group">
                            <div class="row">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
   {{--<script src="/js/app.js" charset="utf-8"></script>--}}
    <script src="{{ asset('js/app.js') }}" ></script>

@endsection
@section('script')
    <style>
        .typeScope {
            display:none;
        }
        #context-price {
            display:none;
        }
    </style>
    <script>
        $('#pageSubmenu').addClass('show');
        $('.sidenav-item').eq(5).find('a').addClass('active');
    </script>
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
        function dropdownBrand(id) {
            $('.typeScope').hide();

            if (id == 0) {
                // $('#product_brand').val('');
                // $('#product_series').val('');
                // $('#product_btu').val('');
                $("#product_brand").attr('required', '');
                $("#product_series").attr('required', '');
                $("#product_btu").attr('required', '');
                $("#product_air_id").removeAttr('required');
                $("#product_series1").removeAttr('required');
                $("#product_btu1").removeAttr('required');
                $('#content-product1').show();
                $('#content-product2').hide();
            }else{
                // $('#series').val('');
                $("#product_brand").removeAttr('required');
                $("#product_series").removeAttr('required');
                $("#product_btu").removeAttr('required');
                $("#product_air_id").attr('required', '');
                $('#content-product2').show();
                $.ajax({
                    url: '{{ url("/api/getBrandSeries") }}',
                    type: "GET",
                    data: {id: id, _token: '{{ csrf_field() }}'},
                    success: function (data) {
                        $('#product_air_id').html(data);
                    }
                });
            }
            if(id == ""){
                $('#content-product2').hide();
            }
        }
        function dropdownSeries(id) {
            if (id == 0) {
                $('#product_price1').val('');
                $("#product_series1").attr('required', '');
                $("#product_btu1").attr('required', '');
                $('#content-product3').show();
                $("#product_price1").removeAttr('required', '');
            }else {
                $('#context-price').show();
                $.ajax({
                    url: '{{ url("/api/getPriceAir") }}',
                    type: "GET",
                    data: {id: id, _token: '{{ csrf_field() }}'},
                    success: function (data) {
                        $('#product_price1').val(data);
                        $("#product_price1").attr('required', '');
                    }
                });

                $("#product_series1").removeAttr('required');
                $("#product_btu1").removeAttr('required');
                $('#product_series1').val('');
                $('#product_btu1').val('');
                $('#content-product3').hide();
            }
        }
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

    <script type="text/javascript">
      @if($profile->latitude != null && $profile->longitude != null )
        var jsonObj = [
                {"location":"{{ $profile->company }}", "lat": "{{ $profile->latitude }}", "lng": "{{ $profile->longitude }}"},
            ]

        console.log(jsonObj);
        function initMap() {
            var mapOptions = {
                center: {location:'TEST',lat: {{ $profile->latitude }}, lng: {{ $profile->longitude }}},
                zoom: {{ $profile->zoom }},
            }
            var maps = new google.maps.Map(document.getElementById("map"),mapOptions);
            var marker, info;
            $.each(jsonObj, function(i, item){

                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(item.lat, item.lng),
                    map: maps,
                    title: item.location
                });

                info = new google.maps.InfoWindow();
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        info.setContent(item.location);
                        info.open(maps, marker);
                    }
                })(marker, i));
            });
        }
        @endif

        var geocoder; // กำหนดตัวแปรสำหรับ เก็บ Geocoder Object ใช้แปลงชื่อสถานที่เป็นพิกัด
        var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้
        var my_Marker; // กำหนดตัวแปรสำหรับเก็บตัว marker
        var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น
        function initialize() { // ฟังก์ชันแสดงแผนที่
            GGM=new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
            geocoder = new GGM.Geocoder(); // เก็บตัวแปร google.maps.Geocoder Object
            // กำหนดจุดเริ่มต้นของแผนที่

            var my_Latlng  = new GGM.LatLng(13.761728449950002,100.6527900695800);

            var my_mapTypeId=GGM.MapTypeId.ROADMAP; // กำหนดรูปแบบแผนที่ที่แสดง
            // กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas
            var my_DivObj=$("#map_canvas")[0];
            // กำหนด Option ของแผนที่
            var myOptions = {
                zoom: 13, // กำหนดขนาดการ zoom
                center: my_Latlng , // กำหนดจุดกึ่งกลาง จากตัวแปร my_Latlng
                mapTypeId:my_mapTypeId // กำหนดรูปแบบแผนที่ จากตัวแปร my_mapTypeId
            };
            map = new GGM.Map(my_DivObj,myOptions); // สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map
            if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(function(position){
                    var pos = new GGM.LatLng(position.coords.latitude,position.coords.longitude);
                    var infowindow = new GGM.Marker({
                        map: map,
                        position: pos,
                        draggable:true, // กำหนดให้สามารถลากตัว marker นี้ได้

                    });

                    var my_Point = infowindow.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
                    map.panTo(my_Point);  // ให้แผนที่แสดงไปที่ตัว marker
                    $("#lat_value").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
                    $("#lon_value").val(my_Point.lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
                    $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
                    map.setCenter(pos);

                    GGM.event.addListener(infowindow, 'dragend', function() {
                        var my_Point = infowindow.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
                        map.panTo(my_Point); // ให้แผนที่แสดงไปที่ตัว marker
                        $("#lat_value").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
                        $("#lon_value").val(my_Point.lng());  // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
                        $("#zoom_value").val(map.getZoom());  // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_valu
                    });
                },function() {
                    // คำสั่งทำงาน ถ้า ระบบระบุตำแหน่ง geolocation ผิดพลาด หรือไม่ทำงาน
                });
            }else{
                // คำสั่งทำงาน ถ้า บราวเซอร์ ไม่สนับสนุน ระบุตำแหน่ง
            }

            my_Marker = new GGM.Marker({ // สร้างตัว marker ไว้ในตัวแปร my_Marker
                position: my_Latlng,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง
                map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map
                draggable:true, // กำหนดให้สามารถลากตัว marker นี้ได้
                title:"คลิกลากเพื่อหาตำแหน่งจุดที่ต้องการ!" // แสดง title เมื่อเอาเมาส์มาอยู่เหนือ
            });

            // กำหนด event ให้กับตัว marker เมื่อสิ้นสุดการลากตัว marker ให้ทำงานอะไร
            GGM.event.addListener(my_Marker, 'dragend', function() {
                var my_Point = my_Marker.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
                map.panTo(my_Point); // ให้แผนที่แสดงไปที่ตัว marker
                $("#lat_value").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
                $("#lon_value").val(my_Point.lng());  // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
                $("#zoom_value").val(map.getZoom());  // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_valu
            });

            // กำหนด event ให้กับตัวแผนที่ เมื่อมีการเปลี่ยนแปลงการ zoom
            GGM.event.addListener(map, 'zoom_changed', function() {
                $("#zoom_value").val(map.getZoom());   // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
            });

        }
        $(function(){
            // ส่วนของฟังก์ชันค้นหาชื่อสถานที่ในแผนที่
            var searchPlace=function(){ // ฟังก์ชัน สำหรับคันหาสถานที่ ชื่อ searchPlace
                var AddressSearch=$("#namePlace").val();// เอาค่าจาก textbox ที่กรอกมาไว้ในตัวแปร
                if(geocoder){ // ตรวจสอบว่าถ้ามี Geocoder Object
                    geocoder.geocode({
                        address: AddressSearch // ให้ส่งชื่อสถานที่ไปค้นหา
                    },function(results, status){ // ส่งกลับการค้นหาเป็นผลลัพธ์ และสถานะ
                        if(status == GGM.GeocoderStatus.OK) { // ตรวจสอบสถานะ ถ้าหากเจอ
                            var my_Point=results[0].geometry.location; // เอาผลลัพธ์ของพิกัด มาเก็บไว้ที่ตัวแปร
                            map.setCenter(my_Point); // กำหนดจุดกลางของแผนที่ไปที่ พิกัดผลลัพธ์
                            my_Marker.setMap(map); // กำหนดตัว marker ให้ใช้กับแผนที่ชื่อ map
                            my_Marker.setPosition(my_Point); // กำหนดตำแหน่งของตัว marker เท่ากับ พิกัดผลลัพธ์
                            $("#lat_value").val(my_Point.lat());  // เอาค่า latitude พิกัดผลลัพธ์ แสดงใน textbox id=lat_value
                            $("#lon_value").val(my_Point.lng());  // เอาค่า longitude พิกัดผลลัพธ์ แสดงใน textbox id=lon_value
                            $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_valu
                        }else{
                            // ค้นหาไม่พบแสดงข้อความแจ้ง
                            alert("Geocode was not successful for the following reason: " + status);
                            $("#namePlace").val("");// กำหนดค่า textbox id=namePlace ให้ว่างสำหรับค้นหาใหม่
                        }
                    });
                }
            }
            $("#SearchPlace").click(function(){ // เมื่อคลิกที่ปุ่ม id=SearchPlace ให้ทำงานฟังก์ฃันค้นหาสถานที่
                searchPlace();  // ฟังก์ฃันค้นหาสถานที่
            });
            $("#namePlace").keyup(function(event){ // เมื่อพิมพ์คำค้นหาในกล่องค้นหา
                if(event.keyCode==13){  //  ตรวจสอบปุ่มถ้ากด ถ้าเป็นปุ่ม Enter ให้เรียกฟังก์ชันค้นหาสถานที่
                    searchPlace();      // ฟังก์ฃันค้นหาสถานที่
                }
            });

        });


        var callbackLink ;
        function switchCallback(name) {
            callbackLink = name ;
            if(callbackLink == "initialize"){
                $(function(){
                    // โหลด สคริป google map api เมื่อเว็บโหลดเรียบร้อยแล้ว
                    // ค่าตัวแปร ที่ส่งไปในไฟล์ google map api
                    // v=3.2&sensor=false&language=th&callback=initialize
                    //  v เวอร์ชัน่ 3.2
                    //  sensor กำหนดให้สามารถแสดงตำแหน่งทำเปิดแผนที่อยู่ได้ เหมาะสำหรับมือถือ ปกติใช้ false
                    //  language ภาษา th ,en เป็นต้น
                    //  callback ให้เรียกใช้ฟังก์ชันแสดง แผนที่ initialize
                    $("<script/>", {
                        "type": "text/javascript",
                        src: "https://maps.googleapis.com/maps/api/js?key=AIzaSyDvJji6UAeoyj5LslVa4uo1bpNbycAOCXc&v=3.2&sensor=false&language=th&callback=initialize"
                    }).appendTo("body");
                });
            }else if (callbackLink == "initMap"){
                $(function(){
                    $("<script/>", {
                        "type": "text/javascript",
                        src: "https://maps.googleapis.com/maps/api/js?key=AIzaSyDvJji6UAeoyj5LslVa4uo1bpNbycAOCXc&v=3.2&sensor=false&language=th&callback=initMap"
                    }).appendTo("body");
                });
            }
        }
    </script>
@endsection