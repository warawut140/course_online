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
                                <th class="op3center">ชื่อผู้เรียน</th>
                                <th class="op3center">แบบทดสอบ/Workshop</th>
                                <th class="op3center">ชื่อข้อสอบ</th>
                                <th class="op3center"></th>
                                <th class="op3center">สถานะ</th>
                            </tr>

                            <?php
                                 $courses_arr = \App\Models\Course::where('profile_id',Auth::guard('web')->user()->profile->id)
                                //  ->where('status',1)
                                 ->orderBy('created_at','desc')
                                 ->pluck('id')->toArray();
                                 if(@$courses_arr){
                                    $course_list_arr = \DB::table('course_lists')->whereIn('course_id',@$courses_arr)->pluck('id')->toArray();
                                    if(@$course_list_arr){
                                        $questions_details_arr = \DB::table('questions_details')->whereIn('course_list_id',@$course_list_arr)->pluck('id')->toArray();
                                        if(@$questions_details_arr){
                                            $qtd = \App\Models\ProfileQuestionDetail::whereIn('questions_detail_id',$questions_details_arr)->get();
                                        }
                                    }
                                 }
                            ?>
                        @if(isset($qtd))

                        @foreach(@$qtd as $key => $q)
                        <tr>
                            <td class="opcenter"> {{ $key + 1 }}</td>
                            <td class="text-left">{{$q->User->profile->firstname}} {{$q->User->profile->lastname}}</td>
                            <td class="opcenter">Workshop</td>
                            <td class="text-left">{{$q->QuestionsDetail->name}}</td>
                            <td class="opcenter"><a class="btn btn-sm btn-primary" href="{{url('workshop_inside_check/'.$q->id)}}">ตรวจ</a></td>
                            <td class="opcenter">{{$q->get_status()}}</td>

                        </tr>
                    @endforeach

                        @endif


                        </table>
                    </div>
            </div>


            </div>
        </div>
{{-- </div> --}}
