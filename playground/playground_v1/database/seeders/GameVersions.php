<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\GameVersion;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameVersions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $game_versions = [
                [
                    'game_id'=>(Game::where('title','Demo Game 1'))->first()->id,
                    'path_to_file'=>'demo-game-1-v1',
                    'created_at'=>now()
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

            foreach (range(5,20) as $index) {
                $path_to_file = "demo-game-$index-v".count(GameVersion::where('game_id',(Game::where('title',"Demo Game $index"))->first()->id)->get());
                DB::table('game_versions')->insert([
                    'game_id'=>(Game::where('title',"Demo Game $index"))->first()->id,
                    'path_to_file'=>$path_to_file,
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
