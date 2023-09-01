<?php

namespace App\Http\Controllers\backend;

use App\Models\Air_Conditioning;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminPipingController extends Controller
{
    /**
     * AdminPipingController constructor.
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
        return view('backend.piping.index');
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
     * @param  \Illuminate\Http\Request $request
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
            // COPPER PIPE, TYPE "L" => 6
            $air->type_sub_work_id = 6;
            $air->type_sub_work_list_id = null;
        }elseif ($request->typeInput == 2){
            // REFRIGERANT PIPE INSULATION 3/4" THK. (FOR VRV) => 12
            $air->type_sub_work_id = 12;
            $air->type_sub_work_list_id = null;
        }elseif ($request->typeInput == 3){
            // PVC PIPE, CLASS 8.5 => 14
            $air->type_sub_work_id = 14;
            $air->type_sub_work_list_id = null;
        }elseif ($request->typeInput == 4){
            // DRAIN PIPE INSULATION 1/2" THK.	 => 18
            $air->type_sub_work_id = 18;
            $air->type_sub_work_list_id = null;
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
     * @param  int $id
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
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
     * @param  int $id
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
    //## REFRIGERANT PIPE ##//
    public function rpCopperPipeTypeL()
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
            ->where('air_conditionings.type_sub_work_id', '=', '6')
//            ->where('air_conditionings.standard_id', '=', '2')
            ->get();
        return response()->json([
            'method' => 'rpCopperPipeTypeL',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    public function rpPipeFittings()
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
            ->where('air_conditionings.type_sub_work_id', '=', 7)
//            ->where('air_conditionings.standard_id', '=', '1')
            ->get();

        return response()->json([
            'method' => 'rpPipeFittings',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    public function rpSupportHanger()
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
            ->where('air_conditionings.type_sub_work_id', '=', 8)
//            ->where('air_conditionings.standard_id', '=', '1')
            ->get();


        return response()->json([
            'method' => 'rpSupportHanger',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    public function rpRefrigerant()
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
            ->where('air_conditionings.type_sub_work_id', '=', 9)
//            ->where('air_conditionings.standard_id', '=', '1')
            ->get();

        return response()->json([
            'method' => 'rpRefrigerant',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    public function rpNytrogenTest()
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
            ->where('air_conditionings.type_sub_work_id', '=', 10)
//            ->where('air_conditionings.standard_id', '=', '1')
            ->get();


        return response()->json([
            'method' => 'rpNytrogenTest',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    public function rpAccessorries()
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
            ->where('air_conditionings.type_sub_work_id', '=', 11)
//            ->where('air_conditionings.standard_id', '=', '1')
            ->get();


        return response()->json([
            'method' => 'rpAccessorries',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    public function refrigerantPipeInsulation()
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
            ->where('air_conditionings.type_sub_work_id', '=', 12)
//            ->where('air_conditionings.standard_id', '=', '1')
            ->get();


        return response()->json([
            'method' => 'refrigerantPipeInsulation',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    public function rfpiAccessorries()
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
            ->where('air_conditionings.type_sub_work_id', '=', 13)
//            ->where('air_conditionings.standard_id', '=', '1')
            ->get();

        return response()->json([
            'method' => 'rfpiAccessorries',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    //## DRAIN PIPE ##//
    public function dpPvcPipeClass()
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
            ->where('air_conditionings.type_sub_work_id', '=', 14)
//            ->where('air_conditionings.standard_id', '=', '1')
            ->get();

        return response()->json([
            'method' => 'dpPvcPipeClass',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    public function dpPipeFittings()
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
            ->where('air_conditionings.type_sub_work_id', '=', 16)
//            ->where('air_conditionings.standard_id', '=', '2')
            ->get();

        return response()->json([
            'method' => 'dpPipeFittings',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    public function dpSupportHanger()
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
            ->where('air_conditionings.type_sub_work_id', '=', 17)
//            ->where('air_conditionings.standard_id', '=', '2')
            ->get();

        return response()->json([
            'method' => 'dpSupportHanger',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    public function dpInsulation()
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
            ->where('air_conditionings.type_sub_work_id', '=', 18)
//            ->where('air_conditionings.standard_id', '=', '1')
            ->get();


        return response()->json([
            'method' => 'dpInsulation',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    public function dpAccessorries()
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
            ->where('air_conditionings.type_sub_work_id', '=', 19)
//            ->where('air_conditionings.standard_id', '=', '1')
            ->get();

        return response()->json([
            'method' => 'dpAccessorries',
            'material' => $data,
            'labour' => $data,
        ]);
    }
}
