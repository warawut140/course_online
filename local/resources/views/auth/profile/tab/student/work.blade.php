{{-- <div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
    <br> --}}
    <br>
    <h4 style="color:#8B0900;">WORK</h4>
    <div class="card">
        <div class="card-body">
            <div class="form-group col-md-12">
            <button class="btn btn-rounded btn-danger">ประวัติการสมัคร</button>
            </div>
            <hr>
            <div class="form-group col-md-12">
                @foreach ($jobs as $j)
                <div class="col-12">
                    <div class="row">
                        <div class="col-2">
                            <img src="{{ asset('images/profile/' . $j->Profile->image_profile) }}"
                                class="mw-100 mb-3" width="150px" height="150px">
                        </div>
                        <div class="col-8">
                            <h5 class="mb-3 text-left">
                                <font style="color:black">
                                    <a href="{{ url('worklist_detail/' . $j->id) }}"
                                        style="color:grey;" class="">
                                    {{ $j->position }}
                                    </a>
                                </font>
                            </h5>
                            <p class="mb-3 text-left">
                                <font style="color:gray">{{ $j->location }}</font>
                            </p>
                            <p class="mb-3 text-left">
                                <font style="color:gray"> มาเป็นหนึ่งในผู้สมัคร 25 คนแรก</font>
                            </p>
                            <p class="mb-3 text-left">
                                <font style="color:gray"><i class="fa fa-clock" aria-hidden="true"
                                        style="color:green;"></i> {{ $j->created_at }} </font>
                            </p>
                            {{-- <p class="mb-3 text-left"> <i class='fas fa-user-circle fa-lg'></i>
                                <font style="color:black">โปรไฟล์ของคุณเข้ากับงานนี้</font>
                            </p> --}}

                            {{-- <a href="{{ url('worklist_detail/' . $j->id) }}"
                                style="background-color:#374291; color:white;" class="btn "> ดูข้อมูล
                            </a> --}}
                        </div>
                    </div>
                </div>{{-- end #work --}}
            @endforeach
            </div>
            </div>
        </div>
{{-- </div> --}}
