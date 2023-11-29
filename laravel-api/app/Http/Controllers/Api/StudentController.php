<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class StudentController extends Controller
{
    public function index(Request $r){
        $data['students'] = DB::table('students')->select('*')->paginate(2);
        return response()->json(['data' => $data]);
    }
    public function store(Request $r){
        DB::table('students')->insert([
            'name' => $r->name,
            'age' => $r->age
        ]);

        return $this->shareData(['status' => 'success', 'sms' => 'insert successfully']);
    }
    public function delete(Request $r){
        DB::table('students')->where('id',$r->id)->delete();
        return $this->shareData(['status' => 'success', 'sms' => 'delete successfully']);
    }
    public function edit(Request $r){
        $data['student'] = DB::table('students')->find($r->id);

        return response()->json(['data' => $data]);
    }
    public function update(Request $r){
        DB::table("students")->where('id',$r->id)->update([
            'name' => $r->name,
            'age' => $r->age
        ]);
        return $this->shareData(['status' => 'success', 'sms' => 'update successfully']);

    }
}
