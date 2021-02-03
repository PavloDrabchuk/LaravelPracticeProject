<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            [
                'name' => 'Natural history tour',
            ],
            [
                'name' => 'Vacation at sea',
            ],
        ];

        foreach ($colors as $key => $value) {
            Color::create($value);
        }

        Color::factory(10)->create();
    }
}
