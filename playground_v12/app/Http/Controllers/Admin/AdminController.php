<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\BannedUser;
use App\Models\Game;
use App\Models\GameVersion;
use App\Models\Score;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin (Request $request) {
        $admins = Admin::all();
        return view('admin', ['admins'=>$admins]);
    }
    public function users (Request $request) {
        $users = User::with(['is_ban'])->get();
        return view('users', ['users'=>$users]);
    }
    public function games (Request $request) {
        $games = Game::withTrashed()->get();
        return view('games', ['games'=>$games]);
    }
    public function user (Request $request, $username) {
        $user = User::with('is_ban')->where(['username'=>$username])->first();
        if ($user->is_ban) {
            return abort(404, $user->is_ban->reason);
        }

        return view('user', ['user'=>$user, 'me'=>$request->user()]);
    }
    public function game (Request $request, $slug) {
        $game = Game::withoutTrashed()->with(['versions'])->where(['slug'=>$slug])->first();
        if ($game) {
            return view('game', ['game'=>$game, 'versions'=>$game->versions]);
        }

        return abort(404, 'Game not found');
    }
    public function user_ban (Request $request) {
        $user_id = $request->get('user_id');
        $reason_id = $request->get('reason_id');
        BannedUser::create([
            'user_id'=>$user_id,
            'reason_id'=>$reason_id,
            'created_at'=>now()
        ]);

        return back()->withInput();
    }
    public function user_unban (Request $request) {
        $user_id = $request->get('user_id');
        BannedUser::where(['user_id'=>$user_id])->delete();
        return back()->withInput();
    }
    public function game_delete (Request $request) {
        $game_id = $request->get('game_id');
        Game::where(['id'=>$game_id])->delete();
        return back()->withInput();
    }
    public function game_refresh (Request $request) {
        $game_id = $request->get('game_id');
        Game::where(['id'=>$game_id])->restore();
        return back()->withInput();
    }
    public function drop_all_game_score (Request $request) {
        $game_id = $request->get('game_id');
        $game = Game::with('versions')->where(['id'=>$game_id])->first();
        collect($game->versions)->map(function ($version) {
            Score::where(['game_version_id'=>$version->id])->delete();
        });
        return back()->withInput();
    }
    public function drop_user_version_score (Request $request) {
        $game_id = $request->get('game_id');
        $user_id = $request->get('user_id');
        $game = Game::with('versions')->where(['id'=>$game_id])->first();
        collect($game->versions)->map(function ($version) use ($user_id) {
            Score::where(['game_version_id'=>$version->id, 'user_id'=>$user_id])->delete();
        });
        return back()->withInput();
    }
    public function drop_one_user_score (Request $request) {
        $score_id = $request->get('score_id');
        Score::where(['id'=>$score_id])->delete();
        return back()->withInput();
    }
}
