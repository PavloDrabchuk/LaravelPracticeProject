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
                'password' => bcrypt('pavlo'),
                'api_token'=>Str::random(60)
            ],
            [
                'name' => 'Andrey',
                'phone' => '380111111111',
                'password' => bcrypt('andrey'),
                'api_token'=>Str::random(60)
            ],
            [
                'name' => 'Yulia',
                'phone' => '380222222222',
                'password' => bcrypt('yulia'),
                'api_token'=>Str::random(60)
            ],
            [
                'name' => 'Anna',
                'phone' => '380333333333',
                'password' => bcrypt('anna'),
                'api_token'=>Str::random(60)
            ],
            [
                'name' => 'Ivan',
                'phone' => '380444444444',
                'password' => bcrypt('ivan'),
                'api_token'=>Str::random(60)
            ]
        ];

        foreach ($users as $key => $value) {
            User::create($value);
        }
    }
}
