<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'name' => 'admins',
                'email' => 'admins@admins.com',
                'password' => bcrypt('admins')
            ]
        ];

        foreach ($admins as $key => $value) {
            Admin::create($value);
        }
    }
}
