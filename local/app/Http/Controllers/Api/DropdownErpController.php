<?php

namespace App\Http\Controllers\Api;

use App\Models\Air_Conditioning;
use App\Models\ErpStoreGift;
use App\Models\ErpStoreProduct;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DropdownErpController extends Controller
{
    public function getBrandSeries(Request $request)
    {
        $id = $_REQUEST['id'];
        $data = Air_Conditioning::where('brand_id','=',$id)
            ->where('type_sub_work_id','=','1')
            ->where('standard_id','=','1')
            ->get();
        $html = '<option value="" selected>- กรุณาเลือก รุ่น -</option>';
        foreach ($data AS $row) {
            $html .= '<option value="' . $row->id . '">' . $row->model .' / BTU : '.$row->price.'</option>';
        }
        $html .= '<option value="0">อื่นๆ</option>';
        return $html;
    }

    public function getPriceAir(Request $request)
    {
        $id = $_REQUEST['id'];
        $data = Air_Conditioning::where('id','=',$id)->first();
        return json_encode($data->cost_material) ;
    }

    public function getAddressErp($provinces_id , $amphures , $districts)
    {
        $inputArr = [$provinces_id , $amphures , $districts];
        if($provinces_id != 0){
            $checkProfileAddress = DB::table('profiles')
                ->join('erp_store_products','erp_store_products.user_id','=','profiles.user_id')
                ->select('profiles.*')
                ->where(function ($query) use ($districts, $amphures, $provinces_id) {
                    if($provinces_id != 0){
                        $query->where('profiles.provinces_id', $provinces_id);
                    }
                    if($amphures != 0){
                        $query->where('profiles.amphures_id',  $amphures);
                    }
                    if($districts != 0){
                        $query->where('profiles.districts_id', $districts);
                    }
                })->where(function ($query) {
                    $query->Where('type_user_id_2', '=', 2)
                        ->orWhere('type_user_id_3', '=', 3);
                })->groupBy('erp_store_products.user_id')->get();

            $sql= DB::table('profiles')
                ->join('erp_store_products','erp_store_products.user_id','=','profiles.user_id')
                ->select('profiles.*')
                ->where(function ($query) use ($districts, $amphures, $provinces_id) {
                    if($provinces_id != 0){
                        $query->where('profiles.provinces_id', $provinces_id);
                    }
                    if($amphures != 0){
                        $query->where('profiles.amphures_id',  $amphures);
                    }
                    if($districts != 0){
                        $query->where('profiles.districts_id', $districts);
                    }
                })->where(function ($query) use ($districts, $amphures, $provinces_id){
                    $query->Where('type_user_id_2', '=', 2)
                        ->orWhere('type_user_id_3', '=', 3);
                })->groupBy('erp_store_products.user_id')->toSql();

            if(count($checkProfileAddress) > 0){
                $arr = [];
                for ($i = 0 ; $i < count($checkProfileAddress);$i++){
                    $arr[] = $checkProfileAddress[$i]->user_id;
                }
                $brandStore = ErpStoreProduct::select('product_brand')
                    ->whereIn('user_id',$arr)
                    ->groupBy('product_brand')
                    ->get();
                $brandStore2 = DB::table('erp_product_air')
                    ->select('air_brand_id','air_brand_name','pa_image')
                    ->whereIn('user_id',$arr)
                    ->groupBy('air_brand_id')
                    ->get();

                return json_encode([
                    'msg' => 'success',
                    'inputArr' => $inputArr,
                    'data' => $checkProfileAddress,
                    'brandStore' => $brandStore ,
                    'brandStore2' => $brandStore2 ,
                    'sql' => $sql ,
                ]);
            }else{
                return json_encode([
                    'msg' => 'error',
                    'inputArr' => $inputArr,
                    'sql' => $sql ,
                ]);
            }
        }else{
            return json_encode([
                'msg' => 'error',
                'inputArr' => $inputArr,
            ]);
        }
    }

    public function getBrandProductStore($brandName , $btu)
    {
        if($brandName != null){
            $store = ErpStoreProduct::join('profiles','erp_store_products.user_id','=','profiles.user_id')
                ->select('erp_store_products.user_id'  , 'profiles.company' , 'profiles.company_logo' ,'profiles.review_profile'
                    ,'profiles.provinces_id' , 'profiles.amphures_id' , 'profiles.districts_id',
                    DB::raw("case when profiles.provinces_id != '' then (select provinces.PROVINCE_NAME from provinces where PROVINCE_ID = profiles.provinces_id) else '' end as provinces"),
                    DB::raw("case when profiles.amphures_id != '' then (select amphures.AMPHUR_NAME from amphures where amphures_id = profiles.amphures_id) else '' end as amphures"),
                    DB::raw("case when profiles.districts_id != '' then (select districts.DISTRICT_NAME from districts where districts_id = profiles.districts_id) else '' end as districts")
                )
                ->where('erp_store_products.product_brand', 'like', '%'.$brandName.'%')
                ->groupBy('product_brand')
                ->get();
            foreach ($store as $key => $value){
                $products = ErpStoreProduct::where('product_brand', 'like', '%'.$brandName.'%')
                    ->whereBetween('product_btu',[$btu - 2000 , $btu + 2000])
                    ->where('product_stock','>',0)
                    ->where('user_id',$value->user_id)
                    ->get();
                $psp_id = [];
                for ($i = 0 ; $i < count($products);$i++){
                    $psp_id[] = $products[$i]->id;
                }
                $giftIn = ErpStoreGift::whereIn('psp_id',$psp_id)->get();
                foreach ($products as $keyB => $valueB){
                    $gifts = ErpStoreGift::where('psp_id',$valueB->id)->get();
                    $products[$keyB]->gifts = (count($gifts) > 0?$gifts:"ไม่มีของแถม") ;
                }

                $store[$key]->products = (count($products) > 0?$products:"ไม่มีสินค้า");
                $store[$key]->gift = (count($giftIn)>0?"มีของแถม":"ไม่มีของแถม") ;
                $store[$key]->promotion = "ไม่มี" ;

                $max = ErpStoreProduct::where('user_id',$value->user_id)->max('product_price');
                $min = ErpStoreProduct::where('user_id',$value->user_id)->min('product_price');
                $store[$key]->max_price = $max ;
                $store[$key]->min_price = $min ;
            }


            $store2 = DB::table('erp_product_air')
                ->join('profiles','erp_product_air.user_id','=','profiles.user_id')
                ->select('erp_product_air.user_id'  , 'profiles.company' , 'profiles.company_logo' ,'profiles.review_profile',
                    'profiles.provinces_id' , 'profiles.amphures_id' , 'profiles.districts_id',
                    DB::raw("case when profiles.provinces_id != '' then (select provinces.PROVINCE_NAME from provinces where PROVINCE_ID = profiles.provinces_id) else '' end as provinces"),
                    DB::raw("case when profiles.amphures_id != '' then (select amphures.AMPHUR_NAME from amphures where amphures_id = profiles.amphures_id) else '' end as amphures"),
                    DB::raw("case when profiles.districts_id != '' then (select districts.DISTRICT_NAME from districts where districts_id = profiles.districts_id) else '' end as districts")
                )
                ->where('erp_product_air.air_brand_name', 'like', '%'.$brandName.'%')
                ->groupBy('air_brand_name')
                ->get();
            foreach ($store2 as $key => $value){
                $products2 = DB::table('erp_product_air')
                    ->where('air_brand_name', 'like', '%'.$brandName.'%')
                    ->whereBetween('air_btu_detail',[$btu - 2000 , $btu + 2000])
                    ->where('pa_stock','>',0)
                    ->where('user_id',$value->user_id)
                    ->get();
                $psp_id2 = [];
                for ($i = 0 ; $i < count($products2);$i++){
                    $psp_id2[] = $products2[$i]->id;
                }
                $giftIn2 = ErpStoreGift::whereIn('psp_id',$psp_id2)->get();
                foreach ($products2 as $keyB => $valueB){
                    $gifts2 = ErpStoreGift::where('psp_id',$valueB->id)->get();
                    $products2[$keyB]->gifts = (count($gifts2) > 0?$gifts2:"ไม่มีของแถม") ;
                }
                $store2[$key]->products = (count($products2) > 0?$products2:"ไม่มีสินค้า");
                $store2[$key]->gift = (count($giftIn2)>0?"มีของแถม":"ไม่มีของแถม") ;
                $store2[$key]->promotion = "ไม่มี" ;
                $max = DB::table('erp_product_air')
                    ->where('user_id',$value->user_id)->max('air_price_list');
                $min = DB::table('erp_product_air')
                    ->where('user_id',$value->user_id)->min('air_price_list');
                $store2[$key]->max_price = $max ;
                $store2[$key]->min_price = $min ;
            }


            return json_encode([
                'msg' => 'success',
                'inputArr' => $brandName,
                'store' => $store,
                'store2' => $store2,
            ]);
        }else{
            return json_encode([
                'msg' => 'error',
                'inputArr' => $brandName,
            ]);
        }
    }

    public function getProductList($brandName , $btu , $user_id)
    {
        $products = ErpStoreProduct::where('product_brand', 'like', '%'.$brandName.'%')
            ->whereBetween('product_btu',[$btu - 2000 , $btu + 2000])
            ->where('product_stock','>',0)
            ->where('user_id',$user_id)
            ->get();
        foreach ($products as $keyB => $valueB){
            $gifts = ErpStoreGift::where('psp_id',$valueB->id)->get();
            $products[$keyB]->gifts = (count($gifts) > 0?$gifts:"ไม่มีของแถม") ;
        }

        $products2 = DB::table('erp_product_air')
            ->where('air_brand_name', 'like', '%'.$brandName.'%')
            ->whereBetween('air_btu_detail',[$btu - 2000 , $btu + 2000])
            ->where('pa_stock','>',0)
            ->where('user_id',$user_id)
            ->get();
        foreach ($products2 as $keyB => $valueB){
            $gifts = ErpStoreGift::where('psp_id',$valueB->id)->get();
            $products2[$keyB]->gifts = (count($gifts) > 0?$gifts:"ไม่มีของแถม") ;
        }

        return json_encode([
            'msg' => 'success',
            'inputArr' => $brandName,
            'product' => $products,
            'product2' => $products2,
        ]);
    }

    public function getProductListDetail($id1 , $id2)
    {
        $products1 = DB::table('erp_product_air')
            ->where('id','=',$id1)
            ->get();
        foreach ($products1 as $keyA => $valueB){
            $gifts = ErpStoreGift::where('psp_id',$valueB->id)->get();
            $products1[$keyA]->gifts = (count($gifts) > 0?$gifts:"ไม่มีของแถม") ;
        }
        $products2 = DB::table('erp_product_air')
            ->where('id','=',$id2)
            ->get();
        foreach ($products2 as $keyB => $valueB){
            $gifts = ErpStoreGift::where('psp_id',$valueB->id)->get();
            $products2[$keyB]->gifts = (count($gifts) > 0?$gifts:"ไม่มีของแถม") ;
        }
        return json_encode([
            'msg' => 'success',
            'product1' => $products1,
            'product2' => $products2,
        ]);
    }

}
