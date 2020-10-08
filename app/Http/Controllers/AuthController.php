<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterAuthRequest;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Http\Request;
use Validator;
use App\User;

class AuthController extends Controller
{
    public function login(Request $request){

        $credentials = $request->only('email','password');

        $validator = Validator::make($credentials,[
            'email' => 'required|email',
            'password' => 'required' 
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Wrong Validation',
                'errors' => $validator->errors()
            ],422);
        }
        
        $token = JWTAuth::attempt($credentials);
        if ($token) {
            $user = Auth::user();

            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => $user
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Wrong credentials',
                'errors' => $validator->errors()
            ],401);
        }
    }

     
}
