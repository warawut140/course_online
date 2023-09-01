<?php

namespace App\Http\Controllers\backend;

use App\Models\Air_Conditioning;
use App\Models\Brands;
use App\Models\Subject_Works;
use App\Models\Type_Subject_Works;
use App\Models\Works;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminStandardController extends Controller
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
        $brands = Brands::whereNull('deleted_at')->orderBy('id', 'desc')->get();
        $typeProjectAuctions = DB::table('type_project_auctions')
            ->orderBy('name')->get();
        echo view('backend.standard.index' , [
            'typeProjectAuctions' => $typeProjectAuctions,
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $air = new Air_Conditioning();
        $now = new DateTime();
        $auth_name = Auth::user()->name;
        $air->data_type  = $request->get('data_type') ;
        $air->product_type  = $request->get('product_type') ;
        $air->product_id  = $request->get('product_id') ;
        $air->product_id_type  = $request->get('product_id_type') ;
        $air->name  = $request->get('name') ;
        $air->price  = $request->get('price') ;
        $air->btu  = $request->get('btu') ;
        $air->model  = $request->get('model') ;
        $air->unit_id  = $request->get('unit_id') ;
        $air->qty_material  = $request->get('qty_material') ;
        $air->cost_material  = $request->get('cost_material') ;
        $air->qty_labour  = $request->get('qty_labour') ;
        $air->cost_labour  = $request->get('cost_labour') ;
        $air->brand_id  = $request->get('brand_id') ;
        $air->type_sub_work_id  = $request->get('type_sub_work_id') ;
//        $air->type_sub_work_list_id  = $request->get('type_sub_work_list_id') ;
        $air->actby  = $auth_name ;
        $air->created_at  = $now ;
        if($air->save()){
            $response = ['success' => true, 'status' => 'success'];
            return response()->json($response, 200);
        }else{
            $response = ['success' => false, 'status' => 'fail',];
            return response()->json($response, 404);
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
        $data = Air_Conditioning::join('type__subject__works','type__subject__works.id','=','air_conditionings.type_sub_work_id')
            ->join('subject__works','subject__works.id','=','type__subject__works.sub_work_id')
            ->join('units','units.id','=','air_conditionings.unit_id')
            ->select('air_conditionings.*','type__subject__works.name as sub_name_list','type__subject__works.sub_work_id',
                'type__subject__works.type_list' ,
                'subject__works.name as sub_name' , 'units.name as unit_name')
            ->where('air_conditionings.id',$id)
            ->first();
        return response()->json($data,200);
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
        $air =  Air_Conditioning::find($id);
        $air->name  = $request->get('name') ;
        $air->model  = $request->get('model') ;
        $air->unit_id  = $request->get('unit_id') ;
        $air->cost_material  = $request->get('cost_material') ;
        $air->cost_labour  = $request->get('cost_labour') ;
        $air->actby  = $auth_name ;
        $air->updated_at  = $now ;
        if($air->update()){
            $response = ['success' => true, 'status' => 'success'];
            return response()->json($response, 200);
        }else{
            $response = ['success' => false, 'status' => 'fail',];
            return response()->json($response, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $now = new DateTime();
        Air_Conditioning::where('id','=',$id)->update(['deleted_at' => $now ]);
        return response()->json([
            'success' => 'success',
        ],200);
    }

    public function saveWork(Request $request)
    {
        $now = new DateTime();
        $auth_name = Auth::user()->name;
        if($request->type == 'sub_work'){
            $sub_work = new Subject_Works();
            $sub_work->data_type = $request->data_type ;
            $sub_work->name = $request->name ;
            $sub_work->actby =  $auth_name ;
            $sub_work->created_at = $now;
            $sub_work->updated_at = null;
            if($sub_work->save()){
                $response = ['success' => true, 'status' => 'success'];
                return response()->json($response, 200);
            }else{
                $response = ['success' => false, 'status' => 'fail',];
                return response()->json($response, 404);
            }
        }else if($request->type == 'sub_work_list'){
            $check_order = Type_Subject_Works::where('sub_work_id',$request->sub_work_id)
                ->orderBy('id','desc')
                ->first();
            $sub_work_list = new Type_Subject_Works();
            $sub_work_list->name = $request->name;
            $sub_work_list->sub_work_id = $request->sub_work_id;
            $sub_work_list->type_select = $request->type_select;
            $sub_work_list->type_list = $request->type_list;
            $sub_work_list->sort = ($check_order == null)?1:$check_order->sort + 1;
            $sub_work_list->actby = $auth_name;
            $sub_work_list->created_at = $now;
            $sub_work_list->updated_at = null;
            if($sub_work_list->save()){
                $response = ['success' => true, 'status' => 'success'];
                return response()->json($response, 200);
            }else{
                $response = ['success' => false, 'status' => 'fail',];
                return response()->json($response, 404);
            }
        }else if($request->type == 'work'){
            $work = new Works();
            $work->data_type = $request->data_type;
            $work->name = $request->name;
            $work->actby = $auth_name;
            $work->created_at = $now;
            $work->updated_at = null;
            if($work->save()){
                $response = ['success' => true, 'status' => 'success'];
                return response()->json($response, 200);
            }else{
                $response = ['success' => false, 'status' => 'fail',];
                return response()->json($response, 404);
            }
        }
    }

    public function updateWork(Request $request , $id)
    {
        $now = new DateTime();
        $auth_name = Auth::user()->name;
        if($request->type == 'sub_work'){
            $sub_work = Subject_Works::find($id);
            $sub_work->name = $request->name ;
            $sub_work->actby =  $auth_name ;
            $sub_work->updated_at = $now;
            if($sub_work->update()){
                $response = ['success' => true, 'status' => 'success'];
                return response()->json($response, 200);
            }else{
                $response = ['success' => false, 'status' => 'fail',];
                return response()->json($response, 404);
            }
        }else if($request->type == 'sub_work_list'){
            $sub_work_list = Type_Subject_Works::find($id);
            $sub_work_list->name = $request->name;
            $sub_work_list->actby = $auth_name;
            $sub_work_list->updated_at = $now;
            if($sub_work_list->update()){
                $response = ['success' => true, 'status' => 'success'];
                return response()->json($response, 200);
            }else{
                $response = ['success' => false, 'status' => 'fail',];
                return response()->json($response, 404);
            }
        }else if($request->type == 'work'){
            $work= Works::find($id);
            $work->name = $request->name;
            $work->updated_at = $now;
            if($work->update()){
                $response = ['success' => true, 'status' => 'success'];
                return response()->json($response, 200);
            }else{
                $response = ['success' => false, 'status' => 'fail',];
                return response()->json($response, 404);
            }
        }
    }

    //API
    public function getDataStandardList(Request $request)
    {
        $arr = [] ;
        if ($request->sub_work_id == '' && $request->type_sub_work_id == ''){
            // Show All Data  data_type
            $data = Air_Conditioning::join('type__subject__works','type__subject__works.id','=','air_conditionings.type_sub_work_id')
                ->join('subject__works','subject__works.id','=','type__subject__works.sub_work_id')
                ->join('units','units.id','=','air_conditionings.unit_id')
                ->select('air_conditionings.*','type__subject__works.name as sub_name_list','type__subject__works.sub_work_id',
                    'subject__works.name as sub_name' , 'units.name as unit_name')
                ->where('air_conditionings.data_type',$request->data_type)
                ->whereNull('air_conditionings.deleted_at')
                ->orderBy('air_conditionings.id','desc')
                ->paginate(10);
            if(count($data) > 0){
                foreach ($data as $key => $item){
                    if($item->brand_id != null){
                        $brand = Brands::find($item->brand_id);
                        $data[$key]->brand = $brand->name;
                    }else{
                        $data[$key]->brand = '-';
                    }
                }
            }
        }else if($request->type_sub_work_id == ''){
            // request no type_sub_work_id => search sub_work_id tb : type__subject__works
            $type = Type_Subject_Works::where('sub_work_id',$request->sub_work_id)->get();
            for($i = 0 ; $i < count($type);$i++){
                $arr[] = $type[$i]->id;
            }
            $data = Air_Conditioning::join('type__subject__works','type__subject__works.id','=','air_conditionings.type_sub_work_id')
                ->join('subject__works','subject__works.id','=','type__subject__works.sub_work_id')
                ->join('units','units.id','=','air_conditionings.unit_id')
                ->select('air_conditionings.*','type__subject__works.name as sub_name_list','type__subject__works.sub_work_id',
                    'subject__works.name as sub_name' , 'units.name as unit_name')
                ->whereIn('air_conditionings.type_sub_work_id',$arr)
                ->whereNull('air_conditionings.deleted_at')
                ->orderBy('air_conditionings.id','desc')
                ->paginate(10);
            if(count($data) > 0){
                foreach ($data as $key => $item){
                    if($item->brand_id != null){
                        $brand = Brands::find($item->brand_id);
                        $data[$key]->brand = $brand->name;
                    }else{
                        $data[$key]->brand = '-';
                    }
                }
            }
        }else{
            $data = Air_Conditioning::join('type__subject__works','type__subject__works.id','=','air_conditionings.type_sub_work_id')
                ->join('subject__works','subject__works.id','=','type__subject__works.sub_work_id')
                ->join('units','units.id','=','air_conditionings.unit_id')
                ->select('air_conditionings.*','type__subject__works.name as sub_name_list','type__subject__works.sub_work_id',
                    'subject__works.name as sub_name' , 'units.name as unit_name')
                ->where('air_conditionings.data_type',$request->data_type)
                ->where('air_conditionings.type_sub_work_id',$request->type_sub_work_id)
                ->whereNull('air_conditionings.deleted_at')
                ->orderBy('air_conditionings.id','desc')
                ->paginate(10);
            if(count($data) > 0){
                foreach ($data as $key => $item){
                    if($item->brand_id != null){
                        $brand = Brands::find($item->brand_id);
                        $data[$key]->brand = $brand->name;
                    }else{
                        $data[$key]->brand = '-';
                    }
                }
            }
        }
        $dataType = [
            'request' => $request->all(),
            'arr' => $arr,
            'data' => $data,
        ];
        return response()->json($dataType);
    }

    public function getWork($id)
    {
        $data = Works::where('data_type',$id)->paginate(5);
        return response()->json($data);
    }

    public function getSubJectWork($id)
    {
        $data = Subject_Works::where('data_type',$id)->paginate(5);
        return response()->json($data);
    }

    public function getTypeSubjectWorksList($id)
    {
        $data = Type_Subject_Works::where('sub_work_id',$id)->paginate(5);
        return response()->json($data);
    }

    public function getTypeSubjectWorks($id)
    {
        $data = Type_Subject_Works::find($id);
        return response()->json($data,200);
    }

    public function getDataStandard(Request $request)
    {
        $data = Subject_Works::where('data_type',$request->id)->paginate(10);
        return response()->json($data);
    }

    // APT DROPDOWN
    public function getDropDownListSubjectWorks($id)
    {
        $sw_type = DB::table('subject__works')->select("id", "name")
            ->where('data_type','=',$id)
           ->get();
        return response()->json($sw_type);
    }

    public function getDropDownListSubjectWorksType($id)
    {
        $swt_type = DB::table('type__subject__works')->select("id", "name","type_list")
            ->where('sub_work_id','=',$id)
            ->get();
        return response()->json($swt_type);
    }

    public function getDropDownListWorks($id)
    {
        $w_type = DB::table('works')->select("id", "name")
            ->where('data_type','=',$id)
            ->get();
        return response()->json($w_type);
    }

    public function getDropDownListProduct($id)
    {
        if($id == 1){
            //1 ข้อมูล AIR
            $data = DB::table('air_data')
                ->where('deleted_at','=',0)->get();
            foreach ($data as $key => $datum){
                $data[$key]->name =  $datum->air_type_name.' : '.$datum->air_model_indoor.' '.$datum->air_model_outdoor ;
                $data[$key]->model = $datum->air_model_indoor.' '.$datum->air_model_outdoor ;
                $data[$key]->price = $datum->air_price_list ;
                $data[$key]->btu = 'BTU/Hr' ;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id = $datum->brand_id ;
            }
        }elseif ($id == 2){
            //2 สายไฟ
            $data = DB::table('product_wire')
                ->join('product_wire_detail','product_wire_detail.pw_id','=','product_wire.id')
                ->select('product_wire.*', 'product_wire_detail.id as pwd_id',
                    'product_wire_detail.pwd_detail', 'product_wire_detail.pw_id',
                    'product_wire_detail.pwd_price')
                ->whereNull('product_wire.deleted_at')->get();
            foreach ($data as $key => $datum){
                $data[$key]->name =  $datum->pw_type_name.' '.$datum->pw_size ;
                $data[$key]->model = '' ;
                $data[$key]->price = $datum->pwd_price ;
                $data[$key]->btu = '' ;
                $data[$key]->id = $datum->pwd_id;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id = $datum->pw_brand_id ;
            }
        }elseif ($id == 3){
            //3 น้ำยาแอร์
            $data = DB::table('product_air_cleaner')
                ->whereNull('deleted_at')->get();
            foreach ($data as $key => $datum){
                $data[$key]->name =  $datum->ac_list_name;
                $data[$key]->model = '' ;
                $data[$key]->price = $datum->ac_price ;
                $data[$key]->btu = '' ;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id = $datum->ac_brand_id ;
            }
        }elseif ($id == 4){
            //4 ท่อร้อย สายไฟ
            $data = DB::table('product_pipe_wire')
                ->whereNull('deleted_at')->get();
            foreach ($data as $key => $datum){
                $inch = ($datum->pw_size_inch != '')?' '.$datum->pw_size_inch.'/Inch':'';
                $mm = ($datum->pw_size_mm != '')?' '.$datum->pw_size_mm.'/mm':'';
                $data[$key]->name =  $datum->pw_type.'  '.$inch.'  '.$mm;
                $data[$key]->model = '' ;
                $data[$key]->price = $datum->pw_price_line ;
                $data[$key]->btu = '' ;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id = $datum->pw_brand_id ;
            }
        }elseif ($id == 5){
            //5 PVC
            $data = DB::table('product_pvc_pipe')
                ->join('product_pp_detail','product_pp_detail.pp_id','=','product_pvc_pipe.id')
                ->select('product_pvc_pipe.*', 'product_pp_detail.id as id_pp',
                    'product_pp_detail.pp_id','product_pp_detail.pp_d_class',
                    'product_pp_detail.pp_d_price','product_pp_detail.pp_d_osd','product_pp_detail.pp_d_thickness')
                ->whereNull('product_pvc_pipe.deleted_at')->get();
            foreach ($data as $key => $datum){
                $data[$key]->name =  $datum->pp_type_pipe.'  '.$datum->pp_d_class.'  '.$datum->pp_size;
                $data[$key]->model = '' ;
                $data[$key]->price = $datum->pp_d_price ;
                $data[$key]->btu = '' ;
                $data[$key]->id = $datum->id_pp;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id = $datum->pp_brand_id ;
            }
        }elseif ($id == 6){
            //6 ฉนวนใยแก้ว
            $data = DB::table('product_fiberglass_insulation')
                ->whereNull('deleted_at')->get();
            foreach ($data as $key => $datum){
                $data[$key]->name =  $datum->fi_code.' / '.$datum->fi_size;
                $data[$key]->model = $datum->fi_model;
                $data[$key]->price = $datum->fi_price2;
                $data[$key]->btu = '' ;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id = $datum->fi_brand_id ;
            }
        }elseif ($id == 7){
            //7 ฉนวนยางดำ
            $data = DB::table('product_blackrubber_insulation')
                ->join('product_bi_detail','product_bi_detail.bi_id','=','product_blackrubber_insulation.id')
                ->select('product_blackrubber_insulation.*','product_bi_detail.id as id_bi','product_bi_detail.bi_id',
                    'product_bi_detail.bi_d_thickness','product_bi_detail.bi_d_price')
                ->whereNull('product_blackrubber_insulation.deleted_at')->get();
            foreach ($data as $key => $datum){
                $data[$key]->name =  $datum->bi_inch;
                $data[$key]->model = '';
                $data[$key]->price = $datum->bi_d_price;
                $data[$key]->btu = '' ;
                $data[$key]->id = $datum->id_bi;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id = $datum->bi_brand_id ;
            }
        }elseif ($id == 8){
            //8 PVC ท่อน้ำทิ้ง
            $data = DB::table('product_pvc_water_pipe')
                ->join('product_pwp_detail','product_pwp_detail.pwp_id','=','product_pvc_water_pipe.id')
                ->select('product_pvc_water_pipe.*','product_pwp_detail.id as id_pwp','product_pwp_detail.pwp_id',
                    'product_pwp_detail.pwp_d_class','product_pwp_detail.pwp_d_price')
                ->whereNull('product_pvc_water_pipe.deleted_at')->get();
            foreach ($data as $key => $datum){
                $data[$key]->name =  $datum->pwp_inch .' '.$datum->pwp_d_class;
                $data[$key]->model = '';
                $data[$key]->price = $datum->pwp_d_price;
                $data[$key]->btu = '' ;
                $data[$key]->id = $datum->id_pwp;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id = $datum->pwp_brand_id ;
            }
        }elseif ($id == 9){
            //9 HDPE งานประปา
            $data = [];
            $data1 = DB::table('product_hdpe_plumbing')
                ->join('product_hp_detail','product_hp_detail.hp_id','=','product_hdpe_plumbing.id')
                ->select('product_hdpe_plumbing.*','product_hp_detail.id as id_hp','product_hp_detail.hp_id',
                    'product_hp_detail.hp_d_name', 'product_hp_detail.hp_d_pe80','product_hp_detail.hp_d_pe100',
                    'product_hp_detail.hp_d_price')
                ->where('hp_type','=',1)
                ->whereNull('product_hdpe_plumbing.deleted_at')->get();
            foreach ($data1 as $key => $datum){
                $inch = ($datum->hp_od_inch != '')?' '.$datum->hp_od_inch.'/Inch':'';
                $mm = ($datum->hp_od_mm != '')?' '.$datum->hp_od_mm.'/mm':'';
                $data1[$key]->name =  $datum->hp_d_name.'  '.$inch.'  '.$mm;
                $data1[$key]->model = '';
                $data1[$key]->price = $datum->hp_d_price;
                $data1[$key]->btu = '' ;
                $data1[$key]->id = $datum->id_hp;
                $data1[$key]->product_id_type = 1 ;
                $data1[$key]->brand_id =  $datum->hp_brand_id ;
            }
            $data2 = DB::table('product_hdpe_plumbing')
                ->where('hp_type','=',2)
                ->whereNull('deleted_at')->get();
            foreach ($data2 as $key => $datum){
                $inch = ($datum->hp_od_inch != '')?' '.$datum->hp_od_inch.'/Inch':'';
                $mm = ($datum->hp_od_mm != '')?' '.$datum->hp_od_mm.'/mm':'';
                $data2[$key]->name =  $datum->hp_fitting_name.'  '.$inch.'  '.$mm;
                $data2[$key]->model = '';
                $data2[$key]->price = $datum->hp_fitting_price;
                $data2[$key]->btu = '' ;
                $data2[$key]->product_id_type = 2 ;
                $data2[$key]->brand_id = $datum->hp_brand_id  ;
            }
            $count = 0 ;
            for ($i = 0 ; $i < count($data1);$i++){
                $data[$count] = $data1[$i];
                $count = $count+1;
            }
            for ($i = 0 ; $i < count($data2);$i++){
                $data[$count] = $data2[$i];
                $count = $count+1;
            }
        }elseif ($id == 10){
            //10  HDPE งานไฟฟ้า
            $data = DB::table('product_hdpe_electricity')
                ->join('product_he_detail','product_he_detail.he_id','=','product_hdpe_electricity.id')
                ->select('product_hdpe_electricity.*','product_he_detail.id as id_hdpe','product_he_detail.he_id',
                    'product_he_detail.he_d_type','product_he_detail.he_d_sub_type','product_he_detail.he_d_price','product_he_detail.he_d_thick')
                ->whereNull('product_hdpe_electricity.deleted_at')->get();
            foreach ($data as $key => $datum){
                $data[$key]->name =  $datum->hdpe_type_name .' / '.$datum->he_d_type;
                $data[$key]->model = '';
                $data[$key]->price = $datum->he_d_price;
                $data[$key]->btu = '' ;
                $data[$key]->id = $datum->id_hdpe;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id =  $datum->hdpe_brand_id ;
            }

        }elseif ($id == 11){
            //11 ท่อทองแดง / Copper Tube
            $data = DB::table('product_copper')
                ->whereNull('deleted_at')->get();
            foreach ($data as $key => $datum){
                $data[$key]->name =  $datum->c_name_type .' '.$datum->c_weight.' /weight';
                $data[$key]->model = '';
                $data[$key]->price = $datum->c_price;
                $data[$key]->btu = '' ;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id = $datum->c_brand_id ;
            }
        }elseif ($id == 12){
            //12 Flexible duct
            $data = DB::table('product_aeroduct')
                ->join('product_aeroduct_detail','product_aeroduct_detail.aeroduct_id','=','product_aeroduct.id')
                ->select('product_aeroduct.*','product_aeroduct_detail.id as id_ad','product_aeroduct_detail.ad_name',
                    'product_aeroduct_detail.ad_price')
                ->whereNull('product_aeroduct.deleted_at')->get();
            foreach ($data as $key => $datum){
                $data[$key]->name =  $datum->ae_size_inch .' '.$datum->ad_name;
                $data[$key]->model = '';
                $data[$key]->price = $datum->ad_price;
                $data[$key]->btu = '' ;
                $data[$key]->id = $datum->id_ad;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id =  $datum->ae_brand_id ;
            }
        }elseif ($id == 13){
            //13 รายการวัสดุ อื่น =  ท่อน้ำยา
            $data = DB::table('product_all')->where('pa_type_id','=',1)
                ->whereNull('deleted_at')->get();
            foreach ($data as $key => $datum){
                $data[$key]->name =  $datum->pa_spec;
                $data[$key]->model = '';
                $data[$key]->price = $datum->pa_price;
                $data[$key]->btu = '' ;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id = $datum->pa_brand_id ;
            }
        }elseif ($id == 14){
            //14 รายการวัสดุ อื่น =  ฉนวน
            $data = DB::table('product_all')->where('pa_type_id','=',2)
                ->whereNull('deleted_at')->get();
            foreach ($data as $key => $datum){
                $data[$key]->name =  $datum->pa_spec;
                $data[$key]->model = '';
                $data[$key]->price = $datum->pa_price;
                $data[$key]->btu = '' ;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id = $datum->pa_brand_id ;
            }
        }elseif ($id == 15){
            //15 รายการวัสดุ อื่น =  Control Cable
            $data = DB::table('product_all')->where('pa_type_id','=',3)
                ->whereNull('deleted_at')->get();
            foreach ($data as $key => $datum){
                $data[$key]->name =  $datum->pa_spec;
                $data[$key]->model = '';
                $data[$key]->price = $datum->pa_price;
                $data[$key]->btu = '' ;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id = $datum->pa_brand_id ;
            }
        }elseif ($id == 16){
            //16 รายการวัสดุ อื่น = Main EE Cable
            $data = DB::table('product_all')->where('pa_type_id','=',4)
                ->whereNull('deleted_at')->get();
            foreach ($data as $key => $datum){
                $data[$key]->name =  $datum->pa_spec;
                $data[$key]->model = '';
                $data[$key]->price = $datum->pa_price;
                $data[$key]->btu = '' ;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id = $datum->pa_brand_id ;
            }
        }elseif ($id == 17){
            //17 รายการวัสดุ อื่น = ท่อร้อยสาย
            $data = DB::table('product_all')->where('pa_type_id','=',5)
                ->whereNull('deleted_at')->get();
            foreach ($data as $key => $datum){
                $data[$key]->name =  $datum->pa_spec;
                $data[$key]->model = '';
                $data[$key]->price = $datum->pa_price;
                $data[$key]->btu = '' ;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id = $datum->pa_brand_id ;
            }
        }elseif ($id == 18){
            //18 รายการวัสดุ อื่น = SAFETY
            $data = DB::table('product_all')->where('pa_type_id','=',6)
                ->whereNull('deleted_at')->get();
            foreach ($data as $key => $datum){
                $data[$key]->name =  $datum->pa_spec;
                $data[$key]->model = '';
                $data[$key]->price = $datum->pa_price;
                $data[$key]->btu = '' ;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id = $datum->pa_brand_id ;
            }
        }elseif ($id == 19){
            //19 รายการวัสดุ อื่น = LP ,DB
            $data = DB::table('product_all')->where('pa_type_id','=',7)
                ->whereNull('deleted_at')->get();
            foreach ($data as $key => $datum){
                $data[$key]->name =  $datum->pa_spec;
                $data[$key]->model = '';
                $data[$key]->price = $datum->pa_price;
                $data[$key]->btu = '' ;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id = $datum->pa_brand_id ;
            }
        }elseif ($id == 20){
            //20 รายการวัสดุ อื่น = CB BREAKER
            $data = DB::table('product_all')->where('pa_type_id','=',8)
                ->whereNull('deleted_at')->get();
            foreach ($data as $key => $datum){
                $data[$key]->name =  $datum->pa_spec;
                $data[$key]->model = '';
                $data[$key]->price = $datum->pa_price;
                $data[$key]->btu = '' ;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id = $datum->pa_brand_id ;
            }
        }elseif ($id == 21){
            //21 รายการวัสดุ อื่น = SLIM DUCT
            $data = DB::table('product_all')->where('pa_type_id','=',9)
                ->whereNull('deleted_at')->get();
            foreach ($data as $key => $datum){
                $data[$key]->name =  $datum->pa_spec;
                $data[$key]->model = '';
                $data[$key]->price = $datum->pa_price;
                $data[$key]->btu = '' ;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id = $datum->pa_brand_id ;
            }
        }elseif ($id == 22){
            //22 รายการวัสดุ อื่น = Galvanize Steel Sheet
            $data = DB::table('product_all')->where('pa_type_id','=',10)
                ->whereNull('deleted_at')->get();
            foreach ($data as $key => $datum){
                $data[$key]->name =  $datum->pa_spec;
                $data[$key]->model = '';
                $data[$key]->price = $datum->pa_price;
                $data[$key]->btu = '' ;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id = $datum->pa_brand_id ;
            }
        }elseif ($id == 23){
            //23 รายการวัสดุ อื่น = GRILL
            $data = DB::table('product_all')->where('pa_type_id','=',11)
                ->whereNull('deleted_at')->get();
            foreach ($data as $key => $datum){
                $data[$key]->name =  $datum->pa_spec;
                $data[$key]->model = '';
                $data[$key]->price = $datum->pa_price;
                $data[$key]->btu = '' ;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id = $datum->pa_brand_id ;
            }
        }elseif ($id == 24){
            //24 รายการวัสดุ อื่น = INSULATION DUCT
            $data = DB::table('product_all')->where('pa_type_id','=',12)
                ->whereNull('deleted_at')->get();
            foreach ($data as $key => $datum){
                $data[$key]->name =  $datum->pa_spec;
                $data[$key]->model = '';
                $data[$key]->price = $datum->pa_price;
                $data[$key]->btu = '' ;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id = $datum->pa_brand_id ;
            }
        }elseif ($id == 25){
            //25 รายการวัสดุ อื่น = REFIGERANT
            $data = DB::table('product_all')->where('pa_type_id','=',13)
                ->whereNull('deleted_at')->get();
            foreach ($data as $key => $datum){
                $data[$key]->name =  $datum->pa_spec;
                $data[$key]->model = '';
                $data[$key]->price = $datum->pa_price;
                $data[$key]->btu = '' ;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id = $datum->pa_brand_id ;
            }
        }elseif ($id == 26){
            //26 รายการวัสดุ อื่น = ขาแขวน
            $data = DB::table('product_all')->where('pa_type_id','=',14)
                ->whereNull('deleted_at')->get();
            foreach ($data as $key => $datum){
                $data[$key]->name =  $datum->pa_spec;
                $data[$key]->model = '';
                $data[$key]->price = $datum->pa_price;
                $data[$key]->btu = '' ;
                $data[$key]->product_id_type = 0 ;
                $data[$key]->brand_id = $datum->pa_brand_id ;
            }
        }
        return response()->json($data, 200);
    }
}
