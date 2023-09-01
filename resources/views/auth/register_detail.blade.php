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
          .bg-light2 {
            background-color: #8B0900;
            background-image: url("{{ asset('image/bg.png') }}");
        }

    </style>
@endsection
@section('content')
    <div id="app">
     {{--begin #register --}}
     <div id="register-section1" class="bg-light2">
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
                             <form method="POST" action="{{ route('register') }}" id="searchForm"  enctype="multipart/form-data">
                                 @csrf
                                 <div class="form-row align-items-center">
                                     <div class="col-auto">
                                         <label class="form-label" for="inlineFormInput">ประเภท</label>
                                     </div>
                                     <div class="col-auto">
                                         <div class="form-check mb-2">
                                             <input class="form-check-input" type="checkbox" id="autoSizingCheck" name="typeAccount1" value="1">
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
                                         {{-- {!!  Form::select('prefixe_id', $prefixes, null, ['id' => 'prefixe_id','class' => 'form-control' , 'placeholder' => 'เลือก' ]) !!} --}}
                                         <?php
                                         $prefixes = App\Models\Prefix::select('name','id')->get();
                                         ?>
                                         <select class="form-control" name="prefixe_id">
                                            <option value="">เลือก</option>
                                            @foreach($prefixes as $prefixe)
                                            <option value="{{$prefixe->id}}">{{$prefixe->name}}</option>
                                            @endforeach
                                         </select>

                                     </div>
                                     <div class="form-group col-md-5">
                                         <label for="inputEmail4">ชื่อจริง</label>
                                         <input name="firstname" type="text" class="form-control" id="inputEmail4">
                                     </div>
                                     <div class="form-group col-md-4">
                                         <label for="inputPassword4">นามสกุล</label>
                                         <input name="lastname" type="text" class="form-control" id="inputPassword4">
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleInputEmail1">เบอร์โทร</label>
                                     <input type="text" class="form-control" id="exampleInputEmail1" name="tel">
                                 </div>
                                 <a href="ref"></a>
                                 <div class="form-group">
                                     <label for="exampleInputEmail1">Username</label>
                                     <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                     @if ($errors->has('name'))
                                         <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                     @endif
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleInputEmail1">อีเมล์</label>
                                     <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                     @if ($errors->has('email'))
                                         <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                     @endif
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleInputEmail1">รหัสผ่าน</label>
                                     <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                     @if ($errors->has('password'))
                                         <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                     @endif
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleInputEmail1">ยืนยัน รหัสผ่าน</label>
                                     <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleFormControlFile1">รูปประจำตัว</label>
                                     <input type="file" class="form-control-file" id="exampleFormControlFile1" name="imageProfile">
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleFormControlFile1">รูปสำเนาบัตรประชาชน</label>
                                     <input type="file" class="form-control-file" id="exampleFormControlFile1" name="fileCard">
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleFormControlFile1">เอกสารอ้างอิง/ใบอนุญาต เพื่อใช้ยืนยันตัวตน</label>
                                     <input type="file" class="form-control-file" id="exampleFormControlFile1" name="fileProfile">
                                 </div>
                                         <div class="form-group form-check">
                                             <input type="checkbox" class="form-check-input" name="i_accept" id="i_accept">
                                             <label class="form-check-label" for="exampleCheck1">ยอมรับ
                                                 <a class="text-primary pointer" data-toggle="modal" data-target="#exampleModal" >
                                                     ข้อตกลงและเงื่อนไข</a> การสมัครสมาชิก
                                     </label>
                                 </div>
                                 <div class="form-group" >
                                    <button type="submit" name="btn_send" id="btn_send" class="btn btn-success w-100" disabled="disabled">สมัครสมาชิก</button>
                                     {{-- <button type="button" name="btn_send" id="btn_send" class="btn btn-success w-100" data-toggle="modal" data-target="#otpModal"  disabled="disabled">สมัครสมาชิก</button> --}}
                                 </div>
                                 <modal-otp></modal-otp>
                                 <div class="form-group text-center">
                                     <p>มีบัญชีแล้ว? <a href="{{ url('login') }}">เข้าสู่ระบบ</a></p>
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
@endsection
