<?php

namespace App\Http\Controllers\frontend;

use App\Models\CourseComment;
use App\Models\CourseList;
use App\Models\CourseLogView;
use App\Models\Course;
use App\Models\Gallery;
use App\Models\Logview;
use App\Models\Profile;
use App\Models\Training;
use App\Models\TrainingComment;
use App\Models\TrainingLogView;
use App\Models\WorkComment;
use App\Models\WorkPosting;
use App\Models\WorkTag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Models\JobDescription;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $home_gellery = Gallery::where('type','=',1)
            ->where('isActive','=',1)
            ->get();
        $user_count_1 = DB::table('profiles')
            ->select(DB::raw('count(type_user_id) as usertype1'))
            ->first();
        $user_count_2 = DB::table('profiles')
            ->select(DB::raw('count(type_user_id_2) as usertype2'))
            ->first();
        $user_count_3 = DB::table('profiles')
            ->select(DB::raw('count(type_user_id_3) as usertype3'))
            ->first();
        // Data Work Posting : หาผู้รับจ้าง
        $works1 = WorkPosting::join('tpye_work_postings', 'tpye_work_postings.id', '=', 'work_postings.tpye_wp_id')
            ->join('price_ranges', 'price_ranges.id', '=', 'work_postings.price_range_id')
            ->join('provinces', 'provinces.PROVINCE_ID', '=', 'work_postings.provinces_id')
            ->join('profiles', 'profiles.id', '=', 'work_postings.profile_id')
            ->select('work_postings.*', 'tpye_work_postings.name', 'price_ranges.price', 'provinces.PROVINCE_NAME'
                , 'provinces.PROVINCE_NAME_ENG', 'profiles.firstname', 'profiles.lastname', 'profiles.image_profile')
            ->where('tpye_wp_id', '=',1)
            ->orderBy('id', 'desc')
            ->limit(4)
            ->get();
        foreach ($works1 as $key => $work) {
            $wp_tags = WorkTag::join('tags', 'tags.id', '=', 'work_tags.tag_id')
                ->select('tags.name', 'work_tags.wp_id', 'work_tags.tag_id')
                ->where('wp_id', '=', $work->id)
                ->get();
            $works1[$key]->tags = $wp_tags;
        }
        foreach ($works1 as $key => $work1) {
//            $Logview = Logview::where('wp_id', $work->id)->sum('count');
            $Logview = Logview::where('wp_id', $work->id)->get();
            if ($Logview != null) {
                $works1[$key]->sum = count($Logview);
            } else {
                $works1[$key]->sum = 0;
            }
        }
        foreach ($works1 as $key => $work1) {
            $Logview = Logview::where('wp_id', $work1->id)->get();
            if ($Logview != null) {
                $works1[$key]->sum = count($Logview);
            } else {
                $works1[$key]->sum = 0;
            }
        }

        // Data Work Posting : หาผู้รับเหมา
        $works2 = WorkPosting::join('tpye_work_postings', 'tpye_work_postings.id', '=', 'work_postings.tpye_wp_id')
            ->join('price_ranges', 'price_ranges.id', '=', 'work_postings.price_range_id')
            ->join('provinces', 'provinces.PROVINCE_ID', '=', 'work_postings.provinces_id')
            ->join('profiles', 'profiles.id', '=', 'work_postings.profile_id')
            ->select('work_postings.*', 'tpye_work_postings.name', 'price_ranges.price', 'provinces.PROVINCE_NAME'
                , 'provinces.PROVINCE_NAME_ENG', 'profiles.firstname', 'profiles.lastname', 'profiles.image_profile')
            ->where('tpye_wp_id', '=',2)
            ->orderBy('id', 'desc')
            ->limit(4)
            ->get();
        foreach ($works2 as $key => $work) {
            $wp_tags = WorkTag::join('tags', 'tags.id', '=', 'work_tags.tag_id')
                ->select('tags.name', 'work_tags.wp_id', 'work_tags.tag_id')
                ->where('wp_id', '=', $work->id)
                ->get();
            $works2[$key]->tags = $wp_tags;
        }
        foreach ($works2 as $key => $work) {
            $Logview = Logview::where('wp_id', $works2->id)->get();
            if ($Logview != null) {
                $works2[$key]->sum = count($Logview);
            } else {
                $works2[$key]->sum = 0;
            }
        }
        foreach ($works2 as $key => $work) {
            $wp_comment = WorkComment::where('wp_id', $work->id)->count('wp_id');
            if ($wp_comment != null) {
                $works2[$key]->count = $wp_comment;
            } else {
                $works2[$key]->count = 0;
            }
        }

        // Data Work Posting : หางาน หรือ ผู้รับจ้าง
        $works3 = WorkPosting::join('tpye_work_postings', 'tpye_work_postings.id', '=', 'work_postings.tpye_wp_id')
            ->join('price_ranges', 'price_ranges.id', '=', 'work_postings.price_range_id')
            ->join('provinces', 'provinces.PROVINCE_ID', '=', 'work_postings.provinces_id')
            ->join('profiles', 'profiles.id', '=', 'work_postings.profile_id')
            ->select('work_postings.*', 'tpye_work_postings.name', 'price_ranges.price', 'provinces.PROVINCE_NAME'
                , 'provinces.PROVINCE_NAME_ENG', 'profiles.firstname', 'profiles.lastname', 'profiles.image_profile')
            ->where('tpye_wp_id', '=',3)
            ->orderBy('id', 'desc')
            ->limit(4)
            ->get();
        foreach ($works3 as $key => $work) {
            $wp_tags = WorkTag::join('tags', 'tags.id', '=', 'work_tags.tag_id')
                ->select('tags.name', 'work_tags.wp_id', 'work_tags.tag_id')
                ->where('wp_id', '=', $work->id)
                ->get();
            $works3[$key]->tags = $wp_tags;
        }
        foreach ($works3 as $key => $work) {
            $Logview = Logview::where('wp_id', $work->id)->get();
            if ($Logview != null) {
                $works3[$key]->sum = count($Logview);
            } else {
                $works3[$key]->sum = 0;
            }
        }
        foreach ($works3 as $key => $work) {
            $wp_comment = WorkComment::where('wp_id', $work->id)->count('wp_id');
            if ($wp_comment != null) {
                $works3[$key]->count = $wp_comment;
            } else {
                $works3[$key]->count = 0;
            }
        }

        //Training
        $training = Training::join('users','users.id','=','trainings.user_id')
            ->join('profiles','profiles.user_id','=','trainings.user_id')
            ->select('trainings.*','users.name as username','profiles.firstname','profiles.lastname'
                ,'profiles.image_profile')
            ->limit(3)
            ->orderBy('id','desc')
            ->get();
        foreach ($training as $key => $item){
            $trainingCount = TrainingLogView::select(DB::raw('sum(count) as total'))
                ->where('training_id','=',$item->id)
                ->groupBy('training_id')
                ->first();
            $training[$key]->total =  ($trainingCount == null)?0:$trainingCount->total;;
            $trainingCountCM = TrainingComment::select(DB::raw('count(training_id) as total'))
                ->where('training_id','=',$item->id)
                ->groupBy('training_id')
                ->first();
            $training[$key]->commentTotal =  ($trainingCountCM == null)?0:$trainingCountCM->total;
        }

        //Course List
        $course_list = CourseList::join('courses','course_lists.course_id','=','courses.id')
            ->select('courses.name','course_lists.*')
            ->where('course_order','=',1)
            ->orderBy('course_id','desc')
            ->limit(3)
            ->get();
        foreach ($course_list as $key => $item){
            $course_listCount = CourseLogView::select(DB::raw('sum(count) as total'))
                ->where('course_list_id','=',$item->id)
                ->groupBy('course_list_id')
                ->first();
            $course_list[$key]->total =  ($course_listCount == null)?0:$course_listCount->total;
            $course_listCM = CourseComment::select(DB::raw('count(course_list_id) as total'))
                ->where('course_list_id','=',$item->id)
                ->groupBy('course_list_id')
                ->first();
            $course_list[$key]->commentTotal =  ($course_listCM == null)?0:$course_listCM->total;
        }

        //Recoommend  อันบนดึงจาก ผู้รับจ้าง/รับเหมาที่ได้ดาวเฉลี่ย4-5
        $recoommend_profile = Profile::where('review_profile','>=',3)
            ->whereRaw('(type_user_id_2 is not null  or type_user_id_3 is not null )')
            ->limit(8)
            ->get();


        //Review Profile
        $arr = [];
        $review_profile = Profile::all();

        foreach ($review_profile as $key => $value){
            $work_postings = WorkPosting::where('profile_id','=',$value->id)
                ->get();
            $review_profile[$key]->work = $work_postings;
        }
        foreach ($review_profile as $key => $value){
            for ($i = 0 ; $i < count($review_profile[$key]->work);$i++){
                $arr[] = $review_profile[$key]->work[$i]['id'];
            }
            $sum_comment = DB::table('work_comments')
                ->select(DB::raw('sum(rate) as  sum_rate'))
                ->join('users', 'users.id', '=', 'work_comments.user_id')
                ->join('profiles', 'profiles.user_id', '=', 'users.id')
                ->whereIn('wp_id', $arr)
                ->first();
            $count_comment = DB::table('work_comments')
                ->select(DB::raw('count(rate) as  count_rate'))
                ->join('users', 'users.id', '=', 'work_comments.user_id')
                ->join('profiles', 'profiles.user_id', '=', 'users.id')
                ->whereIn('wp_id', $arr)
                ->first();
            $sum_rate = $sum_comment->sum_rate;
            $count_rate = $count_comment->count_rate;
            $review_profile[$key]->wp_id = $arr;
            $review_profile[$key]->sum_rate = $sum_rate ;
            $review_profile[$key]->count_rate = $count_rate ;
            if($sum_rate != null && $count_rate != 0){
                $round =  $sum_rate / $count_rate ;
                $review_rate = number_format(round($round,0));
            }else{
                $review_rate = 0 ;
            }
            DB::table('profiles')
                ->where('id','=',$review_profile[$key]->id)
                ->update([
                    'review_profile' => $review_rate
                ]);
            $arr = [];
        }
        $review = Profile::where('review_profile','!=',0)
            ->orderBy('review_profile','desc')
            ->limit(3)
            ->get();

        $courses_trending = Course::where('status',1)->get();

        $courses_recom = Course::where('status',1)->limit(4)->get();


        return view('frontend.index',[
            'home_gellery' => $home_gellery ,
            'works1' => $works1 ,
            'works2' => $works2 ,
            'works3' => $works3 ,
            'user_count_1' =>  ($user_count_1 != "")?$user_count_1:0,
            'user_count_2' =>  ($user_count_2 != "")?$user_count_2:0,
            'user_count_3' =>  ($user_count_3 != "")?$user_count_3:0,
            'search' =>  null,
            'training' =>  $training,
            'course_list' => $course_list ,
            'review' => $review ,
            'recoommend' => $recoommend_profile ,
            'courses_recom' => $courses_recom ,
            'courses_trending' => $courses_trending,
        ]);

    }

    public function search(Request $request)
    {
        $home_gellery = Gallery::where('type','=',1)
            ->where('isActive','=',1)
            ->get();
        $user_count_1 = DB::table('profiles')
            ->select(DB::raw('count(type_user_id) as usertype1'))
            ->first();
        $user_count_2 = DB::table('profiles')
            ->select(DB::raw('count(type_user_id_2) as usertype2'))
            ->first();
        $user_count_3 = DB::table('profiles')
            ->select(DB::raw('count(type_user_id_3) as usertype3'))
            ->first();

        $search = Input::get('q');

        //Training
        $training = Training::join('users','users.id','=','trainings.user_id')
            ->join('profiles','profiles.user_id','=','trainings.user_id')
            ->select('trainings.*','users.name as username','profiles.firstname','profiles.lastname'
                ,'profiles.image_profile')
            ->limit(4)
            ->orderBy('id','desc')
            ->get();
        foreach ($training as $key => $item){
            $trainingCount = TrainingLogView::select(DB::raw('sum(count) as total'))
                ->where('training_id','=',$item->id)
                ->groupBy('training_id')
                ->first();
            $training[$key]->total =  ($trainingCount == null)?0:$trainingCount->total;;
            $trainingCountCM = TrainingComment::select(DB::raw('count(training_id) as total'))
                ->where('training_id','=',$item->id)
                ->groupBy('training_id')
                ->first();
            $training[$key]->commentTotal =  ($trainingCountCM == null)?0:$trainingCountCM->total;
        }

        $course_list = CourseList::join('courses','course_lists.course_id','=','courses.id')
            ->select('courses.name','course_lists.*')
            ->where('course_order','=',1)
            ->orderBy('course_id','desc')
            ->limit(3)
            ->get();
        foreach ($course_list as $key => $item){
            $course_listCount = CourseLogView::select(DB::raw('sum(count) as total'))
                ->where('course_list_id','=',$item->id)
                ->groupBy('course_list_id')
                ->first();
            $course_list[$key]->total =  ($course_listCount == null)?0:$course_listCount->total;
            $course_listCM = CourseComment::select(DB::raw('count(course_list_id) as total'))
                ->where('course_list_id','=',$item->id)
                ->groupBy('course_list_id')
                ->first();
            $course_list[$key]->commentTotal =  ($course_listCM == null)?0:$course_listCM->total;
        }

        //Recoommend  อันบนดึงจาก ผู้รับจ้าง/รับเหมาที่ได้ดาวเฉลี่ย4-5
        $recoommend_profile = Profile::where('review_profile','>=',3)
            ->whereRaw('(type_user_id_2 is not null  or type_user_id_3 is not null )')
            ->limit(8)
            ->get();

        //Review Profile
        $review = Profile::where('review_profile','!=',0)
            ->orderBy('review_profile','desc')
            ->limit(3)
            ->get();

        if($search != null){
            $works1 = WorkPosting::join('tpye_work_postings', 'tpye_work_postings.id', '=', 'work_postings.tpye_wp_id')
                ->join('price_ranges', 'price_ranges.id', '=', 'work_postings.price_range_id')
                ->join('provinces', 'provinces.PROVINCE_ID', '=', 'work_postings.provinces_id')
                ->join('profiles', 'profiles.id', '=', 'work_postings.profile_id')
                ->select('work_postings.*', 'tpye_work_postings.name', 'price_ranges.price', 'provinces.PROVINCE_NAME'
                    , 'provinces.PROVINCE_NAME_ENG', 'profiles.firstname', 'profiles.lastname', 'profiles.image_profile')
                ->where('tpye_wp_id', '=',1)
                ->where('title', 'LIKE','%'.$search.'%')
                ->orderBy('id', 'desc')
                ->limit(4)
                ->get();
            foreach ($works1 as $key => $work) {
                $wp_tags = WorkTag::join('tags', 'tags.id', '=', 'work_tags.tag_id')
                    ->select('tags.name', 'work_tags.wp_id', 'work_tags.tag_id')
                    ->where('wp_id', '=', $work->id)
                    ->get();
                $works1[$key]->tags = $wp_tags;
            }
            foreach ($works1 as $key => $work1) {
                $Logview = Logview::where('wp_id', $work->id)->sum('count');
                if ($Logview != null) {
                    $works1[$key]->sum = $Logview;
                } else {
                    $works1[$key]->sum = 0;
                }
            }
            foreach ($works1 as $key => $work1) {
                $wp_comment = WorkComment::where('wp_id', $work->id)->count('wp_id');
                if ($wp_comment != null) {
                    $works1[$key]->count = $wp_comment;
                } else {
                    $works1[$key]->count = 0;
                }
            }

            // Data Work Posting : หาผู้รับเหมา
            $works2 = WorkPosting::join('tpye_work_postings', 'tpye_work_postings.id', '=', 'work_postings.tpye_wp_id')
                ->join('price_ranges', 'price_ranges.id', '=', 'work_postings.price_range_id')
                ->join('provinces', 'provinces.PROVINCE_ID', '=', 'work_postings.provinces_id')
                ->join('profiles', 'profiles.id', '=', 'work_postings.profile_id')
                ->select('work_postings.*', 'tpye_work_postings.name', 'price_ranges.price', 'provinces.PROVINCE_NAME'
                    , 'provinces.PROVINCE_NAME_ENG', 'profiles.firstname', 'profiles.lastname', 'profiles.image_profile')
                ->where('tpye_wp_id', '=',2)
                ->where('title', 'LIKE','%'.$search.'%')
                ->orderBy('id', 'desc')
                ->limit(4)
                ->get();
            foreach ($works2 as $key => $work) {
                $wp_tags = WorkTag::join('tags', 'tags.id', '=', 'work_tags.tag_id')
                    ->select('tags.name', 'work_tags.wp_id', 'work_tags.tag_id')
                    ->where('wp_id', '=', $work->id)
                    ->get();
                $works2[$key]->tags = $wp_tags;
            }
            foreach ($works2 as $key => $work) {
                $Logview = Logview::where('wp_id', $work->id)->sum('count');
                if ($Logview != null) {
                    $works2[$key]->sum = $Logview;
                } else {
                    $works2[$key]->sum = 0;
                }
            }
            foreach ($works2 as $key => $work) {
                $wp_comment = WorkComment::where('wp_id', $work->id)->count('wp_id');
                if ($wp_comment != null) {
                    $works2[$key]->count = $wp_comment;
                } else {
                    $works2[$key]->count = 0;
                }
            }

            $works3 = WorkPosting::join('tpye_work_postings', 'tpye_work_postings.id', '=', 'work_postings.tpye_wp_id')
                ->join('price_ranges', 'price_ranges.id', '=', 'work_postings.price_range_id')
                ->join('provinces', 'provinces.PROVINCE_ID', '=', 'work_postings.provinces_id')
                ->join('profiles', 'profiles.id', '=', 'work_postings.profile_id')
                ->select('work_postings.*', 'tpye_work_postings.name', 'price_ranges.price', 'provinces.PROVINCE_NAME'
                    , 'provinces.PROVINCE_NAME_ENG', 'profiles.firstname', 'profiles.lastname', 'profiles.image_profile')
                ->where('tpye_wp_id', '=',3)
                ->where('title', 'LIKE','%'.$search.'%')
                ->orderBy('id', 'desc')
                ->limit(4)
                ->get();
            foreach ($works3 as $key => $work) {
                $wp_tags = WorkTag::join('tags', 'tags.id', '=', 'work_tags.tag_id')
                    ->select('tags.name', 'work_tags.wp_id', 'work_tags.tag_id')
                    ->where('wp_id', '=', $work->id)
                    ->get();
                $works3[$key]->tags = $wp_tags;
            }
            foreach ($works3 as $key => $work) {
                $Logview = Logview::where('wp_id', $work->id)->sum('count');
                if ($Logview != null) {
                    $works3[$key]->sum = $Logview;
                } else {
                    $works3[$key]->sum = 0;
                }
            }
            foreach ($works3 as $key => $work) {
                $wp_comment = WorkComment::where('wp_id', $work->id)->count('wp_id');
                if ($wp_comment != null) {
                    $works3[$key]->count = $wp_comment;
                } else {
                    $works3[$key]->count = 0;
                }
            }


            return view('frontend.index',[
                'home_gellery' => $home_gellery ,
                'works1' => $works1 ,
                'works2' => $works2 ,
                'works3' => $works3 ,
                'user_count_1' =>  ($user_count_1 != "")?$user_count_1:0,
                'user_count_2' =>  ($user_count_2 != "")?$user_count_2:0,
                'user_count_3' =>  ($user_count_3 != "")?$user_count_3:0,
                'search' =>  'search',
                'training' =>  $training,
                'course_list' => $course_list ,
                'review' => $review ,
                'recoommend' => $recoommend_profile ,
            ]);
        }else{
            return view('frontend.index',[
                'home_gellery' => $home_gellery ,
                'works1' => $works1 = [] ,
                'works2' => $works2 = [] ,
                'works3' => $works3 = [] ,
                'user_count_1' =>  ($user_count_1 != "")?$user_count_1:0,
                'user_count_2' =>  ($user_count_2 != "")?$user_count_2:0,
                'user_count_3' =>  ($user_count_3 != "")?$user_count_3:0,
                'search' =>  'search',
                'training' =>  $training,
                'course_list' => $course_list ,
                'review' => $review ,
                'recoommend' => $recoommend_profile ,
            ]);
        }
    }

    public function worklist(Request $request)
    {

        $jobs = JobDescription::get();
        return view('frontend/worklist',[
            'jobs'=>$jobs,
        ]);
    }

}
