<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prices = [
            [
                'value' => 150,
                'currency' => 'UAH',
                'product_id' => 1,
            ],
            [
                'value' => 5.40,
                'currency' => 'USD',
                'product_id' => 1,
            ],
        ];

        foreach ($prices as $key => $value) {
            Price::create($value);
        }

        Price::factory(10)->create();
    }
}
