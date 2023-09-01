<?php

namespace App\Http\Controllers\backend;

use App\Models\PriceRange;
use App\Models\Profile;
use App\Models\Provinces;
use App\Models\Tags;
use App\Models\WorkComment;
use App\Models\WorkGallery;
use App\Models\WorkPosting;
use App\Models\WorkProcedure;
use App\Models\WorkService;
use App\Models\WorkTag;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminWorkController extends Controller
{
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
        //หมวดหมู่
        $tags2 =  Tags::orderBy('name')->get();
        //ราคา
        $priceRange = PriceRange::orderBy('price')->pluck('price', 'id');
        //สถานที่ปฏิบัติงาน
        $provinces = Provinces::orderBy('PROVINCE_NAME')->pluck('PROVINCE_NAME', 'PROVINCE_ID');


        $works = WorkPosting::join('tpye_work_postings','tpye_work_postings.id','=','work_postings.tpye_wp_id')
            ->join('price_ranges','price_ranges.id','=','work_postings.price_range_id')
            ->join('provinces', 'provinces.PROVINCE_ID', '=', 'work_postings.provinces_id')
            ->join('profiles','profiles.id','=','work_postings.profile_id')
            ->select('work_postings.*', 'tpye_work_postings.name','price_ranges.price','provinces.PROVINCE_NAME'
                ,'provinces.PROVINCE_NAME_ENG','profiles.firstname','profiles.lastname','profiles.image_profile')
            ->orderBy('id', 'desc')
            ->get();
        foreach ($works as $key => $work){
            $tags = WorkTag::join('tags','tags.id','=','work_tags.tag_id')
                ->select('tags.name', 'work_tags.wp_id','work_tags.tag_id')
                ->where('wp_id','=',$work->id)
                ->get();
            $works[$key]->tags = $tags ;
        }
//        dd($works);
        return view('backend.work.index',[
            'works' => $works ,
            'priceRange' => $priceRange ,
            'provinces' => $provinces ,
            'tags2' => $tags2 ,
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $w_postings = new WorkPosting();
        $now = new DateTime();
        $auth_id = Auth::user()->id;

        $profiles = DB::table('profiles')
            ->where('admin_id','=','$auth_id')
            ->first();

        $w_postings->title = $request->title;
        $w_postings->tpye_wp_id = $request->type_wp_id;
        $w_postings->detail_data = $request->detail_data;
        $w_postings->time_work = $request->time_work;
        $w_postings->price_range_id = $request->price_range;
        $w_postings->detail_price = $request->detail_price;
        $w_postings->profile_id = $profiles->id;
        $w_postings->provinces_id = $request->provinces_id;
        $w_postings->created_at = $now;
        $w_postings->updated_at = null;
        $w_postings->source = 2;
        $w_postings->save();

        $wp_id = $w_postings->id;

        if($request->tags != null){
            for ($i = 0 ; $i < count($request->tags);$i++){
                $wp_tag = new  WorkTag();
                $wp_tag->wp_id = $wp_id ;
                $wp_tag->tag_id = $request->tags[$i] ;
                $wp_tag->created_at =  $now;
                $wp_tag->updated_at =  null;
                $wp_tag->save();
            }
        }

        if($request->work_procedures != null){
            for ($i = 0 ; $i < count($request->work_procedures);$i++){
                $wp_procedures = new  WorkProcedure();
                $wp_procedures->wp_id =  $wp_id;
                $wp_procedures->detail =  $request->work_procedures[$i];
                $wp_procedures->created_at =  $now;
                $wp_procedures->updated_at =  null;
                $wp_procedures->save() ;
            }
        }

        if($request->listService != null){
            for ($i = 0 ; $i < count($request->listService);$i++){
                $wp_service = new WorkService();
                $wp_service->wp_id =  $wp_id;
                $wp_service->detail =  $request->listService[$i];
                $wp_service->created_at =  $now;
                $wp_service->updated_at =  null;
                $wp_service->save() ;
            }
        }

        if(!empty($request->file('work_gallery'))){
            /* insert file Gallery */
            if ($request->file('work_gallery') != ""){
                $count = count($request->file('work_gallery'));
                for ($i = 0 ; $i < $count;$i++){
                    $filename = 'gel_work_'.$request->tpye_wp_id."-".str_random(3).$wp_id.'.'.$request->file('work_gallery')[$i]->getClientOriginalExtension();
                    $request->work_gallery[$i]->move(public_path() . '/images/gallery-work/', $filename);
                    $image_gal[$i] = $filename;
                }
            }
            /* end */
            /* insert database WorkGallery */
            if($image_gal != null){
                for ($i = 0 ; $i < count($image_gal);$i++){
                    $gallery = new  WorkGallery();
                    $gallery->wp_id = $wp_id;
                    $gallery->filename = $image_gal[$i] ;
                    $gallery->created_at = $now;
                    $gallery->updated_at = null;
                    $gallery->save();
                }
            }
            /* end */
        }

        Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
        return redirect('admin/work');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $works = WorkPosting::join('tpye_work_postings','tpye_work_postings.id','=','work_postings.tpye_wp_id')
            ->join('price_ranges','price_ranges.id','=','work_postings.price_range_id')
            ->join('provinces', 'provinces.PROVINCE_ID', '=', 'work_postings.provinces_id')
            ->join('profiles','profiles.id','=','work_postings.profile_id')
            ->select('work_postings.*', 'tpye_work_postings.name','price_ranges.price','provinces.PROVINCE_NAME'
                ,'provinces.PROVINCE_NAME_ENG','profiles.firstname','profiles.lastname','profiles.image_profile')
            ->where('work_postings.id','=', $id)
            ->first();


        $tags = WorkTag::join('tags','tags.id','=','work_tags.tag_id')
            ->select('tags.name', 'work_tags.wp_id','work_tags.tag_id')
            ->where('work_tags.wp_id','=',$works->id)
            ->get();
        $works->tags = $tags ;

        $services = WorkService::where('wp_id','=',$id)->get();
        $work_gallery = WorkGallery::where('wp_id','=',$id)->get();
        $procedures = WorkProcedure::where('wp_id','=',$id)->get();
        $comments = WorkComment::where('wp_id','=',$id)->get();
//        dd($works);


        $wp_comment = WorkComment::where('wp_id', $id)->count('wp_id');
        $take = ($wp_comment > 4 )?$wp_comment-4:0 ;
        $comments_limit = WorkComment::join('users','users.id','=','work_comments.user_id')
            ->join('profiles','profiles.user_id','=','users.id')
            ->select('work_comments.*','users.name as username' ,'profiles.image_profile')
            ->where('wp_id','=',$id)
            ->orderBy('id','DESC')
            ->limit(4)
            ->get();
        $comments_skip = WorkComment::join('users','users.id','=','work_comments.user_id')
            ->join('profiles','profiles.user_id','=','users.id')
            ->select('work_comments.*','users.name as username','profiles.image_profile')
            ->where('wp_id','=',$id)
            ->orderBy('id','DESC')
            ->take($take)
            ->skip(4)
            ->get();

        return view('backend.work.show',[
            'works' => $works ,
            'work_gallery' => $work_gallery ,
            'services' => $services ,
            'procedures' => $procedures ,
            'comments' => $comments ,
            'wp_comment' => ($wp_comment != "")?$wp_comment:0,
            'comments_limit' => ($comments_limit != "")?$comments_limit:null,
            'comments_skip' => ($comments_skip != "")?$comments_skip:null,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $works = WorkPosting::join('tpye_work_postings','tpye_work_postings.id','=','work_postings.tpye_wp_id')
            ->join('price_ranges','price_ranges.id','=','work_postings.price_range_id')
            ->join('provinces', 'provinces.PROVINCE_ID', '=', 'work_postings.provinces_id')
            ->join('profiles','profiles.id','=','work_postings.profile_id')
            ->select('work_postings.*', 'tpye_work_postings.name','price_ranges.price','provinces.PROVINCE_NAME'
                ,'provinces.PROVINCE_NAME_ENG','profiles.firstname','profiles.lastname','profiles.image_profile')
            ->where('work_postings.id','=', $id)
            ->first();

        $tags = WorkTag::join('tags','tags.id','=','work_tags.tag_id')
            ->select('tags.name', 'work_tags.wp_id','work_tags.tag_id')
            ->where('work_tags.wp_id','=',$works->id)
            ->get();
        $works->tags = $tags ;

        $services = WorkService::where('wp_id','=',$id)->get();
        $work_gallery = WorkGallery::where('wp_id','=',$id)->get();
        $procedures = WorkProcedure::where('wp_id','=',$id)->get();
        $comments = WorkComment::where('wp_id','=',$id)->get();
//        dd($works);


        $wp_comment = WorkComment::where('wp_id', $id)->count('wp_id');
        $take = ($wp_comment > 4 )?$wp_comment-4:0 ;
        $comments_limit = WorkComment::join('users','users.id','=','work_comments.user_id')
            ->join('profiles','profiles.user_id','=','users.id')
            ->select('work_comments.*','users.name as username' ,'profiles.image_profile')
            ->where('wp_id','=',$id)
            ->orderBy('id','DESC')
            ->limit(4)
            ->get();
        $comments_skip = WorkComment::join('users','users.id','=','work_comments.user_id')
            ->join('profiles','profiles.user_id','=','users.id')
            ->select('work_comments.*','users.name as username','profiles.image_profile')
            ->where('wp_id','=',$id)
            ->orderBy('id','DESC')
            ->take($take)
            ->skip(4)
            ->get();

        return view('backend.work.edit',[
            'works' => $works ,
            'work_gallery' => $work_gallery ,
            'services' => $services ,
            'procedures' => $procedures ,
            'comments' => $comments ,
            'wp_comment' => ($wp_comment != "")?$wp_comment:0,
            'comments_limit' => ($comments_limit != "")?$comments_limit:null,
            'comments_skip' => ($comments_skip != "")?$comments_skip:null,
        ]);
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
