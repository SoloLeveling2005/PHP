<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminIdentification extends Controller
{
    public function login (Request $request) {
        if ($request->method() == "POST") {
            $validation = $request->validate([
                'username'=>'',
                'password'=>'',
            ]);
            if (Auth::attempt($validation)) {
                return redirect(route('admins'));
            }
        }
        return view('auth');
    }
}
