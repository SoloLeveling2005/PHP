<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuth extends Controller
{
    public function auth(Request $request) {
        return view('auth');
    }
}
