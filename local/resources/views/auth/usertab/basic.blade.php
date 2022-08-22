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
            <form method="POST" action="{{ url('register_company_detail_basic_store') }}" id="searchForm"
                enctype="multipart/form-data">
                @csrf
   <div class="form-group">
       <div class="form-row">
          <div class="form-group col-md-6">
                       <img src="{{ asset('images/upload.png') }}" class="circleco mb-2 mw-100" width="200" height="200"><br>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleFormControlFile1">รูปภาพโปรไฟล์</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="imageProfile">
                    </div>

                     </div>
                   <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">ชื่อ</label>
                        <input name="firstname" type="text"  class="form-control"
                            id="inputEmail4">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">นามสกุล</label>
                        <input name="lastname" type="text"  class="form-control"
                            id="inputPassword4">
                    </div>
                </div>
                <div class="form-row">
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
                </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">เบอร์โทรศัพท์</label>
                            <input name="firstname" type="text"  class="form-control"
                                id="inputEmail4">
                        </div>
                       
                    </div>

              

            

                <div class="form-group">
                    <label for="exampleInputEmail1">ตำแหน่งที่ตั้ง</label>
                    <textarea type="text" class="form-control" rows="3" name="ssxx"></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">E-mail</label>
                            <input name="firstname" type="text"  class="form-control"
                                id="inputEmail4">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">วัน/เดือน/ปีเกิด </label>
                            <input name="birthday" type="date" class="form-control">
                        </div>
                    </div>
 <div class="form-group">
                    <label for="exampleInputEmail1">ตำแหน่งปัจจุบัน</label>
                    <textarea type="text" class="form-control" name="ssxx"></textarea>
                    </div>
                 
                    <div class="form-group" >
                        <button type="submit" class="btn btn-outline-success w-100">บันทึก</button>
                     </div>
                </form>
            </div>
        </div>
</div>
