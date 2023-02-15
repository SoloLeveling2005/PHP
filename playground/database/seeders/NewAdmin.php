<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// todo seeder - php artisan make:seeder NewAdmin
// todo run main seeder (DatabaseSeeder) - php artisan db:seed
class NewAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_admins = [
            [
                'name'=>'user_test3',
                'email'=>'email3',
                'username'=>'admin3',
                'password'=>Hash::make('hellouniverse1!')
            ],
            [
                'name'=>'user_test4',
                'email'=>'email4',
                'username'=>'admin4',
                'password'=>Hash::make('hellouniverse2!')
            ]
        ];
        foreach ($data_admins as $data_admin) {
            // todo добавляем косую черту так как он не видит DB фаил
            \DB::table('users')->insert($data_admin);
        }
    }
}
