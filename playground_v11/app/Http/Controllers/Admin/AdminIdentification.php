<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminIdentification extends Controller
{
    public function login (Request $request) {
        if ($request->method() == "POST") {
            $valid_data = $request->validate([
                'username' => ['required', 'unique:users'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($valid_data)) {
                $user = $request->user();
                $admin = Admin::where(['id' => $user->id])->first();
                $admin->updated_at = now();
                $admin->save();
                return redirect(route('admin'));
            }
            dd('hhi');
        }
        return view('auth');


    }
}
