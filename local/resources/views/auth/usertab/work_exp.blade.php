    <style>
        .gray {
            color: #fff;
            background-color: #8B0900;
        }
    </style>

    <br>
    <h4 style="color:#8B0900;">WORK EXPERIENCE</h4>
    <br>

    {{-- <div class="card gray" style="background-color: #D3D3D3;">
        <div class="card-body" >
            <div class="form-row">
                      <div class="form-group col-md-11">
             <h5><b>
               JS Engineering And Mechanical Co.Ltd
            </b></h5>
            <p>UX/UI & Graphic Designer | April 2022 - September 2022 | Thailand</p>
            </div>
            <div class="form-group col-md-1">
   <button><i class="fa fa-pen"></i></button>
</div>
                </div>
      </div>  </div>  <br> --}}
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

                    <input type="hidden" name="type" value="work_exp">

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">บริษัท / องค์กร</label>
                            <input name="name" type="text" value="{{ @$work_exp->name }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="web">เว็บไซต์</label>
                            <input name="web" type="text" value="{{ @$work_exp->web }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">ตำแหน่งที่ตั้ง</label>
                        <textarea type="text" class="form-control" rows="3" name="address">{{ @$work_exp->address }}</textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="position">ตำแหน่งงาน</label>
                            <input name="position" type="text" value="{{ @$work_exp->position }}"
                                class="form-control">
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="start_date">วันที่เริ่ม</label>
                            <input name="start_date" type="date" value="{{ @$work_exp->start_date }}"
                                class="form-control" id="inputEmail4">
                        </div>
                        <div class="form-group">
                            <label for="end_date">วันสิ้นสุด</label>
                            <input name="end_date" type="date" value="{{ @$work_exp->end_date }}"
                                class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="detail">รายละเอียดงาน</label>
                        <textarea type="text" class="form-control" rows="3" name="detail">{{ @$work_exp->detail }}</textarea>
                    </div>
                    <br>
                    {{-- <div class="form-group" >
                                              <div class="form-row">
                                                  <div class="form-group col-md-3">
                                                       </div>
                                <div class="form-group">
                                <button type="submit" class="btn btn-outline-success w-100">Add Work Experience</button>
                                 </div>
                                <div class="form-group col-md-3">
                                <button type="cancel" class="btn btn-outline-danger w-100">Cancle</button>
                             </div>
                                </div>
                             </div> --}}
                    {{-- <div class="form-group" >
                        <button type="submit" style="background-color: #8B0900; color:white;" class="btn  w-100">Submit</button>
                     </div> --}}

                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary w-100"
                            onclick="return confirm('ยืนยันการทำรายการ?')">บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
