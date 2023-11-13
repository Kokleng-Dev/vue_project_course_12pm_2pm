<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;
use Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sharePermission($action = 'view', $user_id = ''){
        if($user_id == ''){
            $user_id = Request::header('user_id');
        }
        $user = DB::table('users')->find($user_id);
        $role_permissions = DB::table('role_permissions')
                            ->where('role_id',$user->role_id)
                            ->get();

        $pers = [];
        foreach ($role_permissions as $key => $role_permission) {
            $permission_feature_ids = json_decode($role_permission->permission_feature_id);
            $permissions = DB::table('permissions')
                ->join('permission_features','permission_features.permission_id','permissions.id')
                ->whereIn('permission_features.id',$permission_feature_ids)
                ->where('permission_features.key',$action)
                ->value('permissions.key');

            if($permissions){
                array_push($pers,$permissions);
            }
        }


        
        
        array_push($pers,'home');

        return $pers;
    }

    public function shareData($data, $user_id = ''){
        try {
            $data['permission'] = $this->sharePermission('view',$user_id);
            return response()->json($data);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
