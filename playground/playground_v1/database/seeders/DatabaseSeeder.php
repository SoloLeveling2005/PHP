<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Game;
use App\Models\GameVersion;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Nette\Schema\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
            $users = [
                [
                    'username'=>'player1',
                    'password'=>Hash::make('helloworld1!'),
                    'created_at'=>now()
                ],[
                    'username'=>'player2',
                    'password'=>Hash::make('helloworld2!'),
                    'created_at'=>now()
                ],[
                    'username'=>'dev1',
                    'password'=>Hash::make('hellobyte1!'),
                    'created_at'=>now()
                ],[
                    'username'=>'dev2',
                    'password'=>Hash::make('hellobyte2!'),
                    'created_at'=>now()
                ],
            ];
            $admins = [
                [
                    'username'=>'admin1',
                    'password'=>Hash::make('hellouniverse1!'),
                    'created_at'=>now()
                ],[
                    'username'=>'admin2',
                    'password'=>Hash::make('hellouniverse2!'),
                    'created_at'=>now()
                ]
            ];
            foreach ($users as $user) {
                DB::table('users')->insert([
                    'username'=>$user['username'],
                    'password'=>$user['password'],
                    'created_at'=>now()
                ]);
            }
            foreach ($admins as $admin) {
                DB::table('admins')->insert([
                    'username'=>$admin['username'],
                    'password'=>$admin['password'],
                    'created_at'=>now()
                ]);
            }
            $games = [
                [
                    'title'=>'Demo Game 1',
                    'img_url'=>'logo-game-1',
                    'slug'=>'demo-game-1',
                    'description'=>'This is demo game 1',
                    'author_id'=>(User::where('username','dev1'))->first()->id
                ],[
                    'title'=>'Demo Game 2',
                    'img_url'=>'logo-game-2',
                    'slug'=>'demo-game-2',
                    'description'=>'This is demo game 2',
                    'author_id'=>(User::where('username','dev2'))->first()->id
                ],
            ];
            foreach ($games as $game) {
                DB::table('games')->insert([
                    'title'=>$game['title'],
                    'slug'=>$game['slug'],
                    'img_url'=>$game['img_url'],
                    'description'=>$game['description'],
                    'author_id'=>$game['author_id'],
                    'created_at'=>now()
                ]);
            }
            $game_versions = [
                [
                    'game_id'=>(Game::where('title','Demo Game 1'))->first()->id,
                    'path_to_file'=>'demo-game-1-v1'
                ],[
                    'game_id'=>(Game::where('title','Demo Game 1'))->first()->id,
                    'path_to_file'=>'demo-game-1-v2',
                    'created_at'=>now()
                ],[
                    'game_id'=>(Game::where('title','Demo Game 2'))->first()->id,
                    'path_to_file'=>'demo-game-2-v1',
                    'created_at'=>now()
                ]
            ];
            foreach ($game_versions as $game_version) {
                DB::table('game_versions')->insert([
                    'game_id'=>$game_version['game_id'],
                    'path_to_file'=>$game_version['path_to_file'],
                    'created_at'=>now()
                ]);
            }
            $scores = [
                [
                    'user_id'=>User::where('username','player1')->first()->id,
                    'game_versions_id'=>GameVersion::all()->where('game_id',(Game::where('title','Demo Game 1'))->first()->id)->sortDesc()->first()->id,
                    'score'=>10.0
                ],[
                    'user_id'=>User::where('username','player1')->first()->id,
                    'game_versions_id'=>GameVersion::all()->where('game_id',(Game::where('title','Demo Game 1'))->first()->id)->sortDesc()->first()->id,
                    'score'=>15.0
                ],[
                    'user_id'=>User::where('username','player1')->first()->id,
                    'game_versions_id'=>GameVersion::all()->where('game_id',(Game::where('title','Demo Game 1'))->first()->id)->sortDesc()->last()->id,
                    'score'=>12.0
                ],[
                    'user_id'=>User::where('username','player2')->first()->id,
                    'game_versions_id'=>GameVersion::all()->where('game_id',(Game::where('title','Demo Game 1'))->first()->id)->sortDesc()->last()->id,
                    'score'=>20.0
                ],[
                    'user_id'=>User::where('username','player2')->first()->id,
                    'game_versions_id'=>GameVersion::all()->where('game_id',(Game::where('title','Demo Game 2'))->first()->id)->sortDesc()->last()->id,
                    'score'=>30.0
                ],[
                    'user_id'=>User::where('username','dev1')->first()->id,
                    'game_versions_id'=>GameVersion::all()->where('game_id',(Game::where('title','Demo Game 1'))->first()->id)->sortDesc()->last()->id,
                    'score'=>1000.0
                ],[
                    'user_id'=>User::where('username','dev1')->first()->id,
                    'game_versions_id'=>GameVersion::all()->where('game_id',(Game::where('title','Demo Game 1'))->first()->id)->sortDesc()->last()->id,
                    'score'=>-300.0
                ],[
                    'user_id'=>User::where('username','dev2')->first()->id,
                    'game_versions_id'=>GameVersion::all()->where('game_id',(Game::where('title','Demo Game 1'))->first()->id)->sortDesc()->last()->id,
                    'score'=>5.0
                ],[
                    'user_id'=>User::where('username','dev2')->first()->id,
                    'game_versions_id'=>GameVersion::all()->where('game_id',(Game::where('title','Demo Game 2'))->first()->id)->sortDesc()->last()->id,
                    'score'=>200.0
                ],
            ];


            foreach ($scores as $score) {
                DB::table('scores')->insert([
                    'user_id'=>$score['user_id'],
                    'game_versions_id'=>$score['game_versions_id'],
                    'score'=>$score['score'],
                    'created_at'=>now()
                ]);
            }
        } catch (Exception $e) {

            DB::rollBack();
            throw $e;
        }
        DB::commit();

    }
}
