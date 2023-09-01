{{-- <div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
    <br> --}}
<br>
<h4 style="color:#8B0900;">APPLICANT</h4>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center"></th>
                        <th class="text-center">ชื่อผู้สมัคร</th>
                        <th class="text-center">ตำแหน่งที่สมัคร</th>
                        <th class="text-center">วันที่สมัคร</th>
                        <th class="text-center">เบอร์โทรติดต่อ</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">CV/RESUME</th>

                    </tr>

                </thead>
                <tbody>
                    <?php
                    $job_dis = \App\Models\JobDescription::where('profile_id', $profile->id)
                        ->pluck('id')
                        ->toArray();
                    $job_re = \App\Models\JobRegister::whereIn('job_description_id', $job_dis)
                        ->orderBy('updated_at', 'desc')
                        ->get();
                    ?>

                    @foreach ($job_re as $key => $job)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-left">{{ $job->Profile->firstname }}
                                {{ $job->Profile->lastname }}</td>
                            <td class="text-left">{{ $job->JobDescription->position }}</td>
                            <td class="text-center">{{ $job->created_at }}</td>
                            <td class="text-left">{{ $job->tel }}</td>
                            <td class="text-left">{{ $job->email }}</td>
                            <td class="text-center">
                                {{-- <img src="{{ asset('images/profile/' . $job->resume) }}" class="mw-100 mb-3"
                                                    width="50px" height="50px"> --}}
                                <a href="{{ url('getDownload/resume/' . $job->resume) }}">โหลดไฟล์</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
{{-- </div> --}}
