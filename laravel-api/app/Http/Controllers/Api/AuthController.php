<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $r){
        $e = base64Encode(1);
        $d = base64Decode($e);

        return [$e, $d];
    }
}
