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
            $staff_archive_ids = DB::table('staff_archives')->where('user_id',$r->header('user_id'))->select('staff_id')->get()->pluck('staff_id')->toArray();
            $staff = DB::table('staffs')
                    ->whereNotIn('id',$staff_archive_ids);
                    // ->where('created_by',$user_id)
            $staff = $staff->orderBy('id',$r->orderBy);
            if($r->pagination == 'All'){
                $staff = $staff->paginate(100000000000);
            }else{
                $staff = $staff->paginate($r->pagination);
            }


        } else {
            $staff = DB::table('staffs')->find($r->staff_id);
        }
        $data['staff'] = $staff;
        $data['staff_archives'] = DB::table('staff_archives')
                            ->join('staffs','staffs.id','staff_archives.staff_id')
                            ->where("staff_archives.user_id",$r->header('user_id'))
                            ->select('staffs.*')
                            ->get();

        return $this->shareData(['data' => $data]);
    }
    public function store(Request $r){
        $data = $r->all();

        foreach ($data as $key => $staff) {
            $staff = (object) $staff;
           DB::table('staffs')->insert([
            'name' => $staff->name,
            'phone' => $staff->phone,
            'gender' => $staff->gender
           ]);
        }

        return $this->shareData(['status' => 'success', 'sms' => 'insert successfully']);
    }
    public function update(Request $r){
        DB::table('staffs')->where('id',$r->id)->update([
            'name' => $r->name,
            'gender' => $r->gender
        ]);
        return $this->shareData(['status' => 'success', 'sms' => 'Update successfully']);

    }
    public function delete(Request $r){
        DB::table('staffs')->where('id',$r->id)->delete();
        return $this->shareData(['status' => 'success', 'sms' => 'Delete successfully']);
    }
    public function archive(Request $r){
        DB::table('staff_archives')->insert([
            'staff_id' => $r->staff_id,
            'user_id' => $r->header('user_id')
        ]);
        return $this->shareData(['status' => 'success', 'sms' => 'Archive successfully']);
    }
    public function archiveBack(Request $r){
        DB::table('staff_archives')->where('staff_id',$r->staff_id)->delete();
        return $this->shareData(['status' => 'success', 'sms' => 'Archive Back']);

    }
}
