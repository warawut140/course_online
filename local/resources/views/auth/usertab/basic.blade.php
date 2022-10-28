<div class="col-xl-8 offset-xl-1 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
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
            <form method="POST" action="{{ url('register_student_detail_basic_store') }}" id="searchForm"
                enctype="multipart/form-data">
                @csrf

   <div class="form-group">
       <div class="form-row">
          <div class="form-group col-md-6">
            @if(@$data)
            <img src="{{ asset('images/profile/'.@$data->image_profile) }}" class="circleco mb-2 mw-100" width="200" height="200"><br>
            @else
            <img src="{{ asset('images/upload.png') }}" class="circleco mb-2 mw-100" width="200" height="200"><br>
            @endif

            <input type="hidden" name="type" value="basic">

                    </div>
                    <div class="form-group col-md-6">
                        <label for="image_profile">รูปภาพโปรไฟล์</label>
                        <input type="file" class="form-control-file" id="image_profile"  name="image_profile">
                    </div>

                     </div>
                   <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstname">ชื่อ</label>
                        <input name="firstname" type="text" required value="{{@$data->firstname}}" class="form-control"
                            id="firstname">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastname">นามสกุล</label>
                        <input name="lastname" type="text" required value="{{@$data->lastname}}" class="form-control"
                            id="lastname">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="username">username</label>
                        <input name="username" type="text" required value="{{@$data->username}}" class="form-control"
                            id="username">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password">รหัสผ่าน</label>
                        <input name="password" type="text"  placeholder="ระบุหากต้องการแก้ไข" class="form-control"
                            id="password">
                    </div>
                    {{-- <div class="form-group col-md-6">
                        <label for="con_password">ยืนยันรหัสผ่าน</label>
                        <input name="con_password" type="text"  class="form-control"
                            id="con_password">
                    </div> --}}

                    <div class="form-group col-md-6">
                        <label for="tel">เบอร์โทรศัพท์</label>
                        <input name="tel" type="text" required value="{{@$data->tel}}" class="form-control"
                            id="tel">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="title_me">แนะนำตัว</label>
                        <input name="title_me" type="text" required value="{{@$data->title_me}}" class="form-control"
                            id="title_me">
                    </div>
                </div>

                {{-- <div class="form-group">
                    <label for="exampleInputEmail1">ตำแหน่งที่ตั้ง</label>
                    <textarea type="text" class="form-control" rows="3" name="ssxx"></textarea>
                    </div> --}}

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">E-mail</label>
                            <input name="email" type="text" required value="{{@$data->email}}" class="form-control"
                                id="email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date_of_birth">วัน/เดือน/ปีเกิด </label>
                            <input name="date_of_birth" type="date" required value="{{@$data->date_of_birth}}" class="form-control">
                        </div>
                    </div>
 <div class="form-group">
                    <label for="exampleInputEmail1">ที่อยู่</label>
                    <textarea type="text" class="form-control" name="company_address">{{@$data->company_address}}</textarea>
                    </div>

                    <div class="form-group" >
                        <button type="submit" class="btn btn-outline-success w-100" onclick="return confirm('ยืนยันการทำรายการ?')">บันทึก</button>
                     </div>
                    </div>
                </form>
            </div>
        </div>
</div>
