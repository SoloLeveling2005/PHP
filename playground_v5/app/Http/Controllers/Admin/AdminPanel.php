<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\BannedUser;
use App\Models\Game;
use App\Models\GameVersion;
use App\Models\Reason;
use App\Models\Score;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPanel extends Controller
{
    public function admins(Request $request) {
        $admins = Admin::all();
        return view('admins', ['admins'=>$admins]);
    }
    public function games(Request $request) {
        $games = Game::with(['author'])->withTrashed()->get();
        return view('games', ['games'=>$games]);
    }
    public function game(Request $request, $slug) {
        $game = Game::where(['slug'=>$slug])->first();

        if ($game->deleted_at) {
            return abort(404, 'Game not found');
        }

        $game_versions = GameVersion::with('scores')->where(['game_id'=>$game->id])->get();
        $banned_user_ids = collect(BannedUser::all('user_id')->map(function ($user_id) {
            return $user_id->user_id;
        }));
        return view('game', ['game'=>$game, 'game_versions'=>$game_versions, "banned_user_ids"=>$banned_user_ids]);
    }
    public function users(Request $request) {
        $users = User::with('is_ban')->get();
        return view('users', ['users'=>$users]);
    }

    public function user(Request $request, $username) {
        $me = Auth::guard('web')->user();
        $user = User::where(['username'=>$username])->first();
        if ($user->is_ban) {
            return abort(404, Reason::where(['id'=>$user->is_ban->reason_id])->first()->title);
        }
        return view('user', ['user'=>$user, 'me'=>$me]);
    }

    /**
     * Удаляет одно очко
     */
    public function delete_one_score (Request $request, $score_id) {
        $score = Score::where(['id'=>$score_id])->delete();
        return back()->withInput();
    }

    /**
     * Удаляет все очки одного пользователя
     */
    public function delete_all_user_score (Request $request, $user_id, $game_version_id) {
        $score = Score::where(['user_id'=>$user_id, 'game_version_id'=>$game_version_id])->delete();
        return back()->withInput();
    }

    /**
     * Удаляет очки для всей игры
     */
    public function delete_all_game_version_score (Request $request, $game_version_id) {
        $score = Score::where(['game_version_id'=>$game_version_id])->delete();
        return back()->withInput();
    }


    /**
     * Баним пользователя
     */
    public function user_ban (Request $request, $user_id) {
        if ($request->get('spamming')) {
            $reason_id = 2;
        } elseif ($request->get('cheating')) {
            $reason_id = 3;
        } elseif ($request->get('other')) {
            $reason_id = 1;
        }
        $user = BannedUser::create(['user_id'=>$user_id, 'reason_id'=>$reason_id]);
        return back()->withInput();
    }

    /**
     * Разбаниваем пользователя
     */
    public function user_unban (Request $request, $user_id) {
        $user = BannedUser::where(['user_id'=>$user_id])->delete();
        return back()->withInput();
    }



    /**
     * Удаляем игру
     */
    public function game_delete (Request $request, $game_id) {
        $game = Game::where(['id'=>$game_id])->delete();
        return back()->withInput();
    }


    /**
     * Восстанавливаем игру
     */
    public function game_refresh (Request $request, $game_id) {
        $game = Game::where(['id'=>$game_id])->restore();
        return back()->withInput();
    }
}
