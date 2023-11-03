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
                if($user->is_two_factor == 1){
                    $num_str = sprintf("%06d", mt_rand(1, 999999));
                    $user = User::find($user->id);
                    $user->otp = $num_str;
                    $user->save();

                    return response()->json(['status' => 'is_two_factor', 'sms' => __('OTP Sent'), 'user_id' => base64Encode($user->id)]);
                } else {
                    $token = $user->createToken('MyApi')->accessToken;
                    return response()->json(['status' => 'success', 'sms' => __('Login Successfully'), 'data' => [
                        'user' => $user,
                        'token' => $token
                    ]]);
                }
            }
            return response()->json(['status' => 'error', 'sms' => 'Password not match !!!']);
        }
        return response()->json(['status' => 'error', 'sms' => 'User not found !!!']);
    }
    public function logout(Request $r){
        $r->user()->token()->revoke();
        return response()->json(['status' => 'success', 'sms' => __('Logout Successfully !!!')]);
    }
    public function checkOTP(Request $r){
        $user = User::find($r->user_id);
        if($user){
            if($user->otp == $r->otp){
                $token = $user->createToken('MyApi')->accessToken;
                return response()->json(['status' => 'success', 'sms' => __('Login Successfully'), 'data' => [
                    'user' => $user,
                    'token' => $token
                ]]);
            } else {
                return response()->json(['status' => 'error', 'sms' => 'Wrong OTP !!!']);
            }
        }
        return response()->json(['status' => 'error', 'sms' => 'Somethings Wrong !!!']);
    }
}
