@extends('layouts.navber')
@section('head')
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script src="{{ asset('js/modernizr.js') }}"></script>
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
            <div id="content-erp" style="min-height: auto;">
                <div class="row">
                    <div class="col-sm-12">
                        <nav class="navbar navbar-default mb-3">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <button type="button" id="sidebarCollapse-erp" class="btn btn-orange navbar-btn">
                                        <i class='fas fa-bars'></i>
                                    </button>
                                </div>
                                {{--<div class="navbar-header">--}}
                                    {{--<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#">--}}
                                        {{--<i class="fas fa-truck"></i> <span class="badge badge-light">4</span>--}}
                                    {{--</button>--}}
                                {{--</div>--}}
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="mb-3">หน้าแรก</h3>
                        <div class="card mb-5" style="padding-top: 15px">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4" style="">
                                        <div class="card">
                                            <div class="card-body p-2 text-center">
                                                @if($profile->image_profile != null)
                                                    <img src="{{ asset('images/profile/'.$profile->image_profile) }}"
                                                         class="card-img-top rounded-circle"
                                                         style="margin: auto;width:100px;height:100px;object-fit:cover;">
                                                @else
                                                    <img src="{{ asset('image/Noimage_available.png') }}"
                                                         style="margin: auto;width: 40%">
                                                @endif
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
                                    <div class="col-sm-8">
                                        <div class="card">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <form style="padding-left: 15px;padding-top: 15px">
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
                                                    <center>
                                                        <div style="padding-bottom: 15px">
                                                            <button data-toggle="modal" data-target="#editProfileModal"
                                                                    class="btn btn-sm btn-outline-secondary"><i class='fas fa-edit'></i> แก้ไขข้อมูล
                                                            </button>
                                                            @if($profile->latitude != null && $profile->longitude != null)
                                                                <button data-toggle="modal" data-target="#showMapModal" onclick="switchCallback('initMap')"
                                                                        class="btn btn-sm btn-outline-secondary"><i class='fas fa fa-map-marker'></i> ดู Map ปัจจุบัน
                                                                </button>
                                                            @endif
                                                            <button data-toggle="modal" data-target="#editMapModal" onclick="switchCallback('initialize')"
                                                                    class="btn btn-sm btn-outline-secondary"><i class='fas fa fa-map-marker'></i> แก้ไข Map
                                                            </button>
                                                        </div>
                                                    </center>
                                                </div>

                                            </div>
                                        </div>
                                        <br>
                                        <erp-home :auth_id="{{ $auth_id }}"></erp-home>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--edit Profile Modal -->
        <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="hidden" name="type" value="1">
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
    <script src="{{ asset('GBPrimePay.js') }}" ></script>
    <!-- https://github.com/GBPrimepay/gbprimepay-js -->
    <script>
        new GBPrimePay({
            publicKey: 'publickey_1234abcd',
            gbForm: '#gb-form',
            merchantForm: '#checkout-form',
            amount: 90.90,
            customStyle: {
                backgroundColor: '#eaeaea'
            },
            env: 'test' // default prd | optional: test, prd
        });
    </script>
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
    <script type="text/javascript">
        $('.btn-stepNext').click(function() {
            $('.nav-pills .active').parent().next('li').find('a').trigger('click');
        });

        $('.btn-stepPrevious').click(function() {
            $('.nav-pills .active').parent().prev('li').find('a').trigger('click');
        });
    </script>
    <script>
        $('.sidenav-item').eq(0).find('a').addClass('active');
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

    <script type="text/javascript">
        var jsonObj = [
            {"location":"{{ $profile->company }}", "lat": "{{ $profile->latitude }}", "lng": "{{ $profile->longitude }}"},
        ]

        // console.log(jsonObj);
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