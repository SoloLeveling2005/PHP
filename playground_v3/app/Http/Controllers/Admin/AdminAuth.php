<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminAuth extends Authenticatable
{
    public function auth (Request $request) {
        if ($request->method() == "GET") {
            if (Auth::guard('web')->user()) {
                return Redirect::route('admin');
            }
            return view('auth');
        } elseif ($request->method() == "POST") {
            $data = $request->validate([
                'username'=>'required',
                'password'=>'required',
            ]);
            if (Auth::guard('web')->attempt(['username'=>$data['username'], 'password'=>$data['password']])) {
                $user_id = Auth::guard('web')->user()->getAuthIdentifier();
                Admin::where(['id'=>$user_id])->update(['updated_at'=>now()]);
                return Redirect::route('admin');
            }
        }
        return Redirect::route('auth');
    }
}
