<?php

namespace App\Http\Controllers\frontend;

use App\Models\Air_Conditioning;
use App\Models\Brands;
use App\Models\ErpStoreGift;
use App\Models\ErpStoreProduct;
use App\Models\Profile;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ErpStoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function erpPriceSetup()
    {
        $profile = $this->permission();
        if($profile->statusType == 1){
            return redirect('erp-home');
        }elseif($profile->statusType == 2){
            $airBTU = DB::table('air_btu')
//                ->whereNotIn('id',$arr)
                ->orderBy('air_btu_detail', 'asc')
                ->get();
//            dd($airBTU);
            $auth_id = Auth::user()->id;
            return view('frontend.ERP.erp-priceSetup',[
                'page' =>1 ,
                'profile' =>$profile ,
                'airBTU' =>$airBTU ,
                'auth_id' =>$auth_id ,
            ]);
        }
    }

    public function erpAirProduct()
    {
        $profile = $this->permission();
        if($profile->statusType == 1){
            return redirect('erp-home');
        }elseif($profile->statusType == 2){
            $airBTU = DB::table('air_btu')
                ->orderBy('air_btu_detail', 'asc')
                ->get();
            $auth_id = Auth::user()->id;
            return view('frontend.ERP.erp-priceSetup',[
                'page' => 2 ,
                'profile' =>$profile ,
                'airBTU' =>$airBTU ,
                'auth_id' =>$auth_id ,
            ]);
        }
    }

    public function erpInfoStore()
    {
        $profile = $this->permission();
        if($profile->statusType == 1){
            return redirect('erp-home');
        }elseif($profile->statusType == 2){
            $auth_id = Auth::user()->id;
            $dropdownBrand = DB::table('air_conditionings')
                ->join('brands','air_conditionings.brand_id','=','brands.id')
                ->select('air_conditionings.brand_id','brands.name')
                ->where('type_sub_work_id','=',1)
                ->groupBy('air_conditionings.brand_id')
                ->get();
            $store_air = DB::table('erp_store_products')
                ->where('user_id','=',$auth_id)
                ->orderBy('id','desc')
                ->paginate(3);
            $store_product = DB::table('erp_product_air')
                ->where('user_id','=',$auth_id)
                ->whereNull('deleted_at')
                ->orderBy('id','desc')
                ->paginate(3);

            return view('frontend.ERP.erp-infoStore',[
                'auth_id' =>$auth_id ,
                'profile' =>$profile ,
                'dropdownBrand' =>$dropdownBrand ,
                'store_air' => (count($store_product) > 0)?$store_product:null,
            ]);
        }
    }

    public function erpInfoStoreProduct($id)
    {
        $profile = $this->permission();
        if($profile->statusType == 1){
            return redirect('erp-home');
        }elseif($profile->statusType == 2){
            $auth_id = Auth::user()->id;
            $dropdownBrand = DB::table('air_conditionings')
                ->join('brands','air_conditionings.brand_id','=','brands.id')
                ->select('air_conditionings.brand_id','brands.name')
                ->where('type_sub_work_id','=',1)
                ->groupBy('air_conditionings.brand_id')
                ->get();
//            $storeProduct = ErpStoreProduct::find($id);
            $storeProduct = DB::table('erp_product_air')
                ->where('id','=',$id)->first();
            $air_type_sub_name = '';
            if($storeProduct->air_type_id == 2){
                $pa = DB::table('air_data')
                    ->where('id','=',$storeProduct->air_data_id)
                    ->first();
                $air_type_sub_name = $pa->air_type_sub_name ;
            }
            $storeGift = ErpStoreGift::where('psp_id','=',$id)->get();
            $air_data_details = DB::table('air_data_details')
                ->where('air_data_id','=',$storeProduct->air_data_id)
                ->get();
            return view('frontend.ERP.erp-infoStore-detail',[
                'type_page' => 1 ,
                'id' =>$id ,
                'profile' =>$profile ,
                'dropdownBrand' =>$dropdownBrand ,
                'storeProduct' => $storeProduct,
                'air_type_sub_name' => $air_type_sub_name,
                'storeGift' => (count($storeGift) > 0)?$storeGift:null,
                'air_data_details' => (count($air_data_details) > 0)?$air_data_details:null,
            ]);
        }
    }

    public function erpEditStoreProduct($id)
    {
        $profile = $this->permission();
        if($profile->statusType == 1){
            return redirect('erp-home');
        }elseif($profile->statusType == 2){
            $auth_id = Auth::user()->id;
            $dropdownBrand = DB::table('air_conditionings')
                ->join('brands','air_conditionings.brand_id','=','brands.id')
                ->select('air_conditionings.brand_id','brands.name')
                ->where('type_sub_work_id','=',1)
                ->groupBy('air_conditionings.brand_id')
                ->get();
//            $storeProduct = ErpStoreProduct::find($id);
            $storeProduct = DB::table('erp_product_air')
                ->where('id','=',$id)->first();
            $storeGift = ErpStoreGift::where('psp_id','=',$id)->get();

            return view('frontend.ERP.erp-infoStore-detail',[
                'type_page' => 2 ,
                'id' =>$id ,
                'profile' =>$profile ,
                'dropdownBrand' =>$dropdownBrand ,
                'storeProduct' => $storeProduct,
                'storeGift' => (count($storeGift) > 0)?$storeGift:null,
            ]);
        }
    }

    public function erpPurchaseOrder()
    {
        $profile = $this->permission();
        if($profile->statusType == 1){
            return redirect('erp-home');
        }elseif($profile->statusType == 2){
            $auth_id = Auth::user()->id;
            return view('frontend.ERP.erp-purchaseOrder',[
                'type_page' => 2 ,
                'profile' =>$profile ,
                'auth_id' =>$auth_id ,
            ]);
        }
    }

    public function erpInstall()
    {
        $profile = $this->permission();
        if($profile->statusType == 1){
            return redirect('erp-home');
        }elseif($profile->statusType == 2){
            $auth_id = Auth::user()->id;
            return view('frontend.ERP.erp-install',[
                'type_page' => 2 ,
                'profile' =>$profile ,
                'auth_id' =>$auth_id ,
            ]);
        }
    }

    public function erpService()
    {
        $profile = $this->permission();
        if($profile->statusType == 1){
            return redirect('erp-home');
        }elseif($profile->statusType == 2){
            $auth_id = Auth::user()->id;
            return view('frontend.ERP.erp-service',[
                'type_page' => 2 ,
                'profile' =>$profile ,
                'auth_id' =>$auth_id ,
            ]);
        }
    }

    public function permission()
    {
        $auth_id = Auth::user()->id;
        $statusType = null;
        $profile = Profile::join('users','profiles.user_id','=','users.id')
            ->select('profiles.*','users.email')
            ->where('user_id',$auth_id)
            ->first();
        if ($profile->type_user_id == 1 && $profile->type_user_id_2 == null && $profile->type_user_id_3 == null){
            // 1 ผู้ว่าจ้าง
            $statusName = "ผู้ชื้อ";
            $statusType = 1;
        }elseif($profile->type_user_id_2 == 2 || $profile->type_user_id_3 == 3){
            // 2 ผู้รับจ้าง , 3 ผู้รับเหมา
            $statusName = "เจ้าของร้าน";
            $statusType = 2;
        }
        $profile->statusName = $statusName;
        $profile->statusType = $statusType;

        return  $profile;
    }

    public function store(Request $request)
    {
        $now = new DateTime();
        $auth_id = Auth::user()->id;

//        dd($request->all());

        if (!empty($request->product_image)) {
            if ($request->hasFile('product_image') != '') {
                $imageStoreProduct = 'store_product_'. str_random(4) .".".$request->file('product_image')->getClientOriginalExtension();
                $request->file('product_image')->move(public_path() . '/images/store-product/', $imageStoreProduct);
            }
        }

        $erpStoreProduct = new ErpStoreProduct();
        $erpStoreProduct->product_name = $request->product_name;
        $erpStoreProduct->product_image = $imageStoreProduct;
        $erpStoreProduct->product_details = $request->product_details;


        if($request->brand  == 0){
            $erpStoreProduct->product_brand = $request->product_brand;
            $erpStoreProduct->product_series = $request->product_series;
            $erpStoreProduct->product_btu = $request->product_btu;
            $erpStoreProduct->product_price = $request->product_price;
        }else{
            if($request->product_air_id != 0){
                $erpStoreProduct->product_air_id = $request->product_air_id;
                $data_air = Air_Conditioning::find($request->product_air_id);
                $data_brand = Brands::find($data_air->brand_id);
                $erpStoreProduct->product_brand = $data_brand->name;
                $erpStoreProduct->product_series = $data_air->model;
                $erpStoreProduct->product_btu = $data_air->price;
                $erpStoreProduct->product_price = $request->product_price1;
            }else{
                $erpStoreProduct->product_brand = $request->product_brand;
                $erpStoreProduct->product_series = $request->product_series1;
                $erpStoreProduct->product_btu = $request->product_btu1;
                $erpStoreProduct->product_price = $request->product_price1;
            }
        }

        if($request->product_air_id != 0){
            $erpStoreProduct->product_air_id = $request->product_air_id;
            $data_air = Air_Conditioning::find($request->product_air_id);
            $data_brand = Brands::find($data_air->brand_id);
            $erpStoreProduct->product_brand = $data_brand->name;
            $erpStoreProduct->product_series = $data_air->model;
            $erpStoreProduct->product_btu = $data_air->price;
        }else{
            $erpStoreProduct->product_brand = $request->product_brand;
            $erpStoreProduct->product_series = $request->product_series;
            $erpStoreProduct->product_btu = $request->product_btu;
        }
        $erpStoreProduct->product_price = $request->product_price;
        $erpStoreProduct->product_vat = $request->product_vat;
        $erpStoreProduct->product_stock = $request->product_stock;
        $erpStoreProduct->product_setup = $request->product_setup;
        $erpStoreProduct->product_setup2 = $request->product_setup2;
        $erpStoreProduct->product_piping = $request->product_piping;
        $erpStoreProduct->user_id = $auth_id;
        $erpStoreProduct->created_at = $now;
        $erpStoreProduct->updated_at = null;
        $erpStoreProduct->save();

        $lastId_StoreProduct = $erpStoreProduct->id;
        if ($request->gift_name[0] != null){
            for ($i = 0 ; $i < count($request->gift_name);$i++){
                $erpStoreGift = new ErpStoreGift();
                $erpStoreGift->psp_id = $lastId_StoreProduct;
                $erpStoreGift->gift_name = $request->gift_name[$i];
                $erpStoreGift->gift_count = $request->gift_count[$i];
                $erpStoreGift->save();
            }
        }
        Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
        return redirect('erp-infoStore');
    }

    public function update(Request $request, $id)
    {
        $now = new DateTime();
        $auth_id = Auth::user()->id;
        $auth_name = Auth::user()->name;
        $type = $request->type ;
        $profile = Profile::find($id);
        if($type == 1){
            if (!empty($request->company_logo)) {
                if ($request->hasFile('company_logo') != '') {
                    File::delete(public_path() . '/images/profile/company_logo/' . $profile->company_logo);
                    $imageLogo= 'company_logo_'.$profile->id.".".$request->file('company_logo')->getClientOriginalExtension();
                    $request->file('company_logo')->move(public_path() . '/images/profile/company_logo/', $imageLogo);
                }
            }else{
                $imageLogo = $profile->company_logo ;
            }
            $profile->company = $request->company;
            $profile->company_logo = $imageLogo;
            $profile->company_address = $request->company_address;
            $profile->tel = $request->tel;
            $profile->updated_at = $now;
            $profile->update();
        }elseif($type == 2){
            // Update Stock Product
//            echo  $id;
//            dd($request->all());
            $storeProduct = ErpStoreProduct::find($id);
            $storeProduct->product_name = $request->product_name;
            if (!empty($request->product_image)) {
                if ($request->hasFile('product_image') != '') {
                    $imageStoreProduct = 'store_product_'. str_random(4) .".".$request->file('product_image')->getClientOriginalExtension();
                    $request->file('product_image')->move(public_path() . '/images/store-product/', $imageStoreProduct);
                    $storeProduct->product_image = $imageStoreProduct;
                }
            }
            $storeProduct->product_details = $request->product_details;
            $storeProduct->product_brand = $request->product_brand;
            $storeProduct->product_series = $request->product_series;
            $storeProduct->product_btu = $request->product_btu;
            $storeProduct->product_price = $request->product_price;
            $storeProduct->product_vat = $request->product_vat;
            $storeProduct->product_stock = $request->product_stock;
            $storeProduct->product_setup = $request->product_setup;
            $storeProduct->product_setup2 = $request->product_setup2;
            $storeProduct->product_piping = $request->product_piping;
            $storeProduct->update();
            if (!empty($request->del_storeGift)) {
                if ($request->count_storeGift != null) {
                    for ($i = 0; $i < $request->count_storeGift; $i++) {
                        if (!empty($request->del_storeGift[$i])) {
                            if ($request->del_storeGift[$i] != null) {
                                ErpStoreGift::destroy($request->del_storeGift[$i]);
                            }
                        }
                    }
                }
            }
            if ($request->gift_name[0] != null){
                for ($i = 0 ; $i < count($request->gift_name);$i++){
                    $erpStoreGift = new ErpStoreGift();
                    $erpStoreGift->psp_id = $id;
                    $erpStoreGift->gift_name = $request->gift_name[$i];
                    $erpStoreGift->gift_count = $request->gift_count[$i];
                    $erpStoreGift->save();
                }
            }
        }
        Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
        return redirect('erp-infoStore');
    }

    public function deleteProduct($id)
    {
        $storeProduct = ErpStoreProduct::find($id);
        File::delete(public_path() . '/images/store-product/' . $storeProduct->product_image);
        $erpStoreGift = ErpStoreGift::where('psp_id','=',$id)->get();
        if(count($erpStoreGift) > 0){
            ErpStoreGift::where('psp_id','=',$id)->delete();
        }
        ErpStoreProduct::destroy($id);
        Session::flash('status', 'ลบข้อมูลเรียบร้อย !');
        return redirect('erp-infoStore');
    }


}
