@extends('layouts.navber')
@section('head')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    {{-- <script src="https://rawgit.com/vuejs/vue/dev/dist/vue.js"></script> --}}
    <script>
        function checkTypeUser(id) {
            if (id == 2) {
                $('#typeUser').show();
            } else {
                $('#typeUser').hide();
            }
        }
    </script>
    <style>
        .bg-light2 {
            /* background-color: #8B0900;
                        background-image: url("{{ asset('image/bg.png') }}"); */
            /* clear: both; */
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #8B0900;
        }

        .nav-pills a.nav-link {
            color: black;
            border-bottom: 1px solid #d9d9d9;
        }
    </style>
@endsection
@section('content')

    <div id="app">

        {{-- begin #register --}}
        <div id="register-section1" class="bg-light2">
            <div class="container py-5">
                <div class="row">
                    <div class="col-md-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link " id="v-pills-home-tab"  href="{{url('register_company_detail')}}"
                                role="tab" aria-controls="v-pills-home" aria-selected="true">BASIC INFORMATION</a>
                            <a class="nav-link" id="v-pills-profile-tab"  href="{{url('register_company_on_web')}}"
                                role="tab" aria-controls="v-pills-profile" aria-selected="false">ON THE WEB</a>
                            <a class="nav-link active" id="v-pills-messages-tab"  href="{{url('register_company_job')}}"
                                role="tab" aria-controls="v-pills-messages" aria-selected="false">Add a job
                                description</a>
                            <a class="nav-link" id="v-pills-settings-tab"  href="#v-pills-settings"
                                role="tab" aria-controls="v-pills-settings" aria-selected="false">How would you like to
                                receive your applicants?
                            </a>
                        </div>
                        {{-- <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">...</div>
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
                            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
                          </div> --}}
                    </div>

                    <div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                        <h4 style="color:#8B0900;">ADD A JOB DESCRIPTION</h4>
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title text-center">สมัครสมาชิก</h5> --}}
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
                                <form method="POST" action="{{ url('register_company_detail_basic_store') }}" id="searchForm"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">ตำแหน่ง</label>
                                        <input type="text" class="form-control"  id="exampleInputEmail1"
                                            name="tel">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">ระดับประสบการณ์</label>
                                            <input name="firstname" type="text"  class="form-control"
                                                id="inputEmail4">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">จำนวนที่รับสมัคร</label>
                                            <input name="lastname" type="text"  class="form-control"
                                                id="inputPassword4">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">สถานที่ทำงาน</label>
                                            <select class="form-control">
                                                <option value="">กรุณาเลือก</option>
                                                <option value="">Hybrid</option>
                                               </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">ประเภทการจ้างงาน</label>
                                           <select class="form-control">
                                            <option value="">กรุณาเลือก</option>
                                            <option value="">เต็มเวลา</option>
                                           </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">เพิ่มรายละเอียดของงาน</label>
                                        <textarea type="text" class="form-control" name="ssxx"></textarea>
                                        </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Skill ที่ต้องการ</label>
                                        <textarea type="text" class="form-control" name="ssxx"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">คอร์สเรียนที่ควรผ่านการเรียนรู้มาก่อน</label>
                                            <br>
                                            <button class="btn btn-sm btn-outline-primary">+ เพิ่มคอร์สเรียน</button>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">เงินเดือน</label>
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                                    <label class="form-check-label" for="inlineCheckbox1">กำหนด</label>
                                                  </div>
                                                  <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                                    <label class="form-check-label" for="inlineCheckbox2">รอเจรจา</label>
                                                  </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="inputPassword4">งวดการจ่ายเงิน</label>
                                                   <select class="form-control">
                                                    <option value="">กรุณาเลือก</option>
                                                    <option value="">รายเดือน</option>
                                                    <option value="">รายวัน</option>
                                                   </select>
                                                </div>

                                                <div class="form-group" >
                                                    <button type="submit" style="background-color: #8B0900; color:white;" class="btn  w-100">สร้างตำแหน่งงานที่ต้องการ</button>
                                                 </div>

                                                 <div class="form-group" >
                                                    <button type="submit" class="btn btn-outline-danger w-100">ยกเลิก</button>
                                                 </div>


                                        <div class="form-group" >
                                            <button type="submit" style="background-color: #8B0900; color:white;" class="btn  w-100">Submit</button>
                                         </div>
                                    </form>
                                </div>
                            </div>
                    </div>

                    </div>
                </div>
            </div>

            <!-- Modal ข้อตกลงและเงื่อนไข-->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
            </div>
            {{-- end #register --}}
        </div>
        {{-- <script src="/js/app.js" charset="utf-8"></script> --}}
        <script src="{{ asset('js/app.js') }}"></script>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            // console.log( "ready!" );
            // console.log($('#otp').val());
            $('#typeUser').hide();
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
