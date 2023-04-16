<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request) {
        return view('index');
    }

    public function users(Request $request) {
        return view('users');
    }

    public function games(Request $request) {
        return view('games');
    }

    public function user(Request $request, $username) {
        return view('user');
    }

    public function game(Request $request, $slug) {
        return view('game');
    }
}
