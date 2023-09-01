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

class StudentController extends Controller
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
    public function index()
    {
        $students = Profile::where('type_user_id',1)->orderBy('id','desc')->get();
        return view('backend.student.index',[
            'students'=>$students,
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
    public function store(Request $r)
    {
        DB::beginTransaction();
        try
        {

        $profile = Profile::where('id',$r->data_id)->first();
        if(!$profile){
            return redirect()->back()->with('error','ไม่พบข้อมูล');
        }

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
