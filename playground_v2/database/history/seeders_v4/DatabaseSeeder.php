<?php

namespace Database\Seeders;

use App\Models\GameVersion;
use App\Models\User;
use Exception;
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
        try{
            DB::beginTransaction();

            foreach (range(1,4) as $i) {
                DB::table('admins')->insert([
                    'username'=>"admin$i",
                    'password'=>Hash::make("hellouniverse$i!"),
                    'created_at'=>now(),
                    'updated_at'=>now()
                ]);
            }

            foreach (range(1,4) as $i) {
                DB::table('users')->insert([
                    'username'=>"dev$i",
                    'password'=>Hash::make("hellobyte$i!"),
                    'created_at'=>now(),
                    'updated_at'=>now()
                ]);
            }
            foreach (range(1,4) as $i) {
                DB::table('games')->insert([
                    'title'=>"Demo game $i",
                    'description'=>"This is demo game $i",
                    'thumbnail'=>now(),
                    'slug'=>Str::slug("demo-game-$i"),
                    'author_id'=>DB::table('users')->inRandomOrder()->first()->id,
                    'created_at'=>now(),
                    'updated_at'=>now()
                ]);
            }
            foreach (range(1,4) as $i_game) {
                foreach (range(1,random_int(3,6)) as $i_version) {
                    DB::table('game_versions')->insert([
                        'game_id'=>DB::table('games')->where(['title'=>"Demo game $i_game"])->first()->id,
                        'path_to_file'=>"demo-game-$i_game-v$i_version/",
                        'created_at'=>now(),
                        'updated_at'=>now()
                    ]);
                }
            }

            foreach (range(1,4) as $i) {
                DB::table('users')->insert([
                    'username'=>"player$i",
                    'password'=>Hash::make("helloworld$i!"),
                    'created_at'=>now(),
                    'updated_at'=>now()
                ]);
            }

            foreach (range(1,4) as $i_user) {
                foreach (range(1,random_int(4,7)) as $i_score) {
                    DB::table('scores')->insert([
                        'user_id'=>DB::table('users')->inRandomOrder()->first()->id,
                        'game_version_id'=>DB::table('game_versions')->inRandomOrder()->first()->id,
                        'score'=>random_int(50, 300),
                        'created_at'=>now(),
                        'updated_at'=>now()
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
            
        } catch(Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
    }
}
