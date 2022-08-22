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

                <input type="hidden" name="type" value="job">

                <div class="form-group">
                    <label for="position">ตำแหน่ง</label>
                    <input type="text" class="form-control" required id="position" name="position">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="level">ระดับประสบการณ์</label>
                        <input name="level" type="text" required class="form-control" id="level">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="number_emp">จำนวนที่รับสมัคร</label>
                        <input name="number_emp" type="text" required class="form-control" id="number_emp">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="location">สถานที่ทำงาน</label>
                        {{-- <select class="form-control">
                            <option value="">กรุณาเลือก</option>
                            <option value="">Hybrid</option>
                           </select> --}}
                        <input name="location" type="text" required class="form-control" id="location">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="employment_type">ประเภทการจ้างงาน</label>
                        <select class="form-control" name="employment_type" required>
                            <option value="">กรุณาเลือก</option>
                            <option value="1">เต็มเวลา</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="job_detail">เพิ่มรายละเอียดของงาน</label>
                    <textarea type="text" class="form-control" name="job_detail"></textarea>
                </div>

                <div class="form-group">
                    <label for="skill_detail">Skill ที่ต้องการ</label>
                    <textarea type="text" class="form-control" name="skill_detail"></textarea>
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
                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                    id="inlineRadio1" value="option1">
                                <label class="form-check-label" for="inlineRadio1">Certificate</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                    id="inlineRadio2" value="option2">
                                <label class="form-check-label" for="inlineRadio2">No Certificate</label>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn btn-sm btn-outline-primary">+ เพิ่มคอร์สเรียน</button>

                <div class="form-group">
                    <br>
                    <label for="exampleInputEmail1">เงินเดือน</label>
                    <br>
                    <div class="col-md-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="salary_type" id="salary_type1"
                                value="1">
                            <label class="form-check-label" for="salary_type1">กำหนด</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="salary_type" id="salary_type2"
                                value="2">
                            <label class="form-check-label" for="salary_type2">No รอเจรจา</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input name="salary" type="text" placeholder="จำนวนเงิน" class="form-control"
                        id="salary">
                </div>

                <div class="form-group">
                    <label for="payment_period">งวดการจ่ายเงิน</label>
                    <select class="form-control" required name="payment_period">
                        <option value="">กรุณาเลือก</option>
                        <option value="1">รายเดือน</option>
                        <option value="2">รายวัน</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-outline-success w-100" onclick="return confirm('ยืนยันการทำรายการ?')">บันทึกตำแหน่งงาน</button>
                </div>

                <div class="form-group">
                    <a href="javascript:;" class="btn btn-outline-danger w-100" onclick="return confirm('ยืนยันการลบรายการ?')">ยกเลิก</a>
                </div>


                {{-- <div class="form-group" >
                        <button type="submit" style="background-color: #8B0900; color:white;" class="btn  w-100">Submit</button>
                     </div> --}}
            </form>
        </div>
    </div>
</div>
