<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Score;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function games (Request $request) {
        if ($request->method() == "GET") {

        } elseif ($request->method() == "POST") {
            $valid_data = $request->validate([
                'title'=>['required', 'min:3', 'max:60'],
                'description'=>['required', 'min:0', 'max:200'],
            ]);

            $slug = Str::slug($valid_data['title']);
            if (count(Game::where(['slug'=>$slug])->get())) return response([
                'status'=>'invalid',
                'message'=>"Game title already exists"
            ], 400);

            $game = Game::create([
                'title'=>$valid_data['title'],
                'description'=>$valid_data['description'],
                'slug'=>$slug,
                'user_id'=>$request->user()->id,
                'created_at'=>now()
            ]);

            Storage::disk('public')->makeDirectory("/games/$slug");

            return response([
                'status'=>'success',
                'slug'=>$slug
            ], 201);
        }
    }

    public function game (Request $request, $slug) {
        if ($request->method() == "GET") {
            $game = Game::with(['author', 'versions', 'scores'])->where(['slug'=>$slug])->first();
            $last_version = $game->versions->sortByDesc('version')->first();
            $path = "games/$game->slug/$last_version->version";
            $thumbnail =  (Storage::disk('public')->exists("$path/thumbnail.png")) ? "$path/thumbnail.png" : null;
            return response([
                "slug"=>$game->slug,
                "title"=>$game->title,
                "description"=>$game->description,
                "thumbnail"=>$thumbnail,
                "uploadTimestamp"=>$game->created_at,
                "author"=>$game->author->username,
                "scoreCount"=>count($game->scores),
                "gamePath"=>"/games/$game->slug/$last_version->version"
            ]);
        } elseif ($request->method() == "PUT") {
            $title = $request->get('title');
            $description = $request->get('description');
            if (!count(Game::where(['slug'=>$slug])->get())) return response([
                'message'=>'Game not found'
            ], 404);
            $game  = Game::where(['slug'=>$slug])->first();
            $game->title = $title ? $title : $game->title;
            $game->description = $description ? $description : $game->description;
            $game->save();

            return response([
                'status'=>'success'
            ], 200);
        } elseif ($request->method() == "DELETE") {
            $user = $request->user();
            $game = Game::with('author')->where(['slug'=>$slug])->first();
            if ($game->author->id != $user->id) {
                return response([
                    "status"=>"forbidden",
                    "message"=>"You are not the game author"
                ], 403);
            }
            Storage::disk('public')->deleteDirectory("games/$slug");
            $game->delete();

            return response([
                'status'=>'success'
            ], 200);
        }
    }
    public function upload_v (Request $request) {
        if ($request->method() == "POST") {

        }
    }
    public function get_file (Request $request, $slug, $version) {
        if ($request->method() == "GET") {
            $path = "games/$slug/$version/index.html";
            Storage::disk('public')->response($path);
        }
    }

    public function scores (Request $request, $slug) {
        if ($request->method() == "GET") {
            $users = User::with(['scores', 'is_ban'])->get();
            $scores = collect($users)->map(function ($user) {
                $scores = Score::with(['user','game_version'])->where(['user_id'=>$user->id])->get();

                return $scores->sortByDesc('score')->first();
            });
            return response([
                $scores
            ]);
        } elseif ($request->method() == "POST") {
            $score = $request->get('score');
            $user = $request->user();
            $game = Game::where(['slug'=>$slug])->with('versions')->first();
            $last_version = $game->versions->sortByDesc('version')->first();
            Score::create([
                'game_version_id'=>$last_version->id,
                'user_id'=>$user->id,
                'score'=>$score,
                'created_at'=>now()
            ]);
            return response([
                'status'=>'success'
            ]);
        }

    }


//   todo не реализовано
    public function users (Request $request, $username) {
        if ($request->method() == "GET") {
            $user = User::where(['username'=>$username])->first();
            $games = Game::with(['author', 'versions', 'scores'])->where(['user_id'=>$user->id])->get();
            $authoredGames = collect($games)->map(function ($game) {
                return [
                    'slug'=>$game->slug,
                    'title'=>$game->title,
                    'description'=>$game->description
                ];
            });
            $games  = Game::with(['versions', 'author', 'scores'])->get();
            $scores = Score::with(['user','game', 'game_version'])->get()->groupBy('user.id');
            $hightscore = collect($games)->map(function ($game) use($scores, $user) {
                $score = $scores;
//                [$user->id]->sortByDesc('score')->first();
                return [
                    'user_id'=>$score,
//                    'score'=>$score,
//                    'game'=>$scoree

                ];
            });
//            $highscores = collect($highscores)
            return response([
                'username'=>$user->username,
                'registeredTimestamp'=>$user->created_at,
                'authoredGames'=> $authoredGames,
                'highscores'=>$hightscore
            ]);
        }
    }

}
