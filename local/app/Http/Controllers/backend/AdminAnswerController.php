<?php

namespace App\Http\Controllers\backend;

use App\Models\Answers;
use App\Models\Options;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminAnswerController extends Controller
{
    /**
     * AdminAnswerController constructor.
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
        $answers_check = DB::table('answer_checktime')
            ->join('profiles','answer_checktime.user_id','=','profiles.user_id')
            ->join('course_lists','answer_checktime.course_list_id','=','course_lists.id')
            ->join('courses','course_lists.course_id','=','courses.id')
            ->select('answer_checktime.*','profiles.firstname','profiles.lastname','course_lists.course_name','courses.name')
            ->orderBy('id','desc')
            ->get();
        return view('backend.answer.index',[
            'answers' => $answers_check
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
        $answers = Answers::where('idcheck','=',$request->idcheck)
            ->whereNull('pass')
            ->get();
//        dd($request->all());
        if(count($request->option_text) > 0){
            foreach ($answers as $answer){
                if($request->option_text[$answer->id] == 0){
                    //PASS
                    DB::table('answers')->where('id','=',$answer->id)->update([
                       'pass' => 0
                    ]);
                }elseif ($request->option_text[$answer->id] == 1){
                    //NO PASS
                    DB::table('answers')->where('id','=',$answer->id)->update([
                        'pass' => 1
                    ]);
                }
            }
        }
        Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
        return redirect('admin/answers');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $answers = DB::table('answers')
            ->join('questions','answers.question_id','=','questions.id')
            ->join('option_type','questions.option_type_id','=','option_type.id')
            ->select('answers.*','questions.name as  q_name','questions.course_list_id',
                'option_type.id as option_type_id','option_type.name')
            ->where('answers.idcheck','=',$id)
            ->get();

        foreach ($answers as $key => $answer){
            if($answer->option_type_id == 2){
                $option = Options::find($answer->option_id);
                $answers[$key]->option_name = $option->name;
            }
        }


//        dd($answers);
        return view('backend.answer.show',[
            'idcheck' => $id ,
            'answers' => $answers
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
