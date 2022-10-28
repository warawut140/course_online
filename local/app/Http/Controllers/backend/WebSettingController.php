<?php

namespace App\Http\Controllers\backend;

use App\Models\Profile;
use App\Models\ProjectAuction;
use App\Models\Suggests;
use App\Models\WorkPosting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use App\User;
use File;
use App\Models\Course;
use App\Models\JobDescription;
use App\Models\JobRegister;

class WebSettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function banner()
    {
        $banners = DB::table('banner_index')->where('status',1)->orderBy('id','desc')->get();
        return view('backend.web_setting.banner',[
            'banners'=>$banners,
        ]);
    }

    public function display_course()
    {
        $course = Course::get();
        return view('backend.web_setting.display_course',[
            'course'=>$course,
        ]);
    }

    public function display_work()
    {
        $job = JobDescription::get();
        return view('backend.web_setting.display_work',[
            'job'=>$job,
        ]);
    }

    public function display_course_view($id)
    {
        $data = Course::where('id',$id)->first();
        if(!$data){
            return redirect()->back()->with('error','ไม่พบข้อมูลทำรายการ');
        }
        return view('backend.web_setting.display_course_view',[
            'data'=>$data,
        ]);
    }

    public function display_work_view($id)
    {
        $data = JobDescription::where('id',$id)->first();
        if(!$data){
            return redirect()->back()->with('error','ไม่พบข้อมูลทำรายการ');
        }
        return view('backend.web_setting.display_work_view',[
            'data'=>$data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function banner_add()
    {
        return view('backend.web_setting.banner_add');
    }

    public function banner_view($id)
    {
        $data = DB::table('banner_index')->where('id',$id)->first();
        if(!$data){
            return redirect()->back()->with('error','ไม่พบข้อมูลทำรายการ');
        }
        return view('backend.web_setting.banner_add',[
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function banner_store(Request $r)
    {
        DB::beginTransaction();
        try
        {
            if(!$r->data_id){
                $data_image = '';
                    if ($r->hasFile('image')) {
                        // File::delete(public_path() . '/images/banner/' . $profile->image);
                        $image2 = 'banner_'.date('Y_m_d_H_i_s').".".$r->file('image')->getClientOriginalExtension();
                        $r->file('image')->move(public_path() . '/images/banner/', $image2);
                        $data_image = $image2;
                    }

            DB::table('banner_index')->insert([
                'name' => $r->name,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => @Auth::user()->id,
                'image' => $data_image,
            ]);

    }else{
        $data = DB::table('banner_index')->where('id',$r->data_id)->first();
        if($data){
            $data_image = $data->image;
            if ($r->hasFile('image')) {
                File::delete(public_path() . '/images/banner/' . $data->image);
                $image2 = 'banner_'.date('Y_m_d_H_i_s').".".$r->file('image')->getClientOriginalExtension();
                $r->file('image')->move(public_path() . '/images/banner/', $image2);
                $data_image = $image2;
            }
                DB::table('banner_index')->where('id',$r->data_id)->update([
                    'name' => $r->name,
                    // 'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'user_id' => @Auth::user()->id,
                    'image' => $data_image,
                ]);
        }else{
            return redirect()->back()->with('error','ไม่พบข้อมูลทำรายการ');
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

        return redirect()->to('admin/banner')->with('success','บันทึกข้อมูลสำเร็จ');
    }

    public function display_course_store(Request $r)
    {
        DB::beginTransaction();
        try
        {

        $data = DB::table('courses')->where('id',$r->data_id)->first();
        if($data){
            // $data_image = $data->image;
            // if ($r->hasFile('image')) {
            //     File::delete(public_path() . '/images/banner/' . $data->image);
            //     $image2 = 'banner_'.date('Y_m_d_H_i_s').".".$r->file('image')->getClientOriginalExtension();
            //     $r->file('image')->move(public_path() . '/images/banner/', $image2);
            //     $data_image = $image2;
            // }
                DB::table('courses')->where('id',$r->data_id)->update([
                    // 'name' => $r->name,
                    // 'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'status' => $r->status,
                    // 'user_id' => @Auth::user()->id,
                    // 'image' => $data_image,
                ]);
        }else{
            return redirect()->back()->with('error','ไม่พบข้อมูลทำรายการ');
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

        return redirect()->to('admin/display_course')->with('success','บันทึกข้อมูลสำเร็จ');
    }

    public function display_work_store(Request $r)
    {
        DB::beginTransaction();
        try
        {

        $data = DB::table('job_description')->where('id',$r->data_id)->first();
        if($data){
            // $data_image = $data->image;
            // if ($r->hasFile('image')) {
            //     File::delete(public_path() . '/images/banner/' . $data->image);
            //     $image2 = 'banner_'.date('Y_m_d_H_i_s').".".$r->file('image')->getClientOriginalExtension();
            //     $r->file('image')->move(public_path() . '/images/banner/', $image2);
            //     $data_image = $image2;
            // }
                DB::table('job_description')->where('id',$r->data_id)->update([
                    // 'name' => $r->name,
                    // 'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'status' => $r->status,
                    // 'user_id' => @Auth::user()->id,
                    // 'image' => $data_image,
                ]);
        }else{
            return redirect()->back()->with('error','ไม่พบข้อมูลทำรายการ');
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

        return redirect()->to('admin/display_work')->with('success','บันทึกข้อมูลสำเร็จ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Profile::select('profiles.*','users.email','users.name as username')->
        join('users','users.id','profiles.user_id')->
        where('profiles.id',$id)->first();
        $type = '';
        if($data){
            return view('backend.student.view',[
                'data'=>$data,
                'type'=>$type,
            ]);
        }else{
            return redirect()->back()->with('error','ไม่พบข้อมูลทำรายการ');
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
        //
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
}
