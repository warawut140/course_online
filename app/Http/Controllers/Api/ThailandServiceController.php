<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ThailandServiceController extends Controller
{
    public function address(Request $request)
    {
        $type = $_REQUEST['type'];
        $id = $_REQUEST['id'];
        if ($type == 'amphures') {
            if ($id != '') {
                $amphures = DB::table('amphures')->where('PROVINCE_ID', $id)->get();
                $html = '<option value="">-กรุณาเลือก เขต/อำเภอ-</option>';
                foreach ($amphures AS $row) {
                    $html .= '<option value="' . $row->AMPHUR_ID . '">' . $row->AMPHUR_NAME . '</option>';
                }
                return $html;
            } else {
                $amphures = DB::table('amphures')->get();
                $html = '<option value="">-กรุณาเลือก เขต/อำเภอ-</option>';
                foreach ($amphures AS $row) {
                    $html .= '<option value="' . $row->AMPHUR_ID . '">' . $row->AMPHUR_NAME . '</option>';
                }
                return $html;

            }
        } else if ($type == 'districts') {
            if ($id != '') {
                $districts = DB::table('districts')->where('AMPHUR_ID', $id)->get();
                $html = '<option value="">-กรุณาเลือกตำบล-</option>';
                foreach ($districts AS $row) {
                    $html .= '<option value="' . $row->DISTRICT_ID . '">' . $row->DISTRICT_NAME . '</option>';
                }
                return $html;
            } else {
                $districts = DB::table('districts')->get();
                $html = '<option value="">-กรุณาเลือกตำบล-</option>';
                foreach ($districts AS $row) {
                    $html .= '<option value="' . $row->DISTRICT_ID . '">' . $row->DISTRICT_NAME . '</option>';
                }
                return $html;
            }
        }
    }
}
