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
                'price_id' => 1,
            ],
        ];

        foreach ($tours as $key => $value) {
            Product::create($value);
        }
    }
}
