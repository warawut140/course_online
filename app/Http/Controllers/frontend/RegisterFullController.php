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
use App\Models\BitCoin;
use File;
use App\Models\JobDescription;
use App\Models\Course;
use App\Models\Education;
use App\Models\WorkEXP;

class RegisterFullController extends Controller
{
    public function index()
    {
        return view('frontend.faq');
    }

    public function register_company_detail($type='')
    {
        $data = Profile::where('user_id',Auth::guard('web')->user()->id)->first();
        $job = JobDescription::where('profile_id',$data->id)->get();
        $course = Course::where('profile_id',$data->id)->get();
            // return view('auth.register_company_detail',[
            //     'type'=>$type,
            //     'data'=>$data,
            //     'job'=>$job,
            //     'course'=>$course,
            // ]);

            return view('frontend_new.register_company_detail',[
                'type'=>$type,
                'data'=>$data,
                'job'=>$job,
                'course'=>$course,
            ]);
    }


    public function interes_course()
    {
        $data_type_course = DB::table('data_type')->where('type',1)->where('recom_status',0)->orderBy('id','asc')->get();
        $data_type_course_recom = DB::table('data_type')->where('type',1)->where('recom_status',1)->orderBy('id','asc')->get();
       return view('frontend.interes_course',[
        'data_type_course' => $data_type_course,
        'data_type_course_recom' => $data_type_course_recom,
       ]);
    }

    public function findjob()
    {
        $data_type_course = DB::table('data_type')->where('type',2)->where('recom_status',0)->orderBy('id','asc')->get();
        $data_type_course_recom = DB::table('data_type')->where('type',2)->where('recom_status',1)->orderBy('id','asc')->get();
       return view('frontend.findjob',[
        'data_type_course' => $data_type_course,
        'data_type_course_recom' => $data_type_course_recom,
       ]);
    }

    public function register_user_detail($type='')
    {
        $data = Profile::select('profiles.*','users.email','users.name as username')->
        join('users','users.id','profiles.user_id')->
        where('profiles.user_id',Auth::guard('web')->user()->id)->first();

        $education = Education::where('user_id',Auth::guard('web')->user()->id)->first();
        if(!$education){
            $education = new Education();
            $education->user_id = Auth::guard('web')->user()->id;
            $education->save();
        }

        $work_exp = WorkEXP::where('user_id',Auth::guard('web')->user()->id)->first();

        if(!$work_exp){
            $work_exp = new WorkEXP();
            $work_exp->user_id = Auth::guard('web')->user()->id;
            $work_exp->save();
        }

            // return view('auth.register_user_detail',[
            //     'type'=>$type,
            //     'data'=>$data,
            //     'education'=>$education,
            //     'work_exp'=>$work_exp,
            // ]);

            return view('frontend_new.register_user_detail',[
                'type'=>$type,
                'data'=>$data,
                'education'=>$education,
                'work_exp'=>$work_exp,
            ]);
    }

    public function register_company_detail_basic_store(Request $r)
    {
        DB::beginTransaction();
        try
        {
// dd($r->all());
        $profile = Profile::where('user_id',Auth::guard('web')->user()->id)->first();

        if($r->type=='basic'){
            $profile->company = $r->company;
            $profile->services = $r->services;
            $profile->emp_number = $r->emp_number;
            $profile->registration_number = $r->registration_number;
            $profile->company_tel = $r->company_tel;
            $profile->day_work = $r->day_work;
            $profile->day_off = $r->day_off;
            $profile->company_address = $r->company_address;
            $profile->bank_name = $r->bank_name;
            $profile->bank_number = $r->bank_number;

            $profile->title_about_me = $r->title_about_me;
            $profile->detail_about_me = $r->detail_about_me;

            if (!empty($r->image_profile)) {
                if ($r->hasFile('image_profile') != '') {
                    File::delete(public_path() . '/images/profile/' . $profile->image_profile);
                    $image_profile = 'profile_'.$profile->id.date('YmdHis').".".$r->file('image_profile')->getClientOriginalExtension();
                    $r->file('image_profile')->move(public_path() . '/images/profile/', $image_profile);
                }
                $profile->image_profile = $image_profile;
    }


            if (!empty($r->company_img1)) {
                if ($r->hasFile('company_img1') != '') {
                    File::delete(public_path() . '/images/profile/' . $profile->company_img1);
                    $company_img1 = 'profile_'.$profile->id.date('YmdHis')."1.".$r->file('company_img1')->getClientOriginalExtension();
                    $r->file('company_img1')->move(public_path() . '/images/profile/', $company_img1);
                }
                $profile->company_img1 = $company_img1;
            }

            if (!empty($r->company_img2)) {
                if ($r->hasFile('company_img2') != '') {
                    File::delete(public_path() . '/images/profile/' . $profile->company_img2);
                    $company_img2 = 'profile_'.$profile->id.date('YmdHis')."2.".$r->file('company_img2')->getClientOriginalExtension();
                    $r->file('company_img2')->move(public_path() . '/images/profile/', $company_img2);
                }
                $profile->company_img2 = $company_img2;
            }

            if (!empty($r->company_img3)) {
                if ($r->hasFile('company_img3') != '') {
                    File::delete(public_path() . '/images/profile/' . $profile->company_img3);
                    $company_img3 = 'profile_'.$profile->id.date('YmdHis')."3.".$r->file('company_img3')->getClientOriginalExtension();
                    $r->file('company_img3')->move(public_path() . '/images/profile/', $company_img3);
                }
                $profile->company_img3 = $company_img3;
            }
        }

        if($r->type=='web'){
            $profile->link_1 = $r->link_1;
            $profile->link_2 = $r->link_2;
            $profile->link_3 = $r->link_3;
            $profile->link_4 = $r->link_4;
        }

        if($r->type=='receive'){
            $profile->applicants = $r->applicants;
            $profile->applicants_email = $r->applicants_email;
        }

        $profile->save();

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
    }


    public function register(Request $r)
    {
        $this->validate($r, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'tel' => ['required', 'string', 'max:20'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'imageProfile' => ['mimes:jpeg,jpg,png,gif|required|max:10000'], // max 10000kb
            // 'fileCard' => ['mimes:jpeg,jpg,png,gif|required|max:10000'], // max 10000kb
            // 'fileProfile' => ['required'],
        ]);

        DB::beginTransaction();
        try
        {

       $user = new User();
       $user->name = $r->name;
       $user->email = $r->email;
       $user->password = Hash::make($r->password);
       $user->created_at = date('Y-m-d H:i:s');
       $user->updated_at = date('Y-m-d H:i:s');
       $user->save();

       $profile = new Profile();
       $profile->firstname = $r->firstname;
       $profile->lastname = $r->lastname;
       $profile->tel = $r->tel;

       if (!empty($r->imageProfile)) {
                if ($r->hasFile('imageProfile') != '') {
                    // File::delete(public_path() . '/images/profile/' . $profile->image_profile);
                    $imageProfile = 'profile_'.date('YmdHis').$r->file('imageProfile')->getClientOriginalName().".".$r->file('imageProfile')->getClientOriginalExtension();
                    $r->file('imageProfile')->move(public_path() . '/images/profile/', $imageProfile);
                }
                $profile->image_profile = $imageProfile;
    }

       $profile->prefix_id = $r->prefixe_id;
       if($r->typeAccount1==1){
        $profile->type_user_id = 1;
       }
       if($r->typeAccount1==2){
        $profile->type_user_id_2 = 2;
       }
       $profile->user_id = $user->id;
       $profile->created_at = date('Y-m-d H:i:s');
       $profile->updated_at = date('Y-m-d H:i:s');
       $profile->save();

       $bitCoin = new BitCoin();
       $bitCoin->profile_id  = $profile->id;
       $bitCoin->coins = 2000;
       $bitCoin->created_at = date('Y-m-d H:i:s');
       $bitCoin->updated_at = date('Y-m-d H:i:s');
       $bitCoin->save();

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

       Auth::guard('web')->login($user);

       if($r->typeAccount1==2){
        return redirect()->to('register_company_detail');
    }

    if($r->typeAccount1==1){
        // return redirect()->to('interes_course');
        return redirect()->to('register_user_detail');
    }
        // $request->session()->flash('success', 'สำเร็จ');
        // return redirect()->to('register_company_detail');
        // return view('frontend.faq');
    }

    public function register_student_detail_basic_store(Request $r)
    {
        DB::beginTransaction();
        try
        {

        $profile = Profile::where('user_id',Auth::guard('web')->user()->id)->first();

        if($r->type=='basic'){
            $profile->firstname = $r->firstname;
            $profile->lastname = $r->lastname;
            $profile->title_me = $r->title_me;
            $profile->tel = $r->tel;
            $profile->date_of_birth = $r->date_of_birth;
            $profile->company_address = $r->company_address;

            if (!empty($r->image_profile)) {
                if ($r->hasFile('image_profile') != '') {
                    File::delete(public_path() . '/images/profile/' . $profile->image_profile);
                    $image_profile = 'profile_'.$profile->id.".".$r->file('image_profile')->getClientOriginalExtension();
                    $r->file('image_profile')->move(public_path() . '/images/profile/', $image_profile);
                }
                $profile->image_profile = $image_profile;
    }

        $user = User::where('id',Auth::guard('web')->user()->id)->first();
        $user->name = $r->username;
        $user->email = $r->email;
        if($r->password!=''){
            $user->password = Hash::make($r->password);
        }
        $user->save();
}

        if($r->type=='web'){
            $profile->link_1 = $r->link_1;
            $profile->link_2 = $r->link_2;
            $profile->link_3 = $r->link_3;
            $profile->link_4 = $r->link_4;
        }

        if($r->type=='job'){
            $profile->title_about_me = $r->title_about_me;
            $profile->detail_about_me = $r->detail_about_me;

                        if (!empty($r->rasume1)) {
                            if ($r->hasFile('rasume1') != '') {
                                File::delete(public_path() . '/images/profile/' . $profile->rasume1);
                                $rasume1 = 'rasume1_'.$profile->id.".".$r->file('rasume1')->getClientOriginalExtension();
                                $r->file('rasume1')->move(public_path() . '/images/profile/', $rasume1);
                            }
                            $profile->rasume1 = $rasume1;
                }

                if (!empty($r->portfolio1)) {
                    if ($r->hasFile('portfolio1') != '') {
                        File::delete(public_path() . '/images/profile/' . $profile->portfolio1);
                        $portfolio1 = 'portfolio1_'.$profile->id.".".$r->file('portfolio1')->getClientOriginalExtension();
                        $r->file('portfolio1')->move(public_path() . '/images/profile/', $portfolio1);
                    }
                    $profile->portfolio1 = $portfolio1;
        }

            //     if (!empty($r->rasume2)) {
            //         if ($r->hasFile('rasume2') != '') {
            //             File::delete(public_path() . '/images/profile/' . $profile->rasume2);
            //             $rasume2 = 'rasume2_'.$profile->id.".".$r->file('rasume2')->getClientOriginalExtension();
            //             $r->file('rasume2')->move(public_path() . '/images/profile/', $rasume2);
            //         }
            //         $profile->rasume2 = $rasume2;
            // }

        }

        if($r->type=='education'){
            $education = Education::where('user_id',Auth::guard('web')->user()->id)->first();
            $education->academy = $r->academy;
            $education->level = $r->level;
            $education->major = $r->major;
            $education->date_start = $r->date_start;
            $education->date_end = $r->date_end;
            $education->grade = $r->grade;
            $education->save();
        }

        if($r->type=='work_exp'){
            $work_exp = WorkEXP::where('user_id',Auth::guard('web')->user()->id)->first();
            $work_exp->name = $r->name;
            $work_exp->web = $r->web;
            $work_exp->address = $r->address;
            $work_exp->position = $r->position;
            $work_exp->start_date = $r->start_date;
            $work_exp->end_date = $r->end_date;
            $work_exp->detail = $r->detail;
            $work_exp->save();
        }

        $profile->save();

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
    }

}
