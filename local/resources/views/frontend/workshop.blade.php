@extends('layouts.navber')
@section('head')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    {{-- <script src="https://rawgit.com/vuejs/vue/dev/dist/vue.js"></script> --}}
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet">
    {{-- <script>
        function checkTypeUser(id) {
            if (id == 2) {
                $('#typeUser').show();
            } else {
                $('#typeUser').hide();
            }
        }
    </script> --}}
    <style>
        body {

}
.main {
    background-image: url("{{ asset('images/bgco.png') }}");
   background-repeat: no-repeat;
  background-size: auto;

  margin-right: 200px;
  margin-left: 200px;
}
        .bg-light2 {
            /* background-color: #8B0900;
                                            background-image: url("{{ asset('image/bg.png') }}"); */
            /* clear: both; */
        }


        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            border-left: 15px solid #8B0900;
                 background-color: white;
                     color: black;
        }
     .gray {
            color: #fff;
            background-color: #8B0900;
        }
        .nav-pills a.nav-link {
            color: black;
            border-bottom: 1px solid #d9d9d9;
        }

        .select2-container .select2-selection--single {
            height: 30px;
        }

        .input-group-text {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding: 0.375rem 0.75rem;
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #ffffff;
            text-align: center;
            white-space: nowrap;
            background-color: #8B0900;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }
        .input-group-text2 {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding: 0.375rem 0.75rem;
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #ffffff;
            text-align: center;
            white-space: nowrap;
            background-color: #f8f8f8;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }
        .circlered {
  background-color: #8B0900;
  border-radius: 50%;
  border: 1px solid #8B0900;
  padding: 10px;
}

        .circlegreen {
  background-color: green;
  border-radius: 50%;
  border: 1px solid green;
  padding: 10px;
}
.left {
   text-align: left;

    margin-left: 280px;
      margin-Right: 20px;  
}

.left2 {
   text-align: left;

    margin-left: 20px;
      margin-Right: 20px;  
}

.right {
   text-align: right;

    margin-Right: 80px;
      margin-left: 20px;  
}
    </style>
@endsection
@section('content')
    <div id="app" class="main">

      
          <br>   
       <div class="left">
      <button  style="background-color: #8B0900; color:white;" class="btn "><i class="fa fa-chevron-left" aria-hidden="true"></i> ย้อนกลับ  </button>
                </div>
  
<div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
    
  
      <h4 style="color:#8B0900;"><i class="fa fa-file-text circlered " aria-hidden="true" style="color:white;"></i> แบบทดสอบ/WORKSHOP</h4>
   <br><br>
     {{-- begin #header --}}
      <div class="card">
        <div class="card-body">
            
                <div class="form-row">
                    <div class="form-group col-md-4">
           <h3>แบบทดสอบความรู้ </h3>   </div>  <div class="form-group col-md-8"><h3>องค์กรและการพัฒนาองค์กรสมัยใหม่</h3> </div>  
           <div class="form-group col-md-12">
           <h5 style="color:gray;"> Data science is one of today's top careers. Get the training you need to get ahead—or stay on top—in fields such as data analysis, mining, visualization, and big data, using tools like Excel, R, Hadoop, and Python.</h5> 
    </div> <br><br>
           <div class="form-group col-md-12">
                <h5 style="color:gray;"> จำนวนทั้งหมด 4 ข้อ</h5> 
            </div>
 <div class="form-group col-md-12">
                <h5 style="color:gray;"> 10 คะแนน</h5> 
            </div>
          
            </div>
             <div class="right">
           <h4 style="color:green;"> ผ่าน <i class="fa fa-check-circle circlegreed " aria-hidden="true" style="color:green;"></i></h4>
  <div class="form-group col-md-12">
                <h4 style="color:red;"> 10 / 10 คะแนน</h4> 
            </div> 
                </div>



            </div>
        </div>
         {{-- end #header --}} 

              {{-- begin #ข้อกา --}}
             
                 <br><br>
    <h1 style="color:#8B0900;"> 1</h1> 
        
      <div class="card">
     
        <div class="card-body">
            
                <div class="form-row">
                    <div class="form-group col-md-12"><br>
           <h5 style="color:gray;">ข้อใดถูกต้องที่สุด? </h5>   </div> 
            <div class="form-row">
           <div class="form-group col-md-12 left2">
         <h5 style="color:gray;"> <input type="radio" id="html" name="fav_language" value="HTML">
  <label for="html">ตัวเลือกที่ 1</label><br>  </h5> 
    </div> 

 <div class="form-group col-md-12 left2">
         <h5 style="color:gray;"> <input type="radio" id="html" name="fav_language" value="HTML">
  <label for="html">ตัวเลือกที่ 2</label><br>  </h5> 
    </div>

     <div class="form-group col-md-12 left2">
         <h5 style="color:gray;"> <input type="radio" id="html" name="fav_language" value="HTML">
  <label for="html">ตัวเลือกที่ 3</label><br>  </h5> 
    </div>
     <div class="form-group col-md-12 left2">
         <h5 style="color:gray;"> <input type="radio" id="html" name="fav_language" value="HTML">
  <label for="html">ตัวเลือกที่ 4</label><br>  </h5> 
    </div>
</div> 
          
            </div>
            
              



            </div>
        </div>
         {{-- end #ข้อกา --}} 

           {{-- begin #ข้อขียน --}}
                 <br><br>
     <h1 style="color:#8B0900;"> 2</h1> 
      <div class="card">
               <div class="card-body">
            
                <div class="form-row">
                    <div class="form-group col-md-12"><br>
           <h5 style="color:gray;">จงเขียนโค้ดการแสดงข้อมูลแบบ Pop up </h5>   </div> 
            <div class="form-row">
           <div class="form-group col-md-12 left2">
        <textarea id="detail" name="detail" rows="10"  cols="90
        "> </textarea>  </h5> 
    </div> 

 <div class="form-group col-md-3 left2">
       <div class="card">
         <div class="card-body">
            
                <h5 style="color:#8B0900; text-align: center;"> 5 คะแนน</h5> 
  </div>
    </div>
    </div>
</div> 
            </div>
            </div>
        </div>
         {{-- end #ข้อขียน --}} 

                    {{-- begin #ข้อกา --}}
             
                 <br><br>
    <h1 style="color:#8B0900;"> 3</h1> 
      <div class="card">
     
        <div class="card-body">
            
                <div class="form-row">
                    <div class="form-group col-md-12"><br>
           <h5 style="color:gray;">ข้อใดถูกต้องที่สุด? </h5>   </div> 
            <div class="form-row">
           <div class="form-group col-md-12 left2">
         <h5 style="color:gray;"> <input type="radio" id="html" name="fav_language" value="HTML">
  <label for="html">ตัวเลือกที่ 1</label><br>  </h5> 
    </div> 

 <div class="form-group col-md-12 left2">
         <h5 style="color:gray;"> <input type="radio" id="html" name="fav_language" value="HTML">
  <label for="html">ตัวเลือกที่ 2</label><br>  </h5> 
    </div>

     <div class="form-group col-md-12 left2">
         <h5 style="color:gray;"> <input type="radio" id="html" name="fav_language" value="HTML">
  <label for="html">ตัวเลือกที่ 3</label><br>  </h5> 
    </div>
     <div class="form-group col-md-12 left2">
         <h5 style="color:gray;"> <input type="radio" id="html" name="fav_language" value="HTML">
  <label for="html">ตัวเลือกที่ 4</label><br>  </h5> 
    </div>
</div> 
          
            </div>
            
              



            </div>
        </div>
         {{-- end #ข้อกา --}} 

          {{-- begin #ข้อขียน --}}
                                <br><br>
     <h1 style="color:#8B0900;"> 4</h1> 
      <div class="card">
               <div class="card-body">
            
                <div class="form-row">
                    <div class="form-group col-md-12"><br>
           <h5 style="color:gray;">จงเขียนโค้ดการแสดงข้อมูลแบบ Pop up </h5>   </div> 
            <div class="form-row">
           <div class="form-group col-md-12 left2">
        <textarea id="detail" name="detail" rows="10"  cols="90
        "> </textarea>  </h5> 
    </div> 

 <div class="form-group col-md-3 left2">
       <div class="card">
         <div class="card-body">
            
                <h5 style="color:#8B0900; text-align: center;"> 5 คะแนน</h5> 
  </div>
    </div>
    </div>
</div> 
            </div>
            </div>
        </div>
         {{-- end #ข้อขียน --}} 

             <br><br>    <br><br>    <br><br>
</div>


 
                </div>
            </div>
        </div>

        <!-- Modal ข้อตกลงและเงื่อนไข-->
        {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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
        </div> --}}
        {{-- end #register --}}
    </div>
    {{-- <script src="/js/app.js" charset="utf-8"></script> --}}
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
@endsection
@section('script')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('select2/select2.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // $('#typeUser').hide();
            $('.select2').select2({
                width: '100%',
            });
            // CKEDITOR.replace('detail_scope');

            setTimeout(function() {
                $('.success').hide()
            }, 2000);
            setTimeout(function() {
                $('.error').hide()
            }, 2000);

        });



        $(function() {
            $(":checkbox[name=i_accept]").on("click", function() {
                var i_check = $(this).prop("checked");
                console.log(i_check);
                if (i_check == true) {
                    $("button[name=btn_send]").attr("disabled", false);
                } else {
                    $("button[name=btn_send]").attr("disabled", true);
                }
            });
        });
    </script>
    <script>
        $('.bg-light').css({
            'min-height': $(window).height() - $('.navbar').height() - $('#section-footer').height()
        });
    </script>
@endsection
