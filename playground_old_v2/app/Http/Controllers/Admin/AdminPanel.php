<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Game;
use App\Models\GameVersion;
use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPanel extends Controller
{
    use Authenticatable;

    private mixed $admin_info;

    public function __construct()
    {
        $this->middleware('admin');
        $this->admin_info = Auth::guard('admin')->user()->getAttributes()['username'];
    }
    public function index(Request $request, Auth $auth)
    {
        $admins = Admin::all();
        $users = User::all();
        $games = Game::all();
        $game_versions = GameVersion::all();
        $games = $games->map(function ($game) {
            return [
                'title'=>$game['title'],
                'slug'=>$game['slug'],
                'description'=>$game['description'],
                'author'=>(User::where('id', $game['author_id'])->first())->username,
                'latest_version'=>GameVersion::where('game_id', $game['id'])->latest('id')->first()->file_name
            ];
        });
        return view('admin', ['admins'=>$admins, 'users'=>$users, 'games'=>$games, 'game_versions'=>$game_versions, 'admin_me'=>ucfirst($this->admin_info)]);
    }

    public function user(Request $request, $username) {
        $info = User::where('username', $username)->first()->getAttributes();

        return view('user_and_game', ['type_info'=>'user','info'=>$info , 'admin_me'=>ucfirst($this->admin_info)]);
    }
    public function game(Request $request, $slug) {
        $info = Game::where('slug', $slug)->first()->getAttributes();
        dd($info);
        return view('user_and_game', ['type_info'=>'game','info'=>$info , 'admin_me'=>ucfirst($this->admin_info)]);
    }
}
