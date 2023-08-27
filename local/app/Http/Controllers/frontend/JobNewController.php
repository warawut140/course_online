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
use App\Models\JobDescription;
use App\Models\Course;
use App\Models\JobRegister;
use File;

class JobNewController extends Controller
{
    public function job_add()
    {
        $courses = Course::where('status',1)->orderBy('name','asc')->get();
        return view('frontend.job.job_add',[
            'courses' => $courses
        ]);
    }

    public function job_view($id)
    {
        $profile = Profile::where('user_id',Auth::guard('web')->user()->id)->first();
        $data = JobDescription::where('id',$id)->where('profile_id',$profile->id)->first();
        $courses = Course::where('status',1)->orderBy('name','asc')->get();
        if($data){
            return view('frontend.job.job_add',[
                'data' => $data,
                'courses' => $courses
            ]);
        }else{
            return redirect()->back()->with('error','ไม่พบข้อมูล');
        }
    }

    public function job_delete($id)
    {
        $profile = Profile::where('user_id',Auth::guard('web')->user()->id)->first();
        if($profile){
            $data = JobDescription::where('id',$id)->where('profile_id',$profile->id)->delete();
            return redirect()->to('register_company_detail/job')->with('success','ทำรายการสำเร็จ');
        }else{
            return redirect()->to('register_company_detail/job')->with('error','ไม่พบข้อมูล');
        }

    }

    public function job_store(Request $r)
    {
        DB::beginTransaction();
        try
        {
            $profile = Profile::where('user_id',Auth::guard('web')->user()->id)->first();
            if($profile){
                if($r->job_id!=''){
                    $job = JobDescription::where('id',$r->job_id)->where('profile_id',$profile->id)->first();
                    if(!$job){
                        return redirect()->back()->with('error','ไม่พบข้อมูล');
                    }
                }else{
                    $job = new JobDescription();
                }

                $course_id_for_job = "";
                if($r->course_id_for_job){
                    $course_id_for_job = implode(',',$r->course_id_for_job);
                }

                $job->profile_id = $profile->id;
                $job->position = $r->position;
                $job->level = $r->level;
                $job->number_emp = $r->number_emp;
                $job->location = $r->location;
                $job->job_detail = $r->job_detail;
                $job->skill_detail = $r->skill_detail;
                $job->salary_type = $r->salary_type;
                $job->salary = $r->salary;
                $job->payment_period = $r->payment_period;
                $job->course_id_for_job = $course_id_for_job;
                $job->save();
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
    }

    public function worklist_detail($id)
    {
        $profile = Profile::where('user_id',Auth::guard('web')->user()->id)->first();
        if($profile){
            $job = JobDescription::where('id',$id)->first();
            $jobs = JobDescription::get();
            // return view('frontend/worklist_detail',[
            //     'job'=>$job,
            //     'jobs'=>$jobs,
            //     'profile'=>$profile,
            // ]);
            return view('frontend_new/worklist_detail',[
                'job'=>$job,
                'jobs'=>$jobs,
                'profile'=>$profile,
            ]);
        }

    }

    public function worklist_detail_register($id)
    {
        $profile = Profile::where('user_id',Auth::guard('web')->user()->id)->first();
        if($profile){
            $job = JobDescription::where('id',$id)->first();
            $jobs = JobDescription::get();
            return view('frontend/worklist_detail_register',[
                'job'=>$job,
                'jobs'=>$jobs,
                'profile'=>$profile,
            ]);
        }

    }

    public function worklist_detail_register_store(Request $r)
    {
        DB::beginTransaction();
        try
        {
            $profile = Profile::where('user_id',Auth::guard('web')->user()->id)->first();
            if($profile){
                $job_register = new JobRegister();
                $job_register->profile_id = $profile->id;
                $job_register->job_description_id = $r->job_description_id;
                $job_register->email = $r->email;
                $job_register->tel = $r->tel;

                if (!empty($r->resume)) {
                    if ($r->hasFile('resume') != '') {
                        File::delete(public_path() . '/images/profile/' . $job_register->resume);
                        $resume = 'profile_'.date('YmdHis').$r->file('resume')->getClientOriginalName()."resume.".$r->file('resume')->getClientOriginalExtension();
                        $r->file('resume')->move(public_path() . '/images/profile/', $resume);
                    }
                    $job_register->resume = $resume;
                }

                $job_register->save();

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

        return redirect()->to('worklist_detail/'.$r->job_description_id)->with('success','บันทึกข้อมูลสำเร็จ');
    }

}
