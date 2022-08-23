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
            return view('auth.register_company_detail',[
                'type'=>$type,
                'data'=>$data,
                'job'=>$job,
                'course'=>$course,
            ]);
    }


    public function register_user_detail($type='')
    {
            return view('auth.register_user_detail',[
                'type'=>$type,
            ]);
    }

    public function register_company_detail_basic_store(Request $r)
    {
        DB::beginTransaction();
        try
        {

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
                    File::delete(public_path() . '/images/profile/' . $profile->image_profile);
                    $imageProfile = 'profile_'.$profile->id.".".$r->file('imageProfile')->getClientOriginalExtension();
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
        return redirect()->to('/');
    }
        // $request->session()->flash('success', 'สำเร็จ');
        // return redirect()->to('register_company_detail');
        // return view('frontend.faq');
    }
}
