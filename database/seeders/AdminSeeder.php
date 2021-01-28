<?php

namespace Database\Seeders;

use App\Models\Admins;
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
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin')
            ]
        ];

        foreach ($admins as $key => $value) {
            Admins::create($value);
        }
    }
}
