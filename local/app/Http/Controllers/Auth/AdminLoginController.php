<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login-admin2');
    }

    public function login(Request $request)
    {
    //    dd($request);
        // Validate the forn data
        $this->validate($request , [
            'email' => 'required|string',
            'password' => 'required|min:6',
        ]);

        //Attempt to log the user in
        if(Auth::guard('admin')->attempt(['email' => $request->email , 'password' => $request->password] , $request->remember )){
            // if successful , then redirect to their intended location
            return redirect()->intended(route('admin.home'));
        }
        // if un successful  , then redirect back to the login with  the form data
        return redirect()->back()->with($request->only('email' , 'remember'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('admin.login');
    }
}
