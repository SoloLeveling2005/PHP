<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Games extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $games = [
            [
                'title'=> 'Demo Game 1',
                'slug'=>'demo-game-1',
                'description'=> 'This is demo game 1',
                'author_id' => (User::where('username', 'dev1')->first())->id
            ],
            [
                'title'=> 'Demo Game 1',
                'slug'=>'demo-game-2',
                'description'=> 'This is demo game 2',
                'author'=> 'dev2'
//                'author'=> (User::where('username', 'dev2')->first())->id
            ],
        ];
        foreach ($games as $game) {
            \DB::table('games')->insert($game);
        }
    }
}
