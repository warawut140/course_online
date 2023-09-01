<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function path($id)
    {
        $notification = DB::table('notifications')->where('id','=',$id)->first();
        DB::table('notifications')->where('id','=',$id)->update([
            'isActive' => 1
        ]);
        return redirect($notification->path);
    }




}
