<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameVersion;
use App\Models\Score;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mockery\Exception;
use ZipArchive;

class ApiController extends Controller
{
    public $user, $token;
    public function __construct(Request $request) {
        $token = str_replace('Bearer ','',$request->header('Authorization'));
        $user = $request->user();
    }

    public function games(Request $request) {
        if ($request->method() == 'POST') { 
            try {
                DB::beginTransaction();
    
                $validator = $request->validate([
                    'title' => ['required','unique:games','min:3','max:60'],
                    'description' => ['required','min:0','max:200'],
                ]);
    
                $slug = Str::slug($validator['title']);
    
                DB::table('games')->insert([
                    'title'=>$validator['title'],
                    'description'=>$validator['description'],
                    'slug'=>$slug,
                    'author_id'=>$this->user->id,
                    'created_at'=>now()
                ]);
    
                Storage::makeDirectory("public/v1/games/$slug");
    
            } catch (\Throwable $e) {
                DB::rollBack();
                return response([
                    "status" => "invalid",
                    "slug" => $e->getMessage()
                ], 400);
            }
            DB::commit();
            return response([
                "status" => "success"
            ], 201);

        } elseif ($request->method() == 'GET') {
            $page = $request->get('page', 0)+1;
            $size = $request->get('size', 10); // todo поменять на 10
            $sortBy = $request->get('sortBy', 'popular');
            $sortDir = $request->get('sortDir', 'asc');

            $data = collect(Game::has('versions')->get())->map(function ($game) {
                $last_version = $game->latestVersion();

                
                return [
                    "slug" => $game->slug,
                    "title" => $game->title,
                    "description" => $game->description,
                    "thumbnail" => $game->thumbnail,
                    "uploaddate" => $game->created_at,
                    "author" => $game->author->username,
                    "scoreCount" => count($last_version->version_scores),
                    "popular" => count($last_version->version_scores),
                ];

            });

            $data = $sortDir == "asc" ? $data->sortBy($sortBy) : $data->sortByDesc($sortBy);
            
            $games = new LengthAwarePaginator(
                $data->forPage($page, $size),  // items
                $data->count(), // total
                $size, // perPage
                $page // currentPage
            );

            $games_data = collect($games->all())->map(function ($game) {
                return [
                    "slug" => $game['slug'],
                    "title" => $game['title'],
                    "description" => $game['description'],
                    "thumbnail" => $game['thumbnail'],
                    "uploaddate" => $game['uploaddate'],
                    "author" => $game['author'],
                    "scoreCount" => $game['scoreCount'],
                ];

            });

            return response([
                "page"=> $games->currentPage(),
                "size"=> $games->perPage(),
                "totalElements" => count(Game::has('versions')->get()),
                "content"=> $games_data
            ], 200);

        } else {
            return response([
                "status" => 405,
                "message" => 'Method Not Allowed'
            ], 405 );
        }
    }


    public function game(Request $request, $slug) {
        if ($request->method() == 'PUT') {
            $title = $request->get('title');
            $description = $request->get('description');

            $game = Game::firstWhere('slug' , $slug);

            if (!$game) return response([
                "status" => "Error",
                "message" => 'Game not found'
            ], 403); 

            if ($this->user->id != $game->author_id) {
                return response([
                    "status" => "forbidden",
                    "message" => "You are not the game author"
                ], 403);
            }

            $title = $title == '' ? $game->title : $title;
            $description = $description == '' ? $game->description : $description;

            $game->update(['title' => $title,'description' => $description]);
            $game->save();

            return response([
                "status" => "success"
            ], 200);
        } elseif ($request->method() == 'GET') {
            $game = Game::where(['slug'=>$slug])->with('versions')->has('versions')->first();
            if (!$game) return response([
                "status"=> "invalid",
                "slug"=> "Versions not found"
            ], 404);

            $last_version = $game->latestVersion();
            $game_version_scores = $last_version->version_scores;

            return response([
                "slug" => $game->slug,
                "title" => $game->title,
                "description" => $game->description,
                "thumbnail" => $game['thumbnail'],
                "uploadTimestamp" => $game->created_at,
                "author" => $game->author->username,
                "scoreCount" => count($game_version_scores),
                "gamePath" => (isset($last_version->path_to_game) ? 'v1/games/' . $last_version->path_to_game : null),
                'game_versions' => $game->versions->sortBy('id')
            ], 200);

        } elseif ($request->method() == 'DELETE') {
            try {
                DB::beginTransaction();
    
                $game = Game::firstWhere('slug' , $slug);
                if (!$game) return response([
                    "status" => "Error",
                    "message" => 'Game not found'
                ], 403); 
    
                if ($this->user->id != $game->author_id) {
                    return response([
                        "status" => "forbidden",
                        "message" => "You are not the game author"
                    ], 403);
                }
    
                DB::table('games')->where('slug', $slug)->delete();
    
            } catch (\Throwable $e) {
                DB::rollBack();
                return response([
                    "status" => "Error",
                    "message" => $e->getMessage()
                ], 404);
            }
            DB::commit();
            return response([],200);
        } else {
            return response([
                "status" => 405,
                "message" => 'Method Not Allowed'
            ], 405 );
        }
    }


    public function gameScore(Request $request, $slug) {
        if ($request->method() == 'GET') {
            $game = Game::firstWhere(['slug'=>$slug]);
            if (!$game) return response([
                "status" => "Error",
                "message" => 'Game not found'
            ], 403); 
            $versions = $game->game_version_scores;
            // return $versions;
            $scores = collect($versions)->flatMap(function ($version) {
                return collect($version->version_scores)->map(function ($scores) use ($version) {
                    return [
                        'username'=> $scores->user->username,
                        'score'=> $scores->score,
                        'timestamp'=> $version->created_at,
                    ];
                });
            }); 
            $scores = array_slice(iterator_to_array($scores->sortBy('score')), 0, 10);
    
            return $scores;

        } elseif ($request->method() == 'POST') {
            $score = $request->get('score');
            $game = Game::firstWhere(['slug'=>$slug]);
            if (!$game) return response([
                "status" => "Error",
                "message" => 'Game not found'
            ], 403); 
            $last_version = $game->latestVersion();
            $score = Score::create(['user_id'=>$this->user->id, 'game_version_id'=>$last_version->id, 'score'=>$score]);
            return response([
                "status" => "success"
            ], 200);
        } else {
            return response([
                "status" => 405,
                "message" => 'Method Not Allowed'
            ], 405 );
        }
    }

//  todo load game, realize later
    public function upload_v(Request $request, $slug) {
        $request->validate([
            'zipfile' => 'required|file',
            'token' => 'required'
        ]);


        $game = Game::firstWhere(['slug'=>$slug]);
        if (!$game) return response([
            "status" => "Error",
            "message" => 'Game not found'
        ], 403); 
        $last_version = $game->latestVersion();

        $mass = explode('/', $last_version->path_to_game);
        $count_last_versions = end($mass)+1;

        GameVersion::create(['game_id'=>$game->id, 'path_to_game'=>"$slug/$count_last_versions", 'created_at'=>now()]);

        $file = $request->file('zipfile');
        $zip = new ZipArchive;
        $res = $zip->open($file);
        if ($res === TRUE) {
            $zip->extractTo(storage_path("app/public/v1/games/$slug/$count_last_versions/"));
            $zip->close();
            return response('Succes unarchivations', 201);
        } else {
            return response('Error unarchivations', 201);
        }

    }

//  todo РЕАЛИЗОВАН!
    public function game_v(Request $request, $slug, $version)  {
//      todo предоставление игровых файлов.
        try {
            $pathToFile = "v1/games/$slug/$version";
            if (!Storage::disk('public')->exists($pathToFile)) {
                return response('Invalid path', 400);
            }
            
            return Storage::disk('public')->response($pathToFile);

        } catch (Exception $exception) {
            return response([
                "status"=> "error",
            ], 404);
        }
    }

//  todo РЕАЛИЗОВАН!
//  todo тестировал!
    public function user(Request $request, $username) {
//      todo Информация о пользователе.
    
        $author = User::where('username', $username)->first();
        $user = $request->user();
        if (!$author) return response([
            "status" => "Error",
            "message" => 'Author not found'
        ], 403); 
        
        $authoredGames = Game::where(['author_id' => $author->id])->get();
        
        if ($author->id != $user->id) {
            $authoredGames = Game::where(['author_id' => $author->id, ])->has('versions')->get();
        }

        $highscores = Score::where('user_id', $author->id)->groupBy('scores.game_version_id')
        ->selectRaw('MAX(score) as score, scores.game_version_id as game_version_id, scores.created_at as timestamp')->get();

        $highscores = collect($highscores)->map(function ($highscore) {
            $game_versions = GameVersion::firstWhere(['id'=> $highscore->game_version_id])->has('game')->with('game')->latest()->orderBy('id', 'desc')->first();       
            return [
                "game" => [
                    "slug" => $game_versions->game->slug,
                    "title" => $game_versions->game->title,
                    "description" => $game_versions->game->description
                ],
                "score" => $highscore->score,
                "timestamp" => $highscore->timestamp
            ];
        });

        return response([
            "user"=> $user->username,
            "author"=> $author->username,
            "registeredTimestamp" => $author->created_at,
            "authoredGames" => $authoredGames,
            "highscores" => $highscores
        ], 200);
    }

}
