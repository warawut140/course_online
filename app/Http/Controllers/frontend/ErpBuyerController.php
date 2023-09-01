<?php

namespace App\Http\Controllers\frontend;

use App\Models\Profile;
use App\Models\Provinces;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ErpBuyerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function erpHome()
    {
        $profile = $this->permission();
        if($profile->statusType == 1){
            $auth_id = Auth::user()->id;

            return view('frontend.ERP.erp-home',[
                'profile' => $profile ,
                'auth_id' => $auth_id ,
            ]);
        }elseif($profile->statusType == 2){
            return redirect('erp-infoStore');
        }
    }

    public function erpOpen()
    {
        $profile = $this->permission();
        if($profile->statusType == 1){
            //สถานที่ปฏิบัติงาน
//            $provinces = Provinces::orderBy('PROVINCE_NAME')->pluck('PROVINCE_NAME', 'PROVINCE_ID');
            $provinces = Provinces::orderBy('PROVINCE_NAME')->get();
            $auth_id = Auth::user()->id;
            return view('frontend.ERP.erp-open',[
                'profile' => $profile ,
                'provinces' => $provinces ,
                'auth_id' => $auth_id ,
            ]);
        }elseif($profile->statusType == 2){
            return redirect('erp-infoStore');
        }
    }

    public function erpListOrder()
    {
        $profile = $this->permission();
        $auth_id = Auth::user()->id;

        if($profile->statusType == 1){
            //สถานที่ปฏิบัติงาน
            $auth_id = Auth::user()->id;
            return view('frontend.ERP.erp-listOrder',[
                'profile' => $profile ,
                'auth_id' => $auth_id ,
            ]);
        }elseif($profile->statusType == 2){
            return redirect('erp-infoStore');
        }
    }

    public function erpOther()
    {
        $profile = $this->permission();
        $auth_id = Auth::user()->id;
        if($profile->statusType == 1){
            //สถานที่ปฏิบัติงาน
            $auth_id = Auth::user()->id;
            return view('frontend.ERP.erp-other',[
                'profile' => $profile ,
                'auth_id' => $auth_id ,
            ]);
        }elseif($profile->statusType == 2){
            return redirect('erp-infoStore');
        }
    }

    public function checkPermission()
    {
        $profile = $this->permission();
        if($profile->statusType == 1){
            return redirect('erp-open');
        }elseif($profile->statusType == 2){
            return redirect('erp-infoStore');
        }
    }

    public function permission()
    {
        $auth_id = Auth::user()->id;
        $statusType = null;
        $profile = Profile::join('users','profiles.user_id','=','users.id')
            ->select('profiles.*','users.email')
            ->where('user_id',$auth_id)
            ->first();
        if ($profile->type_user_id == 1 && $profile->type_user_id_2 == null && $profile->type_user_id_3 == null){
            // 1 ผู้ว่าจ้าง
            $statusName = "ผู้ชื้อ";
            $statusType = 1;
        }elseif($profile->type_user_id_2 == 2 || $profile->type_user_id_3 == 3){
            // 2 ผู้รับจ้าง , 3 ผู้รับเหมา
            $statusName = "เจ้าของร้าน";
            $statusType = 2;
        }
        $profile->statusName = $statusName;
        $profile->statusType = $statusType;

        return  $profile;
    }

    public function update(Request $request, $id)
    {
        $now = new DateTime();
        $auth_id = Auth::user()->id;
        $auth_name = Auth::user()->name;
        $type = $request->type ;
        $profile = Profile::find($id);
        if($type == 1){
            $profile->company_address = $request->company_address;
            $profile->tel = $request->tel;
            $profile->updated_at = $now;
            $profile->update();
        }elseif ($type == 2){
            $profile->latitude = $request->lat_value ;
            $profile->longitude = $request->lon_value ;
            $profile->zoom = $request->zoom_value ;
            $profile->updated_at = $now;
            $profile->update();
        }
        Session::flash('status', 'บันทึกข้อมูลเรียบร้อย !');
        return redirect('erp-home');
    }

}
