<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use DB;

class StaffController extends Controller
{
    public function index(Request $r){
        $user_id = request()->header('user_id');
        if($r->staff_id == 0){
            $staff = DB::table('staffs')->where('created_by',$user_id)->paginate(2);
        } else {
            $staff = DB::table('staffs')->find($r->staff_id);
        }
        $data['staff'] = $staff;

        return $this->shareData(['data' => $data]);
    }
}
