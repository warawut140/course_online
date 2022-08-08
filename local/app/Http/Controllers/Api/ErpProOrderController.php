<?php

namespace App\Http\Controllers\Api;

use App\Models\ErpPreOrder;
use App\Models\ErpService;
use App\Models\ErpStoreProduct;
use App\Models\Profile;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ErpProOrderController extends Controller
{
    // Home
    public function store(Request $request)
    {
        $now = new DateTime();
        $erpPreOrder = new  ErpPreOrder();
        $erpPreOrder->user_id = $request->get('auth_id');
        $erpPreOrder->erp_sp_id = $request->get('erp_sp_id');
        $erpPreOrder->erp_sp_brand = $request->get('erp_sp_brand');
        $erpPreOrder->erp_sp_series = $request->get('erp_sp_series');
        $erpPreOrder->erp_sp_btu = $request->get('erp_sp_btu');
        $erpPreOrder->erp_sp_setup = $request->get('erp_sp_setup');
        $erpPreOrder->erp_sp_setup_value = $request->get('erp_sp_setup_value');
        $erpPreOrder->erp_sp_vat = $request->get('erp_sp_vat');
        $text = "";

        if ($request->get('erp_gifts') != "ไม่มีของแถม") {
            for ($i = 0; $i < count($request->get('erp_gifts')); $i++) {
                $text .= $request->get('erp_gifts')[$i]['gift_name'] . "  จำนวน " . $request->get('erp_gifts')[$i]['gift_count'] . "<br>";
            }
            $erpPreOrder->erp_gifts = $text;
        } else {
            $erpPreOrder->erp_gifts = null;
        }

        $erpPreOrder->erp_sp_promotion = ($request->get('erp_sp_promotion') == null ? 1 : $request->get('erp_sp_promotion'));
        $erpPreOrder->erp_pre_count = $request->get('erp_pre_count');
        $erpPreOrder->erp_pre_date_setup = $request->get('erp_pre_date_setup');
        $erpPreOrder->erp_pre_fullname = $request->get('erp_pre_fullname');
        $erpPreOrder->erp_pre_tel = $request->get('erp_pre_tel');
        $erpPreOrder->erp_pre_email = $request->get('erp_pre_email');
        $erpPreOrder->erp_pre_line = $request->get('erp_pre_line');
        $erpPreOrder->erp_sp_payment = $request->get('erp_sp_payment');
        $erpPreOrder->created_at = $now;
        $erpPreOrder->updated_at = null;
        $erpPreOrder->save();

        return response()->json([
            'msg' => 'success',
//            'request' => $request->all() ,
        ]);

    }

    public function update(Request $request, $id)
    {
        $now = new DateTime();
        $erpPreOrder = ErpPreOrder::find($id);
        if ($erpPreOrder != null) {
            $response = [
                'success' => true,
                'status' => 'success',
//                'request_data' => $request->all() ,
//                'id' => $id ,
            ];
            $erpPreOrder->erp_pre_status_install = 4;
            $erpPreOrder->erp_pre_review = $request->review;
            $erpPreOrder->erp_pre_review_detail = $request->details;
            $erpPreOrder->updated_at = $now;
            $erpPreOrder->update();
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'status' => 'fail',
            ];
            return response()->json($response, 404);
        }
    }

    public function updateCancel(Request $request, $id)
    {
        $erpPreOrder = ErpPreOrder::find($id);
        if ($erpPreOrder != null) {
            $response = [
                'success' => true,
                'status' => 'success',
                'request_data' => $request->all(),
            ];
            $erpPreOrder->erp_pre_status_payment = 3;
            $erpPreOrder->update();
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'status' => 'fail',
            ];
            return response()->json($response, 404);
        }
    }

    public function getPreOrderAriListPayment($user_id)
    {
        $data = ErpPreOrder::where('user_id', $user_id)
            ->where('erp_pre_status_payment', 1)
            ->get();
        if (count($data) > 0) {
            foreach ($data as $key => $datum) {
//                $product = ErpStoreProduct::join('profiles', 'erp_store_products.user_id', '=', 'profiles.user_id')
//                    ->select('erp_store_products.product_image', 'erp_store_products.user_id', 'erp_store_products.product_price',
//                        'profiles.company', 'profiles.company_logo', 'profiles.review_profile'
//                        , 'profiles.provinces_id', 'profiles.amphures_id', 'profiles.districts_id',
//                        DB::raw("case when profiles.provinces_id != '' then (select provinces.PROVINCE_NAME from provinces where PROVINCE_ID = profiles.provinces_id) else '' end as provinces"),
//                        DB::raw("case when profiles.amphures_id != '' then (select amphures.AMPHUR_NAME from amphures where amphures_id = profiles.amphures_id) else '' end as amphures"),
//                        DB::raw("case when profiles.districts_id != '' then (select districts.DISTRICT_NAME from districts where districts_id = profiles.districts_id) else '' end as districts")
//                    )
//                    ->where('erp_store_products.id', '=', $datum->erp_sp_id)
//                    ->first();
//                $data[$key]->product_image = $product->product_image;
//                $data[$key]->company_user_id = $product->user_id;
//                $data[$key]->product_price = $product->product_price;
//                $data[$key]->company = $product->company;
//                $data[$key]->company_logo = $product->company_logo;
//                $data[$key]->review_profile = $product->review_profile;
//                $data[$key]->provinces = $product->provinces;
//                $data[$key]->amphures = $product->amphures;
//                $data[$key]->districts = $product->districts;


                $product2 = DB::table('erp_product_air')
                    ->join('profiles', 'erp_product_air.user_id', '=', 'profiles.user_id')
                    ->select('erp_product_air.pa_image as product_image', 'erp_product_air.user_id',
                        'erp_product_air.air_price_list as product_price',
                        'profiles.company', 'profiles.company_logo', 'profiles.review_profile'
                        , 'profiles.provinces_id', 'profiles.amphures_id', 'profiles.districts_id',
                        DB::raw("case when profiles.provinces_id != '' then (select provinces.PROVINCE_NAME from provinces where PROVINCE_ID = profiles.provinces_id) else '' end as provinces"),
                        DB::raw("case when profiles.amphures_id != '' then (select amphures.AMPHUR_NAME from amphures where amphures_id = profiles.amphures_id) else '' end as amphures"),
                        DB::raw("case when profiles.districts_id != '' then (select districts.DISTRICT_NAME from districts where districts_id = profiles.districts_id) else '' end as districts")
                    )
                    ->where('erp_product_air.id', '=', $datum->erp_sp_id)
                    ->first();
                $data[$key]->product_image = $product2->product_image;
                $data[$key]->company_user_id = $product2->user_id;
                $data[$key]->product_price = $product2->product_price;
                $data[$key]->company = $product2->company;
                $data[$key]->company_logo = $product2->company_logo;
                $data[$key]->review_profile = $product2->review_profile;
                $data[$key]->provinces = $product2->provinces;
                $data[$key]->amphures = $product2->amphures;
                $data[$key]->districts = $product2->districts;

            }
        }
        return json_encode([
            'msg' => 'success',
            'product' => $data,
        ]);
    }

    public function getPreOrderAriListInstall($user_id)
    {
        $data = ErpPreOrder::where('user_id', $user_id)
            ->where('erp_pre_status_payment', 2)
            ->whereIn('erp_pre_status_install', [1, 2, 3, 5])
            ->get();
        if (count($data) > 0) {
            foreach ($data as $key => $datum) {
//                $product = ErpStoreProduct::join('profiles', 'erp_store_products.user_id', '=', 'profiles.user_id')
//                    ->select('erp_store_products.product_image', 'erp_store_products.user_id', 'erp_store_products.product_price',
//                        'profiles.company', 'profiles.company_logo', 'profiles.review_profile'
//                        , 'profiles.provinces_id', 'profiles.amphures_id', 'profiles.districts_id',
//                        DB::raw("case when profiles.provinces_id != '' then (select provinces.PROVINCE_NAME from provinces where PROVINCE_ID = profiles.provinces_id) else '' end as provinces"),
//                        DB::raw("case when profiles.amphures_id != '' then (select amphures.AMPHUR_NAME from amphures where amphures_id = profiles.amphures_id) else '' end as amphures"),
//                        DB::raw("case when profiles.districts_id != '' then (select districts.DISTRICT_NAME from districts where districts_id = profiles.districts_id) else '' end as districts")
//                    )
//                    ->where('erp_store_products.id', '=', $datum->erp_sp_id)
//                    ->first();
//                $data[$key]->product_image = $product->product_image;
//                $data[$key]->company_user_id = $product->user_id;
//                $data[$key]->product_price = $product->product_price;
//                $data[$key]->company = $product->company;
//                $data[$key]->company_logo = $product->company_logo;
//                $data[$key]->review_profile = $product->review_profile;
//                $data[$key]->provinces = $product->provinces;
//                $data[$key]->amphures = $product->amphures;
//                $data[$key]->districts = $product->districts;


                $product2 = DB::table('erp_product_air')
                    ->join('profiles', 'erp_product_air.user_id', '=', 'profiles.user_id')
                    ->select('erp_product_air.pa_image as product_image', 'erp_product_air.user_id',
                        'erp_product_air.air_price_list as product_price',
                        'profiles.company', 'profiles.company_logo', 'profiles.review_profile'
                        , 'profiles.provinces_id', 'profiles.amphures_id', 'profiles.districts_id',
                        DB::raw("case when profiles.provinces_id != '' then (select provinces.PROVINCE_NAME from provinces where PROVINCE_ID = profiles.provinces_id) else '' end as provinces"),
                        DB::raw("case when profiles.amphures_id != '' then (select amphures.AMPHUR_NAME from amphures where amphures_id = profiles.amphures_id) else '' end as amphures"),
                        DB::raw("case when profiles.districts_id != '' then (select districts.DISTRICT_NAME from districts where districts_id = profiles.districts_id) else '' end as districts")
                    )
                    ->where('erp_product_air.id', '=', $datum->erp_sp_id)
                    ->first();
                $data[$key]->product_image = $product2->product_image;
                $data[$key]->company_user_id = $product2->user_id;
                $data[$key]->product_price = $product2->product_price;
                $data[$key]->company = $product2->company;
                $data[$key]->company_logo = $product2->company_logo;
                $data[$key]->review_profile = $product2->review_profile;
                $data[$key]->provinces = $product2->provinces;
                $data[$key]->amphures = $product2->amphures;
                $data[$key]->districts = $product2->districts;
            }
        }
        return json_encode([
            'msg' => 'success',
            'product' => $data,
        ]);
    }

    public function getPreOrderAriListInstallSuccess($user_id)
    {
        $data = ErpPreOrder::where('user_id', $user_id)
            ->where('erp_pre_status_payment', 2)
            ->where('erp_pre_status_install', 3)
            ->get();
        if (count($data) > 0) {
            foreach ($data as $key => $datum) {
//                $product = ErpStoreProduct::join('profiles', 'erp_store_products.user_id', '=', 'profiles.user_id')
//                    ->select('erp_store_products.product_image', 'erp_store_products.user_id', 'erp_store_products.product_price',
//                        'profiles.company', 'profiles.company_logo', 'profiles.review_profile'
//                        , 'profiles.provinces_id', 'profiles.amphures_id', 'profiles.districts_id',
//                        DB::raw("case when profiles.provinces_id != '' then (select provinces.PROVINCE_NAME from provinces where PROVINCE_ID = profiles.provinces_id) else '' end as provinces"),
//                        DB::raw("case when profiles.amphures_id != '' then (select amphures.AMPHUR_NAME from amphures where amphures_id = profiles.amphures_id) else '' end as amphures"),
//                        DB::raw("case when profiles.districts_id != '' then (select districts.DISTRICT_NAME from districts where districts_id = profiles.districts_id) else '' end as districts")
//                    )
//                    ->where('erp_store_products.id', '=', $datum->erp_sp_id)
//                    ->first();
//                $data[$key]->product_image = $product->product_image;
//                $data[$key]->company_user_id = $product->user_id;
//                $data[$key]->product_price = $product->product_price;
//                $data[$key]->company = $product->company;
//                $data[$key]->company_logo = $product->company_logo;
//                $data[$key]->review_profile = $product->review_profile;
//                $data[$key]->provinces = $product->provinces;
//                $data[$key]->amphures = $product->amphures;
//                $data[$key]->districts = $product->districts;


                $product2 = DB::table('erp_product_air')
                    ->join('profiles', 'erp_product_air.user_id', '=', 'profiles.user_id')
                    ->select('erp_product_air.pa_image as product_image', 'erp_product_air.user_id',
                        'erp_product_air.air_price_list as product_price',
                        'profiles.company', 'profiles.company_logo', 'profiles.review_profile'
                        , 'profiles.provinces_id', 'profiles.amphures_id', 'profiles.districts_id',
                        DB::raw("case when profiles.provinces_id != '' then (select provinces.PROVINCE_NAME from provinces where PROVINCE_ID = profiles.provinces_id) else '' end as provinces"),
                        DB::raw("case when profiles.amphures_id != '' then (select amphures.AMPHUR_NAME from amphures where amphures_id = profiles.amphures_id) else '' end as amphures"),
                        DB::raw("case when profiles.districts_id != '' then (select districts.DISTRICT_NAME from districts where districts_id = profiles.districts_id) else '' end as districts")
                    )
                    ->where('erp_product_air.id', '=', $datum->erp_sp_id)
                    ->first();
                $data[$key]->product_image = $product2->product_image;
                $data[$key]->company_user_id = $product2->user_id;
                $data[$key]->product_price = $product2->product_price;
                $data[$key]->company = $product2->company;
                $data[$key]->company_logo = $product2->company_logo;
                $data[$key]->review_profile = $product2->review_profile;
                $data[$key]->provinces = $product2->provinces;
                $data[$key]->amphures = $product2->amphures;
                $data[$key]->districts = $product2->districts;
            }
        }
        return json_encode([
            'msg' => 'success',
            'product' => $data,
        ]);
    }

    // Other
    public function storeService(Request $request)
    {
        $now = new DateTime();
        $erpService = new  ErpService();
        $erpService->erp_po_id = $request->erp_po_id;
        $erpService->erp_service = $request->erp_service;
        $erpService->erp_s_type = $request->erp_s_type;
        $erpService->erp_s_status = 1;
        $erpService->erp_s_details = $request->erp_s_details;
        $erpService->erp_s_date = $request->erp_s_date;
        $erpService->erp_s_date_setup = null;
        $erpService->erp_s_price = null;
        if ($erpService->erp_s_type == 3) {
            $erpService->service_user_id = null;
        } else {
            $erpService->service_user_id = $request->service_user_id;
        }
        $erpService->created_at = $now;
        $erpService->updated_at = null;
//        $erpService->save();
        if ($erpService->save()) {
            $response = [
                'success' => true,
                'status' => 'success',
                'request_data' => $request->all(),
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'status' => 'fail',
            ];
            return response()->json($response, 404);
        }
    }

    public function updateService(Request $request, $id)
    {
        $now = new DateTime();
        $erpService = ErpService::find($request->s_id);
        if ($erpService != null) {
            $erpService->erp_s_status = $request->s_status;
            $erpService->updated_at = $now;
            $erpService->update();
            $response = [
                'success' => true,
                'status' => 'success',
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'status' => 'fail',
            ];
            return response()->json($response, 404);
        }
    }

    public function getPreOrderAirListSuccess($user_id)
    {
        $data = ErpPreOrder::where('user_id', $user_id)
            ->where('erp_pre_status_payment', 2)
            ->where('erp_pre_status_install', 4)
            ->get();
        if (count($data) > 0) {
            foreach ($data as $key => $datum) {
                $product = ErpStoreProduct::join('profiles', 'erp_store_products.user_id', '=', 'profiles.user_id')
                    ->select('erp_store_products.product_image', 'erp_store_products.user_id', 'erp_store_products.product_price',
                        'profiles.company', 'profiles.company_logo', 'profiles.review_profile'
                        , 'profiles.provinces_id', 'profiles.amphures_id', 'profiles.districts_id',
                        DB::raw("case when profiles.provinces_id != '' then (select provinces.PROVINCE_NAME from provinces where PROVINCE_ID = profiles.provinces_id) else '' end as provinces"),
                        DB::raw("case when profiles.amphures_id != '' then (select amphures.AMPHUR_NAME from amphures where amphures_id = profiles.amphures_id) else '' end as amphures"),
                        DB::raw("case when profiles.districts_id != '' then (select districts.DISTRICT_NAME from districts where districts_id = profiles.districts_id) else '' end as districts")
                    )
                    ->where('erp_store_products.id', '=', $datum->erp_sp_id)
                    ->first();
                $data[$key]->product_image = $product->product_image;
                $data[$key]->company_user_id = $product->user_id;
                $data[$key]->product_price = $product->product_price;
                $data[$key]->company = $product->company;
                $data[$key]->company_logo = $product->company_logo;
                $data[$key]->review_profile = $product->review_profile;
                $data[$key]->provinces = $product->provinces;
                $data[$key]->amphures = $product->amphures;
                $data[$key]->districts = $product->districts;

                // GET Serial Number (API => ช่างติดตั้ง)
                $serial = "-";
                $data[$key]->serial = $serial;


                //service

                $service = ErpService::where('erp_po_id', $datum->id)->orderBy('id', 'desc')->first();
                if ($service != null) {
                    $data[$key]->service = true;
                    $data[$key]->erp_s_id = $service->id;
                    $data[$key]->erp_po_id = $service->erp_po_id;
                    $data[$key]->erp_service = $service->erp_service;
                    $data[$key]->erp_s_type = $service->erp_s_type;
                    $data[$key]->erp_s_status = $service->erp_s_status;
                    $data[$key]->erp_s_details = $service->erp_s_details;
                    $data[$key]->erp_s_date = date('d/m/Y H:i:s', strtotime($service->erp_s_date));
                    $data[$key]->erp_s_date_setup = ($service->erp_s_date_setup != null) ? date('d/m/Y d/m/Y H:i:s', strtotime($service->erp_s_date)) : null;
                    $data[$key]->erp_s_price = $service->erp_s_price;
                    $data[$key]->service_user_id = $service->service_user_id;
                    $services = ErpService::where('erp_po_id', '=', $datum->id)
                        ->whereIn('erp_s_status', [3, 4, 5])
                        ->orderBy('id', 'desc')
                        ->get();
                    $data[$key]->services = $services;
                } else {
                    $data[$key]->erp_s_type = null;
                    $data[$key]->service = false;
                    $data[$key]->erp_s_price = null;
                    $data[$key]->services = [];
                }
            }
        }
        $response = [
            'msg' => 'success',
            'product' => $data,
        ];
        return response($response, 200);
    }

    public function getPreOrderAriListInstallId($user_id, $id)
    {
        $data = ErpPreOrder::where('user_id', $user_id)
            ->where('erp_pre_status_payment', 2)
            ->where('erp_pre_status_install', 4)
            ->where('id', $id)
            ->get();
        if (count($data) > 0) {
            foreach ($data as $key => $datum) {
                $product = ErpStoreProduct::join('profiles', 'erp_store_products.user_id', '=', 'profiles.user_id')
                    ->select('erp_store_products.product_image', 'erp_store_products.user_id', 'erp_store_products.product_price',
                        'profiles.company', 'profiles.company_logo', 'profiles.review_profile'
                        , 'profiles.provinces_id', 'profiles.amphures_id', 'profiles.districts_id',
                        DB::raw("case when profiles.provinces_id != '' then (select provinces.PROVINCE_NAME from provinces where PROVINCE_ID = profiles.provinces_id) else '' end as provinces"),
                        DB::raw("case when profiles.amphures_id != '' then (select amphures.AMPHUR_NAME from amphures where amphures_id = profiles.amphures_id) else '' end as amphures"),
                        DB::raw("case when profiles.districts_id != '' then (select districts.DISTRICT_NAME from districts where districts_id = profiles.districts_id) else '' end as districts")
                    )
                    ->where('erp_store_products.id', '=', $datum->erp_sp_id)
                    ->first();
                $data[$key]->product_image = $product->product_image;
                $data[$key]->company_user_id = $product->user_id;
                $data[$key]->product_price = $product->product_price;
                $data[$key]->company = $product->company;
                $data[$key]->company_logo = $product->company_logo;
                $data[$key]->review_profile = $product->review_profile;
                $data[$key]->provinces = $product->provinces;
                $data[$key]->amphures = $product->amphures;
                $data[$key]->districts = $product->districts;

                // GET Serial Number (API => ช่างติดตั้ง)
                $serial = "-";
                $data[$key]->serial = $serial;


                //service

                $service = ErpService::where('erp_po_id', $datum->id)->orderBy('id', 'desc')->first();
                if ($service != null) {
                    $data[$key]->service = true;
                    $data[$key]->erp_s_id = $service->id;
                    $data[$key]->erp_po_id = $service->erp_po_id;
                    $data[$key]->erp_service = $service->erp_service;
                    $data[$key]->erp_s_type = $service->erp_s_type;
                    $data[$key]->erp_s_status = $service->erp_s_status;
                    $data[$key]->erp_s_details = $service->erp_s_details;
                    $data[$key]->erp_s_date = date('d/m/Y H:i:s', strtotime($service->erp_s_date));
                    $data[$key]->erp_s_date_setup = ($service->erp_s_date_setup != null) ? date('d/m/Y d/m/Y H:i:s', strtotime($service->erp_s_date)) : null;
                    $data[$key]->erp_s_price = $service->erp_s_price;
                    $data[$key]->service_user_id = $service->service_user_id;
                    $services = ErpService::where('erp_po_id', '=', $datum->id)
                        ->whereIn('erp_s_status', [3, 4, 5])
                        ->orderBy('id', 'desc')
                        ->get();
                    $data[$key]->services = $services;
                } else {
                    $data[$key]->service = false;
                    $data[$key]->erp_s_price = null;
                }
            }
        }
        $response = [
            'msg' => 'success',
            'product' => $data,
        ];
        return response($response, 200);
    }

    // Order Product => Store
    public function getStorePreOrderAriList($user_id)
    {
        $data = ErpPreOrder::join('erp_store_products', 'erp_pre_orders.erp_sp_id', '=', 'erp_store_products.id')
            ->select('erp_store_products.user_id as sp_user_id', 'erp_store_products.product_price',
                'erp_store_products.product_name', 'erp_pre_orders.*')
            ->where('erp_store_products.user_id', $user_id)
            ->orderBy('id', 'desc')
            ->orderBy('erp_pre_orders.erp_pre_status_payment')
            ->get();
        $response = [
            'msg' => 'success',
            'product' => $data,
        ];
        return response($response, 200);
    }

    public function getStorePreOrderAriListInstallId($user_id, $id)
    {
        $data = ErpPreOrder::where('user_id', $user_id)
            ->where('id', $id)
            ->get();
        if (count($data) > 0) {
            foreach ($data as $key => $datum) {
                $product = ErpStoreProduct::join('profiles', 'erp_store_products.user_id', '=', 'profiles.user_id')
                    ->select('erp_store_products.product_image', 'erp_store_products.user_id', 'erp_store_products.product_price',
                        'profiles.company', 'profiles.company_logo', 'profiles.review_profile'
                        , 'profiles.provinces_id', 'profiles.amphures_id', 'profiles.districts_id',
                        'profiles.latitude', 'profiles.longitude', 'profiles.zoom',
                        DB::raw("case when profiles.provinces_id != '' then (select provinces.PROVINCE_NAME from provinces where PROVINCE_ID = profiles.provinces_id) else '' end as provinces"),
                        DB::raw("case when profiles.amphures_id != '' then (select amphures.AMPHUR_NAME from amphures where amphures_id = profiles.amphures_id) else '' end as amphures"),
                        DB::raw("case when profiles.districts_id != '' then (select districts.DISTRICT_NAME from districts where districts_id = profiles.districts_id) else '' end as districts")
                    )
                    ->where('erp_store_products.id', '=', $datum->erp_sp_id)
                    ->first();
                $data[$key]->product_image = $product->product_image;
                $data[$key]->company_user_id = $product->user_id;
                $data[$key]->product_price = $product->product_price;
                $data[$key]->company = $product->company;
                $data[$key]->company_logo = $product->company_logo;
                $data[$key]->review_profile = $product->review_profile;
                $data[$key]->provinces = $product->provinces;
                $data[$key]->amphures = $product->amphures;
                $data[$key]->districts = $product->districts;


                $profile = Profile::find($user_id);

                $data[$key]->latitude = $profile->latitude;
                $data[$key]->longitude = $profile->longitude;
                $data[$key]->zoom = $profile->zoom;

                // GET Serial Number (API => ช่างติดตั้ง)
                $serial = "-";
                $data[$key]->serial = $serial;


                //service

                $service = ErpService::where('erp_po_id', $datum->id)->orderBy('id', 'desc')->first();
                if ($service != null) {
                    $data[$key]->service = true;
                    $data[$key]->erp_s_id = $service->id;
                    $data[$key]->erp_po_id = $service->erp_po_id;
                    $data[$key]->erp_service = $service->erp_service;
                    $data[$key]->erp_s_type = $service->erp_s_type;
                    $data[$key]->erp_s_status = $service->erp_s_status;
                    $data[$key]->erp_s_details = $service->erp_s_details;
                    $data[$key]->erp_s_date = date('d/m/Y H:i:s', strtotime($service->erp_s_date));
                    $data[$key]->erp_s_date_setup = ($service->erp_s_date_setup != null) ? date('d/m/Y d/m/Y H:i:s', strtotime($service->erp_s_date)) : null;
                    $data[$key]->erp_s_price = $service->erp_s_price;
                    $data[$key]->service_user_id = $service->service_user_id;
                    $services = ErpService::where('erp_po_id', '=', $datum->id)
                        ->whereIn('erp_s_status', [3, 4, 5])
                        ->orderBy('id', 'desc')
                        ->get();
                    $data[$key]->services = $services;
                } else {
                    $data[$key]->service = false;
                    $data[$key]->erp_s_price = null;
                }
            }
        }
        $response = [
            'msg' => 'success',
            'product' => $data,
        ];
        return response($response, 200);
    }

    public function updateStoreOrder(Request $request, $id)
    {
        $now = new DateTime();
        $erpPreOrder = ErpPreOrder::find($id);
        if ($erpPreOrder != null) {
            if ($request->pre_status_payment == 2) {
                //ชำระแล้ว
                $erpPreOrder->erp_pre_status_install = 2;
            } else if ($request->pre_status_payment == 3) {
                //ยกเลิก
                $erpPreOrder->erp_pre_status_payment = 3;
            }
            $erpPreOrder->updated_at = $now;
            $erpPreOrder->update();
            $response = [
                'success' => true,
                'status' => 'success',
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'status' => 'fail',
            ];
            return response()->json($response, 404);
        }


    }

    // Order Product Install => Store
    public function getStorePoInstallAriList($user_id)
    {
        $data = ErpPreOrder::join('erp_store_products', 'erp_pre_orders.erp_sp_id', '=', 'erp_store_products.id')
            ->select('erp_store_products.user_id as sp_user_id', 'erp_store_products.product_price',
                'erp_store_products.product_name', 'erp_pre_orders.*')
            ->where('erp_store_products.user_id', $user_id)
            ->where('erp_pre_orders.erp_pre_status_payment', 2)
            ->whereIn('erp_pre_orders.erp_pre_status_install', [2, 3])
            ->orderBy('id', 'desc')
            ->orderBy('erp_pre_orders.erp_pre_status_payment')
            ->get();
        $response = [
            'msg' => 'success',
            'product' => $data,
        ];
        return response($response, 200);
    }

    // Order Product Service => Store
    public function getStorePoServiceAriList($user_id)
    {
        $data = ErpPreOrder::join('erp_store_products', 'erp_pre_orders.erp_sp_id', '=', 'erp_store_products.id')
            ->select('erp_store_products.user_id as sp_user_id', 'erp_store_products.product_price',
                'erp_store_products.product_name', 'erp_pre_orders.*')
            ->where('erp_store_products.user_id', $user_id)
            ->where('erp_pre_orders.erp_pre_status_payment', 2)
            ->whereIn('erp_pre_orders.erp_pre_status_install', [3, 4])
            ->orderBy('id', 'desc')
            ->orderBy('erp_pre_orders.erp_pre_status_payment')
            ->get();
        if (count($data) > 0) {
            foreach ($data as $key => $datum) {
                $product = ErpStoreProduct::join('profiles', 'erp_store_products.user_id', '=', 'profiles.user_id')
                    ->select('erp_store_products.product_image', 'erp_store_products.user_id', 'erp_store_products.product_price',
                        'profiles.company', 'profiles.company_logo', 'profiles.review_profile'
                        , 'profiles.provinces_id', 'profiles.amphures_id', 'profiles.districts_id',
                        DB::raw("case when profiles.provinces_id != '' then (select provinces.PROVINCE_NAME from provinces where PROVINCE_ID = profiles.provinces_id) else '' end as provinces"),
                        DB::raw("case when profiles.amphures_id != '' then (select amphures.AMPHUR_NAME from amphures where amphures_id = profiles.amphures_id) else '' end as amphures"),
                        DB::raw("case when profiles.districts_id != '' then (select districts.DISTRICT_NAME from districts where districts_id = profiles.districts_id) else '' end as districts")
                    )
                    ->where('erp_store_products.id', '=', $datum->erp_sp_id)
                    ->first();
                $data[$key]->product_image = $product->product_image;
                $data[$key]->company_user_id = $product->user_id;
                $data[$key]->product_price = $product->product_price;
                $data[$key]->company = $product->company;
                $data[$key]->company_logo = $product->company_logo;
                $data[$key]->review_profile = $product->review_profile;
                $data[$key]->provinces = $product->provinces;
                $data[$key]->amphures = $product->amphures;
                $data[$key]->districts = $product->districts;


                $profile = Profile::find($user_id);

                $data[$key]->latitude = $profile->latitude;
                $data[$key]->longitude = $profile->longitude;
                $data[$key]->zoom = $profile->zoom;

                // GET Serial Number (API => ช่างติดตั้ง)
                $serial = "-";
                $data[$key]->serial = $serial;


                //service
                $service = ErpService::where('erp_po_id', $datum->id)->orderBy('id', 'desc')->first();
                if ($service != null) {
                    $data[$key]->service = true;
                    $data[$key]->erp_s_id = $service->id;
                    $data[$key]->erp_po_id = $service->erp_po_id;
                    $data[$key]->erp_service = $service->erp_service;
                    $data[$key]->erp_s_type = $service->erp_s_type;
                    $data[$key]->erp_s_status = $service->erp_s_status;
                    $data[$key]->erp_s_details = $service->erp_s_details;
                    $data[$key]->erp_s_date = date('d/m/Y H:i:s', strtotime($service->erp_s_date));
                    $data[$key]->erp_s_date_setup = ($service->erp_s_date_setup != null) ? date('d/m/Y d/m/Y H:i:s', strtotime($service->erp_s_date)) : null;
                    $data[$key]->erp_s_price = $service->erp_s_price;
                    $data[$key]->service_user_id = $service->service_user_id;
                    $services = ErpService::where('erp_po_id', '=', $datum->id)
                        ->whereIn('erp_s_status', [3, 4, 5])
                        ->orderBy('id', 'desc')
                        ->get();
                    $data[$key]->services = $services;
                } else {
                    $data[$key]->service = false;
                    $data[$key]->erp_s_price = null;
                }
            }
        }


        $service = ErpService::join('erp_pre_orders', 'erp_services.erp_po_id', '=', 'erp_pre_orders.id')
            ->select('erp_pre_orders.erp_sp_brand', 'erp_pre_orders.erp_sp_series', 'erp_pre_orders.user_id as po_user_id',
                'erp_services.*')
            ->where('erp_services.service_user_id', $user_id)
            ->get();

        $response = [
            'msg' => 'success',
            'service' => $service,
        ];
        return response($response, 200);
    }

    public function updatePoService(Request $request, $id)
    {
        $now = new DateTime();
        $erpService = ErpService::find($request->s_id);
        if ($erpService != null) {

            if ($request->s_status == 2) {
                $erpService->erp_s_status = $request->s_status;
                $erpService->erp_s_price = $request->s_price;
                $erpService->erp_s_date_setup = $request->s_date_setup;

            } elseif ($request->s_status == 5) {
                $erpService->erp_s_status = $request->s_status;
            }
            $erpService->updated_at = $now;
            $erpService->update();
            $response = [
                'success' => true,
                'status' => 'success',
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'status' => 'fail',
            ];
            return response()->json($response, 404);
        }
    }

    // Order Product BTU Price Setup => Store
    public function getPriceSetup($type_id)
    {
        $data = DB::table('air_price_setup')
            ->join('air_btu','air_price_setup.air_btu_id','=','air_btu.id')
            ->select('air_price_setup.*','air_btu.air_btu_detail')
            ->where('deleted_at','=',0)
            ->where('air_type_id','=',$type_id)
            ->get();
        foreach ($data as $k => $v){
            $msg = '';
            if($v->ps_year != null){
                $msg .= $v->ps_year." ปี " ;
            }
            if($v->ps_month != null){
                $msg .= $v->ps_month." เดือน" ;
            }
            $data[$k]->msg = $msg ;
        }
        return response()->json($data, 200);
    }

    public function getPriceSetupDetail($id)
    {
        $data = DB::table('air_price_setup')
            ->where('id','=',$id)
            ->first();
        return response()->json($data, 200);
    }

    public function storePriceSetup(Request $request)
    {
        $now = new DateTime();
        $erpPriceSetup = DB::table('air_price_setup')->insert([
            'air_type_id' => $request->get('air_type_id'),
            'air_btu_id' => $request->get('air_btu_id'),
            'ps_s_cost' => $request->get('ps_s_cost'),
            'ps_s_install_pipe' => $request->get('ps_s_install_pipe'),
            'ps_s_profit' => $request->get('ps_s_profit'),
            'ps_s_pipe_over' => $request->get('ps_s_pipe_over'),
            'ps_p_cost' => $request->get('ps_p_cost'),
            'ps_p_install' => $request->get('ps_p_install'),
            'ps_p_profit' => $request->get('ps_p_profit'),
            'ps_p_pipe_over' => $request->get('ps_p_pipe_over'),
            'ps_year' => $request->get('ps_year'),
            'ps_month' => $request->get('ps_month'),
            'user_id' => $request->get('auth_id'),
            'created_at' => $now,
            'updated_at' => null,
        ]);
        if ($erpPriceSetup) {
            $response = [
                'success' => true,
                'status' => 'success',
                'request_data' => $request->all(),
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'status' => 'fail',
            ];
            return response()->json($response, 404);
        }
    }

    public function updatePriceSetup(Request $request, $id)
    {
        $now = new DateTime();
        $erpPriceSetup = DB::table('air_price_setup')->where('id', '=', $id)
            ->update([
                'air_btu_id' => $request->get('air_btu_id'),
                'ps_s_cost' => $request->get('ps_s_cost'),
                'ps_s_install_pipe' => $request->get('ps_s_install_pipe'),
                'ps_s_profit' => $request->get('ps_s_profit'),
                'ps_s_pipe_over' => $request->get('ps_s_pipe_over'),
                'ps_p_cost' => $request->get('ps_p_cost'),
                'ps_p_install' => $request->get('ps_p_install'),
                'ps_p_profit' => $request->get('ps_p_profit'),
                'ps_p_pipe_over' => $request->get('ps_p_pipe_over'),
                'ps_year' => $request->get('ps_year'),
                'ps_month' => $request->get('ps_month'),
                'user_id' => $request->get('user_id'),
                'updated_at' => $now,
            ]);
        if ($erpPriceSetup) {
            $response = [
                'success' => true,
                'status' => 'success',
                'request_data' => $request->all(),
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'status' => 'fail',
            ];
            return response()->json($response, 404);
        }
    }

    public function deletePriceSetup($id)
    {
        DB::table('air_price_setup')
            ->where('id','=',$id)
            ->update(['deleted_at' => 1]);
        $response = [
            'success' => 'success',
            'status' => 'fail',
        ];
        return response()->json($response, 200);
    }

    // Order Add Data Product  => Store
    public function getAirBrand($type_id)
    {
        # 1) type => 1:room air , 2: Sky Air , 3:Package , 4:VRV
        $air_data = DB::table('air_data')
            ->join('brands','air_data.brand_id','=','brands.id')
            ->select('brands.id','brands.name')
            ->where('air_data.air_type_id','=',$type_id)
            ->where('air_data.deleted_at','=',0)
            ->groupBy('brand_id')
            ->get();
        $response = [
            'success' => 'success',
            'air_brand' => $air_data,
        ];
        return response()->json($response, 200);
    }

    public function getDataAir($type_id , $brand_id)
    {
        # 2) Get Brand and where search air_price_setup data group by air_btu_id
        $air_price_setup = DB::table('air_price_setup')
            ->select('air_btu_id')
            ->where('air_type_id','=',$type_id)
            ->where('deleted_at','=',0)
            ->groupBy('air_btu_id')
            ->get();
        $arr_id = [];
        for ($i = 0 ; $i < count($air_price_setup);$i++){
            $arr_id[] = $air_price_setup[$i]->air_btu_id;
        }
        # 3) GET Data Air
        if(count($arr_id) > 0){
            $air_data2 = DB::table('erp_product_air')->groupBy('air_data_id')->get();
            $arr_id2 = [];
            for ($i = 0 ; $i < count($air_data2);$i++){
                $arr_id2[] = $air_data2[$i]->air_data_id;
            }
            if(count($arr_id2) > 0){
                $air_data = DB::table('air_data')
                    ->join('air_btu','air_data.air_btu_id','=','air_btu.id')
                    ->join('air_group','air_data.air_group_id','=','air_group.id')
                    ->join('air_price_setup','air_btu.id','=','air_price_setup.air_btu_id')
                    ->join('brands','air_data.brand_id','=','brands.id')
                    ->select('air_data.*','air_group.air_group_details','air_data.air_btu_id' ,
                        'air_btu.air_btu_detail','air_price_setup.air_btu_id as ps_btu_id','air_price_setup.id as ps_id',
                        'air_price_setup.ps_s_cost','air_price_setup.ps_s_install_pipe',
                        'air_price_setup.ps_s_profit','air_price_setup.ps_s_pipe_over',
                        'air_price_setup.ps_p_cost','air_price_setup.ps_p_install',
                        'air_price_setup.ps_p_profit','air_price_setup.ps_p_pipe_over',
                        'air_price_setup.ps_year','air_price_setup.ps_month',
                        'brands.name')
                    ->where('air_data.air_type_id','=',$type_id)
                    ->where('air_data.brand_id','=',$brand_id)
                    ->where('air_data.deleted_at','=',0)
                    ->where('air_price_setup.air_type_id','=',$type_id)
                    ->where('air_price_setup.deleted_at','=',0)
                    ->whereIn('air_data.air_btu_id',$arr_id)
                    ->whereNotIn('air_data.id',$arr_id2)
                    ->get();
            }else{
                $air_data = DB::table('air_data')
                    ->join('air_btu','air_data.air_btu_id','=','air_btu.id')
                    ->join('air_group','air_data.air_group_id','=','air_group.id')
                    ->join('air_price_setup','air_btu.id','=','air_price_setup.air_btu_id')
                    ->join('brands','air_data.brand_id','=','brands.id')
                    ->select('air_data.*','air_group.air_group_details','air_data.air_btu_id' ,
                        'air_btu.air_btu_detail','air_price_setup.air_btu_id as ps_btu_id','air_price_setup.id as ps_id',
                        'air_price_setup.ps_s_cost','air_price_setup.ps_s_install_pipe',
                        'air_price_setup.ps_s_profit','air_price_setup.ps_s_pipe_over',
                        'air_price_setup.ps_p_cost','air_price_setup.ps_p_install',
                        'air_price_setup.ps_p_profit','air_price_setup.ps_p_pipe_over',
                        'air_price_setup.ps_year','air_price_setup.ps_month',
                        'brands.name')
                    ->where('air_data.air_type_id','=',$type_id)
                    ->where('air_data.brand_id','=',$brand_id)
                    ->where('air_data.deleted_at','=',0)
                    ->where('air_price_setup.air_type_id','=',$type_id)
                    ->where('air_price_setup.deleted_at','=',0)
                    ->whereIn('air_data.air_btu_id',$arr_id)
                    ->get();
            }

            foreach ($air_data as $k => $v){
                $msg = '';
                if($v->ps_year != null){
                    $msg .= $v->ps_year." ปี " ;
                }
                if($v->ps_month != null){
                    $msg .= $v->ps_month." เดือน" ;
                }
                $air_data[$k]->msg = $msg ;
            }
        }else{
            $air_data = [
                'data' => "ไม่มีข้อมูล"
            ];
        }
        $response = [
            'success' => 'success',
            'arr_id2' => $arr_id2,
            'air_price_setup' => $air_price_setup,
            'count' => count($air_data),
            'air_data' => $air_data,
        ];
        return response()->json($response, 200);
    }

    public function getDataAirShow($id)
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

    public function storeDataAirProduct(Request $request)
    {
        $now = new DateTime();

        # 3) GET Data Air
        $air_data = DB::table('air_data')
            ->join('air_btu','air_data.air_btu_id','=','air_btu.id')
            ->join('air_group','air_data.air_group_id','=','air_group.id')
            ->join('air_price_setup','air_btu.id','=','air_price_setup.air_btu_id')
            ->join('brands','air_data.brand_id','=','brands.id')
            ->select('air_data.*','air_group.air_group_details','air_data.air_btu_id' ,
                'air_btu.air_btu_detail','air_price_setup.air_btu_id as ps_btu_id','air_price_setup.id as ps_id',
                'air_price_setup.ps_s_cost','air_price_setup.ps_s_install_pipe',
                'air_price_setup.ps_s_profit','air_price_setup.ps_s_pipe_over',
                'air_price_setup.ps_p_cost','air_price_setup.ps_p_install',
                'air_price_setup.ps_p_profit','air_price_setup.ps_p_pipe_over',
                'air_price_setup.ps_year','air_price_setup.ps_month',
                'brands.name')
            ->where('air_data.id','=',$request->get('air_data_id'))
            ->where('air_data.deleted_at','=',0)
            ->where('air_price_setup.deleted_at','=',0)
            ->first();
        $msg = '';
        if($air_data->ps_year != null){
            $msg .= $air_data->ps_year." ปี " ;
        }
        if($air_data->ps_month != null){
            $msg .= $air_data->ps_month." เดือน" ;
        }

        $erp_pa = DB::table('erp_product_air')->insert([
            'pa_name' => $request->get('pa_name') ,
            'pa_detail' => $request->get('pa_detail') ,
            'pa_stock' => $request->get('pa_stock') ,
            'air_data_id' => $air_data->id ,
            'air_type_id' => $air_data->air_type_id ,
            'air_type_name' => $air_data->air_type_name ,
            'air_brand_id' => $air_data->brand_id ,
            'air_brand_name' => $air_data->name ,
            'air_group_id' => $air_data->air_group_id ,
            'air_group_details' => $air_data->air_group_details ,
            'air_model_indoor' => $air_data->air_model_indoor ,
            'air_model_outdoor' => $air_data->air_model_outdoor ,
            'air_btu_id' => $air_data->air_btu_id ,
            'air_btu_detail' => $air_data->air_btu_detail ,
            'air_price_list' => $air_data->air_price_list ,
            'pa_discount' => $request->get('pa_discount') ,
            'pa_sale_price' => $request->get('pa_sale_price') ,
            'pa_price_cost' => $request->get('pa_price_cost') ,
            'pa_sale_discount' => $request->get('pa_sale_discount') ,
            'pa_profit_machine' => $request->get('pa_profit_machine') ,
            'pa_profit_percect' => $request->get('pa_profit_percect') ,
            'ps_id' => $air_data->ps_id ,
            'ps_s_cost' => $air_data->ps_s_cost ,
            'ps_s_install_pipe' => $air_data->ps_s_install_pipe ,
            'ps_s_profit' => $air_data->ps_s_profit ,
            'ps_s_pipe_over' => $air_data->ps_s_pipe_over ,
            'pa_sum_s_install' => $request->get('pa_sum_s_install') ,
            'pa_s_vat' => $request->get('pa_s_vat') ,
            'pa_sum_s_vat_price' => $request->get('pa_sum_s_vat_price') ,
            'ps_p_cost' => $air_data->ps_p_cost ,
            'ps_p_install' => $air_data->ps_p_install ,
            'ps_p_profit' => $air_data->ps_p_profit ,
            'ps_p_pipe_over' => $air_data->ps_p_pipe_over ,
            'pa_sum_p_install' => $request->get('pa_sum_p_install') ,
            'pa_p_vat' => $request->get('pa_p_vat') ,
            'pa_sum_p_vat_price' => $request->get('pa_sum_p_vat_price') ,
            'pa_tool_1' => ($request->get('pa_tool_1')==null)?0:$request->get('pa_tool_1') ,
            'pa_tool_2' => ($request->get('pa_tool_2')==null)?0:$request->get('pa_tool_2') ,
            'pa_tool_3' => ($request->get('pa_tool_3')==null)?0:$request->get('pa_tool_3') ,
            'pa_tool_4' => ($request->get('pa_tool_4')==null)?0:$request->get('pa_tool_4') ,
            'pa_tool_5' => ($request->get('pa_tool_5')==null)?0:$request->get('pa_tool_5') ,
            'pa_image' => $air_data->air_image ,
            'ps_year' => $air_data->ps_year ,
            'ps_month' => $air_data->ps_month ,
            'pa_fullname_insurance' => $msg ,
            'user_id' => $request->get('user_id') ,
            'pa_sale_out' => 0 ,
            'created_at' => $now ,
            'updated_at' => null ,
            'deleted_at' => null ,
        ]);
        $response = [
            'success' => 'success',
            'erp_pa' => $erp_pa,
        ];
        return response()->json($response, 200);
    }
}
