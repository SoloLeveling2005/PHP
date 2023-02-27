<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use \App\Models\Game_Versions;
class Scores extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $scores = [
            [
//                'user' => 'player1',
                'user' => (User::where('username', 'player1')->first())->id,
                'game versions' => "first version of 'Demo Game 1'",
                'score' => 10.0
            ],
            [
//                'user' => 'player1',
                'user' => (User::where('username', 'player1')->first())->id,
                'game versions' => "first version of 'Demo Game 1'",
                'score' => 15.0
            ],
            [
//                'user' => 'player1',
                'user' => (User::where('username', 'player1')->first())->id,
                'game versions' => "latest version of 'Demo Game 1'",
                'score' => 12.0
            ],
            [
//                'user' => 'player2',
                'user' => (User::where('username', 'player2')->first())->id,
                'game versions' => "latest version of 'Demo Game 1'",
                'score' => 20.0
            ],
            [
//                'user' => 'player2',
                'user' => (User::where('username', 'player2')->first())->id,
                'game versions' => "latest version of 'Demo Game 2'",
                'score' => 30.0
            ],
            [
//                'user' => 'dev1',
                'user' => (User::where('username', 'dev1')->first())->id,
                'game versions' => "latest version of 'Demo Game 1'",
                'score' => 1000.0
            ],
            [
//                'user' => 'dev1',
                'user' => (User::where('username', 'dev1')->first())->id,
                'game versions' => "latest version of 'Demo Game 1'",
                'score' => -300.0
            ],
            [
//                'user' => 'dev2',
                'user' => (User::where('username', 'dev2')->first())->id,
                'game versions' => "latest version of 'Demo Game 2'",
                'score' => 5.0
            ],
            [
//                'user' => 'dev2',
                'user' => (User::where('username', 'dev2')->first())->id,
                'game versions' => "latest version of 'Demo Game 1'",
                'score' => 200.0
            ],



        ];
        foreach ($scores as $score) {
            \DB::table('scores')->insert($score);
        }
    }
}
