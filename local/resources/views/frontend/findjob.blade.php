@extends('layouts.navber')
@section('head')
    {{-- @include('sweetalert::alert') --}}
@endsection
@section('content')

<style>
.bgdd{
    background-image: url("{{ asset('images/bgcourse.png') }}");
       background-repeat: no-repeat;
  background-size: 100%;
     height: 2000px;
}
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
   margin-top: 10px;
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
.circle {
 border: 1px solid black;
   border-radius: 50%;

  padding: 5px;
}

.circlered {
 border: 1px solid red;
   background-color: #8B0900;
   border-radius: 50%;
    font-size:2em;
  padding: 30px;
}


.active {

   background-color: #f08080;

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


 <div class="bgdd">

               <br>

  <div class="main opcenter">

        <div class="row">
				<div class="col-lg-12 optop">
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
.buttonblack {
  background-color: while;
  border: 1px solid grey;
  font-size: 1.5em;
    padding: 20px 20px;

  border-radius: 50px;

}
#more {display: none;}
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

<br>
 <div class="row ">
      <div class="col-6">
 				<br>
 				<br>
 				<br>
 				<br>
		<h1 class="left" style="color: black;" >ค้นหางานที่ใช่สำหรับคุณ</h1>
        <h1 class="left" style="color: #8B0900;" >Find Job</h1><br>
             <img src="{{ asset('images/Group3773.png') }}" style="  width: 80%;">
    </div>
     <div class="col-6">
 				<br>
                    <div class="opcenter">
                  <br>     <br>  <br>

            <h5 class="mb-3 text-left"><font style="color:grey">รายการแนะนำ</font></h5>
                   <br>




<p> <div class="row"> <a class="nav-link py-1 buttonblack " style="margin-right: 20px;margin-top: 20px;" href="javascript:;"><font style="color:grey">วิศวะกรรมศาสตร์</font></a>
                <a class="nav-link py-1 buttonblack"  style="margin-right: 20px;margin-top: 20px;" href="javascript:;"><font style="color:grey">การจัดการธุรกิจโรงแรม</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="javascript:;"><font style="color:grey">การศึกษา</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="javascript:;"><font style="color:grey">เทคนิคการแพทย์</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="javascript:;"><font style="color:grey">การเงิน</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="javascript:;"><font style="color:grey">เทคโนโลยีสารสนเทศ</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="javascript:;"><font style="color:grey">สังคมและการบริการสังคม</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="javascript:;"><font style="color:grey">ฝ่ายบริการลูกค้า</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="javascript:;"><font style="color:grey">การตลาด</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="javascript:;"><font style="color:grey">นักวิชาการ</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="javascript:;"><font style="color:grey">นักบัญชี</font></a> <span id="dots"></span></div>
                <span id="more"> <div class="row"> <a class="nav-link py-1 buttonblack " style="margin-right: 20px;margin-top: 20px;" href="javascript:;"><font style="color:grey">วิศวะกรรมศาสตร์</font></a>
                <a class="nav-link py-1 buttonblack"  style="margin-right: 20px;margin-top: 20px;" href="javascript:;"><font style="color:grey">การจัดการธุรกิจโรงแรม</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="javascript:;"><font style="color:grey">การศึกษา</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="javascript:;"><font style="color:grey">เทคนิคการแพทย์</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="javascript:;"><font style="color:grey">การเงิน</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="javascript:;"><font style="color:grey">เทคโนโลยีสารสนเทศ</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="javascript:;"><font style="color:grey">สังคมและการบริการสังคม</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="javascript:;"><font style="color:grey">ฝ่ายบริการลูกค้า</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="javascript:;"><font style="color:grey">การตลาด</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="javascript:;"><font style="color:grey">นักวิชาการ</font></a>
                <a class="nav-link py-1 buttonblack"   style="margin-right: 20px;margin-top: 20px;"href="javascript:;"><font style="color:grey">นักบัญชี</font></a> </div></span></p>
 <div class="left">
<a onclick="myFunction()" id="myBtn" class="left">ดูเพิ่มเติม</a>
      </div>

        </div>
         <div class="right">
            <a href="{{url('register_user_detail')}}" style="background-color: #8B0900; color:white;" class="btn ">ถัดไป <i class="fa fa-chevron-right" aria-hidden="true"></i> </a>
      {{-- <button type="submit" style="background-color: #8B0900; color:white;" class="btn ">ถัดไป <i class="fa fa-chevron-right" aria-hidden="true"></i> </button> --}}
                </div>
    </div>
 </div>
              </div> {{-- end #main --}}</div>
    {{-- end #Profile --}}
    <script src="{{ asset('js/app.js') }}" ></script>

@endsection
@section('script')
    <script type="text/javascript">
        function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "ดูเพิ่มเติม";
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "ดูน้อยลง";
    moreText.style.display = "inline";
  }
}
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
