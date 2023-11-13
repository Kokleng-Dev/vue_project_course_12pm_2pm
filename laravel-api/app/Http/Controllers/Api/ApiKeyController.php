<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\ApiKey;

class ApiKeyController extends Controller
{
    public function index(Request $r){
        if($r->api_key_id == 0){
            $api_key = ApiKey::query()->select('*')->paginate(2);
        } else {
            $api_key = Role::find($r->api_key_id);
        }
        $data['api_key'] = $api_key;

        return response()->json(['data' => $data]);
    }
    public function store(Request $r){
        try {
            $api_key = new ApiKey;
            $api_key->name = $r->name;
            $api_key->key = $r->key;
            $api_key->api_key = $r->api_key;
            $api_key->note = $r->note;
            $api_key->save();

            return response()->json(['status' => 'success', 'sms' => 'បញ្ចូលបានសម្រេច!!!']);

        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }

    }

    public function update(Request $r){
        try {
            $api_key = ApiKey::find($r->api_key_id);
            $api_key->name = $r->name;
            $api_key->key = $r->key;
            $api_key->api_key = $r->api_key;
            $api_key->note = $r->note;

            $api_key->save();

            return response()->json(['status' => 'success', 'sms' => 'Update Successfully']);

        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }

    }
    public function delete(Request $r){
        try {
            $api_key = ApiKey::find($r->api_key_id);
            $api_key->active = 0;
            $api_key->save();
            return response()->json(['status' => 'success', 'sms' => 'InActive']);
            
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => 'error', 'sms' => $th->getMessage()]);
        }
    }
}
