<?php

namespace App\Http\Controllers\Api;

use App\Models\ProjectAuction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProjectAuctionController extends Controller
{
    public function index()
    {
        $projectAuction = ProjectAuction::join('price_ranges', 'price_ranges.id', '=', 'project_auctions.price_ranges_id')
            ->join('provinces', 'provinces.PROVINCE_ID', '=', 'project_auctions.provinces_id')
            ->join('amphures', 'amphures.AMPHUR_ID', '=', 'project_auctions.amphures_id')
            ->join('districts', 'districts.DISTRICT_ID', '=', 'project_auctions.districts_id')
            ->join('users', 'users.id', '=', 'project_auctions.user_id')
            ->join('type_project_auctions', 'type_project_auctions.id', '=', 'project_auctions.type_project_id')
            ->select('project_auctions.*', 'price_ranges.price',
                'provinces.PROVINCE_NAME as provinces',
                'amphures.AMPHUR_NAME as amphures',
                'districts.DISTRICT_NAME as districts',
                'users.name as username', 'type_project_auctions.name as type_project')
            ->get();
        return response()->json($projectAuction);
    }

    public function countDown(Request $request,$id)
    {
        //    dd($request->get('project_id'));
        $projectAuction = ProjectAuction::where('id','=',$request->get('project_id'))->first();
        $projectAuction->countDown = 1 ;
        $projectAuction->update();
        return response()->json([
            'projectAuction' => $projectAuction,
            'success' => 'success',
        ]);
    }


}
