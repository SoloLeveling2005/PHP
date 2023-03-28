<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\User;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Games extends Seeder
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
//            $games = [
////                [
////                    'title'=>'Demo Game 1',
////                    'img_url'=>'logo-game-1',
////                    'slug'=>'demo-game-1',
////                    'description'=>'This is demo game 1',
////                    'author_id'=>(User::where('username','dev1'))->first()->id
////                ],[
////                    'title'=>'Demo Game 2',
////                    'img_url'=>'logo-game-2',
////                    'slug'=>'demo-game-2',
////                    'description'=>'This is demo game 2',
////                    'author_id'=>(User::where('username','dev2'))->first()->id
////                ],
//                [
//                    'title'=>'Demo Game 3',
//                    'img_url'=>'logo-game-3',
//                    'slug'=>'demo-game-3',
//                    'description'=>'This is demo game 3',
//                    'author_id'=>(User::where('username','dev1'))->first()->id
//                ],[
//                    'title'=>'Demo Game 4',
//                    'img_url'=>'logo-game-4',
//                    'slug'=>'demo-game-4',
//                    'description'=>'This is demo game 4',
//                    'author_id'=>(User::where('username','dev2'))->first()->id
//                ],
//            ];
            foreach (range(5,20) as $index) {
                DB::table('games')->insert([
                    'title'=>"Demo Game $index",
                    'slug'=>"logo-game-$index",
                    'img_url'=>"demo-game-$index",
                    'description'=>"This is demo game $index",
                    'author_id'=>($index%2==1) ? (User::where('username','dev2'))->first()->id : (User::where('username','dev1'))->first()->id,
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
