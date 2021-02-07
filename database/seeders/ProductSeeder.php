<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tours = [
            [
                'name' => [
                    'ua' => 'Похід на Говерлу',
                    'en' => 'Hike to Hoverla',
                    'ru' => 'Поход на Говерлу',
                ],
                'category_id' => 1,
                'quantity' => 12,
                'article' => '123abc',
                'color_id' => 1,
                //'price_id' => 1,
            ],
            [
                'name' => [
                    'ua' => 'Поїздка до Одеси',
                    'en' => 'Trip to Odessa',
                    'ru' => 'Поездка в Одессу',
                ],
                'category_id' => 2,
                'quantity' => 13,
                'article' => 'a1b2c3',
                'color_id' => 2,
                //'price_id' => 2,
            ],
        ];

        foreach ($tours as $key => $value) {
            Product::create($value);
        }

        Product::factory(10)->create();
    }
}
