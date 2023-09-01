<?php

namespace App\Http\Controllers\frontend;

use App\Models\Profile;
use App\Models\SuggestComment;
use App\Models\SuggestGallerys;
use App\Models\SuggestLogView;
use App\Models\Suggests;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SuggestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suggests = Suggests::join('tpye_suggests','tpye_suggests.id','=','suggests.type_suggest_id')
            ->join('users','users.id','=','suggests.user_id')
            ->join('profiles','profiles.user_id','=','suggests.user_id')
            ->select('suggests.*','tpye_suggests.name as type_suggest','users.name as username','profiles.firstname','profiles.lastname'
                ,'profiles.image_profile')
            ->orderBy('id','desc')
//            ->get();
            ->paginate(8);


        foreach ($suggests as $key => $item){
//            $suggestsCount = SuggestLogView::select(DB::raw('sum(count) as total'))
//                ->where('suggest_id','=',$item->id)
//                ->groupBy('suggest_id')
//                ->first();
            $suggestsCount = SuggestLogView::where('suggest_id','=',$item->id)
                ->get();
            $suggests[$key]->total =  ($suggestsCount == null)?0:count($suggestsCount);
            $suggestsCountCM = SuggestComment::select(DB::raw('count(suggest_id) as total'))
                ->where('suggest_id','=',$item->id)
                ->groupBy('suggest_id')
                ->first();
            $suggests[$key]->commentTotal =  ($suggestsCountCM == null)?0:$suggestsCountCM->total;
        }

//        dd($suggests);

        return view('frontend.suggest',[
            'suggests' => $suggests
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

//        dd($request->all());
        $now = new DateTime();
        $auth_id = Auth::user()->id;
        $suggest = new Suggests();
        $suggest->title = $request->title;
        $suggest->type_suggest_id = $request->type_suggest_id;
        $suggest->details = $request->details;
        $suggest->user_id = $auth_id;
        $suggest->created_at = $now;
        $suggest->updated_at = null;
        $suggest->save();
        $suggest_id = $suggest->id;
        if(!empty($request->file('galley'))){
            /* insert file Gallery */
            if ($request->file('galley') != ""){
                $count = count($request->file('galley'));
                for ($i = 0 ; $i < $count;$i++){
                    $filename = 'suggest_type_'.$request->type_suggest_id."-".str_random(3).$suggest_id.'.'.$request->file('galley')[$i]->getClientOriginalExtension();
                    $request->galley[$i]->move(public_path() . '/images/suggest/', $filename);
                    $image_gal[$i] = $filename;
                }
            }
            /* end */
            /* insert database SuggestGallerys */
            if($image_gal != null){
                for ($i = 0 ; $i < count($image_gal);$i++){
                    $gallery = new  SuggestGallerys();
                    $gallery->filename = $image_gal[$i];
                    $gallery->suggest_id =  $suggest_id;
                    $gallery->created_at = $now;
                    $gallery->updated_at = null;
                    $gallery->save();
                }
            }
            /* end */
        }
        Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
        return redirect('suggest/'.$suggest_id);
    }


    public function storeComment(Request $request)
    {
        $now = new DateTime();
        $auth_id = Auth::user()->id;
        $auth_name = Auth::user()->name;
        $suggest_comment = new SuggestComment();
        $suggest_comment->details = $request->details;
        $suggest_comment->suggest_id = $request->suggest_id;
        $suggest_comment->actby = $auth_name;
        $suggest_comment->user_id = $auth_id;
        $suggest_comment->created_at = $now;
        $suggest_comment->updated_at = null;
        $suggest_comment->save();

        Session::flash('status', 'Comment เรียบร้อย !');
        return redirect('suggest/'.$request->suggest_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $now = new DateTime();
        $ip = \Request::getClientIp(true);
        $visitor = SuggestLogView::where('ip','=',$ip)
            ->where('suggest_id','=',$id)
            ->first();
        if ($visitor == null){
            $logview = new SuggestLogView();
            $logview->suggest_id = $id;
            $logview->ip = $ip;
            $logview->count = 1;
            $logview->created_at = $now;
            $logview->updated_at = null;
            $logview->save();
        }else{
            DB::table('suggest_log_views')
                ->where('ip', '=', $ip)
                ->where('suggest_id', '=', $id)
                ->update([
                    'count' =>  $visitor->count + 1,
                    'updated_at' =>  $now ,
                ]);
        }

        $suggests = Suggests::join('tpye_suggests','tpye_suggests.id','=','suggests.type_suggest_id')
            ->join('users','users.id','=','suggests.user_id')
            ->join('profiles','profiles.user_id','=','suggests.user_id')
            ->select('suggests.*','tpye_suggests.name','users.name as username','profiles.firstname','profiles.lastname'
                ,'profiles.image_profile','profiles.id as profile_id')
            ->where('suggests.id','=',$id)
            ->orderBy('id','desc')
            ->first();
        $suggestsGallery = SuggestGallerys::where('suggest_id','=',$id)->get();
        $suggestsComment = SuggestComment::where('suggest_id','=',$id)
            ->paginate(8);

        if (Auth::user() != null) {
            $profiles = Profile::where('user_id', '=', Auth::user()->id)->first();
            if ($suggests->profile_id == $profiles->id) {
                $edit = "edit";
                $msg = "msg";
            } else {
                $edit = "";
            }
        } else {
            $edit = "";
        }

        return view('frontend.article-suggest',[
            'id' => $id ,
            'suggests' => $suggests ,
            'suggestsGallery' => $suggestsGallery ,
            'suggestsComment' => $suggestsComment ,
            'edit' => $edit ,
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
