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
                'username'=>'admin1',
                'password'=>bcrypt('hellouniverse1!')
            ],
            [
                'username'=>'admin2',
                'password'=>bcrypt('hellouniverse2!')
            ]
        ];
        foreach ($data_admins as $data_admin) {
            // todo добавляем косую черту так как он не видит DB фаил
            \DB::table('admins')->insert($data_admin);
        }
    }
}
