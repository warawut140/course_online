{{-- <div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
    <br> --}}
<br>
<h4 style="color:#8B0900;">APPLICANT</h4>
<div class="card">
    <div class="card-body">

        <div class="row">
            <div class="col-md-12">
                <table>
                    <tr>
                        <th class="op3center"> </th>
                        <th class="op3center">ชื่อผู้สมัคร</th>
                        <th class="op3center">ตำแหน่งที่สมัคร</th>
                        <th class="op3center">วันที่สมัคร</th>
                        <th class="op3center">เบอร์โทรติดต่อ</th>
                        <th class="op3center">Email</th>
                        <th class="op3center">CV/RESUME</th>
                        {{-- <th class="op3center">คำถาม/แบบทดสอบ</th> --}}

                    </tr>

                    <?php
                    $job_dis = \App\Models\JobDescription::where('profile_id', $profile->id)
                        ->pluck('id')
                        ->toArray();
                    $job_re = \App\Models\JobRegister::whereIn('job_description_id', $job_dis)
                        ->orderBy('updated_at', 'desc')
                        ->get();
                    ?>

                    @foreach($job_re as $key => $job)
                        <tr>
                            <td class="opcenter">{{ $key + 1 }}</td>
                            <td class="opcenter">{{$job->Profile->firstname}} {{$job->Profile->lastname}}</td>
                            <td class="opcenter">{{$job->JobDescription->position}}</td>
                            <td class="opcenter">{{$job->created_at}}</td>
                            <td class="opcenter">{{$job->tel}}</td>
                            <td class="opcenter">{{$job->email}}</td>
                            <td class="opcenter">
                                <img src="{{ asset('images/profile/' . $job->resume) }}" class="mw-100 mb-3"
                                width="50px" height="50px">
                            </td>
                            {{-- <td class="opcenter"><i class="fa fa-file-text" aria-hidden="true"> &nbsp&nbsp<i
                                        class="fa fa-file-text" aria-hidden="true"></i></i></td> --}}

                        </tr>
                    @endforeach

                </table>
            </div>
        </div>


    </div>
</div>
{{-- </div> --}}
