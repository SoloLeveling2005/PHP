<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Games;
class Game_Versions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $games = [
            [
                'game'=> (Games::where('title', 'Demo Game 1')->first())->id,
                'files'=>'demo-game-1-v1'
            ],
            [
                'game'=> (Games::where('title', 'Demo Game 1')->first())->id,
                'files'=>'demo-game-1-v2'
            ],
            [
                'game'=> (Games::where('title', 'Demo Game 2')->first())->id,
                'files'=>'demo-game-2-v1'
            ],
        ];
        foreach ($games as $game) {
            \DB::table('game versions')->insert($game);
        }
    }
}
