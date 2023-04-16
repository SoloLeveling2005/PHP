<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiIdentification extends Controller
{
    public function signup(Request $request) {
        $validator = $request->validate([
            'username' => ['required','unique:users','min:4','max:60'],
            'password' => ['required','min:4','max:60'],
        ]);
        if (!$validator) {
            return response([
                "status"=> "invalid",
                "message"=> "The user already exists"
            ], 401);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create([
            'username'=>$input['username'],
            'password'=>$input['password'],
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        // Auth::login($user);
        
        $success['token'] = $user->createToken($validator['username'], ['expires_at' => now()->addHours(1)])->plainTextToken;
        $success['xsrf'] = csrf_token();
        return response($success, 200);
    }

    public function signin(Request $request) {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken($credentials['username'], ['expires_at' => now()->addHours(1)])->plainTextToken;
            $user = User::firstWhere('username',$credentials['username']);
            $user->updated_at = now();
            $user->save();

            return response([
                "status"=> "success",
                'xsrf'=>csrf_token(),
                "token"=> $token
            ], 200);
        }
        return response([
            "status"=> "invalid",
            "message"=> 'Wrong username or password'
        ], 401);

    }

    public function signout(Request $request) {
        $request->user()->tokens()->delete();

        return response([
            "status"=> "success",
        ], 200);
    }
}
