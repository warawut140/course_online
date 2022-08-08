<?php

namespace App\Http\Controllers\Api;

use App\Models\Brands;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DropdownController extends Controller
{

    public function countNotification()
    {
        $user_id = $_REQUEST['user_id'];
        $notifications = DB::table('notifications')->where('user_id_send','=',$user_id)
            ->where('isActive','=',0)
            ->count('user_id_send');
        $html = '<button type="button" class="btn btn-sm btn-warning"  data-toggle="modal" data-target="#noti">
                  <i class="fas fa-bell"></i> <span class="badge badge-light" >'.$notifications.'</span>
                  </button>';
        return $html ;
//        return response($notifications);
    }

    public function notification()
    {
        $user_id = $_REQUEST['user_id'];
        $notifications = DB::table('notifications')->where('user_id_send','=',$user_id)
            ->where('isActive','=',0)
            ->get();

        foreach ($notifications as $key => $row) {
            $notifications[$key]->date = date('d/m/Y',strtotime($row->created_at));
        }


//        $html = '';
//        foreach ($notifications AS $row) {
//            $html .= '<div class="card mb-2">
//                          <div class="row no-gutters">
//                              <div class="col-md-7">
//                                  <div class="card-body p-2">
//                                      <p class="card-text">'.$row->detail.'</p>
//                                  </div>
//                              </div>
//                              <div class="col-md-3">
//                                  <div class="card-body p-2">
//                                      <a href="'.$row->path.'" class="btn btn-sm btn-outline-success">'.$row->btn_name.'</button>
//                                  </div>
//                              </div>
//                              <div class="col-md-2">
//                                  <div class="card-body p-2">
//                                      <p class="card-text"><small class="text-muted">'. date('d/m/Y',strtotime($row->created_at)) .'</small></p>
//                                  </div>
//                              </div>
//                          </div>
//                      </div>';
//        }
//        return $html;

        return response()->json($notifications);
    }

    public function getBrand()
    {
        $brand = Brands::all();
//        $brand = Brands::whereNotIn('id', [6])->get();
        return response()->json($brand);
    }

    // 1. InstallMachine
    public function condensingUnit($id)
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
            ->where('air_conditionings.brand_id', '=', $id)
            ->get();


        if(sizeof($material) != 0){
            foreach ($material as $value){
                $value->count =  '' ;
                $value->qty =  '' ;
                $value->materail_unitCost =  '' ;
                $value->materail_unitTotal =  '' ;
                $value->labour_unitCost =  '' ;
                $value->labour_unitTotal =  '' ;
                $value->totalCost =  '' ;
                $value->materail_unitCost_invest =  '' ;
                $value->materail_unitTotal_invest =  '' ;
                $value->labour_unitCost_invest =  '' ;
                $value->labour_unitTotal_invest =  '' ;
                $value->totalCost_invest =  '' ;
                $value->totalCost_all =  '' ;
                $value->a =  '' ;
                $value->b =  '' ;
                $value->c =  '' ;
                $value->d =  '' ;
                $value->f =  '' ;
                $value->g =  '' ;
            }
        }



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
            ->where('air_conditionings.brand_id', '=', $id)
            ->get();
        $data = [
            0 => [
                'ac_name' => 'ไม่มีข้อมูล'
            ]

        ];

        if(sizeof($labour) != 0){
            foreach ($labour as $value){
                $value->count =  '' ;
                $value->qty =  '' ;
                $value->materail_unitCost =  '' ;
                $value->materail_unitTotal =  '' ;
                $value->labour_unitCost =  '' ;
                $value->labour_unitTotal =  '' ;
                $value->totalCost =  '' ;
                $value->materail_unitCost_invest =  '' ;
                $value->materail_unitTotal_invest =  '' ;
                $value->labour_unitCost_invest =  '' ;
                $value->labour_unitTotal_invest =  '' ;
                $value->totalCost_invest =  '' ;
                $value->totalCost_all =  '' ;
                $value->a =  '' ;
                $value->b =  '' ;
                $value->c =  '' ;
                $value->d =  '' ;
                $value->f =  '' ;
                $value->g =  '' ;
            }
        }



        return response()->json([
            'method' => 'condensingUnit',
//            'material' => (empty($material)) ? $data : $material,
            'material' => (sizeof($material) == 0) ? $data : $material,
//            'labour' => (empty($labour)) ? $data : $labour,
            'labour' => (sizeof($labour) == 0) ? $data : $labour,
        ]);
    }

    //##### Fancoil Unit #####
    public function wallMount($id)
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
            ->where('air_conditionings.brand_id', '=', $id)
            ->get();

        if(sizeof($material) != 0){
            foreach ($material as $value){
                $value->count =  '' ;
                $value->qty =  '' ;
                $value->materail_unitCost =  '' ;
                $value->materail_unitTotal =  '' ;
                $value->labour_unitCost =  '' ;
                $value->labour_unitTotal =  '' ;
                $value->totalCost =  '' ;
                $value->materail_unitCost_invest =  '' ;
                $value->materail_unitTotal_invest =  '' ;
                $value->labour_unitCost_invest =  '' ;
                $value->labour_unitTotal_invest =  '' ;
                $value->totalCost_invest =  '' ;
                $value->totalCost_all =  '' ;
                $value->a =  '' ;
                $value->b =  '' ;
                $value->c =  '' ;
                $value->d =  '' ;
                $value->f =  '' ;
                $value->g =  '' ;
            }
        }

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
            ->where('air_conditionings.brand_id', '=', $id)
            ->get();

        if(sizeof($labour) != 0){
            foreach ($labour as $value){
                $value->count =  '' ;
                $value->qty =  '' ;
                $value->materail_unitCost =  '' ;
                $value->materail_unitTotal =  '' ;
                $value->labour_unitCost =  '' ;
                $value->labour_unitTotal =  '' ;
                $value->totalCost =  '' ;
                $value->materail_unitCost_invest =  '' ;
                $value->materail_unitTotal_invest =  '' ;
                $value->labour_unitCost_invest =  '' ;
                $value->labour_unitTotal_invest =  '' ;
                $value->totalCost_invest =  '' ;
                $value->totalCost_all =  '' ;
                $value->a =  '' ;
                $value->b =  '' ;
                $value->c =  '' ;
                $value->d =  '' ;
                $value->f =  '' ;
                $value->g =  '' ;
            }
        }
        $data = [
            0 => [
                'ac_name' => 'ไม่มีข้อมูล'
            ]
        ];
        return response()->json([
            'method' => 'wallMount',
            'material' => (sizeof($material) == 0) ? $data : $material,
            'labour' => (sizeof($labour) == 0) ? $data : $labour,
        ]);
    }

    public function ceilingSuspended($id)
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
            ->where('air_conditionings.brand_id', '=', $id)
            ->get();
        if(sizeof($material) != 0){
            foreach ($material as $value){
                $value->count =  '' ;
                $value->qty =  '' ;
                $value->materail_unitCost =  '' ;
                $value->materail_unitTotal =  '' ;
                $value->labour_unitCost =  '' ;
                $value->labour_unitTotal =  '' ;
                $value->totalCost =  '' ;
                $value->materail_unitCost_invest =  '' ;
                $value->materail_unitTotal_invest =  '' ;
                $value->labour_unitCost_invest =  '' ;
                $value->labour_unitTotal_invest =  '' ;
                $value->totalCost_invest =  '' ;
                $value->totalCost_all =  '' ;
                $value->a =  '' ;
                $value->b =  '' ;
                $value->c =  '' ;
                $value->d =  '' ;
                $value->f =  '' ;
                $value->g =  '' ;
            }
        }
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
            ->where('air_conditionings.brand_id', '=', $id)
            ->get();
        if(sizeof($labour) != 0){
            foreach ($labour as $value){
                $value->count =  '' ;
                $value->qty =  '' ;
                $value->materail_unitCost =  '' ;
                $value->materail_unitTotal =  '' ;
                $value->labour_unitCost =  '' ;
                $value->labour_unitTotal =  '' ;
                $value->totalCost =  '' ;
                $value->materail_unitCost_invest =  '' ;
                $value->materail_unitTotal_invest =  '' ;
                $value->labour_unitCost_invest =  '' ;
                $value->labour_unitTotal_invest =  '' ;
                $value->totalCost_invest =  '' ;
                $value->totalCost_all =  '' ;
                $value->a =  '' ;
                $value->b =  '' ;
                $value->c =  '' ;
                $value->d =  '' ;
                $value->f =  '' ;
                $value->g =  '' ;
            }
        }
        $data = [
            0 => [
                'ac_name' => 'ไม่มีข้อมูล'
            ]
        ];
        return response()->json([
            'method' => 'wallMount',
            'material' => (sizeof($material) == 0) ? $data : $material,
            'labour' => (sizeof($labour) == 0) ? $data : $labour,
        ]);
    }

    public function ceilingMountedDuct($id)
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
            ->where('air_conditionings.brand_id', '=', $id)
            ->get();
        if(sizeof($material) != 0){
            foreach ($material as $value){
                $value->count =  '' ;
                $value->qty =  '' ;
                $value->materail_unitCost =  '' ;
                $value->materail_unitTotal =  '' ;
                $value->labour_unitCost =  '' ;
                $value->labour_unitTotal =  '' ;
                $value->totalCost =  '' ;
                $value->materail_unitCost_invest =  '' ;
                $value->materail_unitTotal_invest =  '' ;
                $value->labour_unitCost_invest =  '' ;
                $value->labour_unitTotal_invest =  '' ;
                $value->totalCost_invest =  '' ;
                $value->totalCost_all =  '' ;
                $value->a =  '' ;
                $value->b =  '' ;
                $value->c =  '' ;
                $value->d =  '' ;
                $value->f =  '' ;
                $value->g =  '' ;
            }
        }
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
            ->where('air_conditionings.brand_id', '=', $id)
            ->get();
        if(sizeof($labour) != 0){
            foreach ($labour as $value){
                $value->count =  '' ;
                $value->qty =  '' ;
                $value->materail_unitCost =  '' ;
                $value->materail_unitTotal =  '' ;
                $value->labour_unitCost =  '' ;
                $value->labour_unitTotal =  '' ;
                $value->totalCost =  '' ;
                $value->materail_unitCost_invest =  '' ;
                $value->materail_unitTotal_invest =  '' ;
                $value->labour_unitCost_invest =  '' ;
                $value->labour_unitTotal_invest =  '' ;
                $value->totalCost_invest =  '' ;
                $value->totalCost_all =  '' ;
                $value->a =  '' ;
                $value->b =  '' ;
                $value->c =  '' ;
                $value->d =  '' ;
                $value->f =  '' ;
                $value->g =  '' ;
            }
        }
        $data = [
            0 => [
                'ac_name' => 'ไม่มีข้อมูล'
            ]
        ];
        return response()->json([
            'method' => 'wallMount',
            'material' => (sizeof($material) == 0) ? $data : $material,
            'labour' => (sizeof($labour) == 0) ? $data : $labour,
        ]);
    }

    public function ceilingMountedCassette($id)
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
            ->where('air_conditionings.brand_id', '=', $id)
            ->get();
        if(sizeof($material) != 0){
            foreach ($material as $value){
                $value->count =  '' ;
                $value->qty =  '' ;
                $value->materail_unitCost =  '' ;
                $value->materail_unitTotal =  '' ;
                $value->labour_unitCost =  '' ;
                $value->labour_unitTotal =  '' ;
                $value->totalCost =  '' ;
                $value->materail_unitCost_invest =  '' ;
                $value->materail_unitTotal_invest =  '' ;
                $value->labour_unitCost_invest =  '' ;
                $value->labour_unitTotal_invest =  '' ;
                $value->totalCost_invest =  '' ;
                $value->totalCost_all =  '' ;
                $value->a =  '' ;
                $value->b =  '' ;
                $value->c =  '' ;
                $value->d =  '' ;
                $value->f =  '' ;
                $value->g =  '' ;
            }
        }
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
            ->where('air_conditionings.brand_id', '=', $id)
            ->get();
        if(sizeof($labour) != 0){
            foreach ($labour as $value){
                $value->count =  '' ;
                $value->qty =  '' ;
                $value->materail_unitCost =  '' ;
                $value->materail_unitTotal =  '' ;
                $value->labour_unitCost =  '' ;
                $value->labour_unitTotal =  '' ;
                $value->totalCost =  '' ;
                $value->materail_unitCost_invest =  '' ;
                $value->materail_unitTotal_invest =  '' ;
                $value->labour_unitCost_invest =  '' ;
                $value->labour_unitTotal_invest =  '' ;
                $value->totalCost_invest =  '' ;
                $value->totalCost_all =  '' ;
                $value->a =  '' ;
                $value->b =  '' ;
                $value->c =  '' ;
                $value->d =  '' ;
                $value->f =  '' ;
                $value->g =  '' ;
            }
        }
        $data = [
            0 => [
                'ac_name' => 'ไม่มีข้อมูล'
            ]
        ];
        return response()->json([
            'method' => 'wallMount',
            'material' => (sizeof($material) == 0) ? $data : $material,
            'labour' => (sizeof($labour) == 0) ? $data : $labour,
        ]);
    }

    public function floorMounted($id)
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
            ->where('air_conditionings.brand_id', '=', $id)
            ->get();
        if(sizeof($material) != 0){
            foreach ($material as $value){
                $value->count =  '' ;
                $value->qty =  '' ;
                $value->materail_unitCost =  '' ;
                $value->materail_unitTotal =  '' ;
                $value->labour_unitCost =  '' ;
                $value->labour_unitTotal =  '' ;
                $value->totalCost =  '' ;
                $value->materail_unitCost_invest =  '' ;
                $value->materail_unitTotal_invest =  '' ;
                $value->labour_unitCost_invest =  '' ;
                $value->labour_unitTotal_invest =  '' ;
                $value->totalCost_invest =  '' ;
                $value->totalCost_all =  '' ;
                $value->a =  '' ;
                $value->b =  '' ;
                $value->c =  '' ;
                $value->d =  '' ;
                $value->f =  '' ;
                $value->g =  '' ;
            }
        }
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
            ->where('air_conditionings.brand_id', '=', $id)
            ->get();
        if(sizeof($labour) != 0){
            foreach ($labour as $value){
                $value->count =  '' ;
                $value->qty =  '' ;
                $value->materail_unitCost =  '' ;
                $value->materail_unitTotal =  '' ;
                $value->labour_unitCost =  '' ;
                $value->labour_unitTotal =  '' ;
                $value->totalCost =  '' ;
                $value->materail_unitCost_invest =  '' ;
                $value->materail_unitTotal_invest =  '' ;
                $value->labour_unitCost_invest =  '' ;
                $value->labour_unitTotal_invest =  '' ;
                $value->totalCost_invest =  '' ;
                $value->totalCost_all =  '' ;
                $value->a =  '' ;
                $value->b =  '' ;
                $value->c =  '' ;
                $value->d =  '' ;
                $value->f =  '' ;
                $value->g =  '' ;
            }
        }
        $data = [
            0 => [
                'ac_name' => 'ไม่มีข้อมูล'
            ]
        ];
        return response()->json([
            'method' => 'wallMount',
            'material' => (sizeof($material) == 0) ? $data : $material,
            'labour' => (sizeof($labour) == 0) ? $data : $labour,
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
        if(sizeof($material) != 0){
            foreach ($material as $value){
                $value->count =  '' ;
                $value->qty =  '' ;
                $value->materail_unitCost =  '' ;
                $value->materail_unitTotal =  '' ;
                $value->labour_unitCost =  '' ;
                $value->labour_unitTotal =  '' ;
                $value->totalCost =  '' ;
                $value->materail_unitCost_invest =  '' ;
                $value->materail_unitTotal_invest =  '' ;
                $value->labour_unitCost_invest =  '' ;
                $value->labour_unitTotal_invest =  '' ;
                $value->totalCost_invest =  '' ;
                $value->totalCost_all =  '' ;
                $value->a =  '' ;
                $value->b =  '' ;
                $value->c =  '' ;
                $value->d =  '' ;
                $value->f =  '' ;
                $value->g =  '' ;
            }
        }
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
        if(sizeof($labour) != 0){
            foreach ($labour as $value){
                $value->count =  '' ;
                $value->qty =  '' ;
                $value->materail_unitCost =  '' ;
                $value->materail_unitTotal =  '' ;
                $value->labour_unitCost =  '' ;
                $value->labour_unitTotal =  '' ;
                $value->totalCost =  '' ;
                $value->materail_unitCost_invest =  '' ;
                $value->materail_unitTotal_invest =  '' ;
                $value->labour_unitCost_invest =  '' ;
                $value->labour_unitTotal_invest =  '' ;
                $value->totalCost_invest =  '' ;
                $value->totalCost_all =  '' ;
                $value->a =  '' ;
                $value->b =  '' ;
                $value->c =  '' ;
                $value->d =  '' ;
                $value->f =  '' ;
                $value->g =  '' ;
            }
        }
        $data = [
            0 => [
                'ac_name' => 'ไม่มีข้อมูล'
            ]
        ];
        return response()->json([
            'method' => 'wallMount',
            'material' => (sizeof($material) == 0) ? $data : $material,
            'labour' => (sizeof($labour) == 0) ? $data : $labour,
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
        if(sizeof($material) != 0){
            foreach ($material as $value){
                $value->count =  '' ;
                $value->qty =  '' ;
                $value->materail_unitCost =  '' ;
                $value->materail_unitTotal =  '' ;
                $value->labour_unitCost =  '' ;
                $value->labour_unitTotal =  '' ;
                $value->totalCost =  '' ;
                $value->materail_unitCost_invest =  '' ;
                $value->materail_unitTotal_invest =  '' ;
                $value->labour_unitCost_invest =  '' ;
                $value->labour_unitTotal_invest =  '' ;
                $value->totalCost_invest =  '' ;
                $value->totalCost_all =  '' ;
                $value->a =  '' ;
                $value->b =  '' ;
                $value->c =  '' ;
                $value->d =  '' ;
                $value->f =  '' ;
                $value->g =  '' ;
            }
        }
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
        if(sizeof($labour) != 0){
            foreach ($labour as $value){
                $value->count =  '' ;
                $value->qty =  '' ;
                $value->materail_unitCost =  '' ;
                $value->materail_unitTotal =  '' ;
                $value->labour_unitCost =  '' ;
                $value->labour_unitTotal =  '' ;
                $value->totalCost =  '' ;
                $value->materail_unitCost_invest =  '' ;
                $value->materail_unitTotal_invest =  '' ;
                $value->labour_unitCost_invest =  '' ;
                $value->labour_unitTotal_invest =  '' ;
                $value->totalCost_invest =  '' ;
                $value->totalCost_all =  '' ;
                $value->a =  '' ;
                $value->b =  '' ;
                $value->c =  '' ;
                $value->d =  '' ;
                $value->f =  '' ;
                $value->g =  '' ;
            }
        }
        $data = [
            0 => [
                'ac_name' => 'ไม่มีข้อมูล'
            ]
        ];
        return response()->json([
            'method' => 'wallMount',
            'material' => (sizeof($material) == 0) ? $data : $material,
            'labour' => (sizeof($labour) == 0) ? $data : $labour,
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
        if(sizeof($material) != 0){
            foreach ($material as $value){
                $value->count =  '' ;
                $value->qty =  '' ;
                $value->materail_unitCost =  '' ;
                $value->materail_unitTotal =  '' ;
                $value->labour_unitCost =  '' ;
                $value->labour_unitTotal =  '' ;
                $value->totalCost =  '' ;
                $value->materail_unitCost_invest =  '' ;
                $value->materail_unitTotal_invest =  '' ;
                $value->labour_unitCost_invest =  '' ;
                $value->labour_unitTotal_invest =  '' ;
                $value->totalCost_invest =  '' ;
                $value->totalCost_all =  '' ;
                $value->a =  '' ;
                $value->b =  '' ;
                $value->c =  '' ;
                $value->d =  '' ;
                $value->f =  '' ;
                $value->g =  '' ;
            }
        }
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
        if(sizeof($labour) != 0){
            foreach ($labour as $value){
                $value->count =  '' ;
                $value->qty =  '' ;
                $value->materail_unitCost =  '' ;
                $value->materail_unitTotal =  '' ;
                $value->labour_unitCost =  '' ;
                $value->labour_unitTotal =  '' ;
                $value->totalCost =  '' ;
                $value->materail_unitCost_invest =  '' ;
                $value->materail_unitTotal_invest =  '' ;
                $value->labour_unitCost_invest =  '' ;
                $value->labour_unitTotal_invest =  '' ;
                $value->totalCost_invest =  '' ;
                $value->totalCost_all =  '' ;
                $value->a =  '' ;
                $value->b =  '' ;
                $value->c =  '' ;
                $value->d =  '' ;
                $value->f =  '' ;
                $value->g =  '' ;
            }
        }
        $data = [
            0 => [
                'ac_name' => 'ไม่มีข้อมูล'
            ]
        ];
        return response()->json([
            'method' => 'wallMount',
            'material' => (sizeof($material) == 0) ? $data : $material,
            'labour' => (sizeof($labour) == 0) ? $data : $labour,
        ]);
    }


    // 2. Piping
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


    // 3. Control
    public function remote()
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
            ->where('air_conditionings.type_sub_work_id', '=', 20)
//            ->where('air_conditionings.standard_id', '=', '2')
            ->get();
        return response()->json([
            'method' => 'remote',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    public function wiring()
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
            ->where('air_conditionings.type_sub_work_id', '=', 21)
//            ->where('air_conditionings.standard_id', '=', '2')
            ->get();
        return response()->json([
            'method' => 'wiring',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    //CONDUIT => 22
    //12	EMT
    public function emt()
    {
        $data = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
//            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
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
//                'standards.name as s_name',
                'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id', 'type__subject__works_lists.name as wl_name')
            ->where('air_conditionings.type_sub_work_id', '=', 22)
            ->where('type__subject__works_lists.id', '=', 12)
            //            ->where('air_conditionings.standard_id', '=', '2')
            ->get();
        return response()->json([
            'method' => 'emt',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    //CONDUIT => 22
    //13	IMC
    public function imc()
    {
        $data = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
//            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
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
//                'standards.name as s_name',
                'air_conditionings.brand_id',
                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id', 'type__subject__works_lists.name as wl_name')
            ->where('air_conditionings.type_sub_work_id', '=', 22)
            ->where('type__subject__works_lists.id', '=', 13)
            //            ->where('air_conditionings.standard_id', '=', '2')
            ->get();
        return response()->json([
            'method' => 'emt',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    public function fittingAccessorries()
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
            ->where('air_conditionings.type_sub_work_id', '=', 23)
//            ->where('air_conditionings.standard_id', '=', '2')
            ->get();
        return response()->json([
            'method' => 'fittingAccessorries',
            'material' => $data,
            'labour' => $data,
        ]);
    }

    public function hangerSupports()
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
            ->where('air_conditionings.type_sub_work_id', '=', 24)
//            ->where('air_conditionings.standard_id', '=', '2')
            ->get();
        return response()->json([
            'method' => 'hangerSupports',
            'material' => $data,
            'labour' => $data,
        ]);
    }


    // 4. DuctPiping
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


    // 5. Main
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
    public function mehangerSupport()
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
