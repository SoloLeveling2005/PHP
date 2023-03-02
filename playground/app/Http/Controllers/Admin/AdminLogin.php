<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminLogin extends Controller
{
    use Authenticatable;
    public function login(Request $request, Auth $auth)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($auth::guard('admin')->attempt($validated, true)) {
//            Admin::where($validated)->update(['updated_at'=>now()]);

            return Redirect::route('admin');
//            return redirect()->intended('XX-module-a/admin');
        }
        return redirect()->route('login');
    }
}
