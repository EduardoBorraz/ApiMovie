<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterAuthRequest;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){ 
        
        $val = Validator::make($request -> all(),[
            'email' => 'required',
            'password' => 'required',
            'name' => 'required',
            'Paternal' => 'required',
            'Maternal' => 'required',
            'Token' => 'required'
        ]);
        if ($val->fails()) {
            $response = [
                'success' => false,
                'errors' => $val->errors(),
                'data' => []
            ];

            return response()->json($response,202);
        }

        $user = new User();
        $user->id_user = $request->id_user;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->name = $request->name;
        $user->Paternal = $request->Paternal;
        $user->Maternal = $request->Maternal;
        $user->Token = $request->Token;
        $user->save();

        $response =  [
            'success'=>true,
            'data'=>$user
        ];

        return response()->json($response,200);
    }

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
        $user = auth()->user();
        //dd($token);
        if ($token) {
           
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

    /* public  function  getAuthenticatedUser(Request  $request) {
		$validatedData = $request->validate([
            'token' => 'required',
        ]);
		if(!$validatedData){
            return response()->json(['token_absent']);
        }
	
		$user = JWTAuth::authenticate($request->token);
		return  response()->json(['user' => $user]);
	} */
     
}
