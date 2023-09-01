<?php

namespace App\Http\Controllers\frontend;

use App\Models\Percent;
use App\Models\Profile;
use App\Models\ProjectAuction;
use App\Models\ProjectAuctionGallery;
use App\Models\ProjectAuctionWork;
use App\Models\QuotationPercentage;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class QuotationPercentageController extends Controller
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
        $now = new DateTime();
        $percentage = Percent::select('id','name')->where('title_type','=',1)->get();
        foreach ($percentage as $value){
            if($value->id == 29){
                for ($i = 0 ; $i < count($request->cost_of_offer[29]);$i++){
                    $quotationPercentage = new QuotationPercentage();
                    $quotationPercentage->percent_id = $value->id;
                    $quotationPercentage->name = $request->other[$value->id][$i];
                    $quotationPercentage->cost_of_offer = $request->cost_of_offer[$value->id][$i];
                    $quotationPercentage->cost_of_invest = $request->cost_of_invest[$value->id][$i];
                    $quotationPercentage->labor_cost_offer = $request->labor_cost_offer[$value->id][$i];
                    $quotationPercentage->labor_cost_invest = $request->labor_cost_invest[$value->id][$i];
                    $quotationPercentage->profile_id = $request->profile_id;
                    $quotationPercentage->project_auctions_id = $request->project_auctions_id;
                    $quotationPercentage->created_at = $now;
                    $quotationPercentage->updated_at = null;
                    $quotationPercentage->save();
                }
            }else{
                $quotationPercentage = new QuotationPercentage();
                $quotationPercentage->percent_id = $value->id;
                $quotationPercentage->name = $value->name;
                $quotationPercentage->cost_of_offer = $request->cost_of_offer[$value->id][0];
                $quotationPercentage->cost_of_invest = $request->cost_of_invest[$value->id][0];
                $quotationPercentage->labor_cost_offer = $request->labor_cost_offer[$value->id][0];
                $quotationPercentage->labor_cost_invest = $request->labor_cost_invest[$value->id][0];
                $quotationPercentage->profile_id = $request->profile_id;
                $quotationPercentage->project_auctions_id = $request->project_auctions_id;
                $quotationPercentage->created_at = $now;
                $quotationPercentage->updated_at = null;
                $quotationPercentage->save();
            }
        }
        return redirect()->route('quotation.show', $request->project_auctions_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
//        dd($projectAuction);
        $projectAuctionWorks = ProjectAuctionWork::join('works', 'works.id', 'project_auction_works.work_id')
            ->select('project_auction_works.*', 'works.name as work_name')
            ->where('project_id', '=', $id)
            ->get();
        $projectAuctionGalleries = ProjectAuctionGallery::where('project_id', '=', $id)->get();


        if (Auth::user() != null) {
            $profile = Profile::join('bit_coins', 'bit_coins.profile_id', 'profiles.id')
                ->select('profiles.*', 'bit_coins.coins')
                ->where('profiles.user_id', '=', Auth::user()->id)
                ->first();
        } else {
            $profile = null;
        }


        return view('frontend.quotationPercentage', [
            'projectAuction' => $projectAuction,
            'projectAuctionWorks' => $projectAuctionWorks,
            'projectAuctionGalleries' => $projectAuctionGalleries,
            'id' => $id,
            'profile' => $profile,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
}
