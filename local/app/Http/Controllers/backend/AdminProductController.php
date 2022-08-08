<?php

namespace App\Http\Controllers\backend;

use App\Models\Brands;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminProductController extends Controller
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
        //
    }

    public function wire()
    {
        $brands = Brands::whereNull('deleted_at')->orderBy('id', 'desc')->get();
        return view('backend.air.index-airdata', [
            'view' => 2,
            'brands' => $brands,
        ]);
    }

    public function airCleaners()
    {
        $brands = Brands::whereNull('deleted_at')->orderBy('id', 'desc')->get();
        return view('backend.air.index-airdata', [
            'view' => 3,
            'brands' => $brands,
        ]);
    }

    public function pipeWire()
    {
        $brands = Brands::whereNull('deleted_at')->orderBy('id', 'desc')->get();
        return view('backend.air.index-airdata', [
            'view' => 4,
            'brands' => $brands,
        ]);
    }

    public function pvc()
    {
        $brands = Brands::whereNull('deleted_at')->orderBy('id', 'desc')->get();
        return view('backend.air.index-airdata', [
            'view' => 5,
            'brands' => $brands,
        ]);
    }

    public function fiberglassInsulation()
    {
        $brands = Brands::whereNull('deleted_at')->orderBy('id', 'desc')->get();
        return view('backend.air.index-airdata', [
            'view' => 6,
            'brands' => $brands,
        ]);
    }

    public function blackRubberInsulation()
    {
        $brands = Brands::whereNull('deleted_at')->orderBy('id', 'desc')->get();
        return view('backend.air.index-airdata', [
            'view' => 7,
            'brands' => $brands,
        ]);
    }

    public function pvcWaterPipe()
    {
        $brands = Brands::whereNull('deleted_at')->orderBy('id', 'desc')->get();
        return view('backend.air.index-airdata', [
            'view' => 8,
            'brands' => $brands,
        ]);
    }

    public function hdpeWaterwork()
    {
        $brands = Brands::whereNull('deleted_at')->orderBy('id', 'desc')->get();
        return view('backend.air.index-airdata', [
            'view' => 9,
            'brands' => $brands,
        ]);
    }

    public function hdpeElectricalWork()
    {
        $brands = Brands::whereNull('deleted_at')->orderBy('id', 'desc')->get();
        return view('backend.air.index-airdata', [
            'view' => 10,
            'brands' => $brands,
        ]);
    }

    public function copperTube()
    {
        $brands = Brands::whereNull('deleted_at')->orderBy('id', 'desc')->get();
        return view('backend.air.index-airdata', [
            'view' => 11,
            'brands' => $brands,
        ]);
    }

    public function aeroduct()
    {
        $brands = Brands::whereNull('deleted_at')->orderBy('id', 'desc')->get();
        return view('backend.air.index-airdata', [
            'view' => 12,
            'brands' => $brands,
        ]);
    }

    public function productAll()
    {
        $brands = Brands::whereNull('deleted_at')->orderBy('id', 'desc')->get();
        return view('backend.air.index-airdata', [
            'view' => 13,
            'brands' => $brands,
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now = new DateTime();
        $auth_id = Auth::user()->id;
        $auth_name = Auth::user()->name;
        if ($request->get('type_wire') == 1) {
            // สายไฟ
            $pwProduct_id = DB::table('product_wire')->insertGetId([
                'pw_brand_id' => ($request->get('brand_id') == '') ? null : $request->get('brand_id'),
                'pw_brand_name' => ($request->get('brand_name') == '') ? '-' : $request->get('brand_name'),
                'pw_type_Id' => ($request->get('wireTypeId') == '') ? null : $request->get('wireTypeId'),
                'pw_type_name' => ($request->get('wireTypeName') == '') ? null : $request->get('wireTypeName'),
                'pw_type_volt' => ($request->get('wireTypeVolt') == '') ? null : $request->get('wireTypeVolt'),
                'pw_type_standard' => ($request->get('wireTypeStandard') == '') ? null : $request->get('wireTypeStandard'),
                'pw_size' => ($request->get('wireSize') == '') ? null : $request->get('wireSize'),
                'pw_size_detail' => ($request->get('wireSizeDetail') == '') ? null : $request->get('wireSizeDetail'),
                'user_id' => $auth_id,
                'actby' => $auth_name,
                'created_at' => $now,
                'updated_at' => null,
            ]);
            $array_details = json_decode($_POST['wireDetails']);
            if (count($array_details) > 0) {
                for ($i = 0; $i < count($array_details); $i++) {
                    DB::table('product_wire_detail')->insert([
                        'pw_id' => $pwProduct_id,
                        'pwd_detail' => $array_details[$i]->details,
                        'pwd_price' => $array_details[$i]->price,
                    ]);

                }
            }
        } elseif ($request->get('type_wire') == 2) {
            // น้ำยาแอร์
            DB::table('product_air_cleaner')->insert([
                'ac_brand_id' => ($request->get('ac_brand_id') == '') ? null : $request->get('ac_brand_id'),
                'ac_brand_name' => ($request->get('ac_brand_name') == '') ? '-' : $request->get('ac_brand_name'),
                'ac_list_name' => $request->get('ac_list_name'),
                'ac_price' => $request->get('ac_price'),
                'user_id' => $auth_id,
                'actby' => $auth_name,
                'created_at' => $now,
            ]);
        } elseif ($request->get('type_wire') == 3) {
            // ท่อร้อย สายไฟ
            DB::table('product_pipe_wire')->insert([
                'pw_brand_id' => ($request->get('pw_brand_id') == '') ? null : $request->get('pw_brand_id'),
                'pw_brand_name' => ($request->get('pw_brand_name') == '') ? '-' : $request->get('pw_brand_name'),
                'pw_type' => $request->get('pw_type'),
                'pw_size_inch' => $request->get('pw_size_inch'),
                'pw_size_mm' => $request->get('pw_size_mm'),
                'pw_price_line' => $request->get('pw_price_line'),
                'pw_price_m' => $request->get('pw_price_m'),
                'user_id' => $auth_id,
                'actby' => $auth_name,
                'created_at' => $now,
            ]);
        } elseif ($request->get('type_wire') == 4) {
            // New
            //1 "SGC" ท่อ PVC สีฟ้า ท่อประปา
            //2 "SGC" ท่อ PVC สีฟ้า ท่อเซาะร่อง
            //3 "SGC" ท่อ PVC สีเหลือง งานร้อยสายไฟฟ้าและสายโทรศัพท์
            //4 "SGC" ท่อ PVC สีขาว BS งานร้อยสายไฟฟ้าและสายโทรศัพท์
            //5 "SGC" ท่อ PVC สีขาว JIS งานร้อยสายไฟฟ้าและสายโทรศัพท์
            $pwProduct_id = DB::table('product_pvc_pipe')->insertGetId([
                'pp_brand_id' => ($request->get('pp_brand_id') == '') ? null : $request->get('pp_brand_id'),
                'pp_brand_name' => ($request->get('pp_brand_name') == '') ? '-' : $request->get('pp_brand_name'),
                'pp_type_pipe_id' => $request->get('pp_type_pipe_id'),
                'pp_type_pipe' => ($request->get('pp_type_pipe') == '') ? null : $request->get('pp_type_pipe'),
                'pp_size' => ($request->get('pp_size') == '') ? null : $request->get('pp_size'),
                'pp_laborcost' => ($request->get('pp_laborcost') == '') ? null : $request->get('pp_laborcost'),
                'pp_count' => ($request->get('pp_count') == '') ? null : $request->get('pp_count'),
                'user_id' => $auth_id,
                'actby' => $auth_name,
                'created_at' => $now,
            ]);

            if ($request->get('pp_type_pipe_id') == 1 ||
                $request->get('pp_type_pipe_id') == 2 ||
                $request->get('pp_type_pipe_id') == 3) {
                $array_details = json_decode($_POST['pwDetails']);
                if (count($array_details) > 0) {
                    for ($i = 0; $i < count($array_details); $i++) {
                        DB::table('product_pp_detail')->insert([
                            'pp_id' => $pwProduct_id,
                            'pp_d_class' => $array_details[$i]->class,
                            'pp_d_price' => $array_details[$i]->price,
                        ]);
                    }
                }
            } else {
                DB::table('product_pp_detail')->insert([
                    'pp_id' => $pwProduct_id,
                    'pp_d_class' => null,
                    'pp_d_osd' => $request->get('pp_d_osd'),
                    'pp_d_thickness' => $request->get('pp_d_thickness'),
                    'pp_d_price' => $request->get('pp_d_price'),
                ]);
            }
        } elseif ($request->get('type_wire') == 5) {
            // ฉนวนใยแก้ว
            DB::table('product_fiberglass_insulation')->insert([
                'fi_brand_id' => ($request->get('fi_brand_id') == '') ? null : $request->get('fi_brand_id'),
                'fi_brand_name' => ($request->get('fi_brand_name') == '') ? '-' : $request->get('fi_brand_name'),
                'fi_model' => $request->get('fi_model'),
                'fi_model_detail' => $request->get('fi_model_detail'),
                'fi_code' => $request->get('fi_code'),
                'fi_density' => $request->get('fi_density'),
                'fi_thickness' => $request->get('fi_thickness'),
                'fi_size' => $request->get('fi_size'),
                'fi_price1' => $request->get('fi_price1'),
                'fi_price2' => $request->get('fi_price2'),
                'user_id' => $auth_id,
                'actby' => $auth_name,
                'created_at' => $now,
            ]);
        } elseif ($request->get('type_wire') == 6) {
            // ฉนวนยางดำ
            $pwProduct_id = DB::table('product_blackrubber_insulation')->insertGetId([
                'bi_brand_id' => ($request->get('bi_brand_id') == '') ? null : $request->get('bi_brand_id'),
                'bi_brand_name' => ($request->get('bi_brand_name') == '') ? '-' : $request->get('bi_brand_name'),
                'bi_inch' => ($request->get('bi_inch') == '') ? null : $request->get('bi_inch'),
                'bi_mm' => ($request->get('bi_mm') == '') ? null : $request->get('bi_mm'),
                'bi_pipe_steel' => ($request->get('bi_pipe_steel') == '') ? null : $request->get('bi_pipe_steel'),
                'user_id' => $auth_id,
                'actby' => $auth_name,
                'created_at' => $now,
            ]);
            $array_details = json_decode($_POST['pwDetails']);
            if (count($array_details) > 0) {
                for ($i = 0; $i < count($array_details); $i++) {
                    DB::table('product_bi_detail')->insert([
                        'bi_id' => $pwProduct_id,
                        'bi_d_thickness' => $array_details[$i]->thickness,
                        'bi_d_price' => $array_details[$i]->price,
                    ]);
                }
            }
        } elseif ($request->get('type_wire') == 7) {
            // PVC ท่อน้ำ
            $pwProduct_id = DB::table('product_pvc_water_pipe')->insertGetId([
                'pwp_brand_id' => ($request->get('pwp_brand_id') == '') ? null : $request->get('pwp_brand_id'),
                'pwp_brand_name' => ($request->get('pwp_brand_name') == '') ? '-' : $request->get('pwp_brand_name'),
                'pwp_type' => ($request->get('pwp_type') == '') ? null : $request->get('pwp_type'),
                'pwp_name' => ($request->get('pwp_name') == '') ? null : $request->get('pwp_name'),
                'pwp_type2' => ($request->get('pwp_type2') == '') ? null : $request->get('pwp_type2'),
                'pwp_mill' => ($request->get('pwp_mill') == '') ? null : $request->get('pwp_mill'),
                'pwp_inch' => ($request->get('pwp_inch') == '') ? null : $request->get('pwp_inch'),
                'pwp_count' => ($request->get('pwp_count') == '') ? null : $request->get('pwp_count'),
                'pwp_laborcost' => ($request->get('pwp_laborcost') == '') ? null : $request->get('pwp_laborcost'),
                'user_id' => $auth_id,
                'actby' => $auth_name,
                'created_at' => $now,
            ]);

            $array_details = json_decode($_POST['pwDetails']);
            if ($request->get('pwp_type') == 1) {
                if (count($array_details) > 0) {
                    for ($i = 0; $i < count($array_details); $i++) {
                        DB::table('product_pwp_detail')->insert([
                            'pwp_id' => $pwProduct_id,
                            'pwp_d_class' => $array_details[$i]->class,
                            'pwp_d_price' => $array_details[$i]->price,
                        ]);
                    }
                }
            } else {
                DB::table('product_pwp_detail')->insert([
                    'pwp_id' => $pwProduct_id,
                    'pwp_d_price' => $request->get('pwp_d_price'),
                ]);
            }
        } elseif ($request->get('type_wire') == 8) {
            // HDPE งานประปา
            $pwProduct_id = DB::table('product_hdpe_plumbing')->insertGetId([
                'hp_brand_id' => ($request->get('hp_brand_id') == '') ? null : $request->get('hp_brand_id'),
                'hp_brand_name' => ($request->get('hp_brand_name') == '') ? '-' : $request->get('hp_brand_name'),
                'hp_type' => ($request->get('hp_type') == '') ? null : $request->get('hp_type'),
                'hp_fitting_name' => ($request->get('hp_fitting_name') == '') ? null : $request->get('hp_fitting_name'),
                'hp_od_mm' => ($request->get('hp_od_mm') == '') ? null : $request->get('hp_od_mm'),
                'hp_od_inch' => ($request->get('hp_od_inch') == '') ? null : $request->get('hp_od_inch'),
                'hp_fitting_price' => ($request->get('hp_fitting_price') == '') ? null : $request->get('hp_fitting_price'),
                'user_id' => $auth_id,
                'actby' => $auth_name,
                'created_at' => $now,
            ]);
            $array_details = json_decode($_POST['pwDetails']);
            if (count($array_details) > 0) {
                if (!empty($array_details[0]->name)) {
                    for ($i = 0; $i < count($array_details); $i++) {
                        DB::table('product_hp_detail')->insert([
                            'hp_id' => $pwProduct_id,
                            'hp_d_name' => $array_details[$i]->name,
                            'hp_d_pe80' => (!empty($array_details[$i]->pe80)) ? $array_details[$i]->pe80 : null,
                            'hp_d_pe100' => (!empty($array_details[$i]->pe100)) ? $array_details[$i]->pe100 : null,
                            'hp_d_price' => $array_details[$i]->price,
                        ]);
                    }
                }
            }
        } elseif ($request->get('type_wire') == 9) {
            // HDPE งานไฟฟ้า
            $pwProduct_id = DB::table('product_hdpe_electricity')->insertGetId([
                'hdpe_brand_id' => ($request->get('hdpe_brand_id') == '') ? null : $request->get('hdpe_brand_id'),
                'hdpe_brand_name' => ($request->get('hdpe_brand_name') == '') ? '-' : $request->get('hdpe_brand_name'),
                'hdpe_type' => ($request->get('hdpe_type') == '') ? null : $request->get('hdpe_type'),
                'hdpe_type_name' => ($request->get('hdpe_type_name') == '') ? null : $request->get('hdpe_type_name'),
                'hdpe_od_mm' => ($request->get('hdpe_od_mm') == '') ? null : $request->get('hdpe_od_mm'),
                'hdpe_od_inch' => ($request->get('hdpe_od_inch') == '') ? null : $request->get('hdpe_od_inch'),
                'user_id' => $auth_id,
                'actby' => $auth_name,
                'created_at' => $now,
            ]);
            $array_details = json_decode($_POST['pwDetails']);
            if (count($array_details) > 0) {
                for ($i = 0; $i < count($array_details); $i++) {
                    DB::table('product_he_detail')->insert([
                        'he_id' => $pwProduct_id,
                        'he_d_type' => $array_details[$i]->type,
                        'he_d_sub_type' => (!empty($array_details[$i]->sub_type)) ? $array_details[$i]->sub_type : null,
                        'he_d_thick' => (!empty($array_details[$i]->thick)) ? $array_details[$i]->thick : null,
                        'he_d_price' => $array_details[$i]->price,
                    ]);
                }
            }
        } elseif ($request->get('type_wire') == 10) {
            // ท่อทองแดง , Copper Tube
            $pwProduct_id = DB::table('product_copper')->insertGetId([
                'c_brand_id' => ($request->get('c_brand_id') == '') ? null : $request->get('c_brand_id'),
                'c_brand_name' => ($request->get('c_brand_name') == '') ? '-' : $request->get('c_brand_name'),
                'c_type' => ($request->get('c_type') == '') ? null : $request->get('c_type'),
                'c_type_name' => ($request->get('c_type_name') == '') ? null : $request->get('c_type_name'),
                'c_name_type' => ($request->get('c_name_type') == '') ? null : $request->get('c_name_type'),
                'c1_ns_id' => ($request->get('c1_ns_id') == '') ? null : $request->get('c1_ns_id'),
                'ct1_ns_od' => ($request->get('ct1_ns_od') == '') ? null : $request->get('ct1_ns_od'),
                'c1_od_in' => ($request->get('c1_od_in') == '') ? null : $request->get('c1_od_in'),
                'ct1_od_mm' => ($request->get('ct1_od_mm') == '') ? null : $request->get('ct1_od_mm'),
                'c1_nwt_in' => ($request->get('c1_nwt_in') == '') ? null : $request->get('c1_nwt_in'),
                'ct_mwt_mm' => ($request->get('ct_mwt_mm') == '') ? null : $request->get('ct_mwt_mm'),
                'c1_p_psi' => ($request->get('c1_p_psi') == '') ? null : $request->get('c1_p_psi'),
                'ct1_p_kpa' => ($request->get('ct1_p_kpa') == '') ? null : $request->get('ct1_p_kpa'),
                'c2_od' => ($request->get('c2_od') == '') ? null : $request->get('c2_od'),
                'c2_pack_up' => ($request->get('c2_pack_up') == '') ? null : $request->get('c2_pack_up'),
                'c2_hun' => ($request->get('c2_hun') == '') ? null : $request->get('c2_hun'),
                'c2_type' => ($request->get('c2_type') == '') ? null : $request->get('c2_type'),
                'c3_od' => ($request->get('c3_od') == '') ? null : $request->get('c3_od'),
                'c_weight' => ($request->get('c_weight') == '') ? null : $request->get('c_weight'),
                'c_price' => ($request->get('c_price') == '') ? null : $request->get('c_price'),
                'user_id' => $auth_id,
                'actby' => $auth_name,
                'created_at' => $now,
            ]);
        } elseif ($request->get('type_wire') == 11) {
            // Aeroduct
            $pwProduct_id = DB::table('product_aeroduct')->insertGetId([
                'ae_brand_id' => ($request->get('ae_brand_id') == '') ? null : $request->get('ae_brand_id'),
                'ae_brand_name' => ($request->get('ae_brand_name') == '') ? '-' : $request->get('ae_brand_name'),
                'ae_size_inch' => ($request->get('ae_size_inch') == '') ? null : $request->get('ae_size_inch'),
                'ae_size_mm' => ($request->get('ae_size_mm') == '') ? null : $request->get('ae_size_mm'),
                'ae_bareduct' => ($request->get('ae_bareduct') == '') ? null : $request->get('ae_bareduct'),
                'user_id' => $auth_id,
                'actby' => $auth_name,
                'created_at' => $now,
            ]);
            $array_details = json_decode($_POST['pwDetails']);
            if (count($array_details) > 0) {
                for ($i = 0; $i < count($array_details); $i++) {
                    DB::table('product_aeroduct_detail')->insert([
                        'aeroduct_id' => $pwProduct_id,
                        'ad_name' => $array_details[$i]->name,
                        'ad_price' => $array_details[$i]->price,
                    ]);
                }
            }
        } elseif ($request->get('type_wire') == 12) {
            // Product All
            $pwProduct_id = DB::table('product_all')->insertGetId([
                'pa_brand_id' => ($request->get('pa_brand_id') == '') ? null : $request->get('pa_brand_id'),
                'pa_brand_name' => ($request->get('pa_brand_name') == '') ? '-' : $request->get('pa_brand_name'),
                'pa_type_id' => ($request->get('pa_type_id') == '') ? null : $request->get('pa_type_id'),
                'pa_type_name' => ($request->get('pa_type_name') == '') ? null : $request->get('pa_type_name'),
                'pa_spec' => ($request->get('pa_spec') == '') ? null : $request->get('pa_spec'),
                'pa_description' => ($request->get('pa_description') == '') ? null : $request->get('pa_description'),
                'pa_size_unit' => ($request->get('pa_size_unit') == '') ? null : $request->get('pa_size_unit'),
                'pa_price' => ($request->get('pa_price') == '') ? null : $request->get('pa_price'),
                'user_id' => $auth_id,
                'actby' => $auth_name,
                'created_at' => $now,
            ]);

        } else {
            $response = ['success' => false, 'status' => 'fail',];
            return response()->json($response, 404);
        }
        $response = ['success' => true, 'status' => 'success'];
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $now = new DateTime();
        $auth_id = Auth::user()->id;
        $auth_name = Auth::user()->name;
        if ($request->type == 1) {
            // สายไฟ
            DB::table('product_wire')->where('id', '=', $id)
                ->update([
                    'pw_brand_id' => ($request->pw_brand_id == '') ? null : $request->pw_brand_id,
                    'pw_brand_name' => ($request->pw_brand_name == '') ? '-' : $request->pw_brand_name,
                    'pw_type_Id' => ($request->pw_type_Id == '') ? null : $request->pw_type_Id,
                    'pw_type_name' => ($request->pw_type_name == '') ? null : $request->pw_type_name,
                    'pw_type_volt' => ($request->pw_type_volt == '') ? null : $request->pw_type_volt,
                    'pw_type_standard' => ($request->pw_type_standard == '') ? null : $request->pw_type_standard,
                    'pw_size' => ($request->pw_size == '') ? null : $request->pw_size,
                    'pw_size_detail' => ($request->pw_size_detail == '') ? null : $request->pw_size_detail,
                    'user_id' => $auth_id,
                    'actby' => $auth_name,
                    'updated_at' => $now,
                ]);
            if (count($request->editWireDetails) > 0) {
                for ($i = 0; $i < count($request->editWireDetails); $i++) {
                    DB::table('product_wire_detail')->where('id', '=', $request->editWireDetails[$i]['id'])
                        ->update([
                            'pwd_detail' => $request->editWireDetails[$i]['pwd_detail'],
                            'pwd_price' => $request->editWireDetails[$i]['pwd_price'],
                        ]);
                }
            }
            if (count($request->newWireDetails) > 0) {
                for ($i = 0; $i < count($request->newWireDetails); $i++) {
                    if (!empty($request->newWireDetails[$i]['details'])) {
                        DB::table('product_wire_detail')->insert([
                            'pw_id' => $id,
                            'pwd_detail' => $request->newWireDetails[$i]['details'],
                            'pwd_price' => $request->newWireDetails[$i]['price'],
                        ]);
                    }
                }
            }
        } elseif ($request->type == 2) {
            // น้ำยาแอร์
            DB::table('product_air_cleaner')->where('id', '=', $id)
                ->update([
                    'ac_brand_id' => ($request->get('ac_brand_id') == '') ? null : $request->get('ac_brand_id'),
                    'ac_brand_name' => ($request->get('ac_brand_name') == '') ? '-' : $request->get('ac_brand_name'),
                    'ac_list_name' => $request->get('ac_list_name'),
                    'ac_price' => $request->get('ac_price'),
                    'user_id' => $auth_id,
                    'actby' => $auth_name,
                    'updated_at' => $now,
                ]);
        } elseif ($request->type == 3) {
            // ท่อร้อย สายไฟ
            DB::table('product_pipe_wire')
                ->where('id', '=', $id)
                ->update([
                    'pw_brand_id' => ($request->pw_brand_id == '') ? null : $request->pw_brand_id,
                    'pw_brand_name' => ($request->pw_brand_name == '') ? '-' : $request->pw_brand_name,
                    'pw_type' => $request->pw_type,
                    'pw_size_inch' => $request->get('pw_size_inch'),
                    'pw_size_mm' => $request->get('pw_size_mm'),
                    'pw_price_line' => $request->get('pw_price_line'),
                    'pw_price_m' => $request->get('pw_price_m'),
                    'user_id' => $auth_id,
                    'actby' => $auth_name,
                    'created_at' => $now,
                ]);
        } elseif ($request->type == 4) {
            // New
            //1 "SGC" ท่อ PVC สีฟ้า ท่อประปา
            //2 "SGC" ท่อ PVC สีฟ้า ท่อเซาะร่อง
            //3 "SGC" ท่อ PVC สีเหลือง งานร้อยสายไฟฟ้าและสายโทรศัพท์
            //4 "SGC" ท่อ PVC สีขาว BS งานร้อยสายไฟฟ้าและสายโทรศัพท์
            //5 "SGC" ท่อ PVC สีขาว JIS งานร้อยสายไฟฟ้าและสายโทรศัพท์
            DB::table('product_pvc_pipe')
                ->where('id', '=', $id)
                ->update([
                    'pp_brand_id' => ($request->get('pp_brand_id') == '') ? null : $request->get('pp_brand_id'),
                    'pp_brand_name' => ($request->get('pp_brand_name') == '') ? '-' : $request->get('pp_brand_name'),
                    'pp_type_pipe' => ($request->get('pp_type_pipe') == '') ? null : $request->get('pp_type_pipe'),
                    'pp_size' => ($request->get('pp_size') == '') ? null : $request->get('pp_size'),
                    'pp_laborcost' => ($request->get('pp_laborcost') == '') ? null : $request->get('pp_laborcost'),
                    'pp_count' => ($request->get('pp_count') == '') ? null : $request->get('pp_count'),
                    'user_id' => $auth_id,
                    'actby' => $auth_name,
                    'created_at' => $now,
                ]);
            if (count($request->editPdDetails) > 0) {
                for ($i = 0; $i < count($request->editPdDetails); $i++) {
                    DB::table('product_pp_detail')->where('id', '=', $request->editPdDetails[$i]['id'])
                        ->update([
                            'pp_d_class' => $request->editPdDetails[$i]['pp_d_class'],
                            'pp_d_osd' => $request->editPdDetails[$i]['pp_d_osd'],
                            'pp_d_thickness' => $request->editPdDetails[$i]['pp_d_thickness'],
                            'pp_d_price' => $request->editPdDetails[$i]['pp_d_price'],
                        ]);
                }
            }

            if (count($request->newPdDetails) > 0) {
                for ($i = 0; $i < count($request->newPdDetails); $i++) {
                    if ($request->get('pp_type_pipe_id') == 1 ||
                        $request->get('pp_type_pipe_id') == 2 ||
                        $request->get('pp_type_pipe_id') == 3) {
                        if (!empty($request->newPdDetails[$i]['class'])) {
                            DB::table('product_pp_detail')->insert([
                                'pp_id' => $id,
                                'pp_d_class' => $request->newPdDetails[$i]['class'],
                                'pp_d_osd' => null,
                                'pp_d_thickness' => null,
                                'pp_d_price' => $request->newPdDetails[$i]['price'],
                            ]);
                        }
                    } else {
                        DB::table('product_pp_detail')->insert([
                            'pp_id' => $id,
                            'pp_d_class' => null,
                            'pp_d_osd' => $request->get('pp_d_osd'),
                            'pp_d_thickness' => $request->get('pp_d_thickness'),
                            'pp_d_price' => $request->get('pp_d_price'),
                        ]);
                    }
                }
            }
        } elseif ($request->type == 5) {
            // ฉนวนใยแก้ว
            DB::table('product_fiberglass_insulation')
                ->where('id', '=', $id)
                ->update([
                    'fi_brand_id' => ($request->fi_brand_id == '') ? null : $request->fi_brand_id,
                    'fi_brand_name' => ($request->fi_brand_name == '') ? '-' : $request->fi_brand_name,
                    'fi_model' => $request->fi_model,
                    'fi_model_detail' => $request->fi_model_detail,
                    'fi_code' => $request->fi_code,
                    'fi_density' => $request->fi_density,
                    'fi_thickness' => $request->fi_thickness,
                    'fi_size' => $request->fi_size,
                    'fi_price1' => $request->fi_price1,
                    'fi_price2' => $request->fi_price2,
                    'user_id' => $auth_id,
                    'actby' => $auth_name,
                    'created_at' => $now,
                ]);
        } elseif ($request->type == 6) {
            // ฉนวนยางดำ
            DB::table('product_blackrubber_insulation')->where('id', '=', $id)
                ->update([
                    'bi_brand_id' => ($request->bi_brand_id == '') ? null : $request->bi_brand_id,
                    'bi_brand_name' => ($request->bi_brand_name == '') ? '-' : $request->bi_brand_name,
                    'bi_inch' => ($request->bi_inch == '') ? null : $request->bi_inch,
                    'bi_mm' => ($request->bi_mm == '') ? null : $request->bi_mm,
                    'bi_pipe_steel' => ($request->bi_pipe_steel == '') ? null : $request->bi_pipe_steel,
                    'user_id' => $auth_id,
                    'actby' => $auth_name,
                    'updated_at' => $now,
                ]);
            if (count($request->editPdDetails) > 0) {
                for ($i = 0; $i < count($request->editPdDetails); $i++) {
                    DB::table('product_bi_detail')->where('id', '=', $request->editPdDetails[$i]['id'])
                        ->update([
                            'bi_d_thickness' => $request->editPdDetails[$i]['bi_d_thickness'],
                            'bi_d_price' => $request->editPdDetails[$i]['bi_d_price'],
                        ]);
                }
            }
            if (count($request->newPdDetails) > 0) {
                for ($i = 0; $i < count($request->newPdDetails); $i++) {
                    if (!empty($request->newPdDetails[$i]['thickness'])) {
                        DB::table('product_bi_detail')->insert([
                            'bi_id' => $id,
                            'bi_d_thickness' => $request->newPdDetails[$i]['thickness'],
                            'bi_d_price' => $request->newPdDetails[$i]['price'],
                        ]);
                    }
                }
            }
        } elseif ($request->type == 7) {
            // PVC ท่อน้ำ
            DB::table('product_pvc_water_pipe')->where('id', '=', $id)
                ->update([
                    'pwp_brand_id' => ($request->get('pwp_brand_id') == '') ? null : $request->get('pwp_brand_id'),
                    'pwp_brand_name' => ($request->get('pwp_brand_name') == '') ? '-' : $request->get('pwp_brand_name'),
                    'pwp_type' => ($request->get('pwp_type') == '') ? null : $request->get('pwp_type'),
                    'pwp_name' => ($request->get('pwp_name') == '') ? null : $request->get('pwp_name'),
                    'pwp_type2' => ($request->get('pwp_type2') == '') ? null : $request->get('pwp_type2'),
                    'pwp_mill' => ($request->get('pwp_mill') == '') ? null : $request->get('pwp_mill'),
                    'pwp_inch' => ($request->get('pwp_inch') == '') ? null : $request->get('pwp_inch'),
                    'pwp_count' => ($request->get('pwp_count') == '') ? null : $request->get('pwp_count'),
                    'pwp_laborcost' => ($request->get('pwp_laborcost') == '') ? null : $request->get('pwp_laborcost'),
                    'user_id' => $auth_id,
                    'actby' => $auth_name,
                    'updated_at' => $now,
                ]);

            if ($request->get('pwp_type') == 1) {
                if (count($request->editPdDetails) > 0) {
                    for ($i = 0; $i < count($request->editPdDetails); $i++) {
                        DB::table('product_pwp_detail')->where('id', '=', $request->editPdDetails[$i]['id'])
                            ->update([
                                'pwp_d_class' => $request->editPdDetails[$i]['pwp_d_class'],
                                'pwp_d_price' => $request->editPdDetails[$i]['pwp_d_price'],
                            ]);
                    }
                }
                if (count($request->newPdDetails) > 0) {
                    for ($i = 0; $i < count($request->newPdDetails); $i++) {
                        if (!empty($request->newPdDetails[$i]['class'])) {
                            DB::table('product_pwp_detail')->insert([
                                'pwp_id' => $id,
                                'pwp_d_class' => $request->newPdDetails[$i]['class'],
                                'pwp_d_price' => $request->newPdDetails[$i]['price'],
                            ]);
                        }
                    }
                }
            } else if ($request->get('pwp_type') == 2) {
                if (count($request->editPdDetails) > 0) {
                    for ($i = 0; $i < count($request->editPdDetails); $i++) {
                        DB::table('product_pwp_detail')->where('id', '=', $request->editPdDetails[$i]['id'])
                            ->update([
                                'pwp_d_price' => $request->editPdDetails[$i]['pwp_d_price'],
                            ]);
                    }
                }
            }
        } elseif ($request->type == 8) {
            // HDPE งานประปา
            DB::table('product_hdpe_plumbing')->where('id', '=', $id)
                ->update([
                    'hp_brand_id' => ($request->get('hp_brand_id') == '') ? null : $request->get('hp_brand_id'),
                    'hp_brand_name' => ($request->get('hp_brand_name') == '') ? '-' : $request->get('hp_brand_name'),
                    'hp_type' => ($request->get('hp_type') == '') ? null : $request->get('hp_type'),
                    'hp_fitting_name' => ($request->get('hp_fitting_name') == '') ? null : $request->get('hp_fitting_name'),
                    'hp_od_mm' => ($request->get('hp_od_mm') == '') ? null : $request->get('hp_od_mm'),
                    'hp_od_inch' => ($request->get('hp_od_inch') == '') ? null : $request->get('hp_od_inch'),
                    'hp_fitting_price' => ($request->get('hp_fitting_price') == '') ? null : $request->get('hp_fitting_price'),
                    'user_id' => $auth_id,
                    'actby' => $auth_name,
                    'updated_at' => $now,
                ]);
            if ($request->get('hp_type') == 1) {
                if (count($request->editPdDetails) > 0) {
                    for ($i = 0; $i < count($request->editPdDetails); $i++) {
                        DB::table('product_hp_detail')->where('id', '=', $request->editPdDetails[$i]['id'])
                            ->update([
                                'hp_d_name' => $request->editPdDetails[$i]['hp_d_name'],
                                'hp_d_pe80' => (!empty($request->editPdDetails[$i]['hp_d_pe80'])) ? $request->editPdDetails[$i]['hp_d_pe80'] : null,
                                'hp_d_pe100' => (!empty($request->editPdDetails[$i]['hp_d_pe100'])) ? $request->editPdDetails[$i]['hp_d_pe100'] : null,
                                'hp_d_price' => $request->editPdDetails[$i]['hp_d_price'],
                            ]);
                    }
                }
                if (count($request->newPdDetails) > 0) {
                    for ($i = 0; $i < count($request->newPdDetails); $i++) {
                        if (!empty($request->newPdDetails[$i]['name'])) {
                            DB::table('product_hp_detail')->insert([
                                'hp_id' => $id,
                                'hp_d_name' => $request->newPdDetails[$i]['name'],
                                'hp_d_pe80' => $request->newPdDetails[$i]['pe80'],
                                'hp_d_pe100' => $request->newPdDetails[$i]['pe100'],
                                'hp_d_price' => $request->newPdDetails[$i]['price'],
                            ]);
                        }
                    }
                }
            }
        } elseif ($request->type == 9) {
            // HDPE งานไฟฟ้า
            DB::table('product_hdpe_electricity')->where('id', '=', $id)
                ->update([
                    'hdpe_brand_id' => ($request->get('hdpe_brand_id') == '') ? null : $request->get('hdpe_brand_id'),
                    'hdpe_brand_name' => ($request->get('hdpe_brand_name') == '') ? '-' : $request->get('hdpe_brand_name'),
                    'hdpe_type' => ($request->get('hdpe_type') == '') ? null : $request->get('hdpe_type'),
                    'hdpe_type_name' => ($request->get('hdpe_type_name') == '') ? null : $request->get('hdpe_type_name'),
                    'hdpe_od_mm' => ($request->get('hdpe_od_mm') == '') ? null : $request->get('hdpe_od_mm'),
                    'hdpe_od_inch' => ($request->get('hdpe_od_inch') == '') ? null : $request->get('hdpe_od_inch'),
                    'user_id' => $auth_id,
                    'actby' => $auth_name,
                    'updated_at' => $now,
                ]);
            if (count($request->editPdDetails) > 0) {
                for ($i = 0; $i < count($request->editPdDetails); $i++) {
                    DB::table('product_he_detail')->where('id', '=', $request->editPdDetails[$i]['id'])
                        ->update([
                            'he_d_type' => $request->editPdDetails[$i]['he_d_type'],
                            'he_d_sub_type' => (!empty($request->editPdDetails[$i]['he_d_sub_type'])) ? $request->editPdDetails[$i]['he_d_sub_type'] : null,
                            'he_d_thick' => (!empty($request->editPdDetails[$i]['he_d_thick'])) ? $request->editPdDetails[$i]['he_d_thick'] : null,
                            'he_d_price' => $request->editPdDetails[$i]['he_d_price'],
                        ]);
                }
            }
            if (count($request->newPdDetails) > 0) {
                for ($i = 0; $i < count($request->newPdDetails); $i++) {
                    if (!empty($request->newPdDetails[$i]['type'])) {
                        DB::table('product_he_detail')->insert([
                            'he_id' => $id,
                            'he_d_type' => $request->newPdDetails[$i]['type'],
                            'he_d_sub_type' => (!empty($request->newPdDetails[$i]['sub_type'])) ? $request->newPdDetails[$i]['sub_type'] : null,
                            'he_d_thick' => (!empty($request->newPdDetails[$i]['thick'])) ? $request->newPdDetails[$i]['thick'] : null,
                            'he_d_price' => $request->newPdDetails[$i]['price'],
                        ]);
                    }
                }
            }
        } elseif ($request->type == 10) {
            // ท่อทองแดง  Copper Tube
            DB::table('product_copper')->where('id', '=', $id)
                ->update([
                    'c_brand_id' => ($request->get('c_brand_id') == '') ? null : $request->get('c_brand_id'),
                    'c_brand_name' => ($request->get('c_brand_name') == '') ? '-' : $request->get('c_brand_name'),
                    'c_type' => ($request->get('c_type') == '') ? null : $request->get('c_type'),
                    'c_type_name' => ($request->get('c_type_name') == '') ? null : $request->get('c_type_name'),
                    'c_name_type' => ($request->get('c_name_type') == '') ? null : $request->get('c_name_type'),
                    'c1_ns_id' => ($request->get('c1_ns_id') == '') ? null : $request->get('c1_ns_id'),
                    'ct1_ns_od' => ($request->get('ct1_ns_od') == '') ? null : $request->get('ct1_ns_od'),
                    'c1_od_in' => ($request->get('c1_od_in') == '') ? null : $request->get('c1_od_in'),
                    'ct1_od_mm' => ($request->get('ct1_od_mm') == '') ? null : $request->get('ct1_od_mm'),
                    'c1_nwt_in' => ($request->get('c1_nwt_in') == '') ? null : $request->get('c1_nwt_in'),
                    'ct_mwt_mm' => ($request->get('ct_mwt_mm') == '') ? null : $request->get('ct_mwt_mm'),
                    'c1_p_psi' => ($request->get('c1_p_psi') == '') ? null : $request->get('c1_p_psi'),
                    'ct1_p_kpa' => ($request->get('ct1_p_kpa') == '') ? null : $request->get('ct1_p_kpa'),
                    'c2_od' => ($request->get('c2_od') == '') ? null : $request->get('c2_od'),
                    'c2_pack_up' => ($request->get('c2_pack_up') == '') ? null : $request->get('c2_pack_up'),
                    'c2_hun' => ($request->get('c2_hun') == '') ? null : $request->get('c2_hun'),
                    'c2_type' => ($request->get('c2_type') == '') ? null : $request->get('c2_type'),
                    'c3_od' => ($request->get('c3_od') == '') ? null : $request->get('c3_od'),
                    'c_weight' => ($request->get('c_weight') == '') ? null : $request->get('c_weight'),
                    'c_price' => ($request->get('c_price') == '') ? null : $request->get('c_price'),
                    'user_id' => $auth_id,
                    'actby' => $auth_name,
                    'updated_at' => $now,
                ]);
        } elseif ($request->type == 11) {
            // Aeroduct
            DB::table('product_aeroduct')->where('id', '=', $id)
                ->update([
                    'ae_brand_id' => ($request->ae_brand_id == '') ? null : $request->ae_brand_id,
                    'ae_brand_name' => ($request->ae_brand_name == '') ? '-' : $request->ae_brand_name,
                    'ae_size_inch' => ($request->ae_size_inch == '') ? null : $request->ae_size_inch,
                    'ae_size_mm' => ($request->ae_size_mm == '') ? null : $request->ae_size_mm,
                    'ae_bareduct' => ($request->ae_bareduct == '') ? null : $request->ae_bareduct,
                    'user_id' => $auth_id,
                    'actby' => $auth_name,
                    'updated_at' => $now,
                ]);
            if (count($request->editPdDetails) > 0) {
                for ($i = 0; $i < count($request->editPdDetails); $i++) {
                    DB::table('product_aeroduct_detail')->where('id', '=', $request->editPdDetails[$i]['id'])
                        ->update([
                            'ad_name' => $request->editPdDetails[$i]['ad_name'],
                            'ad_price' => $request->editPdDetails[$i]['ad_price'],
                        ]);
                }
            }
            if (count($request->newPdDetails) > 0) {
                for ($i = 0; $i < count($request->newPdDetails); $i++) {
                    if (!empty($request->newPdDetails[$i]['name'])) {
                        DB::table('product_aeroduct_detail')->insert([
                            'aeroduct_id' => $id,
                            'ad_name' => $request->newPdDetails[$i]['name'],
                            'ad_price' => $request->newPdDetails[$i]['price'],
                        ]);
                    }
                }
            }
        } elseif ($request->type == 12) {
            // Product All
            DB::table('product_all')->where('id', '=', $id)
                ->update([
                    'pa_brand_id' => ($request->get('pa_brand_id') == '') ? null : $request->get('pa_brand_id'),
                    'pa_brand_name' => ($request->get('pa_brand_name') == '') ? '-' : $request->get('pa_brand_name'),
                    'pa_type_id' => ($request->get('pa_type_id') == '') ? null : $request->get('pa_type_id'),
                    'pa_type_name' => ($request->get('pa_type_name') == '') ? null : $request->get('pa_type_name'),
                    'pa_spec' => ($request->get('pa_spec') == '') ? null : $request->get('pa_spec'),
                    'pa_description' => ($request->get('pa_description') == '') ? null : $request->get('pa_description'),
                    'pa_size_unit' => ($request->get('pa_size_unit') == '') ? null : $request->get('pa_size_unit'),
                    'pa_price' => ($request->get('pa_price') == '') ? null : $request->get('pa_price'),
                    'user_id' => $auth_id,
                    'actby' => $auth_name,
                    'updated_at' => $now,
                ]);
        } else {
            $response = ['success' => false, 'status' => 'fail',];
            return response()->json($response, 404);
        }
        $response = ['success' => true, 'status' => 'success', 'data' => $request->all()];
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $now = new DateTime();
        DB::table('product_wire')->where('id', '=', $id)->update(['deleted_at' => $now]);
        DB::table('product_wire_detail')->where('pw_id', '=', $id)->update(['deleted_at' => $now]);
        return response()->json([
            'success' => 'success',
        ], 200);
    }

    public function deleteDetail($id)
    {
        $now = new DateTime();
        DB::table('product_wire_detail')->where('id', '=', $id)->update(['deleted_at' => $now]);
        return response()->json([
            'success' => 'success',
        ], 200);
    }

    public function showDetails($type, $id)
    {
        if ($type == 1) {
            // สายไฟ
            $data = DB::table('product_wire')->where('id', '=', $id)->first();
            $dataDetail = DB::table('product_wire_detail')
                ->where('pw_id', '=', $id)
                ->whereNull('deleted_at')
                ->get();
        } elseif ($type == 2) {
            // น้ำยาแอร์
            $data = DB::table('product_air_cleaner')->where('id', '=', $id)->first();
            $dataDetail = null;
        } elseif ($type == 3) {
            // ท่อร้อย สายไฟ
            $data = DB::table('product_pipe_wire')->where('id', '=', $id)->first();
            $dataDetail = null;
        } elseif ($type == 4) {
            $data = DB::table('product_hdpe_electricity')->where('id', '=', $id)->first();
            $dataDetail = DB::table('product_he_detail')
                ->where('he_id', '=', $id)
                ->whereNull('deleted_at')
                ->get();
        } elseif ($type == 5) {
            // ฉนวนใยแก้ว
            $data = DB::table('product_fiberglass_insulation')->where('id', '=', $id)->first();
            $dataDetail = null;
        } elseif ($type == 6) {
            // ฉนวนยางดำ
            $data = DB::table('product_blackrubber_insulation')->where('id', '=', $id)->first();
            $dataDetail = DB::table('product_bi_detail')
                ->where('bi_id', '=', $id)
                ->whereNull('deleted_at')
                ->get();
        } elseif ($type == 7) {
            // PVC ท่อน้ำ
            $data = DB::table('product_pvc_water_pipe')->where('id', '=', $id)->first();
            $dataDetail = DB::table('product_pwp_detail')
                ->where('pwp_id', '=', $id)
                ->whereNull('deleted_at')
                ->get();
        } elseif ($type == 8) {
            // HDPE งานประปา
            $data = DB::table('product_hdpe_plumbing')->where('id', '=', $id)->first();
            $dataDetail = DB::table('product_hp_detail')
                ->where('hp_id', '=', $id)
                ->whereNull('deleted_at')
                ->get();
        } elseif ($type == 9) {
            // HDPE งานไฟฟ้า
            $data = DB::table('product_hdpe_electricity')->where('id', '=', $id)->first();
            $dataDetail = DB::table('product_he_detail')
                ->where('he_id', '=', $id)
                ->whereNull('deleted_at')
                ->get();
        } elseif ($type == 10) {
            //ท่อทองแดง Copper Tube
            $data = DB::table('product_copper')->where('id', '=', $id)->first();
            $dataDetail = null;
        } elseif ($type == 11) {
            // Aeroduct
            $data = DB::table('product_aeroduct')->where('id', '=', $id)->first();
            $dataDetail = DB::table('product_aeroduct_detail')
                ->where('aeroduct_id', '=', $id)
                ->whereNull('deleted_at')
                ->get();
        } elseif ($type == 12) {
            // PVC
            $data = DB::table('product_pvc_pipe')->where('id', '=', $id)->first();
            $dataDetail = DB::table('product_pp_detail')
                ->where('pp_id', '=', $id)
                ->whereNull('deleted_at')
                ->get();
        } elseif ($type == 14) {
            // PRODUCT ALL
            $data = DB::table('product_all')->where('id', '=', $id)->first();
            $dataDetail = null;
        } else {
            $data = null;
            $dataDetail = null;
        }
        return response()->json([
            'product' => $data,
            'productDetail' => $dataDetail,
        ], 200);
    }

    public function deleteProduct($type, $id)
    {
        $now = new DateTime();
        if ($type == 1) {
            DB::table('product_wire')->where('id', '=', $id)->update(['deleted_at' => $now]);
            DB::table('product_wire_detail')->where('pw_id', '=', $id)->update(['deleted_at' => $now]);
        } elseif ($type == 2) {
            DB::table('product_air_cleaner')->where('id', '=', $id)->update(['deleted_at' => $now]);
        } elseif ($type == 3) {
            DB::table('product_pipe_wire')->where('id', '=', $id)->update(['deleted_at' => $now]);
        } elseif ($type == 4) {
            DB::table('product_hdpe_electricity')->where('id', '=', $id)->update(['deleted_at' => $now]);
            DB::table('product_he_detail')->where('he_id', '=', $id)->update(['deleted_at' => $now]);
        } elseif ($type == 5) {
            DB::table('product_fiberglass_insulation')->where('id', '=', $id)->update(['deleted_at' => $now]);
        } elseif ($type == 6) {
            DB::table('product_blackrubber_insulation')->where('id', '=', $id)->update(['deleted_at' => $now]);
            DB::table('product_bi_detail')->where('aeroduct_id', '=', $id)->update(['deleted_at' => $now]);
        } elseif ($type == 7) {
            DB::table('product_pvc_water_pipe')->where('id', '=', $id)->update(['deleted_at' => $now]);
            DB::table('product_pwp_detail')->where('pwp_id', '=', $id)->update(['deleted_at' => $now]);
        } elseif ($type == 8) {
            DB::table('product_hdpe_plumbing')->where('id', '=', $id)->update(['deleted_at' => $now]);
            DB::table('product_hp_detail')->where('hp_id', '=', $id)->update(['deleted_at' => $now]);
        } elseif ($type == 9) {
            DB::table('product_hdpe_electricity')->where('id', '=', $id)->update(['deleted_at' => $now]);
            DB::table('product_he_detail')->where('he_id', '=', $id)->update(['deleted_at' => $now]);
        } elseif ($type == 10) {
            DB::table('product_copper')->where('id', '=', $id)->update(['deleted_at' => $now]);
        } elseif ($type == 11) {
            DB::table('product_aeroduct')->where('id', '=', $id)->update(['deleted_at' => $now]);
            DB::table('product_aeroduct_detail')->where('aeroduct_id', '=', $id)->update(['deleted_at' => $now]);
        } elseif ($type == 12) {
            DB::table('product_pvc_pipe')->where('id', '=', $id)->update(['deleted_at' => $now]);
            DB::table('product_pp_detail')->where('pp_id', '=', $id)->update(['deleted_at' => $now]);
        } elseif ($type == 13) {
            DB::table('product_all')->where('id', '=', $id)->update(['deleted_at' => $now]);
        } else {
            $response = ['success' => false, 'status' => 'fail',];
            return response()->json($response, 404);
        }
        return response()->json([
            'success' => 'success',
        ], 200);
    }

    // API Product ALL
    public function apiWire(Request $request)
    {
        if ($request->input('client')) {
            return DB::table('product_wire')
                ->select('product_wire.*')
                ->whereNull('deleted_at')
                ->orderBy('air_data.air_group_id', 'desc')
                ->get();
        }
        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $columns = ['id', 'pw_brand_name', 'pw_type_Id', 'pw_type_name', 'pw_type_volt', 'pw_type_standard', 'pw_size', 'pw_size_detail', 'actby'];


        $query = DB::table('product_wire')
            ->select('product_wire.*')
            ->whereNull('deleted_at')
            ->orderBy($columns[$column], $dir);
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('pw_brand_name', 'like', '%' . $searchValue . '%');
                $query->orWhere('pw_type_name', 'like', '%' . $searchValue . '%');
                $query->orWhere('pw_type_volt', 'like', '%' . $searchValue . '%');
                $query->orWhere('pw_type_standard', 'like', '%' . $searchValue . '%');
                $query->orWhere('pw_size', 'like', '%' . $searchValue . '%');
                $query->orWhere('pw_size_detail', 'like', '%' . $searchValue . '%');
                $query->orWhere('actby', 'like', '%' . $searchValue . '%');
            });
        }
        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function apiAirCleaners(Request $request)
    {
        if ($request->input('client')) {
            return DB::table('product_air_cleaner')
                ->select('product_air_cleaner.*')
                ->whereNull('deleted_at')
                ->get();
        }

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $columns = ['id', 'ac_brand_name', 'ac_list_name', 'ac_price', 'actby'];

        $query = DB::table('product_air_cleaner')
            ->select('product_air_cleaner.*')
            ->whereNull('deleted_at')
            ->orderBy($columns[$column], $dir);
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('ac_brand_name', 'like', '%' . $searchValue . '%');
                $query->orWhere('ac_list_name', 'like', '%' . $searchValue . '%');
                $query->orWhere('ac_price', 'like', '%' . $searchValue . '%');
                $query->orWhere('actby', 'like', '%' . $searchValue . '%');
            });
        }
        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function apiPipeHotWire(Request $request)
    {
        if ($request->input('client')) {
            return DB::table('product_pipe_wire')
                ->select('product_pipe_wire.*')
                ->whereNull('deleted_at')
                ->get();
        }

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $columns = ['id', 'pw_brand_name', 'pw_type', 'pw_size_inch', 'pw_size_mm', 'pw_price_line', 'pw_price_m', 'actby'];

        $query = DB::table('product_pipe_wire')
            ->select('product_pipe_wire.*')
            ->whereNull('deleted_at')
            ->orderBy($columns[$column], $dir);
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('pw_brand_name', 'like', '%' . $searchValue . '%');
                $query->orWhere('pw_type', 'like', '%' . $searchValue . '%');
                $query->orWhere('pw_size_inch', 'like', '%' . $searchValue . '%');
                $query->orWhere('pw_size_mm', 'like', '%' . $searchValue . '%');
                $query->orWhere('pw_price_line', 'like', '%' . $searchValue . '%');
                $query->orWhere('pw_price_m', 'like', '%' . $searchValue . '%');
                $query->orWhere('actby', 'like', '%' . $searchValue . '%');
            });
        }
        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function apiFiberglassInsulation(Request $request)
    {
        if ($request->input('client')) {
            return DB::table('product_fiberglass_insulation')
                ->select('product_fiberglass_insulation.*')
                ->whereNull('deleted_at')
                ->get();
        }
        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $columns = ['id', 'fi_brand_name', 'fi_model', 'fi_model_detail', 'fi_code', 'fi_density', 'fi_thickness', 'fi_size', 'fi_price1', 'fi_price2', 'actby'];
        $query = DB::table('product_fiberglass_insulation')
            ->select('product_fiberglass_insulation.*')
            ->whereNull('deleted_at')
            ->orderBy($columns[$column], $dir);
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('fi_brand_name', 'like', '%' . $searchValue . '%');
                $query->orWhere('fi_model', 'like', '%' . $searchValue . '%');
                $query->orWhere('fi_code', 'like', '%' . $searchValue . '%');
                $query->orWhere('fi_density', 'like', '%' . $searchValue . '%');
                $query->orWhere('fi_thickness', 'like', '%' . $searchValue . '%');
                $query->orWhere('fi_size', 'like', '%' . $searchValue . '%');
                $query->orWhere('fi_price1', 'like', '%' . $searchValue . '%');
                $query->orWhere('fi_price2', 'like', '%' . $searchValue . '%');
                $query->orWhere('actby', 'like', '%' . $searchValue . '%');
            });
        }
        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function apiBlackRubberInsulation(Request $request)
    {
        if ($request->input('client')) {
            return DB::table('product_blackrubber_insulation')
                ->select('product_blackrubber_insulation.*')
                ->whereNull('deleted_at')
                ->get();
        }
        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $columns = ['id', 'bi_brand_name', 'bi_inch', 'bi_mm', 'bi_pipe_steel', 'actby'];
        $query = DB::table('product_blackrubber_insulation')
            ->select('product_blackrubber_insulation.*')
            ->whereNull('deleted_at')
            ->orderBy($columns[$column], $dir);
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('bi_brand_name', 'like', '%' . $searchValue . '%');
                $query->orWhere('bi_inch', 'like', '%' . $searchValue . '%');
                $query->orWhere('bi_mm', 'like', '%' . $searchValue . '%');
                $query->orWhere('bi_pipe_steel', 'like', '%' . $searchValue . '%');
                $query->orWhere('actby', 'like', '%' . $searchValue . '%');
            });
        }
        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function apiPvc(Request $request)
    {
        if ($request->input('client')) {
            return DB::table('product_pvc_pipe')
                ->select('product_pvc_pipe.*')
                ->whereNull('deleted_at')
                ->get();
        }
        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $columns = ['id', 'pp_brand_name', 'pp_type_pipe', 'pp_size', 'pp_laborcost', 'pp_count', 'actby'];
        $query = DB::table('product_pvc_pipe')
            ->select('product_pvc_pipe.*')
            ->whereNull('deleted_at')
            ->orderBy($columns[$column], $dir);
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('pp_brand_name', 'like', '%' . $searchValue . '%');
                $query->orWhere('pp_type_pipe', 'like', '%' . $searchValue . '%');
                $query->orWhere('pp_size', 'like', '%' . $searchValue . '%');
                $query->orWhere('actby', 'like', '%' . $searchValue . '%');
            });
        }
        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function apiPvcWaterPipe(Request $request)
    {
        if ($request->input('client')) {
            return DB::table('product_pvc_water_pipe')
                ->select('product_pvc_water_pipe.*')
                ->whereNull('deleted_at')
                ->get();
        }
        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $columns = ['id', 'pwp_brand_name', 'pwp_type', 'pwp_type2', 'pwp_mill', 'pwp_inch', 'actby'];
        $query = DB::table('product_pvc_water_pipe')
            ->select('product_pvc_water_pipe.*')
            ->whereNull('deleted_at')
            ->orderBy($columns[$column], $dir);
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('pwp_brand_name', 'like', '%' . $searchValue . '%');
                $query->orWhere('pwp_type', 'like', '%' . $searchValue . '%');
                $query->orWhere('pwp_type2', 'like', '%' . $searchValue . '%');
                $query->orWhere('pwp_mill', 'like', '%' . $searchValue . '%');
                $query->orWhere('pwp_inch', 'like', '%' . $searchValue . '%');
                $query->orWhere('actby', 'like', '%' . $searchValue . '%');
            });
        }
        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function apiHdpeWaterwork(Request $request)
    {
        if ($request->input('client')) {
            return DB::table('product_hdpe_plumbing')
                ->select('product_hdpe_plumbing.*')
                ->whereNull('deleted_at')
                ->get();
        }
        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $columns = ['id', 'hp_brand_name', 'hp_type', 'hp_od_mm', 'hp_od_inch', 'hp_fitting_name', 'hp_fitting_price', 'actby'];
        $query = DB::table('product_hdpe_plumbing')
            ->select('product_hdpe_plumbing.*')
            ->whereNull('deleted_at')
            ->orderBy($columns[$column], $dir);
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('hp_brand_name', 'like', '%' . $searchValue . '%');
                $query->orWhere('hp_type', 'like', '%' . $searchValue . '%');
                $query->orWhere('hp_fitting_name', 'like', '%' . $searchValue . '%');
                $query->orWhere('hp_od_mm', 'like', '%' . $searchValue . '%');
                $query->orWhere('hp_od_inch', 'like', '%' . $searchValue . '%');
                $query->orWhere('hp_fitting_name', 'like', '%' . $searchValue . '%');
                $query->orWhere('actby', 'like', '%' . $searchValue . '%');
            });
        }
        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function apiHdpeElectricalWork(Request $request)
    {
        if ($request->input('client')) {
            return DB::table('product_hdpe_electricity')
                ->select('product_hdpe_electricity.*')
                ->whereNull('deleted_at')
                ->get();
        }
        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $columns = ['id', 'hdpe_brand_name', 'hdpe_type', 'hdpe_type_name', 'hdpe_od_mm', 'hdpe_od_inch', 'actby'];
        $query = DB::table('product_hdpe_electricity')
            ->select('product_hdpe_electricity.*')
            ->whereNull('deleted_at')
            ->orderBy($columns[$column], $dir);
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('hdpe_brand_name', 'like', '%' . $searchValue . '%');
                $query->orWhere('hdpe_type_name', 'like', '%' . $searchValue . '%');
                $query->orWhere('hdpe_od_mm', 'like', '%' . $searchValue . '%');
                $query->orWhere('hdpe_od_inch', 'like', '%' . $searchValue . '%');
                $query->orWhere('actby', 'like', '%' . $searchValue . '%');
            });
        }
        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function apiCopperTube(Request $request)
    {
        if ($request->input('client')) {
            return DB::table('product_copper')
                ->select('product_copper.*')
                ->whereNull('deleted_at')
                ->get();
        }
        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $columns = ['id', 'c_brand_name', 'c_type_name', 'c_name_type', 'c_weight', 'c_price', 'actby'];
        $query = DB::table('product_copper')
            ->select('product_copper.*')
            ->whereNull('deleted_at')
            ->orderBy($columns[$column], $dir);
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('c_type_name', 'like', '%' . $searchValue . '%');
                $query->orWhere('c1_ns_id', 'like', '%' . $searchValue . '%');
                $query->orWhere('ct1_ns_od', 'like', '%' . $searchValue . '%');
                $query->orWhere('c1_od_in', 'like', '%' . $searchValue . '%');
                $query->orWhere('ct1_od_mm', 'like', '%' . $searchValue . '%');
                $query->orWhere('c1_nwt_in', 'like', '%' . $searchValue . '%');
                $query->orWhere('ct_mwt_mm', 'like', '%' . $searchValue . '%');
                $query->orWhere('c1_p_psi', 'like', '%' . $searchValue . '%');
                $query->orWhere('ct1_p_kpa', 'like', '%' . $searchValue . '%');
                $query->orWhere('c2_od', 'like', '%' . $searchValue . '%');
                $query->orWhere('c2_pack_up', 'like', '%' . $searchValue . '%');
                $query->orWhere('c2_hun', 'like', '%' . $searchValue . '%');
                $query->orWhere('c2_type', 'like', '%' . $searchValue . '%');
                $query->orWhere('c3_od', 'like', '%' . $searchValue . '%');
                $query->orWhere('c_weight', 'like', '%' . $searchValue . '%');
                $query->orWhere('c_price', 'like', '%' . $searchValue . '%');
                $query->orWhere('actby', 'like', '%' . $searchValue . '%');
                $query->orWhere('actby', 'like', '%' . $searchValue . '%');
            });
        }
        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function apiAeroduct(Request $request)
    {
        if ($request->input('client')) {
            return DB::table('product_aeroduct')
                ->select('product_aeroduct.*')
                ->whereNull('deleted_at')
                ->get();
        }
        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $columns = ['id', 'ae_brand_name', 'ae_size_inch', 'ae_size_mm', 'ae_bareduct', 'actby'];
        $query = DB::table('product_aeroduct')
            ->select('product_aeroduct.*')
            ->whereNull('deleted_at')
            ->orderBy($columns[$column], $dir);
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('ae_brand_name', 'like', '%' . $searchValue . '%');
                $query->orWhere('ae_size_inch', 'like', '%' . $searchValue . '%');
                $query->orWhere('ae_size_mm', 'like', '%' . $searchValue . '%');
                $query->orWhere('ae_bareduct', 'like', '%' . $searchValue . '%');
                $query->orWhere('actby', 'like', '%' . $searchValue . '%');
            });
        }
        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function apiProductAll(Request $request)
    {
        if ($request->input('client')) {
            return DB::table('product_all')
                ->select('product_all.*')
                ->whereNull('deleted_at')
                ->get();
        }
        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $columns = ['id', 'pa_brand_name', 'pa_type_name', 'pa_spec', 'pa_description', 'pa_size_unit', 'pa_price	', 'actby'];
        $query = DB::table('product_all')
            ->select('product_all.*')
            ->whereNull('deleted_at')
            ->orderBy($columns[$column], $dir);
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('pa_brand_name', 'like', '%' . $searchValue . '%');
                $query->orWhere('pa_type_name', 'like', '%' . $searchValue . '%');
                $query->orWhere('pa_spec', 'like', '%' . $searchValue . '%');
                $query->orWhere('pa_description', 'like', '%' . $searchValue . '%');
                $query->orWhere('pa_size_unit', 'like', '%' . $searchValue . '%');
                $query->orWhere('pa_price', 'like', '%' . $searchValue . '%');
                $query->orWhere('actby', 'like', '%' . $searchValue . '%');
            });
        }
        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }
}
