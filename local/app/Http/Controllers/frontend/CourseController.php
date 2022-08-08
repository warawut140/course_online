<?php

namespace App\Http\Controllers\frontend;

use App\Models\BitCoin;
use App\Models\Course;
use App\Models\CourseComment;
use App\Models\CourseList;
use App\Models\CourseLogView;
use App\Models\CourseUnLock;
use App\Models\Options;
use App\Models\Profile;
use App\Models\Questions;
use App\Models\QuestionsDetail;
use App\Models\Tags;
use App\Models\TypeUser;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Question\Question;
use App\Models\CourseChapter;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show','searchCourse']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //หมวดหมู่
        $tags =  Tags::orderBy('name')->pluck('name', 'id');
        $course_list = CourseList::join('courses','course_lists.course_id','=','courses.id')
            ->select('courses.name','course_lists.*')
            ->orderBy('course_id','desc')
//            ->orderBy('course_order','desc')
            ->get();
        foreach ($course_list as $key => $item){
            $course_listCount = CourseLogView::where('course_list_id','=',$item->id)->get();
            $course_list[$key]->total =  ($course_listCount == null)?0:count($course_listCount);
            $course_listCM = CourseComment::select(DB::raw('count(course_list_id) as total'))
                ->where('course_list_id','=',$item->id)
                ->groupBy('course_list_id')
                ->first();
            $course_list[$key]->commentTotal =  ($course_listCM == null)?0:$course_listCM->total;
        }

        // New Show Course
        $course = Course::where('status',1)->orderBy('id','desc')->get();
//        dd($course);
        return view('frontend.course',[
            'tags' => $tags ,
            'course_list' => $course_list ,
            'course' => $course ,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now = new DateTime();
        $auth_id = Auth::user()->id;
        $auth_name = Auth::user()->name;
        $course_comment = new CourseComment();
        $course_comment->details = $request->details;
        $course_comment->course_list_id = $request->course_list_id;
        $course_comment->actby = $auth_name;
        $course_comment->user_id = $auth_id;
        $course_comment->created_at = $now;
        $course_comment->updated_at = null;
        $course_comment->save();

        Session::flash('status', 'Comment เรียบร้อย !');
        return redirect('course/'.$request->course_list_id);
    }

    public function searchCourse(Request $request)
    {
//        dd($request->all());
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $now = new DateTime();
        $ip = \Request::getClientIp(true);
        $visitor = CourseLogView::where('ip','=',$ip)
            ->where('course_list_id','=',$id)
            ->first();
        if ($visitor == null){
            $logview = new CourseLogView();
            $logview->course_list_id = $id;
            $logview->ip = $ip;
            $logview->count = 1;
            $logview->save();
        }else{
            DB::table('course_log_views')
                ->where('ip', '=', $ip)
                ->where('course_list_id', '=', $id)
                ->update([
                    'count' =>  $visitor->count + 1,
                ]);
        }

        $course_list = CourseList::join('courses','course_lists.course_id','=','courses.id')
            ->select('courses.name','course_lists.*')
            ->where('course_lists.id',$id)
            ->first();
        $course_listComment = CourseComment::where('course_list_id','=',$id)
            ->paginate(8);;

        // New Edit Design 23/12/2562
        $course = Course::find($id);


        if(Auth::user()){
            $course_video_list =  CourseList::where('course_id',$id)->get();
            $profile = Profile::join('users','users.id','=','profiles.user_id')
                ->select('profiles.*','users.name as username','users.email')
                ->where('profiles.user_id','=', Auth::user()->id)
                ->first();
            $coin = BitCoin::where('profile_id',$profile->id)->first();
            // Check UnLock Course
            $unlock = CourseUnLock::where('user_id',Auth::user()->id)
                ->where('course_id',$id)
                ->first();

            foreach ($course_video_list as $key => $value){
                $course_check = Questions::where('course_list_id','=',$value->id)->get();
                 // true => มีข้อสอบ , false => ไม่มีข้อสอบ
                $course_video_list[$key]->course_check =  (count($course_check) > 0)?true:false ;

                // Check ข้อสอบ
                $answer_checktime =  DB::table('answer_checktime')
                    ->where('course_list_id','=',$value->id)
                    ->where('user_id','=',Auth::user()->id)
                    ->where('answer_status','=',1)
                    ->orderBy('id','desc')
                    ->first();
                if($answer_checktime != null){
                    $answer = DB::table('answers')
                        ->where('idcheck','=',$answer_checktime->id)
                        ->where('user_id','=',Auth::user()->id)
                        ->get();
                    $sum_answer = DB::table('answers')
                        ->where('idcheck','=',$answer_checktime->id)
                        ->where('user_id','=',Auth::user()->id)
                        ->where('pass','=',0)
                        ->count('pass');
                    if(count($answer) > 0){
                        $percent = (100 / count($answer) * $sum_answer);
                        if($percent > 70){
                            $course_video_list[$key]->answer = 1 ;
                            $course_video_list[$key]->sum_answer = 'ผ่านสอบ' ;
                        }else{
                            $course_video_list[$key]->answer = 2 ;
                            $course_video_list[$key]->sum_answer = 'ไม่ผ่านสอบ' ;
                        }
                    }
                }else{
                    $course_video_list[$key]->answer = 3 ;
                    $course_video_list[$key]->sum_answer = '' ;
                }

            }

//            dd($course_video_list);
            return view('frontend.article_course',[
                'id' => $id,
                'course_list' => $course_list,
                'course_listComment' => $course_listComment,
                'd_none1' => '',
                'd_none2' => 'd-none',
                'last_id' => '',
                'course' => $course,
                'course_video_list' => $course_video_list,
                'profile' => $profile,
                'coin' => ($coin == '')?0:$coin->coins,
                'unlock' => ($unlock == null)?0:$unlock->unlock,
            ]);
        }else{
            $course_video_list =  CourseList::where('course_id',$id)->get();
            return view('frontend.article_course',[
                'id' => $id,
                'course_list' => $course_list,
                'course_listComment' => $course_listComment,
                'd_none1' => '',
                'd_none2' => 'd-none',
                'last_id' => '',
                'course' => $course,
                'course_video_list' => $course_video_list,
                'profile' => null,
                'unlock' => 0,
            ]);
        }
    }

    public function show2($id)
    {
        $now = new DateTime();
        $ip = \Request::getClientIp(true);
        $visitor = CourseLogView::where('ip','=',$ip)
            ->where('course_list_id','=',$id)
            ->first();
        if ($visitor == null){
            $logview = new CourseLogView();
            $logview->course_list_id = $id;
            $logview->ip = $ip;
            $logview->count = 1;
            $logview->save();
        }else{
            DB::table('course_log_views')
                ->where('ip', '=', $ip)
                ->where('course_list_id', '=', $id)
                ->update([
                    'count' =>  $visitor->count + 1,
                ]);
        }

        $course_list = CourseList::join('courses','course_lists.course_id','=','courses.id')
            ->select('courses.name','course_lists.*')
            ->where('course_lists.id',$id)
            ->first();
        $course_listComment = CourseComment::where('course_list_id','=',$id)
            ->paginate(8);;

        // New Edit Design 23/12/2562
        $course = Course::find($id);


        if(Auth::user()){
            $course_video_list =  CourseList::where('course_id',$id)->get();
            $profile = Profile::join('users','users.id','=','profiles.user_id')
                ->select('profiles.*','users.name as username','users.email')
                ->where('profiles.user_id','=', Auth::user()->id)
                ->first();
            $coin = BitCoin::where('profile_id',$profile->id)->first();
            // Check UnLock Course
            $unlock = CourseUnLock::where('user_id',Auth::user()->id)
                ->where('course_id',$id)
                ->first();

            foreach ($course_video_list as $key => $value){
                $course_check = Questions::where('course_list_id','=',$value->id)->get();
                 // true => มีข้อสอบ , false => ไม่มีข้อสอบ
                $course_video_list[$key]->course_check =  (count($course_check) > 0)?true:false ;

                // Check ข้อสอบ
                $answer_checktime =  DB::table('answer_checktime')
                    ->where('course_list_id','=',$value->id)
                    ->where('user_id','=',Auth::user()->id)
                    ->where('answer_status','=',1)
                    ->orderBy('id','desc')
                    ->first();
                if($answer_checktime != null){
                    $answer = DB::table('answers')
                        ->where('idcheck','=',$answer_checktime->id)
                        ->where('user_id','=',Auth::user()->id)
                        ->get();
                    $sum_answer = DB::table('answers')
                        ->where('idcheck','=',$answer_checktime->id)
                        ->where('user_id','=',Auth::user()->id)
                        ->where('pass','=',0)
                        ->count('pass');
                    if(count($answer) > 0){
                        $percent = (100 / count($answer) * $sum_answer);
                        if($percent > 70){
                            $course_video_list[$key]->answer = 1 ;
                            $course_video_list[$key]->sum_answer = 'ผ่านสอบ' ;
                        }else{
                            $course_video_list[$key]->answer = 2 ;
                            $course_video_list[$key]->sum_answer = 'ไม่ผ่านสอบ' ;
                        }
                    }
                }else{
                    $course_video_list[$key]->answer = 3 ;
                    $course_video_list[$key]->sum_answer = '' ;
                }

            }
// dd($course);
//            dd($course_video_list);
            
            $chapter = CourseChapter::where('course_id',$id)->orderBy('order','asc')->get();
            return view('frontend.article2-course-main',[
                'id' => $id,
                'course_list' => $course_list,
                'course_listComment' => $course_listComment,
                'd_none1' => '',
                'd_none2' => 'd-none',
                'last_id' => '',
                'course' => $course,
                'course_video_list' => $course_video_list,
                'profile' => $profile,
                'coin' => ($coin == '')?0:$coin->coins,
                'unlock' => ($unlock == null)?0:$unlock->unlock,
                'chapter' => $chapter,
            ]);
        }else{
            $chapter = CourseChapter::where('course_id',$id)->orderBy('order','asc')->get();
            $course_video_list =  CourseList::where('course_id',$id)->get();
            return view('frontend.article2-course-main',[
                'id' => $id,
                'course_list' => $course_list,
                'course_listComment' => $course_listComment,
                'd_none1' => '',
                'd_none2' => 'd-none',
                'last_id' => '',
                'course' => $course,
                'course_video_list' => $course_video_list,
                'profile' => null,
                'unlock' => 0,
                'chapter' => $chapter,
            ]);
        }
    }

    public function show2_list($id,$list_id)
    {
        $now = new DateTime();
        $ip = \Request::getClientIp(true);
        $visitor = CourseLogView::where('ip','=',$ip)
            ->where('course_list_id','=',$id)
            ->first();
        if ($visitor == null){
            $logview = new CourseLogView();
            $logview->course_list_id = $id;
            $logview->ip = $ip;
            $logview->count = 1;
            $logview->save();
        }else{
            DB::table('course_log_views')
                ->where('ip', '=', $ip)
                ->where('course_list_id', '=', $id)
                ->update([
                    'count' =>  $visitor->count + 1,
                ]);
        }

        $course_list = CourseList::join('courses','course_lists.course_id','=','courses.id')
            ->select('courses.name','course_lists.*')
            ->where('course_lists.id',$id)
            ->first();
        $course_listComment = CourseComment::where('course_list_id','=',$id)
            ->paginate(8);;

        // New Edit Design 23/12/2562
        $course = Course::find($id);


        if(Auth::user()){
            $course_video_list =  CourseList::where('course_id',$id)->get();
            $profile = Profile::join('users','users.id','=','profiles.user_id')
                ->select('profiles.*','users.name as username','users.email')
                ->where('profiles.user_id','=', Auth::user()->id)
                ->first();
            $coin = BitCoin::where('profile_id',$profile->id)->first();
            // Check UnLock Course
            $unlock = CourseUnLock::where('user_id',Auth::user()->id)
                ->where('course_id',$id)
                ->first();

            foreach ($course_video_list as $key => $value){
                $course_check = Questions::where('course_list_id','=',$value->id)->get();
                 // true => มีข้อสอบ , false => ไม่มีข้อสอบ
                $course_video_list[$key]->course_check =  (count($course_check) > 0)?true:false ;

                // Check ข้อสอบ
                $answer_checktime =  DB::table('answer_checktime')
                    ->where('course_list_id','=',$value->id)
                    ->where('user_id','=',Auth::user()->id)
                    ->where('answer_status','=',1)
                    ->orderBy('id','desc')
                    ->first();
                if($answer_checktime != null){
                    $answer = DB::table('answers')
                        ->where('idcheck','=',$answer_checktime->id)
                        ->where('user_id','=',Auth::user()->id)
                        ->get();
                    $sum_answer = DB::table('answers')
                        ->where('idcheck','=',$answer_checktime->id)
                        ->where('user_id','=',Auth::user()->id)
                        ->where('pass','=',0)
                        ->count('pass');
                    if(count($answer) > 0){
                        $percent = (100 / count($answer) * $sum_answer);
                        if($percent > 70){
                            $course_video_list[$key]->answer = 1 ;
                            $course_video_list[$key]->sum_answer = 'ผ่านสอบ' ;
                        }else{
                            $course_video_list[$key]->answer = 2 ;
                            $course_video_list[$key]->sum_answer = 'ไม่ผ่านสอบ' ;
                        }
                    }
                }else{
                    $course_video_list[$key]->answer = 3 ;
                    $course_video_list[$key]->sum_answer = '' ;
                }

            }
// dd($course);
//            dd($course_video_list);
            $data_list = CourseList::where('id',$list_id)->first();
            $chapter = CourseChapter::where('course_id',$id)->orderBy('order','asc')->get();
            return view('frontend.article2-course',[
                'id' => $id,
                'course_list' => $course_list,
                'course_listComment' => $course_listComment,
                'd_none1' => '',
                'd_none2' => 'd-none',
                'last_id' => '',
                'course' => $course,
                'course_video_list' => $course_video_list,
                'profile' => $profile,
                'coin' => ($coin == '')?0:$coin->coins,
                'unlock' => ($unlock == null)?0:$unlock->unlock,
                'chapter' => $chapter,
                'data_list' => $data_list,
            ]);
        }else{
            $data_list = CourseList::where('id',$list_id)->first();
            $chapter = CourseChapter::where('course_id',$id)->orderBy('order','asc')->get();
            $course_video_list =  CourseList::where('course_id',$id)->get();
            return view('frontend.article2-course',[
                'id' => $id,
                'course_list' => $course_list,
                'course_listComment' => $course_listComment,
                'd_none1' => '',
                'd_none2' => 'd-none',
                'last_id' => '',
                'course' => $course,
                'course_video_list' => $course_video_list,
                'profile' => null,
                'unlock' => 0,
                'chapter' => $chapter,
                'data_list' => $data_list,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $now = new DateTime();
        $ip = \Request::getClientIp(true);
        $visitor = CourseLogView::where('ip','=',$ip)
            ->where('course_list_id','=',$id)
            ->first();
        if ($visitor == null){
            $logview = new CourseLogView();
            $logview->course_list_id = $id;
            $logview->ip = $ip;
            $logview->count = 1;
            $logview->save();
        }else{
            DB::table('course_log_views')
                ->where('ip', '=', $ip)
                ->where('course_list_id', '=', $id)
                ->update([
                    'count' =>  $visitor->count + 1,
                ]);
        }

        $course_list = CourseList::join('courses','course_lists.course_id','=','courses.id')
            ->select('courses.name','course_lists.*')
            ->where('course_lists.id',$id)
            ->first();
        $course_listComment = CourseComment::where('course_list_id','=',$id)->paginate(8);;
        $course_check = Questions::where('course_list_id','=',$id)->get();


        // New Edit Design 23/12/2562
        $course = Course::find($id);
        $course_video_list =  CourseList::where('course_id',$id)->get();


        if(Auth::user()){
            //Check Answer
            $findCourse = CourseList::where('course_id',$course_list->course_id)
                ->where('id','=',$id)
                ->first();
            $auth_id = Auth::user()->id;
            $course_order = $findCourse->course_order - 1;
            if($course_order != 0){
                $findCourseLast = CourseList::where('course_id',$course_list->course_id)
                    ->where('course_order','=',$course_order)
                    ->first();
                $answer_checktime =  DB::table('answer_checktime')
                    ->where('course_list_id','=',$findCourseLast->id)
                    ->where('user_id','=',$auth_id)
                    ->where('answer_status','=',1)
                    ->first();
                if($answer_checktime != null){
                    $answer = DB::table('answers')
                        ->where('idcheck','=',$answer_checktime->id)
                        ->where('user_id','=',$auth_id)
                        ->get();
                    $sum_answer = DB::table('answers')
                        ->where('idcheck','=',$answer_checktime->id)
                        ->where('user_id','=',$auth_id)
                        ->where('pass','=',0)
                        ->count('pass');
                    if(count($answer) > 0){
                        $percent = (100 / count($answer) * $sum_answer);
                        if($percent > 70){
                            $d_none1 = '';
                            $d_none2 = 'd-none';
                            $last_id = '';
                        }else{
                            $d_none1 = 'd-none';
                            $d_none2 = '';
                            $last_id = $findCourseLast->id;
                        }
                        return view('frontend.article-course',[
                            'id' => $id,
                            'course_list' => $course_list,
                            'course_listComment' => $course_listComment,
                            'course_check' => (count($course_check) > 0)?true:false, // true => มีข้อสอบ , false => ไม่มีข้อสอบ
                            'd_none1' => $d_none1,
                            'd_none2' => $d_none2,
                            'last_id' => $last_id,
                        ]);
                    }else{
                        return view('frontend.article-course',[
                            'id' => $id,
                            'course_list' => $course_list,
                            'course_listComment' => $course_listComment,
                            'course_check' => (count($course_check) > 0)?true:false,  // true => มีข้อสอบ , false => ไม่มีข้อสอบ
                            'd_none1' => '',
                            'd_none2' => 'd-none',
                            'last_id' => '',
                        ]);
                    }
                }elseif($answer_checktime == null){
                    return view('frontend.article-course',[
                        'id' => $id,
                        'course_list' => $course_list,
                        'course_listComment' => $course_listComment,
                        'course_check' => (count($course_check) > 0)?true:false,  // true => มีข้อสอบ , false => ไม่มีข้อสอบ
                        'd_none1' => 'd-none',
                        'd_none2' => '',
                        'last_id' => $findCourseLast->id,
                    ]);
                }else{
                    return view('frontend.article-course',[
                        'id' => $id,
                        'course_list' => $course_list,
                        'course_listComment' => $course_listComment,
                        'course_check' => (count($course_check) > 0)?true:false,  // true => มีข้อสอบ , false => ไม่มีข้อสอบ
                        'd_none1' => '',
                        'd_none2' => 'd-none',
                        'last_id' => '',
                    ]);
                }
            }else{
                return view('frontend.article_course',[
                    'id' => $id,
                    'course_list' => $course_list,
                    'course_listComment' => $course_listComment,
                    'course_check' => (count($course_check) > 0)?true:false,  // true => มีข้อสอบ , false => ไม่มีข้อสอบ
                    'd_none1' => '',
                    'd_none2' => 'd-none',
                    'last_id' => '',
                    'course' => $course,
                    'course_video_list' => $course_video_list,
                ]);
            }
        }else{
            return view('frontend.article_course',[
                'id' => $id,
                'course_list' => $course_list,
                'course_listComment' => $course_listComment,
                'course_check' => (count($course_check) > 0)?true:false,  // true => มีข้อสอบ , false => ไม่มีข้อสอบ
                'd_none1' => '',
                'd_none2' => 'd-none',
                'last_id' => '',
                'course' => $course,
                'course_video_list' => $course_video_list,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function articleTest($id)
    {
        $questions =  Questions::join('option_type','questions.option_type_id','=','option_type.id')
            ->select('option_type.name' , 'questions.*')
            ->where('course_list_id',$id)
            ->get();

        $courseList = CourseList::find($id);
        $questionsDetails = QuestionsDetail::where('course_list_id',$id)->first();
        foreach ($questions as $key => $question){
            if($question->option_type_id == 2){
                $options = Options::where('question_id',$question->id)->get();
                $questions[$key]->options = $options ;
            }
        }

        //###### Answer Check Time ######//
        $now = new DateTime();
        $auth_id = Auth::user()->id;
        list($hour, $minute, $second) = explode(':', date('H:i:s', strtotime($questionsDetails->time_test)));
        $answer_end_date = date("Y-m-d H:i:s", mktime(date("H")+$hour, date("i")+$minute, date("s")+$second, date("m")  , date("d"), date("Y")));

        $check = DB::table('answer_checktime')
            ->where('course_list_id','=',$id)
            ->where('user_id','=',$auth_id)
            ->where('hide','=',0)
            ->first();

        if ($check == null){
//            echo "INSERT DATA";
            $answer_checktime = DB::table('answer_checktime')->insert([
                [
                    'course_list_id' => $id,
                    'answer_start_date' => $now,
                    'answer_end_date' => "$answer_end_date",
                    'user_id' => $auth_id,
                    'answer_status' => 0,
                    'exam_status' => 0,
                    'count' => 1,
                    'created_at' => $now,
                    'updated_at' => null,
                ],
            ]);
            if ($answer_checktime == true){
                $check = DB::table('answer_checktime')
                    ->where('course_list_id','=',$id)
                    ->where('user_id','=',$auth_id)
                    ->where('answer_status','=',0)
                    ->first();

                return view('frontend.article-test',[
                    'check' => $check ,
                    'id' => $id ,
                    'courseList' => $courseList ,
                    'questions' => $questions ,
                    'questionsDetails' => $questionsDetails ,
                ]);
            }
        }elseif($check->answer_status == 0){
//            echo "กำลังสอบ";
//            dd($check);
            return view('frontend.article-test',[
                'check' => $check ,
                'id' => $id ,
                'courseList' => $courseList ,
                'questions' => $questions ,
                'questionsDetails' => $questionsDetails ,
            ]);
        }elseif($check->answer_status == 1){
            if ($check->exam_status == 0 || $check->exam_status == 1){
//                echo "CHECk DATA กำลังตรวจ || สอบผ่าน";
//                return redirect('answers/'.$check->id);
                return redirect('profile');
            }elseif ($check->exam_status == 2){
//                echo "CHECk DATA สอบซ่อม";
                return redirect('profile');
            }
        }
        //###### Answer Check Time ######//
    }

    public function articleTestAPI($id)
    {
        $questions =  Questions::join('option_type','questions.option_type_id','=','option_type.id')
            ->select('option_type.name' , 'questions.*')
            ->where('course_list_id',$id)
            ->paginate(2);

        foreach ($questions as $key => $question){
            if($question->option_type_id == 2){
                $options = Options::where('question_id',$question->id)->get();
                $questions[$key]->options = $options ;
            }
        }

        return response()->json($questions);
    }

    public function countArticleTestAPI($id)
    {
        $countQuestions =  Questions::join('option_type','questions.option_type_id','=','option_type.id')
            ->select('option_type.name' , 'questions.*')
            ->where('course_list_id',$id)
            ->get();
        return response()->json(count($countQuestions));
    }

    public function checkCourseList($idCheck)
    {
        $auth_id = Auth::user()->id;
        $profile = Profile::join('bit_coins','bit_coins.profile_id','profiles.id')
            ->select('profiles.*','bit_coins.coins')
            ->where('profiles.id','=', $auth_id)
            ->first();
        $typeUser1 = TypeUser::find(1);
        $typeUser2 = TypeUser::find(2);
        $typeUser3 = TypeUser::find(3);




        return view('frontend.answer',[
            'id' => $idCheck,
            'profile' => $profile ,
            'typeUser1' => $typeUser1 ,
            'typeUser2' => $typeUser2 ,
            'typeUser3' => $typeUser3 ,
        ]);

    }

    public function unLockCourse($course_id)
    {
        $now = new DateTime();
        $auth_id = Auth::user()->id;
        $unlock_course = new CourseUnLock();
        $unlock_course->course_id = $course_id;
        $unlock_course->unlock = 1;
        $unlock_course->user_id = $auth_id;
        $unlock_course->created_at = $now;
        $unlock_course->updated_at = null;
        $unlock_course->save();
        $profile = Profile::join('users','users.id','=','profiles.user_id')
            ->select('profiles.*','users.name as username','users.email')
            ->where('profiles.user_id','=', Auth::user()->id)
            ->first();
        $coin = BitCoin::where('profile_id',$profile->id)->first();
        $course = Course::find($course_id);
        $sum = (int)$coin->coins - (int)$course->price ;
        BitCoin::where('profile_id',$profile->id)
            ->update([
                'coins' => $sum
            ]);
        Session::flash('status_course', 'ปลดล็อค Course !');
        return redirect('course/'.$course_id);
    }

    public function unLockCourse2($course_id)
    {
        $now = new DateTime();
        $auth_id = Auth::user()->id;
        $unlock_course = new CourseUnLock();
        $unlock_course->course_id = $course_id;
        $unlock_course->unlock = 1;
        $unlock_course->user_id = $auth_id;
        $unlock_course->created_at = $now;
        $unlock_course->updated_at = null;
        $unlock_course->save();
        $profile = Profile::join('users','users.id','=','profiles.user_id')
            ->select('profiles.*','users.name as username','users.email')
            ->where('profiles.user_id','=', Auth::user()->id)
            ->first();
        $coin = BitCoin::where('profile_id',$profile->id)->first();
        $course = Course::find($course_id);
        $sum = (int)$coin->coins - (int)$course->price ;
        BitCoin::where('profile_id',$profile->id)
            ->update([
                'coins' => $sum
            ]);
        Session::flash('status_course', 'ปลดล็อค Course !');
        return redirect('course2/'.$course_id);
    }
}
