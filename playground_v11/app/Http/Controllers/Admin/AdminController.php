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
        $users = User::with('is_ban')->get();
        return view('users', ['users'=>$users]);
    }

    public function games (Request $request) {
        $games = Game::withTrashed()->with(['versions', 'author'])->get();
        return view('games', ['games'=>$games]);
    }

    public function user (Request $request, $username) {
        $user = User::where(['username'=>$username])->first();
        if ($user->is_ban) return abort(404);
        return view('user', ['user'=>$user]);
    }

    public function game (Request $request, $slug) {
        $game = Game::with(['versions', 'author', 'scores'])->first();
        return view('game', ['game'=>$game]);
    }

    public function user_ban (Request $request) {
        $Spamming = $request->get('Spamming');
        $Cheating = $request->get('Cheating');
        $Other = $request->get('Other');
        $reason_id = null;
        if ($Spamming) {
            $reason_id = 2;
        } elseif ($Cheating) {
            $reason_id = 3;
        } else {
            $reason_id = 1;
        }
        BannedUser::create([
            'user_id'=>$request->get('user_id'),
            'reason_id'=>$reason_id,
            'created_at'=>now()
        ]);
        return back()->withInput();
    }

    public function user_unban (Request $request) {
        BannedUser::where(['user_id'=>$request->get('user_id')])->delete();
        return back()->withInput();
    }

    public function drop_version_score (Request $request) {
        Score::where(['game_version_id'=>$request->get('game_version_id')])->delete();
        return back()->withInput();
    }

    public function drop_all_user_score (Request $request) {
        $game_versions = GameVersion::where(['game_id'=>$request->get('game_id')])->get();
        $d = collect($game_versions)->map(function ($game_version) use($request) {
            Score::where(['game_version_id'=>$game_version->id, 'user_id'=>$request->get('user_id')])->delete();
        });
        return back()->withInput();
    }

    public function drop_score (Request $request) {
        Score::where(['id'=>$request->get('score_id')])->delete();
        return back()->withInput();
    }

    public function game_delete (Request $request) {
        Game::where(['id'=>$request->get('game_id')])->delete();
        return back()->withInput();
    }
    public function game_refresh (Request $request) {
        $game = Game::where(['id'=>$request->get('game_id')])->restore();
        return back()->withInput();
    }
}
