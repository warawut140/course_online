<div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
    <br>
    <h4 style="color:#8B0900;">BASIC INFORMATION</h4>
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

                <input type="hidden" name="type" value="basic">

                <div class="form-row">
                    <div class="form-group col-md-6">
                      @if($data)
                      <img src="{{ asset('images/profile/'.$data->image_profile) }}" class="circleco mb-2 mw-100" width="200" height="200"><br>
                      @else
                      <img src="{{ asset('images/upload.png') }}" class="circleco mb-2 mw-100" width="200" height="200"><br>
                      @endif
                      </div>
                              <div class="form-group col-md-6">
                                  <label for="image_profile">รูปภาพโปรไฟล์</label>
                                  <input type="file" class="form-control-file" id="image_profile"  name="image_profile">
                              </div>

                               </div>

                <div class="form-group">
                    <label for="company">ชื่อบริษัท</label>
                    <input type="text" class="form-control" value="{{$data->company}}" required name="company" id="company"
                        name="tel">
                </div>
                {{-- <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">ID</label>
                        <input name="firstname" type="text"  class="form-control"
                            id="inputEmail4">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">รหัสผ่าน</label>
                        <input name="lastname" type="text"  class="form-control"
                            id="inputPassword4">
                    </div>
                </div> --}}

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="services">ผลิตภัณฑ์/บริการ</label>
                        <input name="services" type="text" value="{{$data->services}}" required class="form-control"
                            id="services">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="emp_number">จำนวนพนักงานทั้งหมด</label>
                        <input name="emp_number" type="text" value="{{$data->emp_number}}" required class="form-control"
                            id="emp_number">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="registration_number">เลขที่จดแจ้ง</label>
                        <input name="registration_number" type="text" value="{{$data->registration_number}}" class="form-control"
                            id="registration_number">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="company_tel">เบอร์โทรติดต่อสำนักงาน</label>
                        <input name="company_tel" type="text" required value="{{$data->company_tel}}" class="form-control"
                            id="company_tel">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="day_work">วันทำงาน</label>
                        <input name="day_work" type="text"  value="{{$data->day_work}}" class="form-control"
                            id="day_work">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="day_off">วันหยุด</label>
                        <input name="day_off" type="text" value="{{$data->day_off}}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="company_address">สถานที่ตั้ง</label>
                    <textarea type="text" class="form-control" required name="company_address">{{$data->company_address}}</textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="bank_name">ธนาคาร</label>
                            <input name="bank_name" type="text" required value="{{$data->bank_name}}"  class="form-control"
                                id="bank_name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="bank_number">เลขบัญชี <span style="color:rgb(47, 137, 255); font-size:10px;">ส่วนนี้สำหรับการโอนรายได้ค่าคอร์สเรียน</span></label>
                            <input name="bank_number" type="text" required value="{{$data->bank_number}}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title_about_me">หัวข้อเกี่ยวกับเรา</label>
                        <input type="text" class="form-control" value="{{@$data->title_about_me}}" id="title_about_me"
                            name="title_about_me">
                    </div>


                    <div class="form-group">
                        <label for="detail_about_me">รายละเอียดเกี่ยวกับเรา</label>
                        <textarea type="text" class="form-control" name="detail_about_me">{{@$data->detail_about_me}}</textarea>
                        </div>


                    <div class="form-group">
                        <label for="exampleFormControlFile1">รูปภาพเกี่ยวกับบริษัทเพิ่มเติม</label>
                        <input type="file" class="form-control-file" id="company_img1" name="company_img1"><br>
                        @if($data->company_img1!='')
                        <img src="{{asset('images/profile/'.$data->company_img1)}}" width="300px" height="250px">
                        @endif
                        <input type="file" class="form-control-file" id="company_img2" name="company_img2"><br>
                        @if($data->company_img2!='')
                        <img src="{{asset('images/profile/'.$data->company_img2)}}" width="300px" height="250px">
                        @endif
                        <input type="file" class="form-control-file" id="company_img3" name="company_img3">
                        @if($data->company_img3!='')
                        <img src="{{asset('images/profile/'.$data->company_img3)}}" width="300px" height="250px">
                        @endif
                    </div>
                    <div class="form-group" >
                        <button type="submit" class="btn btn-outline-success w-100" onclick="return confirm('ยืนยันการทำรายการ?')">บันทึก</button>
                     </div>
                </form>
            </div>
        </div>
</div>
