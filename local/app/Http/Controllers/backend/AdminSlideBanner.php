<?php

namespace App\Http\Controllers\backend;

use App\Models\Gallery;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class AdminSlideBanner extends Controller
{

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
        $galleries =  Gallery::where('type','=',1)->paginate(2);
        return view('backend.banner.index',[
            'galleries' => $galleries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $auth_name = Auth::user()->name;
        $now = new DateTime();
//        dd($request->all());
        if ($request->hasFile('image') != '') {
            $filename = 'banner_'.str_random(10).".".$request->file('image')->getClientOriginalExtension();
            $originalName = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path() . '/images/banner/', $filename);
            $image_gal = $filename;

            $gallery = new Gallery();
            $gallery->filename = $image_gal;
            $gallery->type = 1;
            $gallery->isActive = 1;
            $gallery->original_name = $originalName;
            $gallery->actby = $auth_name;
            $gallery->created_at = $now;
            $gallery->updated_at = null;
            $gallery->save();
            Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
            return redirect('admin/slide-banner');
        }else{
            Session::flash('alert', 'รูปไม่สามารถอัพได้ !');
            return redirect('admin/slide-banner/create');
//            return back()->withInput($request->input())->with('alert', "รูปไม่สามารถอัพได้");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $gallery = Gallery::where('id' , '=',$id)->first();
        File::delete(public_path() . '/images/banner/' . $gallery->filename);
        Gallery::destroy($id);
        Session::flash('status', 'ลบข้อมูลเรียบร้อย !');
        return redirect('admin/slide-banner');
    }

    public function updateShow(Request $request, $id)
    {
        DB::table('galleries')
            ->where('id', '=', $id)
            ->update([
                'isActive' => 1,
            ]);
        Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
        return redirect('admin/slide-banner');
    }

    public function updateHide(Request $request, $id)
    {
        DB::table('galleries')
            ->where('id', '=', $id)
            ->update([
                'isActive' => 0,
            ]);
        Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
        return redirect('admin/slide-banner');
    }
}
