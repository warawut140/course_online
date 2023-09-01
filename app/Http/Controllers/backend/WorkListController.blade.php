<?php

namespace App\Http\Controllers\backend;

use App\Models\Profile;
use App\Models\ProjectAuction;
use App\Models\Suggests;
use App\Models\WorkPosting;
use Illuminate\Http\Request;
use App\Models\DataType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class WorkListController extends Controller
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
    public function course_type()
    {
        $data_type = DataType::where('type',1)->orderBy('id','desc')->get();
        return view('backend.data_type.course_type',[
            'data_type'=>$data_type,
        ]);
    }

    public function course_type_add()
    {
        return view('backend.data_type.course_type_add');
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
    public function course_type_store(Request $r)
    {
        if($r->data_id){
            // dd($r->data_id);
            $data_type = DataType::where('id',$r->data_id)->first();
          if(!$data_type){
            return redirect()->to('admin/course_type')->with('error','ไม่สามารถทำรายการได้ กรุณาลองใหม่ภายหลัง');
          }
            $data_type->updated_at = date('Y-m-d H:i:s');
        }else{
            $data_type = new DataType();
            $data_type->created_at = date('Y-m-d H:i:s');
            $data_type->updated_at = date('Y-m-d H:i:s');
        }
        $data_type->name = $r->name;
        $data_type->type = 1;
        $data_type->admin_id = Auth::user()->id;
        $data_type->save();
        return redirect()->to('admin/course_type')->with('success','บันทึกข้อมูลสำเร็จ');
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
    public function course_type_view($id)
    {
        $data = DataType::where('id',$id)->first();
        if($data){
            return view('backend.data_type.course_type_add',[
                'data' => $data,
            ]);
        }else{
            return redirect()->to('admin/course_type')->with('error','ไม่พบข้อมูลทำรายการ');
        }
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
    public function course_type_delete($id)
    {
            DataType::where('id',$id)->delete();
            return redirect()->to('admin/course_type')->with('success','ลบรายการสำเร็จ');
    }

    public function work_type_delete($id)
    {
            DataType::where('id',$id)->delete();
            return redirect()->to('admin/work_type')->with('success','ลบรายการสำเร็จ');
    }
}
