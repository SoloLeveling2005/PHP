<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Game;
use App\Models\GameVersion;
use App\Models\Score;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            
            foreach(range(1,3) as $i){
                DB::table('admins')->insert([
                    'username'=>"admin$i",
                    'password'=>Hash::make("hellouniverse$i!"),
                    'created_at'=>now()
                ]);
            }

            foreach(range(1,3) as $i){
                DB::table('users')->insert([
                    'username'=>"dev$i",
                    'password'=>Hash::make("hellobyte$i!"),
                    'created_at'=>now()
                ]);
            }


            foreach(range(1,7) as $i){
                DB::table('games')->insert([
                    'title'=>"Demo Game $i",
                    'slug'=>"demo-game-$i",
                    'description'=>"This is demo game $i",
                    "last_v"=>1,
                    'author_id'=>DB::table('users')->inRandomOrder()->first()->id,
                    'created_at'=>now()
                ]);
            }
            echo "create games data";
            foreach(range(1,7) as $i){
                $game_v = DB::table('games')->inRandomOrder()->first();
                foreach (range(1, random_int(3,7)) as $ii) {
                    DB::table('game_versions')->insert([
                        'game_id'=>$game_v->id,
                        'files'=>"demo-game-$i/",
                        'created_at'=>now()
                    ]);
                    DB::table('games')->where(['id'=>$game_v->id])->update(['last_v'=>$ii]);
                }
                
            }
            echo "create game_versions data";
            foreach(range(1,7) as $i){
                DB::table('users')->insert([
                    'username'=>"player$i",
                    'password'=>Hash::make("helloworld$i!"),
                    'created_at'=>now()
                ]);
            }
            echo "create users data";
            foreach(range(1,7) as $i){
                foreach (range(1, random_int(3,7)) as $ii) {
                    DB::table('scores')->insert([
                        'user_id'=>DB::table('users')->inRandomOrder()->first()->id,
                        'game_version_id'=>DB::table('game_versions')->inRandomOrder()->first()->id,
                        'created_at'=>now(),
                        'score'=>random_int(100, 300)
                    ]);
                }
            }
            echo "create scores data";
            DB::table('reasons')->insert([
                'title'=>'You have been blocked by an administrator',
            ]);
            DB::table('reasons')->insert([
                'title'=>'You have been blocked for spamming',
            ]);
            DB::table('reasons')->insert([
                'title'=>'You have been blocked for cheating',
            ]);



        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
    }
}
