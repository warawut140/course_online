@extends('layouts.navber')
@section('head')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    {{--<script src="https://rawgit.com/vuejs/vue/dev/dist/vue.js"></script>--}}
    <script>
        function checkTypeUser(id) {
            if (id == 2){
                $('#typeUser').show();
            }else {
                $('#typeUser').hide();
            }
        }
    </script>
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

        /* css กำหนดความกว้าง ความสูงของแผนที่ */
        #map_canvas {
            width:550px;
            height:400px;
            margin:auto;
            /*  margin-top:100px;*/
        }
    </style>
@endsection
@section('content')
    <div id="app">
        {{--begin #register --}}
        <div id="register-section1" class="bg-light">
            <div class="container py-5">
                <div class="row">
                    <div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">สมัครสมาชิก</h5>
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('registerProfile') }}" id="searchForm"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row align-items-center">
                                        <div class="col-auto">
                                            <label class="form-label" for="inlineFormInput">ประเภท</label>
                                        </div>
                                        <div class="col-auto">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="autoSizingCheck" name="typeAccount1" value="1" required>
                                                <label class="form-check-label" for="autoSizingCheck">
                                                    ผู้ว่าจ้าง
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="autoSizingCheck" name="typeAccount2" value="2" onchange="checkTypeUser(2)">
                                                <label class="form-check-label" for="autoSizingCheck">
                                                    ผู้รับจ้าง
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto my-1" id="typeUser">
                                            <select class="form-control my-1 mr-sm-2" id="inlineFormCustomSelect" name="typeUser">
                                                <option selected>Choose...</option>
                                                <option value="1">Advisor</option>
                                                <option value="2">Designer</option>
                                                <option value="3">QS</option>
                                                <option value="4">QC</option>
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="autoSizingCheck" name="typeAccount3"  value="3">
                                                <label class="form-check-label" for="autoSizingCheck">
                                                    ผู้รับเหมา
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">คำนำหน้า</label>
                                            {!!  Form::select('prefixe_id', $prefixes, null, ['id' => 'prefixe_id','class' => 'form-control' , 'placeholder' => 'เลือก' ,'required']) !!}
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="inputEmail4">ชื่อจริง</label>
                                            <input name="firstname" type="text" class="form-control" id="inputEmail4" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputPassword4">นามสกุล</label>
                                            <input name="lastname" type="text" class="form-control" id="inputPassword4" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">เบอร์โทร</label>
                                        <input type="number" class="form-control" id="exampleInputEmail1" name="tel" required>
                                    </div>
                                    <a href="ref"></a>
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">รูปประจำตัว</label>
                                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="imageProfile" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">รูปสำเนาบัตรประชาชน</label>
                                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="fileCard" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">เอกสารอ้างอิง/ใบอนุญาต เพื่อใช้ยืนยันตัวตน</label>
                                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="fileProfile">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">ภาพใบอนุญาต</label>
                                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="filename_award">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">ภาพประกาศนียบัตร</label>
                                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="filename_diploma">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div id="map_canvas"></div>
                                        </div>
                                    </div>
                                    <div class="form-group" style="display:none;">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label for="exampleInputPassword1">Latitude</label>
                                                <input class="form-control" type="text" name="lat_value"  id="lat_value" value="0"  disabled/>
                                            </div>
                                            <div class="col-lg-12">
                                                <label for="exampleInputPassword1">Longitude</label>
                                                <input class="form-control" type="text" name="lon_value"  id="lon_value" value="0"  disabled/>
                                            </div>
                                            <div class="col-lg-12">
                                                <label for="exampleInputPassword1">Zoom</label>
                                                <input class="form-control" type="text" name="zoom_value"  id="zoom_value" value="0" size="5" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">บริษัท</label>
                                        <input type="text" name="company" id="company"  class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">รายละเอียด</label>
                                        <textarea id="details" name="details" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" name="i_accept" id="i_accept">
                                        <label class="form-check-label" for="exampleCheck1">ยอมรับ
                                            <a class="text-primary pointer" data-toggle="modal" data-target="#exampleModal" >
                                                ข้อตกลงและเงื่อนไข</a> การสมัครสมาชิก
                                        </label>
                                    </div>
                                    <div class="form-group" >
                                        <button type="submit" name="btn_send" id="btn_send" class="btn btn-success w-100" data-toggle="modal" data-target="#otpModal"  disabled="disabled">สมัครสมาชิก</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal ข้อตกลงและเงื่อนไข-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ข้อตกลงและเงื่อนไข</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                        </button>
                    </div>
                    <div class="modal-body text-justify">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                        anim id est laborum
                    </div>
                </div>
            </div>
        </div>
        {{--end #register --}}
    </div>
    {{--<script src="/js/app.js" charset="utf-8"></script>--}}
    <script src="{{ asset('js/app.js') }}" ></script>
@endsection
@section('script')
    <script type="text/javascript">
        $( document ).ready(function() {
            // console.log( "ready!" );
            // console.log($('#otp').val());
            $('#typeUser').hide();
        });

        $(function(){
            $(":checkbox[name=i_accept]").on("click",function(){
                var i_check = $(this).prop("checked");
                console.log(i_check);
                if(i_check == true){
                    $("button[name=btn_send]").attr("disabled",false);
                }else {
                    $("button[name=btn_send]").attr("disabled",true);
                }
            });
        });
    </script>
    <script>
        $('.bg-light').css({
            'min-height': $(window).height() - $('.navbar').height() - $('#section-footer').height()
        });
    </script>
    <script type="text/javascript">
        var geocoder; // กำหนดตัวแปรสำหรับ เก็บ Geocoder Object ใช้แปลงชื่อสถานที่เป็นพิกัด
        var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้
        var my_Marker; // กำหนดตัวแปรสำหรับเก็บตัว marker
        var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น
        function initialize() { // ฟังก์ชันแสดงแผนที่
            GGM=new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
            geocoder = new GGM.Geocoder(); // เก็บตัวแปร google.maps.Geocoder Object
            // กำหนดจุดเริ่มต้นของแผนที่

            var my_Latlng  = new GGM.LatLng(0,0);

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
                src: "//maps.google.com/maps/api/js?v=3.2&key=AIzaSyDvJji6UAeoyj5LslVa4uo1bpNbycAOCXc&sensor=false&language=th&callback=initialize"
            }).appendTo("body");
        });
    </script>
@endsection