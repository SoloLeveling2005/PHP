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
use Illuminate\Support\Str;
use Mockery\Exception;
use Illuminate\Support\Facades\File;
use ZipArchive;

class ApiController extends Controller
{
    public $user;
    public function __construct(Request $request) {
        $token = $request->get('token');
        $this->user = User::where('token',$token)->first();
    }

//  todo РЕАЛИЗОВАН!
    public function gamesGet(Request $request) {
//      todo Возвращает список игр с возможностью пагинации.

//      Параметры запроса:
//      page - начианется с 0. По умолчанию 0.
//      size - Количество элементов. Должно быть больше или равно 1. По умолчанию 10.
//      sortBy - Поле для сортировки. Должен быть один из "title", "popular", "uploaddate". По умолчанию title.
//      sortDir - Направление сортировки. Должен быть один из "asc" или "desc". По умолчанию asc.
        $page = $request->get('page', 0)+1;
        $size = $request->get('size', 2); // todo поменять на 10
        $sortBy = $request->get('sortBy', 'popular');
        $sortDir = $request->get('sortDir', 'asc');

//      Описание полей сортировки:
//      title - Заголовок игры.
//      popular - Считает общее количество результатов за игру и сортирует по этому количеству.
//      uploaddate - По временной метке загрузки последней версии игры.

//      В `content`, поля `thumbnail` и `uploadTimestamp` относятся только к последней версии.
//      Поле `scoreCount` это сумма результатов по всем версиям.

//      Описание полей в теле ответа:
//      page - Запрашиваемый номер страницы. Начинается с 0.
//      size - Фактический размер страницы. Должен быть меньше или равен, чем запрошенный размер страницы.
//      totalElements - Общее количество элементов независимо от страницы.
//      content - Массив игр на странице.

//      Можно рассчитать, сколько страниц есть:
//      pageCount = ceil(totalElements / requestedSize)
//      isLastPage = (page + 1) * requestedSize >= totalElements

//      ПРИМЕЧАНИЕ 1: Если есть игра, в которой пока нет игровой версии, она не включена ни в ответ, ни в общее количество.
//      ПРИМЕЧАНИЕ 2: Если нет миниатюры, поле миниатюры равно null.



        $data = collect(Game::has('versions')->get())->map(function ($game) {
            $game_versions = $game->versions->sortBy('id');
            $game_version = $game_versions[count($game_versions) - 1];
//            $thumbnail = "/games/" . $game->slug . "/" . count($game_versions) . "/thumbnail.png";
            $pathToFile = "v1/games/$game->slug/$game_version->id/thumbnail.png";
//            dd($pathToFile);
            if (!Storage::disk('public')->exists($pathToFile)) {
                $thumbnail = "http://127.0.0.1:8000/thumbnail.png";
            } else {
                $thumbnail = "http://127.0.0.1:8000/api/".$pathToFile;
            }

            return [
                "slug" => $game->slug,
                "title" => $game->title,
                "description" => $game->description,
                "thumbnail" => $thumbnail,
                'v' => $game_version->id,
                "uploaddate" => $game->created_at,
                "author" => $game->author->username,
                "scoreCount" => count($game_version->version_scores),
                "popular" => count($game_version->version_scores),
            ];

        });

        $data = $sortDir == "asc" ? $data->sortBy($sortBy) : $data->sortByDesc($sortBy);
//        return $data;
        $games = new LengthAwarePaginator(
            $data->forPage($page, $size),  // items
            $data->count(), // total
            $size, // perPage
            $page // currentPage
        );

        // todo фича
        $games_data = collect($games->all())->map(function ($game) {
            // return $game['slug'];
            return [
                "slug" => $game['slug'],
                "title" => $game['title'],
                "description" => $game['description'],
                "thumbnail" => $game['thumbnail'],
                "v" => $game['v'],
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
    public function gamesPost(Request $request) {
//      todo Создает игру. Версия игры загружается отдельно.

//      Параметры запроса:
//      title - required | min-length 3 | max-length 60
//      description - required | min-length 0 | max-length 200

//      Если сгенерированный slug не уникален, игра не может быть создана, а вместо этого возвращается ошибка 404.

        try {
            DB::beginTransaction();
            $token = $request->get('token');
            $user = User::where('token',$token)->first();

            $title = $request->get('title');
            $description = $request->get('description');

//          todo реализовать $slug
            $slug = Str::slug($title);
//          throw new Exception('Division by zero.');

            DB::table('games')->insert(['title'=>$title, 'description'=>$description, 'slug'=>$slug, 'author_id'=>$user->id, 'created_at'=>now()]);
            Storage::makeDirectory("public/games/$slug");

        } catch (\Throwable $e) {
            DB::rollBack();
            return response([
                "status" => "invalid",
                "slug" => "Game title already exists"
            ], 400);
        }
        DB::commit();
        return response([
            "status" => "success"
        ], 201);
    }

//  todo РЕАЛИЗОВАН!
    public function gameGet(Request $request, $slug) {
//      todo Возвращает детали игры.

//      Если нет миниатюры(thumbnail), поле миниатюры равно null.
//      Поле «gamePath» указывает на URL-пути, который могут использовать браузеры для визуализации игры. Это означает,
//          что это достижимый путь для загрузки.

        try {
//          todo реализовать $title $description $version $uploadTimestamp $author $scoreCount $gamePath
            $game = Game::where(['slug'=>$slug])->first();
            $game_versions = $game->versions->sortBy('id');
            $game_version = $game_versions[count($game_versions)-1];
            $gamePath = "/games/$slug/".count($game_versions);

//            throw new Exception('Division by zero.');
            return response([
                "slug" => $game->slug,
                "title" => $game->title,
                "description" => $game->description,
                "thumbnail" => "/games/$slug/".count($game_versions)."/thumbnail.png",
                "uploadTimestamp" => $game->created_at,
                "author" => $game->author->username,
                "scoreCount" => count($game_version->version_scores),
                "gamePath" => $gamePath,
                'game_versions' => $game->versions->sortBy('id')
            ], 200);

        } catch (\Throwable $e) {
            return response([
                "status"=> "invalid",
                "slug"=> "Game not found",
                "error"=>$e
            ], 404);
        }
    }

//  todo РЕАЛИЗОВАН!
    public function gamePut(Request $request, $slug) {
//      todo обновление заголовка и описания игры.
        try {

            $token = $request->get('token');
            $title = $request->get('title');
            $description = $request->get('description');

            $user = User::where('token',$token)->get();
            $game = Game::where('slug' , $slug)->get();

            if ($user[0]->id != $game[0]->author_id) {
                return response([
                    "status" => "forbidden",
                    "message" => "You are not the game author"
                ], 403);
            }
            Game::where('slug' , $slug)->update(['title' => $title,'description' => $description]);

            return response([
                "status" => "success"
            ], 200);

        } catch (Exception $exception) {
            return response([
                "status" => "error",
                "message" => "error"
            ], 403);
        }
    }

//  todo РЕАЛИЗОВАН!
    public function gameDelete(Request $request, $slug) {
//      todo Удаление игры
        try {
            DB::beginTransaction();

            $token = $request->get('token');


            $user = User::where('token',$token)->get();
            $game = Game::where('slug' , $slug)->get();
//            return $game;
            if ($user[0]->id != $game[0]->author_id) {
                return response([
                    "status" => "forbidden",
                    "message" => "You are not the game author"
                ], 403);
            }

            DB::table('games')->where('slug', $slug)->delete();

        } catch (\Throwable $e) {
            DB::rollBack();
            return response([
                "status" => "Not found",
                "message" => "Игры не существует"
            ], 404);
        }
        DB::commit();
        return response([],200);
    }

//  todo Не проверял!
    public function gameScoreGet(Request $request, $slug) {
        $game = Game::with('versions')->where(['slug'=>$slug])->first();
        $game_versions = $game->versions;
        $scores = collect($game_versions)->map(function ($game_version) {
            return  $game_version->version_scores;
        })->flatten()->sortBy(['score'])->reverse();

        $scores = collect($scores)->map(function ($score) {
            return [
                'username'=> User::where('id', $score->user_id)->first()->username,
                'score'=> $score->score,
                'timestamp'=> $score->created_at,
            ];
        });

        return $scores;
    }

//  todo РЕАЛИЗОВАН!
    public function gameScorePost(Request $request, $slug) {
        $score = $request->get('score');
        $game = Game::where(['slug'=>$slug])->latest('created_at')->first();
        $score = Score::create(['user_id'=>$this->user->id, 'game_versions_id'=>$game->id, 'score'=>$score]);
        return response([
            "status" => "success"
        ], 200);
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
//            dd($pathToFile);
//            if (str_contains($pathToFile, '..')) {
//                return response('Invalid path', 400);
//            }
//            dd(Storage::disk('public')->exists($pathToFile));
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
    public function user(Request $request, $username) {
//      todo Информация о пользователе.
        $token = $request->get('token');
        $user = User::where('token',$token)->first();
        $author = User::where('username', $username)->first();

        $authoredGames = Game::where(['author_id' => $author->id, ])->get();

//        return $user->id;
        if ($author->id != $user->id) {
//            $authoredGames = Game::where(['author_id' => $author->id])->get();
            $authoredGames = collect($authoredGames)->map(function ($game) {
                if (!count($game->versions)) {
                    return;
                } else {
                    return $game;
                }
            });
        }

        $highscores = User::select(['games.slug', 'games.title','games.description','scores.score', 'scores.created_at as timestamp', 'games.description', 'games.slug'])
            ->leftJoin('scores', 'scores.user_id', '=', 'users.id')
            ->leftJoin('game_versions', 'game_versions.id', '=', 'scores.game_versions_id')
            ->leftJoin('games', 'games.id', '=', 'game_versions.game_id')
            ->where('user_id', $author->id)->groupBy('games.id')->selectRaw('MAX(score) as score')->get();

        $highscores = collect($highscores)->map(function ($highscore) {
            return [
                "game" => [
                    "slug" => $highscore->slug,
                    "title" => $highscore->title,
                    "description" => $highscore->description
                ],
                "score" => $highscore->score,
                "timestamp" => $highscore->timestamp
            ];
        });

        return response([
            "user"=> $user->username,
            "author"=> $author->username,
            "registeredTimestamp" => $author->created_at,
            "authoredGames" => [$authoredGames],
            "highscores" => $highscores

        ], 200);
    }

}
