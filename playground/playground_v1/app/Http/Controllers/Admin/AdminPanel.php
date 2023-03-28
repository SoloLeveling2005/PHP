<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BannedUser;
use App\Models\Game;
use App\Models\GameVersion;
use App\Models\Reason;
use App\Models\Score;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminPanel extends Controller
{
    use Authenticatable;

    public $reasons;
    public $me;
    public $games;
    public $users;
    public $admins;

    public function __construct() {
        $this->reasons = Reason::all();
        $this->me = Auth::guard('admin')->user();
        $this->games = Game::withTrashed()->with(['author', 'versions'])->get();
        $this->users = User::all();
        $this->admins = Admin::all();
    }

    public function index (Request $request, $filter_i = 'default') {
        $filter = $request->query('filter');
        $filter_data = $request->query('filter_data');
        if ($filter == "games" and $filter_data != Null) {
            $games = Game::with('author')->get()->filter(function ($game) use ($filter_data) {
                return Str::contains($game->author->username, $filter_data) or Str::contains($game->title, $filter_data) or Str::contains($game->description, $filter_data);
            });

        } else {
            $games = $this->games;
            $filter = $filter_i;
        }
        return view('admin',
            ['users'=>$this->users, 'admins'=>$this->admins, 'games'=>$games, 'reasons'=>$this->reasons, 'me'=>$this->me])->with('filter', $filter);
    }

    public function game (Request $request, $slug) {
        $game = Game::with(['versions'=> function($query) {
            $query->orderBy('created_at');
        }])->where(['slug'=>$slug])->first();
        if (is_null($game)) {
            return abort(403);
        }

        return view('game', ['game'=>$game, 'me'=>$this->me]);
    }

    public function user (Request $request, $username) {
        $user = User::with('ban')->where(['username'=>$username])->first();
        if (isset($user->ban)) {
            return abort(403);
        }
        $scores = Score::with('game_versions')->where('user_id',$user->id)->get();
        return view('user', ['user'=>$user, 'me'=>$this->me, 'reasons'=>$this->reasons, 'scores'=>$scores]);
    }

    public function reset_all_user_score (Request $request) {
        $user_id = $request->get('user_id');
        Score::where(['user_id'=>$user_id])->delete();
        return back()->withInput();
    }

    public function reset_user_score (Request $request) {
        $score_id = $request->get('score_id');
        Score::where(['id'=>$score_id])->delete();
        return back()->withInput();
    }

    public function reset_all_game_score (Request $request) {
        $game_id = $request->get('game_id');
        $game_versions = Game::with('versions')->find(['id'=>$game_id])->first()->versions;

        $versions_score = collect($game_versions->map(function ($game_version) {
            return $game_version->version_scores;
        }));
        foreach ($versions_score as $scores) {
            foreach ($scores as $score) {
                Score::where(['id'=>$score->id])->delete();
            }

        }
        return back()->withInput();
    }


    public function user_ban (Request $request) {
        $user_id = $request->get('user_id');
        $reason = $request->get('reason_id');
        BannedUser::create(['user_id'=>$user_id, 'reason_id'=>$reason]);
        return redirect()->route('index', ['filter'=>'users']);
    }

    public function user_unban (Request $request) {
        $user_id = $request->get('user_id');
        BannedUser::where(['user_id'=>$user_id])->delete();
        return redirect()->route('index', ['filter'=>'users']);
    }


    public function game_delete (Request $request) {
        $game_id = $request->get('game_id');
        Game::where(['id'=>$game_id])->delete();
        return redirect()->route('index', ['filter'=>'games']);
    }

    public function game_recovery (Request $request) {
        $game_id = $request->get('game_id');
        Game::where(['id'=>$game_id])->restore();
        return redirect()->route('index', ['filter'=>'games']);
    }

    public function game_filter (Request $request) {
        $filter_data = $request->get('filter_data');


        return redirect("XX-module-a/admin?filter=games&filter_data=$filter_data");
    }
}
