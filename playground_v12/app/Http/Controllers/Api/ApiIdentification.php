<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiIdentification extends Controller
{
    public function signup (Request$request) {
        $valid_data = $request->validate([
            'username'=>['required','unique:users','min:4','max:60'],
            'password'=>['required','min:8','max:32'],
        ]);

        $user = User::create([
            'username'=>$valid_data['username'],
            'password'=>$valid_data['password'],
        ]);

        $token = $user->createToken($valid_data['username'], ['expires_at'=>now()->addHour(1)])->plainTextToken;
        $user->created_at = now();
        $user->updated_at = now();
        $user->save();
        return response([
            'status'=>'success',
            'token'=>$token
        ], 201);

    }

    public function signin (Request$request) {
        $valid_data = $request->validate([
            'username'=>['required','min:4','max:60'],
            'password'=>['required','min:8','max:32'],
        ]);
        if (Auth::guard('api')->attempt($valid_data)){
            $user = User::where(['username'=>$valid_data['username']])->first();
            $token = $user->createToken($valid_data['username'], ['expires_at'=>now()->addHour(1)])->plainTextToken;
            $user = User::where(['id'=>$user->id])->first();
            $user->updated_at = now();
            $user->save();
            return response([
                'status'=>'success',
                'token'=>$token
            ], 201);
        }
        return response([
            'status'=>'invalid',
            "message"=> "Wrong username or password"
        ], 401);

    }

    public function signout (Request$request) {
        $request->user()->tokens()->delete();
        return response([
            'status'=>'success'
        ], 200);
    }
}
