<?php

namespace App\Http\Controllers\frontend;

use App\Models\BitCoin;
use App\Models\Brands;
use App\Models\BuddingAir;
use App\Models\PriceRange;
use App\Models\Profile;
use App\Models\ProjectAuction;
use App\Models\ProjectAuctionGallery;
use App\Models\ProjectAuctionWork;
use App\Models\Provinces;
use App\Models\Subject_Works;
use App\Models\Works;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProjectAuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::guest()) {
            $profile = Profile::join('bit_coins', 'bit_coins.profile_id', 'profiles.id')
                ->select('profiles.*', 'bit_coins.coins')
                ->where('profiles.user_id', '=', Auth::user()->id)
                ->first();
        } else {
            $profile = null;
        }

        $provinces = Provinces::orderBy('PROVINCE_NAME')->pluck('PROVINCE_NAME', 'PROVINCE_ID');
        $typeProjectAuctions = DB::table('type_project_auctions')
            ->orderBy('name')->pluck('name', 'id');
        $price_ranges = PriceRange::pluck('price', 'id');

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
            ->orderby('project_auctions.countDown', 'asc')
            ->orderby('project_auctions.id', 'desc')
            ->paginate(8);
//            ->get();
        foreach ($projectAuction as $key => $value) {
            $projectAuction[$key]->sum = number_format($this->getLowPrice($value->id),2);
            $Logview = DB::table('project_auctions_logview')->where('project_id', $value->id)->get();
            $projectAuction[$key]->view = count($Logview);
        }

        // data master
        //-- ขอบเขตงาน --
        $master_work_air = Works::where('data_type',1)->get();
        $master_work_piumbling = Works::where('data_type',2)->get();
        $master_work_electrical = Works::where('data_type',3)->get();
        $master_work_fire = Works::where('data_type',4)->get();
        //-- ขอบเขตงานย่อย --
        $master_sub_air = Subject_Works::where('data_type',1)->get();
        $master_sub_piumbling = Subject_Works::where('data_type',2)->get();
        $master_sub_electrical = Subject_Works::where('data_type',3)->get();
        $master_sub_fire = Subject_Works::where('data_type',4)->get();

//        dd($master_piumbling);
        return view('frontend.projectauction', [
            'provinces' => $provinces,
            'profile' => $profile,
            'typeProjectAuctions' => $typeProjectAuctions,
            'price_ranges' => $price_ranges,
            'projectAuction' => $projectAuction,
            'master_sub_air' => $master_sub_air,
            'master_sub_piumbling' => $master_sub_piumbling,
            'master_sub_electrical' => $master_sub_electrical,
            'master_sub_fire' => $master_sub_fire,
            'master_work_air' => $master_work_air,
            'master_work_piumbling' => $master_work_piumbling,
            'master_work_electrical' => $master_work_electrical,
            'master_work_fire' => $master_work_fire,
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        //### Check Create Project Auction : 1 Profile to 2 Projct > Coin 1000 : tb : mgt_bit_coin ###/
        $mgtBitCoin = DB::table('mgt_bin_coin')->where('type', '=', 2)->first(); // โปร Coin
        $countProjectAuction = ProjectAuction::where('profile_id', '=', $request->profile_id)->count('profile_id'); // Count จำนวนการสร้าง
        if ($countProjectAuction >= $mgtBitCoin->count) {
            $bitCoins = BitCoin::where('profile_id', '=', $request->profile_id)->first();
            $coin_user = $bitCoins->coins;
            if ($coin_user < $mgtBitCoin->coin) {
//                echo "จำนวนเงิน Coin ในระบบไม่พอ";
                return back()->withInput($request->input())->with('alert', "จำนวนเงิน Coin ในระบบไม่พอ");
            } else {
//                echo "จำนวนคงเหลือ ".$coin_user - $mgtBitCoin->coin;
                $bitCoins->coins = $coin_user - $mgtBitCoin->coin;
                $bitCoins->update();
                DB::table('mgt_log_bit_coins')->insert(
                    [
                        'profile_id' => $request->profile_id,
                        'coins' => $mgtBitCoin->coin,
                        'type' => 2
                    ]
                );
            }
        }
        //### Check Create Project Auction : 1 Profile to 2 Projct > Coin 1000 : tb : mgt_bit_coin ###/

        //### Save Project Auction ###/
        if ($request->type_project_id == 1) {
            $now = new DateTime();
            $auth_id = Auth::user()->id;
            $ProjectAuction = new  ProjectAuction();
            $ProjectAuction->user_id = $auth_id;
            $ProjectAuction->profile_id = $request->profile_id;
            $ProjectAuction->project_name = $request->project_name;
            $ProjectAuction->type_project_id = $request->type_project_id;
            $ProjectAuction->date_end = $request->date_end;
            $ProjectAuction->time_end = $request->time_end;
            $ProjectAuction->price_ranges_id = $request->price_ranges_id;
            $ProjectAuction->provinces_id = $request->provinces;
            $ProjectAuction->amphures_id = $request->amphures;
            $ProjectAuction->districts_id = $request->districts;
            $ProjectAuction->startdate = $request->startdate;
            $ProjectAuction->enddate = $request->enddate;
            $ProjectAuction->period = $request->period;
            $ProjectAuction->details = $request->details;
            $ProjectAuction->created_at = $now;
            $ProjectAuction->updated_at = null;
            $ProjectAuction->save();

            $project_id = $ProjectAuction->id;

            if($request->type_project_id == 1){
                //Air condition
                for ($i = 0; $i < count($request->work); $i++) {
                    $ProjectAuctionWork = new ProjectAuctionWork();
                    $ProjectAuctionWork->project_id = $project_id;
                    $ProjectAuctionWork->work_id = $request->work[$i];
                    $ProjectAuctionWork->install_machine = $request->subject_work1;
                    $ProjectAuctionWork->piping = $request->subject_work2;
                    $ProjectAuctionWork->control = $request->subject_work3;
                    $ProjectAuctionWork->main = $request->subject_work4;
                    $ProjectAuctionWork->duct_piping = $request->subject_work5;
                    $ProjectAuctionWork->created_at = $now;
                    $ProjectAuctionWork->updated_at = null;
                    $ProjectAuctionWork->save();
                }
            }elseif($request->type_project_id == 2){
                //Plumbling And Sanitary (ประปา)

            }elseif($request->type_project_id == 3){
                //Electrical system (ไฟฟ้า)

            }elseif($request->type_project_id == 4){
                //FIre protection (ดับเพลิง)

            }
            if (!empty($request->file('gallery'))) {
                /* insert file Gallery */
                if ($request->file('gallery') != "") {
                    $count = count($request->file('gallery'));
                    for ($i = 0; $i < $count; $i++) {
                        $filename = 'project_auction_' . $project_id . "-" . str_random(3) . '.' . $request->file('gallery')[$i]->getClientOriginalExtension();
                        $request->gallery[$i]->move(public_path() . '/images/gallery-projectauction/', $filename);
                        $image_gal[$i] = $filename;
                    }
                }
                /* end */
                /* insert database WorkGallery */
                if ($image_gal != null) {
                    for ($i = 0; $i < count($image_gal); $i++) {
                        $gallery = new  ProjectAuctionGallery();
                        $gallery->project_id = $project_id;
                        $gallery->filename = $image_gal[$i];
                        $gallery->created_at = $now;
                        $gallery->updated_at = null;
                        $gallery->save();
                    }
                }
                /* end */
            }
        }
        //### Save Project Auction ###/

        Session::flash('status', 'สร้างโครงการ เรียบร้อย!');
        return redirect('projectauction');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $now = new DateTime();
        $ip = \Request::getClientIp(true);
        $visitor = DB::table('project_auctions_logview')->where('ip','=',$ip)
            ->where('project_id','=',$id)
            ->first();
        if ($visitor == null){
            DB::table('project_auctions_logview')->insert([
               'project_id' => $id ,
               'ip' => $ip ,
               'count' => 1 ,
               'created_at' => $now ,
               'updated_at' => null ,
            ]);
        }else{
            DB::table('project_auctions_logview')
                ->where('ip', '=', $ip)
                ->where('project_id', '=', $id)
                ->update([
                    'count' =>  $visitor->count + 1,
                    'updated_at' =>  $now ,
                ]);
        }

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

        $projectAuctionWorks = ProjectAuctionWork::join('works', 'works.id', 'project_auction_works.work_id')
            ->select('project_auction_works.*', 'works.name as work_name')
            ->where('project_id', '=', $id)
            ->get();

        $projectAuctionGalleries = ProjectAuctionGallery::where('project_id', '=', $id)->get();
        if ($projectAuction->countDown == 0) {
            $date = $projectAuction->date_end . ' ' . $projectAuction->time_end;
            $year = date('Y', strtotime($date));
            $month = date('m', strtotime($date));
            $day = date('d', strtotime($date));
            $hour = date('H', strtotime($date));
            $minute = date('i', strtotime($date));
            $second = date('s', strtotime($date));

//            $current_timestamp = Carbon::createFromTimestamp($year, $month, $day, $hour, $minute, $second)->timestamp; // Produces something like 1552296328
            $current_timestamp = mktime($hour, $minute, $second, $month, $day, $year);

//            $date = date_create($date);
//            echo date_timestamp_get($date)."<br>";

        } else {
            $current_timestamp = 0000000000;
        }


//        dd($projectAuction);
        $AuthId = null;
        if(!Auth::guest()){
            $AuthId = Auth::user()->id ;
        }

        // Log View
        $Logview = DB::table('project_auctions_logview')->where('project_id', $id)->get();

        $low = $this->getLowPrice($id);

        if($projectAuction->type_project_id == 1){
            return view('frontend.auction-topic', [
                'projectAuction' => $projectAuction,
                'projectAuctionWorks' => $projectAuctionWorks,
                'projectAuctionGalleries' => $projectAuctionGalleries,
                'current_timestamp' => $current_timestamp,
                'id' => $id,
                'AuthId' => $AuthId,
                'Logview' => count($Logview),
                'low' =>  number_format($low,2) ,
            ]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    public function quotation($id)
    {
        $projectAuction = ProjectAuction::join('price_ranges', 'price_ranges.id', '=', 'project_auctions.price_ranges_id')
            ->join('provinces', 'provinces.id', '=', 'project_auctions.provinces_id')
            ->join('amphures', 'amphures.id', '=', 'project_auctions.amphures_id')
            ->join('districts', 'districts.id', '=', 'project_auctions.districts_id')
            ->join('users', 'users.id', '=', 'project_auctions.user_id')
            ->join('type_project_auctions', 'type_project_auctions.id', '=', 'project_auctions.type_project_id')
            ->join('profiles', 'profiles.id', '=', 'project_auctions.profile_id')
            ->select('project_auctions.*', 'price_ranges.price',
                'provinces.name_th as provinces',
                'amphures.name_th as amphures',
                'districts.name_th as districts',
                'users.name as username',
                'type_project_auctions.name as type_project',
                'profiles.firstname', 'profiles.lastname', 'profiles.image_profile')
            ->where('project_auctions.id', '=', $id)
            ->first();

        $projectAuctionWorks = ProjectAuctionWork::join('works', 'works.id', 'project_auction_works.work_id')
            ->select('project_auction_works.*', 'works.name as work_name')
            ->where('project_id', '=', $id)
            ->get();

        $projectAuctionGalleries = ProjectAuctionGallery::where('project_id', '=', $id)->get();

        if ($projectAuction->countDown == 0) {
            $date = $projectAuction->date_end . ' ' . $projectAuction->time_end;
            $year = date('Y', strtotime($date));
            $month = date('m', strtotime($date));
            $day = date('d', strtotime($date));
            $hour = date('H', strtotime($date));
            $minute = date('i', strtotime($date));
            $second = date('s', strtotime($date));

            $current_timestamp = mktime($hour, $minute, $second, $month, $day, $year);

        } else {
            $current_timestamp = 0000000000;
        }

        return view('frontend.quotation', [
            'projectAuction' => $projectAuction,
            'projectAuctionWorks' => $projectAuctionWorks,
            'projectAuctionGalleries' => $projectAuctionGalleries,
            'current_timestamp' => $current_timestamp,
            'id' => $id,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $id
     */
    public function getLowPrice($id)
    {
        $status_air_user = DB::table('project_auctions_air')
            ->where('project_id','=',$id)
            ->where('status_prelim','=',2)
            ->get();
        $alphabet = Array();
        if(count($status_air_user) > 0){
            for ($na = 0; $na < count($status_air_user); $na++) {
                $alphabet[]= $this->generateAlphabet($na);
                $status_air_user[$na]->name = $alphabet[$na];
            }

            $sum_data  = 0 ;
            $sum_btu  = 0 ;
            $sum_fcu  = 0 ;
            $sum_cud  = 0 ;
            $sum_support_hanger  = 0 ;
            $sum_brand  = "" ;
            $sum_brand_str  = "" ;
            $sum_all = 0 ;

            $brand_arr2 = [];
            $brand_arr3 = [];
            $brand_arr4 = [];
            $brand_arr5 = [];

            foreach ($status_air_user as $key => $value){
                //Profile
                $profile = Profile::where('user_id','=',$value->user_id)->first();
                $status_air_user[$key]->profile_id = $profile->id;
                $status_air_user[$key]->fullname = $profile->firstname." ".$profile->lastname;
                //Install Machine : 1
                if($value->status_machine == 2){
                    $budding_install_machine = BuddingAir::where('type_work_sub','=',1)
                        ->where('user_id','=',$value->user_id)
                        ->get();
                    $status_air_user[$key]->install_machine = $budding_install_machine ;
//                $sum_data  = 0 ;
//                $sum_btu  = 0 ;
//                $sum_fcu  = 0 ;
//                $sum_cud  = 0 ;
//                $sum_support_hanger  = 0 ;
//                $sum_brand  = "" ;
//                $sum_brand_str  = "" ;
                    foreach ($budding_install_machine as $keyB => $valueB){
                        //Brand
                        if ($valueB->sub_brand_id != null){
                            $brand = Brands::where('id','=',$valueB->sub_brand_id)->first();
                            $status_air_user[$key]->install_machine[$keyB]->brand = $brand->name ;
                            if($brand->name != $sum_brand){
                                $sum_brand = $brand->name;
                                if($keyB > 0){
                                    $sum_brand_str .= " / ".$brand->name;
                                }else{
                                    $sum_brand_str .= $brand->name;
                                }
                            }
                        }else{
                            $status_air_user[$key]->install_machine[$keyB]->brand = null;
                        }

                        $sub_budding = DB::table('sub_budding_airs')
                            ->where('budding_air_id','=',$valueB->id)
                            ->get();
                        $status_air_user[$key]->install_machine[$keyB]->sub_data = $sub_budding;

                        // Sub Price Data
                        $sum_data = $valueB->totalAll_sub + $sum_data ;

                        foreach ($sub_budding as $keyC => $valueC){
                            $sum_btu = $valueC->price + $sum_btu;
                        }

                        //sub_work_id : 1 =
                        if ($valueB->sub_work_id == 1){
                            foreach ($sub_budding as $keyC => $valueC){
                                $sum_fcu = $valueC->qty + $sum_fcu;
                            }
                        }
                        //sub_work_id : 2 =
                        if ($valueB->sub_work_id == 2){
                            foreach ($sub_budding as $keyC => $valueC){
                                $sum_cud = $valueC->qty + $sum_cud;
                            }
                        }
                        //Support & Hanger (For CDU. & FCU.) sub_work_id : 4
                        if ($valueB->sub_work_id == 4){
                            $sum_support_hanger = $valueB->totalAll_sub + $sum_support_hanger;
                        }

                    }
                    $status_air_user[$key]->install_machine->sum = $sum_data ;
                    $status_air_user[$key]->install_machine->btu = $sum_btu ;
                    $status_air_user[$key]->btu_install_machine = $sum_btu ;
                    $status_air_user[$key]->install_machine->brand  = $sum_brand_str ;
                    $status_air_user[$key]->install_machine->fcu  = $sum_fcu ;
                    $status_air_user[$key]->install_machine->cud  = $sum_cud ;
                    $status_air_user[$key]->sum_install_machine  = $sum_data ;
                    $status_air_user[$key]->support_hanger  = $sum_support_hanger ;
                    $sum_all +=  $sum_data ;
                    $sum_brand_str = "";


                }
                //Piping : 2
                if($value->status_piping == 2){
                    $budding_piping = BuddingAir::where('type_work_sub','=',2)
                        ->where('user_id','=',$value->user_id)
                        ->get();
                    $status_air_user[$key]->piping = $budding_piping ;
                    $sum_data  = 0 ;
                    foreach ($budding_piping as $keyB => $valueB){
                        //Brand
                        if ($valueB->sub_brand_id != null){
                            $brand = Brands::where('id','=',$valueB->sub_brand_id)->first();
                            $status_air_user[$key]->piping[$keyB]->brand = $brand->name ;
                        }else{
                            $status_air_user[$key]->piping[$keyB]->brand = null;
                        }
                        $sub_budding = DB::table('sub_budding_airs')
                            ->where('budding_air_id','=',$valueB->id)
                            ->get();
                        $status_air_user[$key]->piping[$keyB]->sub_data = $sub_budding;

                        // Sub Price Data
                        $sum_data = $valueB->totalAll_sub + $sum_data ;
                        // Brand ALL
                        if ($valueB->sub_brand_id != null){
                            $brand_arr2[] =  $valueB->sub_brand_id;
                        }
                    }
                    $status_air_user[$key]->piping->sum = $sum_data ;
                    $status_air_user[$key]->sum_piping  = $sum_data ;
                    $sum_all +=  $sum_data ;
                    $query_brands2 = collect($brand_arr2)->unique();
                    $query_brands2 = Brands::whereIn('id',$query_brands2)->get();
                    $status_air_user[$key]->piping->brands = $query_brands2;
                }
                //Control : 3
                if($value->status_control == 2){
                    $budding_control = BuddingAir::where('type_work_sub','=',3)
                        ->where('user_id','=',$value->user_id)
                        ->get();
                    $status_air_user[$key]->control = $budding_control ;
                    $sum_data  = 0 ;
                    foreach ($budding_control as $keyB => $valueB){
                        //Brand
                        if ($valueB->sub_brand_id != null){
                            $brand = Brands::where('id','=',$valueB->sub_brand_id)->first();
                            $status_air_user[$key]->control[$keyB]->brand = $brand->name ;
                        }else{
                            $status_air_user[$key]->control[$keyB]->brand = null;
                        }
                        $sub_budding = DB::table('sub_budding_airs')
                            ->where('budding_air_id','=',$valueB->id)
                            ->get();
                        $status_air_user[$key]->control[$keyB]->sub_data = $sub_budding;

                        // Sub Price Data
                        $sum_data = $valueB->totalAll_sub + $sum_data ;
                        $status_air_user[$key]->sum_control  = $sum_data ;
                        // Brand ALL
                        if ($valueB->sub_brand_id != null){
                            $brand_arr3[] =  $valueB->sub_brand_id;
                        }
                    }
                    $status_air_user[$key]->control->sum = $sum_data ;
                    $sum_all +=  $sum_data ;
                    $query_brands3 = collect($brand_arr3)->unique();
                    $data_brands3 = Brands::whereIn('id',$query_brands3)->get();
                    $status_air_user[$key]->control->brands = $data_brands3;
                }
                //Main : 4
                if($value->status_main == 2){
                    $budding_main = BuddingAir::where('type_work_sub','=',5)
                        ->where('user_id','=',$value->user_id)
                        ->get();
                    $status_air_user[$key]->main = $budding_main ;
                    $sum_data  = 0 ;
                    foreach ($budding_main as $keyB => $valueB){
                        $sub_budding = DB::table('sub_budding_airs')
                            ->where('budding_air_id','=',$valueB->id)
                            ->get();
                        $status_air_user[$key]->main[$keyB]->sub_data = $sub_budding;

                        // Sub Price Data
                        $sum_data = $valueB->totalAll_sub + $sum_data ;
                        $status_air_user[$key]->sum_main = $sum_data ;
                        // Brand ALL
                        if ($valueB->sub_brand_id != null){
                            $brand_arr4[] =  $valueB->sub_brand_id;
                        }
                    }
                    $status_air_user[$key]->main->sum = $sum_data ;
                    $sum_all +=  $sum_data ;
                    $query_brands4 = collect($brand_arr4)->unique();
                    $data_brands4 = Brands::whereIn('id',$query_brands4)->get();
                    $status_air_user[$key]->main->brands = $data_brands4;
                }
                //Duct Piping : 5
                if($value->status_duct == 2){
                    $budding_duct = BuddingAir::where('type_work_sub','=',4)
                        ->where('user_id','=',$value->user_id)
                        ->get();
                    $status_air_user[$key]->duct = $budding_duct ;
                    $sum_data  = 0 ;
                    foreach ($budding_duct as $keyB => $valueB){
                        $sub_budding = DB::table('sub_budding_airs')
                            ->where('budding_air_id','=',$valueB->id)
                            ->get();
                        $status_air_user[$key]->duct[$keyB]->sub_data = $sub_budding;

                        // Sub Price Data
                        $sum_data = $valueB->totalAll_sub + $sum_data ;
                        // Brand ALL
                        if ($valueB->sub_brand_id != null){
                            $brand_arr5[] =  $valueB->sub_brand_id;
                        }
                    }
                    $status_air_user[$key]->duct->sum = $sum_data ;
                    $status_air_user[$key]->sum_duct_piping  = $sum_data ;
                    $sum_all +=  $sum_data ;
                    $query_brands5 = collect($brand_arr5)->unique();
                    $data_brands5 = Brands::whereIn('id',$query_brands5)->get();
                    $status_air_user[$key]->duct->brands = $data_brands5;
                }
                //Prelim
                if($value->status_prelim == 2){
                    $prelim = DB::table('prelim_air')
                        ->where('project_id','=',$id)
                        ->where('user_id','=',$value->user_id)
                        ->get();
                    $status_air_user[$key]->prelim = $prelim ;
                    $sum_data  = 0 ;
                    foreach ($prelim as $keyB => $valueB){
                        $sub_prelim = DB::table('preliminaries_datail')
                            ->where('prelim_id','=',$valueB->id)
                            ->get();
                        $status_air_user[$key]->prelim[$keyB]->sub_data = $sub_prelim ;
                    }
                    $arr = [];
                    for ($i = 0 ; $i < count($prelim);$i++){
                        $arr[] = $prelim[$i]->id;
                    }
                    // Sub Price Data
                    if (count($arr) > 0){
                        $preliminaries_datail = DB::table('preliminaries_datail')
                            ->whereIn('prelim_id',$arr)
                            ->sum('price_sum');
                        $arr = [];
                        $status_air_user[$key]->prelim->sum = $preliminaries_datail ;
                        $status_air_user[$key]->sum_prelim = $preliminaries_datail ;
                        $sum_all +=  $preliminaries_datail ;
                    }
                }
                //Overhead กำไร
                $overhead = DB::table('budding_overhead')
                    ->where('project_id','=',$id)
                    ->where('user_id','=',$value->user_id)
                    ->first();
                if ($overhead != null){
                    $status_air_user[$key]->overhead_sum = (double)$overhead->sum_overhead ;
                    $status_air_user[$key]->overhead_sub_data = $overhead ;
                    $sum_all +=  (double)$overhead->sum_overhead ;
                }
                // SUM ALL

                $status_air_user[$key]->sum_all = $sum_all ;
                $sum_all = 0;
            }



            $sum_Low = $status_air_user->sortBy('sum_all');
            $sum_Much = $status_air_user->sortByDesc('sum_all');

            $sort = [];
            $sort2 = [];
            $i = 0;
            $j = 0;
            foreach ($sum_Low as $value){
                $sort[$i]['name'] =  $value->name ;
                $sort[$i]['low'] =  $value->sum_all ;
                $i++;
            }

            foreach ($sum_Much as $value){
                $sort2[$j]['name'] =  $value->name ;
                $sort2[$j]['much'] =  $value->sum_all ;
                $j++;
            }


            $name = (isset($sort[0]['name']))?$sort[0]['name']:'-';
            $low = (isset($sort[0]['low']))?$sort[0]['low']:'0';
            $much = (isset($sort2[0]['much']))?$sort2[0]['much']:'0';
            return $low;
        }else{
            return 0;
        }

    }

    function generateAlphabet($na) {
        $sa = "";
        while ($na >= 0) {
            $sa = chr($na % 26 + 65) . $sa;
            $na = floor($na / 26) - 1;
        }
        return $sa;
    }
}
