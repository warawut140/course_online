{{-- <div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
    <br> --}}
<br>
<h4 style="color:#8B0900;">CERTIFICATE</h4>
<div class="card">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center"></th>
                        <th class="text-center">หลักสูตร</th>
                        <th class="text-center">แบบทดสอบ/Workshop</th>
                        <th class="text-center">ชื่อข้อสอบ</th>
                        <th class="text-center">ใบรับรอง</th>

                    </tr>

                </thead>
                <tbody>
                    <?php
                    $qtd_arr = \App\Models\ProfileQuestionDetail::select('questions_detail_id')
                        ->where('user_id', Auth::user()->id)
                        ->where('status', 1)
                        ->pluck('questions_detail_id')
                        ->toArray();

                    $questions_details = \App\Models\QuestionsDetail::
                        select('courses.id as c_id','courses.name as c_name','questions_details.name as q_name','course_lists.course_name as cl_name','course_lists.id as cl_id','questions_details.id as qd_id')
                        ->join('course_lists','course_lists.id','questions_details.course_list_id')
                        ->join('courses','courses.id','course_lists.course_id')
                        ->whereIn('questions_details.id', $qtd_arr)
                        ->where('questions_details.unlock_certificate', 1)
                        ->get();
                    ?>
                    @foreach (@$questions_details as $key => $q)
                        <tr>
                            <td class="text-center"> {{ $key + 1 }}</td>
                            <td class="text-left">{{ $q->c_name }}</td>
                            <td class="text-left">{{ $q->cl_name }}</td>
                            <td class="text-left">{{ $q->q_name }}</td>
                            <td class="text-center"><a class="btn btn-sm btn-success"
                                   target="blank" href="{{ url('certificate_print/' . $q->c_id.'/'.Auth::user()->id.'/'.$q->cl_id.'/'.$q->qd_id) }}">ดาวโหลด</a></td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
{{-- </div> --}}
