<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Profile;
use Auth;
use App\Models\Course;
use File;
use App\Models\CourseChapter;
use App\Models\CourseList;
use App\Models\QuestionsDetail;
use App\Models\Questions;
use App\Models\Options;
use App\Models\Answers;
use App\Models\ProfileQuestionDetail;

class CourseNewController extends Controller
{
    public function course_add()
    {
        $courses = Course::where('status',1)->get();
        return view('frontend.course.course_add',[
            'courses' => $courses,
        ]);
    }

    public function chapter_add($c_id)
    {
        $profile = Profile::where('user_id',Auth::guard('web')->user()->id)->first();
        $course = Course::where('id',$c_id)->where('profile_id',$profile->id)->first();
        if(!$course){
            return redirect()->back()->with('error','ไม่พบข้อมูล');
        }
        return view('frontend.course.chapter_add',[
            'course' => $course,
        ]);
    }

    public function course_view($id)
    {
        $profile = Profile::where('user_id',Auth::guard('web')->user()->id)->first();
        $data = Course::where('id',$id)->where('profile_id',$profile->id)->first();
        $chapter = CourseChapter::where('course_id',$data->id)->get();
        $courses = Course::where('status',1)->where('id','!=',$data->id)->get();
        if($data){
            return view('frontend.course.course_add',[
                'data' => $data,
                'chapter' => $chapter,
                'courses' => $courses,
            ]);
        }else{
            return redirect()->back()->with('error','ไม่พบข้อมูล');
        }
    }


    public function course_store(Request $r)
    {
        DB::beginTransaction();
        try
        {
            $profile = Profile::where('user_id',Auth::guard('web')->user()->id)->first();
            if($profile){
                if($r->course_id!=''){
                    $course = Course::where('id',$r->course_id)->where('profile_id',$profile->id)->first();
                    if(!$course){
                        return redirect()->back()->with('error','ไม่พบข้อมูล');
                    }
                }else{
                    $course = new Course();
                }
                $course->profile_id = $profile->id;
                $course->status = $r->status;
                $course->name = $r->name;
                $course->detail = $r->detail;
                $course->video_number = $r->video_number;
                $course->time_number = $r->time_number;
                $course->certificate_status = $r->certificate_status;
                $course->actby = Auth::guard('web')->user()->name;

                if (!empty($r->certificate_file)) {
                    if ($r->hasFile('certificate_file') != '') {
                        File::delete(public_path() . '/images/profile/' . $course->certificate_file);
                        $certificate_file = 'profile_'.date('YmdHis').$r->file('certificate_file')->getClientOriginalName()."certificate.".$r->file('certificate_file')->getClientOriginalExtension();
                        $r->file('certificate_file')->move(public_path() . '/images/profile/', $certificate_file);
                    }
                    $course->certificate_file = $certificate_file;
                }

                if (!empty($r->image)) {
                    if ($r->hasFile('image') != '') {
                        File::delete(public_path() . '/images/profile/' . $course->image);
                        $image = 'profile_'.date('YmdHis').$r->file('image')->getClientOriginalName()."cover.".$r->file('image')->getClientOriginalExtension();
                        $r->file('image')->move(public_path() . '/images/profile/', $image);
                    }
                    $course->image = $image;
                }
                $befor_course = "";
                if($r->befor_course){
                    $befor_course = implode(",",$r->befor_course);
                }
                $course->befor_course = $befor_course;
                $course->save();
            }

            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollback();
        return $e->getMessage();
        }
        catch(\FatalThrowableError $fe)
        {
            DB::rollback();
        return $e->getMessage();
        }

        return redirect()->to('course_view/'.$course->id)->with('success','บันทึกข้อมูลสำเร็จ');
    }

    public function chapter_view($id)
    {
        $profile = Profile::where('user_id',Auth::guard('web')->user()->id)->first();
        $data = CourseChapter::where('id',$id)->first();
        if($data){
            $course = Course::where('id',$data->course_id)->where('profile_id',$profile->id)->first();
            $list = CourseList::where('course_id',$course->id)->where('chapter_id',$data->id)->get();
            $workshop = QuestionsDetail::where('chapter_id',$data->id)->get();
            if(!$course){
                return redirect()->back()->with('error','ไม่พบข้อมูล');
            }
            return view('frontend.course.chapter_add',[
                'data' => $data,
                'course' => $course,
                'list' => $list,
                'workshop' => $workshop,
            ]);
        }else{
            return redirect()->back()->with('error','ไม่พบข้อมูล');
        }
    }

    public function chapter_store(Request $r)
    {
        DB::beginTransaction();
        try
        {
            $profile = Profile::where('user_id',Auth::guard('web')->user()->id)->first();
            if($profile){

                $course = Course::where('id',$r->course_id)->where('profile_id',$profile->id)->first();
                if(!$course){
                    return redirect()->back()->with('error','ไม่พบข้อมูล');
                }


                if($r->chapter_id!=''){
                    $chapter = CourseChapter::where('id',$r->chapter_id)->first();
                    if(!$chapter){
                        return redirect()->back()->with('error','ไม่พบข้อมูล');
                    }
                }else{
                    $chapter = new CourseChapter();
                }
                $chapter->course_id = $course->id;
                $chapter->order = $r->order;
                $chapter->name = $r->name;
                $chapter->video_number = $r->video_number;
                $chapter->time_number = $r->time_number;
                $chapter->actby = Auth::guard('web')->user()->name;
                $chapter->save();
            }

            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollback();
        return $e->getMessage();
        }
        catch(\FatalThrowableError $fe)
        {
            DB::rollback();
        return $e->getMessage();
        }

        return redirect()->to('chapter_view/'.$chapter->id)->with('success','บันทึกข้อมูลสำเร็จ');
    }

    public function course_list_store(Request $r)
    {
        DB::beginTransaction();
        try
        {
            $profile = Profile::where('user_id',Auth::guard('web')->user()->id)->first();
            if($profile){
                $course = Course::where('id',$r->course_id)->where('profile_id',$profile->id)->first();
                if(!$course){
                    return redirect()->back()->with('error','ไม่พบข้อมูล');
                }
                if($r->list_id!=''){
                    $list = CourseList::where('id',$r->list_id)->first();
                    if(!$list){
                        return redirect()->back()->with('error','ไม่พบข้อมูล');
                    }
                }else{
                    $list = new CourseList();
                }

                $list->course_id = $course->id;
                $list->chapter_id = $r->chapter_id;
                $list->course_name = $r->course_name;
                $list->course_detail = $r->course_detail;
                $list->course_free = $r->course_free;
                $list->actby = Auth::guard('web')->user()->name;
                $list->course_time = $r->course_time;
                $list->course_order = $r->course_order;

                if (!empty($r->course_video)) {
                    if ($r->hasFile('course_video') != '') {
                        File::delete(public_path() . '/images/profile/' . $list->course_video);
                        $course_video = 'profile_'.date('YmdHis').$r->file('course_video')->getClientOriginalName()."video.".$r->file('course_video')->getClientOriginalExtension();
                        $r->file('course_video')->move(public_path() . '/images/profile/', $course_video);
                    }
                    $list->course_video = $course_video;
                }

                if (!empty($r->course_image)) {
                    if ($r->hasFile('course_image') != '') {
                        File::delete(public_path() . '/images/profile/' . $course->course_image);
                        $course_image = 'profile_'.date('YmdHis').$r->file('course_image')->getClientOriginalName()."cover.".$r->file('course_image')->getClientOriginalExtension();
                        $r->file('course_image')->move(public_path() . '/images/profile/', $course_image);
                    }
                    $list->course_image = $course_image;
                }

                $list->save();
            }

            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollback();
        return $e->getMessage();
        }
        catch(\FatalThrowableError $fe)
        {
            DB::rollback();
        return $e->getMessage();
        }

        return response()->json(['success'=>'You have successfully upload file.']);
        // return redirect()->to('chapter_view/'.$r->chapter_id)->with('success','บันทึกข้อมูลสำเร็จ');
    }

    public function workshop_add($chapter_id)
    {
        $chapter = CourseChapter::where('id',$chapter_id)->first();
        if(!$chapter){
            return redirect()->back()->with('error','ไม่พบข้อมูล');
        }
        $profile = Profile::where('user_id',Auth::guard('web')->user()->id)->first();
        $course = Course::where('id',$chapter->course_id)->where('profile_id',$profile->id)->first();
        if(!$course){
            return redirect()->back()->with('error','ไม่พบข้อมูล');
        }
        $list = CourseList::where('course_id',$course->id)->where('chapter_id',$chapter->id)->get();
        return view('frontend.course.workshop_add',[
            'course' => $course,
            'chapter' => $chapter,
            'list' => $list,
        ]);
    }

    public function course_list_remove_video(Request $r)
    {
        DB::beginTransaction();
        try
        {
            $profile = Profile::where('user_id',Auth::guard('web')->user()->id)->first();
            $list = CourseList::where('id',$r->list_id)->first();
            $course = Course::where('id',$list->course_id)->where('profile_id',$profile->id)->first();

            if($course){
                File::delete(public_path() . '/images/profile/' . $list->course_video);
                $list->course_video = '';
                $list->save();
            }

            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollback();
        return $e->getMessage();
        }
        catch(\FatalThrowableError $fe)
        {
            DB::rollback();
        return $e->getMessage();
        }

        return response()->json(['success'=>'วีดิโอถูกลบแล้ว.']);
        // return redirect()->to('workshop_view/'.$r->chapter_id.'/'.$question_detail->id)->with('success','บันทึกข้อมูลสำเร็จ');
    }

    public function workshop_store(Request $r)
    {
        DB::beginTransaction();
        try
        {
            $profile = Profile::where('user_id',Auth::guard('web')->user()->id)->first();
            if($profile){
                $course = Course::where('id',$r->course_id)->where('profile_id',$profile->id)->first();
                if(!$course){
                    return redirect()->back()->with('error','ไม่พบข้อมูล');
                }
                $list = CourseList::where('id',$r->course_list_id)->first();
                if(!$list){
                    return redirect()->back()->with('error','ไม่พบข้อมูล');
                }

                if($r->workshop_id!=''){
                    $question_detail = QuestionsDetail::where('id',$r->workshop_id)->first();
                    if(!$question_detail){
                        return redirect()->back()->with('error','ไม่พบข้อมูล');
                    }
                }else{
                    $question_detail = new QuestionsDetail();
                }
                $question_detail->chapter_id = $r->chapter_id;
                $question_detail->course_list_id = $list->id;
                $question_detail->time_test = $r->time_test;
                $question_detail->details = $r->details;
                $question_detail->name = $r->name;
                $question_detail->type = $r->type;
                $question_detail->score_success = $r->score_success;
                $question_detail->unlock_certificate = $r->unlock_certificate;
                $question_detail->save();
            }

            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollback();
        return $e->getMessage();
        }
        catch(\FatalThrowableError $fe)
        {
            DB::rollback();
        return $e->getMessage();
        }

        return redirect()->to('workshop_view/'.$r->chapter_id.'/'.$question_detail->id)->with('success','บันทึกข้อมูลสำเร็จ');
    }

    public function workshop_view($chapter_id,$workshop_id)
    {
        $profile = Profile::where('user_id',Auth::guard('web')->user()->id)->first();
        $chapter = CourseChapter::where('id',$chapter_id)->first();
        $data = QuestionsDetail::where('id',$workshop_id)->first();
        if(!$chapter){
            return redirect()->back()->with('error','ไม่พบข้อมูล');
        }
        if(!$data){
            return redirect()->back()->with('error','ไม่พบข้อมูล');
        }
        if($chapter){
            $course = Course::where('id',$chapter->course_id)->where('profile_id',$profile->id)->first();
            $list = CourseList::where('course_id',$course->id)->where('chapter_id',$chapter->id)->get();
            if(!$course){
                return redirect()->back()->with('error','ไม่พบข้อมูล');
            }
            $question = Questions::where('question_detail_id',$data->id)->orderBy('position','asc')->get();
            return view('frontend.course.workshop_add',[
                'chapter' => $chapter,
                'course' => $course,
                'list' => $list,
                'data' => $data,
                'question' => $question,
            ]);
        }else{
            return redirect()->back()->with('error','ไม่พบข้อมูล');
        }
    }

    public function question_store(Request $r)
    {
        DB::beginTransaction();
        try
        {
            $profile = Profile::where('user_id',Auth::guard('web')->user()->id)->first();
            if($profile){
                $course = Course::where('id',$r->course_id)->where('profile_id',$profile->id)->first();
                if(!$course){
                    return redirect()->back()->with('error','ไม่พบข้อมูล');
                }
                $question_detail = QuestionsDetail::where('id',$r->question_detail_id)->first();

                if(!$question_detail){
                         return redirect()->back()->with('error','ไม่พบข้อมูล');
                     }
                if($r->question_id!=''){
                    $question = Questions::where('id',$r->question_id)->first();
                    if(!$question){
                        return redirect()->back()->with('error','ไม่พบข้อมูล');
                    }
                }else{
                    $question = new Questions();
                }
                $question->question_detail_id = $r->question_detail_id;
                $question->course_list_id = $question_detail->course_list_id;
                $question->option_type_id = $r->option_type_id;
                $question->name = $r->name;
                $question->position = $r->position;
                $question->score = $r->score;
                $question->actby = Auth::guard('web')->user()->name;
                if($r->option_type_id=='1'){
                    $question->ans = $r->ans;
                }
                $question->save();

                if($r->option_type_id=='2'){
                    Options::where('question_id',$question->id)->delete();
                    $option1 = new Options();
                    $option1->name = $r->option_name1;
                    $option1->position = 1;
                    $option1->question_id = $question->id;
                    if($r->option_correct==1){
                        $option1->correct_answer = 1;
                    }else{
                        $option1->correct_answer = 0;
                    }
                    $option1->save();

                    $option2 = new Options();
                    $option2->name = $r->option_name2;
                    $option2->position = 2;
                    $option2->question_id = $question->id;
                    if($r->option_correct==2){
                        $option2->correct_answer = 1;
                    }else{
                        $option2->correct_answer = 0;
                    }
                    $option2->save();

                    $option3 = new Options();
                    $option3->name = $r->option_name3;
                    $option3->position = 3;
                    $option3->question_id = $question->id;
                    if($r->option_correct==3){
                        $option3->correct_answer = 1;
                    }else{
                        $option3->correct_answer = 0;
                    }
                    $option3->save();

                    $option4 = new Options();
                    $option4->name = $r->option_name4;
                    $option4->position = 4;
                    $option4->question_id = $question->id;
                    if($r->option_correct==4){
                        $option4->correct_answer = 1;
                    }else{
                        $option4->correct_answer = 0;
                    }
                    $option4->save();
                }


            }

            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollback();
        return $e->getMessage();
        }
        catch(\FatalThrowableError $fe)
        {
            DB::rollback();
        return $e->getMessage();
        }

        return redirect()->to('workshop_view/'.$r->chapter_id.'/'.$question_detail->id)->with('success','บันทึกข้อมูลสำเร็จ');
    }

    public function course_online_view($course_id)
    {
        $course = Course::where('id',$course_id)->first();
        if(!$course){
            return redirect()->back()->with('error','ไม่พบข้อมูล');
        }
        $chapter = CourseChapter::where('course_id',$course_id)->orderBy('order','asc')->get();

            return view('frontend.course_online',[
                'course' => $course,
                'chapter' => $chapter,
            ]);
    }

    public function course_online_inside_view($course_list_id)
    {
        $list = CourseList::where('id',$course_list_id)->first();
        if(!$list){
            return redirect()->back()->with('error','ไม่พบข้อมูล');
        }
        $course = Course::where('id',$list->course_id)->first();
        if(!$course){
            return redirect()->back()->with('error','ไม่พบข้อมูล');
        }
        $course_list = CourseList::where('course_id',$course->id)->where('chapter_id',$list->chapter_id)->get();

            return view('frontend.course_online_inside',[
                'course' => $course,
                'course_list' => $course_list,
                'list' => $list,
            ]);
    }

    public function workshop_inside_view($course_id,$workshop_id)
    {
        $question_detail = QuestionsDetail::where('id',$workshop_id)->first();
        $course = Course::where('id',$course_id)->first();

        $question_count = \App\Models\Questions::where('question_detail_id', $question_detail->id)->count();
        $question = \App\Models\Questions::where('question_detail_id', $question_detail->id)->get();
        $question_score_sum = \App\Models\Questions::where('question_detail_id', $question_detail->id)->sum('score');
        $pro_quest_detail = ProfileQuestionDetail::where('questions_detail_id',$question_detail->id)->where('user_id',Auth::guard('web')->user()->id)->first();

            return view('frontend.workshop_inside_view',[
                'question_detail' => $question_detail,
                'course' => $course,
                'question_count' => $question_count,
                'question' => $question,
                'question_score_sum' => $question_score_sum,
                'pro_quest_detail' => $pro_quest_detail,
            ]);
    }

    public function workshop_inside_check($question_detail_id)
    {
        $pro_quest_detail = ProfileQuestionDetail::where('id',$question_detail_id)->first();
        $question_detail = QuestionsDetail::where('id',$pro_quest_detail->questions_detail_id)->first();
        $course_list = CourseList::where('id',$question_detail->course_list_id)->first();
        $course = Course::where('id',$course_list->course_id)->first();
        $type = 'check';
        $question_count = \App\Models\Questions::where('question_detail_id', $question_detail->id)->count();
        $question = \App\Models\Questions::where('question_detail_id', $question_detail->id)->get();
        $question_score_sum = \App\Models\Questions::where('question_detail_id', $question_detail->id)->sum('score');

            return view('frontend.workshop_inside_view',[
                'question_detail' => $question_detail,
                'course' => $course,
                'question_count' => $question_count,
                'question' => $question,
                'question_score_sum' => $question_score_sum,
                'pro_quest_detail' => $pro_quest_detail,
                'type' => $type,
            ]);
    }

    public function workshop_inside_store(Request $r)
    {
        $question_detail = QuestionsDetail::where('id',$r->question_detail_id)->first();
        $course = Course::where('id',$r->course_id)->first();

            DB::beginTransaction();
            try
            {

               $score = 0;
               $text_score = 0;

               if($r->type == ''){

                if(isset($r->option_ans)){
                    foreach($r->option_ans as $key => $op){

                        $option_correct = DB::table('options')->select('correct_answer')->where('id',$op)->first();
                        $question = \App\Models\Questions::where('id', $key)->first();

                        $answers = new Answers();
                        $answers->question_id = $key;
                        $answers->option_id = $op;
                        $answers->user_id = Auth::guard('web')->user()->id;
                        if($option_correct->correct_answer==1){
                            $answers->pass = 1;
                            $score += $question->score;
                        }else{
                            $answers->pass = 2;
                        }
                        $answers->save();

                    }
                }

                if(isset($r->text_ans)){
                    foreach($r->text_ans as $key => $text){

                        $answers = new Answers();
                        $answers->question_id = $key;
                        $answers->option_text = $text;
                        $answers->user_id = Auth::guard('web')->user()->id;
                        // if($option_correct->correct_answer==1){
                        //     $answers->pass = 1;
                        // }else{
                        //     $answers->pass = 2;
                        // }
                        $answers->save();
                        $text_score++;
                    }
                }


                $pro_quest_detail = new ProfileQuestionDetail();
                $pro_quest_detail->user_id = Auth::guard('web')->user()->id;
                $pro_quest_detail->questions_detail_id = $question_detail->id;
                $pro_quest_detail->score = $score;
                if($score>=$question_detail->score_success){
                    $pro_quest_detail->status = 1;
                }else{
                    if($text_score>0){
                        $pro_quest_detail->status = 0;
                    }else{
                        $pro_quest_detail->status = 2;
                    }
                }
                $pro_quest_detail->save();

               }

               if($r->type=='check'){
                $score = 0;
                if(isset($r->text_ans_check)){
                    foreach($r->text_ans_check as $key => $text){
                            $ans = Answers::where('id',$key)->first();
                            $question = \App\Models\Questions::where('id',$ans->question_id)->first();
                            $ans->pass = $text;
                            if($ans->pass==1){
                                $score+=$question->score;
                            }
                            $ans->save();
                    }

                    $pro_quest_detail = ProfileQuestionDetail::where('id',$r->pro_quest_detail_id)->first();
                    $pro_quest_detail->score = $pro_quest_detail->score+$score;
                    if($pro_quest_detail->score >= $question_detail->score_success){
                        $pro_quest_detail->status = 1;
                    }else{
                        $pro_quest_detail->status = 2;
                    }

                    $pro_quest_detail->save();

                }

               }



                DB::commit();
            }
            catch (\Exception $e) {
                DB::rollback();
            return $e->getMessage();
            }
            catch(\FatalThrowableError $fe)
            {
                DB::rollback();
            return $e->getMessage();
            }

            return redirect()->back()->with('success','บันทึกข้อมูลสำเร็จ');
        // return redirect()->to('workshop_inside_view/'.$course->id.'/'.$question_detail->id)->with('success','บันทึกข้อมูลสำเร็จ');

    }



}
