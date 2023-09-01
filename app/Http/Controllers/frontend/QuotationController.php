<?php

namespace App\Http\Controllers\frontend;

use App\Models\Air_Conditioning;
use App\Models\Answers;
use App\Models\Brands;
use App\Models\BuddingAir;
use App\Models\CourseList;
use App\Models\Profile;
use App\Models\ProjectAuction;
use App\Models\ProjectAuctionGallery;
use App\Models\ProjectAuctionWork;
use App\Models\Questions;
use App\Models\QuotationPercentage;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Tag\Dd;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use PHPExcel_Worksheet_Drawing;
//use PDF2;

class QuotationController extends Controller
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user() != null) {

            //================= Master Data =================//

            $profile = Profile::join('bit_coins', 'bit_coins.profile_id', 'profiles.id')
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



            //================= Process Data =================//
            $check_statusProjectWork = ProjectAuctionWork::join('works', 'works.id', '=', 'project_auction_works.work_id')
                ->select('project_auction_works.project_id','works.name as work_name', 'project_auction_works.id','project_auction_works.work_id',
                    DB::raw('(CASE WHEN project_auction_works.status_machine = 0 && project_auction_works.install_machine != "" THEN "not" ELSE "record" END) AS "status_machine"'),
                    DB::raw('(CASE WHEN project_auction_works.status_piping = 0 && project_auction_works.piping != "" THEN "not" ELSE "record" END) AS "status_piping"'),
                    DB::raw('(CASE WHEN project_auction_works.status_control = 0 && project_auction_works.control != "" THEN "not" ELSE "record" END) AS "status_control"'),
                    DB::raw('(CASE WHEN project_auction_works.status_main = 0 && project_auction_works.main != "" THEN "not" ELSE "record" END) AS "status_main"'),
                    DB::raw('(CASE WHEN project_auction_works.status_duct = 0 && project_auction_works.duct_piping != "" THEN "not" ELSE "record" END) AS "status_duct"')
                )
                ->where('project_auction_works.project_id', '=', $id)
                ->get();


            $check_status_air = DB::table('project_auctions_air')
                ->where('user_id','=',Auth::user()->id)
                ->where('project_id','=',$id)
                ->first();

//            dd($projectAuctionWorks);

            $project_auction_works = ProjectAuctionWork::join('works', 'works.id', '=', 'project_auction_works.work_id')
                ->where('project_auction_works.project_id', '=', $id)
                ->get();;
            if (!empty($check_status_air)){

//                echo "check project_auctions_air" ;
                //================= Process Budding Data =================//
                if ($check_status_air->status_machine == 1) {
                    $type = "install_machine";
                } elseif ($check_status_air->status_piping == 1) {
                    $type = "piping";
                } elseif ($check_status_air->status_control == 1) {
                    $type = "control";
                } elseif ($check_status_air->status_main == 1) {
                    $type = "main";
                } elseif ($check_status_air->status_duct == 1) {
                    $type = "duct_piping";
                }elseif ($check_status_air->status_prelim == 1){
                    $type = "prelim";
                }else{
                    return redirect('quotation/dashboard/'.$id);
                }
//                echo "TYPE : ".$type;
                return view('frontend.quotation', [
                    'projectAuction' => $projectAuction,
                    'projectAuctionWorks' => $projectAuctionWorks,
                    'projectAuctionGalleries' => $projectAuctionGalleries,
                    'id' => $id,
                    'type' => $type,
                    'profile' => $profile,
                    'user_id' => Auth::user()->id,
                ]);

                //================= Process Budding Data =================//

            }else{
//                echo "insert project_auctions_air" ;
                $now = new DateTime();
                DB::table('project_auctions_air')->insert([
                    'user_id' => Auth::user()->id ,
                    'project_id' => $id ,
                    'status_machine' => ($check_statusProjectWork[0]->status_machine == "not")?1:0 ,
                    'status_piping' => ($check_statusProjectWork[0]->status_piping == "not")?1:0 ,
                    'status_control' => ($check_statusProjectWork[0]->status_control == "not")?1:0 ,
                    'status_main' => ($check_statusProjectWork[0]->status_main == "not")?1:0 ,
                    'status_duct' => ($check_statusProjectWork[0]->status_duct == "not")?1:0 ,
                    'created_at' => $now ,
                    'updated_at' => null ,
                ]);
                return redirect('quotation/'.$id);
            }
            //================= Process Data =================//
//            dd($project_auction_works);
        }else{
            return redirect('login');
        }
    }

    public function dashboard($id)
    {

        //================= Master Data =================//
        $profile = Profile::join('bit_coins', 'bit_coins.profile_id', 'profiles.id')
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


        $status_prelim = 0 ;


        $status_air_user = DB::table('project_auctions_air')
            ->where('project_id','=',$id)
            ->where('status_prelim','=',2)
            ->get();
        $alphabet = Array();
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

                    $budding = DB::table('budding_airs')
                        ->where('project_id','=',$id)
                        ->where('user_id','=',$valueB->user_id)
                        ->where('sub_work_id','=' ,1)
                        ->first();

                    $sub_budding = DB::table('sub_budding_airs')
                        ->where('budding_air_id','=' ,$budding->id)
                        ->get();

                    //26/1262 = ื new show data model เปรียนเทียบ Air
                    foreach ($sub_budding as $keyA => $valueA){
//                        $air_con  = Air_Conditioning::find($valueA->air_id);
//                        $air_con  = Air_Conditioning::join('air_data','air_data.id','=','air_conditionings.product_id')
//                            ->join('air_btu','air_btu.id','=','air_data.air_btu_id')
//                            ->select('air_data.air_type_name','air_btu.air_btu_detail')
//                            ->where('air_conditionings.id',$valueA->air_id)->first();
                        $sub_budding[$keyA]->type_air = 'sky air';
                        $sub_budding[$keyA]->btu = 14000;
                    }

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
                for ($i = 0 ; $i < count($prelim);$i++){
                    $arr[] = $prelim[$i]->id;
                }
                // Sub Price Data
                $preliminaries_datail = DB::table('preliminaries_datail')
                    ->whereIn('prelim_id',$arr)
                    ->sum('price_sum');
                $arr = [];
                $status_air_user[$key]->prelim->sum = $preliminaries_datail ;
                $status_air_user[$key]->sum_prelim = $preliminaries_datail ;
                $sum_all +=  $preliminaries_datail ;
            }
            //Overhead กำไร
            $overhead = DB::table('budding_overhead')
                ->where('project_id','=',$id)
                ->where('user_id','=',$value->user_id)
                ->first();
            $status_air_user[$key]->overhead_sum = 0 ;
            $status_air_user[$key]->overhead_sub_data = $overhead ;
             $sum_all +=  0 ;

            // SUM ALL
//            echo $key." = ".$sum_all." <br>";
            $status_air_user[$key]->sum_all = $sum_all ;
            $sum_all = 0;

            // check Profile
            $status_air_user[$key]->exp_detail = $profile->details;
            $status_air_user[$key]->review_profile = $profile->review_profile;
            $status_air_user[$key]->course = $this->checkCourseOnline(4, $status_air_user[$key]->user_id);

            // เสนอราคาด่วน
            $data = DB::table('project_auctions_quick')
                ->where('user_id','=', $value->user_id)
                ->where('project_id','=',$id)
                ->first();
            if ($data != ''){
                $status_air_user[$key]->quick_price = $data->price ;
            }else{
                $status_air_user[$key]->quick_price = 0 ;
            }

        }


        $machine = $status_air_user->sortBy('sum_install_machine');
        $btu_machine = $status_air_user->sortBy('btu_install_machine');
        $piping = $status_air_user->sortBy('sum_piping');
        $control = $status_air_user->sortBy('sum_control');
        $main = $status_air_user->sortBy('sum_main');
        $duct = $status_air_user->sortBy('sum_duct_piping');
        $prelim = $status_air_user->sortBy('sum_prelim');
        $overhead = $status_air_user->sortBy('overhead_sum');
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

        // เสนอราคาด่วน
        $data = DB::table('project_auctions_quick')
            ->where('user_id','=',Auth::user()->id)
            ->where('project_id','=',$id)
            ->first();

        $quick = 0 ;
        if ($data != ''){
            $quick = $data->price ;
        }

//        echo count($status_air_user[0]->install_machine);
//        dd($status_air_user[0]->install_machine[0]->sub_data);

        return view('frontend.analyze-project',[
            'id' => $id ,
            'projectAuction' => $projectAuction,
            'projectAuctionWorks' => $projectAuctionWorks,
            'projectAuctionGalleries' => $projectAuctionGalleries,
            'profile' => $profile,
            'user_id' => Auth::user()->id,
            'data_dashboard' => $status_air_user ,
            'machine' => $machine,
            'piping' => $piping,
            'control' => $control,
            'main' => $main,
            'duct' => $duct,
            'prelim' => $prelim,
            'overhead' => $overhead,
            'btu_machine' => $btu_machine,
            'sum_Low' => $sort,
            'sum_Much' => $sort2,
            'name' => $name,
            'low' => $low,
            'much' => $much,
            'profile_review' => $sum_Low,
            'quick' => $quick,
        ]);
    }

    public function saveQuick(Request $request)
    {
//        dd($request->all());
        $data = DB::table('project_auctions_quick')
            ->where('user_id','=',Auth::user()->id)
            ->where('project_id','=',$request->project_id)
            ->first();
        if ($data == ''){
            //save
            DB::table('project_auctions_quick')->insert([
                'user_id' => Auth::user()->id ,
                'price' => $request->price ,
                'project_id' => $request->project_id ,
            ]);
        }else{
            //update
            DB::table('project_auctions_quick')
                ->where('user_id','=',Auth::user()->id)
                ->where('project_id','=',$request->project_id)
                ->update([
                    'price' => $request->price ,
                ]);
        }
        Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
        return redirect('/quotation/dashboard/'.$request->project_id);
    }

    public function contract($id)
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
        $sum_all = 0 ;


//        dd($budding_air_user);


        if(Auth::user()->id == $projectAuction->user_id){
            // ผู้ว่าจ้าง
            if($budding_air_user->status_phungngan_Follow == 0){

//                Session::flash('warning', 'รอผลการตอบกลับ ผู้รับเหมา/ผู้รับจ้าง!');
//                return redirect('/quotation/dashboard/'.$id);
                return view('frontend.contract',[
                    'type_page' => 1 ,
                    'id' => $id ,
                    'projectAuction' => $projectAuction,
                    'projectAuctionWorks' => $projectAuctionWorks,
                    'projectAuctionGalleries' => $projectAuctionGalleries,
//                'profile' => $profile,
                    'user_id' => Auth::user()->id,
                    'budding_air_user' => $budding_air_user,
                ]);
            }else{
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

                return view('frontend.contract',[
                    'type_page' => 2 ,
                    'type_contract' => 0 ,
                    'id' => $id ,
                    'projectAuction' => $projectAuction,
                    'projectAuctionWorks' => $projectAuctionWorks,
                    'projectAuctionGalleries' => $projectAuctionGalleries,
                    'profile' => $profile,
                    'user_id' => Auth::user()->id,
                    'budding_air_user' => $budding_air_user,
                    'budding_file' => $budding_file,
                ]);
            }
        }elseif (Auth::user()->id == $budding_air_user->user_id){
            // ผู้รับเหมา
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


            return view('frontend.contract',[
                'type_page' => 2 ,
                'type_contract' => 1 ,
                'id' => $id ,
                'projectAuction' => $projectAuction,
                'projectAuctionWorks' => $projectAuctionWorks,
                'projectAuctionGalleries' => $projectAuctionGalleries,
                'profile' => $profile,
                'user_id' => Auth::user()->id,
                'budding_air_user' => $budding_air_user,
                'budding_file' => $budding_file,
            ]);

        }else {
            Session::flash('warning', 'ไม่มีสิทธิ์เข้าถึง การใช้งาน!');
            return redirect('projectauction/' . $id);
        }
    }

    public function generateExcel($user_id , $project_id)
    {
        $data = [];

        $budding_boq = DB::table('budding_boq')
            ->where('project_id', '=', $project_id)
            ->where('user_id', '=', $user_id)
            ->first();

        list($year,$month,$day) = explode('-',date('Y-m-d',strtotime($budding_boq->boq_date)));
        if($day <10){
            $day = substr($day,1,1);
        }

        $thMonth = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน",
            "กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        if($month<10){
            $month = substr($month,1,1);
        }
        $year +=543;
        $boq_number = $budding_boq->boq_number;
        $boq_date = $day." ".$thMonth[$month-1]." ".$year;
        $boq_deadline = $budding_boq->boq_deadline ;

        $myFile = Excel::create('ใบเสนอราคาค่าติดตั้งเครื่องปรับอากาศ', function ($excel) use ($data, $user_id, $project_id , $boq_number ,$boq_date , $boq_deadline) {

            $excel->sheet('QUOTATION(SUMMARY)', function ($sheet) use ($data, $user_id, $project_id , $boq_number ,$boq_date , $boq_deadline) {

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
                    $arr2[] = $prelim_air[$i]->id;
                }
                $preliminaries_datail = DB::table('preliminaries_datail')
                    ->whereIn('prelim_id', $arr2)
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
                    'ใบเสนอราคาเลขที่ ', $boq_number
                ));
                $sheet->row(4, array(
                    'เรียน :', $profile->firstname . " " . $profile->lastname,
                    '', '', '', '',
                    'วันที่', $boq_date
                ));
                $sheet->row(5, array(
                    '', '', '', '', '', '',
                    'เครดิต  ตามเงื่อนไขชำระข้างล่าง'
                ));
                $sheet->row(6, array(
                    '', '', '', '', '', '',
                    'กำหนดยืนราคา', $boq_deadline.'  วัน'
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

            $excel->sheet('QUOTATION(SUMMARY) 2', function ($sheet) use ($data, $user_id, $project_id , $boq_number ,$boq_date , $boq_deadline) {

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
                    $arr2[] = $prelim_air[$i]->id;
                }
                $preliminaries_datail = DB::table('preliminaries_datail')
                    ->whereIn('prelim_id', $arr2)
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
                    'ใบเสนอราคาเลขที่ ', $boq_number
                ));
                $sheet->row(4, array(
                    'เรียน :', $profile->firstname . " " . $profile->lastname,
                    '', '', '', '',
                    'วันที่', $boq_date
                ));
                $sheet->row(5, array(
                    '', '', '', '', '', '',
                    'เครดิต  ตามเงื่อนไขชำระข้างล่าง'
                ));
                $sheet->row(6, array(
                    '', '', '', '', '', '',
                    'กำหนดยืนราคา', $boq_deadline.'  วัน'
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

            $excel->sheet('QUOTATION(SUMMARY) (ราคา)', function ($sheet) use ($data, $user_id, $project_id , $boq_number ,$boq_date , $boq_deadline) {

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
                    'วันที่', $boq_date, '', '', '', '',
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

            $excel->sheet('Preliminaries', function ($sheet) use ($data , $user_id, $project_id , $boq_number ,$boq_date , $boq_deadline) {
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
                    'วันที่', $boq_date, '', '', '', '',
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
    }

    public function generatePDF($user_id , $project_id)
    {
        $today = Carbon::today();
        $data = "";
        $day = "วันที่ " . date('d/m/Y', strtotime($today));

        $budding_boq = DB::table('budding_boq')
            ->where('project_id', '=', $project_id)
            ->where('user_id', '=', $user_id)
            ->first();

        list($year,$month,$day) = explode('-',date('Y-m-d',strtotime($budding_boq->boq_date)));
        if($day <10){
            $day = substr($day,1,1);
        }

        $thMonth = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน",
            "กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        if($month<10){
            $month = substr($month,1,1);
        }
        $year +=543;
        $boq_number = $budding_boq->boq_number;
        $boq_date = $day." ".$thMonth[$month-1]." ".$year;
        $boq_deadline = $budding_boq->boq_deadline ;



        $pdf = PDF::loadView('frontend.pdf.boq-form' , ['data' => $data , 'day' => $day]);
        return $pdf->stream('สัญญาว่าจ้าง-ผู้รับเหมา_'.date('d/m/Y').'.pdf');
    }

    function generateAlphabet($na) {
        $sa = "";
        while ($na >= 0) {
            $sa = chr($na % 26 + 65) . $sa;
            $na = floor($na / 26) - 1;
        }
        return $sa;
    }

    public function checkCourseOnline($id , $user_id)
    {
        $CourseList = CourseList::where('course_id',$id)->get();
        $percent_course = 0;
        if(count($CourseList) > 0){
            // Search % Course Answer
            foreach ($CourseList as $key => $value)
            {
                $percent = (100 / count($CourseList));
                $CourseList[$key]->percent  = $percent ;
                // คำถามทั้งหมด
                $question_sum = Questions::where('course_list_id',$value->id)->count();
                $CourseList[$key]->question_sum  = $question_sum ;
                // คำตอบ
                $courseAnswer = DB::table('answer_checktime')
                    ->join('course_lists','answer_checktime.course_list_id','=','course_lists.id')
                    ->select('answer_checktime.*','course_lists.course_name')
                    ->where('user_id','=',$user_id)
                    ->where('course_list_id','=',$value->id)
                    ->orderBy('id', 'DESC')
                    ->first();
                $CourseList[$key]->courseAnswer = $courseAnswer ;
                if ($courseAnswer != null){
                    // หาข้อที่ผ่าน และ ต้องตรวจแล้ว  Null
                    $answer_null  = Answers::where('idcheck',$courseAnswer->id)->where('pass',null)->count();
                    if($answer_null == 0) {

                        $answer_sum = Answers::where('idcheck', $courseAnswer->id)->count();
                        $answer_pass = Answers::where('idcheck', $courseAnswer->id)->where('pass', 0)->count();
                        $percent = (100 / $answer_sum) * $answer_pass;

                        $CourseList[$key]->answer_sum  = $answer_sum ;
                        $CourseList[$key]->answer_pass  = $answer_pass ;
                        $CourseList[$key]->answer_pass  = $percent ;
                        if($percent > 70){
                            $CourseList[$key]->answer_text = "สอบผ่าน";
                            $CourseList[$key]->answer_pass = true;
                        }else{
                            $CourseList[$key]->answer_text = "สอบยังไม่ผ่าน";
                            $CourseList[$key]->answer_pass = false;
                        }
                    }
                }else{
                    $CourseList[$key]->answer_text = "ยังไม่สอบ";
                    $CourseList[$key]->answer_pass = false;
                }
            }
            // Check Answer if (True) add Percent
            foreach ($CourseList as $key => $value){
                if($value->answer_pass == true){
                    $percent_course = $percent_course + $value->percent ;
                }
            }
        }
        return $percent_course;
    }

    public function show2($id)
    {
        if (Auth::user() != null) {
            $profile = Profile::join('bit_coins', 'bit_coins.profile_id', 'profiles.id')
                ->select('profiles.*', 'bit_coins.coins')
                ->where('profiles.user_id', '=', Auth::user()->id)
                ->first();
        } else {
            $profile = null;
        }
//        $check_Auction = QuotationPercentage::select('profile_id')
//            ->where('profile_id','=',$profile->id)
//            ->groupBy('profile_id')
//            ->get();
//        if(count($check_Auction) > 0){
        //echo "not null";
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



        $check_statusProjectWork = ProjectAuctionWork::join('works', 'works.id', '=', 'project_auction_works.work_id')
            ->select('project_auction_works.project_id','works.name as work_name', 'project_auction_works.id','project_auction_works.work_id',
                DB::raw('(CASE WHEN project_auction_works.status_machine = 0 && project_auction_works.install_machine != "" THEN "not" ELSE "record" END) AS "status_machine"'),
                DB::raw('(CASE WHEN project_auction_works.status_piping = 0 && project_auction_works.piping != "" THEN "not" ELSE "record" END) AS "status_piping"'),
                DB::raw('(CASE WHEN project_auction_works.status_control = 0 && project_auction_works.control != "" THEN "not" ELSE "record" END) AS "status_control"'),
                DB::raw('(CASE WHEN project_auction_works.status_main = 0 && project_auction_works.main != "" THEN "not" ELSE "record" END) AS "status_main"'),
                DB::raw('(CASE WHEN project_auction_works.status_duct = 0 && project_auction_works.duct_piping != "" THEN "not" ELSE "record" END) AS "status_duct"')
            )
            ->where('project_auction_works.project_id', '=', $id)
            ->get();


        $vrv_vrf_system = [];
        $sprit_type_system = [];
        $ventilation_system = [];
        $chiller_system = [];

        foreach ($check_statusProjectWork as $val) {
            if ($val->work_id == 1 && ($val->status_machine == "not" || $val->status_piping == "not" || $val->status_control == "not"
                    || $val->status_main == "not" || $val->status_duct == "not")) {
                $vrv_vrf_system = $val;
            } elseif ($val->work_id == 2 && ($val->status_machine == "not" || $val->status_piping == "not" || $val->status_control == "not"
                    || $val->status_main == "not" || $val->status_duct == "not")) {
                $sprit_type_system = $val;
            } elseif ($val->work_id == 3 && ($val->status_machine == "not" || $val->status_piping == "not" || $val->status_control == "not"
                    || $val->status_main == "not" || $val->status_duct == "not")) {
                $ventilation_system = $val;
            } elseif ($val->work_id == 4  && ($val->status_machine == "not" || $val->status_piping == "not" || $val->status_control == "not"
                    || $val->status_main == "not" || $val->status_duct == "not")) {
                $chiller_system = $val;
            }
        }

        echo "<br>";
        if (!empty($vrv_vrf_system)) {
            echo "VRV/VRF system" . "<br>";
            if ($vrv_vrf_system->status_machine == "not") {
                $type = "install_machine";
            } elseif ($vrv_vrf_system->status_piping == "not") {
                $type = "piping";
            } elseif ($vrv_vrf_system->status_control == "not") {
                $type = "control";
            } elseif ($vrv_vrf_system->status_main == "not") {
                $type = "main";
            } elseif ($vrv_vrf_system->status_duct == "not") {
                $type = "duct_piping";
            }
            echo $type."<br>";
            return view('frontend.quotation', [
                'projectAuction' => $projectAuction,
                'projectAuctionWorks' => $projectAuctionWorks,
                'projectAuctionGalleries' => $projectAuctionGalleries,
                'id' => $id,
                'type' => $type,
                'profile' => $profile,
            ]);
        }
        if (!empty($sprit_type_system)) {
            echo "Sprit type system" . "<br>";
            if ($sprit_type_system->status_machine == "not") {
                $type = "install_machine";
            } elseif ($sprit_type_system->status_piping == "not") {
                $type = "piping";
            } elseif ($sprit_type_system->status_control == "not") {
                $type = "control";
            } elseif ($sprit_type_system->status_main == "not") {
                $type = "main";
            } elseif ($sprit_type_system->status_duct == "not") {
                $type = "duct_piping";
            }
            echo $type."<br>";
            return view('frontend.quotation', [
                'projectAuction' => $projectAuction,
                'projectAuctionWorks' => $projectAuctionWorks,
                'projectAuctionGalleries' => $projectAuctionGalleries,
                'id' => $id,
                'type' => $type,
                'profile' => $profile,
            ]);
        }
        if (!empty($ventilation_system)) {
            echo "Ventilation system" . "<br>";
            if ($ventilation_system->status_machine == "not") {
                $type = "install_machine";
            } elseif ($ventilation_system->status_piping == "not") {
                $type = "piping";
            } elseif ($ventilation_system->status_control == "not") {
                $type = "control";
            } elseif ($ventilation_system->status_main == "not") {
                $type = "main";
            } elseif ($ventilation_system->status_duct == "not") {
                $type = "duct_piping";
            }
            echo $type."<br>";
            return view('frontend.quotation', [
                'projectAuction' => $projectAuction,
                'projectAuctionWorks' => $projectAuctionWorks,
                'projectAuctionGalleries' => $projectAuctionGalleries,
                'id' => $id,
                'type' => $type,
                'profile' => $profile,
            ]);
        }

        if (!empty($chiller_system)) {
            echo "Chiller system" . "<br>";
            if ($chiller_system->status_machine == "not") {
                $type = "install_machine";
            } elseif ($chiller_system->status_piping == "not") {
                $type = "piping";
            } elseif ($chiller_system->status_control == "not") {
                $type = "control";
            } elseif ($chiller_system->status_main == "not") {
                $type = "main";
            } elseif ($chiller_system->status_duct == "not") {
                $type = "duct_piping";
            }
            echo $type."<br>";
            return view('frontend.quotation', [
                'projectAuction' => $projectAuction,
                'projectAuctionWorks' => $projectAuctionWorks,
                'projectAuctionGalleries' => $projectAuctionGalleries,
                'id' => $id,
                'type' => $type,
                'profile' => $profile,
            ]);
        }
//        }else{
//            return redirect()->route('quotationPercentage.show', $id);
//        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd($id);
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


    }
}
