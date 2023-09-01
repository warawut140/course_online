<?php

namespace App\Http\Controllers\Api;

use App\Models\Air_Conditioning;
use App\Models\QuotationPercentage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProcessQuotationController extends Controller
{
    public function processData(Request $request)
    {

        $price_air = Air_Conditioning::find($request->get('air_id'));
        $percent = QuotationPercentage::where('profile_id', '=', $request->get('profile_id'))
            ->where('percent_id', '=', $request->get('percent_id'))
            ->where('project_auctions_id', '=', $request->get('project_auctions_id'))
            ->first();


        $qty = $request->get('qty');  //1
        $a = $percent->cost_of_offer; //7
        $b = $percent->labor_cost_offer; //8
        $c = $price_air->price;  //c
        $d = $percent->cost_of_invest; //d
        $f = $percent->labor_cost_invest; //f
        $g = $price_air->price; //g


        $materail_unitCost_invest = $c *($qty - $d);  //9  : c*(1 - d)
        $materail_unitTotal_invest = $qty * $materail_unitCost_invest;  //10  : 1*9
        $labour_unitCost_invest = $f * ($qty - $g);  //11  : f*(1-g)
        $labour_unitTotal_invest = $qty * $labour_unitCost_invest;  //12  : 1*11
        $totalCost_invest = $materail_unitTotal_invest + $labour_unitTotal_invest;  //13  : 10 + 12


        $materail_unitCost = $a * $materail_unitCost_invest;  //2  : 7*9
        $materail_unitTotal = $qty * $materail_unitCost;  //3  : 1*2
        $labour_unitCost = $b * $labour_unitCost_invest;  //4  : 8*11
        $labour_unitTotal = $qty * $labour_unitCost;  //5  : 1*4
        $totalCost = $materail_unitTotal + $labour_unitTotal;  //6  : 3+5

        $totalCost_all = $totalCost + $totalCost_invest;

        return response()->json([
            'method' => 'processData',
            'qty' => $qty,
            'a' => $a,
            'b' => $b,
            'c' => $c,
            'd' => $d,
            'f' => $f,
            'g' => $g,
            'materail_unitCost' =>  $materail_unitCost,
            'materail_unitTotal' =>  $materail_unitTotal,
            'labour_unitCost' =>  $labour_unitCost,
            'labour_unitTotal' =>  $labour_unitTotal,
            'totalCost' =>  $totalCost,
            'materail_unitCost_invest' =>  $materail_unitCost_invest,
            'materail_unitTotal_invest' =>  $materail_unitTotal_invest,
            'labour_unitCost_invest' =>  $labour_unitCost_invest,
            'labour_unitTotal_invest' =>  $labour_unitTotal_invest,
            'totalCost_invest' =>  $totalCost_invest,
            'totalCost_all' =>  $totalCost_all,

        ]);

    }
}
