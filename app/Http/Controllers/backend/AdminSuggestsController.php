<?php

namespace App\Http\Controllers\backend;

use App\Models\SuggestGallerys;
use App\Models\SuggestLogView;
use App\Models\Suggests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminSuggestsController extends Controller
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
        $suggests = Suggests::join('tpye_suggests','tpye_suggests.id','=','suggests.type_suggest_id')
            ->join('users','users.id','=','suggests.user_id')
            ->join('profiles','profiles.user_id','=','suggests.user_id')
            ->select('suggests.*','tpye_suggests.name','users.name as username','profiles.firstname','profiles.lastname'
                ,'profiles.image_profile')
            ->orderBy('id','desc')->get();

        return view('backend.suggest.index',[
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
        $suggests = Suggests::join('tpye_suggests','tpye_suggests.id','=','suggests.type_suggest_id')
            ->join('users','users.id','=','suggests.user_id')
            ->join('profiles','profiles.user_id','=','suggests.user_id')
            ->select('suggests.*','tpye_suggests.name','users.name as username','profiles.firstname','profiles.lastname'
                ,'profiles.image_profile')
            ->where('suggests.id','=',$id)
            ->orderBy('id','desc')
            ->first();
        $suggestsGallery = SuggestGallerys::where('suggest_id','=',$id)->get();
        $suggestsCount = SuggestLogView::select(DB::raw('sum(count) as total'))
            ->where('suggest_id','=',$id)
            ->groupBy('suggest_id')
            ->get();
        return view('backend.suggest.show',[
            'suggests' => $suggests ,
            'suggestsGallery' => $suggestsGallery ,
            'suggestsCount' => $suggestsCount ,
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
