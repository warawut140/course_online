<?php

namespace App\Http\Controllers\backend;

use App\Models\Air_Conditioning;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminControlController extends Controller
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
        return view('backend.control.index');
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
        $now = new DateTime();
        $auth_name = Auth::user()->name;
        $air = new Air_Conditioning();


        $air->name = $request->get('name');
        $air->price = $request->get('price');
        $air->btu = $request->get('btu');
        $air->model = $request->get('models');
        $air->unit_id = $request->get('unit');
        $air->qty_material = $request->get('qty_material');
        $air->cost_material = $request->get('cost_material');
        $air->qty_labour = $request->get('qty_labour');
        $air->cost_labour = $request->get('cost_labour');
        $air->standard_id = null;
        $air->brand_id = $request->get('brand');
        if($request->typeInput == 1){
            // REMOTE CONTROLLER =>
            $air->type_sub_work_id = 20;
            $air->type_sub_work_list_id = null;
        }elseif ($request->typeInput == 2){
            // WIRING =>
            $air->type_sub_work_id = 21;
            $air->type_sub_work_list_id = null;
        }elseif ($request->typeInput == 3){
            // CONDUIT / EMT =>
            $air->type_sub_work_id = 22;
            $air->type_sub_work_list_id = 12;
        }elseif ($request->typeInput == 4){
            // CONDUIT / IMC =>
            $air->type_sub_work_id = 22;
            $air->type_sub_work_list_id = 13;
        }
        $air->actby = $auth_name;
        $air->created_at = $now;
        $air->save();
        return response()->json([
            'air' => $air,
            'success' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $air = Air_Conditioning::find($id);
        return response()->json($air);
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
        $now = new DateTime();
        $auth_name = Auth::user()->name;
        $air = Air_Conditioning::find($id);
        $air->name = $request->get('name');
        $air->price = $request->get('price');
        $air->btu = $request->get('btu');
        $air->model = $request->get('models');
        $air->unit_id = $request->get('unit');
        $air->qty_material = $request->get('qty_material');
        $air->cost_material = $request->get('cost_material');
        $air->qty_labour = $request->get('qty_labour');
        $air->cost_labour = $request->get('cost_labour');
        $air->brand_id = $request->get('brand');
        $air->actby = $auth_name ;
        $air->updated_at = $now ;
        $air->update();
        return response()->json([
            'air' => $air,
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
        Air_Conditioning::destroy($id);
        return response()->json([
            'success' => 'success',
        ]);
    }

    //API
    public function remote()
    {
        $data = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
//            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
//                'standards.name as s_name',
                'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', 20)
//            ->where('air_conditionings.standard_id', '=', '2')
            ->get();
        return response()->json([
            'method' => 'remote',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    public function wiring()
    {
        $data = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
//            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
//                'standards.name as s_name',
                'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', 21)
//            ->where('air_conditionings.standard_id', '=', '2')
            ->get();
        return response()->json([
            'method' => 'wiring',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    //CONDUIT => 22
    //12	EMT
    public function emt()
    {
        $data = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
//            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->join('type__subject__works_lists', 'air_conditionings.type_sub_work_list_id', '=', 'type__subject__works_lists.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
//                'standards.name as s_name',
                'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id' , 'type__subject__works_lists.name as wl_name')
            ->where('air_conditionings.type_sub_work_id', '=', 22)
            ->where('type__subject__works_lists.id', '=', 12)
            //            ->where('air_conditionings.standard_id', '=', '2')
            ->get();
        return response()->json([
            'method' => 'emt',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    //CONDUIT => 22
    //13	IMC
    public function imc()
    {
        $data = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
//            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->join('type__subject__works_lists', 'air_conditionings.type_sub_work_list_id', '=', 'type__subject__works_lists.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
//                'standards.name as s_name',
                'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id' , 'type__subject__works_lists.name as wl_name')
            ->where('air_conditionings.type_sub_work_id', '=', 22)
            ->where('type__subject__works_lists.id', '=', 13)
            //            ->where('air_conditionings.standard_id', '=', '2')
            ->get();
        return response()->json([
            'method' => 'emt',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    public function fittingAccessorries()
    {
        $data = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
//            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
//                'standards.name as s_name',
                'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', 23)
//            ->where('air_conditionings.standard_id', '=', '2')
            ->get();
        return response()->json([
            'method' => 'fittingAccessorries',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    public function hangerSupports()
    {
        $data = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
//            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
//                'standards.name as s_name',
                'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', 24)
//            ->where('air_conditionings.standard_id', '=', '2')
            ->get();
        return response()->json([
            'method' => 'hangerSupports',
            'material' => $data,
            'labour' => $data,
        ]);
    }

}
