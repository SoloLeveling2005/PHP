<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\GameVersion;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class Scores extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
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




            foreach (range(5,20) as $index) {
                $rand_int = random_int(3,7);
                while ($rand_int) {
                    try {
                        DB::table('scores')->insert([
                            'user_id' => User::all()->random()->id,
                            'game_versions_id' => GameVersion::all()->where('game_id', (Game::where('title', "Demo Game $index"))->first()->id)->sortDesc()->last()->id,
                            'score' => $rand_int * random_int(10, 30),
                            'created_at' => now()
                        ]);
                    } catch (\Throwable $e) {
//                        echo $e;
                    }
                    $rand_int-=1;
                }
            }
        } catch (\Throwable) {
            DB::rollBack();
        }
        DB::commit();
    }
}
