<?php
use Jenssegers\Agent\Agent;


function base64Encode($data){

    $data = json_encode($data);
    $data =  base64_encode($data);
    $data = $data . '$$$kpaskdpaksd1231#!^@&*SADKAJD123#$$!#!FAS';
    $data = base64_encode($data);
    $data = '$jahsdj123$!*(#!*!!#!#@@' . $data;
    $data = base64_encode($data);

    return $data;
}

function base64Decode($data){
    $data = base64_decode($data);
    $data = explode('@@', $data);
    if(count($data) != 2 || $data[0] != '$jahsdj123$!*(#!*!!#!#'){
        return 0;
    }

    $data = $data[1];
    $data = base64_decode($data);

    $data = explode('$$$', $data);

    if(count($data) != 2 || $data[1] != 'kpaskdpaksd1231#!^@&*SADKAJD123#$$!#!FAS'){
        return 0;
    }



    $data = base64_decode($data[0]);
    $data = json_decode($data);

    return $data;
}


function checkPermission($permission,$action){

    $get_permission = DB::table('permissions')->where('key',$permission)->first();
    if(!$get_permission) {
        return false;
    }

    $user_id = request()->header('user_id');
    $user = DB::table('users')->find($user_id);


    $role_permissions = DB::table('role_permissions')
                        ->where(['role_id' => $user->role_id, 'permission_id' => $get_permission->id])
                        ->first();

    if(!$role_permissions){
        return false;
    }


    $feature_ids = json_decode($role_permissions->permission_feature_id);

    $permission_feature = DB::table('permission_features')
                            ->whereIn('id',$feature_ids)
                            ->where('key',$action)
                            ->exists();
        
    return $permission_feature ? true : false;
}

function audit($condition,$action = 'is_view', $user){
    $is_no_auth = 0;
    $is_login = 0;
    $is_no_permission = 0;
    $login_time = date('Y-m-d H:i:s');
    $logout_time = date('Y-m-d H:i:s');
    $last_time_used = '';
    $url = request()->url();
    $ip = request()->ip();

    $data = [
        'ip' => $ip,
        'url' => $url,
    ];

    if($condition == 'is_no_auth'){
        $data['username'] = $user->email;
        $data['password'] = $user->password;
        $data['user_id'] = $user->id;
        $is_no_auth = 1;
    }
    else if($condition == 'is_no_permission'){
        $is_no_permission = 1;
    }else if($condition == 'is_login'){
        $data['user_id'] = $user->id;
        $data['login_time'] = $login_time;
        $data['username'] = $user->email;
        $data['password'] = $user->password;
        $data['is_login'] = 1;
    } else if($condition == 'is_logout'){
        $data['user_id'] = $user->id;
        $data['username'] = $user->email;
        $data['password'] = $user->password;
        $data['logout_time'] = $logout_time;
    } else {
        $last_time_used = date('Y-m-d H:i:s');
        $data['username'] = $user->email;
        $data['password'] = $user->password;
        $data['user_id'] = $user->id;
    }

    $data['is_no_auth'] = $is_no_auth;
    $data['is_no_permission'] = $is_no_permission;

    $agent = new Agent;
    $data['device'] = $agent->device();
    $data['platform'] = $agent->platform();
    $data['browser'] = $agent->browser();
    $data['version'] = $agent->version($agent->platform());
    $data['is_desktop'] = $agent->isDesktop() ? 1 : 0;
    $data['is_phone'] = $agent->isMobile() ? 1 : 0;
    $data['is_table'] = $agent->isTablet() ? 1 : 0;
    $data['is_robot'] = $agent->isRobot() ? 1 : 0;
    $data['robot_name'] = $agent->isRobot() ? $agent->robot() : '';
    $data[$action] = 1;
    $data['last_time_used'] = $last_time_used;

    try {
        $id = DB::table('audits')->insertGetId($data);
    } catch (\Throwable $th) {
        return false;
    }
}

?>