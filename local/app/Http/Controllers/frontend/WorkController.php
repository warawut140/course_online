<?php

namespace App\Http\Controllers\frontend;

use App\Http\Requests\StoreWorkRequest;
use App\Models\Logview;
use App\Models\Notification;
use App\Models\PriceRange;
use App\Models\Profile;
use App\Models\Provinces;
use App\Models\Tags;
use App\Models\TpyeWorkPosting;
use App\Models\WorkComment;
use App\Models\WorkGallery;
use App\Models\WorkMgmt;
use App\Models\WorkPosting;
use App\Models\WorkProcedure;
use App\Models\WorkService;
use App\Models\WorkTag;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class WorkController extends Controller
{
    /**
     * WorkController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show','searchWork']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //หมวดหมู่
        $tags = Tags::orderBy('name')->pluck('name', 'id');
        $tags2 = Tags::orderBy('name')->get();
        //ประเภทประกาศ
        $typeWP = TpyeWorkPosting::orderBy('name')->pluck('name', 'id');
        //ราคา
        $priceRange = PriceRange::orderBy('price')->pluck('price', 'id');
        //สถานที่ปฏิบัติงาน
        $provinces = Provinces::orderBy('PROVINCE_NAME')->pluck('PROVINCE_NAME', 'PROVINCE_ID');

        // Data Work Posting
        $works = WorkPosting::join('tpye_work_postings', 'tpye_work_postings.id', '=', 'work_postings.tpye_wp_id')
            ->join('price_ranges', 'price_ranges.id', '=', 'work_postings.price_range_id')
            ->join('provinces', 'provinces.PROVINCE_ID', '=', 'work_postings.provinces_id')
            ->join('profiles', 'profiles.id', '=', 'work_postings.profile_id')
            ->select('work_postings.*', 'tpye_work_postings.name', 'price_ranges.price', 'provinces.PROVINCE_NAME'
                , 'provinces.PROVINCE_NAME_ENG', 'profiles.firstname', 'profiles.lastname', 'profiles.image_profile')
            ->orderBy('id', 'desc')
//            ->get();
            ->paginate(8);
        foreach ($works as $key => $work) {
            $wp_tags = WorkTag::join('tags', 'tags.id', '=', 'work_tags.tag_id')
                ->select('tags.name', 'work_tags.wp_id', 'work_tags.tag_id')
                ->where('wp_id', '=', $work->id)
                ->get();
            $works[$key]->tags = $wp_tags;
        }
        foreach ($works as $key => $work) {
            //        $Logview = Logview::where('wp_id', $id)->sum('count');
            $Logview = Logview::where('wp_id', $work->id)->get();
            if ($Logview != null) {
//                $works[$key]->sum = $Logview;
                $works[$key]->sum = count($Logview);
            } else {
                $works[$key]->sum = 0;
            }

        }
        foreach ($works as $key => $work) {
            $wp_comment = WorkComment::where('wp_id', $work->id)->count('wp_id');
            if ($wp_comment != null) {
                $works[$key]->count = $wp_comment;
            } else {
                $works[$key]->count = 0;
            }
        }


        return view('frontend.work', [
            'tags' => $tags,
            'typeWP' => $typeWP,
            'priceRange' => $priceRange,
            'provinces' => $provinces,
            'works' => $works,
            'tags2' => $tags2,
        ]);
    }

    public function searchWork(Request $request)
    {

        //หมวดหมู่
        $tags = Tags::orderBy('name')->pluck('name', 'id');
        $tags2 = Tags::orderBy('name')->get();
        //ประเภทประกาศ
        $typeWP = TpyeWorkPosting::orderBy('name')->pluck('name', 'id');
        //ราคา
        $priceRange = PriceRange::orderBy('price')->pluck('price', 'id');
        //สถานที่ปฏิบัติงาน
        $provinces = Provinces::orderBy('PROVINCE_NAME')->pluck('PROVINCE_NAME', 'PROVINCE_ID');


//        dd($request->all());
        $arr = [];
        $search_work_tag = WorkTag::where('tag_id','=',$request->tags)->get();

//        dd($search_work_tag);

        if(count($search_work_tag) > 0){
            $works = WorkPosting::join('tpye_work_postings', 'tpye_work_postings.id', '=', 'work_postings.tpye_wp_id')
                ->join('price_ranges', 'price_ranges.id', '=', 'work_postings.price_range_id')
                ->join('provinces', 'provinces.PROVINCE_ID', '=', 'work_postings.provinces_id')
                ->join('profiles', 'profiles.id', '=', 'work_postings.profile_id')
                ->select('work_postings.*', 'tpye_work_postings.name', 'price_ranges.price', 'provinces.PROVINCE_NAME'
                    , 'provinces.PROVINCE_NAME_ENG', 'profiles.firstname', 'profiles.lastname', 'profiles.image_profile')
                ->where(function ($query) use ($search_work_tag , $arr, $request) {
                    if(count($search_work_tag) > 0){
                        for ($i = 0 ; $i < count($search_work_tag);$i++){
                            $arr[] = $search_work_tag[$i]['wp_id'];
                        }
                        $query->whereIn('work_postings.id', $arr);
                    }
                    if ($request->type_wp != null){
                        $query->where('work_postings.tpye_wp_id', $request->type_wp);
                    }
                    if ($request->price_range != null){
                        $query->where('work_postings.price_range_id', $request->price_range);
                    }
                    if ($request->provinces != null){
                        $query->where('work_postings.provinces_id', $request->provinces);
                    }
                })
                ->orderBy('id', 'desc')
                ->paginate(8);

            foreach ($works as $key => $work) {
                $wp_tags = WorkTag::join('tags', 'tags.id', '=', 'work_tags.tag_id')
                    ->select('tags.name', 'work_tags.wp_id', 'work_tags.tag_id')
                    ->where('wp_id', '=', $work->id)
                    ->get();
                $works[$key]->tags = $wp_tags;
            }
            foreach ($works as $key => $work) {
                $Logview = Logview::where('wp_id', $work->id)->sum('count');
                if ($Logview != null) {
                    $works[$key]->sum = $Logview;
                } else {
                    $works[$key]->sum = 0;
                }
            }
            foreach ($works as $key => $work) {
                $wp_comment = WorkComment::where('wp_id', $work->id)->count('wp_id');
                if ($wp_comment != null) {
                    $works[$key]->count = $wp_comment;
                } else {
                    $works[$key]->count = 0;
                }
            }
            return view('frontend.work', [
                'tags' => $tags,
                'typeWP' => $typeWP,
                'priceRange' => $priceRange,
                'provinces' => $provinces,
                'works' => $works,
                'tags2' => $tags2,
            ]);
        }else{
            $works = [];
            return view('frontend.work', [
                'tags' => $tags,
                'typeWP' => $typeWP,
                'priceRange' => $priceRange,
                'provinces' => $provinces,
                'works' => $works,
                'tags2' => $tags2,
            ]);
        }


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
    public function store(StoreWorkRequest $request)
    {
        $w_postings = new WorkPosting();
        $now = new DateTime();
        $auth_id = Auth::user()->id;
        $profileID = Profile::where('user_id', '=', $auth_id)->first();

        $w_postings->title = $request->title;
        $w_postings->tpye_wp_id = $request->type_wp_id;
        $w_postings->detail_data = $request->detail_data;
        $w_postings->time_work = $request->time_work;
        $w_postings->price_range_id = $request->price_range;
        $w_postings->detail_price = $request->detail_price;
        $w_postings->profile_id = $profileID->id;
        $w_postings->provinces_id = $request->provinces_id;
        $w_postings->created_at = $now;
        $w_postings->updated_at = null;
        $w_postings->save();

        $wp_id = $w_postings->id;

        if ($request->tags != null) {
            for ($i = 0; $i < count($request->tags); $i++) {
                $wp_tag = new  WorkTag();
                $wp_tag->wp_id = $wp_id;
                $wp_tag->tag_id = $request->tags[$i];
                $wp_tag->created_at = $now;
                $wp_tag->updated_at = null;
                $wp_tag->save();
            }
        }

        if ($request->work_procedures != null) {
            for ($i = 0; $i < count($request->work_procedures); $i++) {
                $wp_procedures = new  WorkProcedure();
                $wp_procedures->wp_id = $wp_id;
                $wp_procedures->detail = $request->work_procedures[$i];
                $wp_procedures->created_at = $now;
                $wp_procedures->updated_at = null;
                $wp_procedures->save();
            }
        }

        if ($request->listService != null) {
            for ($i = 0; $i < count($request->listService); $i++) {
                $wp_service = new WorkService();
                $wp_service->wp_id = $wp_id;
                $wp_service->detail = $request->listService[$i];
                $wp_service->created_at = $now;
                $wp_service->updated_at = null;
                $wp_service->save();
            }
        }

        if (!empty($request->file('work_gallery'))) {
            /* insert file Gallery */
            if ($request->file('work_gallery') != "") {
                $count = count($request->file('work_gallery'));
                for ($i = 0; $i < $count; $i++) {
                    $filename = 'gel_work_' . $request->tpye_wp_id . "-" . str_random(3) . $wp_id . '.' . $request->file('work_gallery')[$i]->getClientOriginalExtension();
                    $request->work_gallery[$i]->move(public_path() . '/images/gallery-work/', $filename);
                    $image_gal[$i] = $filename;
                }
            }
            /* end */
            /* insert database WorkGallery */
            if ($image_gal != null) {
                for ($i = 0; $i < count($image_gal); $i++) {
                    $gallery = new  WorkGallery();
                    $gallery->wp_id = $wp_id;
                    $gallery->filename = $image_gal[$i];
                    $gallery->created_at = $now;
                    $gallery->updated_at = null;
                    $gallery->save();
                }
            }
            /* end */
        }

        Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
        return redirect('work');
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
        $visitor = Logview::where('ip','=',$ip)
            ->where('wp_id','=',$id)
            ->first();
        if ($visitor == null){
            $logview = new Logview();
            $logview->wp_id = $id;
            $logview->ip = $ip;
            $logview->count = 1;
            $logview->created_at = $now;
            $logview->updated_at = null;
            $logview->save();
        }else{
            DB::table('logviews')
                ->where('ip', '=', $ip)
                ->where('wp_id', '=', $id)
                ->update([
                    'count' =>  $visitor->count + 1,
                    'updated_at' =>  $now ,
                ]);
        }

        $works = WorkPosting::join('tpye_work_postings', 'tpye_work_postings.id', '=', 'work_postings.tpye_wp_id')
            ->join('price_ranges', 'price_ranges.id', '=', 'work_postings.price_range_id')
            ->join('provinces', 'provinces.PROVINCE_ID', '=', 'work_postings.provinces_id')
            ->join('profiles', 'profiles.id', '=', 'work_postings.profile_id')
            ->select('work_postings.*', 'tpye_work_postings.name', 'price_ranges.price', 'provinces.PROVINCE_NAME'
                , 'provinces.PROVINCE_NAME_ENG', 'profiles.firstname', 'profiles.lastname', 'profiles.image_profile' , 'profiles.user_id')
            ->where('work_postings.id', '=', $id)
            ->first();

        $tags = WorkTag::join('tags', 'tags.id', '=', 'work_tags.tag_id')
            ->select('tags.name', 'work_tags.wp_id', 'work_tags.tag_id')
            ->where('work_tags.wp_id', '=', $works->id)
            ->get();
        $works->tags = $tags;

        $services = WorkService::where('wp_id', '=', $id)->get();
        $work_gallery = WorkGallery::where('wp_id', '=', $id)->get();
        $procedures = WorkProcedure::where('wp_id', '=', $id)->get();
        $comments = WorkComment::where('wp_id', '=', $id)->get();

//        $Logview = Logview::where('wp_id', $id)->sum('count');
        $Logview = Logview::where('wp_id', $id)->get();
        if ($Logview != null) {
//            $view = $Logview;
            $view = count($Logview);
        } else {
            $view = 0;
        }
        $profile_work = Profile::where('id', '=', $works->profile_id)->first();
        $works_all = WorkMgmt::where('owner_id',$profile_work->user_id)->whereIn('status',[4,5])->get();
        $works_success = WorkMgmt::where('owner_id',$profile_work->user_id)->where('status',4)->get();

        $portfolio_all = count($works_all);
        $portfolio_success = count($works_success);
        $percent = 0;
        if ($portfolio_success != null || $portfolio_success = 0) {
            $percent = (100 / $portfolio_all) * $portfolio_success;
        }


        $wp_comment = WorkComment::where('wp_id', $id)->count('wp_id');
        $take = ($wp_comment > 4) ? $wp_comment - 4 : 0;
        $comments_limit = WorkComment::join('users', 'users.id', '=', 'work_comments.user_id')
            ->join('profiles', 'profiles.user_id', '=', 'users.id')
            ->select('work_comments.*', 'users.name as username', 'profiles.image_profile')
            ->where('wp_id', '=', $id)
            ->orderBy('id', 'DESC')
            ->limit(4)
            ->get();
        $comments_skip = WorkComment::join('users', 'users.id', '=', 'work_comments.user_id')
            ->join('profiles', 'profiles.user_id', '=', 'users.id')
            ->select('work_comments.*', 'users.name as username', 'profiles.image_profile')
            ->where('wp_id', '=', $id)
            ->orderBy('id', 'DESC')
            ->take($take)
            ->skip(4)
            ->get();

        if (Auth::user() != null) {
            $profiles = Profile::where('user_id', '=', Auth::user()->id)->first();
            if ($works->profile_id == $profiles->id) {
                $edit = "edit";
                $msg = "msg";
            } else {
                $edit = "";
            }
        } else {
            $edit = "";
        }

        $sum_comment = DB::table('work_comments')
            ->select(DB::raw('sum(rate) as  sum_rate'))
            ->join('users', 'users.id', '=', 'work_comments.user_id')
            ->join('profiles', 'profiles.user_id', '=', 'users.id')
            ->where('wp_id', '=', $id)
            ->first();
        $count_comment = DB::table('work_comments')
            ->select(DB::raw('count(rate) as  count_rate'))
            ->join('users', 'users.id', '=', 'work_comments.user_id')
            ->join('profiles', 'profiles.user_id', '=', 'users.id')
            ->where('wp_id', '=', $id)
            ->first();
        $sum_comment2 = ($sum_comment->sum_rate != null)?$sum_comment->sum_rate:0;

        $result_review_comment = @($sum_comment2 / $count_comment->count_rate);
        $result_review_comment2 = (!is_nan($result_review_comment))?$result_review_comment:0;
        return view('frontend.article-work', [
            'now' => new DateTime(),
            'id' => $id,
            'works' => $works,
            'portfolio_all' => $portfolio_all,
            'percent' => $percent,
            'work_gallery' => $work_gallery,
            'services' => $services,
            'procedures' => $procedures,
            'comments' => $comments,
            'view' => $view,
            'wp_comment' => ($wp_comment != "") ? $wp_comment : 0,
            'comments_limit' => ($comments_limit != "") ? $comments_limit : null,
            'comments_skip' => ($comments_skip != "") ? $comments_skip : null,
            'edit' => $edit,
            'review_comment' => number_format($result_review_comment2,1),
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
        $works = WorkPosting::join('tpye_work_postings', 'tpye_work_postings.id', '=', 'work_postings.tpye_wp_id')
            ->join('price_ranges', 'price_ranges.id', '=', 'work_postings.price_range_id')
            ->join('provinces', 'provinces.PROVINCE_ID', '=', 'work_postings.provinces_id')
            ->join('profiles', 'profiles.id', '=', 'work_postings.profile_id')
            ->select('work_postings.*', 'tpye_work_postings.name', 'price_ranges.price', 'provinces.PROVINCE_NAME'
                , 'provinces.PROVINCE_NAME_ENG', 'profiles.firstname', 'profiles.lastname', 'profiles.image_profile')
            ->where('work_postings.id', '=', $id)
            ->first();

        $tags = WorkTag::join('tags', 'tags.id', '=', 'work_tags.tag_id')
            ->select('tags.name', 'work_tags.id', 'work_tags.wp_id', 'work_tags.tag_id')
            ->where('work_tags.wp_id', '=', $works->id)
            ->get();
        $works->tags = $tags;

        $services = WorkService::where('wp_id', '=', $id)->get();
        $work_gallery = WorkGallery::where('wp_id', '=', $id)->get();
        $procedures = WorkProcedure::where('wp_id', '=', $id)->get();
        $comments = WorkComment::where('wp_id', '=', $id)->get();

        $Logview = Logview::where('wp_id', $id)->get();
        if ($Logview != null) {
//            $view = $Logview;
            $view = count($Logview);
        } else {
            $view = 0;
        }

        $profile_work = Profile::where('id', '=', $works->profile_id)->first();
        $works_all = WorkMgmt::where('owner_id',$profile_work->user_id)->whereIn('status',[4,5])->get();
        $works_success = WorkMgmt::where('owner_id',$profile_work->user_id)->where('status',4)->get();


        $portfolio_all = count($works_all);
        $portfolio_success = count($works_success);
        $percent = 0;
        if ($portfolio_success != null || $portfolio_success = 0) {
            $percent = (100 / $portfolio_all) * $portfolio_success;
        }

        //สถานที่ปฏิบัติงาน
//        $provinces =Provinces::orderBy('PROVINCE_NAME')->pluck('PROVINCE_NAME', 'PROVINCE_ID');
        $provinces = Provinces::orderBy('PROVINCE_NAME')->get();
        //Tag
        $tags2 = Tags::orderBy('name')->get();
        //ราคา
//        $priceRange = PriceRange::orderBy('price')->pluck('price', 'id');
        $priceRange = PriceRange::orderBy('price')->get();
//        dd($works);

        $profiles = Profile::where('user_id', '=', Auth::user()->id)->first();
        if ($works->profile_id == $profiles->id) {
            return view('frontend.article-work-edit', [
                'now' => new DateTime(),
                'id' => $id,
                'works' => $works,
                'portfolio_all' => $portfolio_all,
                'percent' => $percent,
                'work_gallery' => $work_gallery,
                'services' => $services,
                'procedures' => $procedures,
                'comments' => $comments,
                'view' => $view,
                'provinces' => $provinces,
                'tags2' => $tags2,
                'priceRange' => $priceRange,
            ]);
        } else {
            Session::flash('warning', 'ไม่มีสิทธิ์เข้าถึง การใช้งาน!');
            return redirect('work/' . $id);
        }
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
        $now = new DateTime();
        // DELETE DATA : tags , image gallery , services , procedures
        if (!empty($request->del_tags)) {
            if ($request->count_tag != null) {
                for ($i = 0; $i < $request->count_tag; $i++) {
                    if (!empty($request->del_tags[$i])) {
                        WorkTag::destroy($request->del_tags[$i]);
                    }
                }
            }
        }
        if (!empty($request->del_image)) {
            if ($request->count_gallery != null) {
                for ($i = 0; $i < $request->count_gallery; $i++) {
                    if (!empty($request->del_image[$i])) {
                        $work_galleries = WorkGallery::find($request->del_image[$i]);
                        if ($work_galleries != null) {
                            File::delete(public_path() . '/images/gallery-work/' . $work_galleries->filename);
                            WorkGallery::destroy($request->del_image[$i]);
                        }

                    }
                }
            }
        }
        if (!empty($request->del_services)) {
            if ($request->count_services != null) {
                for ($i = 0; $i < $request->count_services; $i++) {
                    if (!empty($request->del_services[$i])) {
                        if ($request->del_services[$i] != null) {
                            WorkService::destroy($request->del_services[$i]);
                        }
                    }
                }
            }
        }
        if (!empty($request->del_procedures)) {
            if ($request->count_procedures != null) {
                for ($i = 0; $i < $request->count_procedures; $i++) {
                    if (!empty($request->del_procedures[$i])) {
                        WorkProcedure::destroy($request->del_procedures[$i]);
                    }
                }
            }
        }
        // ADD DATA : tags , image gallery , services , procedures
        if (!empty($request->tags)) {
//            echo "Add tags";
            for ($i = 0; $i < count($request->tags); $i++) {
                $wp_tag = new  WorkTag();
                $wp_tag->wp_id = $id;
                $wp_tag->tag_id = $request->tags[$i];
                $wp_tag->created_at = $now;
                $wp_tag->updated_at = $now;
                $wp_tag->save();
            }
        }
        if (!empty($request->file('work_gallery'))) {
            //echo "Add work gallery";
            /* insert file Gallery */
            if ($request->file('work_gallery') != "") {
                $count = count($request->file('work_gallery'));
                for ($i = 0; $i < $count; $i++) {
                    $filename = 'gel_work_' . $request->tpye_wp_id . "-" . str_random(3) . $id . '.' . $request->file('work_gallery')[$i]->getClientOriginalExtension();
                    $request->work_gallery[$i]->move(public_path() . '/images/gallery-work/', $filename);
                    $image_gal[$i] = $filename;
                }
            }
            /* end */
            /* insert database WorkGallery */
            if ($image_gal != null) {
                for ($i = 0; $i < count($image_gal); $i++) {
                    $gallery = new  WorkGallery();
                    $gallery->wp_id = $id;
                    $gallery->filename = $image_gal[$i];
                    $gallery->created_at = $now;
                    $gallery->updated_at = $now;
                    $gallery->save();
                }
            }
            /* end */
        }
        if (!empty($request->listService)) {
            echo "Add listService";
            for ($i = 0; $i < count($request->listService); $i++) {
                if ($request->listService[$i] != null) {
                    $wp_service = new WorkService();
                    $wp_service->wp_id = $id;
                    $wp_service->detail = $request->listService[$i];
                    $wp_service->created_at = $now;
                    $wp_service->updated_at = $now;
                    $wp_service->save();
                }
            }
        }
        if (!empty($request->work_procedures)) {
//            echo "Add work procedures";
            for ($i = 0; $i < count($request->work_procedures); $i++) {
                if ($request->work_procedures[$i] != null) {
                    $wp_procedures = new  WorkProcedure();
                    $wp_procedures->wp_id = $id;
                    $wp_procedures->detail = $request->work_procedures[$i];
                    $wp_procedures->created_at = $now;
                    $wp_procedures->updated_at = null;
                    $wp_procedures->save();
                }
            }
        }

        $w_postings = WorkPosting::find($id);
        $w_postings->title = $request->title;
        $w_postings->tpye_wp_id = $request->type_wp_id;
        $w_postings->detail_data = $request->detail_data;
        $w_postings->time_work = $request->time_work;
        $w_postings->price_range_id = $request->price_range;
        $w_postings->detail_price = $request->detail_price;
        $w_postings->provinces_id = $request->provinces_id;
        $w_postings->updated_at = $now;
        $w_postings->update();

        Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
        return redirect('work/' . $id);
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

    public function addComment(Request $request)
    {
        $now = new DateTime();
        $auth_id = Auth::user()->id;

        $workComment = new WorkComment();
        $workComment->details = $request->get('details');
        $workComment->rate = $request->get('rate');
        $workComment->wp_id = $request->get('wp_id');
        $workComment->user_id = $auth_id;
        $workComment->created_at = $now;
        $workComment->updated_at = null;
        $workComment->save();
        return response()->json([
            'success' => 'success',
//            'request' => $request ,
        ]);
    }

    public function mgmtWork($id)
    {

        $works = WorkPosting::join('tpye_work_postings', 'tpye_work_postings.id', '=', 'work_postings.tpye_wp_id')
            ->join('price_ranges', 'price_ranges.id', '=', 'work_postings.price_range_id')
            ->join('provinces', 'provinces.PROVINCE_ID', '=', 'work_postings.provinces_id')
            ->join('profiles', 'profiles.id', '=', 'work_postings.profile_id')
            ->select('work_postings.*', 'tpye_work_postings.name', 'price_ranges.price', 'provinces.PROVINCE_NAME'
                , 'provinces.PROVINCE_NAME_ENG', 'profiles.firstname', 'profiles.lastname', 'profiles.image_profile')
            ->where('work_postings.id', '=', $id)
            ->first();

        $tags = WorkTag::join('tags', 'tags.id', '=', 'work_tags.tag_id')
            ->select('tags.name', 'work_tags.id', 'work_tags.wp_id', 'work_tags.tag_id')
            ->where('work_tags.wp_id', '=', $works->id)
            ->get();
        $works->tags = $tags;

        $services = WorkService::where('wp_id', '=', $id)->get();
        $work_gallery = WorkGallery::where('wp_id', '=', $id)->get();
        $procedures = WorkProcedure::where('wp_id', '=', $id)->get();
        $comments = WorkComment::where('wp_id', '=', $id)->get();

        $Logview = Logview::where('wp_id', $id)->get();
        if ($Logview != null) {
//            $view = $Logview;
            $view = count($Logview);
        } else {
            $view = 0;
        }

        $profile_work = Profile::where('id', '=', $works->profile_id)->first();
        $works_all = WorkMgmt::where('owner_id',$profile_work->user_id)->whereIn('status',[4,5])->get();
        $works_success = WorkMgmt::where('owner_id',$profile_work->user_id)->where('status',4)->get();

        $portfolio_all = count($works_all);
        $portfolio_success = count($works_success);
        $percent = 0;
        if ($portfolio_success != null || $portfolio_success = 0) {
            $percent = (100 / $portfolio_all) * $portfolio_success;
        }


        $profiles = Profile::where('user_id', '=', Auth::user()->id)->first();

        $users = DB::table('users')
        ->select('users.id', 'users.name', 'users.email', 'profiles.firstname', 'profiles.lastname')
        ->join('profiles', 'users.id', '=', 'profiles.user_id')
        ->get();

        if ($works->profile_id == $profiles->id) {
            return view('frontend.article-work-mgmt', [
                'now' => new DateTime(),
                'id' => $id,
                'works' => $works,
                'portfolio_all' => $portfolio_all,
                'percent' => $percent,
                'work_gallery' => $work_gallery,
                'services' => $services,
                'procedures' => $procedures,
                'comments' => $comments,
                'view' => $view,
                'users' => $users,
            ]);
        } else {
            Session::flash('warning', 'ไม่มีสิทธิ์เข้าถึง การใช้งาน!');
            return redirect('work/' . $id);
        }
    }

    // Search User Name or Email or Profile
    public function search(Request $request)
    {
        $search = $request->get('term');

//        $result = User::where('name', 'LIKE', '%'. $search. '%')->get();

        $result = DB::table('users')
            ->select('users.id', 'users.name', 'users.email', 'profiles.firstname', 'profiles.lastname')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->where(function ($query) use ($search) {
                $query->where('users.name', 'like', '%' . $search . '%')
//                    ->orWhere('users.email', 'like' , '%'. $search .'%')
                    ->orWhere('profiles.firstname', 'like', '%' . $search . '%')
                    ->orWhere('profiles.lastname', 'like', '%' . $search . '%');
            })
            ->get();

        return response()->json($result);
    }

    public function addMgmtWork(Request $request)
    {
    //    dd($request->all());
if($request->user_id_to==null||$request->user_id_to==''){
    Session::flash('error', 'กรุณาระบุ ผู้จ้างงาน หรือรับงาน ให้ถูกต้อง!');
    return redirect('mgmt-work/' . $request->wp_id);
}
        $now = new DateTime();
        $auth_id = Auth::user()->id;

        $work_mgmts = new  WorkMgmt();
        $work_mgmts->wp_id = $request->wp_id;
        $work_mgmts->title = $request->title;
        $work_mgmts->price = $request->price;
        $work_mgmts->detail_scope = $request->detail_scope;
        $work_mgmts->start_date = $request->start_date;
        $work_mgmts->end_date = $request->end_date;
        $work_mgmts->status = 1;
        $work_mgmts->user_id = $request->user_id_to;
        $work_mgmts->owner_id = $auth_id;
        $work_mgmts->created_at = $now;
        $work_mgmts->updated_at = null;
        $work_mgmts->save();

        $notification = new Notification();
        $notification->detail = "อนุมัติงาน $request->work_title , โครงการ $request->title ของหน้าประกาศงาน";
        $notification->path = 'approve-work/' . $request->wp_id . '/' . $work_mgmts->id;
        $notification->type = 'work';
        $notification->btn_name = 'อนุมัติงาน';
        $notification->isActive = 0;
        $notification->user_id_send = $auth_id;
        $notification->user_id_to = $request->user_id_to;
        $notification->created_at = $now;
        $notification->updated_at = null;
        $notification->save();

        $user = User::find($request->user_id_to);
        $profile = Profile::where('user_id', '=', $request->user_id_to)->first();
        $data['fullname'] = $profile->firstname . ' ' . $profile->lastname;
        $fullname = $profile->firstname . ' ' . $profile->lastname;
        $data['title'] = "อนุมัติงาน $request->work_title , โครงการ $request->title ของหน้าประกาศงาน";
        $data['details'] = $request->detail_scope;
        $data['price'] = $request->price;
        $data['date'] = date('d/m/Y',strtotime($request->start_date)) . ' ถึง ' . date('d/m/Y',strtotime($request->end_date));
        $data['url'] = 'approve-work/' . $request->wp_id . '/' . $work_mgmts->id;

//        dd($user);

        Mail::send('frontend.emails.email_approve_work', $data, function ($message) use ($user, $fullname) {
            $message->to($user->email, $fullname)
                ->subject('Phungngan (ประกาศงาน)');
        });

        if (Mail::failures()) {
            Log::info('Email Sent. inbox @ ' . $user->email . ' :(' . $request->wp_id . '/' . $work_mgmts->id . ') Sorry! Please try again latter : ' . \Carbon\Carbon::now());
        } else {
            Log::info('Email Sent. inbox @ ' . $user->email . ' :(' . $request->wp_id . '/' . $work_mgmts->id . ')Great! Successfully send in your mail : ' . \Carbon\Carbon::now());
        }

        Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
        return redirect('mgmt-work/' . $request->wp_id);
    }

    public function approveWork($wpID, $id)
    {
//        echo "Work : " . $wpID . " , work_mgmts : " . $id;
        $approve_work = WorkMgmt::find($id);


        if (Auth::user()->id == $approve_work->user_id || Auth::user()->id == $approve_work->owner_id) {
            $p_project = Profile::where('user_id','=',$approve_work->owner_id)->first();
            $p_owner = Profile::where('user_id','=',$approve_work->user_id)->first();
            $works = WorkPosting::join('tpye_work_postings', 'tpye_work_postings.id', '=', 'work_postings.tpye_wp_id')
                ->join('price_ranges', 'price_ranges.id', '=', 'work_postings.price_range_id')
                ->join('provinces', 'provinces.PROVINCE_ID', '=', 'work_postings.provinces_id')
                ->join('profiles', 'profiles.id', '=', 'work_postings.profile_id')
                ->select('work_postings.*', 'tpye_work_postings.name', 'price_ranges.price', 'provinces.PROVINCE_NAME'
                    , 'provinces.PROVINCE_NAME_ENG', 'profiles.firstname', 'profiles.lastname', 'profiles.image_profile')
                ->where('work_postings.id', '=', $wpID)
                ->first();

            $tags = WorkTag::join('tags', 'tags.id', '=', 'work_tags.tag_id')
                ->select('tags.name', 'work_tags.id', 'work_tags.wp_id', 'work_tags.tag_id')
                ->where('work_tags.wp_id', '=', $works->id)
                ->get();
            $works->tags = $tags;

            $services = WorkService::where('wp_id', '=', $wpID)->get();
            $work_gallery = WorkGallery::where('wp_id', '=', $wpID)->get();
            $procedures = WorkProcedure::where('wp_id', '=', $wpID)->get();
            $comments = WorkComment::where('wp_id', '=', $wpID)->get();


            $Logview = Logview::where('wp_id', $wpID)->get();
            if ($Logview != null) {
//            $view = $Logview;
                $view = count($Logview);
            } else {
                $view = 0;
            }
            $profile_work = Profile::where('id', '=', $works->profile_id)->first();
            $works_all = WorkMgmt::where('owner_id',$profile_work->user_id)->whereIn('status',[4,5])->get();
            $works_success = WorkMgmt::where('owner_id',$profile_work->user_id)->where('status',4)->get();

            $portfolio_all = count($works_all);
            $portfolio_success = count($works_success);
            $percent = 0;
            if ($portfolio_success != null || $portfolio_success = 0) {
                $percent = (100 / $portfolio_all) * $portfolio_success;
            }

//            dd($approve_work);
            if(Auth::user()->id == $approve_work->user_id){
                $comment = 'yes';
            }else{
                $comment = null;
            }
            return view('frontend.article-work-approve', [
                'wpID' => $wpID,
                'id' => $id,
                'approve_work' => $approve_work,
                'works' => $works,
                'portfolio_all' => $portfolio_all,
                'percent' => $percent,
                'work_gallery' => $work_gallery,
                'services' => $services,
                'procedures' => $procedures,
                'comments' => $comments,
                'view' => $view,
                'p_owner' => $p_owner,
                'user_id_send' => $approve_work->owner_id,
                'user_id_to' => $approve_work->user_id ,
                'comment' => $comment ,
            ]);
        } else {
            Session::flash('warning', 'ไม่มีสิทธิ์เข้าถึง การใช้งาน!');
            return redirect('work/'.$wpID);
        }
    }

    public function addApprove(Request $request)
    {
//        dd($request->all());
        $approve_work = WorkMgmt::find($request->id);
        $approve_work->status = $request->approve;
        $approve_work->update();

        $now = new DateTime();
        $text = ($request->approve == 3)?'อนุมัตื':'ไม่อนุมัติ';
        $notification = new Notification();
        $notification->detail = "งาน $request->title "."<br>"."สถานะ $text";
        $notification->path = 'approve-work/' . $request->wp_id . '/' . $request->id;
        $notification->type = 'work';
        $notification->btn_name = 'ดูงาน';
        $notification->isActive = 0;
        $notification->user_id_send = $request->user_id_send;
        $notification->user_id_to = $request->user_id_to;
        $notification->created_at = $now;
        $notification->updated_at = null;
        $notification->save();


        Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
        return redirect('approve-work/' . $request->wp_id.'/'.$request->id);
    }

    //API
    public function getApiMgmtWork($id)
    {

        $work_mgmts = WorkMgmt::where('wp_id','=',$id)->orderBy('id','desc')->get();

        foreach ($work_mgmts as $key => $mgmt){
            $profile = Profile::where('user_id',$mgmt->user_id)->first();
            $work_mgmts[$key]->fullname = $profile->firstname.' '.$profile->lastname;
            list($year, $month, $day) = explode('-', date('Y-m-d', strtotime($mgmt->start_date)));
            if ($day < 10) {
                $day = substr($day, 1, 1);
            }

            $thMonth = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
                "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
            if ($month < 10) {
                $month = substr($month, 1, 1);
            }
            $year += 543;
            $work_mgmts[$key]->start_date = $day . " " . $thMonth[$month - 1] . " " . $year;
            list($year, $month, $day) = explode('-', date('Y-m-d', strtotime($mgmt->end_date)));
            if ($day < 10) {
                $day = substr($day, 1, 1);
            }
            $thMonth = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
                "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
            if ($month < 10) {
                $month = substr($month, 1, 1);
            }
            $year += 543;
            $work_mgmts[$key]->end_date = $day .' '. $thMonth[$month - 1] . " " . $year;

            if($mgmt->status == 1)    $work_mgmts[$key]->status_name =  'รออนุมัติ';
            elseif($mgmt->status == 2)   $work_mgmts[$key]->status_name = 'ไม่อนุมัติ';
            elseif($mgmt->status == 3)    $work_mgmts[$key]->status_name = 'เริ่มงาน';
            elseif($mgmt->status == 4)    $work_mgmts[$key]->status_name = 'เสร็จสิ้น';
            elseif($mgmt->status == 5)    $work_mgmts[$key]->status_name = 'ยกเลิกงาน';
            else $work_mgmts[$key]->status_name =  '';
        }
        return response()->json($work_mgmts);
    }

    public function getUpdateWork($id)
    {
        DB::table('work_mgmts')
            ->where('id','=',$id)
            ->update([
                'status' => 4
            ]);

        // แจ้งเตืออีก
        $data_work = WorkMgmt::where('id','=',$id)->first();
        $user = User::find($data_work->user_id);
        $profile = Profile::where('user_id', '=', $user->id)->first();

        $now = new DateTime();
        $notification = new Notification();
        $notification->detail = "งาน $data_work->title "."<br>"."สถานะเสร็จสิ้น";
        $notification->path = 'approve-work/' . $data_work->wp_id . '/' . $data_work->id;
        $notification->type = 'work';
        $notification->btn_name = 'รีวิวงาน';
        $notification->isActive = 0;
        $notification->user_id_send = $data_work->owner_id;
        $notification->user_id_to = $data_work->user_id;
        $notification->created_at = $now;
        $notification->updated_at = null;
        $notification->save();

        $data['fullname'] = $profile->firstname . ' ' . $profile->lastname;
        $fullname = $profile->firstname . ' ' . $profile->lastname;
        $data['title'] = "$data_work->work_title , โครงการ $data_work->title ของหน้าประกาศงาน";
        $data['details'] = $data_work->detail_scope;
        $data['price'] = $data_work->price;
        $data['date'] = date('d/m/Y',strtotime($data_work->start_date)) . ' ถึง ' . date('d/m/Y',strtotime($data_work->end_date));
        $data['url'] = 'approve-work/' . $data_work->wp_id . '/' . $data_work->id;

        Mail::send('frontend.emails.work-update', $data, function ($message) use ($user, $fullname) {
            $message->to($user->email, $fullname)
                ->subject('Phungngan (ประกาศงาน) สถานะเสร็จสิ้น');
        });

        if (Mail::failures()) {
            Log::info('Email Sent. inbox @ ' . $user->email . ' :(' . $data_work->wp_id . '/' . $data_work->id . ') Sorry! Please try again latter : ' . \Carbon\Carbon::now());
        } else {
            Log::info('Email Sent. inbox @ ' . $user->email . ' :(' . $data_work->wp_id . '/' . $data_work->id . ')Great! Successfully send in your mail : ' . \Carbon\Carbon::now());
        }

        return response()->json([
            'success' => 'success',
            'id' => $id,
        ]);
    }

    public function getDeleteWork($id)
    {
        DB::table('work_mgmts')
            ->where('id','=',$id)
            ->update([
               'status' => 5
            ]);

        // แจ้งเตืออีก
        $data_work = WorkMgmt::where('id','=',$id)->first();
        $user = User::find($data_work->user_id);
        $profile = Profile::where('user_id', '=', $user->id)->first();

        $now = new DateTime();
        $notification = new Notification();
        $notification->detail = "งาน $data_work->title "."<br>"."สถานะยกเลิก";
        $notification->path = 'approve-work/' . $data_work->wp_id . '/' . $data_work->id;
        $notification->type = 'work';
        $notification->btn_name = 'ดูงาน';
        $notification->isActive = 0;
        $notification->user_id_send = $data_work->owner_id;
        $notification->user_id_to = $data_work->user_id;
        $notification->created_at = $now;
        $notification->updated_at = null;
        $notification->save();

        $data['fullname'] = $profile->firstname . ' ' . $profile->lastname;
        $fullname = $profile->firstname . ' ' . $profile->lastname;
        $data['title'] = "$data_work->work_title , โครงการ $data_work->title ของหน้าประกาศงาน";
        $data['details'] = $data_work->detail_scope;
        $data['price'] = $data_work->price;
        $data['date'] = date('d/m/Y',strtotime($data_work->start_date)) . ' ถึง ' . date('d/m/Y',strtotime($data_work->end_date));
        $data['url'] = 'approve-work/' . $data_work->wp_id . '/' . $data_work->id;

        Mail::send('frontend.emails.work-delete', $data, function ($message) use ($user, $fullname) {
            $message->to($user->email, $fullname)
                ->subject('Phungngan (ประกาศงาน) สถานะยกเลิก');
        });

        if (Mail::failures()) {
            Log::info('Email Sent. inbox @ ' . $data_work->email . ' :(' . $data_work->wp_id . '/' . $data_work->id . ') Sorry! Please try again latter : ' . \Carbon\Carbon::now());
        } else {
            Log::info('Email Sent. inbox @ ' . $data_work->email . ' :(' . $data_work->wp_id . '/' . $data_work->id . ')Great! Successfully send in your mail : ' . \Carbon\Carbon::now());
        }

        return response()->json([
            'success' => 'success',
            'id' => $id,
        ]);
    }

}
