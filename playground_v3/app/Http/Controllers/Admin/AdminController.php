<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{



    public function __construct (Request $request) {

    }


    public function admin (Request $request) {
        $me = Auth::user();
        $admins = Admin::all();
        return view('admin', ['admins'=>$admins]);
    }
    public function games (Request $request) {
        $games = Game::withTrashed()->with('author')->get();
        return view('games', ['games'=>$games]);
    }
    public function game (Request $request, $slug) {
        $game = Game::where(['slug'=>$slug])->with('versions')->first();
        return view('game', ['game'=>$game]);
    }
    public function users (Request $request) {
        $users = User::with('is_ban')->get();


        return view('users', ['users'=>$users]);
    }
    public function user (Request $request, $username) {
        $user = User::where(['username'=>$username])->first();
//        dd($user);
        return view('user', ['user'=>$user]);
    }


}
