<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BannedUser;
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
        foreach (range(1,4) as $admin_id) {
            DB::table('admins')->insert([
                'username'=>"admin$admin_id",
                'password'=>Hash::make("hellouniverse$admin_id!"),
                'created_at'=>now()
            ]);
        }


        foreach (range(1,4) as $developer_id) {
            DB::table('users')->insert([
                'username'=>"dev$developer_id",
                'password'=>Hash::make("hellobyte$developer_id!"),
                'created_at'=>now()
            ]);
        }

        foreach (range(1,4) as $game_id) {
            DB::table('games')->insert([
                'title'=>"Demo Game $game_id",
                'description'=>"This is demo game $game_id",
                'slug'=>Str::slug("Demo Game $game_id"),
                'author_id'=>DB::table('users')->inRandomOrder()->first()->id,
                'created_at'=>now()
            ]);
        }


        foreach (range(1,12) as $game_v_id) {
            $game_id = DB::table('games')->inRandomOrder()->first()->id;
            $game_versions = DB::table('game_versions')->where(['game_id'=>$game_id])->get();
            $game_v = count($game_versions);
            DB::table('game_versions')->insert([
                'game_id'=>$game_id,
                'version'=>$game_v ? $game_v : 1,
                'created_at'=>now()
            ]);
        }

        foreach (range(1,4) as $player_id) {
            DB::table('users')->insert([
                'username'=>"player$player_id",
                'password'=>Hash::make("helloworld$player_id!"),
                'created_at'=>now()
            ]);
        }



        foreach (range(1,40) as $score_id) {
            DB::table('scores')->insert([
                'game_version_id'=>DB::table('games')->inRandomOrder()->first()->id,
                'user_id'=>DB::table('users')->inRandomOrder()->first()->id,
                'score'=>random_int(100, 300),
                'created_at'=>now()
            ]);
        }


        DB::table('reasons')->insert([
            'title'=>"You have been blocked by an administrator",
        ]);
        DB::table('reasons')->insert([
            'title'=>"You have been blocked for spamming",
        ]);
        DB::table('reasons')->insert([
            'title'=>"You have been blocked for cheating",
        ]);


        BannedUser::create([
            'user_id'=>DB::table('users')->inRandomOrder()->first()->id,
            'reason_id'=>DB::table('reasons')->inRandomOrder()->first()->id,
            'created_at'=>now()
        ]);

    }
}
