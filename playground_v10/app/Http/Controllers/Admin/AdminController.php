<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\BannedUser;
use App\Models\Game;
use App\Models\Score;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admins(Request $request) {
        $admins = Admin::all();
        return view('admin', ['admins'=>$admins]);
    }

    public function users (Request $request) {
        $users = User::all();
        return view('users', ['users'=>$users]);
    }

    public function games (Request $request) {
        $games = Game::withTrashed()->get();
        return view('games', ['games'=>$games]);
    }

    public function user(Request $request, $username) {
        $user = User::where(['username'=>$username])->first();
        if ($user->is_ban) return abort(404, $user->is_ban()->reason()->title);
        return view('user', ['user'=>$user]);
    }

    public function game(Request $request, $slug) {
        $game = Game::withTrashed()->where(['slug'=>$slug])->first();
        if ($game->deleted_at) return abort(404, "Game not found");
        return view('game', ['game'=>$game, 'versions'=>$game->versions]);
    }


    public function user_ban (Request $request) {
        $user_id = $request->get('user_id');
        $cheating = $request->get('cheating');
        $spamming = $request->get('spamming');
        $other = $request->get('other');
        $reason_id = null;
        if ($cheating) {
            $reason_id = 3;
        } elseif ($spamming) {
            $reason_id = 2;
        } else {
            $reason_id = 1;
        }

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
        $game = Game::withTrashed()->where(['id'=>$game_id])->first();
        $game->deleted_at = null;
        $game->save();
        return back()->withInput();
    }

    public function drop_all_user_score (Request $request) {
        $user_id = $request->get('user_id');
        $game_version_id = $request->get('game_version_id');
        Score::where(['user_id'=>$user_id, 'game_version_id'=>$game_version_id])->delete();
        return back()->withInput();
    }

    public function drop_user_score (Request $request) {
        $score_id = $request->get('score_id');
        Score::where(['id'=>$score_id])->delete();
        return back()->withInput();
    }

    public function drop_all_version_score (Request $request) {
        $game_version_id = $request->get('game_version_id');
        Score::where(['game_version_id'=>$game_version_id])->delete();
        return back()->withInput();
    }

}
