<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Middleware\TrimStrings;
use App\Models\Game;
//use http\Client\Curl\User;
use App\Models\GameVersion;
use App\Models\Score;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mockery\Exception;
use Illuminate\Support\Facades\File;
use ZipArchive;

class ApiController extends Controller
{
    public $user, $token;
    public function __construct(Request $request) {
        $this->user = $request->user();
        $this->token = $request->bearerToken();
    }

//  todo РЕАЛИЗОВАН!
//  todo тестировал!
//  todo Заменен на games
    public function gamesGet(Request $request) {
//      todo Возвращает список игр с возможностью пагинации.

    //  Параметры запроса:
    //  page - начианется с 0. По умолчанию 0.
    //  size - Количество элементов. Должно быть больше или равно 1. По умолчанию 10.
    //  sortBy - Поле для сортировки. Должен быть один из "title", "popular", "uploaddate". По умолчанию title.
    //  sortDir - Направление сортировки. Должен быть один из "asc" или "desc". По умолчанию asc.

    //  Описание полей сортировки:
    //  title - Заголовок игры.
    //  popular - Считает общее количество результатов за игру и сортирует по этому количеству.
    //  uploaddate - По временной метке загрузки последней версии игры.

    //  В `content`, поля `thumbnail` и `uploadTimestamp` относятся только к последней версии.
    //  Поле `scoreCount` это сумма результатов по всем версиям.

    //  Описание полей в теле ответа:
    //  page - Запрашиваемый номер страницы. Начинается с 0.
    //  size - Фактический размер страницы. Должен быть меньше или равен, чем запрошенный размер страницы.
    //  totalElements - Общее количество элементов независимо от страницы.
    //  content - Массив игр на странице.

    //  Можно рассчитать, сколько страниц есть:
    //  pageCount = ceil(totalElements / requestedSize)
    //  isLastPage = (page + 1) * requestedSize >= totalElements

    //  ПРИМЕЧАНИЕ 1: Если есть игра, в которой пока нет игровой версии, она не включена ни в ответ, ни в общее количество.
    //  ПРИМЕЧАНИЕ 2: Если нет миниатюры, поле миниатюры равно null.

        $page = $request->get('page', 0)+1;
        $size = $request->get('size', 10); // todo поменять на 10
        $sortBy = $request->get('sortBy', 'popular');
        $sortDir = $request->get('sortDir', 'asc');

        $data = collect(Game::has('versions')->get())->map(function ($game) {
            $last_version = $game->latestVersion();

            $thumbnail = $last_version['thumbnail'] == 'thumbnail.png' ? null : $last_version['path_to_game'];
            return [
                "slug" => $game->slug,
                "title" => $game->title,
                "description" => $game->description,
                "thumbnail" => $thumbnail,
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
                "popular" => $game['popular'],
            ];

        });

        return response([
             "page"=> $games->currentPage(),
             "size"=> $games->perPage(),
             "totalElements" => count(Game::has('versions')->get()),
             "content"=> $games_data
        ], 200);
    }


//  todo РЕАЛИЗОВАН!
//  todo тестировал!
//  todo Заменен на games
    public function gamesPost(Request $request) {
//      todo Создает игру. Версия игры загружается отдельно.

//      Параметры запроса:
//      title - required | min-length 3 | max-length 60
//      description - required | min-length 0 | max-length 200

//      Если сгенерированный slug не уникален, игра не может быть создана, а вместо этого возвращается ошибка 404.

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
    }


//  todo РЕАЛИЗОВАН!
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

                $thumbnail = $last_version['thumbnail'] == 'thumbnail.png' ? null : $last_version['path_to_game'];
                return [
                    "slug" => $game->slug,
                    "title" => $game->title,
                    "description" => $game->description,
                    "thumbnail" => $thumbnail,
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
                    "popular" => $game['popular'],
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


//  todo РЕАЛИЗОВАН!
//  todo тестировал!
//  todo заменен на game
    public function gameGet(Request $request, $slug) {
//      todo Возвращает детали игры.
//      Если нет миниатюры(thumbnail), поле миниатюры равно null.
//      Поле «gamePath» указывает на URL-пути, который могут использовать браузеры для визуализации игры. Это означает, что это достижимый путь для загрузки.
        // try {
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

        // } catch (\Throwable $e) {
            // return response([
            //     "status"=> "invalid",
            //     "slug"=> "Game not found",
            //     "error"=>$e
            // ], 404);
        // }
    }

//  todo РЕАЛИЗОВАН!
//  todo заменен на game
    public function gamePut(Request $request, $slug) {
//      todo обновление заголовка и описания игры.
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
    }

//  todo РЕАЛИЗОВАН!
//  todo заменен на game
    public function gameDelete(Request $request, $slug) {
//      todo Удаление игры
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

//  todo Не проверял!
    public function gameScoreGet(Request $request, $slug) {
//      todo Возвращает самые высокие баллы каждого игрока, который играл в любую версию игры, отсортированную по баллам (по убыванию)
        $game = Game::firstWhere(['slug'=>$slug]);
        if (!$game) return response([
            "status" => "Error",
            "message" => 'Game not found'
        ], 403); 

        $versions = $game->game_version_with_scores;
        $scores = collect($versions)->flatMap(function ($version) {
            return collect($version->version_scores)->map(function ($scores) use ($version) {
                return [
                    'username'=> $this->user->username,
                    'score'=> $scores,
                    'timestamp'=> $version->created_at,
                ];
            });
        });

        return $scores;
    }

//  todo РЕАЛИЗОВАН!
    public function gameScorePost(Request $request, $slug) {
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
    }


    public function gameScore(Request $request, $slug) {
        if ($request->method() == 'GET') {
            $game = Game::firstWhere(['slug'=>$slug]);
            if (!$game) return response([
                "status" => "Error",
                "message" => 'Game not found'
            ], 403); 
    
            $versions = $game->game_version_with_scores;
            $scores = collect($versions)->flatMap(function ($version) {
                return collect($version->version_scores)->map(function ($scores) use ($version) {
                    return [
                        'username'=> $this->user->username,
                        'score'=> $scores,
                        'timestamp'=> $version->created_at,
                    ];
                });
            });
    
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
    public function game_upload_v(Request $request, $slug) {

        $request->validate([
            'zipfile' => 'required|file',
        ]);
        return "Ok";
        $file = $request->file('zipfile')->store("public/games/$slug");
//        $file = $request->file('zipfile');


        $zip = new ZipArchive();
        if (!$zip->open($file, ZIPARCHIVE::CREATE) !== TRUE) {
            return response('ZIP file cannot be opened', 400);
        }

        $storagePath = 'games/';
        $absolutePath = Storage::disk('local')->path($storagePath);
        if (!Storage::disk('local')->exists($storagePath)) {
            try {
                if (!Storage::makeDirectory($storagePath, 0755, true)) {
                    return response('Storage path ('.$storagePath.') cannot be created', 500);
                }
            } catch (\Exception $e) {
                return response('Storage path ('.$storagePath.') cannot be created', 500);
            }
        }
        chmod($absolutePath, 0777);
        $zip->extractTo($absolutePath);
        $zip->close();

        return response('Upload successful', 201);

        return "OK";

//        try {
//            return response([
//                "status" => "success",
//            ], 200);
//        } catch (Exception $exception) {
//            return response([
//                "status"=> "error",
//            ], 404);
//        }
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
        if (!$author) return response([
            "status" => "Error",
            "message" => 'Author not found'
        ], 403); 
        
        $authoredGames = Game::where(['author_id' => $author->id])->get();
        
        if ($author->id != $this->user->id) {
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
            "user"=> $this->user->username,
            "author"=> $author->username,
            "registeredTimestamp" => $author->created_at,
            "authoredGames" => $authoredGames,
            "highscores" => $highscores
        ], 200);
    }

}
