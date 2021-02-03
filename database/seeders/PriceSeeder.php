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
            ],
            [
                'value' => 170,
            ],
        ];

        foreach ($prices as $key => $value) {
            Price::create($value);
        }
    }
}
