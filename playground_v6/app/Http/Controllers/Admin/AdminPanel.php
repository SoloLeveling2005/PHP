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

class AdminPanel extends Controller
{
    public function admins (Request $request) {
        $admins = Admin::all();
        return view('admin', ['admins'=> $admins]);
    }
    public function users (Request $request) {
        $users = User::all();
        return view('users', ['users'=> $users]);
    }
    public function games (Request $request) {
        $games = Game::withTrashed()->get();
        return view('games', ['games'=> $games]);
    }
    public function user (Request $request, $username) {
        $user = User::with('is_ban')->where(['username'=>$username])->first();
        return view('user', ['user'=> $user]);
    }
    public function game (Request $request, $slug) {
        $game = Game::where(['slug'=>$slug])->first();
        $game_versions = GameVersion::where(['id'=>$game->id])->get();
        return view('game', ['game'=> $game, 'game_versions'=>$game_versions]);
    }

    public function drop_user_score (Request $request) {
        $score_id = $request->get('score_id');
        Score::where(['id'=>$score_id])->delete();
        return back()->withInput();
    }

    public function drop_all_user_scores (Request $request) {
        $user_id = $request->get('user_id');
        $game_version_id = $request->get('game_version_id');
        Score::where(['user_id'=>$user_id, 'game_version_id'=>$game_version_id])->delete();
        return back()->withInput();
    }

    public function drop_game_version_scores (Request $request) {
        $game_version_id = $request->get('game_version_id');
        Score::where(['game_version_id'=>$game_version_id])->delete();
        return back()->withInput();
    }


    public function user_ban (Request $request) {
        $user_id = $request->get('user_id');
        $reason_id = null;

        $cheating = $request->get('cheating');
        $spamming = $request->get('spamming');
        if ($cheating) {
            $reason_id = 3;
        } elseif ($spamming) {
            $reason_id = 2;
        } else {
            $reason_id = 1;
        }

        BannedUser::create(['user_id'=>$user_id, 'reason_id'=>$reason_id]);
        return redirect(route('users'));
    }


    public function user_unban (Request $request) {
        $user_id = $request->get('user_id');
        $iser = BannedUser::where(['user_id'=>(int)$user_id])->delete();

        return redirect(route('users'));
    }


    public function game_delete (Request $request) {
        $game_id = $request->get('game_id');
        Game::where(['id'=>$game_id])->delete();
        return redirect(route('games'));
    }

    public function game_refresh (Request $request) {
        $game_id = $request->get('game_id');
        Game::where(['id'=>$game_id])->restore();
        return redirect(route('games'));
    }

}
