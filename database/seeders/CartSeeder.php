<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carts = [
            [
                'user_id' => 1,
                /*'products' => [
                    [
                        'product_id' => 1,
                        'quantity' => 2,
                    ],
                    [
                        'product_id' => 2,
                        'quantity' => 3,
                    ],
                ],*/
            ],
            [
                'user_id' => 2,
                /*'products' => [
                    [
                        'product_id' => 4,
                        'quantity' => 4,
                    ],
                    [
                        'product_id' => 3,
                        'quantity' => 2,
                    ],
                ],*/
            ],
        ];


        foreach ($carts as $key => $value) {
            Cart::create($value);
        }

    }
}
