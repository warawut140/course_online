<div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
    <br>
    <h4 style="color:#8B0900;">How would you like to
        receive your applicants?</h4>
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

                <input type="hidden" name="type" value="receive">

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="applicants">ส่งใบสมัครได้ทาง</label>
                        <select class="form-control" name="applicants">
                            <option <?php if(@$data->applicants==1){echo 'selected';} ?> value="1">Email</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="applicants_email">Email <span style="color:red;">*</span></label>
                        <input name="applicants_email" type="text" value="{{@$data->applicants_email}}" class="form-control"
                            id="applicants_email">
                    </div>
                </div>
                            <div class="form-group" >
                                <button type="submit" class="btn btn-outline-success w-100" onclick="return confirm('ยืนยันการทำรายการ?')">บันทึก</button>
                             </div>

                    {{-- <div class="form-group" >
                        <button type="submit" style="background-color: #8B0900; color:white;" class="btn  w-100">Submit</button>
                     </div> --}}
                </form>
            </div>
        </div>
</div>
