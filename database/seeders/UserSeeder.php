<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=[
            [
                'name'=>'Pavlo',
                'phone'=>'380888888888',
                'password'=>bcrypt('pavlo')
            ],
            [
                'name'=>'Andrey',
                'phone'=>'380111111111',
                'password'=>bcrypt('andrey')
            ],
            [
                'name'=>'Yulia',
                'phone'=>'380222222222',
                'password'=>bcrypt('yulia')
            ],
            [
                'name'=>'Anna',
                'phone'=>'380333333333',
                'password'=>bcrypt('anna')
            ],
            [
                'name'=>'Ivan',
                'phone'=>'380444444444',
                'password'=>bcrypt('ivan')
            ]
        ];

        foreach ($user as $key => $value){
            User::create($value);
        }
    }
}
