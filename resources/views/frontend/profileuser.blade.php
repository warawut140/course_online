@extends('layouts.navbercompany')
@section('head')
    {{-- @include('sweetalert::alert') --}}
@endsection
@section('content')

<style> 
body {
 background-image: url("{{ asset('images/bgco.png') }}");
  width: 100%;
   margin: 0 auto;
}
.main {
     background-image: url("{{ asset('images/bgco.png') }}");
    width: 70%;
  margin-right: 200px;
  margin-left: 200px;
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
      margin-top: 150px;
   text-align: center;
   
      padding: 10px;
       
}
.left {
   text-align: left;
 
      margin-Right: 20px;  
}
.right {
   text-align: right;
    margin-Right: 80px;
      margin-left: 20px;   
}
.op2center {
   border: 2px solid gray;
    width: 100%;
   text-align: left;

      padding: 10px;
        margin: auto;
        color: black;
        background-color: white;
      font-size: 18px;
      font-style: normal;
}
.active {
  border-left: 20px solid #8B0900;
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
.circleco{
    color:gray;
        border-radius: 50%;
           border: 2px solid gray;
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
	
<button class="op2center active"><font style="margin-left: 30px;">BASIC INFOMRMATION</font></button>

      <button class="op2center"><font style="margin-left: 30px;">ON THE WEB</font></button>
     
      <button class="op2center"><font style="margin-left: 30px;">ABOUT ME</font></button>
    
      <button class="op2center"><font style="margin-left: 30px;">Education</font></button>
      
      <button class="op2center"><font style="margin-left: 30px;">WORK EXPERIENCE</font></button>
     <!-- <img src="{{ asset('images/bgco.png') }}	" class="img-fluid" alt="Responsive image"></a> -->
			
		</div>	
        <div class="col-lg-1 ">
            </div>
				<div class="col-lg-8 ">
                    <br><br><br>
                    		<h4 class="left" style="color: #8B0900;" >BASIC INFORMATION</h4><br>
                    	

<img src="{{ asset('images/upload.png') }}" class="circleco mb-2 mw-100" width="200" height="200"><br>

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
