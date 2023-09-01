<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\ProjectAuction;
use App\Models\ProjectAuctionGallery;
use App\Models\ProjectAuctionWork;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAirController extends Controller
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
        return view('backend.air.index',[
            'view' => 1
        ]);
//        return view('backend.coming-soon');
    }

    public function approve()
    {
        $status_follow = DB::table('project_auctions_air')
            ->where('status_phungngan_Follow','=',2)
            ->get();

        $arr = [];
        for ($i = 0 ; $i < count($status_follow);$i++){
            $arr[] = $status_follow[$i]->project_id;
        }
        $projectFollow = ProjectAuction::join('profiles','project_auctions.user_id','=','profiles.id')
            ->select('project_auctions.id','project_auctions.project_name','project_auctions.details',
                'project_auctions.created_at','project_auctions.user_id as owner_id' ,
                'profiles.firstname as owner_firstname' , 'profiles.lastname as owner_lastname',
                'profiles.image_profile')
            ->whereIn('project_auctions.id',$arr)
            ->get();
        foreach ($projectFollow as $key => $value){
            $data = $projectAuctionWorks = ProjectAuctionWork::join('works', 'works.id', '=', 'project_auction_works.work_id')
                ->select('works.name as work_name', 'project_auction_works.*')
                ->where('project_auction_works.project_id', '=', $value->id)
                ->get();
            $projectFollow[$key]->pj_work = $data ;
            if(count($data) > 1){
                $projectFollow[$key]->type_pj_work = 5 ;
            }else{
                $projectFollow[$key]->type_pj_work = $data[0]->work_id ;
            }
        }
//        dd($status_follow);
        return view('backend.air.index',[
            'view' => 2 ,
            'projectFollow' => $projectFollow
        ]);
//        return view('backend.coming-soon');
    }


    public function contract($id)
    {
        //================= Master Data =================//
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


        // ผู้ว่าจ้าง
        //Profile
        $profile = Profile::where('user_id','=',$budding_air_user->user_id)->first();
        $budding_air_user->profile_id = $profile->id;
        $budding_air_user->fullname = $profile->firstname." ".$profile->lastname;
        $budding_air_user->company = $profile->company;
        $budding_air_user->tel = $profile->tel;

        $buddingAir = DB::table('budding_airs')
            ->where('project_id', '=', $budding_air_user->project_id)
            ->where('user_id', '=', $budding_air_user->user_id)
            ->get();
        for ($i = 0; $i < count($buddingAir); $i++) {
            $arr[] = $buddingAir[$i]->id;
        }
        $buddingAir_sum = DB::table('budding_airs')
            ->where('project_id', '=', $budding_air_user->project_id)
            ->where('user_id', '=', $budding_air_user->user_id)
            ->sum('totalAll_sub');

        // Preliminaries
        $prelim_air = DB::table('prelim_air')
            ->where('project_id', '=', $budding_air_user->project_id)
            ->where('user_id', '=', $budding_air_user->user_id)
            ->get();
        for ($i = 0; $i < count($prelim_air); $i++) {
            $arr2[] = $prelim_air[$i]->id;
        }
        $preliminaries_datail = DB::table('preliminaries_datail')
            ->whereIn('prelim_id', $arr2)
            ->sum('price_sum');

        // Over Head
        $overhead = DB::table('budding_overhead')
            ->where('project_id', '=', $budding_air_user->project_id)
            ->where('user_id', '=', $budding_air_user->user_id)
            ->first();

        $sum = $buddingAir_sum + $preliminaries_datail;
        $overhead_sum = ($overhead != null) ? $overhead->sum_overhead : 0;
        $total = (double)$sum + (double)$overhead_sum;
        $budding_air_user->total = $total;

        //startdate
        list($year,$month,$day) = explode('-',date('Y-m-d',strtotime($projectAuction->startdate)));
        if($day <10){
            $day = substr($day,1,1);
        }
        $thMonth = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน",
            "กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        if($month<10){
            $month = substr($month,1,1);
        }
        $year +=543;
        $budding_air_user->startdate = $day." ".$thMonth[$month-1]." ".$year;
        //enddate
        list($year,$month,$day) = explode('-',date('Y-m-d',strtotime($projectAuction->enddate)));
        if($day <10){
            $day = substr($day,1,1);
        }

        $thMonth = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน",
            "กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        if($month<10){
            $month = substr($month,1,1);
        }
        $year +=543;
        $budding_air_user->enddate = $day." ".$thMonth[$month-1]." ".$year;
        //Date Budding
        list($year,$month,$day) = explode('-',date('Y-m-d',strtotime($budding_air_user->updated_at)));
        if($day <10){
            $day = substr($day,1,1);
        }

        $thMonth = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน",
            "กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        if($month<10){
            $month = substr($month,1,1);
        }
        $year +=543;
        $budding_air_user->budding_date = $day." ".$thMonth[$month-1]." ".$year;

        //Number BOQ
        $budding_boq =  DB::table('budding_boq')
            ->where('project_id', '=', $budding_air_user->project_id)
            ->where('user_id', '=', $budding_air_user->user_id)
            ->first();

        if($budding_boq != null){
            $budding_air_user->numberBOQ_id = $budding_boq->id ;
            $budding_air_user->numberBOQ = $budding_boq->boq_number ;
            $budding_file = DB::table('budding_file')
                ->where('budding_boq_id','=',$budding_boq->id)
                ->where('project_id', '=', $budding_air_user->project_id)
                ->where('user_id', '=', $budding_air_user->user_id)
                ->get();
        }else{
            $budding_air_user->numberBOQ_id = null;
            $budding_air_user->numberBOQ = null;
            $budding_file  = null;
        }

        return view('backend.air.contract',[
            'type_page' => 2 ,
            'type_contract' => 0 ,
            'id' => $id ,
            'projectAuction' => $projectAuction,
            'projectAuctionWorks' => $projectAuctionWorks,
            'projectAuctionGalleries' => $projectAuctionGalleries,
            'profile' => $profile,
//            'user_id' => Auth::user()->id,
            'budding_air_user' => $budding_air_user,
            'budding_file' => $budding_file,
        ]);
    }

    public function planner($id)
    {
        //================= Master Data =================//
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

//        echo $id ;
//        echo Carbon::now() ;
////        echo $planner_data ;
//        dd($planner_data);
        $budding_success = DB::table('budding_boq')
            ->where('project_id','=',$id)
            ->first();
        return view('backend.air.planner',[
            'type_contract' => 0 ,
            'id' => $id ,
            'projectAuction' => $projectAuction,
            'projectAuctionWorks' => $projectAuctionWorks,
            'projectAuctionGalleries' => $projectAuctionGalleries,
            'planner_data' => $planner_data ,
            'budding_success' => $budding_success
        ]);

    }



    /**
     *
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    
    //API
    public function air()
    {
        
    }
}
