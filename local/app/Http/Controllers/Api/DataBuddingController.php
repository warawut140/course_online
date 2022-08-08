<?php

namespace App\Http\Controllers\Api;


use App\Models\Brands;
use App\Models\BuddingAir;
use App\Models\Profile;
use App\Models\ProjectAuction;
use App\Models\ProjectAuctionWork;
use App\Models\SubBuddingAir;
use App\Models\Type_Subject_Works;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;

class DataBuddingController extends Controller
{

    // Get Data Project Budding
    //##### Get Data Project Budding : Project Work  #####//
    public function projectWork(Request $request)
    {
        $projectAuctionWorks = ProjectAuctionWork::join('works', 'works.id', '=', 'project_auction_works.work_id')
            ->select('works.name as work_name', 'project_auction_works.project_id', 'project_auction_works.id')
            ->where('project_auction_works.project_id', '=', $request->get('project_auctions_id'))
            ->get();
        return response()->json([
            'request' => $request->all(),
            'work' => $projectAuctionWorks,
            'success' => 'success',
        ]);
    }

    public function getBrandGroupByAir(Request $request)
    {
        $sub_work_id = $request->get('sub_work_id');
        $arr = [];
        $list_data = DB::table('air_conditionings')
            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->select('air_conditionings.brand_id', 'brands.name')
            ->where('type_sub_work_id', '=', $sub_work_id)
            ->get();
        for ($i = 0; $i < count($list_data); $i++) {
            $arr[] = $list_data[$i]->brand_id;
        }
        $brand = Brands::whereIn('id', $arr)->get();
        return response()->json($brand);
    }

    public function typeSubjectWork(Request $request)
    {
        $typeSubjectWork = Type_Subject_Works::join('subject__works', 'type__subject__works.sub_work_id', '=', 'subject__works.id')
            ->select('subject__works.name as sub_name', 'type__subject__works.*')
            ->where('type__subject__works.sub_work_id', '=', $request->get('type'))
            ->whereNull('type__subject__works.id_sub')
            ->get();
        return response()->json([
            'typeSubjectWork' => $typeSubjectWork,
            'success' => 'success',
        ]);
    }

    public function getAirTypeSubjectWork(Request $request)
    {
        $data_air = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
//            ->join('standards', 'air_conditionings.standard_id', '=', 'standards.id')
//            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.price2', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
//                'air_conditionings.standard_id',
//                'standards.name as s_name',
                 'air_conditionings.brand_id',
//                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where(function ($query) use ($request) {
//                $query->where('air_conditionings.standard_id', '=', '1');
                if ($request->get('sub_work_id') != null) {
                    $query->where('air_conditionings.type_sub_work_id', '=', $request->get('sub_work_id'));
                }
//                if ($request->get('brand_id') != null) {
//                    $query->where('air_conditionings.brand_id', '=', $request->get('brand_id'));
//                }[
                $query->whereNull('air_conditionings.deleted_at');
            })
            ->get();
          foreach ($data_air as $key => $value){
              $data_air[$key]->standard_id = '' ;
              $data_air[$key]->s_name = '' ;
              if($value->brand_id != null || $value->brand_id != 0){
                 $brand = Brands::find($value->brand_id);
                  $data_air[$key]->b_name = $brand->name;
                  $data_air[$key]->filename = $brand->filename ;
              }else{
                  $data_air[$key]->b_name = '' ;
                  $data_air[$key]->filename = '-' ;
              }
          }

        if (sizeof($data_air) != 0) {
            foreach ($data_air as $value) {
                $value->qty = '';
                $value->materail_unitCost = '';
                $value->materail_unitTotal = '';
                $value->labour_unitCost = '';
                $value->labour_unitTotal = '';
                $value->totalCost = '';
            }
        }
        $data = [
            0 => [
                'ac_name' => 'ไม่มีข้อมูล'
            ]

        ];
        return response()->json([
            'method' => 'getAirTypeSubjectWork',
            'data_air' => (sizeof($data_air) == 0) ? $data : $data_air,
        ]);

    }

    public function getAirTypeSubjectWork2(Request $request)
    {
        $data_air = DB::table('air_conditionings')
            ->join('units', 'air_conditionings.unit_id', '=', 'units.id')
//            ->join('brands', 'air_conditionings.brand_id', '=', 'brands.id')
            ->join('type__subject__works', 'air_conditionings.type_sub_work_id', '=', 'type__subject__works.id')
            ->select('air_conditionings.id', 'air_conditionings.name as ac_name',
                'air_conditionings.price', 'air_conditionings.price2', 'air_conditionings.btu',
                'air_conditionings.model', 'air_conditionings.unit_id',
                'units.name as u_name',
                'air_conditionings.qty_material', 'air_conditionings.cost_material',
                'air_conditionings.qty_labour', 'air_conditionings.cost_labour',
                'air_conditionings.standard_id',
                'air_conditionings.brand_id',
//                'brands.name as b_name', 'brands.filename',
                'air_conditionings.type_sub_work_id', 'type__subject__works.name as w_name',
                'air_conditionings.type_sub_work_list_id')
            ->where(function ($query) use ($request) {
//                $arr = [];
//                if ($request->get('sub_work_id') != null) {
//                    $type_sub_work = DB::table('type__subject__works')
//                        ->join('subject__works', 'type__subject__works.sub_work_id', '=', 'subject__works.id')
//                        ->select('subject__works.name as sub_name', 'type__subject__works.*')
//                        ->where('type__subject__works.id_sub', '=', $request->get('sub_work_id'))
//                        ->get();
//                    if (count($type_sub_work) > 0) {
//                        array_push($arr, $request->get('sub_work_id'));
//                        for ($i = 0; $i < count($type_sub_work); $i++) {
//                            $arr[] = $type_sub_work[$i]->id;
//                        }
//                        $query->whereIn('air_conditionings.type_sub_work_id', $arr);
//                    } else {
//                        $query->where('air_conditionings.type_sub_work_id', '=', $request->get('sub_work_id'));
//                    }
//                }
//                if ($request->get('brand_id') != null) {
//                    $query->where('air_conditionings.brand_id', '=', $request->get('brand_id'));
//                }

                if ($request->get('sub_work_id') != null) {
                    $query->where('air_conditionings.type_sub_work_id', '=', $request->get('sub_work_id'));
                }
                $query->whereNull('air_conditionings.deleted_at');
            })
            ->get();

        $sql = DB::table('type__subject__works')
            ->join('subject__works', 'type__subject__works.sub_work_id', '=', 'subject__works.id')
            ->select('subject__works.name as sub_name', 'type__subject__works.*')
            ->where('type__subject__works.id_sub', '=', $request->get('sub_work_id'))
            ->toSql();
        foreach ($data_air as $key => $value){
            $data_air[$key]->standard_id = '' ;
            $data_air[$key]->s_name = '' ;
            if($value->brand_id != null || $value->brand_id != 0){
                $brand = Brands::find($value->brand_id);
                $data_air[$key]->b_name = $brand->name;
                $data_air[$key]->filename = $brand->filename ;
            }else{
                $data_air[$key]->b_name = '' ;
                $data_air[$key]->filename = '-' ;
            }
        }
        if (sizeof($data_air) != 0) {
            foreach ($data_air as $value) {
                $value->qty = '';
                $value->materail_unitCost = '';
                $value->materail_unitTotal = '';
                $value->labour_unitCost = '';
                $value->labour_unitTotal = '';
                $value->totalCost = '';
            }
        }
        $data = [
            0 => [
                'ac_name' => 'ไม่มีข้อมูล'
            ]

        ];
        return response()->json([
            'method' => 'getAirTypeSubjectWork2',
            'data_air' => (sizeof($data_air) == 0) ? $data : $data_air,
            'sql' => $sql
        ]);

    }

    public function insertBudding(Request $request)
    {
//        dd($request->all());
        $now = new DateTime();
        for ($i = 0; $i < count($request->get('budding')); $i++) {
            $budding = new BuddingAir();
            $budding->project_id = $request->get('project_id');
            $budding->type_work_sub = $request->get('type_work_sub');

            $budding->work_type_id = $request->get('budding')[$i]['sub_workTypeId'];
            $budding->work_type_name = $request->get('budding')[$i]['sub_workTypeName'];

            $budding->sub_work_id = $request->get('budding')[$i]['sub_work'];
            $budding->sub_work_name = $request->get('budding')[$i]['sub_nameWork'];

            $budding->sub_brand_id = $request->get('budding')[$i]['sub_brandId'];
            $budding->sub_brand_name = $request->get('budding')[$i]['sub_brandName'];
            $budding->totalAll_sub = $request->get('budding')[$i]['totalAll_sub'];

            $budding->user_id = $request->get('user_id');
            $budding->created_at = $now;
            $budding->updated_at = null;
            $budding->save();

            for ($j = 0; $j < count($request->get('budding')[$i]['sub_data']); $j++) {
                $subBudding = new  SubBuddingAir();
                $subBudding->budding_air_id = $budding->id;
                $subBudding->air_id = $request->get('budding')[$i]['sub_data'][$j]['id'];
                $subBudding->btu = $request->get('budding')[$i]['sub_data'][$j]['btu'];
                $subBudding->cost_labour = $request->get('budding')[$i]['sub_data'][$j]['cost_labour'];
                $subBudding->cost_material = $request->get('budding')[$i]['sub_data'][$j]['cost_material'];
                $subBudding->price = $request->get('budding')[$i]['sub_data'][$j]['price'];
                $subBudding->qty = $request->get('budding')[$i]['sub_data'][$j]['qty'];
                $subBudding->ac_name = $request->get('budding')[$i]['sub_data'][$j]['ac_name'];
                $subBudding->b_name = $request->get('budding')[$i]['sub_data'][$j]['b_name'];
                $subBudding->brand_id = $request->get('budding')[$i]['sub_data'][$j]['brand_id'];
                $subBudding->model = $request->get('budding')[$i]['sub_data'][$j]['models'];
                // Data Set Budding
                $subBudding->labour_unitCost = $request->get('budding')[$i]['sub_data'][$j]['labour_unitCost'];
                $subBudding->labour_unitTotal = $request->get('budding')[$i]['sub_data'][$j]['labour_unitTotal'];
                $subBudding->materail_unitCost = $request->get('budding')[$i]['sub_data'][$j]['materail_unitCost'];
                $subBudding->materail_unitTotal = $request->get('budding')[$i]['sub_data'][$j]['materail_unitTotal'];
                // Data Set Budding
                $subBudding->qty_labour = $request->get('budding')[$i]['sub_data'][$j]['qty_labour'];
                $subBudding->qty_material = $request->get('budding')[$i]['sub_data'][$j]['qty_material'];
                $subBudding->totalCost = $request->get('budding')[$i]['sub_data'][$j]['totalCost'];
                $subBudding->u_name = $request->get('budding')[$i]['sub_data'][$j]['u_name'];
                $subBudding->unit_id = $request->get('budding')[$i]['sub_data'][$j]['unit_id'];
                $subBudding->w_name = $request->get('budding')[$i]['sub_data'][$j]['w_name'];
                $subBudding->created_at = $now;
                $subBudding->updated_at = null;
                $subBudding->save();
            }
        }

        if ($request->get('type_work_sub') == 1) {
            DB::table('project_auctions_air')
                ->where('project_id', '=', $request->get('project_id'))
                ->where('user_id', '=', $request->get('user_id'))
                ->update([
                    'status_machine' => 2,
                    'updated_at' => $now
                ]);
        } elseif ($request->get('type_work_sub') == 2) {
            DB::table('project_auctions_air')
                ->where('project_id', '=', $request->get('project_id'))
                ->where('user_id', '=', $request->get('user_id'))
                ->update([
                    'status_piping' => 2,
                    'updated_at' => $now
                ]);
        } elseif ($request->get('type_work_sub') == 3) {
            DB::table('project_auctions_air')
                ->where('project_id', '=', $request->get('project_id'))
                ->where('user_id', '=', $request->get('user_id'))
                ->update([
                    'status_control' => 2,
                    'updated_at' => $now
                ]);
        } elseif ($request->get('type_work_sub') == 4) {
            DB::table('project_auctions_air')
                ->where('project_id', '=', $request->get('project_id'))
                ->where('user_id', '=', $request->get('user_id'))
                ->update([
                    'status_duct' => 2,
                    'updated_at' => $now
                ]);
        } elseif ($request->get('type_work_sub') == 5) {
            DB::table('project_auctions_air')
                ->where('project_id', '=', $request->get('project_id'))
                ->where('user_id', '=', $request->get('user_id'))
                ->update([
                    'status_main' => 2,
                    'updated_at' => $now
                ]);
        }

        return response()->json([
            'success' => 'success',
//            'request' => $request ,
//            'budding' => $budding ,
//            'subBudding' => $subBudding ,
        ]);
    }

    public function typePrelim()
    {
        $prelim = DB::table('preliminaries')->get();
        return response()->json($prelim);
    }

    public function insertPrelim(Request $request)
    {
//        dd($request->all());
        $now = new DateTime();
        for ($i = 0; $i < count($request->get('prelim')); $i++) {
            $id = DB::table('prelim_air')->insertGetId(
                [
                    'project_id' => $request->get('project_id'),
                    'user_id' => $request->get('user_id'),
                    'preliminaries_id' => $request->get('prelim')[$i]['preliminaries_id'],
                    'preliminaries_name' => $request->get('prelim')[$i]['preliminaries_name'],
                    'created_at' => $now,
                    'updated_at' => null,
                ]
            );
            for ($j = 0; $j < count($request->get('prelim')[$i]['sub_data']); $j++) {
                DB::table('preliminaries_datail')->insert([
                    [
                        'prelim_id' => $id,
                        'list' => $request->get('prelim')[$i]['sub_data'][$j]['list'],
                        'volume' => $request->get('prelim')[$i]['sub_data'][$j]['volume'],
                        'unit' => $request->get('prelim')[$i]['sub_data'][$j]['unit'],
                        'price_unit' => $request->get('prelim')[$i]['sub_data'][$j]['price_unit'],
                        'price_sum' => $request->get('prelim')[$i]['sub_data'][$j]['price_sum'],
                        'remark' => (!empty($request->get('prelim')[$i]['sub_data'][$j]['remark'])) ? $request->get('prelim')[$i]['sub_data'][$j]['remark'] : null,
                        'created_at' => $now,
                        'updated_at' => null,
                    ],
                ]);
            }
        }

        DB::table('project_auctions_air')
            ->where('project_id', '=', $request->get('project_id'))
            ->where('user_id', '=', $request->get('user_id'))
            ->update([
                'status_prelim' => 2,
                'updated_at' => $now
            ]);
        return response()->json([
            'success' => 'success',
        ]);
    }

    public function getSumPrice(Request $request)
    {
        $project_id = $request->get('project_id');
        $user_id = $request->get('user_id');
        $arr = [];
        $budding_airs = DB::table('budding_airs')
            ->where('project_id', '=', $project_id)
            ->where('user_id', '=', $user_id)
            ->sum('totalAll_sub');
        $prelim_air = DB::table('prelim_air')
            ->where('project_id', '=', $project_id)
            ->where('user_id', '=', $user_id)
            ->get();
        for ($i = 0; $i < count($prelim_air); $i++) {
            $arr[] = $prelim_air[$i]->id;
        }
        $preliminaries_datail = DB::table('preliminaries_datail')
            ->whereIn('id', $arr)
            ->sum('price_sum');
        return response()->json([
            'budding_airs' => $budding_airs,
            'preliminaries_datail' => $preliminaries_datail,
            'sum' => $budding_airs + $preliminaries_datail,
        ]);
    }

    public function insertOverHead(Request $request)
    {
        $now = new DateTime();
        DB::table('budding_overhead')->insert([
            [
                'project_id' => $request->get('project_id'),
                'user_id' => $request->get('user_id'),
                'sum_price' => $request->get('sum_price'),
                'overhead' => $request->get('overhead'),
                'sum_overhead' => $request->get('sum_overhead'),
                'created_at' => $now,
                'updated_at' => null,
            ],
        ]);
        return response()->json([
            'success' => 'success',
        ]);
    }

    public function ReportExcel(Request $request)
    {
//        dd($request->all());
        $user_id = $request->user_id;
        $project_id = $request->project_id;
//        echo $user_id." ".$project_id;
        $data = [];
        $myFile = Excel::create('ใบเสนอราคาค่าติดตั้งเครื่องปรับอากาศ', function ($excel) use ($data, $user_id, $project_id) {

            $excel->sheet('QUOTATION(SUMMARY)', function ($sheet) use ($data, $user_id, $project_id) {
                //############## Query SQL ##############//
                // Detail Project
                $project = ProjectAuction::find($project_id);
//                dd($project_id);
                $profile = Profile::find($project->profile_id);

                $arr = [];
                $arr2 = [];
                $vat = 0;

                $buddingAir = DB::table('budding_airs')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->get();
                for ($i = 0; $i < count($buddingAir); $i++) {
                    $arr[] = $buddingAir[$i]->id;
                }
                $labour_unitTotal_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr)
                    ->sum('labour_unitTotal');
                $materail_unitTotal_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr)
                    ->sum('materail_unitTotal');
                $buddingAir_sum = DB::table('budding_airs')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->sum('totalAll_sub');

                // Preliminaries
                $prelim_air = DB::table('prelim_air')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->get();
                for ($i = 0; $i < count($prelim_air); $i++) {
                    $arrprelim2[] = $prelim_air[$i]->id;
                }
                $preliminaries_datail = DB::table('preliminaries_datail')
                    ->whereIn('prelim_id', $arrprelim2)
                    ->sum('price_sum');

                // Over Head
                $overhead = DB::table('budding_overhead')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->first();

                $sum = $buddingAir_sum + $preliminaries_datail;
                $overhead_sum = ($overhead != null) ? $overhead->sum_overhead : 0;
                $total = (double)$sum + (double)$overhead_sum;
                $sum_vat = $vat + 0;
                $GrandTotal = $total + $sum_vat;
                //############## Query SQL ##############//


                $sheet->setAutoSize(true);
                $sheet->setAutoSize(array(
                    'A', 'B'
                ));
                $sheet->setFontFamily('Angsana New');
                $sheet->setFontSize(14);
                $sheet->mergeCells('A1:I1');
                $sheet->mergeCells('A2:I2');
                $sheet->setHeight(1, 80);
                $sheet->setWidth(array(
                    'A' => 8,
                    'B' => 40,
                    'C' => 7,
                    'D' => 7,
                    'E' => 18,
                    'F' => 18,
                    'G' => 18,
                    'H' => 18,
                    'I' => 18,
                ));

                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('image/logo.PNG')); //your image path
                //$objDrawing->setPath(url('/image/logo.PNG')); //your image path
                $objDrawing->setCoordinates('B1');
                $objDrawing->setWorksheet($sheet);

                $sheet->row(2, array(
                    'QUOTATION (SUMMARY)'
                ));
                $sheet->row(2, function ($row) {
                    $row->setFontColor('#000000');
                    $row->setFontSize(16);
                    $row->setAlignment('center');
                    $row->setValignment('center');
                    $row->setFontWeight('bold');
                });


                $sheet->mergeCells('B3:E3');
                $sheet->row(3, array(
                    'เรื่อง : ', 'เสนอราคาค่าตั้งเครื่องปรับอากาศ', '', '', '', '',
                    'ใบเสนอราคาเลขที่ ', '-'
                ));
                $sheet->row(4, array(
                    'เรียน :', $profile->firstname . " " . $profile->lastname,
                    '', '', '', '',
                    'วันที่', '-'
                ));
                $sheet->row(5, array(
                    '', '', '', '', '', '',
                    'เครดิต  ตามเงื่อนไขชำระข้างล่าง'
                ));
                $sheet->row(6, array(
                    '', '', '', '', '', '',
                    'กำหนดยืนราคา', ' -  วัน'
                ));
                $sheet->row(7, array(
                    '', '', '', '', '', '',
                    'PROJECT : ', $project->project_name
                ));

                $sheet->cell('A8:I8', function ($cell) {
                    $cell->setBorder('none', 'none', 'thin', 'none');
                });
                $sheet->setBorder('A9:I9', 'thin');
                $sheet->setBorder('A10:I10', 'thin');
                $sheet->setBorder('A11:I11', 'thin');
                $sheet->cell('A11:I11', function ($cell) {
                    $cell->setBorder('none', 'none', 'thin', 'none');
                });
                $sheet->cell('I9:I11', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->row(9, array(
                    '', '', '', '', 'MATERIAL', '', 'LABOUR',
                    ' : ', ''
                ));
                //setBorder(T,R,B,L);
                $sheet->cell('A9:A11', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('E9:F9', function ($cell) {
                    $cell->setBorder('none', 'none', 'thin', 'none');
                });
                $sheet->mergeCells('E9:F9');
                $sheet->cell('G9:H9', function ($cell) {
                    $cell->setBorder('none', 'none', 'thin', 'none');
                });
                $sheet->mergeCells('G9:H9');
                $sheet->row(10, array(
                    'ITEM', 'DESCRIPTION', 'QTY.', 'UNIT', 'UNIT PRICE', 'TOTAL',
                    'UNIT PRICE', 'TOTAL', 'TOTAL'
                ));
                $sheet->row(11, array(
                    '', '', '', '', '(BAHT)', '',
                    '(BAHT)', '', '(BAHT)'
                ));
                $sheet->row(9, function ($row) {
                    $row->setAlignment('center');
                    $row->setValignment('center');
                });
                $sheet->row(10, function ($row) {
                    $row->setAlignment('center');
                    $row->setValignment('center');
                });
                $sheet->row(11, function ($row) {
                    $row->setAlignment('center');
                    $row->setValignment('center');
                });

                $sheet->cell('A12:A20', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('B12:B20', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('C12:C20', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('D12:D20', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('E12:E20', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('F12:F20', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('G12:G20', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('H12:H20', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('I12:I20', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->row(12, array(
                    'A', 'BUILDING', '1.', 'Lot',
                    number_format($materail_unitTotal_sum, 2), number_format($materail_unitTotal_sum, 2),
                    number_format($labour_unitTotal_sum, 2), number_format($labour_unitTotal_sum, 2),
                    number_format($buddingAir_sum, 2)
                ));
                $sheet->cell('C12:E12', function ($cell) {
                    $cell->setAlignment('center');
                    $cell->setValignment('center');
                });
                $sheet->cell('E12:I15', function ($cell) {
                    $cell->setAlignment('right');
                    $cell->setValignment('right');
                });
                $sheet->row(13, array(
                    'B', 'Preliminaries', '', '', '', '',
                    '', '', number_format($preliminaries_datail, 2)
                ));
                $sheet->row(16, array(
                    '', 'หมายเหตุ', '', '', '', '',
                    '', '', ''
                ));
//                $sheet->row(17, array(
//                    '','1.ไม่รวมค่าเครนยกเครื่อง','','','' ,'',
//                    '','' ,''
//                ));
                $sheet->row(19, array(
                    '', 'บริการหลังการขาย', '', '', '', '',
                    '', '', ''
                ));
//                $sheet->row(20, array(
//                    '','1. รับประกันผลงานติดตั้ง 1 ปี','','','' ,'',
//                    '','' ,''
//                ));
                $sheet->cell('A21:F25', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('G21:H25', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('G21:H21', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('G22:H22', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('G23:H23', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('G24:H24', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('G25:H25', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->mergeCells('G21:H21');
                $sheet->mergeCells('G22:H22');
                $sheet->mergeCells('G23:H23');
                $sheet->mergeCells('G24:H24');
                $sheet->mergeCells('G25:H25');
                $sheet->cell('I21', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                    $cell->setAlignment('right');
                    $cell->setValignment('right');
                });
                $sheet->cell('I22', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                    $cell->setAlignment('right');
                    $cell->setValignment('right');
                });
                $sheet->cell('I23', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                    $cell->setAlignment('right');
                    $cell->setValignment('right');
                });
                $sheet->cell('I24', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                    $cell->setAlignment('right');
                    $cell->setValignment('right');
                });
                $sheet->cell('I25', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                    $cell->setAlignment('right');
                    $cell->setValignment('right');
                });
                $sheet->cell('A26:F26', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('A27:B31', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('C27:F31', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('G26:I31', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });


                $sheet->row(21, array(
                    'เงื่อนไขชำระ', '', '', '', '', '',
                    'SUM', '', number_format($sum, 2)
                ));
                $sheet->row(22, array(
                    '', '', '', '', '', '',
                    'Overhead & Profit', '', number_format((double)$overhead_sum, 2)
                ));
                $sheet->row(23, array(
                    '', '', '', '', '', '',
                    'TOTAL', '', number_format($total, 2)
                ));
                $sheet->row(24, array(
                    '', '', '', '', '', '',
                    'Vat ' . $vat . ' %', '', number_format($sum_vat, 2)
                ));
                $sheet->row(25, array(
                    '', '', '', '', '', '',
                    'Grand Total', '', number_format($GrandTotal, 2)
                ));

                $sheet->row(26, array(
                    'โดยหวังเป็นอย่างยิ่งว่าจะได้บริการท่านในเร็ววัน และขอขอบพระคุณมา ณ โอกาสนี้', '', '', '', '', '',
                    '(สำหรับลูกค้า)', '', ''
                ));
                $sheet->row(27, array(
                    'ผู้เสนอราคา :', '', 'ผู้อนุมัติ :', '', '', '',
                    '', 'อนุมัติสั่งซื้อ', ''
                ));
                $sheet->mergeCells('A28:B28');
                $sheet->mergeCells('C28:F28');
                $sheet->row(28, array(
                    'ลายเซ็น', '', 'ลายเซ็น', '', '', '',
                    '', '', ''
                ));
                $sheet->row(28, function ($row) {
                    $row->setAlignment('center');
                    $row->setValignment('center');
                });

                $sheet->mergeCells('A29:B29');
                $sheet->mergeCells('C29:F29');
                $sheet->row(29, array(
                    '', '', '', '', '', '',
                    '', '…………………………', ''
                ));
                $sheet->row(29, function ($row) {
                    $row->setAlignment('center');
                    $row->setValignment('center');
                });

                $sheet->mergeCells('A30:B30');
                $sheet->mergeCells('C30:F30');
//                $sheet->mergeCells('G30:H30');
                $sheet->mergeCells('A31:B31');
                $sheet->mergeCells('C31:F31');
                $sheet->row(30, array(
                    'ชื่อ', '', 'ชื่อ', '', '', '',
                    '', '(…………………………)', ''
                ));
                $sheet->row(30, function ($row) {
                    $row->setAlignment('center');
                    $row->setValignment('center');
                });
                $sheet->row(31, array(
                    '', '', '', '', '', '',
                    '', '……/……………/………', ''
                ));
                $sheet->row(31, function ($row) {
                    $row->setAlignment('center');
                    $row->setValignment('center');
                });
            });

            $excel->sheet('QUOTATION(SUMMARY) 2', function ($sheet) use ($data, $user_id, $project_id) {

                //############## Query SQL ##############//
                // Detail Project
                $project = ProjectAuction::find($project_id);
                $profile = Profile::find($project->profile_id);
                $arr = [];
                $arr2 = [];
                $vat = 0;


                $buddingAir = DB::table('budding_airs')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->get();
                for ($i = 0; $i < count($buddingAir); $i++) {
                    $arr[] = $buddingAir[$i]->id;
                }
                $labour_unitTotal_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr)
                    ->sum('labour_unitTotal');
                $materail_unitTotal_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr)
                    ->sum('materail_unitTotal');
                $buddingAir_sum = DB::table('budding_airs')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->sum('totalAll_sub');

                // Preliminaries
                $prelim_air = DB::table('prelim_air')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->get();
                for ($i = 0; $i < count($prelim_air); $i++) {
                    $arr2prelim[] = $prelim_air[$i]->id;
                }
                $preliminaries_datail = DB::table('preliminaries_datail')
                    ->whereIn('prelim_id', $arr2prelim)
                    ->sum('price_sum');

                // Over Head
                $overhead = DB::table('budding_overhead')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->first();

                $sum = $buddingAir_sum + $preliminaries_datail;
                $overhead_sum = ($overhead != null) ? $overhead->sum_overhead : 0;
                $total = (double)$sum + (double)$overhead_sum;
                $sum_vat = $vat + 0;
                $GrandTotal = $total + $sum_vat;

                //Detail
                $data2 = DB::table('project_auctions_air')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->get();
                $array = [];
                foreach ($data2 as $key => $value) {
                    if ($value->status_machine == 2) {
                        $buddingAir = DB::table('budding_airs')
                            ->where('project_id', '=', $project_id)
                            ->where('user_id', '=', $user_id)
                            ->where('type_work_sub', '=', 1)
                            ->get();
                        for ($i = 0; $i < count($buddingAir); $i++) {
                            $arr1[] = $buddingAir[$i]->id;
                        }
                        $materail_unitCost_sum = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr1)
                            ->sum('materail_unitCost');
                        $materail_unitTotal_sum = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr1)
                            ->sum('materail_unitTotal');

                        $labour_unitCost_sum = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr1)
                            ->sum('labour_unitCost');
                        $labour_unitTotal_sum = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr1)
                            ->sum('labour_unitTotal');

                        $buddingAir_sum = DB::table('budding_airs')
                            ->where('project_id', '=', $project_id)
                            ->where('user_id', '=', $user_id)
                            ->where('type_work_sub', '=', 1)
                            ->sum('totalAll_sub');
                        $datail_arr1 = [
                            'name' => 'Install Machine',
                            'arr' => $arr1,
                            'qty' => 1 ,
                            'unit' => 'Lot' ,
                            'materail_unitCost' => $materail_unitCost_sum ,
                            'materail_unitTotal' => $materail_unitTotal_sum ,
                            'labour_unitCost' => $labour_unitCost_sum ,
                            'labour_unitTotal' => $labour_unitTotal_sum ,
                            'total' => $buddingAir_sum,
                        ];
                        $array[1] = $datail_arr1;
                    }
                    if ($value->status_piping == 2) {
                        $buddingAir2 = DB::table('budding_airs')
                            ->where('project_id', '=', $project_id)
                            ->where('user_id', '=', $user_id)
                            ->where('type_work_sub', '=', 2)
                            ->get();
                        for ($i = 0; $i < count($buddingAir2); $i++) {
                            $array2[] = $buddingAir2[$i]->id;
                        }
                        $materail_unitCost_sum2 = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $array2)
                            ->sum('materail_unitCost');
                        $materail_unitTotal_sum2 = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $array2)
                            ->sum('materail_unitTotal');

                        $labour_unitCost_sum2 = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $array2)
                            ->sum('labour_unitCost');
                        $labour_unitTotal_sum2 = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $array2)
                            ->sum('labour_unitTotal');

                        $buddingAir_sum = DB::table('budding_airs')
                            ->where('project_id', '=', $project_id)
                            ->where('user_id', '=', $user_id)
                            ->where('type_work_sub', '=', 2)
                            ->sum('totalAll_sub');
                        $datail_arr2 = [
                            'name' => 'piping',
                            'arr' => $array2,
                            'qty' => 1 ,
                            'unit' => 'Lot' ,
                            'materail_unitCost' => $materail_unitCost_sum2 ,
                            'materail_unitTotal' => $materail_unitTotal_sum2 ,
                            'labour_unitCost' => $labour_unitCost_sum2,
                            'labour_unitTotal' => $labour_unitTotal_sum2 ,
                            'total' => $buddingAir_sum,
                        ];
                        $array[2] = $datail_arr2;
                    }
                    if ($value->status_control == 2) {
                        $buddingAir = DB::table('budding_airs')
                            ->where('project_id', '=', $project_id)
                            ->where('user_id', '=', $user_id)
                            ->where('type_work_sub', '=', 3)
                            ->get();
                        for ($i = 0; $i < count($buddingAir); $i++) {
                            $arr3[] = $buddingAir[$i]->id;
                        }
                        $materail_unitCost_sum = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr3)
                            ->sum('materail_unitCost');
                        $materail_unitTotal_sum = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr3)
                            ->sum('materail_unitTotal');

                        $labour_unitCost_sum = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr3)
                            ->sum('labour_unitCost');
                        $labour_unitTotal_sum = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr3)
                            ->sum('labour_unitTotal');

                        $buddingAir_sum = DB::table('budding_airs')
                            ->where('project_id', '=', $project_id)
                            ->where('user_id', '=', $user_id)
                            ->where('type_work_sub', '=', 3)
                            ->sum('totalAll_sub');
                        $datail_arr3 = [
                            'name' => 'control',
                            'qty' => 1 ,
                            'unit' => 'Lot' ,
                            'materail_unitCost' => $materail_unitCost_sum ,
                            'materail_unitTotal' => $materail_unitTotal_sum ,
                            'labour_unitCost' => $labour_unitCost_sum ,
                            'labour_unitTotal' => $labour_unitTotal_sum ,
                            'total' => $buddingAir_sum,
                        ];
                        $array[3] = $datail_arr3;
                    }
                    if ($value->status_main == 2) {
                        $buddingAir = DB::table('budding_airs')
                            ->where('project_id', '=', $project_id)
                            ->where('user_id', '=', $user_id)
                            ->where('type_work_sub', '=', 5)
                            ->get();
                        for ($i = 0; $i < count($buddingAir); $i++) {
                            $arr5[] = $buddingAir[$i]->id;
                        }
                        $materail_unitCost_sum = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr5)
                            ->sum('materail_unitCost');
                        $materail_unitTotal_sum = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr5)
                            ->sum('materail_unitTotal');

                        $labour_unitCost_sum = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr5)
                            ->sum('labour_unitCost');
                        $labour_unitTotal_sum = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr5)
                            ->sum('labour_unitTotal');

                        $buddingAir_sum = DB::table('budding_airs')
                            ->where('project_id', '=', $project_id)
                            ->where('user_id', '=', $user_id)
                            ->where('type_work_sub', '=', 5)
                            ->sum('totalAll_sub');
                        $datail_arr5 = [
                            'name' => 'main',
                            'qty' => 1 ,
                            'unit' => 'Lot' ,
                            'materail_unitCost' => $materail_unitCost_sum ,
                            'materail_unitTotal' => $materail_unitTotal_sum ,
                            'labour_unitCost' => $labour_unitCost_sum ,
                            'labour_unitTotal' => $labour_unitTotal_sum ,
                            'total' => $buddingAir_sum,
                        ];
                        $array[4] = $datail_arr5;
                    }
                    if ($value->status_duct == 2) {
                        $buddingAir = DB::table('budding_airs')
                            ->where('project_id', '=', $project_id)
                            ->where('user_id', '=', $user_id)
                            ->where('type_work_sub', '=', 4)
                            ->get();
                        for ($i = 0; $i < count($buddingAir); $i++) {
                            $arr4[] = $buddingAir[$i]->id;
                        }
                        $materail_unitCost_sum = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr4)
                            ->sum('materail_unitCost');
                        $materail_unitTotal_sum = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr4)
                            ->sum('materail_unitTotal');

                        $labour_unitCost_sum = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr4)
                            ->sum('labour_unitCost');
                        $labour_unitTotal_sum = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr4)
                            ->sum('labour_unitTotal');

                        $buddingAir_sum = DB::table('budding_airs')
                            ->where('project_id', '=', $project_id)
                            ->where('user_id', '=', $user_id)
                            ->where('type_work_sub', '=', 4)
                            ->sum('totalAll_sub');
                        $datail_arr4 = [
                            'name' => 'duct piping',
                            'qty' => 1 ,
                            'unit' => 'Lot' ,
                            'materail_unitCost' => $materail_unitCost_sum ,
                            'materail_unitTotal' => $materail_unitTotal_sum ,
                            'labour_unitCost' => $labour_unitCost_sum ,
                            'labour_unitTotal' => $labour_unitTotal_sum ,
                            'total' => $buddingAir_sum,
                        ];
                        $array[5] = $datail_arr4;
                    }
                    if ($value->status_prelim == 2) {
                        $prelim_air = DB::table('prelim_air')
                            ->where('project_id', '=', $project_id)
                            ->where('user_id', '=', $user_id)
                            ->get();
                        for ($i = 0; $i < count($prelim_air); $i++) {
                            $arr6[] = $prelim_air[$i]->id;
                        }
                        $preliminaries_datail = DB::table('preliminaries_datail')
                            ->whereIn('prelim_id', $arr6)
                            ->sum('price_sum');
                        $arr = [
                            'name' => 'prelim',
                            'qty' => '' ,
                            'unit' => '' ,
                            'materail_unitCost' => '' ,
                            'materail_unitTotal' => '' ,
                            'labour_unitCost' => '' ,
                            'labour_unitTotal' => '' ,
                            'total' => (int)$preliminaries_datail,
                        ];
                        $array[6] = $arr;
                    }
                }
                //############## Query SQL ##############//

                $sheet->setAutoSize(true);
                $sheet->setAutoSize(array(
                    'A', 'B'
                ));
                $sheet->setFontFamily('Angsana New');
                $sheet->setFontSize(14);
                $sheet->mergeCells('A1:I1');
                $sheet->mergeCells('A2:I2');
                $sheet->setHeight(1, 80);
                $sheet->setWidth(array(
                    'A' => 8,
                    'B' => 40,
                    'C' => 7,
                    'D' => 7,
                    'E' => 18,
                    'F' => 18,
                    'G' => 18,
                    'H' => 18,
                    'I' => 18,
                ));

                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('image/logo.PNG')); //your image path
                $objDrawing->setCoordinates('B1');
                $objDrawing->setWorksheet($sheet);

                $sheet->row(2, array(
                    'QUOTATION (SUMMARY) 2'
                ));
                $sheet->row(2, function ($row) {
                    $row->setFontColor('#000000');
                    $row->setFontSize(16);
                    $row->setAlignment('center');
                    $row->setValignment('center');
                    $row->setFontWeight('bold');
                });


                $sheet->mergeCells('B3:E3');
                $sheet->row(3, array(
                    'เรื่อง : ', 'เสนอราคาค่าตั้งเครื่องปรับอากาศ', '', '', '', '',
                    'ใบเสนอราคาเลขที่ ', '-'
                ));
                $sheet->row(4, array(
                    'เรียน :', $profile->firstname . " " . $profile->lastname,
                    '', '', '', '',
                    'วันที่', '-'
                ));
                $sheet->row(5, array(
                    '', '', '', '', '', '',
                    'เครดิต  ตามเงื่อนไขชำระข้างล่าง'
                ));
                $sheet->row(6, array(
                    '', '', '', '', '', '',
                    'กำหนดยืนราคา', ' -  วัน'
                ));
                $sheet->row(7, array(
                    '', '', '', '', '', '',
                    'PROJECT : ', $project->project_name
                ));

                $sheet->cell('A8:I8', function ($cell) {
                    $cell->setBorder('none', 'none', 'thin', 'none');
                });
                $sheet->setBorder('A9:I9', 'thin');
                $sheet->setBorder('A10:I10', 'thin');
                $sheet->setBorder('A11:I11', 'thin');
                $sheet->cell('A11:I11', function ($cell) {
                    $cell->setBorder('none', 'none', 'thin', 'none');
                });
                $sheet->cell('I9:I11', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->row(9, array(
                    '', '', '', '', 'MATERIAL', '', 'LABOUR',
                    ' : ', ''
                ));
                //setBorder(T,R,B,L);
                $sheet->cell('A9:A11', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('E9:F9', function ($cell) {
                    $cell->setBorder('none', 'none', 'thin', 'none');
                });
                $sheet->mergeCells('E9:F9');
                $sheet->cell('G9:H9', function ($cell) {
                    $cell->setBorder('none', 'none', 'thin', 'none');
                });
                $sheet->mergeCells('G9:H9');
                $sheet->row(10, array(
                    'ITEM', 'DESCRIPTION', 'QTY.', 'UNIT', 'UNIT PRICE', 'TOTAL',
                    'UNIT PRICE', 'TOTAL', 'TOTAL'
                ));
                $sheet->row(11, array(
                    '', '', '', '', '(BAHT)', '',
                    '(BAHT)', '', '(BAHT)'
                ));
                $sheet->row(9, function ($row) {
                    $row->setAlignment('center');
                    $row->setValignment('center');
                });
                $sheet->row(10, function ($row) {
                    $row->setAlignment('center');
                    $row->setValignment('center');
                });
                $sheet->row(11, function ($row) {
                    $row->setAlignment('center');
                    $row->setValignment('center');
                });

                $sheet->cell('A12:A25', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('B12:B25', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('C12:C25', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('D12:D25', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('E12:E25', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('F12:F25', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('G12:G25', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('H12:H25', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('I12:I25', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });

                $alphabet = Array();
                for ($i = 0; $i <= 5; $i++) {
                    $alphabet[] = $this->generateAlphabet($i);
                }

                $c = 12;
                $i = 0;

                foreach ($array as $value){
                    $alphabet[] = $this->generateAlphabet($i);
                    $sheet->row($c, array($alphabet[$i], $value['name'], $value['qty'], $value['unit'],
                        number_format((int)$value['materail_unitCost'], 2), number_format((int)$value['materail_unitTotal'], 2),
                        number_format((int)$value['labour_unitCost'], 2), number_format((int)$value['labour_unitTotal'], 2),
                        number_format((int)$value['total'], 2)
                    ));
                    $c = $c + 1;
                    $i = $i + 1;
                }
//                dd($array);


                $sheet->cell('C12:D' . $c, function ($cell) {
                    $cell->setAlignment('center');
                    $cell->setValignment('center');
                });
                $sheet->cell('E12:I' . $c, function ($cell) {
                    $cell->setAlignment('right');
                    $cell->setValignment('right');
                });

                $sheet->row(20, array(
                    '', 'หมายเหตุ', '', '', '', '',
                    '', '', ''
                ));
//                $sheet->row(21, array(
//                    '','1.ไม่รวมค่าเครนยกเครื่อง','','','' ,'',
//                    '','' ,''
//                ));
                $sheet->row(23, array(
                    '', 'บริการหลังการขาย', '', '', '', '',
                    '', '', ''
                ));
//                $sheet->row(24, array(
//                    '','1. รับประกันผลงานติดตั้ง 1 ปี','','','' ,'',
//                    '','' ,''
//                ));

                $sheet->cell('A26:F30', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('G26:H30', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('G26:H26', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('G27:H27', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('G28:H28', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('G29:H29', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('G30:H30', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->mergeCells('G26:H26');
                $sheet->mergeCells('G27:H27');
                $sheet->mergeCells('G28:H28');
                $sheet->mergeCells('G29:H29');
                $sheet->mergeCells('G30:H30');
                $sheet->cell('I26', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                    $cell->setAlignment('right');
                    $cell->setValignment('right');
                });
                $sheet->cell('I27', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                    $cell->setAlignment('right');
                    $cell->setValignment('right');
                });
                $sheet->cell('I28', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                    $cell->setAlignment('right');
                    $cell->setValignment('right');
                });
                $sheet->cell('I29', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                    $cell->setAlignment('right');
                    $cell->setValignment('right');
                });
                $sheet->cell('I30', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                    $cell->setAlignment('right');
                    $cell->setValignment('right');
                });
                $sheet->cell('A31:F31', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('A32:B36', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('C32:F36', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('G30:I36', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });

                $sheet->row(26, array(
                    'เงื่อนไขชำระ', '', '', '', '', '',
                    'SUM', '', number_format($sum, 2)
                ));
                $sheet->row(27, array(
                    '', '', '', '', '', '',
                    'Overhead & Profit', '', number_format((double)$overhead_sum, 2)
                ));
                $sheet->row(28, array(
                    '', '', '', '', '', '',
                    'TOTAL', '', number_format($total, 2)
                ));
                $sheet->row(29, array(
                    '', '', '', '', '', '',
                    'Vat ' . $vat . ' %', '', number_format($sum_vat, 2)
                ));
                $sheet->row(30, array(
                    '', '', '', '', '', '',
                    'Grand Total', '', number_format($GrandTotal, 2)
                ));

                $sheet->row(31, array(
                    'โดยหวังเป็นอย่างยิ่งว่าจะได้บริการท่านในเร็ววัน และขอขอบพระคุณมา ณ โอกาสนี้', '', '', '', '', '',
                    '(สำหรับลูกค้า)', '', ''
                ));
                $sheet->row(32, array(
                    'ผู้เสนอราคา :', '', 'ผู้อนุมัติ :', '', '', '',
                    '', 'อนุมัติสั่งซื้อ', ''
                ));
                $sheet->mergeCells('A33:B33');
                $sheet->mergeCells('C33:F33');
                $sheet->row(33, array(
                    'ลายเซ็น', '', 'ลายเซ็น', '', '', '',
                    '', '', ''
                ));
                $sheet->row(34, function ($row) {
                    $row->setAlignment('center');
                    $row->setValignment('center');
                });


                $sheet->mergeCells('A34:B34');
                $sheet->mergeCells('C34:F34');
                $sheet->row(34, array(
                    '', '', '', '', '', '',
                    '', '…………………………', ''
                ));
                $sheet->row(34, function ($row) {
                    $row->setAlignment('center');
                    $row->setValignment('center');
                });

                $sheet->mergeCells('A35:B35');
                $sheet->mergeCells('C35:F35');
                $sheet->mergeCells('A36:B36');
                $sheet->mergeCells('C36:F36');
                $sheet->row(35, array(
                    'ชื่อ', '', 'ชื่อ', '', '', '',
                    '', '(…………………………)', ''
                ));
                $sheet->row(35, function ($row) {
                    $row->setAlignment('center');
                    $row->setValignment('center');
                });
                $sheet->row(36, array(
                    '', '', '', '', '', '',
                    '', '……/……………/………', ''
                ));
                $sheet->row(36, function ($row) {
                    $row->setAlignment('center');
                    $row->setValignment('center');
                });
            });

            $excel->sheet('QUOTATION(SUMMARY) (ราคา)', function ($sheet) use ($data, $user_id, $project_id) {

                //############## Query SQL ##############//
                // Detail Project
                $project = ProjectAuction::find($project_id);
                $profile = Profile::find($project->profile_id);
                $arr = [];
                $arr2 = [];
                $vat = 0;


                $buddingAir = DB::table('budding_airs')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->get();
                for ($i = 0; $i < count($buddingAir); $i++) {
                    $arr[] = $buddingAir[$i]->id;
                }
                for ($i = 0; $i < count($buddingAir); $i++) {
                    $arr_sum[] = $buddingAir[$i]->id;
                }
                $labour_unitTotal_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr_sum)
                    ->sum('labour_unitTotal');
                $materail_unitTotal_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr_sum)
                    ->sum('materail_unitTotal');
                $buddingAir_sum = DB::table('budding_airs')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->sum('totalAll_sub');

                // Preliminaries
                $prelim_air = DB::table('prelim_air')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->get();
                for ($i = 0; $i < count($prelim_air); $i++) {
                    $arr2[] = $prelim_air[$i]->id;
                }
                $preliminaries_datail = DB::table('preliminaries_datail')
                    ->whereIn('id', $arr2)
                    ->sum('price_sum');

                // Over Head
                $overhead = DB::table('budding_overhead')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->first();

                $sum = $buddingAir_sum + $preliminaries_datail;
                $overhead_sum = ($overhead != null) ? $overhead->sum_overhead : 0;
                $total = (double)$sum + (double)$overhead_sum;
                $sum_vat = $vat + 0;
                $GrandTotal = $total + $sum_vat;


                //Detail
                $data = DB::table('project_auctions_air')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->get();
                foreach ($data as $key => $value) {
                    if ($value->status_machine == 2) {
                        $buddingAir1 = DB::table('budding_airs')
                            ->where('project_id', '=', $project_id)
                            ->where('user_id', '=', $user_id)
                            ->where('type_work_sub', '=', 1)
                            ->get();
                        foreach ($buddingAir1 as $keyB => $item){
                            $subBuddingAir1 = DB::table('sub_budding_airs')
                                ->where('budding_air_id', $item->id)
                                ->get();
                            $buddingAir1[$keyB]->sub_data = $subBuddingAir1;
                        }
                        $array[1]['type'] = "Install Machine";
                        $array[1]['data'] = $buddingAir1;
                        for ($i = 0; $i < count($buddingAir1); $i++) {
                            $arr_1[] = $buddingAir1[$i]->id;
                        }
                        $materail_unitTotal_sum1 = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr_1)
                            ->sum('materail_unitTotal');
                        $labour_unitTotal_sum1 = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr_1)
                            ->sum('labour_unitTotal');
                        $buddingAir_sum1 = DB::table('budding_airs')
                            ->where('project_id', '=', $project_id)
                            ->where('user_id', '=', $user_id)
                            ->where('type_work_sub', '=', 1)
                            ->sum('totalAll_sub');
                        $array[1]['materail_unitTotal'] = $materail_unitTotal_sum1;
                        $array[1]['labour_unitTotal'] = $labour_unitTotal_sum1;
                        $array[1]['totalAll'] = $buddingAir_sum1;
                    }
                    if ($value->status_piping == 2) {
                        $buddingAir2 = DB::table('budding_airs')
                            ->where('project_id', '=', $project_id)
                            ->where('user_id', '=', $user_id)
                            ->where('type_work_sub', '=', 2)
                            ->get();
                        foreach ($buddingAir2 as $keyB => $item){
                            $subBuddingAir2 = DB::table('sub_budding_airs')
                                ->where('budding_air_id', $item->id)
                                ->get();
                            $buddingAir2[$keyB]->sub_data = $subBuddingAir2;
                        }
                        $array[2]['type'] = "Piping";
                        $array[2]['data'] = $buddingAir2;
                        for ($i = 0; $i < count($buddingAir2); $i++) {
                            $arr_2[] = $buddingAir2[$i]->id;
                        }
                        $materail_unitTotal_sum2 = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr_2)
                            ->sum('materail_unitTotal');
                        $labour_unitTotal_sum2 = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr_2)
                            ->sum('labour_unitTotal');
                        $buddingAir_sum2 = DB::table('budding_airs')
                            ->where('project_id', '=', $project_id)
                            ->where('user_id', '=', $user_id)
                            ->where('type_work_sub', '=', 2)
                            ->sum('totalAll_sub');
                        $array[2]['materail_unitTotal'] = $materail_unitTotal_sum2;
                        $array[2]['labour_unitTotal'] = $labour_unitTotal_sum2;
                        $array[2]['totalAll'] = $buddingAir_sum2;
                    }
                    if ($value->status_control == 2) {
                        $buddingAir3 = DB::table('budding_airs')
                            ->where('project_id', '=', $project_id)
                            ->where('user_id', '=', $user_id)
                            ->where('type_work_sub', '=', 3)
                            ->get();
                        foreach ($buddingAir3 as $keyB => $item){
                            $subBuddingAir3 = DB::table('sub_budding_airs')
                                ->where('budding_air_id', $item->id)
                                ->get();
                            $buddingAir3[$keyB]->sub_data = $subBuddingAir3;
                        }
                        $array[3]['type'] = "Control";
                        $array[3]['data'] = $buddingAir3;
                        for ($i = 0; $i < count($buddingAir3); $i++) {
                            $arr_3[] = $buddingAir3[$i]->id;
                        }
                        $materail_unitTotal_sum3 = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr_3)
                            ->sum('materail_unitTotal');
                        $labour_unitTotal_sum3 = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr_3)
                            ->sum('labour_unitTotal');
                        $buddingAir_sum3 = DB::table('budding_airs')
                            ->where('project_id', '=', $project_id)
                            ->where('user_id', '=', $user_id)
                            ->where('type_work_sub', '=', 3)
                            ->sum('totalAll_sub');
                        $array[3]['materail_unitTotal'] = $materail_unitTotal_sum3;
                        $array[3]['labour_unitTotal'] = $labour_unitTotal_sum3;
                        $array[3]['totalAll'] = $buddingAir_sum3;
                    }
                    if ($value->status_main == 2) {
                        $buddingAir5 = DB::table('budding_airs')
                            ->where('project_id', '=', $project_id)
                            ->where('user_id', '=', $user_id)
                            ->where('type_work_sub', '=', 5)
                            ->get();
                        foreach ($buddingAir5 as $keyB => $item){
                            $subBuddingAir5 = DB::table('sub_budding_airs')
                                ->where('budding_air_id', $item->id)
                                ->get();
                            $buddingAir5[$keyB]->sub_data = $subBuddingAir5;
                        }
                        $array[4]['type'] = "Main";
                        $array[4]['data'] = $buddingAir5;
                        for ($i = 0; $i < count($buddingAir5); $i++) {
                            $arr_5[] = $buddingAir5[$i]->id;
                        }
                        $materail_unitTotal_sum5 = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr_5)
                            ->sum('materail_unitTotal');
                        $labour_unitTotal_sum5 = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr_5)
                            ->sum('labour_unitTotal');
                        $buddingAir_sum5 = DB::table('budding_airs')
                            ->where('project_id', '=', $project_id)
                            ->where('user_id', '=', $user_id)
                            ->where('type_work_sub', '=', 5)
                            ->sum('totalAll_sub');
                        $array[4]['materail_unitTotal'] = $materail_unitTotal_sum5;
                        $array[4]['labour_unitTotal'] = $labour_unitTotal_sum5;
                        $array[4]['totalAll'] = $buddingAir_sum5;
                    }
                    if ($value->status_duct == 2) {
                        $buddingAir4 = DB::table('budding_airs')
                            ->where('project_id', '=', $project_id)
                            ->where('user_id', '=', $user_id)
                            ->where('type_work_sub', '=', 4)
                            ->get();
                        foreach ($buddingAir4 as $keyB => $item){
                            $subBuddingAir4 = DB::table('sub_budding_airs')
                                ->where('budding_air_id', $item->id)
                                ->get();
                            $buddingAir4[$keyB]->sub_data = $subBuddingAir4;
                        }
                        $array[5]['type'] = "Duct Piping";
                        $array[5]['data'] = $buddingAir4;
                        for ($i = 0; $i < count($buddingAir4); $i++) {
                            $arr_4[] = $buddingAir4[$i]->id;
                        }
                        $materail_unitTotal_sum4 = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr_4)
                            ->sum('materail_unitTotal');
                        $labour_unitTotal_sum4 = DB::table('sub_budding_airs')
                            ->whereIn('budding_air_id', $arr_4)
                            ->sum('labour_unitTotal');
                        $buddingAir_sum4 = DB::table('budding_airs')
                            ->where('project_id', '=', $project_id)
                            ->where('user_id', '=', $user_id)
                            ->where('type_work_sub', '=', 4)
                            ->sum('totalAll_sub');
                        $array[5]['materail_unitTotal'] = $materail_unitTotal_sum4;
                        $array[5]['labour_unitTotal'] = $labour_unitTotal_sum4;
                        $array[5]['totalAll'] = $buddingAir_sum4;
                    }
                }



                //############## Query SQL ##############//

                $sheet->setAutoSize(true);
                $sheet->setAutoSize(array(
                    'A', 'B'
                ));
                $sheet->setFontFamily('Angsana New');
                $sheet->setFontSize(14);
                $sheet->mergeCells('A1:I1');
                $sheet->mergeCells('A2:I2');
                $sheet->setHeight(1, 80);
                $sheet->setWidth(array(
                    'A' => 20,
                    'B' => 70,
                    'C' => 20,
                    'D' => 20,
                    'E' => 30,
                    'F' => 30,
                    'G' => 30,
                    'H' => 30,
                    'I' => 35,
                ));

                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('image/logo.PNG')); //your image path
                $objDrawing->setCoordinates('B1');
                $objDrawing->setWorksheet($sheet);

                $sheet->row(2, array(
                    'QUOTATION (SUMMARY) (ราคา)'
                ));
                $sheet->row(2, function ($row) {
                    $row->setFontColor('#000000');
                    $row->setFontSize(16);
                    $row->setAlignment('center');
                    $row->setValignment('center');
                    $row->setFontWeight('bold');
                });


                $sheet->mergeCells('B3:E3');
                $sheet->row(3, array(
                    'เรื่อง : ', 'เสนอราคาค่าตั้งเครื่องปรับอากาศ', '', '', '', '',
                    '', ''
                ));
                $sheet->row(4, array(
                    'เรียน :', $profile->firstname . " " . $profile->lastname,
                    '', '', '', '',
                    '', ''
                ));
                $sheet->row(5, array(
                    'วันที่', '-', '', '', '', '',
                    ''
                ));
                $sheet->row(6, array(
                    'PROJECT : ', $project->project_name, '', '', '', '',
                    '', ''
                ));


                $sheet->cell('A8:I8', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->mergeCells('A8:I8');
                $sheet->row(8, array(
                    'BOQ', '', '', '', '', '', '',
                    '', ''
                ));
                $sheet->row(8, function ($row) {
                    $row->setAlignment('center');
                    $row->setValignment('center');
                });
                $sheet->setBorder('A8:I8', 'thin');
                $sheet->setBorder('A9:I9', 'thin');
                $sheet->setBorder('A10:I10', 'thin');
                $sheet->setBorder('A11:I11', 'thin');
                $sheet->cell('A11:I11', function ($cell) {
                    $cell->setBorder('none', 'none', 'thin', 'none');
                });
                $sheet->cell('I9:I11', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->row(9, array(
                    '', '', '', '', 'MATERIAL', '', 'LABOUR',
                    ' : ', ''
                ));
                //setBorder(T,R,B,L);
                $sheet->cell('A9:A11', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('E9:F9', function ($cell) {
                    $cell->setBorder('none', 'none', 'thin', 'none');
                });
                $sheet->mergeCells('E9:F9');
                $sheet->cell('G9:H9', function ($cell) {
                    $cell->setBorder('none', 'none', 'thin', 'none');
                });
                $sheet->mergeCells('G9:H9');
                $sheet->row(10, array(
                    'ITEM', 'DESCRIPTION', 'UNIT', 'QTY.', 'UNIT PRICE', 'TOTAL',
                    'UNIT PRICE', 'TOTAL', 'TOTAL'
                ));
                $sheet->row(11, array(
                    '', '', '', '', '(BAHT)', '',
                    '(BAHT)', '', '(BAHT)'
                ));
                $sheet->row(9, function ($row) {
                    $row->setAlignment('center');
                    $row->setValignment('center');
                });
                $sheet->row(10, function ($row) {
                    $row->setAlignment('center');
                    $row->setValignment('center');
                });
                $sheet->row(11, function ($row) {
                    $row->setAlignment('center');
                    $row->setValignment('center');
                });



                $sheet->row(12, array(
                    '', 'AIR CONDITIONING SYSTEM', '', '', '', '',
                    '', ''
                ));

                $c = 13;
                $num = 1;

                // List Data Array
                foreach ($array as $key => $value){
                    if($value['type'] != null){
                        $sheet->row($c, array(
                            $num, $value['type'], '', '', '',
                            '', '', ''
                        ));
                        $c = $c + 1;
                        $num = $num + 1;
                    }
                    foreach ($value['data'] as $keyB => $valueB){
                        if ($valueB->work_type_name != null){
//                            echo  "Work : ".$valueB->work_type_name."<br>";
                            $sheet->row($c, array(
                                '', $valueB->work_type_name, '', '', '',
                                '', '', ''
                            ));
                            $c = $c + 1;
                        }
                        if($valueB->sub_work_name != null){
//                            echo  "Sub TYPE : ".$valueB->sub_work_name."<br>";
                            $sheet->row($c, array(
                                '-', $valueB->sub_work_name, '', '', '',
                                '', '', ''
                            ));
                            $c = $c + 1;
                            foreach ($valueB->sub_data as $keyC => $valueC){
//                                echo  "- ".$valueC->ac_name."<br>";
                                $sheet->row($c, array(
                                    '', '-  '.$valueC->ac_name, strip_tags($valueC->u_name), $valueC->qty, number_format($valueC->materail_unitCost),
                                    number_format($valueC->materail_unitTotal), number_format($valueC->labour_unitCost), number_format($valueC->labour_unitTotal) ,number_format($valueC->totalCost)
                                ));
                                $sheet->cell('E'.$c.':I'.$c, function ($cell) {
                                    $cell->setAlignment('right');
                                    $cell->setValignment('right');
                                });
                                $c = $c + 1;
                            }
                        }
                    }
                    //                        echo "Total item | ".$value['materail_unitTotal']." | ".$value['labour_unitTotal']." | ".$value['totalAll']." | "."<br>";
                    //Item
                    $sheet->row($c, array(
                        '', 'Total Item 1', '', '', '',
                        number_format($value['materail_unitTotal'],2), '', number_format($value['labour_unitTotal'],2),
                        number_format($value['totalAll'],2)
                    ));
                    $sheet->cell('B'.$c, function ($cell) {
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('A'.$c.':D'.$c, function ($cell) {
                        $cell->setBorder('thin', 'thin', 'thin', 'thin');
                        $cell->setBackground('#E5ECED');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('E'.$c.':I'.$c, function ($cell) {
                        $cell->setBorder('thin', 'thin', 'thin', 'thin');
                        $cell->setBackground('#E5ECED');
                        $cell->setAlignment('right');
                        $cell->setValignment('right');
                    });
                    $c = $c + 1;
                }
                $sheet->cell('A12:A'.$c, function ($cell) {
                    $cell->setAlignment('center');
                    $cell->setValignment('center');
                });


                $sheet->cell('A12:A'.$c, function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('B12:B'.$c, function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('C12:C'.$c, function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('D12:D'.$c, function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('E12:E'.$c, function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('F12:F'.$c, function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('G12:G'.$c, function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('H12:H'.$c, function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('I12:I'.$c, function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });


                $sheet->row($c, array(
                    '', 'GRAND TOTAL ', '', '', '',
                    number_format($materail_unitTotal_sum,2), '', number_format($labour_unitTotal_sum,2),
                    number_format($sum,2)
                ));
                $sheet->cell('B'.$c, function ($cell) {
                    $cell->setAlignment('center');
                    $cell->setValignment('center');
                });
                $sheet->cell('A'.$c.':D'.$c, function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                    $cell->setBackground('#E5ECED');
                    $cell->setValignment('center');
                });
                $sheet->cell('E'.$c.':I'.$c, function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                    $cell->setBackground('#E5ECED');
                    $cell->setAlignment('right');
                    $cell->setValignment('right');
                });

            });

            $excel->sheet('Preliminaries', function ($sheet) use ($data , $user_id, $project_id) {
                //############## Query SQL ##############//
                // Detail Project
                $project = ProjectAuction::find($project_id);
                $profile = Profile::find($project->profile_id);
                $arr = [];
                $arr2 = [];
                $vat = 0;



                //Detail Preliminaries
                $prelim_air = DB::table('prelim_air')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->get();
                foreach ($prelim_air as $key => $item){
                    $preliminaries_datail = DB::table('preliminaries_datail')
                        ->where('prelim_id', $item->id)
                        ->get();
                    $prelim_air[$key]->sub_data = $preliminaries_datail;
                }
                for ($i = 0; $i < count($prelim_air); $i++) {
                    $arr_prelim[] = $prelim_air[$i]->id;
                }
                $preliminaries_Total = DB::table('preliminaries_datail')
                    ->whereIn('prelim_id', $arr_prelim)
                    ->sum('price_sum');


                //############## Query SQL ##############//

                $sheet->setAutoSize(true);
                $sheet->setAutoSize(array(
                    'A', 'B'
                ));
                $sheet->setFontFamily('Angsana New');
                $sheet->setFontSize(14);
                $sheet->mergeCells('A1:I1');
                $sheet->mergeCells('A2:I2');
                $sheet->setHeight(1, 80);
                $sheet->setWidth(array(
                    'A' => 10,
                    'B' => 45,
                    'C' => 25,
                    'D' => 25,
                    'E' => 35,
                    'F' => 35,
                    'G' => 60,
//                    'H' => 28,
//                    'I' => 18,
                ));

                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('image/logo.PNG')); //your image path
                $objDrawing->setCoordinates('B1');
                $objDrawing->setWorksheet($sheet);

                $sheet->row(2, array(
                    'Preliminaries'
                ));
                $sheet->row(2, function ($row) {
                    $row->setFontColor('#000000');
                    $row->setFontSize(16);
                    $row->setAlignment('center');
                    $row->setValignment('center');
                    $row->setFontWeight('bold');
                });


                $sheet->mergeCells('B3:E3');
                $sheet->row(3, array(
                    'เรื่อง : ', 'เสนอราคาค่าตั้งเครื่องปรับอากาศ', '', '', '', '',
                    '', ''
                ));
                $sheet->row(4, array(
                    'เรียน :', $profile->firstname . " " . $profile->lastname,
                    '', '', '', '',
                    '', ''
                ));
                $sheet->row(5, array(
                    'วันที่', '-', '', '', '', '',
                    ''
                ));
                $sheet->row(6, array(
                    'PROJECT : ', $project->project_name, '', '', '', '',
                    '', ''
                ));


                $sheet->cell('A8:G8', function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->mergeCells('A8:G8');
                $sheet->row(8, array(
                    'Preliminaries', '', '', '', '', '', '',
                    '', ''
                ));
                $sheet->row(8, function ($row) {
                    $row->setAlignment('center');
                    $row->setValignment('center');
                });
                $sheet->setBorder('A8:G8', 'thin');
                $sheet->setBorder('A9:G9', 'thin');
                $sheet->row(9, array(
                    'ลำดับ', 'รายการ', 'ปริมาณ' ,'หน่วย', 'ราคาต่อหน่อย', 'ราคารวม', 'หมายเหตุ',
                ));
                $sheet->row(9, function ($row) {
                    $row->setAlignment('center');
                    $row->setValignment('center');
                });
                $sheet->cell('A9:G9', function ($cell) {
                    $cell->setBorder('none', 'thin', 'thin', 'thin');
                });
                //setBorder(T,R,B,L);
                $c = 10;
                $num = 1;

                // List Data Array
                foreach ($prelim_air as $value){
                    $sheet->row($c, array(
                        $num, $value->preliminaries_name, '', '', ''
                    ));
                    $c = $c + 1;
                    $num = $num + 1;
                    foreach ($value->sub_data as $valueB){
                        $sheet->row($c, array(
                            '', '-  '.$valueB->list , $valueB->volume, $valueB->unit,
                            number_format($valueB->price_unit,2),
                            number_format($valueB->price_sum,2),$valueB->remark
                        ));

                        $sheet->cell('C'.$c.':D'.$c, function ($cell) {
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('E'.$c.':F'.$c, function ($cell) {
                            $cell->setAlignment('right');
                            $cell->setValignment('right');
                        });
                        $c = $c + 1;
                    }
                }

                $sheet->cell('A10:A'.$c, function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('B10:B'.$c, function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('C10:C'.$c, function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('D10:D'.$c, function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('E10:E'.$c, function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('F10:F'.$c, function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('G10:G'.$c, function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->row($c, array(
                    '', '', '', '', 'รวม',number_format($preliminaries_Total,2),''
                ));
                $sheet->mergeCells('A'.$c.':D'.$c);
                $sheet->cell('A'.$c.':G'.$c, function ($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                    $cell->setBackground('#E5ECED');
                    $cell->setAlignment('right');
                    $cell->setValignment('right');
                });
            });

        })->export('xlsx');
//        $myFile = $myFile->string('xls'); //change xlsx for the format you want, default is xls
//        $filename = 'ใบเสนอราคาค่าติดตั้งเครื่องปรับอากาศ_' . date('d/m/y') . '-' . date('h:i', time());
//        $response = array(
//            'name' => "$filename", //no extention needed
//            'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64," . base64_encode($myFile) //mime type of used format
//        );
//        return response()->json($response);
    }

    public function submitBudding(Request $request)
    {
        $now = new DateTime();
        // dd('ok');
        DB::table('project_auctions_air')
            ->where('project_id',$request->get('project_id'))
            ->update([
                'status_budding' => 1 ,
                'updated_at' => $now ,
            ]);
        DB::table('project_auctions_air')
            ->where('id',$request->get('id'))
            ->update([
               'status_budding' => 2
            ]);

        $budding = DB::table('project_auctions_air')
            ->where('id',$request->get('id'))
            ->first();


        // UPDATA Project Auctions


        // dd($budding);

        return response()->json([
            'success' => 'success',
        ]);

    }

    public function createPDFBudding(Request $request)
    {

    }

    function generateAlphabet($na)
    {
        $sa = "";
        while ($na >= 0) {
            $sa = chr($na % 26 + 65) . $sa;
            $na = floor($na / 26) - 1;
        }
        return $sa;
    }

    public function test()
    {

        $user_id = 1;
        $project_id = 5;
        $sum = 0;
        $data2 = DB::table('project_auctions_air')
            ->where('project_id', '=', $project_id)
            ->where('user_id', '=', $user_id)
            ->get();
        $array = [];
        foreach ($data2 as $key => $value) {
            if ($value->status_machine == 2) {
                $buddingAir = DB::table('budding_airs')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->where('type_work_sub', '=', 1)
                    ->get();
                for ($i = 0; $i < count($buddingAir); $i++) {
                    $arr1[] = $buddingAir[$i]->id;
                }
                $materail_unitCost_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr1)
                    ->sum('materail_unitCost');
                $materail_unitTotal_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr1)
                    ->sum('materail_unitTotal');

                $labour_unitCost_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr1)
                    ->sum('labour_unitCost');
                $labour_unitTotal_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr1)
                    ->sum('labour_unitTotal');

                $buddingAir_sum = DB::table('budding_airs')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->where('type_work_sub', '=', 1)
                    ->sum('totalAll_sub');
                $datail_arr1 = [
                    'name' => 'Install Machine',
                    'qty' => 1 ,
                    'unit' => 'Lot' ,
                    'materail_unitCost' => $materail_unitCost_sum ,
                    'materail_unitTotal' => $materail_unitTotal_sum ,
                    'labour_unitCost' => $labour_unitCost_sum ,
                    'labour_unitTotal' => $labour_unitTotal_sum ,
                    'total' => $buddingAir_sum,
                ];
                $array[1] = $datail_arr1;
                $sum += $buddingAir_sum;
            }
            if ($value->status_piping == 2) {
                $buddingAir = DB::table('budding_airs')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->where('type_work_sub', '=', 2)
                    ->get();
                for ($i = 0; $i < count($buddingAir); $i++) {
                    $arr2[] = $buddingAir[$i]->id;
                }
                $materail_unitCost_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr2)
                    ->sum('materail_unitCost');
                $materail_unitTotal_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr2)
                    ->sum('materail_unitTotal');

                $labour_unitCost_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr2)
                    ->sum('labour_unitCost');
                $labour_unitTotal_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr2)
                    ->sum('labour_unitTotal');

                $buddingAir_sum = DB::table('budding_airs')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->where('type_work_sub', '=', 2)
                    ->sum('totalAll_sub');
                $datail_arr2 = [
                    'name' => 'piping',
                    'qty' => 1 ,
                    'unit' => 'Lot' ,
                    'materail_unitCost' => $materail_unitCost_sum ,
                    'materail_unitTotal' => $materail_unitTotal_sum ,
                    'labour_unitCost' => $labour_unitCost_sum ,
                    'labour_unitTotal' => $labour_unitTotal_sum ,
                    'total' => $buddingAir_sum,
                ];
                $array[2] = $datail_arr2;
                $sum += $buddingAir_sum;
            }
            if ($value->status_control == 2) {
                $buddingAir = DB::table('budding_airs')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->where('type_work_sub', '=', 3)
                    ->get();
                for ($i = 0; $i < count($buddingAir); $i++) {
                    $arr3[] = $buddingAir[$i]->id;
                }
                $materail_unitCost_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr3)
                    ->sum('materail_unitCost');
                $materail_unitTotal_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr3)
                    ->sum('materail_unitTotal');

                $labour_unitCost_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr3)
                    ->sum('labour_unitCost');
                $labour_unitTotal_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr3)
                    ->sum('labour_unitTotal');

                $buddingAir_sum = DB::table('budding_airs')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->where('type_work_sub', '=', 3)
                    ->sum('totalAll_sub');
                $datail_arr3 = [
                    'name' => 'control',
                    'qty' => 1 ,
                    'unit' => 'Lot' ,
                    'materail_unitCost' => $materail_unitCost_sum ,
                    'materail_unitTotal' => $materail_unitTotal_sum ,
                    'labour_unitCost' => $labour_unitCost_sum ,
                    'labour_unitTotal' => $labour_unitTotal_sum ,
                    'total' => $buddingAir_sum,
                ];
                $array[3] = $datail_arr3;
                $sum += $buddingAir_sum;
            }
            if ($value->status_main == 2) {
                $buddingAir = DB::table('budding_airs')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->where('type_work_sub', '=', 5)
                    ->get();
                for ($i = 0; $i < count($buddingAir); $i++) {
                    $arr5[] = $buddingAir[$i]->id;
                }
                $materail_unitCost_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr5)
                    ->sum('materail_unitCost');
                $materail_unitTotal_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr5)
                    ->sum('materail_unitTotal');

                $labour_unitCost_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr5)
                    ->sum('labour_unitCost');
                $labour_unitTotal_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr5)
                    ->sum('labour_unitTotal');

                $buddingAir_sum = DB::table('budding_airs')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->where('type_work_sub', '=', 5)
                    ->sum('totalAll_sub');
                $datail_arr5 = [
                    'name' => 'main',
                    'qty' => 1 ,
                    'unit' => 'Lot' ,
                    'materail_unitCost' => $materail_unitCost_sum ,
                    'materail_unitTotal' => $materail_unitTotal_sum ,
                    'labour_unitCost' => $labour_unitCost_sum ,
                    'labour_unitTotal' => $labour_unitTotal_sum ,
                    'total' => $buddingAir_sum,
                ];
                $array[4] = $datail_arr5;
                $sum += $buddingAir_sum;
            }
            if ($value->status_duct == 2) {
                $buddingAir = DB::table('budding_airs')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->where('type_work_sub', '=', 4)
                    ->get();
                for ($i = 0; $i < count($buddingAir); $i++) {
                    $arr4[] = $buddingAir[$i]->id;
                }
                $materail_unitCost_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr4)
                    ->sum('materail_unitCost');
                $materail_unitTotal_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr4)
                    ->sum('materail_unitTotal');

                $labour_unitCost_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr4)
                    ->sum('labour_unitCost');
                $labour_unitTotal_sum = DB::table('sub_budding_airs')
                    ->whereIn('budding_air_id', $arr4)
                    ->sum('labour_unitTotal');

                $buddingAir_sum = DB::table('budding_airs')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->where('type_work_sub', '=', 4)
                    ->sum('totalAll_sub');
                $datail_arr4 = [
                    'name' => 'duct piping',
                    'qty' => 1 ,
                    'unit' => 'Lot' ,
                    'materail_unitCost' => $materail_unitCost_sum ,
                    'materail_unitTotal' => $materail_unitTotal_sum ,
                    'labour_unitCost' => $labour_unitCost_sum ,
                    'labour_unitTotal' => $labour_unitTotal_sum ,
                    'total' => $buddingAir_sum,
                ];
                $array[5] = $datail_arr4;
                $sum += $buddingAir_sum;
            }
            if ($value->status_prelim == 2) {
                $prelim_air = DB::table('prelim_air')
                    ->where('project_id', '=', $project_id)
                    ->where('user_id', '=', $user_id)
                    ->get();
                for ($i = 0; $i < count($prelim_air); $i++) {
                    $arr6[] = $prelim_air[$i]->id;
                }
                $preliminaries_datail = DB::table('preliminaries_datail')
                    ->whereIn('id', $arr6)
                    ->sum('price_sum');
                $arr = [
                    'name' => 'prelim',
                    'qty' => '' ,
                    'unit' => '' ,
                    'materail_unitCost' => '' ,
                    'materail_unitTotal' => '' ,
                    'labour_unitCost' => '' ,
                    'labour_unitTotal' => '' ,
                    'total' => (int)$preliminaries_datail,
                ];
                $array[6] = $arr;
                $sum += $preliminaries_datail;
            }
        }
        echo $sum;
        foreach ($array as $value){
            echo  $value['name']." ".$value['qty']." ".$value['total']."<br>";
        }
        dd($array);

    }

    public function test2()
    {
        $user_id = 1;
        $project_id = 5;
        $array = [];
        $i = 0;
        $data = DB::table('project_auctions_air')
            ->where('project_id', '=', $project_id)
            ->where('user_id', '=', $user_id)
            ->get();


        // Preliminaries
        $prelim_air = DB::table('prelim_air')
            ->where('project_id', '=', $project_id)
            ->where('user_id', '=', $user_id)
            ->get();
        foreach ($prelim_air as $key => $item){
            $preliminaries_datail = DB::table('preliminaries_datail')
                ->where('prelim_id', $item->id)
                ->get();
            $prelim_air[$key]->sub_data = $preliminaries_datail;
        }
        for ($i = 0; $i < count($prelim_air); $i++) {
            $arr_prelim2[] = $prelim_air[$i]->id;
        }
        $preliminaries_datail = DB::table('preliminaries_datail')
            ->whereIn('prelim_id', $arr_prelim2)
            ->sum('price_sum');
        $prelim_air[$key]->sub_data = $preliminaries_datail;
        for ($i = 0; $i < count($prelim_air); $i++) {
            $arr_prelim[] = $prelim_air[$i]->id;
        }
        $preliminaries_sum = DB::table('preliminaries_datail')
            ->whereIn('prelim_id', $arr_prelim)
            ->sum('price_sum');

        dd($prelim_air);




//        foreach ($data as $key => $value) {
//            if ($value->status_machine == 2) {
//                $buddingAir1 = DB::table('budding_airs')
//                    ->where('project_id', '=', $project_id)
//                    ->where('user_id', '=', $user_id)
//                    ->where('type_work_sub', '=', 1)
//                    ->get();
//                foreach ($buddingAir1 as $keyB => $item){
//                    $subBuddingAir1 = DB::table('sub_budding_airs')
//                        ->where('budding_air_id', $item->id)
//                        ->get();
//                    $buddingAir1[$keyB]->sub_data = $subBuddingAir1;
//                }
//                $array[1]['type'] = "Install Machine";
//                $array[1]['data'] = $buddingAir1;
//                for ($i = 0; $i < count($buddingAir1); $i++) {
//                    $arr_1[] = $buddingAir1[$i]->id;
//                }
//                $materail_unitTotal_sum1 = DB::table('sub_budding_airs')
//                    ->whereIn('budding_air_id', $arr_1)
//                    ->sum('materail_unitTotal');
//                $labour_unitTotal_sum1 = DB::table('sub_budding_airs')
//                    ->whereIn('budding_air_id', $arr_1)
//                    ->sum('labour_unitTotal');
//                $buddingAir_sum1 = DB::table('budding_airs')
//                    ->where('project_id', '=', $project_id)
//                    ->where('user_id', '=', $user_id)
//                    ->where('type_work_sub', '=', 1)
//                    ->sum('totalAll_sub');
//                $array[1]['materail_unitTotal'] = $materail_unitTotal_sum1;
//                $array[1]['labour_unitTotal'] = $labour_unitTotal_sum1;
//                $array[1]['totalAll'] = $buddingAir_sum1;
//            }
//            if ($value->status_piping == 2) {
//                $buddingAir2 = DB::table('budding_airs')
//                    ->where('project_id', '=', $project_id)
//                    ->where('user_id', '=', $user_id)
//                    ->where('type_work_sub', '=', 2)
//                    ->get();
//                foreach ($buddingAir2 as $keyB => $item){
//                    $subBuddingAir2 = DB::table('sub_budding_airs')
//                        ->where('budding_air_id', $item->id)
//                        ->get();
//                    $buddingAir2[$keyB]->sub_data = $subBuddingAir2;
//                }
//                $array[2]['type'] = "Piping";
//                $array[2]['data'] = $buddingAir2;
//                for ($i = 0; $i < count($buddingAir2); $i++) {
//                    $arr_2[] = $buddingAir2[$i]->id;
//                }
//                $materail_unitTotal_sum2 = DB::table('sub_budding_airs')
//                    ->whereIn('budding_air_id', $arr_2)
//                    ->sum('materail_unitTotal');
//                $labour_unitTotal_sum2 = DB::table('sub_budding_airs')
//                    ->whereIn('budding_air_id', $arr_2)
//                    ->sum('labour_unitTotal');
//                $buddingAir_sum2 = DB::table('budding_airs')
//                    ->where('project_id', '=', $project_id)
//                    ->where('user_id', '=', $user_id)
//                    ->where('type_work_sub', '=', 2)
//                    ->sum('totalAll_sub');
//                $array[2]['materail_unitTotal'] = $materail_unitTotal_sum2;
//                $array[2]['labour_unitTotal'] = $labour_unitTotal_sum2;
//                $array[2]['totalAll'] = $buddingAir_sum2;
//            }
//            if ($value->status_control == 2) {
//                $buddingAir3 = DB::table('budding_airs')
//                    ->where('project_id', '=', $project_id)
//                    ->where('user_id', '=', $user_id)
//                    ->where('type_work_sub', '=', 3)
//                    ->get();
//                foreach ($buddingAir3 as $keyB => $item){
//                    $subBuddingAir3 = DB::table('sub_budding_airs')
//                        ->where('budding_air_id', $item->id)
//                        ->get();
//                    $buddingAir3[$keyB]->sub_data = $subBuddingAir3;
//                }
//                $array[3]['type'] = "Control";
//                $array[3]['data'] = $buddingAir3;
//                for ($i = 0; $i < count($buddingAir3); $i++) {
//                    $arr_3[] = $buddingAir3[$i]->id;
//                }
//                $materail_unitTotal_sum3 = DB::table('sub_budding_airs')
//                    ->whereIn('budding_air_id', $arr_3)
//                    ->sum('materail_unitTotal');
//                $labour_unitTotal_sum3 = DB::table('sub_budding_airs')
//                    ->whereIn('budding_air_id', $arr_3)
//                    ->sum('labour_unitTotal');
//                $buddingAir_sum3 = DB::table('budding_airs')
//                    ->where('project_id', '=', $project_id)
//                    ->where('user_id', '=', $user_id)
//                    ->where('type_work_sub', '=', 3)
//                    ->sum('totalAll_sub');
//                $array[3]['materail_unitTotal'] = $materail_unitTotal_sum3;
//                $array[3]['labour_unitTotal'] = $labour_unitTotal_sum3;
//                $array[3]['totalAll'] = $buddingAir_sum3;
//            }
//            if ($value->status_main == 2) {
//                $buddingAir5 = DB::table('budding_airs')
//                    ->where('project_id', '=', $project_id)
//                    ->where('user_id', '=', $user_id)
//                    ->where('type_work_sub', '=', 5)
//                    ->get();
//                foreach ($buddingAir5 as $keyB => $item){
//                    $subBuddingAir5 = DB::table('sub_budding_airs')
//                        ->where('budding_air_id', $item->id)
//                        ->get();
//                    $buddingAir5[$keyB]->sub_data = $subBuddingAir5;
//                }
//                $array[4]['type'] = "Main";
//                $array[4]['data'] = $buddingAir5;
//                for ($i = 0; $i < count($buddingAir5); $i++) {
//                    $arr_5[] = $buddingAir5[$i]->id;
//                }
//                $materail_unitTotal_sum5 = DB::table('sub_budding_airs')
//                    ->whereIn('budding_air_id', $arr_5)
//                    ->sum('materail_unitTotal');
//                $labour_unitTotal_sum5 = DB::table('sub_budding_airs')
//                    ->whereIn('budding_air_id', $arr_5)
//                    ->sum('labour_unitTotal');
//                $buddingAir_sum5 = DB::table('budding_airs')
//                    ->where('project_id', '=', $project_id)
//                    ->where('user_id', '=', $user_id)
//                    ->where('type_work_sub', '=', 5)
//                    ->sum('totalAll_sub');
//                $array[4]['materail_unitTotal'] = $materail_unitTotal_sum5;
//                $array[4]['labour_unitTotal'] = $labour_unitTotal_sum5;
//                $array[4]['totalAll'] = $buddingAir_sum5;
//            }
//            if ($value->status_duct == 2) {
//                $buddingAir4 = DB::table('budding_airs')
//                    ->where('project_id', '=', $project_id)
//                    ->where('user_id', '=', $user_id)
//                    ->where('type_work_sub', '=', 4)
//                    ->get();
//                foreach ($buddingAir4 as $keyB => $item){
//                    $subBuddingAir4 = DB::table('sub_budding_airs')
//                        ->where('budding_air_id', $item->id)
//                        ->get();
//                    $buddingAir4[$keyB]->sub_data = $subBuddingAir4;
//                }
//                $array[5]['type'] = "Duct Piping";
//                $array[5]['data'] = $buddingAir4;
//                for ($i = 0; $i < count($buddingAir4); $i++) {
//                    $arr_4[] = $buddingAir4[$i]->id;
//                }
//                $materail_unitTotal_sum4 = DB::table('sub_budding_airs')
//                    ->whereIn('budding_air_id', $arr_4)
//                    ->sum('materail_unitTotal');
//                $labour_unitTotal_sum4 = DB::table('sub_budding_airs')
//                    ->whereIn('budding_air_id', $arr_4)
//                    ->sum('labour_unitTotal');
//                $buddingAir_sum4 = DB::table('budding_airs')
//                    ->where('project_id', '=', $project_id)
//                    ->where('user_id', '=', $user_id)
//                    ->where('type_work_sub', '=', 4)
//                    ->sum('totalAll_sub');
//                $array[5]['materail_unitTotal'] = $materail_unitTotal_sum4;
//                $array[5]['labour_unitTotal'] = $labour_unitTotal_sum4;
//                $array[5]['totalAll'] = $buddingAir_sum4;
//            }
//        }
//
//        echo "<br><br><br><br>";
//        foreach ($array as $key => $value){
//            echo "Type : ".$value['type'] ."<br>";
//            foreach ($value['data'] as $keyB => $valueB){
////                echo "[".$key."] [".$keyB."]"."<br>";
//                if ($valueB->work_type_name != null){
//                    echo  "Work : ".$valueB->work_type_name."<br>";
//                }
//                if($valueB->sub_work_name != null){
//                    echo  "Sub TYPE : ".$valueB->sub_work_name."<br>";
//                    foreach ($valueB->sub_data as $keyC => $valueC){
//                        echo  "- ".$valueC->ac_name."<br>";
//                    }
//                }
//            }
//            echo "Total item | ".$value['materail_unitTotal']." | ".$value['labour_unitTotal']." | ".$value['totalAll']." | "."<br>";
//            echo "--------------------------"."<br>";
//        }


//        dd($array);


    }
}
