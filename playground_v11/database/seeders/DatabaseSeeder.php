<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Game;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach (range(1,4) as $index) {
            DB::table('admins')->insert([
                'username'=>"admin$index",
                'password'=>Hash::make("hellouniverse$index!"),
                 'created_at'=>now()
            ]);
        }

        foreach (range(1,4) as $index) {
            DB::table('users')->insert([
                'username'=>"dev$index",
                'password'=>Hash::make("hellobyte$index!"),
                 'created_at'=>now()
            ]);
        }

        foreach (range(1,4) as $index) {
            DB::table('games')->insert([
                'title'=>"Demo Game $index",
                'description'=>"This is demo game 1",
                'slug'=>Str::slug("Demo Game $index"),
                'user_id'=>Db::table('users')->inRandomOrder()->first()->id,
                'created_at'=>now()
            ]);
        }

        foreach (range(1,14) as $index) {
            $game = Game::with('versions')->inRandomOrder()->first();
            $game_versions_c = count($game->versions);
            DB::table('game_versions')->insert([
                'game_id'=>$game->id,
                'version'=>$game_versions_c+1,
                'created_at'=>now()
            ]);
        }
        foreach (range(1,4) as $index) {
            DB::table('users')->insert([
                'username'=>"player$index",
                'password'=>Hash::make("helloworld$index!"),
                'created_at'=>now()
            ]);
        }
        foreach (range(1,40) as $index) {
            DB::table('scores')->insert([
                'game_version_id'=>DB::table('game_versions')->inRandomOrder()->first()->id,
                'user_id'=>DB::table('users')->inRandomOrder()->first()->id,
                'score'=>random_int(100 ,300),
                'created_at'=>now()
            ]);
        }

        DB::table('reasons')->insert([
            'title'=>"You have been blocked by an administrator"
        ]);

        DB::table('reasons')->insert([
            'title'=>"You have been blocked for spamming"
        ]);

        DB::table('reasons')->insert([
            'title'=>"You have been blocked for cheating"
        ]);

        DB::table('banned_users')->insert([
            'user_id'=>DB::table('users')->inRandomOrder()->first()->id,
            'reason_id'=>DB::table('reasons')->inRandomOrder()->first()->id,
            'created_at'=>now()
        ]);


    }
}
