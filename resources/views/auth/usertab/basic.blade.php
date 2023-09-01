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

            <div class="border shadow rounded p-6 p-md-9">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        @if (@$data)
                            <div class="row row-cols-lg-2 mb-8">
                                <img src="{{ asset('images/profile/' . @$data->image_profile) }}"
                                    class="circleco mb-2 mw-100"><br>
                            </div>
                        @else
                            <div class="row row-cols-lg-2 mb-8">
                                <img src="{{ asset('images/upload.png') }}" class="circleco mb-2 mw-100"><br>
                            </div>
                        @endif

                        <input type="hidden" name="type" value="basic">

                    </div>
                    <div class="form-group col-md-12">
                        <label for="image_profile">รูปภาพโปรไฟล์</label>
                        <input type="file" class="form-control placeholder-1" id="image_profile"
                            name="image_profile">
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="firstname">ชื่อ</label>
                        <input name="firstname" type="text" required value="{{ @$data->firstname }}"
                            class="form-control placeholder-1" id="firstname">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="lastname">นามสกุล</label>
                        <input name="lastname" type="text" required value="{{ @$data->lastname }}"
                            class="form-control placeholder-1" id="lastname">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="username">username</label>
                        <input name="username" type="text" required value="{{ @$data->username }}"
                            class="form-control placeholder-1" id="username">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="password">รหัสผ่าน</label>
                        <input name="password" type="text" placeholder="ระบุหากต้องการแก้ไข"
                            class="form-control placeholder-1" id="password">
                    </div>
                    {{-- <div class="form-group col-md-12">
                        <label for="con_password">ยืนยันรหัสผ่าน</label>
                        <input name="con_password" type="text"  class="form-control placeholder-1"
                            id="con_password">
                    </div> --}}

                    <div class="form-group col-md-12">
                        <label for="tel">เบอร์โทรศัพท์</label>
                        <input name="tel" type="text" required value="{{ @$data->tel }}"
                            class="form-control placeholder-1" id="tel">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="title_me">แนะนำตัว</label>
                        <input name="title_me" type="text" required value="{{ @$data->title_me }}"
                            class="form-control placeholder-1" id="title_me">
                    </div>
                </div>

                {{-- <div class="form-group">
                    <label for="exampleInputEmail1">ตำแหน่งที่ตั้ง</label>
                    <textarea type="text" class="form-control placeholder-1" rows="3" name="ssxx"></textarea>
                    </div> --}}

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="email">E-mail</label>
                        <input name="email" type="text" required value="{{ @$data->email }}"
                            class="form-control placeholder-1" id="email">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="date_of_birth">วัน/เดือน/ปีเกิด </label>
                        <input name="date_of_birth" type="date" required value="{{ @$data->date_of_birth }}"
                            class="form-control placeholder-1">
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">ที่อยู่</label>
                    <textarea type="text" class="form-control placeholder-1" name="company_address">{{ @$data->company_address }}</textarea>
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-primary w-100"
                        onclick="return confirm('ยืนยันการทำรายการ?')">บันทึก</button>
                </div>
            </div>
        </form>
    </div>
</div>
