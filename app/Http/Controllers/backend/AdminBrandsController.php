<?php

namespace App\Http\Controllers\backend;

use App\Models\Air_Conditioning;
use App\Models\Brands;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Image;
class AdminBrandsController extends Controller
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
        $brands = Brands::whereNull('deleted_at')->orderBy('id','desc')->get();
        return view('backend.brands.index',[
            'brands' => $brands
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

        $brands = new Brands();
        $now = new DateTime();
        $auth_name = Auth::user()->name;

        if ($request->hasFile('image') != '') {
            $filename = 'logo_brand_' . str_random(6) . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path() . '/images/brand/', $filename);

            $brands->name  = $request->name ;
            $brands->filename  = $filename;
            $brands->actby  = $auth_name ;
            $brands->actby  = $auth_name ;
            $brands->created_at  = $now ;
            $brands->updated_at  = null ;
            $brands->save();

            Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
            return redirect('admin/brands');
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
        //API
        $brands = Brands::find($id);
        return response()->json($brands);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //API
        $brands = Brands::find($id);
        return response()->json($brands);
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

        $name = $request->get('name');
        $imageData = $request->get('image');
        $now = new DateTime();
        $auth_name = Auth::user()->name;
        $brands = Brands::find($id);

        if($imageData != null){
            if ($brands->filename != null){
                File::delete(public_path() . '/images/brand/' . $brands->filename);
            }
            $fileName = 'logo_brand_' . str_random(6) . "." . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
//            $request->file('image')->move(public_path() . '/images/brand/', $fileName);

            Image::make($request->get('image'))->save(public_path('images/brand/').$fileName);
        }else{
            $fileName = $brands->filename;
        }

        // Update Date
        $brands->name = $name;
        $brands->filename = $fileName;
        $brands->actby = $auth_name;
        $brands->updated_at = $now;
        $brands->update();


        return response()->json([
            'id' => $id,
            'name' => $name,
            'brands' => $imageData,
            'fileName' => $fileName,
            'success' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $checkdata = Air_Conditioning::where('brand_id',$id)->get();
        $now = new DateTime();
        if(count($checkdata) == 0){
            $brands = Brands::find($id);
            $brands->deleted_at = $now;
            $brands->update();
//            if ($brands->filename != null){
//                File::delete(public_path() . '/images/brand/' . $brands->filename);
//            }
//            Brands::destroy($id);
            Session::flash('status', 'ลบข้อมูลเรียบร้อย !');
        }else{
            Session::flash('warning', 'ไม่สามารถลบได้ เนื่องจาก ข้อมูล Air condition มีการใช้งาน !');
        }
        return redirect('admin/brands');
    }




}
