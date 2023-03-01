<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     */
    // todo seeder - php artisan make:seeder NewAdmin
    // todo run main seeder (DatabaseSeeder) - php artisan db:seed <name_seeder>
    public function run(): void
    {
        $users = [
            [
                'username'=>'player1',
                'password'=>Hash::make('helloworld1!')
            ],
            [
                'username'=>'player2',
                'password'=>Hash::make('helloworld2!')
            ],
            [
                'username'=>'dev1',
                'password'=>Hash::make('hellobyte1!')
            ],
            [
                'username'=>'dev2',
                'password'=>Hash::make('hellobyte2!')
            ]
        ];
        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }
}
