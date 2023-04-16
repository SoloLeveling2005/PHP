<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameVersion;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class ApiController extends Controller
{
    public function games (Request $request) {
        if ($request->method()=="POST") {
            $valid_data = $request->validate([
                'title'=>['required', 'min:3', 'max:60'],
                'description'=>['required', 'min:0', 'max:200'],
            ]);
            $slug = Str::slug($valid_data['title']);
            if (count(Game::where(['slug'=>$slug])->get())>0) return response([
                'status'=>'invalid',
                'slug'=>'Game title already exists'
            ], 401);
            Storage::disk('public')->makeDirectory("games/v1/$slug/");
            Game::create([
                'title'=>$valid_data['title'],
                'description'=>$valid_data['description'],
                'slug'=>$slug,
                'user_id'=>$request->user()->id,
                'created_at'=>now()
            ]);
            return response([
                "status"=> "success",
                "slug"=> $slug
            ]);
        } elseif ($request->method()=="GET") {

        }
    }

    public function game (Request $request, $slug) {
        if ($request->method()=="GET") {
            $game = Game::withoutTrashed()->with(['scores', 'versions', 'author'])->where(['slug'=>$slug])->first();
            if (!$game) return abort(404, 'Game not found');
            $scoreCount = count($game->scores);
            $last_v = $game->versions->sortByDesc('id')->first();
            $gamePath = "/games/$slug/v$last_v->version/";
            return response([
                'slug'=>$game->slug,
                'title'=>$game->title,
                'description'=>$game->description,
                'thumbnail'=>$last_v->thumbnail ? $gamePath."thumbnail.png" : null,
                'uploadTimestamp'=>$game->created_at,
                'author'=>$game->author->username,
                'scoreCount'=>$scoreCount,
                'gamePath'=>$gamePath
            ]);

        } elseif ($request->method()=="PUT") {
            $game = Game::where(['slug'=>$slug])->first();
            if ($game->author->id != $request->user()->id) return response([
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

        } elseif ($request->method()=="DELETE") {
            $game = Game::where(['slug'=>$slug])->first();
            if ($game->author->id != $request->user()->id) return response([
                'status'=>'forbidden',
                'message'=>'You are not the game author'
            ], 403);
            $game->delete();
            return response([], 204);
        }
    }

    public function users (Request $request, $username) {
        if ($request->method()=="GET") {

        }
    }

    public function scores (Request $request, $slug) {
        if ($request->method()=="POST") {
            $game = Game::where(['slug'=>$slug])->first();
            $valid_data = $request->validate([
                'score'=>['required']
            ]);
            $last_v = $game->versions->sortByDesc('id')->first();
            Score::create([
                'game_version_id'=>$last_v->id,
                'user_id'=>$request->user()->id,
                'score'=>$valid_data['score']
            ]);

            return response([
                'status'=>'success'
            ], 201);

        } elseif ($request->method()=="GET") {

        }
    }


    public function upload (Request $request, $slug) {
        if ($request->method()=="POST") {
            $valid_data = $request->validate([
                'zipfile'=>['required', 'file', 'mimes:zip', 'max:10000'],
                'token'=>['required']
            ]);
            $game = Game::where(['slug'=>$slug])->first();
            $last_v = $game->versions->sortByDesc('id')->first();
            if ($game->author->id != $request->user()->id) return response([
                'status'=>'forbidden',
                'message'=>'You are not the game author'
            ], 403);
            isset($last_v->version) ?  $last_v = $last_v->version + 1 : $last_v = 1;
            $zip = new ZipArchive();
//            $last_v-=1;
            if ($zip->open($valid_data['zipfile'])) {
                $zip->extractTo(storage_path("app/public/games/v1/$game->slug/v$last_v/"));
                $p = "games/v1/$game->slug/v$last_v/thumbnail.png";
                $zip->close();
                $thumbnail = Storage::disk('public')->exists($p);
                GameVersion::create([
                    'game_id'=>$game->id,
                    'version'=>$last_v,
                    'thumbnail'=> (bool)$thumbnail,
                    'created_at'=>now()
                ]);
                return response([], 200);
            }
            $zip->close();
            return response([
                'status'=>'invalid',
                'message'=>"ZIP file extraction fails"
            ], 400);
        }
    }


    public function game_file (Request $request, $slug, $version) {
        if ($request->method()=="GET") {
            $game = Game::where(['slug'=>$slug])->first();
            return Storage::disk('public')->response("games/v1/$game->slug/$version/index.html");
        }
    }

}
