<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
                'name'=>'user_test1',
                'email'=>'email1',
                'username'=>'admin1',
                'password'=>'hellouniverse1!'
            ],
            [
                'name'=>'user_test2',
                'email'=>'email2',
                'username'=>'admin2',
                'password'=>'hellouniverse2!'
            ]
        ];
        foreach ($data_admins as $data_admin) {
            // todo добавляем косую черту так как он не видит DB фаил
            \DB::table('users')->insert($data_admin);
        }
    }
}
