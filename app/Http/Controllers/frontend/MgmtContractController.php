<?php

namespace App\Http\Controllers\frontend;

use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class MgmtContractController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function follow($id,$project_id,$type)
    {
        $budding_air_user = DB::table('project_auctions_air')
            ->where('id','=',$id)
            ->where('project_id','=',$project_id)
            ->where('status_budding','=',2)
            ->first();

        if($type == 1){
            DB::table('project_auctions_air')
                ->where('id','=',$id)
                ->update([
                   'status_phungngan_Follow' => 1
                ]);
            Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
            return redirect('quotation/contract/'.$project_id);
        }elseif ($type == 2){
            // ติดตามงาน
            DB::table('project_auctions_air')
                ->where('id','=',$id)
                ->update([
                    'status_phungngan_Follow' => 2
                ]);

            // หัก BitCoin



            Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
            return redirect('quotation/contract/'.$project_id);
        }
    }



    public function store(Request $request)
    {
        $now = new DateTime();
        $type_add = $request->type_add;
        if($type_add == 1){
            // Add BOQ
            DB::table('budding_boq')->insert([
                'project_id' => $request->project_id,
                'user_id' => $request->user_id,
                'owner_id' => $request->owner_id,
                'boq_number' => $request->boq_number,
                'created_at' => $now,
                'updated_at' => null,
                'boq_date' => $request->boq_date,
                'boq_deadline' => $request->boq_deadline,
            ]);
            Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
            return redirect('quotation/contract/'.$request->project_id);
        }elseif ($type_add == 2){
            // Add File
            echo $project_id = $request->project_id ;
            $budding_boq_id = $request->budding_boq_id ;
            $user_id = $request->user_id ;
//            dd($request->all());
            if (!empty($request->file_title)) {
                $path = public_path() .'/budding/'.$budding_boq_id;
//            dd($path);
                File::makeDirectory($path , $mode = 0777, true, true);

                foreach ($request->file_title as $key => $value){
                    $file_title = $request->file_title[$key];
                    $file_count = $request->file_count[$key];

                    if (!empty($request->file('file_name')[$key])) {
                        $file_name = $budding_boq_id."-"."สำเนาเอกสาร"."_". str_random(4) .'.' . $request->file('file_name')[$key]->getClientOriginalExtension();
                        $request->file('file_name')[$key]->move($path, $file_name);
                    }else{
                        $file_name = null ;
                    }

                    DB::table('budding_file')->insert([
                           'project_id' => $project_id,
                           'budding_boq_id' => $budding_boq_id,
                           'user_id' => $user_id,
                           'file_title' => $file_title,
                           'file_name' => $file_name,
                           'file_count' => $file_count,
                           'created_at' => $now,
                           'updated_at' => null,
                        ]);
                }
            }
            Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
            return redirect('quotation/contract/'.$project_id);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        DB::table('project_auctions_air')
            ->where('project_id','=',$id)
            ->where('user_id','=',Auth::user()->id)
            ->update([
                'status_submit' => 1
            ]);
        Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
        return redirect('quotation/contract/'.$id);
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
        $data = DB::table('budding_file')
            ->where('id','=',$id)
            ->first();
        $path = '/budding/'.$data->budding_boq_id.'/'.$data->file_name;
        File::delete(public_path() .$path);
        $project_id = $data->project_id ;

        DB::table('budding_file')->where('id','=',$id)->delete();
        Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
        return redirect('quotation/contract/'.$project_id);

    }


}
