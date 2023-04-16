<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPanel extends Controller
{
    public function admins(Request $request) {
        return view("index");
    }
    public function users(Request $request) {
        return view("users");
    }
    public function user(Request $request, $username) {
        return view("user");
    }
    public function games(Request $request) {
        return view("games");
    }
    public function game(Request $request, $slug) {
        return view("game");
    }
//    public function () {
//        return view("");
//    }
}
