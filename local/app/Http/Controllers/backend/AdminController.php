<?php

namespace App\Http\Controllers\backend;

use App\Models\Profile;
use App\Models\ProjectAuction;
use App\Models\Suggests;
use App\Models\WorkPosting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
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
        $count_work = WorkPosting::count();
        $count_suggest = Suggests::count();
        $count_project_auctions = ProjectAuction::count();
        $count_profile = Profile::count();
        $count_profile1 = Profile::count('type_user_id');
        $count_profile2 = Profile::count('type_user_id_2');
        $count_profile3 = Profile::count('type_user_id_3');



        $year = date('Y');
        $month = [];
        for ($i = 1 ; $i <= 12 ; $i++){
            $data = ProjectAuction::whereYear('created_at',$year)
                ->whereMonth('created_at',$i)
                ->get();
            $month[$i] = count($data);
        }


        return view('backend.index',[
            'count_work' => $count_work ,
            'count_suggest' => $count_suggest ,
            'count_project_auctions' => $count_project_auctions ,
            'count_profile' => $count_profile ,
            'count_profile1' => $count_profile1 ,
            'count_profile2' => $count_profile2 ,
            'count_profile3' => $count_profile3 ,
            'year' => $year ,
            'month' => $month ,
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
}
