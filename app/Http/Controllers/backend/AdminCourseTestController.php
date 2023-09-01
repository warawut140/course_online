<?php

namespace App\Http\Controllers\backend;

use App\Models\Options;
use App\Models\Questions;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminCourseTestController extends Controller
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
        $now = new DateTime();
        $auth_name = Auth::user()->name;
        $questions = new Questions();


        $order = Questions::where('course_list_id',$request->input('test_id'))->max('position');
        $is_order = ($order == null) ? 0 : $order;
        if($request->get('option_type') == 1 ){

            $questions->name = $request->get('test_name');
            $questions->position = $is_order+1;
            $questions->option_type_id = $request->get('option_type');
            $questions->course_list_id = $request->get('test_id');
            $questions->actby = $auth_name;
            $questions->created_at = $now;
            $questions->updated_at = null;
            $questions->save() ;
            return response()->json([
                'type' => 2,
                'success' => 'success',
            ]);

        }elseif ($request->get('option_type') == 2 ){
            $questions->name = $request->get('test_name');
            $questions->position = $is_order+1;
            $questions->option_type_id = $request->get('option_type');
            $questions->course_list_id = $request->get('test_id');
            $questions->actby = $auth_name;
            $questions->created_at = $now;
            $questions->save() ;


            for ($i = 1 ; $i <= 4 ;$i++){
                $options = new Options();
                $options->name = $request->get('option'.$i);
                $options->position = $i;
                $options->question_id = $questions->id;
                $correct_answer = $request->get('correct_answer'.$i);
                $options->correct_answer = ($correct_answer == 1)?1:0;
                $options->created_at = $now;
                $options->updated_at = null;
                $options->save();
            }
            return response()->json([
                'type' => 1,
                'success' => 'success',
            ]);
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
        // dd('ok');
        $questions = Questions::join('option_type','option_type.id','=','questions.option_type_id')
            ->select('questions.*','option_type.name as option_type_name')
            ->where('questions.course_list_id',$id)
            ->get();
        return response()->json($questions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $questions = Questions::join('option_type','option_type.id','=','questions.option_type_id')
            ->select('questions.*','option_type.name as option_type_name')
            ->where('questions.id',$id)
            ->first();

        if($questions->option_type_id == 2){
            $option = Options::where('question_id',$questions->id)->get();
            return response()->json([
                'type' => 2 ,
                'questions' => $questions ,
                'option' => $option
            ]);
        }else{
            return response()->json([
                'type' => 1 ,
                'questions' => $questions ,
            ]);
        }



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
        $questions = Questions::find($id);
        $questions->name = $request->get('test_name');
        $questions->update();

        $option1_id = $request->get('option1_id');
        $option2_id = $request->get('option2_id');
        $option3_id = $request->get('option3_id');
        $option4_id = $request->get('option4_id');
        $correct_answer1 = $request->get('correct_answer1');
        $correct_answer2 = $request->get('correct_answer2');
        $correct_answer3 = $request->get('correct_answer3');
        $correct_answer4 = $request->get('correct_answer4');

        if($option1_id != null && $option2_id != null && $option3_id != null && $option4_id!= null){

            $Options = Options::where('question_id','=',$id)->get();
            foreach ($Options as $option){
                $option->correct_answer = 0;
                $option->update();
            }


            $option1 = Options::find($option1_id);
            $option1->name = $request->get('option1_name');
            $option1->correct_answer = ($correct_answer1 == 1)?1:0;
            $option1->update()  ;

            $option2 = Options::find($option2_id);
            $option2->name = $request->get('option2_name');
            $option2->correct_answer = ($correct_answer2 == 1)?1:0;
            $option2->update()  ;

            $option3 = Options::find($option3_id);
            $option3->name = $request->get('option3_name');
            $option3->correct_answer = ($correct_answer3 == 1)?1:0;
            $option3->update()  ;

            $option4 = Options::find($option4_id);
            $option4->name = $request->get('option4_name');
            $option4->correct_answer = ($correct_answer4 == 1)?1:0;
            $option4->update()  ;
        }
        return response()->json([
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
        $questions = Questions::find($id);
        if($questions->option_type_id == 2){
            Options::where('question_id','=',$questions->id)->delete();
        }
        Questions::destroy($id);
        return response()->json([
            'success' => 'success',
        ]);
    }
}
