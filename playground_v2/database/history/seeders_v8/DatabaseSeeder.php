<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        //  create admins
        foreach (range(1,4) as $user_id) {
            DB::table('admins')->insert([
                'username'=>"admin$user_id",
                'password'=>Hash::make("hellouniverse$user_id!"),
                'created_at'=>now()
            ]);
        }

        //  create developers
        foreach (range(1,4) as $user_id) {
            DB::table('users')->insert([
                'username'=>"dev$user_id",
                'password'=>Hash::make("hellobyte$user_id!"),
                'created_at'=>now()
            ]);
        }

        // create games
        foreach (range(1,4) as $game_id) {
            DB::table('games')->insert([
                'title'=>"Demo Game $game_id",
                'slug'=>Str::slug("demo-game-$game_id"),
                'description'=>"This is demo game $game_id",
                'author_id'=>DB::table('users')->inRandomOrder()->first()->id,
                'created_at'=>now()
            ]);
        }
        // create game_versions
        foreach (range(1,4) as $user_id) {
            foreach (range(1, random_int(2,6)) as $game_version_id) {
                DB::table('game_versions')->insert([
                    'game_id'=>DB::table('games')->inRandomOrder()->first()->id,
                    'created_at'=>now()
                ]);
            }
        }

        // create users
        foreach (range(1,4) as $user_id) {
            DB::table('users')->insert([
                'username'=>"player$user_id",
                'password'=>Hash::make("helloworld$user_id!"),
                'created_at'=>now()
            ]);
        }

        // create scores
        foreach (range(1, random_int(40,60)) as $game_version_id) {
            DB::table('scores')->insert([
                'game_version_id'=>DB::table('game_versions')->inRandomOrder()->first()->id,
                'user_id'=>Db::table('users')->inRandomOrder()->first()->id,
                'score'=>random_int(100, 300),
                'created_at'=>now()
            ]);
        }

        // create reasons
        DB::table('reasons')->insert([
            'title'=>"You have been blocked by an administrator",
        ]);
        DB::table('reasons')->insert([
            'title'=>"You have been blocked for spamming",
        ]);
        DB::table('reasons')->insert([
            'title'=>"You have been blocked for cheating",
        ]);
    }
}
