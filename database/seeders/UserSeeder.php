<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Pavlo',
                'phone' => '380888888888',
                'password' => bcrypt('pavlo')
            ],
            [
                'name' => 'Andrey',
                'phone' => '380111111111',
                'password' => bcrypt('andrey')
            ],
            [
                'name' => 'Yulia',
                'phone' => '380222222222',
                'password' => bcrypt('yulia')
            ],
            [
                'name' => 'Anna',
                'phone' => '380333333333',
                'password' => bcrypt('anna')
            ],
            [
                'name' => 'Ivan',
                'phone' => '380444444444',
                'password' => bcrypt('ivan')
            ]
        ];

        foreach ($users as $key => $value) {
            User::create($value);
        }
    }
}
