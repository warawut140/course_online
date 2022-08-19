@extends('layouts.navbercompany')
@section('head')
    {{-- @include('sweetalert::alert') --}}
@endsection
@section('content')

<style> 
.main {
    width: 90%;
  margin-right: 20px;
  margin-left: 20px;
}
img.center {
    display: block;
    margin: 0 auto;
}
.opcenter {
   text-align: center;
      padding: 10px;
        margin: auto;
}
.optop {
   text-align: center;
      padding: 10px;
       
}
.left {
   text-align: left;
    margin-left: 80px;
      margin-Right: 20px;  
}
.right {
   text-align: right;
    margin-Right: 80px;
      margin-left: 20px;   
}
.op2center {
   text-align: center;
      padding: 10px;
        margin: auto;
        color: white;
        background-color: #8B0900;
      font-size: 18px;
      font-style: normal;
}
.op3center {
   text-align: center;
      padding: 10px;
        margin: auto;
        color:  #8B0900;
    
    
      font-style: normal;
}
.button3:hover {
  background-color: #f44336;
  color: white;
}
.blockop {
  display: block;
  width: 100%;
      color: white;
  border: none;
         background-color: #8B0900;
  padding: 14px 28px;
      font-size: 18px;
  cursor: pointer;
  text-align: center;
}
.icon_bg {
    background-color: #808080;
    border-radius: 50px;
    -moz-box-shadow: 0 5px 14px -1px rgba(55, 65, 67, 0.2);
    -webkit-box-shadow: 0 5px 14px -1px rgb(55 65 67 / 20%);
    box-shadow: 0 5px 14px -1px rgb(55 65 67 / 20%);
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-align: center;
}
</style>
        {{-- begin #Profile --}}
        <div id="traning-section1" class="py-5"  style="color: #D3D3D3;">
            <div class="container" style="height: 250px;">
                 <img src="{{ asset('images/upload.png') }}" class="center" width="200" height="200"><br>
             </div>
        </div>
  <div class="main">

        <div class="row">
				<div class="col-lg-3 optop">
					<style>
.memberlink li{
    list-style:none;
    padding-bottom:10px;
    font-size:0.9em;
}
.memberlink li a{
    color:#6a5753;
}
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #eed6d6;
}
.buttonop {
     display: block;
  width: 70%;
      color: #808080;
  border: none;
         background-color: #e7e7e7;
  padding: 3px 3px;
      font-size: 14px;
  cursor: pointer;
  text-align: center;
    border-radius: 15px;}
</style>

<img src="{{ asset('images/profile/profile_15.jpg') }}" class="rounded-circle mb-2 mw-100" width="200" height="200"><br>
		<h4 class="center" style="color: #8B0900;" >BIG ABC</h4>
        <p class="center" style="color: #808080;" >Le Méridien Hotels & Resorts  เชียงใหม่</p><br>
        <h4 class="left" style="color: #8B0900;" >ABOUT ME</h4>
            <p class="left" style="color: #808080;" >At Le Méridien, we believe in helping guests 
unlock the unexpected and engaging experiences 
each destination has to offer. Our guests are curious 
and creative, cosmopolitan, culture seekers that 
appreciate sophisticated, timeless service. 
We provide original, chic and memorable service 
and experiences that inspire guests to unlock 
the destination. We’re looking for curious, 
creative and well-informed people to join our team. </p>
 				<br>

 <h5 class="left" style="color: #808080;" ><img src="{{ asset('images/icon/location.png') }}" height="30"></h5>
 <h5 class="left" style="color: #808080;" >Location</h5>
  <p class="left" style="color: #808080;" >Le Méridien Chiang Mai, 108 Chang Klan Road, 
Chiang Mai, Chiang Mai, Thailand VIEW ON MAP
</p>
 				<br>
                           <div class="row">
                    <div class="col-1">
                        <img class="left" src="{{ asset('images/icon/fb.png') }}" height="35"  style="margin-right: 5px;">
                       </div>
                          <div class="col-11">
                     
                          <button class=" left buttonop"  style="margin-right: 5px;margin-top: 5px;">BIG ABC</button>
                       </div>
                        <div class="col-1">
                         <img class="left" src="{{ asset('images/icon/gg.png') }}" style="margin-right: 5px;" height="35">
                       </div>
                          <div class="col-11">
                            <button class=" left buttonop"  style="margin-right: 5px;margin-top: 5px;">BIG ABC@gmail.com</button>
                       </div>
                        <div class="col-1">
                         <img class="left" src="{{ asset('images/icon/in.png') }}" style="margin-right: 5px;" height="35">
                       </div>
                          <div class="col-11">
                             <button class=" left buttonop"  style="margin-right: 5px;margin-top: 5px;">BIG ABC</button>
                       </div>
                            <div class="col-1">
                         <img class="left" src="{{ asset('images/icon/tw.png') }}" style="margin-right: 5px;" height="35">
                       </div>
                          <div class="col-11">
                           <button class=" left buttonop"  style="margin-right: 5px;margin-top: 5px;">BIG ABC</button>
                       </div>

</div>
<br><br>
                <div class="row">
                    <div class="col-6">
                       <p class="left" style="color: #808080;" >กดถูกใจ</p>
                       </div>
                          <div class="col-6">
                       <p class="right" style="color: #808080;" >30</p>
                       </div>
                        <div class="col-6">
                       <p class="left" style="color: #808080;" >ยื่นสมัครงาน</p>
                       </div>
                          <div class="col-6">
                       <p class="right" style="color: #808080;" >54</p>
                       </div>
                        <div class="col-6">
                       <p class="left" style="color: #808080;" >การเข้าถึง</p>
                       </div>
                          <div class="col-6">
                       <p class="right" style="color: #808080;" >99</p>
                       </div>

</div></div>
				<div class="col-lg-9 opcenter">
                    		<table>
                  <th class="op2center">     <button class="blockop button3">WORK</button></th>
   <th class="op2center">   <button class="blockop button3">APPLICANT</button></th>
   <th class="op2center">   <button class="blockop button3">COURSE</button></th>
     <th class="op2center">  <button class="blockop button3">แบบทดสอบ/WORKSHOP</button></th>
</table>
					<table>


  
    <tr>
          <th class="op3center"> </th>
  <th class="op3center">ชื่อผู้สมัคร</th>
  <th class="op3center">ตำแหน่งที่สมัคร</th>
  <th class="op3center">วันที่สมัคร</th>
   <th class="op3center">เบอร์โทรติดต่อ</th>
      <th class="op3center">CV/RESUME</th>
          <th class="op3center">คำถาม/แบบทดสอบ</th>
                 <th class="op3center">สถานะ</th>
  </tr>

 @for ($i = 0; $i <= 29; $i++)
  <tr>
      <td class="opcenter"> {{$i+1}}</td>
  <td class="opcenter">Peter</td>
  <td class="opcenter">UX/UI DESIGH{{$i}}</td>
  <td class="opcenter">19/08/2022</td>
  <td class="opcenter">00-0000000</td>
   <td class="opcenter"><i class="fa fa-file-text" aria-hidden="true"></i></td>
    <td class="opcenter"><i class="fa fa-file-text" aria-hidden="true"> &nbsp&nbsp<i class="fa fa-file-text" aria-hidden="true"></i></i></td>
     <td class="opcenter">ส่งใบสมัครแล้ว</td>
  </tr>

 @endfor

</table>
				</div>
			</div>

</div> {{-- end #main --}}
   
              
    {{-- end #Profile --}}
    <script src="{{ asset('js/app.js') }}" ></script>

@endsection
@section('script')
    <script type="text/javascript">
        function showHideDiv() {
            var srcElement = document.getElementById('divBoxComment');
            if (srcElement != null) {
                if (srcElement.style.display == "block") {
                    // console.log(1);
                    document.getElementById('divBoxComment').style.display = 'none';
                } else {
                    // console.log(2);
                    document.getElementById('btnComment').style.display = 'none';
                    document.getElementById('divBoxComment').style.display = 'block';
                }
                return false;
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
    @if(session()->has('gb_success'))
        <script>
            Swal({
                position: 'top-end',
                type: 'success',
                title: "<?php echo session()->get('gb_success'); ?>",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @if(session()->has('gb_error'))
        <script>
            Swal({
                position: 'top-end',
                type: 'error',
                title: "<?php echo session()->get('gb_error'); ?>",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
@endsection
