<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    public function login(Request $r){
        $validator = Validator::make($r->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 'is_valid',
                'errors' => $validator->errors(),
                'sms' => 'Need Data of email and password'
            ]);
        }
        $user = User::where(['email' => $r->email])->first();
        if($user){
            if(Hash::check($r->password, $user->password)){
                $token = $user->createToken('MyApi')->accessToken;

                return response()->json(['status' => 'success', 'sms' => __('Login Successfully'), 'data' => [
                    'user' => $user,
                    'token' => $token
                ]]);
            }
            return response()->json(['status' => 'error', 'sms' => 'Password not match !!!']);
        }
        return response()->json(['status' => 'error', 'sms' => 'User not found !!!']);
    }
    public function logout(Request $r){
        $r->user()->token()->revoke();
        return response()->json(['status' => 'success', 'sms' => __('Logout Successfully')]);
    }
}
