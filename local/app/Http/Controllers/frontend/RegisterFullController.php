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

class RegisterFullController extends Controller
{
    public function index()
    {
        return view('frontend.faq');
    }

    public function register_company_detail($type='')
    {
            return view('auth.register_company_detail',[
                'type'=>$type,
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
        return redirect()->to('register_company_on_web');
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
                    $imageProfile = 'profile_'.$profile->id.".".$r->file('imageProfile')->getClientOriginalExtension();
                    $r->file('imageProfile')->move(public_path() . '/images/profile/', $imageProfile);
                }
    }
       $profile->image_profile = $imageProfile;
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
