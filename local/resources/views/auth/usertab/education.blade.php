<div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
    <br>
    <h4 style="color:#8B0900;">Education</h4>
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

                <input type="hidden" name="type" value="education">

                  <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="academy">สถานศึกษา</label>
                        <input name="academy" type="text" value="{{@$education->academy}}" class="form-control" >
                    </div>

                </div>
                <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="level">ระดับการศึกษา</label>
                        <input name="level" type="text"  value="{{@$education->level}}" class="form-control" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="major">สาขา</label>
                        <input name="major" type="text"  value="{{@$education->major}}" class="form-control" >
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="date_start">วันที่เริ่ม</label>
                        <input name="date_start" type="date"  value="{{@$education->date_start}}" class="form-control"
                            id="date_start">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date_end">วันสิ้นสุด</label>
                        <input name="date_end" type="date" value="{{@$education->date_end}}" class="form-control">
                    </div>
                </div>
              <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="grade">เกรดเฉลี่ย</label>
                        <input name="grade" type="text"  value="{{@$education->grade}}" class="form-control">
                    </div>
                    <div class="form-group col-md-6">

                    </div>
                </div><br>

                <div class="form-group" >
                    <button type="submit" class="btn btn-outline-success w-100" onclick="return confirm('ยืนยันการทำรายการ?')">บันทึก</button>
                 </div>

                            {{-- <div class="form-group" >
                                              <div class="form-row">
                                                  <div class="form-group col-md-3">
                                                       </div>
                                <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-outline-success w-100">Add Work Experience</button>
                                 </div>
                                <div class="form-group col-md-3">
                                <button type="cancel" class="btn btn-outline-danger w-100">Cancle</button>
                             </div>
                                </div>
                             </div>   --}}
                    {{-- <div class="form-group" >
                        <button type="submit" style="background-color: #8B0900; color:white;" class="btn  w-100">Submit</button>
                     </div> --}}
                </form>
            </div>
        </div>
        <br>



 {{-- <div class="form-group" >
    <div class="form-row">
        <div class="form-group col-md-1">

                             </div>

                               <div class="form-group col-md-4">
                                <button type="submit" class="btn btn-outline-primary w-100">+ Add Education</button>
                             </div>
  </div>  </div> --}}
</div>
