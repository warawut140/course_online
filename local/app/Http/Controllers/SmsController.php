<?php

namespace App\Http\Controllers;

use App\Sms;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class SmsController extends Controller
{
    public function check_credit()
    {
        // USERNAME TEST : 0957695049 | password : 311038
        $sms = new Sms();
        $username = '0957695049';
        $password = '311038';
        $force = 'credit_remain'; // Standard => credit_remain , Premium => credit_remain_premium
        $result = $sms->check_credit($username,$password,$force);

//        echo "ข้อความ : ".$result['msg'] ."<br/>";
//        echo "จำนวน : ".$result['count'] ."<br/>";
        return $result ;
    }

    public function send_sms($tel)
    {
        // USERNAME TEST : 0957695049 | password : 311038
        // Check Credit
        $check_credit = $this->check_credit();
        if($check_credit['count'] > 0){
            $rand_no = rand(10000, 99999);

            // Send SMS
            $sms = new Sms();
            $username = '0957695049';
            $password = '311038';
            $msisdn = $tel;
            $message = 'สมัครสมาชิก ผึ้งงาน (Phungngan) OTP : '.$rand_no;
            $sender = 'THAIBULKSMS';
            $ScheduledDelivery = '';
            $force = 'standard'; // Standard => credit_remain , Premium => credit_remain_premium

           $sms->send_sms($username,$password,$msisdn,$message,$sender,$ScheduledDelivery,$force);
           $result = $sms->check_credit($username,$password,$force);

            $array = [
                'status' => 'success',
//                'result' => $result ,
                'verification_otp' => $rand_no ,
                'msg' => $result['msg'] ,
                'count' => $result['count'] ,
            ];
            return response()->json($array);
        }else{
            $array = [
                'status' => 'fail',
                'msg' => $check_credit['msg'] ,
                'count' => $check_credit['count'] ,
            ];
            return $array ;
        }
    }
}
