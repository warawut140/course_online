<?php

namespace App\Http\Controllers\backend;

use App\Models\Air_Conditioning;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminMainController extends Controller
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
        return view('backend.main.index');
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
        if ($request->typeInput == 1) {
            //MDB  => 40
            $air->type_sub_work_id = 40;
            $air->type_sub_work_list_id = null;
        } elseif ($request->typeInput == 2) {
            //LP  => 41
            $air->type_sub_work_id = 41;
            $air->type_sub_work_list_id = null;
        } elseif ($request->typeInput == 3) {
            //CIRCUIT BREKER  => 42
            $air->type_sub_work_id = 42;
            $air->type_sub_work_list_id = null;
        } elseif ($request->typeInput == 4) {
            //ELECTRICAL WIRE & CABLE  => 43
            $air->type_sub_work_id = 43;
            $air->type_sub_work_list_id = null;
        } elseif ($request->typeInput == 5) {
            //Acessories  => 44
            $air->type_sub_work_id = 44;
            $air->type_sub_work_list_id = null;
        } elseif ($request->typeInput == 6) {
            //CONDUIT & RACEWAY  => 45
            $air->type_sub_work_id = 45;
            $air->type_sub_work_list_id = null;
        } elseif ($request->typeInput == 7) {
            //Fiiting & Accessories  => 46
            $air->type_sub_work_id = 46;
            $air->type_sub_work_list_id = null;
        } elseif ($request->typeInput == 8) {
            //Hanger & Support  => 47
            $air->type_sub_work_id = 47;
            $air->type_sub_work_list_id = null;
        } elseif ($request->typeInput == 9) {
            //SAFETY SWITCH  => 48
            $air->type_sub_work_id = 48;
            $air->type_sub_work_list_id = null;
        } elseif ($request->typeInput == 10) {
            //CISOLATE SWITCH  => 49
            $air->type_sub_work_id = 49;
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

    //MDB  => 40
    public function mdb()
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
            ->where('air_conditionings.type_sub_work_id', '=', 40)
            ->get();

        return response()->json([
            'method' => 'mdb',
            'data' => $data,
        ]);
    }
    //LP  => 41
    public function lp()
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
            ->where('air_conditionings.type_sub_work_id', '=', 41)
            ->get();

        return response()->json([
            'method' => 'lb',
            'data' => $data,
        ]);
    }
    //CIRCUIT BREKER  => 42
    public function circuitBreker()
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
            ->where('air_conditionings.type_sub_work_id', '=', 42)
            ->get();

        return response()->json([
            'method' => 'circuitBreker',
            'data' => $data,
        ]);
    }
    //ELECTRICAL WIRE & CABLE  => 43
    public function electricalWireCable()
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
            ->where('air_conditionings.type_sub_work_id', '=', 43)
            ->get();

        return response()->json([
            'method' => 'electricalWireCable',
            'data' => $data,
        ]);
    }
    //Acessories  => 44
    public function acessories()
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
            ->where('air_conditionings.type_sub_work_id', '=', 44)
            ->get();

        return response()->json([
            'method' => 'acessories',
            'data' => $data,
        ]);
    }
    //CONDUIT & RACEWAY  => 45
    public function conduitRaceway()
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
            ->where('air_conditionings.type_sub_work_id', '=', 45)
            ->get();

        return response()->json([
            'method' => 'conduitRaceway',
            'data' => $data,
        ]);
    }
    //Fiiting & Accessories  => 46
    public function fiitingAccessories()
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
            ->where('air_conditionings.type_sub_work_id', '=', 46)
            ->get();

        return response()->json([
            'method' => 'fiitingAccessories',
            'data' => $data,
        ]);
    }
    //Hanger & Support  => 47
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
            ->where('air_conditionings.type_sub_work_id', '=', 47)
            ->get();

        return response()->json([
            'method' => 'hangerSupport',
            'data' => $data,
        ]);
    }
    //SAFETY SWITCH  => 48
    public function safetySwitch()
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
            ->where('air_conditionings.type_sub_work_id', '=', 48)
            ->get();

        return response()->json([
            'method' => 'safetySwitch',
            'data' => $data,
        ]);
    }
    //CISOLATE SWITCH  => 49
    public function isolateSwitch()
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
            ->where('air_conditionings.type_sub_work_id', '=', 49)
            ->get();

        return response()->json([
            'method' => 'cisolateSwitch',
            'data' => $data,
        ]);
    }
}
