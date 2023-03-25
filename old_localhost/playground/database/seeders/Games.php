<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Games extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'title'=>'Demo Game 1',
                'slug'=>'demo-game-1',
                'description'=>'This is demo game 1',
                'author_id'=>(User::where('username', 'dev1')->first())->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title'=>'Demo Game 2',
                'slug'=>'demo-game-2',
                'description'=>'This is demo game 2',
                'author_id'=>(User::where('username', 'dev2')->first())->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        foreach ($datas as $data) {
            DB::table('games')->insert($data);
        }
    }
}
