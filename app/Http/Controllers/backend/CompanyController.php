<?php

namespace App\Http\Controllers\backend;

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

class CompanyController extends Controller
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
        $students = Profile::where('type_user_id_2',2)->orderBy('id','desc')->get();
        // dd($students);
        return view('backend.company.index',[
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
        //
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
                    $image_profile = 'profile_'.$profile->id.".".$r->file('image_profile')->getClientOriginalExtension();
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = Profile::where('id',$id)->first();
        $type = '';
        if($data){
            $job = JobDescription::where('profile_id',$data->id)->get();
            $course = Course::where('profile_id',$data->id)->get();
            return view('backend.company.view',[
                'data'=>$data,
                'job'=>$job,
                'course'=>$course,
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
