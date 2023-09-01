<?php

namespace App\Http\Controllers\backend;

use App\Models\Promotion;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class AdminPromotionController extends Controller
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
        $promotion = Promotion::join('admins','admins.id','=','promotions.admin_id')
            ->select('promotions.*','admins.name')
            ->orderBy('promotions.id','DESC')
            ->get();
//        dd($promotion);
        return view('backend.promotion.index',[
            'promotion' => $promotion
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
    public function store(Request $request)
    {

        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        if ($request->hasFile('image') != '') {
            $filename = 'promotion_'.$request->month.'_'.str_random(4).'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path() . '/images/promotion/', $filename);

//            echo $filename;
//            dd($request->all());
            $admin_id = Auth::user()->id;
            $now = new DateTime();

            $promotion = new Promotion();
            $promotion->title = $request->title ;
            $promotion->details = $request->details ;
            $promotion->filename = $filename ;
            $promotion->month = $request->month;
            $promotion->year = $request->year;
            $promotion->startdate = $request->startdate ;
            $promotion->enddate = $request->enddate ;
            $promotion->admin_id = $admin_id;
            $promotion->created_at = $now;
            $promotion->updated_at = null;
            $promotion->save();
            Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
            return redirect('admin/promotion');
        }else{
            Session::flash('alert', 'กรุณาเพิ่มรูปภาพ !');
            return redirect('admin/promotion');
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
        $promotion = Promotion::find($id);
        File::delete(public_path() . '/images/promotion/' . $promotion->filename);
        Promotion::destroy($id);
        Session::flash('status', 'ลบข้อมูลเรียบร้อย !');
        return redirect('admin/promotion');
    }
}
