<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminLogin extends Authenticatable
{

    public function login (Request $request, Auth $auth) {
        $validate = $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);
        if ($auth::guard('admin')->attempt(['username'=>$validate['username'], 'password'=>$validate['password']])) {
            $admin_id = $auth::guard('admin')->user()->getAuthIdentifier();
            DB::table('admins')->where(['id'=>$admin_id])->update(['updated_at'=>now()]);
            return Redirect::route('index');
        }
        return view('login');

    }
}
