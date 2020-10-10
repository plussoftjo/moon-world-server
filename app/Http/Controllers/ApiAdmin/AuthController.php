<?php

namespace App\Http\Controllers\ApiAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
class AuthController extends Controller
{
    public function _login(Request $request) {
        $input = $request->all();
        if(Auth::attempt(['phone' => $input['phone'],'password' => $input['password'],'type' => 0])) {
            $user = Auth::User();
            $token = $user->createToken('auth')-> accessToken; #Fetch Token
            return response()->json(['token' => $token,'user' => $user],200);
        }
        return response()->json(['error' => 'Unauthorised'],401);
    }

    public function _auth() {
        $user = Auth::User();
        if($user->type == 0) {
            return response()->json(['user' => $user],200);
        }
        return response()->json(['msg' => 'Unauthorised'],401);
    }
}
