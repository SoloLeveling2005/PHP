<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuth extends Controller
{
    public function signup (Request $request) {
        $validate_data = $request->validate([
            'username'=>['required', 'unique:users', 'min:4', 'max:60'],
            'password'=>['required', 'min:8', 'max:32'],
        ]);

        if ($validate_data) {
            $user = User::create([
                'username'=>$validate_data['username'],
                'password'=>$validate_data['password'],
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
            $token = $user->createToken($validate_data['username'],['expires_at'=>now()->addHour(1)])->plainTextToken;

            return response([
                'status'=>'success',
                'token'=>$token
            ], 200);
        }

        return abort(401);
    }
    public function signin (Request $request) {
        $validate_data = $request->validate([
            'username'=>['required', 'min:4', 'max:60'],
            'password'=>['required', 'min:8', 'max:32'],
        ]);

        if (Auth::attempt($validate_data)) {
            $user = User::where(['username'=>$validate_data['username']])->first();
            $token = $user->createToken($validate_data['username'],['expires_at'=>now()->addHour(1)])->plainTextToken;

            return response([
                'status'=>'success',
                'token'=>$token
            ], 200);
        }

        return response([
            'status'=>'invalid',
            'token'=>"Wrong username or password"
        ], 401);
    }

    public function signout (Request $request) {
       $request->user()->tokens()->delete();

        return response([
            'status'=>'success',
        ], 200);
    }
}
