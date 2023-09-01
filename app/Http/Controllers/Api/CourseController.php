<?php

namespace App\Http\Controllers\Api;

use App\Models\Answers;
use App\Models\Options;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function countDown(Request $request,$id)
    {
        $answer_checktime = DB::table('answer_checktime')
            ->where('id','=',$id)
            ->update(['answer_status' => 1]);
        return response()->json([
            'answer_checktime' => $answer_checktime,
            'success' => 'success',
        ]);
    }

    public function store(Request $request)
    {
        $now = new DateTime();
//        $auth_id = Auth::user()->id;
        $question_id = $request->get('question_id');
        $question_check_id = $request->get('question_check_id');
        $question_id_text = $request->get('question_id_text');
        $question_id_option = $request->get('question_id_option');
        $question_text = $request->get('question_text');
        $question_option = $request->get('question_option');

        $answer_questions = DB::table('questions')
            ->join('option_type','questions.option_type_id','=','option_type.id')
            ->select('questions.course_list_id','questions.id','questions.name',
                'questions.position','questions.option_type_id','option_type.name')
            ->where('questions.course_list_id','=',$question_id)
            ->get();


        foreach ($answer_questions as $key => $question){
            if($question->option_type_id == 1){
                // dd('ok');
                //TEXT
                $answers = new  Answers();
                $answers->question_id = $question->id ;
                $answers->option_id = null ;
                $answers->option_text = ($question_text[$question->id] != null)?$question_text[$question->id]:null ;
                $answers->pass = null ;
                $answers->user_id = 1 ;
                $answers->created_at = $now ;
                $answers->updated_at = null ;
                $answers->idcheck = $question_check_id ;
                $answers->save();
            }elseif ($question->option_type_id == 2){
                // dd('ok2');
                $answers = new  Answers();
                $options = Options::where('question_id','=',$question->id)->where('correct_answer','=',1)->first();
                if(!empty($question_option[$question->id])){
                    $option_id = $options->id;
                    $answers->question_id = $question->id ;
                    $answers->option_id = $question_option[$question->id] ;
                    $answers->option_text = null ;
                    if ($option_id == $question_option[$question->id]){
                        // PASS
                        $answers->pass = 0 ;
                    }else{
                        // NO PASS
                        $answers->pass = 1 ;
                    }
                    $answers->user_id = 1 ;
                    $answers->created_at = $now ;
                    $answers->updated_at = null ;
                    $answers->idcheck = $question_check_id ;
                    $answers->save();
                }
            }
        }


        //Check Data Course PASS & NO PASS
        DB::table('answer_checktime')
            ->where('id','=',$question_check_id)
            ->update(['answer_status' => 1]);

        if(isset($options)){
            return response()->json([
                'id' => $question_id,
                'success' => 'success',
                'request' => $request ,
                'data' => $answer_questions ,
                'options' => $options ,
            ]);
        }else{
            return response()->json([
                'id' => $question_id,
                'success' => 'success',
                'request' => $request ,
                'data' => $answer_questions ,
                // 'options' => $options ,
            ]);
        }
        
    }

}
