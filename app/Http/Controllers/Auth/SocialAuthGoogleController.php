<?php

namespace App\Http\Controllers\Auth;

use App\Models\Profile;
use App\Services\SocialGoogleAccountService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use App\User;


class SocialAuthGoogleController extends Controller
{
    /**
     * Create a redirect method to google api.
     *
     * @return void
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }


    /**
     * Return a callback method from google api.
     *
     * @return callback URL from google
     */
    public function callback(SocialGoogleAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('google')->user());
        auth()->login($user);
        $profile = Profile::where('user_id',$user->id)->first();
        if(!$profile){
            return redirect()->to('/addProfile');
        }else{
            return redirect()->to('/index');
        }

    }
}
