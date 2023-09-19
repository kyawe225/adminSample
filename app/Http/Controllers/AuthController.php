<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(AuthRequest $request){
        $data=$request->validated();
        if(Auth::attempt($data,false)){
            $token=auth()->user()->createToken('kyaw kyaw')->plainTextToken;
            return $this->successResponse($token);
        }
        else{
            return $this->errorResponse("Try Again with correct Email and Password");
        }
    }
    public function logout(){
        auth()->user()->tokens()->delete();
        return $this->successResponse("Logout Successfully!");
    }
}
