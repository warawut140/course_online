<?php

namespace App\Http\Controllers\frontend;

use App\Models\Profile;
use App\Models\ProjectAuction;
use App\Models\ProjectAuctionGallery;
use App\Models\ProjectAuctionWork;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PlannerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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
        $now = new DateTime();
        $type = $request->type_planner ;
        $project_id = $request->project_id ;
        if($type == 1){
            for ($i = 1;$i <= 19;$i++){
              $startDate =   ($request->startdate[$i] != null)?$request->startdate[$i]:null;
              $enddDate =   ($request->enddate[$i] != null)?$request->enddate[$i]:null;
                if($startDate != null && $enddDate != null){
                    DB::table('planner_project')->insert([
                        'planner_type_id' => $i,
                        'project_id' => $project_id,
                        'user_id' => Auth::user()->id,
                        'planner_startdate' => $startDate,
                        'planner_enddate' => $enddDate,
                        'type_data' => $type,
                        'created_at' => $now,
                        'updated_at' => null,
                    ]);
                    $startDate = null;
                    $enddDate = null;
                }
            }
            Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
            return redirect('planner/'.$project_id);
        }elseif ($type == 2){
            for ($i = 1;$i <= 19;$i++){
                $startDate =   ($request->startdate[$i] != null)?$request->startdate[$i]:null;
                $enddDate =   ($request->enddate[$i] != null)?$request->enddate[$i]:null;
                if($startDate != null && $enddDate != null){
                    DB::table('planner_project')->insert([
                        'planner_type_id' => $i,
                        'project_id' => $project_id,
                        'user_id' => Auth::user()->id,
                        'planner_startdate' => $startDate,
                        'planner_enddate' => $enddDate,
                        'type_data' => $type,
                        'created_at' => $now,
                        'updated_at' => null,
                    ]);
                    $startDate = null;
                    $enddDate = null;
                }
            }
            Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
            return redirect('planner/'.$project_id);
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
        //================= Master Data =================//
        $profile_bit_coins = Profile::join('bit_coins', 'bit_coins.profile_id', 'profiles.id')
            ->select('profiles.*', 'bit_coins.coins')
            ->where('profiles.user_id', '=', Auth::user()->id)
            ->first();

        $projectAuction = ProjectAuction::join('price_ranges', 'price_ranges.id', '=', 'project_auctions.price_ranges_id')
            ->join('provinces', 'provinces.PROVINCE_ID', '=', 'project_auctions.provinces_id')
            ->join('amphures', 'amphures.AMPHUR_ID', '=', 'project_auctions.amphures_id')
            ->join('districts', 'districts.DISTRICT_ID', '=', 'project_auctions.districts_id')
            ->join('users', 'users.id', '=', 'project_auctions.user_id')
            ->join('type_project_auctions', 'type_project_auctions.id', '=', 'project_auctions.type_project_id')
            ->join('profiles', 'profiles.id', '=', 'project_auctions.profile_id')
            ->select('project_auctions.*', 'price_ranges.price',
                'provinces.PROVINCE_NAME as provinces',
                'amphures.AMPHUR_NAME as amphures',
                'districts.DISTRICT_NAME as districts',
                'users.name as username',
                'type_project_auctions.name as type_project',
                'profiles.firstname', 'profiles.lastname', 'profiles.image_profile')
            ->where('project_auctions.id', '=', $id)
            ->first();
        $projectAuctionWorks = ProjectAuctionWork::join('works', 'works.id', '=', 'project_auction_works.work_id')
            ->select('works.name as work_name', 'project_auction_works.*')
            ->where('project_auction_works.project_id', '=', $id)
            ->get();
        $projectAuctionGalleries = ProjectAuctionGallery::where('project_id', '=', $id)->get();
        //================= Master Data =================//
        $budding_air_user = DB::table('project_auctions_air')
            ->where('project_id','=',$id)
            ->where('status_budding','=',2)
            ->first();


        if(Auth::user()->id == $projectAuction->user_id){
            // ผู้ว่าจ้าง
            // Query Data
            $planner_data = DB::table('planner_project')
                ->join('planner_type','planner_project.planner_type_id','=','planner_type.id')
                ->select('planner_type.planner_type','planner_type.planner_name', 'planner_project.*',
                    DB::raw('(CASE WHEN planner_project.planner_update = 1 THEN "ส่งงานเรียบร้อย" 
                    WHEN  planner_project.planner_update = 0 && planner_project.planner_enddate < "' .date('Y-m-d'). '" THEN "แผนงานเกินกำหนด" 
                    ELSE  "ยังไม่เกินกำหนด" END) AS is_date'))
                ->where('project_id','=',$id)
                ->where('planner_startdate','<=',Carbon::now())
                ->orderBy('planner_project.planner_type_id','DESC')
                ->get();

            $budding_success = DB::table('budding_boq')
                ->where('project_id','=',$id)
                ->first();
            return view('frontend.planner',[
                'type_contract' => 0 ,
                'id' => $id ,
                'projectAuction' => $projectAuction,
                'projectAuctionWorks' => $projectAuctionWorks,
                'projectAuctionGalleries' => $projectAuctionGalleries,
                'planner_data' => $planner_data ,
                'budding_success' => $budding_success
            ]);
        }elseif (Auth::user()->id == $budding_air_user->user_id){
            // ผู้รับเหมา
            $planner_project1 = DB::table('planner_project')
                ->where('type_data','=','1')
                ->where('project_id','=',$id)
                ->get();
            $planner_project2 = DB::table('planner_project')
                ->where('type_data','=','2')
                ->where('project_id','=',$id)
                ->get();
            $check_pp1 = (count($planner_project1) > 0)?1:0;
            $check_pp2 = (count($planner_project2) > 0)?1:0;

            // Query Data
            $planner_data = DB::table('planner_project')
                ->join('planner_type','planner_project.planner_type_id','=','planner_type.id')
                ->select('planner_type.planner_type','planner_type.planner_name', 'planner_project.*',
                    DB::raw('(CASE WHEN planner_project.planner_update = 1 THEN "ส่งงานเรียบร้อย" 
                    WHEN  planner_project.planner_update = 0 && planner_project.planner_enddate < "' .date('Y-m-d'). '" THEN "แผนงานเกินกำหนด" 
                    ELSE  "ยังไม่เกินกำหนด" END) AS is_date'))
                ->where('project_id','=',$id)
                ->where('planner_startdate','<=',Carbon::now())
                ->orderBy('planner_project.planner_type_id','DESC')
                ->get();

            return view('frontend.planner',[
                'type_contract' => 1 ,
                'id' => $id ,
                'projectAuction' => $projectAuction,
                'projectAuctionWorks' => $projectAuctionWorks,
                'projectAuctionGalleries' => $projectAuctionGalleries,
                'check_pp1' => $check_pp1,
                'check_pp2' => $check_pp2,
                'planner_data' => $planner_data
            ]);
        }else {
            Session::flash('warning', 'ไม่มีสิทธิ์เข้าถึง การใช้งาน!');
            return redirect('projectauction/' . $id);
        }
    }

    public function plannerUpdate($id , $project_id)
    {
        DB::table('planner_project')
            ->where('id','=',$id)
            ->where('project_id','=',$project_id)
            ->update([
            'planner_update' => 1
        ]);
        Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
        return redirect('planner/'.$project_id);
    }

    public function jobUpdate($project_id)
    {
        DB::table('budding_boq')
            ->where('project_id','=',$project_id)
            ->update([
                'budding_success' => 1
            ]);
        Session::flash('status', 'บันทึกข้อมูลปิดโครงการ เรียบร้อย !');
        return redirect('planner/'.$project_id);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
