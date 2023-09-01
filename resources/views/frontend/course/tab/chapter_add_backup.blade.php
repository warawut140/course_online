<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br>
            <h4 style="color:#8B0900;">เนื้อหาหลักสูตร</h4>
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
                    <form method="POST" action="{{ url('register_company_detail_basic_store') }}"
                        id="searchForm" enctype="multipart/form-data">
                        @csrf

                        <h5>บทเรียน</h5>

                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for="exampleInputEmail1">ลำดับบทเรียน</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    name="tel">
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputEmail1">ชื่อบทเรียน</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    name="tel">
                            </div>

                            <div class="col-md-3">
                                <label for="">วิดิโอ</label>
                                <input type="text" class="form-control" id="" name="tel">
                            </div>
                            <div class="col-md-3">
                                <label for="">ชั่วโมงเรียนทั้งหมด (ชั่วโมง)</label>
                                <input type="text" class="form-control" id="" name="tel">
                            </div>

                        </div>

                        <hr>

                        <h5>ข้อมูลหัวเรื่องในบท</h5>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">ชื่อเรื่อง</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    name="tel">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="exampleInputEmail1">เพิ่มรายละเอียดของเรื่อง</label>
                                <textarea type="text" class="form-control" name="ssxx"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">อัพโหลดไฟล์วิดิโอ</label>
                                <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                    name="imageProfile">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-outline-success w-100">บันทึก</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
