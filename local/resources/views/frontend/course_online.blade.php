@extends('layouts.navber')
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
    
         
                 <img src="{{ asset('images/bannermockup2.png') }}" style="  width: 100%;"  ><br>
 
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
		<h4 class="left" style="color: black;" >เนื้อหาหลักสูตร</h4>
   
 				<br>
                    <div class="opcenter">
                        <div id="accordion">

  <div class="card">
    <div class="card-header" id="headingOne">
      <div class="mb-0 ">
        <div class="row">
              <div class="col-4 left">
          <h5>บทเรียนที่ 1 ความรู้พื้นฐาน   
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        <i class="fa fa-chevron-down circle" style="color: black;"  aria-hidden="true"></i> </button>  </h5>   </div>
           <div class="col-6 right">
         <i class="fa fa-play-circle " style="color: black;"  aria-hidden="true"></i> วิดีโอ 3 &nbsp;&nbsp; <i class="fa fa-clock-o" style="color: black;"  aria-hidden="true"></i> 05:28 นาที
          </div>
  </div>
      </div>
      
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
       {{-- start #course --}}
 <div class="row">
         <div class="col-1">
          <h5>1</h5>
        </div>
      <div class="col-2">
          <a href="{{ url('course_online_inside') }}">
                        <img src="{{ asset('images/1c.png') }}" class="mw-100 mb-3">
                    </a>
          </div>
 <div class="col-7">
          <div class="row">
         <div class="col-12 left">
          <h5>เรียนรู้การใช้งาน React ร่วมกับ API</h5>
        </div>
      <div class="col-12 left">
       <p>  หลักสูตรนี้คุณจะได้เรียนรู้การการประยุกต์ใช้งาน React สำหรับการสร้างเว็บแอพพลิเคชั่น
ซึ่งมีทั้งหมด 15 แอพพลิเคชั่นด้วยกันรวมอยู่ในคอร์สเดียว สามารถนำไปต่อยอดในการนำ 
React ไปใช้งานจริง ในคอร์สนี้นอกจากคุณจะได้เรียนเรื่อง React แล้ว </p>

          </div>
          </div> </div>
<div class="col-2">
    01 : 30 นาที
       </div>
      </div> {{-- end #course --}}
       {{-- start #course --}}
 <div class="row">
         <div class="col-1">
          <h5>2</h5>
        </div>
      <div class="col-2">
          <a href="{{ url('course_online_inside') }}">
                        <img src="{{ asset('images/1c.png') }}" class="mw-100 mb-3">
                    </a>
          </div>
 <div class="col-7">
          <div class="row">
         <div class="col-12 left">
          <h5>เรียนรู้การใช้งาน React ร่วมกับ API</h5>
        </div>
      <div class="col-12 left">
       <p>  หลักสูตรนี้คุณจะได้เรียนรู้การการประยุกต์ใช้งาน React สำหรับการสร้างเว็บแอพพลิเคชั่น
ซึ่งมีทั้งหมด 15 แอพพลิเคชั่นด้วยกันรวมอยู่ในคอร์สเดียว สามารถนำไปต่อยอดในการนำ 
React ไปใช้งานจริง ในคอร์สนี้นอกจากคุณจะได้เรียนเรื่อง React แล้ว </p>

          </div>
          </div> </div>
<div class="col-2">
    01 : 30 นาที
       </div>
      </div> {{-- end #course --}}
       {{-- start #course --}}
 <div class="row">
         <div class="col-1">
          <h5>3</h5>
        </div>
      <div class="col-2">
          <a href="{{ url('course_online_inside') }}">
                        <img src="{{ asset('images/1c.png') }}" class="mw-100 mb-3">
                    </a>
          </div>
 <div class="col-7">
          <div class="row">
         <div class="col-12 left">
          <h5>เรียนรู้การใช้งาน React ร่วมกับ API</h5>
        </div>
      <div class="col-12 left">
       <p>  หลักสูตรนี้คุณจะได้เรียนรู้การการประยุกต์ใช้งาน React สำหรับการสร้างเว็บแอพพลิเคชั่น
ซึ่งมีทั้งหมด 15 แอพพลิเคชั่นด้วยกันรวมอยู่ในคอร์สเดียว สามารถนำไปต่อยอดในการนำ 
React ไปใช้งานจริง ในคอร์สนี้นอกจากคุณจะได้เรียนเรื่อง React แล้ว </p>

          </div>
          </div> </div>
<div class="col-2">
    01 : 30 นาที
       </div>
      </div> {{-- end #course --}}
    
         {{-- start #test --}}     <br>
 <div class="row">

         <div class="col-1">
          <h5></h5>
        </div>
      <div class="col-2">
           <h5> <i class="fa fa-file-text circlered" style="color: white;"  aria-hidden="true"></i></h5>
          </div>
 <div class="col-7">
          <div class="row">
         <div class="col-12 left">
          <h5>แบบทดสอบความรู้</h5>
        </div>
      <div class="col-12 left">
       <p>  จำนวนทั้งหมด 10 ข้อ </p>

          </div>
          </div> </div>
<div class="col-2">
 
<h5> <i class="fa fa-check-circle" style="color: green;"  aria-hidden="true"></i></h5>
    
       </div>
      </div> 
    <br>{{-- end #test --}}
    </div>

    
  </div>
  
 
  <div class="card">
    <div class="card-header" id="headingTwo">
     <div class="mb-0 ">
        <div class="row">
              <div class="col-4 left">
           <h5>  บทเรียนที่ 2 ความเข้าใจเกี่ยวกับโค้ด
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              <i class="fa fa-chevron-down circle" style="color: black;"  aria-hidden="true"></i></button>  </h5>   </div>
         <div class="col-6 right">
         <i class="fa fa-play-circle " style="color: black;"  aria-hidden="true"></i> วิดีโอ 1 &nbsp;&nbsp; <i class="fa fa-clock-o" style="color: black;"  aria-hidden="true"></i> 01:30 นาที
          </div>
  </div>
      </div>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
              {{-- start #course --}}
 <div class="row">
         <div class="col-1">
          <h5>1</h5>
        </div>
      <div class="col-2">
          <a href="{{ url('course_online_inside') }}">
                        <img src="{{ asset('images/1c.png') }}" class="mw-100 mb-3">
                    </a>
          </div>
 <div class="col-7">
          <div class="row">
         <div class="col-12 left">
          <h5>เรียนรู้การใช้งาน React ร่วมกับ API</h5>
        </div>
      <div class="col-12 left">
       <p>  หลักสูตรนี้คุณจะได้เรียนรู้การการประยุกต์ใช้งาน React สำหรับการสร้างเว็บแอพพลิเคชั่น
ซึ่งมีทั้งหมด 15 แอพพลิเคชั่นด้วยกันรวมอยู่ในคอร์สเดียว สามารถนำไปต่อยอดในการนำ 
React ไปใช้งานจริง ในคอร์สนี้นอกจากคุณจะได้เรียนเรื่อง React แล้ว </p>

          </div>
          </div> </div>
<div class="col-2">
    01 : 30 นาที
       </div>
      </div> {{-- end #course --}}

     
    
         {{-- start #test --}}     <br>
 <div class="row">

         <div class="col-1">
          <h5></h5>
        </div>
      <div class="col-2">
           <h5> <i class="fa fa-file-text circlered" style="color: white;"  aria-hidden="true"></i></h5>
          </div>
 <div class="col-7">
          <div class="row">
         <div class="col-12 left">
          <h5>แบบทดสอบความรู้</h5>
        </div>
      <div class="col-12 left">
       <p>  จำนวนทั้งหมด 10 ข้อ </p>

          </div>
          </div> </div>
<div class="col-2">
 
<h5> <i class="fa fa-check-circle" style="color: green;"  aria-hidden="true"></i></h5>
    
       </div>
      </div> 
    <br>{{-- end #test --}}
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
     <div class="mb-0 ">
        <div class="row">
              <div class="col-4 left">
              <h5>   บทเรียนที่ 3 ความเข้าใจเกี่ยวกับโค้ด
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            <i class="fa fa-chevron-down circle" style="color: black;"  aria-hidden="true"></i></button>  </h5>   </div>
     <div class="col-6 right">
         <i class="fa fa-play-circle " style="color: black;"  aria-hidden="true"></i> วิดีโอ 2 &nbsp;&nbsp; <i class="fa fa-clock-o" style="color: black;"  aria-hidden="true"></i> 03:00 นาที
          </div>
  </div>
      </div>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
              {{-- start #course --}}
 <div class="row">
         <div class="col-1">
          <h5>1</h5>
        </div>
      <div class="col-2">
          <a href="{{ url('course_online_inside') }}">
                        <img src="{{ asset('images/1c.png') }}" class="mw-100 mb-3">
                    </a>
          </div>
 <div class="col-7">
          <div class="row">
         <div class="col-12 left">
          <h5>เรียนรู้การใช้งาน React ร่วมกับ API</h5>
        </div>
      <div class="col-12 left">
       <p>  หลักสูตรนี้คุณจะได้เรียนรู้การการประยุกต์ใช้งาน React สำหรับการสร้างเว็บแอพพลิเคชั่น
ซึ่งมีทั้งหมด 15 แอพพลิเคชั่นด้วยกันรวมอยู่ในคอร์สเดียว สามารถนำไปต่อยอดในการนำ 
React ไปใช้งานจริง ในคอร์สนี้นอกจากคุณจะได้เรียนเรื่อง React แล้ว </p>

          </div>
          </div> </div>
<div class="col-2">
    01 : 30 นาที
       </div>
      </div> {{-- end #course --}}
       {{-- start #course --}}
 <div class="row">
         <div class="col-1">
          <h5>2</h5>
        </div>
      <div class="col-2">
          <a href="{{ url('course_online_inside') }}">
                        <img src="{{ asset('images/1c.png') }}" class="mw-100 mb-3">
                    </a>
          </div>
 <div class="col-7">
          <div class="row">
         <div class="col-12 left">
          <h5>เรียนรู้การใช้งาน React ร่วมกับ API</h5>
        </div>
      <div class="col-12 left">
       <p>  หลักสูตรนี้คุณจะได้เรียนรู้การการประยุกต์ใช้งาน React สำหรับการสร้างเว็บแอพพลิเคชั่น
ซึ่งมีทั้งหมด 15 แอพพลิเคชั่นด้วยกันรวมอยู่ในคอร์สเดียว สามารถนำไปต่อยอดในการนำ 
React ไปใช้งานจริง ในคอร์สนี้นอกจากคุณจะได้เรียนเรื่อง React แล้ว </p>

          </div>
          </div> </div>
<div class="col-2">
    01 : 30 นาที
       </div>
      </div> {{-- end #course --}}
      
    
         {{-- start #test --}}     <br>
 <div class="row">

         <div class="col-1">
          <h5></h5>
        </div>
      <div class="col-2">
           <h5> <i class="fa fa-file-text circlered" style="color: white;"  aria-hidden="true"></i></h5>
          </div>
 <div class="col-7">
          <div class="row">
         <div class="col-12 left">
          <h5>แบบทดสอบความรู้</h5>
        </div>
      <div class="col-12 left">
       <p>  จำนวนทั้งหมด 10 ข้อ </p>

          </div>
          </div> </div>
<div class="col-2">
 
<h5> <i class="fa fa-check-circle" style="color: green;"  aria-hidden="true"></i></h5>
    
       </div>
      </div> 
    <br>{{-- end #test --}}
      </div>
    </div>
  </div>
</div></div>
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
