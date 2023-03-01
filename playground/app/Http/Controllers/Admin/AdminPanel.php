<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPanel extends Controller
{
    use Authenticatable;
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index(Request $request, Auth $auth)
    {
        return view('admin');
    }

}
