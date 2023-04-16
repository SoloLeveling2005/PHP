<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthorization extends Controller
{
    public function auth (Request $request) {
        if ($request->method() == "GET") {
            return view('auth');
        } else {
            $data = $request->validate([
                "username"=>"required",
                "password"=>"required",
            ]);

            if (Auth::guard('web')->attempt($data)) {
                $user = Auth::guard('web')->user();
                Admin::where(['id'=>$user->getAuthIdentifier()])->update(['created_at'=>now()]);
                return redirect(route('admins'));
            } else {
                return redirect(route('auth'));
            }
        }
    }

    public function logout (Request $request) {
        Auth::logout();
        return redirect(route('auth'));
    }
}
