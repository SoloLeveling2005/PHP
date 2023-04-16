<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


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

            // create admins
            foreach(range(1,4) as $admin_id) {
                DB::table('admins')->insert([
                    'username'=>"admin$admin_id",
                    "password"=>"hellouniverse$admin_id!",
                    "created_at"=>now()
                ]);
            }

            // create developers
            foreach(range(1,4) as $user_id) {
                DB::table('users')->insert([
                    'username'=>"dev$user_id",
                    "password"=>"hellobyte$user_id!",
                    "created_at"=>now()
                ]);
            }
            // create games
            foreach(range(1,4) as $game_id) {
                DB::table('games')->insert([
                    'title'=>"Demo Game $game_id",
                    "description"=>"This is demo game $game_id",
                    "slug"=>Str::slug("demo-game-$game_id"),
                    "author_id"=>DB::table('users')->inRandomOrder()->first()->id,
                    "created_at"=>now()
                ]);
            }

            // create game versions
            foreach(range(1,4) as $game_id) {
                $game = DB::table('games')->where(['title'=>"Demo Game $game_id"])->first();
                foreach(range(1,random_int(2,4)) as $game_version_id) {
                    DB::table('game_versions')->insert([
                        'game_id'=>$game->id,
                        "created_at"=>now()
                    ]);
                }
            }

            // create players
            foreach(range(1,4) as $user_id) {
                DB::table('users')->insert([
                    'username'=>"player$user_id",
                    "password"=>"helloworld$user_id!",
                    "created_at"=>now()
                ]);
            }

            // create scores
            foreach(range(1,8) as $user_id) {
                foreach(range(1,random_int(3,6)) as $user_id) {
                    DB::table('scores')->insert([
                        'user_id'=>DB::table('users')->inRandomOrder()->first()->id,
                        "game_version_id"=>DB::table('game_versions')->inRandomOrder()->first()->id,
                        "score"=>random_int(100, 300),
                        "created_at"=>now()
                    ]);
                }
            }

            DB::table('reasons')->insert([
                'title'=>'You have been blocked by an administrator'
            ]);
            DB::table('reasons')->insert([
                'title'=>'You have been blocked for spamming'
            ]);
            DB::table('reasons')->insert([
                'title'=>'You have been blocked for cheating'
            ]);


        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();
    }
}
