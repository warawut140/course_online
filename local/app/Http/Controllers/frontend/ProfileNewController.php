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

class ProfileNewController extends Controller
{
    public function profile_student($page="rasume")
    {
        $profile = Profile::where('user_id',Auth::guard('web')->user()->id)->first();
        $work_exp = WorkEXP::where('user_id',Auth::guard('web')->user()->id)->first();
        return view('auth.profile.profile_student',[
            'profile' => $profile,
            'page' => $page,
            'work_exp' => $work_exp,
        ]);
    }

    public function profile_company($page="rasume")
    {
        $profile = Profile::where('user_id',Auth::guard('web')->user()->id)->first();
        $courses = Course::where('profile_id',$profile->id)->where('status',1)->orderBy('created_at','desc')->get();

        return view('auth.profile.profile_company',[
            'profile' => $profile,
            'page' => $page,
            'courses' => $courses,
        ]);
    }


}
