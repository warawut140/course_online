<div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
    <br>
    <h4 style="color:#8B0900;">ON THE WEB</h4>
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

                <input type="hidden" name="type" value="web">

                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text2" id="basic-addon1"> <img class="left"
                                    src="{{ asset('images/icon/fb.png') }}" height="35"
                                   style="margin-right: 10px; margin-top: 10px;"></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Link 1" name="link_1" value="{{$data->link_1}}"
                            aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text2" id="basic-addon1"> <img class="left"
                                    src="{{ asset('images/icon/gg.png') }}" height="35"
                                   style="margin-right: 10px; margin-top: 10px;"></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Link 2" name="link_2" value="{{$data->link_2}}"
                            aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text2" id="basic-addon1"> <img class="left"
                                    src="{{ asset('images/icon/in.png') }}" height="35"
                                    style="margin-right: 10px; margin-top: 10px;"></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Link 3" name="link_3" value="{{$data->link_3}}"
                            aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text2" id="basic-addon1"> <img class="left"
                                    src="{{ asset('images/icon/tw.png') }}" height="35"
                                   style="margin-right: 10px; margin-top: 10px;"></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Link 4" name="link_4" value="{{$data->link_4}}"
                            aria-describedby="basic-addon1">
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-outline-primary w-100" onclick="return confirm('ยืนยันการทำรายการ?')">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>
