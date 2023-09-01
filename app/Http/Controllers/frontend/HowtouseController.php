<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HowtouseController extends Controller
{
    public function index()
    {
        return view('frontend.howtouse');
    }
}
