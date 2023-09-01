<?php

namespace App\Http\Controllers\backend;

use App\Models\Percent;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminPercentsController extends Controller
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
        $percents = Percent::all();
        return view('backend.percents.index',[
            'percents' => $percents
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
        $percents = Percent::find($id);
        return response()->json($percents);
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
        $now = new DateTime();
        $auth_name = Auth::user()->name;
        $percents = Percent::find($id);
        $percents->cost_of_offer = $request->get('cost_of_offer');
        $percents->cost_of_invest = $request->get('cost_of_invest');
        $percents->labor_cost_offer = $request->get('labor_cost_offer');
        $percents->labor_cost_invest = $request->get('labor_cost_invest');
        $percents->actby = $auth_name;
        if($percents->created_at == null){
            $percents->created_at = $now;
        }else{
            $percents->updated_at = $now;
        }
        $percents->update();

        return response()->json([
            'id' => $id,
            'percents' => $percents,
            'success' => 'success',
        ]);

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

    public function percent()
    {
        $percents = Percent::all();
        return response()->json($percents);
    }
}
