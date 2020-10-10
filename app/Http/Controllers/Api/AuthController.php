<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;

class AuthController extends Controller
{
    /** This is for auth the user with the api  */
    public function register(Request $request) {
        $input = $request->all();
        $user = User::create([
            'name' => $input['name'],
            'phone' => $input['phone'],
            'password' => bcrypt($input['password']),
            'type' => 1
        ]);
        $token = $user->createToken('auth')-> accessToken;
        return response()->json(['token'=>$token,'user'=>$user]);
    }

    public function login(Request $request) {
        $input = $request->all();
        /** Check if Has User */
        if(Auth::attempt(['phone' => $input['phone'],'password' => $input['password']])) {
            #Get_User
            $user = Auth::User();
            $token =  $user->createToken('auth')-> accessToken; #Fetch Token
            #Return The result with token to Save in front end
            return response()->json(['token' => $token,'user' => $user],200);
        }else {
            /** If check has faild */
            #Return With error Message
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    public function index() {
        $user = Auth::User();

        return response()->json($user);
    }
}
