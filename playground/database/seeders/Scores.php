<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\GameVersion;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Scores extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'user_id'=>(User::where('username', 'player1')->first())->id,
                'game_version_id'=>(GameVersion::where('game_id', ((Game::where('title', 'Demo Game 1')->first())->id))->first())->id,
                'score'=>10.0
            ],
            [
                'user_id'=>(User::where('username', 'player1')->first())->id,
                'game_version_id'=>(GameVersion::where('game_id', ((Game::where('title', 'Demo Game 1')->first())->id))->first())->id,
                'score'=>15.0
            ],
            [
                'user_id'=>(User::where('username', 'player1')->first())->id,
                'game_version_id'=>(GameVersion::where('game_id', ((Game::where('title', 'Demo Game 1')->first())->id))->first())->id,
                'score'=>12.0
            ],
            [
                'user_id'=>(User::where('username', 'player2')->first())->id,
                'game_version_id'=>(GameVersion::where('game_id', ((Game::where('title', 'Demo Game 1')->first())->id))->first())->id,
                'score'=>20.0
            ],
            [
                'user_id'=>(User::where('username', 'player2')->first())->id,
                'game_version_id'=>(GameVersion::where('game_id', ((Game::where('title', 'Demo Game 2')->first())->id))->first())->id,
                'score'=>30.0
            ],
            [
                'user_id'=>(User::where('username', 'dev1')->first())->id,
                'game_version_id'=>(GameVersion::where('game_id', ((Game::where('title', 'Demo Game 1')->first())->id))->first())->id,
                'score'=>1000.0
            ],
            [
                'user_id'=>(User::where('username', 'dev1')->first())->id,
                'game_version_id'=>(GameVersion::where('game_id', ((Game::where('title', 'Demo Game 1')->first())->id))->first())->id,
                'score'=>-300.0
            ],
            [
                'user_id'=>(User::where('username', 'dev2')->first())->id,
                'game_version_id'=>(GameVersion::where('game_id', ((Game::where('title', 'Demo Game 1')->first())->id))->first())->id,
                'score'=>5.0
            ],
            [
                'user_id'=>(User::where('username', 'dev2')->first())->id,
                'game_version_id'=>(GameVersion::where('game_id', ((Game::where('title', 'Demo Game 2')->first())->id))->first())->id,
                'score'=>200.0
            ],
        ];
        foreach ($datas as $data) {
            DB::table('scores')->insert($data);
        }
    }
}
