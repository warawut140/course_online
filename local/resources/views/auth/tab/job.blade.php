<div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
    <br>
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
                        <div class="row">
                            <div class="col-md-6">
                                <select name="" class="form-control select2">
                                    <option value="">กรุณาเลือกคอร์สเรียน</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">Certificate</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                    <label class="form-check-label" for="inlineCheckbox2">No Certificate</label>
                                  </div>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-sm btn-outline-primary">+ เพิ่มคอร์สเรียน</button>

                        <div class="form-group">
                            <br>
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
                                <button type="submit" class="btn btn-outline-success w-100">สร้างตำแหน่งงานที่ต้องการ</button>
                             </div>

                             <div class="form-group" >
                                <button type="submit" class="btn btn-outline-danger w-100">ยกเลิก</button>
                             </div>


                    {{-- <div class="form-group" >
                        <button type="submit" style="background-color: #8B0900; color:white;" class="btn  w-100">Submit</button>
                     </div> --}}
                </form>
            </div>
        </div>
</div>
