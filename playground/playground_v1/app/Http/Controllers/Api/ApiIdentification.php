<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class ApiIdentification extends Controller
{
    public function signup(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            // 'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        // return $input;
        $user = User::create([
            'username'=>$input['username'],
            'password'=>$input['password'],
        ]);

        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->username;
        User::where('id',$user->id)->update(['token'=>$success['token']]);
        return response($success, 200);
        // $this->sendResponse($success, 'User register successfully.');

    }
    public function signin(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required',
                // 'c_password' => 'required|same:password',
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user = User::where([
                'username'=>$input['username'],
                'password'=>$input['password']
            ])->first();

            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->username;
            User::where('id',$user->id)->update(['token'=>$success['token']]);

            return response([
                "status"=> "success",
                "token"=> $success['token']
            ], 200);

        } catch (Exception $exception) {
            return response([
                "status"=> "invalid",
                "message"=> "Wrong username or password"
            ], 401);
        }
    }
    public function signout(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'token' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $input = $request->all();
            $user = User::where([
                'token'=>$input['token'],
            ])->first();

            User::where('id',$user->id)->update(['token'=>NULL]);

            return response([
                "status"=> "success",
            ], 200);

        } catch (Exception $exception) {
            return response([
                "status"=> "invalid",
                "message"=> "Wrong username or password"
            ], 401);
        }
    }
}
