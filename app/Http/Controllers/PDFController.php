<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;

class PDFController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function certificate_print($c_id,$u_id,$cl_id,$qd_id)
    {

        $profile = DB::table('profiles')->select('firstname','lastname')->where('user_id',$u_id)->first();
        if($profile){
            $cl = DB::table('course_lists')->select('id')->where('id',$cl_id)->where('course_id',$c_id)->first();
            if($cl){
                $c = DB::table('courses')->select('name','profile_id')->where('id',$c_id)->first();
                $com = DB::table('profiles')->select('company')->where('id',$c->profile_id)->first();
                $questions_details = DB::table('questions_details')->select('id')->where('unlock_certificate',1)->where('id',$qd_id)->first();
                if($questions_details){
                    $profile_question_detail = DB::table('profile_question_detail')->where('user_id',$u_id)
                    ->where('questions_detail_id',$questions_details->id)
                    ->where('status',1)
                    ->first();
                    if($profile_question_detail){
                        $pdf = Pdf::loadView('frontend_new.certificate_print', [
                            'profile' => $profile,
                            'courses' => $c,
                            'com' => $com,
                        ]);
                        // $customPaper = array(0,0,360,360);
                        $pdf->setPaper('A4', 'landscape');
                        // $pdf    ->setPaper($customPaper);
                        return $pdf->stream('taxt_invoice_'.date('Y_m_d_H_i_s').'.pdf');
                    }
                }
            }
        }
    }
}
