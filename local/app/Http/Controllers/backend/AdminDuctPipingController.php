<?php

namespace App\Http\Controllers\backend;

use App\Models\Air_Conditioning;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminDuctPipingController extends Controller
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
        return view('backend.duct.index');
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
        if ($request->typeInput == 1) {
            //Galvanized Steel Sheet => 25
            $air->type_sub_work_id = 25;
            $air->type_sub_work_list_id = null;
        } elseif ($request->typeInput == 2) {
            //Insulation Fiberglass FRK => 26
            $air->type_sub_work_id = 26;
            $air->type_sub_work_list_id = null;
        } elseif ($request->typeInput == 3) {
            //Hanger & Support => 27
            $air->type_sub_work_id = 27;
            $air->type_sub_work_list_id = null;
        } elseif ($request->typeInput == 4) {
            //Small Materials + Rain Force Joint => 28
            $air->type_sub_work_id = 28;
            $air->type_sub_work_list_id = null;
        } elseif ($request->typeInput == 5) {
            //Insulation Elastomer Sheet => 29
            $air->type_sub_work_id = 29;
            $air->type_sub_work_list_id = null;
        } elseif ($request->typeInput == 6) {
            //Sag Square => 30
            $air->type_sub_work_id = 30;
            $air->type_sub_work_list_id = null;
        } elseif ($request->typeInput == 7) {
            //Round Diffuser => 31
            $air->type_sub_work_id = 31;
            $air->type_sub_work_list_id = null;
        } elseif ($request->typeInput == 8) {
            //Jet Fan => 32
            $air->type_sub_work_id = 32;
            $air->type_sub_work_list_id = null;
        } elseif ($request->typeInput == 9) {
            //LBG Grill => 33
            $air->type_sub_work_id = 33;
            $air->type_sub_work_list_id = null;
        } elseif ($request->typeInput == 10) {
            //Linear Slot Diffuser => 34
            $air->type_sub_work_id = 34;
            $air->type_sub_work_list_id = null;
        } elseif ($request->typeInput == 11) {
            //Single Deflection Supply Air Grill => 35
            $air->type_sub_work_id = 35;
            $air->type_sub_work_list_id = null;
        } elseif ($request->typeInput == 12) {
            //Duble Deflection Supply Air Grill => 36
            $air->type_sub_work_id = 36;
            $air->type_sub_work_list_id = null;
        } elseif ($request->typeInput == 13) {
            //Return Air Grill => 37
            $air->type_sub_work_id = 37;
            $air->type_sub_work_list_id = null;
        } elseif ($request->typeInput == 14) {
            //Service Panel => 38
            $air->type_sub_work_id = 38;
            $air->type_sub_work_list_id = null;
        } elseif ($request->typeInput == 15) {
            //Chamber => 39
            $air->type_sub_work_id = 39;
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
        $air->actby = $auth_name;
        $air->updated_at = $now;
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

    //Galvanized Steel Sheet => 25
    public function galvanizedSteelSheet()
    {
        $data = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
                'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', 25)
            ->get();

        return response()->json([
            'method' => 'galvanizedSteelSheet',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    //Insulation Fiberglass FRK => 26
    public function insulationFiberglassFRK()
    {
        $data = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
                'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', 26)
            ->get();

        return response()->json([
            'method' => 'insulationFiberglassFRK',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    //Hanger & Support => 27
    public function hangerSupport()
    {
        $data = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
                'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', 27)
            ->get();

        return response()->json([
            'method' => 'hangerSupport',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    //Small Materials + Rain Force Joint => 28
    public function smallMaterialsRainForceJoint()
    {
        $data = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
                'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', 28)
            ->get();

        return response()->json([
            'method' => 'smallMaterialsRainForceJoint',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    //Insulation Elastomer Sheet => 29
    public function insulationElastomerSheet()
    {
        $data = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
                'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', 29)
            ->get();

        return response()->json([
            'method' => 'insulationElastomerSheet',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    //Sag Square => 30
    public function sagSquare()
    {
        $data = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
                'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', 30)
            ->get();

        return response()->json([
            'method' => 'sagSquare',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    //Round Diffuser => 31
    public function roundDiffuser()
    {
        $data = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
                'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', 31)
            ->get();

        return response()->json([
            'method' => 'roundDiffuser',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    //Jet Fan => 32
    public function jetFan()
    {
        $data = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
                'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', 32)
            ->get();

        return response()->json([
            'method' => 'jetFan',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    //LBG Grill => 33
    public function lbgGrill()
    {
        $data = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
                'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', 33)
            ->get();

        return response()->json([
            'method' => 'lbgGrill',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    //Linear Slot Diffuser => 34
    public function linearSlotDiffuser()
    {
        $data = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
                'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', 34)
            ->get();

        return response()->json([
            'method' => 'linearSlotDiffuser',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    //Single Deflection Supply Air Grill => 35
    public function singleDeflectionSupplyAirGrill()
    {
        $data = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
                'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', 35)
            ->get();

        return response()->json([
            'method' => 'singleDeflectionSupplyAirGrill',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    //Duble Deflection Supply Air Grill => 36
    public function dubleDeflectionSupplyAirGrill()
    {
        $data = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
                'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', 36)
            ->get();

        return response()->json([
            'method' => 'dubleDeflectionSupplyAirGrill',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    //Return Air Grill => 37
    public function returnAirGrill()
    {
        $data = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
                'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', 37)
            ->get();

        return response()->json([
            'method' => 'returnAirGrill',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    //Service Panel => 38
    public function servicePanel()
    {
        $data = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
                'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', 38)
            ->get();

        return response()->json([
            'method' => 'servicePanel',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    //Chamber => 39
    public function chamber()
    {
        $data = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
                'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', 39)
            ->get();

        return response()->json([
            'method' => 'chamber',
            'material' => $data,
            'labour' => $data,
        ]);
    }

}
