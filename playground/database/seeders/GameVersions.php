<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameVersions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'game_id'=>(Game::where('title', 'Demo Game 1')->first())->id,
                'file_name'=>'demo-game-1-v1'
            ],
            [
                'game_id'=>(Game::where('title', 'Demo Game 1')->first())->id,
                'file_name'=>'demo-game-1-v2'
            ],
            [
                'game_id'=>(Game::where('title', 'Demo Game 2')->first())->id,
                'file_name'=>'demo-game-2-v1'
            ],
        ];
        foreach ($datas as $data) {
            DB::table('game_versions')->insert($data);
        }
    }
}
