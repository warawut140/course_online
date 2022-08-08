<?php

namespace App\Http\Controllers\backend;

use App\Models\AirInstall;
use App\Models\AirSpec;
use App\Models\Brands;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Image;

class AdminAirDataController extends Controller
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
        $brands = Brands::orderBy('id', 'desc')->get();
        $airGroup = DB::table('air_group')->orderBy('id', 'desc')->get();
        $airBTU = DB::table('air_btu')->orderBy('air_btu_detail', 'asc')->get();

        return view('backend.air.index-airdata', [
            'view' => 1,
            'brands' => $brands,
            'airGroup' => $airGroup,
            'airBTU' => $airBTU,
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now = new DateTime();
        $auth_id = Auth::user()->id;
        $auth_name = Auth::user()->name;
        $air_type_id = null ;
        $air_type_sub_id = null ;
        $air_type_sub_name = null ;
        if ($request->get('air_type_id') == 1) {
            $air_type_id = 1 ;
            $air_type_name = 'Room Air';
        } elseif ($request->get('air_type_id') == 2) {
            $air_type_id = 2 ;
            $air_type_name = 'Sky Air';
            $air_type_sub_id = 1 ;
            $air_type_sub_name = 'CASSETTE TYPE' ;
        }elseif ($request->get('air_type_id') == 3) {
            $air_type_id = 2 ;
            $air_type_name = 'Sky Air';
            $air_type_sub_id = 2 ;
            $air_type_sub_name = 'CEILLING TYPE' ;
        }elseif ($request->get('air_type_id') == 4) {
            $air_type_id = 2 ;
            $air_type_name = 'Sky Air';
            $air_type_sub_id = 3 ;
            $air_type_sub_name = 'DUCT TYPE' ;
        } elseif ($request->get('air_type_id') == 5) {
            $air_type_id = 3 ;
            $air_type_name = 'Package';
        } elseif ($request->get('air_type_id') == 6) {
            $air_type_id = 4 ;
            $air_type_name = 'VRV';
        }
        if ($request->get('air_group_id') == 0) {
            $air_group_id = DB::table('air_group')
                ->insertGetId(['air_group_details' => $request->get('air_group')]);
        } else {
            $air_group_id = $request->get('air_group_id');
        }
        if ($request->get('air_btu_id') == 0) {
            $air_btu_id = DB::table('air_btu')
                ->insertGetId(['air_btu_detail' => $request->get('air_btu')]);
        } else {
            $air_btu_id = $request->get('air_btu_id');
        }

        $type = $request->get('type');
        if ($type == "save") {
            if ($request->file('air_image') != null) {
                $imageFileName = 'product_air_' . str_random(5) . "." . $request->file('air_image')->getClientOriginalExtension();
                Image::make($request->file('air_image'))->save(public_path('/images/store-product/') . $imageFileName);
            } else {
                $imageFileName = null;
            }
            $airProduct_id = DB::table('air_data')->insertGetId([
                'air_type_id' => $air_type_id,
                'air_type_name' => $air_type_name,
                'air_type_sub_id' => $air_type_sub_id,
                'air_type_sub_name' => $air_type_sub_name,
                'brand_id' => $request->get('brand_id'),
                'air_group_id' => $air_group_id,
                'air_model_indoor' => $request->get('air_model_indoor'),
                'air_model_outdoor' => $request->get('air_model_outdoor'),
                'air_btu_id' => $air_btu_id,
                'air_price_list' => $request->get('air_price'),
                'air_image' => $imageFileName,
                'created_at' => $now,
                'updated_at' => null,
                'user_id' => $auth_id,
                'actby' => $auth_name,
                'type_web' => $request->get('type_web'),
            ]);
            $array_details = json_decode($_POST['air_details']);

             if(!empty($array_details[0]->details)){
                 if (count($array_details) > 0) {
                     for ($i = 0; $i < count($array_details); $i++) {
                         DB::table('air_data_details')->insert([
                             'air_data_title' => $array_details[$i]->details,
                             'air_data_value' => $array_details[$i]->value,
                             'air_data_id' => $airProduct_id,
                         ]);
                     }
                 }
             }
            if ($airProduct_id != null) {
                $response = ['success' => true, 'status' => 'success', 'request' => $request->all(),];
                return response()->json($response, 200);
            } else {
                $response = ['success' => false, 'status' => 'fail',];
                return response()->json($response, 404);
            }
        } else if ($type == "update") {
            $data =  DB::table('air_data')->where('id','=',$request->get('air_id'))->first();
            if ($request->file('air_image') != null) {
                File::delete(public_path() . '/images/store-product/' . $data->air_image);
                $imageFileName = 'product_air_' . str_random(5) . "." . $request->file('air_image')->getClientOriginalExtension();
                Image::make($request->file('air_image'))->save(public_path('/images/store-product/') . $imageFileName);
            } else {
                $imageFileName = $data->air_image;
            }
            DB::table('air_data')->where('id','=',$request->get('air_id'))->update([
                'air_type_id' => $air_type_id,
                'air_type_name' => $air_type_name,
                'air_type_sub_id' => $air_type_sub_id,
                'air_type_sub_name' => $air_type_sub_name,
                'brand_id' => $request->get('brand_id'),
                'air_group_id' => $air_group_id,
                'air_model_indoor' => $request->get('air_model_indoor'),
                'air_model_outdoor' => $request->get('air_model_outdoor'),
                'air_btu_id' => $air_btu_id,
                'air_price_list' => $request->get('air_price'),
                'air_image' => $imageFileName,
                'updated_at' => $now,
                'user_id' => $auth_id,
                'actby' => $auth_name,
                'type_web' => $request->get('type_web'),
            ]);
            $array_details = json_decode($_POST['air_details']);
            if (count($array_details) > 0) {
                for ($i = 0; $i < count($array_details); $i++) {
                    DB::table('air_data_details')->where('id','=',$array_details[$i]->id)
                        ->update([
                        'air_data_title' => $array_details[$i]->air_data_title,
                        'air_data_value' => $array_details[$i]->air_data_value,
                    ]);
                }
            }
            if(!isset($_POST['air_details_new'])){
                $array_details_new = json_decode($_POST['air_details_new']);
                if (count($array_details_new) > 0) {
                    for ($i = 0; $i < count($array_details_new); $i++) {
                        DB::table('air_data_details')->insert([
                            'air_data_title' => $array_details_new[$i]->details,
                            'air_data_value' => $array_details_new[$i]->value,
                            'air_data_id' => $request->get('air_id'),
                        ]);

                    }
                }
            }
            $response = ['success' => true, 'status' => 'success', 'request' => $request->all(),];
            return response()->json($response, 200);
        } else {
            $response = ['success' => false, 'status' => 'fail',];
            return response()->json($response, 404);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productAir = DB::table('air_data')
            ->join('brands', 'air_data.brand_id', '=', 'brands.id')
            ->join('air_group', 'air_data.air_group_id', '=', 'air_group.id')
            ->join('air_btu', 'air_data.air_btu_id', '=', 'air_btu.id')
            ->select('air_data.*', 'air_group.air_group_details',
                'air_btu.air_btu_detail', 'brands.name')
            ->where('air_data.id','=',$id)
            ->orderBy('air_data.air_group_id', 'desc')
            ->first();
        $productAirDetail =  DB::table('air_data_details')
            ->where('air_data_id','=',$id)
            ->get();
        return response()->json([
            'product' => $productAir ,
            'productDetail' => $productAirDetail ,
        ],200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $now = new DateTime();
//        $data =  DB::table('air_data')->where('id','=',$id)->first();
//        File::delete(public_path() . '/images/store-product/' . $data->air_image);
        DB::table('air_data')->where('id','=',$id)->update(['deleted_at' => 1 ]);
        DB::table('air_specs')->where('air_data_id','=',$id)->update(['deleted_at' => $now ]);
//        DB::table('air_data_details')->where('air_data_id','=',$id)->delete();
        return response()->json([
            'success' => 'success',
        ],200);
    }

    // API Air Product
    public function apiAirProduct(Request $request)
    {
        if ($request->input('client')) {
            return DB::table('air_data')
                ->join('brands', 'air_data.brand_id', '=', 'brands.id')
                ->join('air_group', 'air_data.air_group_id', '=', 'air_group.id')
                ->join('air_btu', 'air_data.air_btu_id', '=', 'air_btu.id')
                ->select('air_data.id', 'air_data.air_type_name', 'air_data.air_group_id',
                    'air_data.air_type_sub_id',  'air_data.air_type_sub_name', 'air_group.air_group_details',
                    'air_btu.air_btu_detail', 'brands.name', 'air_data.air_model_indoor', 'air_data.air_model_outdoor',
                    'air_data.air_image', 'air_data.air_price_list', 'air_data.actby','air_data.deleted_at')
                ->where('air_data.deleted_at','=',0)
                ->orderBy('air_data.air_group_id', 'desc')
                ->get();
        }
        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $columns = ['id', 'air_type_name', 'air_group_id', 'air_group_details','air_btu_detail','name','air_price_list','actby'];

        $query = DB::table('air_data')
            ->join('brands', 'air_data.brand_id', '=', 'brands.id')
            ->join('air_group', 'air_data.air_group_id', '=', 'air_group.id')
            ->join('air_btu', 'air_data.air_btu_id', '=', 'air_btu.id')
            ->select('air_data.id', 'air_data.air_type_name', 'air_data.air_group_id',
                'air_data.air_type_sub_id',  'air_data.air_type_sub_name', 'air_group.air_group_details',
                'air_btu.air_btu_detail', 'brands.name', 'air_data.air_model_indoor', 'air_data.air_model_outdoor',
                'air_data.air_image', 'air_data.air_price_list', 'air_data.actby','air_data.deleted_at')
            ->where('air_data.deleted_at','=',0)
            ->orderBy($columns[$column], $dir);
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('air_data.air_type_name', 'like', '%' . $searchValue . '%');
                $query->orWhere('air_data.air_model_indoor', 'like', '%' . $searchValue . '%');
                $query->orWhere('air_data.air_model_outdoor', 'like', '%' . $searchValue . '%');
            });
        }

        $projects = $query->paginate($length);
        foreach ($projects as $key => $item){
            $airSpec = AirSpec::where('air_data_id','=',$item->id)->first();
            if($airSpec == ""){
                $projects[$key]->check_spec = true;
            }else{
                $projects[$key]->check_spec = false;
            }
            $projects[$key]->check_setup = false;
        }
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    //****************** SPEC AIR **********************//
    public function apiSpecAir($id)
    {
        $spec = AirSpec::where('air_data_id','=',$id)->first();
        return response()->json([
            'spec' => $spec
        ],200);
    }

    public function saveSpecAir(Request $request)
    {
//        dd($request->all());
        $now = new DateTime();
        $auth_id = Auth::user()->id;
        $auth_name = Auth::user()->name;
        $spec = new AirSpec();
        $spec->air_data_id = $request->get('air_data_id');
        $spec->air_s_1 = $request->get('air_s_1');
        $spec->air_s_2 = $request->get('air_s_2');
        $spec->air_s_3 = $request->get('air_s_3');
        $spec->air_s_4 = $request->get('air_s_4');
        $spec->air_s_5 = $request->get('air_s_5');
        $spec->air_s_6 = $request->get('air_s_6');
        $spec->air_s_7 = $request->get('air_s_7');
        $spec->air_s_8 = $request->get('air_s_8');
        $spec->air_s_9 = $request->get('air_s_9');
        $spec->air_s_10 = $request->get('air_s_10');
        $spec->air_s_11 = $request->get('air_s_11');
        $spec->air_s_12 = $request->get('air_s_12');
        $spec->air_s_13 = $request->get('air_s_13');
        $spec->air_s_14 = $request->get('air_s_14');
        $spec->air_s_15 = $request->get('air_s_15');
        $spec->air_s_16 = $request->get('air_s_16');
        $spec->air_s_17 = $request->get('air_s_17');
        $spec->air_s_18 = $request->get('air_s_18');
        $spec->air_s_19 = $request->get('air_s_19');
        $spec->air_s_20 = $request->get('air_s_20');
        $spec->air_s_21 = $request->get('air_s_21');
        $spec->air_s_22 = $request->get('air_s_22');
        $spec->air_s_23 = $request->get('air_s_23');
        $spec->air_s_24 = $request->get('air_s_24');
        $spec->air_s_25 = $request->get('air_s_25');
        $spec->air_s_26 = $request->get('air_s_26');
        $spec->air_s_27 = $request->get('air_s_27');
        $spec->air_s_28 = $request->get('air_s_28');
        $spec->air_s_29 = $request->get('air_s_29');
        $spec->air_s_30 = $request->get('air_s_30');
        $spec->air_s_31 = $request->get('air_s_31');
        $spec->air_s_32 = $request->get('air_s_32');
        $spec->air_s_33 = $request->get('air_s_33');
        $spec->air_s_34 = $request->get('air_s_34');

//        $spec->air_s_35 = $request->get('air_s_35');
//        $spec->air_s_36 = $request->get('air_s_36');
//        $spec->air_s_37 = $request->get('air_s_37');
//        $spec->air_s_38 = $request->get('air_s_38');
//        $spec->air_s_39 = $request->get('air_s_39');
//        $spec->air_s_40 = $request->get('air_s_40');
//        $spec->air_s_41 = $request->get('air_s_41');
//        $spec->air_s_42 = $request->get('air_s_42');
//        $spec->air_s_43 = $request->get('air_s_43');
//        $spec->air_s_44 = $request->get('air_s_44');
//        $spec->air_s_45 = $request->get('air_s_45');
//        $spec->air_s_46 = $request->get('air_s_46');
//        $spec->air_s_47 = $request->get('air_s_47');
//        $spec->air_s_48 = $request->get('air_s_48');
//        $spec->air_s_49 = $request->get('air_s_49');
//        $spec->air_s_50 = $request->get('air_s_50');
//        $spec->air_s_51 = $request->get('air_s_51');
//        $spec->air_s_52 = $request->get('air_s_52');
//        $spec->air_s_53 = $request->get('air_s_53');
//        $spec->air_s_54 = $request->get('air_s_54');
//        $spec->air_s_55 = $request->get('air_s_55');
//        $spec->air_s_56 = $request->get('air_s_56');
//        $spec->air_s_57 = $request->get('air_s_57');
//        $spec->air_s_58 = $request->get('air_s_58');
//        $spec->air_s_59 = $request->get('air_s_59');
//        $spec->air_s_60 = $request->get('air_s_60');
//        $spec->air_s_61 = $request->get('air_s_61');
//        $spec->air_s_62 = $request->get('air_s_62');

        $spec->air_s_35 = ($request->get('air_s_35') == '')?'N':'Y';
        $spec->air_s_36 = ($request->get('air_s_36') == '')?'N':'Y';
        $spec->air_s_37 = ($request->get('air_s_37') == '')?'N':'Y';
        $spec->air_s_38 = ($request->get('air_s_38') == '')?'N':'Y';
        $spec->air_s_39 = ($request->get('air_s_39') == '')?'N':'Y';
        $spec->air_s_40 = ($request->get('air_s_40') == '')?'N':'Y';
        $spec->air_s_41 = ($request->get('air_s_41') == '')?'N':'Y';
        $spec->air_s_42 = ($request->get('air_s_42') == '')?'N':'Y';
        $spec->air_s_43 = ($request->get('air_s_43') == '')?'N':'Y';
        $spec->air_s_44 = ($request->get('air_s_44') == '')?'N':'Y';
        $spec->air_s_45 = ($request->get('air_s_45') == '')?'N':'Y';
        $spec->air_s_46 = ($request->get('air_s_46') == '')?'N':'Y';
        $spec->air_s_47 = ($request->get('air_s_47') == '')?'N':'Y';
        $spec->air_s_48 = ($request->get('air_s_48') == '')?'N':'Y';
        $spec->air_s_49 = ($request->get('air_s_49') == '')?'N':'Y';
        $spec->air_s_50 = ($request->get('air_s_50') == '')?'N':'Y';
        $spec->air_s_51 = ($request->get('air_s_51') == '')?'N':'Y';
        $spec->air_s_52 = ($request->get('air_s_52') == '')?'N':'Y';
        $spec->air_s_53 = ($request->get('air_s_53') == '')?'N':'Y';
        $spec->air_s_54 = ($request->get('air_s_54') == '')?'N':'Y';
        $spec->air_s_55 = ($request->get('air_s_55') == '')?'N':'Y';
        $spec->air_s_57 = ($request->get('air_s_57') == '')?'N':'Y';
        $spec->air_s_58 = ($request->get('air_s_58') == '')?'N':'Y';
        $spec->air_s_59 = ($request->get('air_s_59') == '')?'N':'Y';
        $spec->air_s_60 = ($request->get('air_s_60') == '')?'N':'Y';
        $spec->air_s_61 = ($request->get('air_s_61') == '')?'N':'Y';
        $spec->air_s_62 = ($request->get('air_s_62') == '')?'N':'Y';

        $spec->created_at = $now ;
        $spec->updated_at = null ;
        $spec->user_id = $auth_id ;
        $spec->actby = $auth_name ;
        if ($spec->save()) {
            $response = ['success' => true, 'status' => 'success'];
            return response()->json($response, 200);
        } else {
            $response = ['success' => false, 'status' => 'fail',];
            return response()->json($response, 404);
        }
    }

    public function updateSpecAir(Request $request , $id)
    {
        $now = new DateTime();
        $auth_id = Auth::user()->id;
        $auth_name = Auth::user()->name;
        $spec = AirSpec::find($id);
        $spec->air_s_1 = $request->get('air_s_1');
        $spec->air_s_2 = $request->get('air_s_2');
        $spec->air_s_3 = $request->get('air_s_3');
        $spec->air_s_4 = $request->get('air_s_4');
        $spec->air_s_5 = $request->get('air_s_5');
        $spec->air_s_6 = $request->get('air_s_6');
        $spec->air_s_7 = $request->get('air_s_7');
        $spec->air_s_8 = $request->get('air_s_8');
        $spec->air_s_9 = $request->get('air_s_9');
        $spec->air_s_10 = $request->get('air_s_10');
        $spec->air_s_11 = $request->get('air_s_11');
        $spec->air_s_12 = $request->get('air_s_12');
        $spec->air_s_13 = $request->get('air_s_13');
        $spec->air_s_14 = $request->get('air_s_14');
        $spec->air_s_15 = $request->get('air_s_15');
        $spec->air_s_16 = $request->get('air_s_16');
        $spec->air_s_17 = $request->get('air_s_17');
        $spec->air_s_18 = $request->get('air_s_18');
        $spec->air_s_19 = $request->get('air_s_19');
        $spec->air_s_20 = $request->get('air_s_20');
        $spec->air_s_21 = $request->get('air_s_21');
        $spec->air_s_22 = $request->get('air_s_22');
        $spec->air_s_23 = $request->get('air_s_23');
        $spec->air_s_24 = $request->get('air_s_24');
        $spec->air_s_25 = $request->get('air_s_25');
        $spec->air_s_26 = $request->get('air_s_26');
        $spec->air_s_27 = $request->get('air_s_27');
        $spec->air_s_28 = $request->get('air_s_28');
        $spec->air_s_29 = $request->get('air_s_29');
        $spec->air_s_30 = $request->get('air_s_30');
        $spec->air_s_31 = $request->get('air_s_31');
        $spec->air_s_32 = $request->get('air_s_32');
        $spec->air_s_33 = $request->get('air_s_33');
        $spec->air_s_34 = $request->get('air_s_34');

//        $spec->air_s_35 = $request->get('air_s_35');
//        $spec->air_s_36 = $request->get('air_s_36');
//        $spec->air_s_37 = $request->get('air_s_37');
//        $spec->air_s_38 = $request->get('air_s_38');
//        $spec->air_s_39 = $request->get('air_s_39');
//        $spec->air_s_40 = $request->get('air_s_40');
//        $spec->air_s_41 = $request->get('air_s_41');
//        $spec->air_s_42 = $request->get('air_s_42');
//        $spec->air_s_43 = $request->get('air_s_43');
//        $spec->air_s_44 = $request->get('air_s_44');
//        $spec->air_s_45 = $request->get('air_s_45');
//        $spec->air_s_46 = $request->get('air_s_46');
//        $spec->air_s_47 = $request->get('air_s_47');
//        $spec->air_s_48 = $request->get('air_s_48');
//        $spec->air_s_49 = $request->get('air_s_49');
//        $spec->air_s_50 = $request->get('air_s_50');
//        $spec->air_s_51 = $request->get('air_s_51');
//        $spec->air_s_52 = $request->get('air_s_52');
//        $spec->air_s_53 = $request->get('air_s_53');
//        $spec->air_s_54 = $request->get('air_s_54');
//        $spec->air_s_55 = $request->get('air_s_55');
//        $spec->air_s_56 = $request->get('air_s_56');
//        $spec->air_s_57 = $request->get('air_s_57');
//        $spec->air_s_58 = $request->get('air_s_58');
//        $spec->air_s_59 = $request->get('air_s_59');
//        $spec->air_s_60 = $request->get('air_s_60');
//        $spec->air_s_61 = $request->get('air_s_61');
//        $spec->air_s_62 = $request->get('air_s_62');

        $spec->air_s_35 = ($request->get('air_s_35') == '')?'N':'Y';
        $spec->air_s_36 = ($request->get('air_s_36') == '')?'N':'Y';
        $spec->air_s_37 = ($request->get('air_s_37') == '')?'N':'Y';
        $spec->air_s_38 = ($request->get('air_s_38') == '')?'N':'Y';
        $spec->air_s_39 = ($request->get('air_s_39') == '')?'N':'Y';
        $spec->air_s_40 = ($request->get('air_s_40') == '')?'N':'Y';
        $spec->air_s_41 = ($request->get('air_s_41') == '')?'N':'Y';
        $spec->air_s_42 = ($request->get('air_s_42') == '')?'N':'Y';
        $spec->air_s_43 = ($request->get('air_s_43') == '')?'N':'Y';
        $spec->air_s_44 = ($request->get('air_s_44') == '')?'N':'Y';
        $spec->air_s_45 = ($request->get('air_s_45') == '')?'N':'Y';
        $spec->air_s_46 = ($request->get('air_s_46') == '')?'N':'Y';
        $spec->air_s_47 = ($request->get('air_s_47') == '')?'N':'Y';
        $spec->air_s_48 = ($request->get('air_s_48') == '')?'N':'Y';
        $spec->air_s_49 = ($request->get('air_s_49') == '')?'N':'Y';
        $spec->air_s_50 = ($request->get('air_s_50') == '')?'N':'Y';
        $spec->air_s_51 = ($request->get('air_s_51') == '')?'N':'Y';
        $spec->air_s_52 = ($request->get('air_s_52') == '')?'N':'Y';
        $spec->air_s_53 = ($request->get('air_s_53') == '')?'N':'Y';
        $spec->air_s_54 = ($request->get('air_s_54') == '')?'N':'Y';
        $spec->air_s_55 = ($request->get('air_s_55') == '')?'N':'Y';
        $spec->air_s_56 = ($request->get('air_s_56') == '')?'N':'Y';
        $spec->air_s_57 = ($request->get('air_s_57') == '')?'N':'Y';
        $spec->air_s_58 = ($request->get('air_s_58') == '')?'N':'Y';
        $spec->air_s_59 = ($request->get('air_s_59') == '')?'N':'Y';
        $spec->air_s_60 = ($request->get('air_s_60') == '')?'N':'Y';
        $spec->air_s_61 = ($request->get('air_s_61') == '')?'N':'Y';
        $spec->air_s_62 = ($request->get('air_s_62') == '')?'N':'Y';
        $spec->updated_at = $now ;
        $spec->user_id = $auth_id ;
        $spec->actby = $auth_name ;
        if ($spec->update()) {
            $response = ['success' => true, 'status' => 'success'];
            return response()->json($response, 200);
        } else {
            $response = ['success' => false, 'status' => 'fail',];
            return response()->json($response, 404);
        }
    }

    //****************** INSTALL AIR **********************//
    public function apiInstallAir($id)
    {
        $install = AirInstall::where('air_data_id','=',$id)->first();
        return response()->json([
            'install' => $install
        ],200);
    }

    public function saveInstallAir(Request $request)
    {
        $now = new DateTime();
        $auth_id = Auth::user()->id;
        $auth_name = Auth::user()->name;
        $installAir = new AirInstall();
        $installAir->air_data_id = $request->get('air_data_id');
        $installAir->air_i_1 = $request->get('air_i_1');
        $installAir->air_i_2 = $request->get('air_i_2');
        $installAir->air_i_3 = $request->get('air_i_3');
        $installAir->air_i_4 = $request->get('air_i_4');
        $installAir->air_i_5 = $request->get('air_i_5');
        $installAir->air_i_6 = $request->get('air_i_6');
        $installAir->air_i_7 = $request->get('air_i_7');
        $installAir->air_i_8 = $request->get('air_i_8');
        $installAir->air_i_9 = $request->get('air_i_9');
        $installAir->air_i_10 = $request->get('air_i_10');
        $installAir->air_i_11 = $request->get('air_i_11');
        $installAir->air_i_12 = $request->get('air_i_12');
        $installAir->air_i_13 = $request->get('air_i_13');
        $installAir->air_i_14 = $request->get('air_i_14');
        $installAir->air_i_15 = $request->get('air_i_15');
        $installAir->air_i_16 = $request->get('air_i_16');
        $installAir->air_i_17 = $request->get('air_i_17');
        $installAir->air_i_18 = $request->get('air_i_18');
        $installAir->air_i_19 = $request->get('air_i_19');
        $installAir->air_i_20 = $request->get('air_i_20');
        $installAir->created_at = $now ;
        $installAir->updated_at = null ;
        $installAir->admin_id = $auth_id ;
        $installAir->actby = $auth_name ;
        if ($installAir->save()) {
            $response = ['success' => true, 'status' => 'success',];
            return response()->json($response, 200);
        } else {
            $response = ['success' => false, 'status' => 'fail',];
            return response()->json($response, 404);
        }
    }

    public function updateInstallAir(Request $request , $id)
    {
        $now = new DateTime();
        $auth_id = Auth::user()->id;
        $auth_name = Auth::user()->name;
        $installAir = AirInstall::find($id);
        $installAir->air_data_id = $request->get('air_data_id');
        $installAir->air_i_1 = $request->get('air_i_1');
        $installAir->air_i_2 = $request->get('air_i_2');
        $installAir->air_i_3 = $request->get('air_i_3');
        $installAir->air_i_4 = $request->get('air_i_4');
        $installAir->air_i_5 = $request->get('air_i_5');
        $installAir->air_i_6 = $request->get('air_i_6');
        $installAir->air_i_7 = $request->get('air_i_7');
        $installAir->air_i_8 = $request->get('air_i_8');
        $installAir->air_i_9 = $request->get('air_i_9');
        $installAir->air_i_10 = $request->get('air_i_10');
        $installAir->air_i_11 = $request->get('air_i_11');
        $installAir->air_i_12 = $request->get('air_i_12');
        $installAir->air_i_13 = $request->get('air_i_13');
        $installAir->air_i_14 = $request->get('air_i_14');
        $installAir->air_i_15 = $request->get('air_i_15');
        $installAir->air_i_16 = $request->get('air_i_16');
        $installAir->air_i_17 = $request->get('air_i_17');
        $installAir->air_i_18 = $request->get('air_i_18');
        $installAir->air_i_19 = $request->get('air_i_19');
        $installAir->air_i_20 = $request->get('air_i_20');
        $installAir->updated_at = $now ;
        $installAir->admin_id = $auth_id ;
        $installAir->actby = $auth_name ;
        if ($installAir->update()) {
            $response = ['success' => true, 'status' => 'success'];
            return response()->json($response, 200);
        } else {
            $response = ['success' => false, 'status' => 'fail',];
            return response()->json($response, 404);
        }
    }

}

