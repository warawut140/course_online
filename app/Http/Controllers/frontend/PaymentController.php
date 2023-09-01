<?php

namespace App\Http\Controllers\frontend;

use App\Models\BitCoin;
use App\Models\Payment;
use App\Models\Profile;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
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
        return view('frontend.payment',['page' => 1 , 'auth_id' => null]);
    }

    public function paymentCredit()
    {
        $auth_id = Auth::user()->id;
        return view('frontend.payment',['page' => 2 , 'auth_id' => $auth_id]);
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
        $userPayment = new Payment();
        $userPayment->user_id = $request->get('auth_id') ;
        $userPayment->price = $request->get('price') ;

        $data_id = array(
            'id_userPayment' => $userPayment->id ,
        );
        $price = $request->get('price');
        $profile = Profile::where('user_id',$request->get('auth_id'))->first();
        $customerName = $profile->firstname;
        $secret_key = "bHjLmWTsATIfGDQgjC9sKAYnhwRlgeLw";
        $token = $request->get('gbToken');
        $data = array(
            'amount' => $price ,
            'referenceNo' => date('YmdHis'),
            'detail' => 'phungngan',
            'customerName' => $customerName ,
            'merchantDefined1' => $userPayment->id,
            'card' => array(
                'token' => $token,
            ),
            'otp' => 'Y',
            'responseUrl' => url('responseurl'),
            'backgroundUrl' => url('backgroundurl'),
        );

        $payload = json_encode($data);

        // POST API GB PRIME
        $ch = curl_init('https://api.gbprimepay.com/v1/tokens/charge'); // Test env
        //curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_USERPWD, $secret_key . ':');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($payload))
        );
        $result = curl_exec($ch);

        curl_close($ch);
        $replace = str_replace(array('{', '}','"'),'',$result);
        $str = explode(',',$replace);
        $datas[] = [];
        foreach($str as  $rs){
            $s = explode(':',$rs);
            $datas[] = [$s[0] => $s[1]];
        }
//        dd($datas);
        $userPayment->gbpReferenceNo = $datas[6]['gbpReferenceNo'] ;
        $userPayment->created_at = $now ;
        $userPayment->updated_at = null ;
        $userPayment->save();

        return view('frontend.gbprime.gbprimeform',['gbpReferenceNo' => $datas[6]['gbpReferenceNo']]);
    }

    public function responseurl(Request $request)
    {
        $auth_id = Auth::user()->id;
        $now = new DateTime();
        $profile = Profile::where('user_id',$auth_id)->first();
        $bitcoin = BitCoin::where('profile_id',$profile->id)->first();
        $gbpReferenceNo = $request->get('gbpReferenceNo');
        $payment = Payment::where('gbpReferenceNo',$gbpReferenceNo)->first();
        $resultCode = $request->get('resultCode');
        if ($resultCode == "00" ) {
            if($bitcoin == null){
                $newBitcoin = new BitCoin();
                $newBitcoin->profile_id =  $profile->id ;
                $newBitcoin->coins =  $payment->price ;
                $newBitcoin->created_at = $now ;
                $newBitcoin->updated_at = null ;
                $newBitcoin->save();
            }else{
                $price_balance = $bitcoin->coins ;
                $bitcoin->coins = (int) $price_balance + (int) $payment->price ;
                $bitcoin->updated_at = $now;
                $bitcoin->update();
            }
            $payment->status = $resultCode ;
            $payment->update();
            Session::flash('gb_success', 'บันทึกข้อมูลการเติมเงินเรียบร้อย !');
            return redirect('/profile');
        } else{
            Session::flash('gb_error', 'เกิดข้อพลาดกรุณาตรวจสอบ !');
            return redirect('/profile');
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
