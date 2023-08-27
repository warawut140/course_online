 <br>
    <h4 style="color:#8B0900;">ABOUT ME</h4>
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
                <input type="hidden" name="type" value="job">

                <div class="form-group">
                    <label for="title_about_me">หัวข้อ</label>
                    <input type="text" class="form-control placeholder-1" value="{{ @$data->title_about_me }}"
                        id="title_about_me" name="title_about_me">
                </div>


                <div class="form-group">
                    <label for="detail_about_me">คำบรรยาย</label>
                    <textarea type="text" class="form-control placeholder-1" name="detail_about_me">{{ @$data->detail_about_me }}</textarea>
                </div>

                <div class="form-group col-md-6">
                    <label for="rasume1">Rasume 1 (รูปภาพ JPG หรือ PNG)</label>
                    <input type="file" class="form-control placeholder-1" id="rasume1" name="rasume1">
                </div>
                <br>
                @if ($data->rasume1 != '')
                    <div class="row row-cols-lg-2 mb-8">
                        <img src="{{ asset('images/profile/' . @$data->rasume1) }}">
                    </div>
                @endif

                {{-- <div class="form-group col-md-6">
                        <label for="rasume2">Rasume 2 (รูปภาพ JPG หรือ PNG)</label>
                        <input type="file" class="form-control placeholder-1" id="rasume2"  name="rasume2">
                    </div> --}}

                {{-- <div class="form-group col-md-12">
                        <img src="{{ asset('images/profile/'.$data->rasume2) }}" class="" width="400" height="500">
                    </div> --}}


                <div class="form-group col-md-6">
                    <label for="portfolio1">Portfolio 1 (รูปภาพ JPG หรือ PNG)</label>
                    <input type="file" class="form-control placeholder-1" id="portfolio1" name="portfolio1">
                </div>
                <br>

                @if ($data->portfolio1 != '')
                <div class="row row-cols-lg-2 mb-8">
                        <img src="{{ asset('images/profile/' . @$data->portfolio1) }}" class="">
                    </div>
                @endif

                <div class="form-group">
                    <button type="submit" class="btn btn-outline-primary w-100"
                        onclick="return confirm('ยืนยันการทำรายการ?')">บันทึก</button>
                </div>

                </div>


                {{-- <div class="form-group" >
                        <button type="submit" style="background-color: #8B0900; color:white;" class="btn  w-100">Submit</button>
                     </div> --}}
            </form>
        </div>
    </div>
