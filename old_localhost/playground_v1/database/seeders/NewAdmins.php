<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// todo seeder - php artisan make:seeder NewAdmin
// todo run main seeder (DatabaseSeeder) - php artisan db:seed <name_seeder>
class NewAdmins extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'username'=>'admin1',
                'password'=>Hash::make('hellouniverse1!')
            ],
            [
                'username'=>'admin2',
                'password'=>Hash::make('hellouniverse2!')
            ]

        ];
        foreach ($admins as $admin) {
            // todo добавляем косую черту так как он не видит DB фаил
            \DB::table('admins')->insert($admin);
        }
    }
}
