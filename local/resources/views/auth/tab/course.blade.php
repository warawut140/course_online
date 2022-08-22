<div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
    <br>
    <h4 style="color:#8B0900;">COURSE</h4>
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

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputEmail4">คอร์สเรียน</label>
                        <div class="input-group mb-3">
                            <input type="text" value="องค์กรและการพัฒนาองค์กรสมัยใหม่" class="form-control form-control-sm" placeholder="Recipient's username" readonly aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <a href="javascript:;"><span class="input-group-text" id="basic-addon2">ตั้งค่าคอร์สเรียน &nbsp;<i class="fa fa-gear"></i></span></a>
                            </div>
                          </div>
                    </div>
                </div>

                            <div class="form-group" >
                                {{-- <button type="submit" class="btn btn-outline-success w-100">บันทึก</button> --}}
                                {{-- <button class="btn btn-outline-primary">+ เพิ่มคอร์สเรียน</button> --}}
                                <a class="btn btn-outline-primary" href="{{url('course_add')}}">+ เพิ่มคอร์สเรียน</a>
                             </div>

                    {{-- <div class="form-group" >
                        <button type="submit" style="background-color: #8B0900; color:white;" class="btn  w-100">Submit</button>
                     </div> --}}
                </form>
            </div>
        </div>
</div>
