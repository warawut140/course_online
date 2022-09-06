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

class JobNewController extends Controller
{
    public function job_add()
    {
        return view('frontend.job.job_add');
    }

    public function job_view($id)
    {
        $profile = Profile::where('user_id',Auth::guard('web')->user()->id)->first();
        $data = JobDescription::where('id',$id)->where('profile_id',$profile->id)->first();
        if($data){
            return view('frontend.job.job_add',[
                'data' => $data
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
            return view('frontend/worklist_detail',[
                'job'=>$job,
                'jobs'=>$jobs,
            ]);
        }

    }
}
