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

                <div class="form-group">
                    <label for="exampleInputEmail1">ชื่อบริษัท</label>
                    <input type="text" class="form-control"  id="exampleInputEmail1"
                        name="tel">
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
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">ผลิตภัณฑ์/บริการ</label>
                        <input name="firstname" type="text"  class="form-control"
                            id="inputEmail4">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">จำนวนพนักงานทั้งหมด</label>
                        <input name="lastname" type="text"  class="form-control"
                            id="inputPassword4">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">เลขที่จดแจ้ง</label>
                        <input name="firstname" type="text"  class="form-control"
                            id="inputEmail4">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">เบอร์โทรติดต่อสำนักงาน</label>
                        <input name="lastname" type="text"  class="form-control"
                            id="inputPassword4">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">วันทำงาน</label>
                        <input name="firstname" type="text"  class="form-control"
                            id="inputEmail4">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">วันหยุด</label>
                        <input name="lastname" type="text" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">สถานที่ตั้ง</label>
                    <textarea type="text" class="form-control" name="ssxx"></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">ธนาคาร</label>
                            <input name="firstname" type="text"  class="form-control"
                                id="inputEmail4">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">เลขบัญชี <span style="color:rgb(47, 137, 255); font-size:10px;">ส่วนนี้สำหรับการโอนรายได้ค่าคอร์สเรียน</span></label>
                            <input name="lastname" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlFile1">รูปภาพเกี่ยวกับบริษัทเพิ่มเติม</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="imageProfile">
                    </div>
                    <div class="form-group" >
                        <button type="submit" class="btn btn-outline-success w-100">บันทึก</button>
                     </div>
                </form>
            </div>
        </div>
</div>
