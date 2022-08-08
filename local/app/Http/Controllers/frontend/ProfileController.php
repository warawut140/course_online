<?php

namespace App\Http\Controllers\frontend;

use App\Models\Answers;
use App\Models\BitCoin;
use App\Models\CourseList;
use App\Models\Logview;
use App\Models\Prefix;
use App\Models\Profile;
use App\Models\ProjectAuction;
use App\Models\Provinces;
use App\Models\Questions;
use App\Models\TypeUser;
use App\Models\WorkComment;
use App\Models\WorkMgmt;
use App\Models\WorkPosting;
use App\Models\WorkTag;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $profile = Profile::join('bit_coins','bit_coins.profile_id','profiles.id')
                ->join('users','users.id','=','profiles.user_id')
                ->select('profiles.*','bit_coins.coins','users.name as username','users.email')
                ->where('profiles.user_id','=', Auth::user()->id)
                ->first();
        $typeUser1 = ($profile->type_user_id != null)?"ผู้ว่าจ้าง":'';
        $typeUser1_1 = ($profile->type_user_id != null && $profile->type_user_id_2 != null)?"/":'';
        $typeUser1_13 = ($profile->type_user_id != null && $profile->type_user_id_3 != null)?"/":'';
        $typeUser2 = ($profile->type_user_id_2 != null)?"ผู้รับจ้าง":'';
        $typeUser2_1 = ($profile->type_user_id_2 != null && $profile->type_user_id_3 != null)?"/":'';
        $typeUser3 = ($profile->type_user_id_3 != null)?"ผู้รับเหมา":'';
        $typeUser = $typeUser1.''.$typeUser1_1.''.$typeUser1_13.''.$typeUser2.''.$typeUser2_1.''.$typeUser3;

        //จังหวัด
        $provinces = Provinces::orderBy('PROVINCE_NAME')->pluck('PROVINCE_NAME', 'PROVINCE_ID');
//        dd($profile);

        $works_all = WorkMgmt::where('owner_id',$profile->user_id)->whereIn('status',[4,5])->get();
        $works_success = WorkMgmt::where('owner_id',$profile->user_id)->where('status',4)->get();

        $portfolio_all = count($works_all);
        $portfolio_success = count($works_success);
        $percent = 0;
        if ($portfolio_success != null || $portfolio_success = 0) {
            $percent = (100 / $portfolio_all) * $portfolio_success;
        }


        //อบรม


        //สอบออนไลน์
        //-- courses  สำหรับผู้ว่าจ้าง => 2 , สำหรับผู้รับจ้าง => 3 , สำหรับผู้รับเหมา => 4
        $courses2 = $this->checkCourseOnline(2);
        $courses3 = $this->checkCourseOnline(3);
        $courses4 = $this->checkCourseOnline(4);


        //ประวัติการเข้าสอบ
        $course_count = DB::table('answer_checktime')
            ->where('user_id','=',Auth::user()->id)
            ->count();
        $take = ($course_count > 5) ? $course_count - 5 : 0;

        $courseAnswer = DB::table('answer_checktime')
            ->join('course_lists','answer_checktime.course_list_id','=','course_lists.id')
            ->select('answer_checktime.*','course_lists.course_name')
            ->where('user_id','=',Auth::user()->id)
            ->orderBy('id', 'DESC')
            ->limit(5)
            ->get();



        foreach ($courseAnswer as $key => $value){
            $question_sum = Questions::where('course_list_id',$value->course_list_id)->count();
            $courseAnswer[$key]->question_sum  = $question_sum ;
            $answer_null  = Answers::where('idcheck',$value->id)->where('pass',null)->count();
            if($answer_null == 0){
                $answer_sum  = Answers::where('idcheck',$value->id)->count();
                $answer_pass  = Answers::where('idcheck',$value->id)->where('pass',0)->count();
                $courseAnswer[$key]->answer_sum  = $answer_sum ;
                $courseAnswer[$key]->answer_pass  = $answer_pass ;
                if($answer_sum!=0){
                    $percent = (100 / $answer_sum) * $answer_pass;
                }else{
                    $percent = (100 / 1) * $answer_pass;
                }
                $courseAnswer[$key]->answer_percent = $percent;
                if($percent > 70){
                    $courseAnswer[$key]->answer_text = "สอบผ่าน";
                    $courseAnswer[$key]->answer_css = "success";
                }else{
                    $courseAnswer[$key]->answer_text = "สอบยังไม่ผ่าน";
                    $courseAnswer[$key]->answer_css = "danger";
                }
            }else{
                $courseAnswer[$key]->answer_sum  = 0 ;
                $courseAnswer[$key]->answer_percent = 0;
                $courseAnswer[$key]->answer_text = "กำลังตรวจสอบ";
                $courseAnswer[$key]->answer_css = "warning";
            }
        }

        $courseAnswer_skip = DB::table('answer_checktime')
            ->join('course_lists','answer_checktime.course_list_id','=','course_lists.id')
            ->select('answer_checktime.*','course_lists.course_name')
            ->where('user_id','=',Auth::user()->id)
            ->orderBy('id', 'DESC')
            ->take($take)
            ->skip(4)
            ->get();
        foreach ($courseAnswer_skip as $key => $value){
            $question_sum = Questions::where('course_list_id',$value->course_list_id)->count();
            $courseAnswer_skip[$key]->question_sum  = $question_sum ;
            $answer_null  = Answers::where('idcheck',$value->id)->where('pass',null)->count();
            if($answer_null == 0){
                $answer_sum  = Answers::where('idcheck',$value->id)->count();
                $answer_pass  = Answers::where('idcheck',$value->id)->where('pass',0)->count();
                $courseAnswer_skip[$key]->answer_sum  = $answer_sum ;
                $courseAnswer_skip[$key]->answer_pass  = $answer_pass ;
                $percent = (100 / $answer_sum) * $answer_pass;
                $courseAnswer_skip[$key]->answer_percent = $percent;
                if($percent > 70){
                    $courseAnswer_skip[$key]->answer_text = "สอบผ่าน";
                    $courseAnswer_skip[$key]->answer_css = "success";
                }else{
                    $courseAnswer_skip[$key]->answer_text = "สอบยังไม่ผ่าน";
                    $courseAnswer_skip[$key]->answer_css = "danger";
                }
            }else{
                $courseAnswer_skip[$key]->answer_sum  = 0 ;
                $courseAnswer_skip[$key]->answer_percent = 0;
                $courseAnswer_skip[$key]->answer_text = "กำลังตรวจสอบ";
                $courseAnswer_skip[$key]->answer_css = "warning";
            }
        }


        //งานของฉัน : TB => Work
        // Data Work Posting
        $works = WorkPosting::join('tpye_work_postings', 'tpye_work_postings.id', '=', 'work_postings.tpye_wp_id')
            ->join('price_ranges', 'price_ranges.id', '=', 'work_postings.price_range_id')
            ->join('provinces', 'provinces.PROVINCE_ID', '=', 'work_postings.provinces_id')
            ->join('profiles', 'profiles.id', '=', 'work_postings.profile_id')
            ->select('work_postings.*', 'tpye_work_postings.name', 'price_ranges.price', 'provinces.PROVINCE_NAME'
                , 'provinces.PROVINCE_NAME_ENG', 'profiles.firstname', 'profiles.lastname', 'profiles.image_profile')
            ->where('work_postings.profile_id','=',$profile->id)
            ->orderBy('id', 'desc')
            ->paginate(6, ['*'], 'page_work');
        foreach ($works as $key => $work) {
            $wp_tags = WorkTag::join('tags', 'tags.id', '=', 'work_tags.tag_id')
                ->select('tags.name', 'work_tags.wp_id', 'work_tags.tag_id')
                ->where('wp_id', '=', $work->id)
                ->get();
            $works[$key]->tags = $wp_tags;
        }
        foreach ($works as $key => $work) {
            $Logview = Logview::where('wp_id', $work->id)->get();
            if ($Logview != null) {
                $works[$key]->sum = count($Logview);
            } else {
                $works[$key]->sum = 0;
            }

        }
        foreach ($works as $key => $work) {
            $wp_comment = WorkComment::where('wp_id', $work->id)->count('wp_id');
            if ($wp_comment != null) {
                $works[$key]->count = $wp_comment;
            } else {
                $works[$key]->count = 0;
            }
        }

        //โครงการของฉัน : TB => project_auctions
        $projectAuction = ProjectAuction::join('price_ranges', 'price_ranges.id', '=', 'project_auctions.price_ranges_id')
            ->join('provinces', 'provinces.PROVINCE_ID', '=', 'project_auctions.provinces_id')
            ->join('amphures', 'amphures.AMPHUR_ID', '=', 'project_auctions.amphures_id')
            ->join('districts', 'districts.DISTRICT_ID', '=', 'project_auctions.districts_id')
            ->join('users', 'users.id', '=', 'project_auctions.user_id')
            ->join('type_project_auctions', 'type_project_auctions.id', '=', 'project_auctions.type_project_id')
            ->select('project_auctions.*', 'price_ranges.price',
                'provinces.PROVINCE_NAME as provinces',
                'amphures.AMPHUR_NAME as amphures',
                'districts.DISTRICT_NAME as districts',
                'users.name as username', 'type_project_auctions.name as type_project')
            ->where('project_auctions.profile_id','=',$profile->id)
            ->orderby('project_auctions.countDown', 'asc')
            ->orderby('project_auctions.id', 'desc')
            ->paginate(6, ['*'], 'page_project');
            
        foreach ($projectAuction as $key => $value) {
            $Logview1 = DB::table('project_auctions_air')->where('project_id', $value->id)->get();
            $projectAuction[$key]->sum = count($Logview1);
            $Logview2 = DB::table('project_auctions_logview')->where('project_id', $value->id)->get();
            $projectAuction[$key]->view = count($Logview2);
            $LogData = DB::table('project_auctions_air')->where('project_id', $value->id)
                ->where('status_budding','=',2)
                ->first();
            if($LogData != null){
                $profileBudding  = Profile::where('user_id','=',$LogData->user_id)->first();
                $projectAuction[$key]->name_budding = "$profileBudding->firstname $profileBudding->lastname";
            }else{
                $projectAuction[$key]->name_budding = "";
            }

            // dd($projectAuction[$key]);
        }


//        dd($profile);
        return view('frontend.profile_employee',[
            'profile' => $profile ,
            'typeUser' => $typeUser ,
            'portfolio_success' => $portfolio_success ,
            'percent' => $percent ,
            'provinces' => $provinces ,
            'works' => $works ,
            'projectAuction' => $projectAuction ,
            'courseAnswer' => $courseAnswer ,
            'courseAnswer_skip' => $courseAnswer_skip ,
            'courses2' => $courses2 ,
            'courses3' => $courses3 ,
            'courses4' => $courses4 ,
        ]);
    }

    public function update(Request $request, $id)
    {
        $now = new DateTime();
        $profile = Profile::find($id);
        $type = $request->type ;

        if($type == 1){
            if (!empty($request->image_profile)) {
                if ($request->hasFile('image_profile') != '') {
                    File::delete(public_path() . '/images/profile/' . $profile->image_profile);
                    $imageProfile = 'profile_'.$profile->id.".".$request->file('image_profile')->getClientOriginalExtension();
                    $request->file('image_profile')->move(public_path() . '/images/profile/', $imageProfile);
                }
            }else{
                $imageProfile = $profile->image_profile ;
            }
            $profile->firstname = $request->firstname;
            $profile->lastname = $request->lastname;
            $profile->tel = $request->tel;
            $profile->birthday = $request->birthday;
            $profile->provinces_id = $request->provinces_id;
            $profile->image_profile = $imageProfile;
            $profile->updated_at = $now;
            $profile->update();

            $user_login = User::find($profile->user_id);
            $user_login->name = $request->username;
            $user_login->email = $request->email;
            if (!empty($request->password)) {
                $user_login->password = Hash::make($request->password);
            }
            $user_login->updated_at = $now;
            $user_login->update();
            Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
            return redirect('profile');
        }elseif ($type == 2){
            if ($request->hasFile('fileCard') != '') {
                if($profile->image_card != null){
                    File::delete(public_path() . '/images/profile/card/' . $profile->image_card);
                }

                $fileCard = 'fileCard_'.$profile->user_id.".".$request->file('fileCard')->getClientOriginalExtension();
                $request->file('fileCard')->move(public_path() . '/images/profile/card/', $fileCard);
                $profile->image_card = $fileCard;
                $profile->updated_at = $now;
                $profile->update();
                Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
                return redirect('profile');
            }else{
                return redirect('profile');
            }
        }elseif ($type == 3){
            $profile->company = $request->company;
            $profile->details = $request->details;
            $profile->updated_at = $now;
            $profile->update();
            Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
            return redirect('profile');
        }elseif ($type == 4){
            if ($request->hasFile('filename_reference') != '') {
                if($profile->filename_reference != null){
                    File::delete(public_path() . '/images/profile/reference/' . $profile->filename_reference);
                }
                $fileProfile = 'filenameReference_'.$profile->user_id.".".$request->file('filename_reference')->getClientOriginalExtension();
                $request->file('filename_reference')->move(public_path() . '/images/profile/reference/', $fileProfile);
                $profile->filename_reference = $fileProfile;
            }
            if ($request->hasFile('filename_award') != '') {
                if($profile->filename_award != null){
                    File::delete(public_path() . '/images/profile/reference/' . $profile->filename_award);
                }
                $fileProfile = 'filenameAward_'.$profile->user_id.".".$request->file('filename_award')->getClientOriginalExtension();
                $request->file('filename_award')->move(public_path() . '/images/profile/reference/', $fileProfile);
                $profile->filename_award = $fileProfile;
            }
            if ($request->hasFile('filename_diploma') != '') {
                if($profile->filename_diploma != null){
                    File::delete(public_path() . '/images/profile/reference/' . $profile->filename_diploma);
                }
                $fileProfile = 'filenameDiploma_'.$profile->user_id.".".$request->file('filename_diploma')->getClientOriginalExtension();
                $request->file('filename_diploma')->move(public_path() . '/images/profile/reference/', $fileProfile);
                $profile->filename_diploma = $fileProfile;
            }
            $profile->updated_at = $now;
            $profile->update();
            Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
            return redirect('profile');
        }
    }

    public function checkCourseOnline($id)
    {
        $CourseList = CourseList::where('course_id',$id)->get();
        $percent_course = 0;
        if(count($CourseList) > 0){
            // Search % Course Answer
            foreach ($CourseList as $key => $value)
            {
                $percent = (100 / count($CourseList));
                $CourseList[$key]->percent  = $percent ;
                // คำถามทั้งหมด
                $question_sum = Questions::where('course_list_id',$value->id)->count();
                $CourseList[$key]->question_sum  = $question_sum ;
                // คำตอบ
                $courseAnswer = DB::table('answer_checktime')
                    ->join('course_lists','answer_checktime.course_list_id','=','course_lists.id')
                    ->select('answer_checktime.*','course_lists.course_name')
                    ->where('user_id','=',Auth::user()->id)
                    ->where('course_list_id','=',$value->id)
                    ->orderBy('id', 'DESC')
                    ->first();
                $CourseList[$key]->courseAnswer = $courseAnswer ;
                if ($courseAnswer != null){
                    // หาข้อที่ผ่าน และ ต้องตรวจแล้ว  Null
                    $answer_null  = Answers::where('idcheck',$courseAnswer->id)->where('pass',null)->count();
                    if($answer_null == 0) {

                        $answer_sum = Answers::where('idcheck', $courseAnswer->id)->count();
                        $answer_pass = Answers::where('idcheck', $courseAnswer->id)->where('pass', 0)->count();
                        $percent = (100 / $answer_sum) * $answer_pass;

                        $CourseList[$key]->answer_sum  = $answer_sum ;
                        $CourseList[$key]->answer_pass  = $answer_pass ;
                        $CourseList[$key]->answer_pass  = $percent ;
                        if($percent > 70){
                            $CourseList[$key]->answer_text = "สอบผ่าน";
                            $CourseList[$key]->answer_pass = true;
                        }else{
                            $CourseList[$key]->answer_text = "สอบยังไม่ผ่าน";
                            $CourseList[$key]->answer_pass = false;
                        }
                    }
                }else{
                    $CourseList[$key]->answer_text = "ยังไม่สอบ";
                    $CourseList[$key]->answer_pass = false;
                }
            }
            // Check Answer if (True) add Percent
            foreach ($CourseList as $key => $value){
                if($value->answer_pass == true){
                    $percent_course = $percent_course + $value->percent ;
                }
            }
        }
        return $percent_course;
    }

    public function addProfile()
    {
        $prefixes = Prefix::pluck('name','id');
        return view('auth.add-profile',[
            'prefixes' => $prefixes
        ]);
    }

    public function registerProfile(Request $request)
    {
        $profiles = new Profile();
        $now = new DateTime();
        $profiles->prefix_id = $request->prefixe_id;
        $profiles->firstname = $request->firstname;
        $profiles->lastname = $request->lastname;
        $profiles->tel = $request->tel;

        if ($request->hasFile('imageProfile') != '') {
            $imageProfile = 'profile_'.Auth::user()->id.".".$request->file('imageProfile')->getClientOriginalExtension();
            $request->file('imageProfile')->move(public_path() . '/images/profile/', $imageProfile);
        }else{
            $imageProfile = null ;
        }
        $profiles->image_profile = $imageProfile;
        if ($request->hasFile('fileCard') != '') {
            $fileCard = 'fileCard_'.Auth::user()->id.".".$request->file('fileCard')->getClientOriginalExtension();
            $request->file('fileCard')->move(public_path() . '/images/profile/card/', $fileCard);
        }else{
            $fileCard = null ;
        }
        $profiles->image_card = $fileCard;
        if ($request->hasFile('fileProfile') != '') {
            $fileProfile = 'filenameReference_'.Auth::user()->id.".".$request->file('fileProfile')->getClientOriginalExtension();
            $request->file('fileProfile')->move(public_path() . '/images/profile/reference/', $fileProfile);
        }else{
            $fileProfile = null ;
        }
        $profiles->filename_reference = $fileProfile;
        if ($request->hasFile('filename_award') != '') {
            $fileProfile = 'filenameAward_'.Auth::user()->id.".".$request->file('filename_award')->getClientOriginalExtension();
            $request->file('filename_award')->move(public_path() . '/images/profile/reference/', $fileProfile);
        }else{
            $fileProfile = null ;
        }

        if ($request->hasFile('filename_diploma') != '') {
            $fileProfile = 'filenameDiploma_'.Auth::user()->id.".".$request->file('filename_diploma')->getClientOriginalExtension();
            $request->file('filename_diploma')->move(public_path() . '/images/profile/reference/', $fileProfile);
        }else{
            $fileProfile = null ;
        }
        $profiles->type_user_id = $request->typeAccount1;
        $profiles->type_user_id_2 = $request->typeAccount2;
        $profiles->type_user_id_3 = $request->typeAccount3;
        if($profiles->type_user_id_2 != null){
            $profiles->type_user_sub_id = $request->typeUser;
        }else{
            $profiles->type_user_sub_id = null ;
        }
        $profiles->latitude = $request->lat_value ;
        $profiles->longitude = $request->lon_value ;
        $profiles->zoom = $request->zoom_value ;
        $profiles->company = $request->company;
        $profiles->details = $request->details;
        $profiles->user_id = Auth::user()->id;
        $profiles->created_at = $now;
        $profiles->updated_at = null;
        $profiles->save();


        $bitCoin = new BitCoin();
        $bitCoin->profile_id = $profiles->id ;
        $bitCoin->coins = 2000 ;
        $bitCoin->created_at = $now;
        $bitCoin->updated_at = null;
        $bitCoin->save();
        Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
        return redirect('index');
    }

}
