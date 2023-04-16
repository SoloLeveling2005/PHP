<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameVersion;
use App\Models\Score;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\PaginationState;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class ApiController extends Controller
{
    // GET - Вывод всех игр с возможностью пагинации / POST - создание новой игры
    public function games (Request $request) {
        if ($request->method() == "GET") {
            $page = $request->get('page', 0)+1;
            $size = $request->get('size', 10);
            $sortBy = $request->get('sortBy', 'title'); // popular uploaddate
            $sortDir = $request->get('sortDir', 'asc'); // desc

            $games = Game::with(['versions', 'author'])->has('versions')->get();

            $games = collect($games)->map(function ($game) {
                $last_v = $game->versions()->orderByDesc('id')->first();
                $thumbnail = $game->thumbnail ? $game->thumbnail : null;
                $game_versions = GameVersion::with('scores')->where(['game_id'=>$game->id])->get();
                $scores = collect($game_versions)->map(function ($game_version) {
                    return count($game_version->scores);
                });
                $scores_count = array_sum($scores->toArray());
                return [
                    'slug'=>$game->slug,
                    'title'=>$game->title,
                    'description'=>$game->description,
                    'thumbnail'=>$thumbnail,
                    'uploadTimestamp'=>$last_v->created_at,
                    'author'=>$game->author->username,
                    'scoreCount'=>$scores_count,

                    'uploaddate'=>$last_v->created_at,
                    'popular'=>$scores_count
                ];
            });
            $games = $sortDir == 'asc' ? $games->sortBy($sortBy): $games->sortByDesc($sortBy);
            $paginate = new LengthAwarePaginator(
                $games->forPage($page, $size),
                count($games),
                $size,
                $page
            );
            return response([
                'page'=>$page,
                'size'=>$size,
                'totalElements'=>count($games),
                'content'=>$paginate->all()
            ]);

        } elseif ($request->method() == "POST") {
            $valid_data = $request->validate([
                'title'=>['required', 'min:3', 'max:60'],
                'description'=>['required', 'min:0', 'max:200']
            ]);

            $slug = Str::slug($valid_data['title']);
            if(count(Game::where(['slug'=>$slug])->get())) return response([
                "status"=> "invalid",
                "slug"=> "Game title already exists"
            ], 400);
            Game::create([
                'title'=>$valid_data['title'],
                'description'=>$valid_data['description'],
                'slug'=>$slug,
                'user_id'=>$request->user()->id,
                'created_at'=>now()
            ]);

            Storage::disk('public')->makeDirectory("games/$slug/");

            return response([
                "status"=> "success",
                "slug"=> $slug
            ], 201);
        }
    }
    // GET - вывод информации об игре / PUT - обновление информации об игре / DELETE - Удаление игры
    public function game (Request $request, $slug) {
        if ($request->method() == "GET") {
            $game = Game::where(['slug'=>$slug])->first();
            $thumbnail = $game->thumbnail ? $game->thumbnail : null;
            $game_versions = GameVersion::with('scores')->where(['game_id'=>$game->id])->get();
            $scores = collect($game_versions)->map(function ($game_version) {
                return count($game_version->scores);
            });
            $scores_count = array_sum($scores->toArray());
            $last_v = $game->versions()->orderByDesc('id')->first();
            $gamePath = "games/$game->slug/$last_v->version";
            return response([
                'slug'=>$game->slug,
                'title'=>$game->title,
                'description'=>$game->description,
                'thumbnail'=>$thumbnail,
                'uploadTimestamp'=>$game->created_at,
                'author'=>$game->author->username,
                'scoreCount'=>$scores_count,
                'gamePath'=>$gamePath,
            ]);
        } elseif ($request->method() == "PUT") {
            $game = Game::where(['slug'=>$slug])->first();
            if (!$game) return response([
                'message'=>'game not found'
            ], 404);
            $user = $request->user();
            if ($game->author->id != $user->id) return response([
                'status'=>'forbidden',
                'message'=>'You are not the game author'
            ], 403);
            $title = $request->get('title', $game->title);
            $description = $request->get('description', $game->description);
            $game->title = $title;
            $game->description = $description;
            $game->save();
            return response([
                'status'=>'success'
            ], 200);
        } elseif ($request->method() == "DELETE") {
            $game = Game::where(['slug'=>$slug])->first();
            if (!$game) return response([
                'message'=>'game not found'
            ], 404);
            $user = $request->user();
            if ($game->author->id != $user->id) return response([
                'status'=>'forbidden',
                'message'=>'You are not the game author'
            ], 403);

            $game->delete();
            return response([], 204);
        }
    }
    // Загрузка новой версии игры
    public function version_upload (Request $request, $slug) {
        if ($request->method() == "POST") {
            $valid_data = $request->validate([
                'zipfile'=>'required|file|mimes:zip',
                'token'=>['required']
            ]);

            $game =  Game::where(['slug'=>$slug])->first();
            $user = $request->user();
            if ($game->author->id != $user->id) return response([
                'status'=>'forbidden',
                'message'=>'You are not the game author'
            ], 403);
            $last_v = $game->versions()->orderByDesc('id')->first();
            $path = "app/public/games/$game->slug/$last_v->version/";
            $zip = new ZipArchive();
            $file = $request->file('zipfile');
            if ($zip->open($file)) {
                $zip->extractTo(storage_path($path));
                GameVersion::create([
                    'game_id'=>$game->id,
                    'version'=>$last_v->version+1,
                    'created_at'=>now()
                ]);
                $zip->close();
                return response([
                    'status'=>'success'
                ], 200);
            }
            $zip->close();
            return response([
                'message'=>'ZIP file extraction fails'
            ], 400);
        }
    }

    // Предоставление версионных файлов
    public function version_file (Request $request, $slug, $version) {
        if ($request->method() == "GET") {
            return Storage::disk('public')->response("games/$slug/$version/index.html");
        }
    }

    // GEt - Вывод самых высоких очков / POST - публикация очка
    public function scores (Request $request, $slug) {
        if ($request->method() == "GET") {
            $game = Game::where(['slug'=>$slug])->first();
            $game_versions = GameVersion::where(['game_id'=>$game->id])->get();
            $scores = collect($game_versions)->map(function ($game_version) {
                return $game_version->scores;
            });
            $scores = $scores->collapse()->groupBy('user_id');
            $scores = collect($scores)->map(function ($score) {
                $score = $score->sortByDesc('score')->first();
                return [
                    'username'=>$score->user->username,
                    'score'=>$score->score,
                    'timestamps'=>$score->created_at,

                ];
            });
            return response([
                'scores'=>$scores
            ], 200);
        } elseif ($request->method() == "POST") {
            $score = $request->get('score');
            $game = Game::where(['slug'=>$slug])->with(['versions'])->first();
            $last_v = $game->versions->sortBy('id')->last('id')->first();
            Score::create([
                'game_version_id'=>$last_v->id,
                'user_id'=>$request->user()->id,
                'score'=>$score,
                'created_at'=>now()
            ]);

            return response([
                'status'=>'success'
            ], 201);
        }
    }

    // GET - предоставление информации о пользователе
    public function users (Request $request, $username) {
        if ($request->method() == "GET") {
            $user = User::with(['authored_game'])->where(['username'=>$username])->first();
            $games = Game::with(['scores', 'author'])->get();

            $scores = collect($games)->map(function ($game) use ($user) {
                $my_scores = collect($game->scores)->map(function ($score) use ($user) {
                    if ($score->user->id == $user->id) {
                        return $score;
                    }
                });

                $max_score = $my_scores->sortByDesc('score')->first();
                if (is_null($max_score)) return [];
                return [
                    'game'=>[
                        'slug'=>$game->slug,
                        'title'=>$game->title,
                        'description'=>$game->description,
                    ],
                    'score'=>$max_score->score,
                    'timestamp'=>$max_score->created_at

                ];
            });
            $games = collect($user->authored_game)->map(function ($game, $user) {
                return [
                    'slug'=>$game->slug,
                    'title'=>$game->title,
                    'description'=>$game->description,
                ];
            });
            return [
                'username'=>$user->username,
                'registeredTimestamp'=>$user->created_at,
                'authoredGames'=>$games,
                'highscores'=>$scores
            ];
        }
    }
}
