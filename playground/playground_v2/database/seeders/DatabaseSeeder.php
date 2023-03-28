<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Game;
use App\Models\GameVersion;
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
            $new_admins = true;
            $new_users = true;
            $new_developers = true;
            $new_games = true;
            $new_game_versions = true;
            $new_scores = true;
            $new_reasons = true;

            /**
             * create new developers
             */
            if ($new_developers) {
                echo "create new developers \n";
                foreach (range(1, 7) as $index) {
                    DB::table('users')->insert([
                        'username' => "dev_$index",
                        'password' => Hash::make("dev_password_$index"),
                        'created_at' => now()
                    ]);
                    sleep(0.001);
                }
            }

            /**
             * create new games
             */
            if ($new_games) {
                echo "create new games \n";
                foreach (range(1, 15) as $index) {
                    DB::table('games')->insert([
                        'title' => "Demo game $index",
                        'description' => "This is demo game $index",
                        'thumbnail' => "thumbnail.png",
                        'slug' => "demo-game-$index",
                        'author_id' => User::all()->random(1)->first()->id,
                        'created_at' => now()
                    ]);
                    sleep(0.001);
                }
            }

            /**
             * create new simple users
             */
            if ($new_users) {
                echo "create new simple users \n";
                foreach (range(1, 7) as $index) {
                    DB::table('users')->insert([
                        'username' => "user_$index",
                        'password' => Hash::make("user_password_$index"),
                        'created_at' => now()
                    ]);
                    sleep(0.001);
                }
            }

            /**
             * create new admins
             */
            if ($new_admins) {
                echo "create new admins \n";
                foreach (range(1, 4) as $index) {
                    DB::table('admins')->insert([
                        'username' => "admin_$index",
                        'password' => Hash::make("admin_password_$index"),
                        'created_at' => now()
                    ]);
                    sleep(0.001);
                }
            }

            /**
             * create new game versions
             */
            if ($new_game_versions) {
                echo "create new game versions \n";
                foreach (range(1, 15) as $index) {
                    $game = Game::all()->random(1)->first();
                    DB::table('game_versions')->insert([
                        'game_id' => $game->id,
                        'path_to_game' => ($game->slug . "/" . count(Game::all()->where(['id' => $game->id]))),
                        'created_at' => now()
                    ]);
                    sleep(0.001);
                }
            }

            /**
             * create new scores
             */
            if ($new_scores) {
                echo "create new scores \n";
                foreach (range(1, 70) as $index) {
                    DB::table('scores')->insert([
                        'user_id' => User::all()->random(1)->first()->id,
                        'game_version_id' => GameVersion::all()->random(1)->first()->id,
                        'score' => random_int(20, 300),
                        'created_at' => now()
                    ]);
                    sleep(0.001);
                }
            }


            /**
             * create new reason
             */
            if ($new_reasons) {
                echo "create new reason \n";
                DB::table('reasons')->insert([
                    [
                        'reason' => 'You have been blocked by an administrator'
                    ], [
                        'reason' => 'You have been blocked for spamming'
                    ], [
                        'reason' => 'You have been blocked for cheating'
                    ]
                ]);
            }


        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
    }
}
