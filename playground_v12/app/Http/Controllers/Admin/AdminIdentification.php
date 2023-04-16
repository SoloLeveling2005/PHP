<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminIdentification extends Controller
{
    public function login (Request $request) {
        if ($request->method() == "POST") {
            $valid_data = $request->validate([
                'username'=>['required'],
                'password'=>['required']
            ]);
            if (Auth::attempt($valid_data)) {
                $user = $request->user();
                $admin = Admin::where(['id'=>$user->id])->first();
                $admin->updated_at = now();
                $admin->save();
                return redirect(route('admin'));
            }
        }
        return view('auth');
    }
}
