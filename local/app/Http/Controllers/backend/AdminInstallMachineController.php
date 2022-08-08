<?php

namespace App\Http\Controllers\backend;

use App\Models\Air_Conditioning;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminInstallMachineController extends Controller
{
    /**
     * AdminInstallMachineController constructor.
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
        return view('backend.machine.index');
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


//        1	Condensing Unit
//        2	Fancoil Unit
//            1	Wallmount
//            2	Ceiling Suspended
//            3	Ceiling mounted duct
//            4	Ceiling mounted cassette
//            5	Floor mounted
//        3	Refnet joint
//        4	Support & Hanger (For CDU. & FCU.)
//        5	Crane

        $max = DB::table('air_conditionings')->max('air_id');

        for ($i = 1; $i <= 2; $i++) {
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
            $air->standard_id = $i;
            $air->brand_id = $request->get('brand');
            if ($request->typeInput == 1) {
                //Condensing Unit
                $air->type_sub_work_id = 1;
                $air->type_sub_work_list_id = null;
            } elseif ($request->typeInput == 2) {
                //Fancoil Unit / Wallmount
                $air->type_sub_work_id = 2;
                $air->type_sub_work_list_id = 1;
            } elseif ($request->typeInput == 3) {
                //Fancoil Unit / Ceiling Suspended
                $air->type_sub_work_id = 2;
                $air->type_sub_work_list_id = 2;
            } elseif ($request->typeInput == 4) {
                //Fancoil Unit / Ceiling mounted duct
                $air->type_sub_work_id = 2;
                $air->type_sub_work_list_id = 3;
            } elseif ($request->typeInput == 5) {
                //Fancoil Unit / Ceiling mounted cassette
                $air->type_sub_work_id = 2;
                $air->type_sub_work_list_id = 4;
            } elseif ($request->typeInput == 6) {
                //Fancoil Unit / Floor mounted
                $air->type_sub_work_id = 2;
                $air->type_sub_work_list_id = 5;
            } elseif ($request->typeInput == 7) {
                //Refnet Joint
                $air->type_sub_work_id = 3;
                $air->type_sub_work_list_id = null;
            }
            $air->actby = $auth_name;
            $air->created_at = $now;
            $air->air_id = $max+1;
            $air->save();
            // 8 = Support & Hanger (For CDU. & FCU
            // 9 = Crane
        }
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
        $check_air = Air_Conditioning::find($id);
        $air_arr = Air_Conditioning::where('air_id','=',$check_air->air_id)->get();
        foreach ($air_arr as $value){
            $air = Air_Conditioning::find($value->id);
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
        }

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
        $check_air = Air_Conditioning::find($id);
        $air_arr = Air_Conditioning::where('air_id','=',$check_air->air_id)->get();
        foreach ($air_arr as $value){
            Air_Conditioning::destroy($value->id);
        }
        return response()->json([
            'success' => 'success',
        ]);
    }


    //API
    public function getDropDownListUnit()
    {
        $units = DB::table('units')->select("id", "name")->get();
        return response()->json($units);
    }

    public function getDropDownListBrand()
    {
        $brands = DB::table('brands')->select("id", "name")
            ->whereNull('deleted_at')->get();
        return response()->json($brands);
    }




    public function condensingUnit()
    {
        $material = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
                'standards.name as s_name', 'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', '1')
            ->where('air_conditionings.standard_id', '=', '1')
            ->get();
        $labour = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
                'standards.name as s_name', 'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', '1')
            ->where('air_conditionings.standard_id', '=', '2')
            ->get();

        return response()->json([
            'method' => 'condensingUnit',
            'material' => $material,
            'labour' => $labour,
        ]);
    }

    //##### Fancoil Unit #####
    public function wallMount()
    {
        $material = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
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
                'standards.name as s_name', 'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id', 'type__subject__works_lists.name as wl_name')
            ->where('air_conditionings.type_sub_work_id', '=', '2')
            ->where('air_conditionings.standard_id', '=', '1')
            ->where('type__subject__works_lists.id', '=', '1')
            ->get();
        $labour = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
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
                'standards.name as s_name', 'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id', 'type__subject__works_lists.name as wl_name')
            ->where('air_conditionings.type_sub_work_id', '=', '2')
            ->where('air_conditionings.standard_id', '=', '2')
            ->where('type__subject__works_lists.id', '=', '1')
            ->get();
        return response()->json([
            'method' => 'wallMount',
            'material' => $material,
            'labour' => $labour,
        ]);
    }

    public function ceilingSuspended()
    {
        $material = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
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
                'standards.name as s_name', 'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id', 'type__subject__works_lists.name as wl_name')
            ->where('air_conditionings.type_sub_work_id', '=', '2')
            ->where('air_conditionings.standard_id', '=', '1')
            ->where('type__subject__works_lists.id', '=', '2')
            ->get();
        $labour = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
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
                'standards.name as s_name', 'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id', 'type__subject__works_lists.name as wl_name')
            ->where('air_conditionings.type_sub_work_id', '=', '2')
            ->where('air_conditionings.standard_id', '=', '2')
            ->where('type__subject__works_lists.id', '=', '2')
            ->get();
        return response()->json([
            'method' => 'ceilingSuspended',
            'material' => $material,
            'labour' => $labour,
        ]);
    }

    public function ceilingMountedDuct()
    {
        $material = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
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
                'standards.name as s_name', 'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id', 'type__subject__works_lists.name as wl_name')
            ->where('air_conditionings.type_sub_work_id', '=', '2')
            ->where('air_conditionings.standard_id', '=', '1')
            ->where('type__subject__works_lists.id', '=', '3')
            ->get();
        $labour = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
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
                'standards.name as s_name', 'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id', 'type__subject__works_lists.name as wl_name')
            ->where('air_conditionings.type_sub_work_id', '=', '2')
            ->where('air_conditionings.standard_id', '=', '2')
            ->where('type__subject__works_lists.id', '=', '3')
            ->get();
        return response()->json([
            'method' => 'ceilingMountedDuct',
            'material' => $material,
            'labour' => $labour,
        ]);
    }

    public function ceilingMountedCassette()
    {
        $material = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
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
                'standards.name as s_name', 'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id', 'type__subject__works_lists.name as wl_name')
            ->where('air_conditionings.type_sub_work_id', '=', '2')
            ->where('air_conditionings.standard_id', '=', '1')
            ->where('type__subject__works_lists.id', '=', '4')
            ->get();
        $labour = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
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
                'standards.name as s_name', 'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id', 'type__subject__works_lists.name as wl_name')
            ->where('air_conditionings.type_sub_work_id', '=', '2')
            ->where('air_conditionings.standard_id', '=', '2')
            ->where('type__subject__works_lists.id', '=', '4')
            ->get();
        return response()->json([
            'method' => 'ceilingMountedCassette',
            'material' => $material,
            'labour' => $labour,
        ]);
    }

    public function floorMounted()
    {
        $material = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
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
                'standards.name as s_name', 'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id', 'type__subject__works_lists.name as wl_name')
            ->where('air_conditionings.type_sub_work_id', '=', '2')
            ->where('air_conditionings.standard_id', '=', '1')
            ->where('type__subject__works_lists.id', '=', '5')
            ->get();
        $labour = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
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
                'standards.name as s_name', 'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id', 'type__subject__works_lists.name as wl_name')
            ->where('air_conditionings.type_sub_work_id', '=', '2')
            ->where('air_conditionings.standard_id', '=', '2')
            ->where('type__subject__works_lists.id', '=', '5')
            ->get();
        return response()->json([
            'method' => 'floorMounted',
            'material' => $material,
            'labour' => $labour,
        ]);
    }

    //##### Fancoil Unit #####

    public function refnetJoint()
    {
        $material = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
                'standards.name as s_name', 'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', '3')
            ->where('air_conditionings.standard_id', '=', '1')
            ->get();
        $labour = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
                'standards.name as s_name', 'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', '3')
            ->where('air_conditionings.standard_id', '=', '2')
            ->get();
        return response()->json([
            'method' => 'refnetJoint',
            'material' => $material,
            'labour' => $labour,
        ]);
    }

    public function supportHanger()
    {
        $material = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
                'standards.name as s_name', 'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', '4')
            ->where('air_conditionings.standard_id', '=', '1')
            ->get();
        $labour = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
                'standards.name as s_name', 'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', '4')
            ->where('air_conditionings.standard_id', '=', '2')
            ->get();
        return response()->json([
            'method' => 'supportHanger',
            'material' => $material,
            'labour' => $labour,
        ]);
    }

    public function crane()
    {
        $material = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
                'standards.name as s_name', 'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', '5')
            ->where('air_conditionings.standard_id', '=', '1')
            ->get();
        $labour = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
                'standards.name as s_name', 'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where('air_conditionings.type_sub_work_id', '=', '5')
            ->where('air_conditionings.standard_id', '=', '2')
            ->get();
        return response()->json([
            'method' => 'crane',
            'material' => $material,
            'labour' => $labour,
        ]);
    }


}
