{{-- <div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
    <br> --}}
    <br>
    <h4 style="color:#8B0900;">ตำแหน่งงาน</h4>
    <div class="card">
        <div class="card-body">

           {{-- end #content 1 --}}
    <div class="container text-center py-4">
        <div class="row">

            <div class="col-5">{{-- start #แบ่งครึ่ง1 --}}
                <br> <br>



                <div class="row">

                    @foreach ($jobs as $j)
                        <div class="col-12">
                            <div class="row">
                                <div class="col-4">
                                    <img src="{{ asset('images/profile/' . $j->Profile->image_profile) }}"
                                        class="mw-100 mb-3" width="150px" height="150px">
                                </div>
                                <div class="col-8">
                                    <h5 class="mb-3 text-left">
                                        <font style="color:black">{{ $j->position }}</font>
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
                                    <p class="mb-3 text-left"> <i class='fas fa-user-circle fa-lg'></i>
                                        <font style="color:black">โปรไฟล์ของคุณเข้ากับงานนี้</font>
                                    </p>

                                    <a href="{{ url('worklist_detail/' . $j->id) }}"
                                        style="background-color:#374291; color:white;" class="btn "> ดูข้อมูล
                                    </a>
                                </div>
                            </div>
                        </div>{{-- end #work --}}
                    @endforeach

                </div>


            </div>{{-- end #แบ่งครึ่ง1 --}}

            <div class="col-7" style= " width: 100%; border: 1px solid #ccc!important;    border-radius: 16px; border-radius: 16px;">{{-- start #แบ่งครึ่ง2 --}}
                <br> <br>
                <h5 class="mb-3 text-left"> <i class='fas fa-user-circle fa-lg' style="color:black"></i>
                    <font style="color:black">โปรไฟล์ของคุณเข้ากับงานนี้</font>
                </h5>
                <br>
                <div class="row">
                    <div class="col-6">
                        <img src="{{ asset('images/profile/' . $job->Profile->company_img1) }}" width="300px"
                            height="250px" class="mw-100 mb-3">
                        {{-- <img src="{{ asset('images/imgup.png') }}" class="mw-100 mb-3"> --}}
                    </div>
                    <div class="col-6">
                        {{-- <img src="{{ asset('images/imgup.png') }}" class="mw-100 mb-3"> --}}
                        <img src="{{ asset('images/profile/' . $job->Profile->company_img2) }}" width="300px"
                            height="250px" class="mw-100 mb-3">
                    </div>
                </div>
                <br> <br>
                <div class="row">
                    <div class="col-12">{{-- start #work --}}
                        <div class="row">
                            <div class="col-4">
                                {{-- <img src="{{ asset('images/logoup.png') }}" class="mw-100 mb-3"> --}}
                                <img src="{{ asset('images/profile/' . $j->Profile->image_profile) }}" class="mw-100 mb-3"
                                    width="150px" height="150px">
                            </div>
                            <div class="col-8">
                                <h5 class="mb-3 text-left">
                                    <font style="color:black">{{ $job->position }}</font>
                                </h5>
                                <p class="mb-3 text-left">
                                    <font style="color:gray">{{ $job->location }}</font>
                                </p>
                                <p class="mb-3 text-left">
                                    <font style="color:gray"> มาเป็นหนึ่งในผู้สมัคร 25 คนแรก</font>
                                </p>
                                <p class="mb-3 text-left">
                                    <font style="color:gray"><i class="fa fa-clock" aria-hidden="true"
                                            style="color:green;"></i> {{ $j->created_at }} </font>
                                </p>

                                {{-- <P class="mb-3 text-left" style="color:red;">{{$text}}</P>
                                <p class="mb-3 text-left"> <a href="{{url('worklist_detail_register/'.$j->id)}}"
                                        style="background-color:#374291; color:white;" class="btn">สมัครงาน &nbsp;<i
                                            class="fa fa-briefcase"></i></a></p> --}}
                                <br>
                            </div>
                        </div>
                    </div>{{-- end #work --}}
                    <div class="col-12">{{-- start #work --}}
                        <div class="row">
                            <br> <br>
                            <div class="col-12">
                                <h5 class="mb-3 text-left">
                                    <font style="color:black">ข้อมูลบริษัท</font>
                                </h5>
                                <p class="mb-3 text-left">
                                    <font style="color:gray">{{ $job->Profile->detail_about_me }}</font>
                                </p>
                                <p class="mb-3 text-left">
                                    <font style="color:gray">
                                        {{ $job->Profile->company_address }}

                                    </font>
                                </p>
                                <br> <br>
                                <p class="mb-3 text-left">
                                    <font style="color:black">ลักษณะการทำงาน - บริหารงาน ประชุม อมรม</font>
                                </p>

                                <p class="mb-3 text-left">
                                    <font style="color:gray"><i class="fa fa-circle" aria-hidden="true"></i>
                                        ขยายการตลาด ประสานงานขาย</font>
                                </p>
                                <p class="mb-3 text-left">
                                    <font style="color:gray"><i class="fa fa-circle" aria-hidden="true"></i>ฝึกอบรม
                                        พัฒนาตนเองและบุคคลากร
                                    </font>
                                </p>
                                <p class="mb-3 text-left">
                                    <font style="color:gray"><i class="fa fa-circle" aria-hidden="true"></i>
                                        ออกตลาด พบปะกลุ่มลูกค้า</font>
                                </p>

                            </div>
                            <div class="col-6">
                                <br> <br>
                                <p class="mb-3 text-left">
                                    <font style="color:black">ระดับประสบการณ์</font>
                                </p>

                                <p class="mb-3 text-left">
                                    <font style="color:#374291;"><i class="fa fa-briefcase" aria-hidden="true"></i>
                                        {{ $j->level }}</font>
                                </p>

                            </div>
                            <div class="col-6">
                                <br> <br>
                                <p class="mb-3 text-left">
                                    <font style="color:black">ประเภทการจ้างงาน</font>
                                </p>

                                <p class="mb-3 text-left">
                                    <font style="color:#374291;"><i class="fa fa-calendar-check" aria-hidden="true"></i>
                                        {{ $j->get_employment_type() }}</font>
                                </p>

                            </div>
                            <div class="col-12">
                                <br> <br>
                                <p class="mb-3 text-left">
                                    <font style="color:black">เงินเดือน</font>
                                </p>

                                <p class="mb-3 text-left">
                                    <font style="color:#374291;"><i class="fa fa-credit-card" aria-hidden="true"></i>
                                        {{ $j->salary }} รายเดือน</font>
                                </p>

                                {{-- <div class="col-12">
                                    <br> <br>
                                    <p class="mb-3 text-left">
                                        <font style="color:black">Skill ที่ต้องการ</font>
                                    </p>

                                    <p class="mb-3 text-left">
                                        <font style="color:#374291;"><i class="fa fa-circle" aria-hidden="true"></i>
                                            ขยายการตลาด ประสานงานขาย</font>
                                    </p>
                                    <p class="mb-3 text-left">
                                        <font style="color:#374291;"><i class="fa fa-circle" aria-hidden="true"></i>
                                            ฝึกอบรม พัฒนาตนเองและบุคคลากร
                                        </font>
                                    </p>
                                    <p class="mb-3 text-left">
                                        <font style="color:#374291;"><i class="fa fa-circle" aria-hidden="true"></i>
                                            ทักษะการพูดชั้นเชิง</font>
                                    </p>
                                </div> --}}
                                <div class="col-12">
                                    <br> <br>
                                    <p class="mb-3 text-left">
                                        <font style="color:black">คอร์สเรียนที่ควรผ่านการเรียนรู้มาก่อน</font>
                                    </p>

                                    <?php
                                    if($j->course_id_for_job!=''){
                                        $arr_course_id_for_job = explode(',',$j->course_id_for_job);
                                    }else{
                                        $arr_course_id_for_job = [];
                                    }

                                    ?>
                                    @foreach($arr_course_id_for_job as $arr)
                                    <?php
                                        $c_data = \DB::table('courses')->where('id',$arr)->first();
                                    ?>

                                    <p class="mb-3 text-left">
                                        <font style="color:#374291;"><i class="fa fa-check" aria-hidden="true"></i>
                                            <a href="{{url('course_online_view/'.@$c_data->id)}}">{{@$c_data->name}}</a></font>&nbsp; &nbsp;&nbsp; &nbsp;
                                        {{-- <font style="color:blue;">Certificate</font> --}}
                                    </p>
                                    @endforeach
                                    {{-- <p class="mb-3 text-left">
                                        <font style="color:gray;"><i class="fa fa-times" aria-hidden="true"></i> ฝึกอบรม
                                            พัฒนาตนเองและบุคคลากร
                                        </font>&nbsp; &nbsp;&nbsp; &nbsp;<font style="color:gray;">Not Certificate</font>
                                    </p>
                                    </p>
                                    <p class="mb-3 text-left">
                                        <font style="color:#374291;"><i class="fa fa-check" aria-hidden="true"></i>
                                            ผ่านการเรียนคอร์ส พัฒนาตัวเอง</font>&nbsp; &nbsp;&nbsp; &nbsp;<font
                                            style="color:blue;">Certificate</font>
                                    </p>
                                    </p> --}}
                                </div>
                            </div>
                        </div>{{-- end #work --}}


                    </div>


                </div>{{-- end #แบ่งครึ่ง2 --}}


            </div>


            </div>

        </div>
        </div>

        {{-- begin #work 1 --}}

            </div>
        </div>
{{-- </div> --}}
