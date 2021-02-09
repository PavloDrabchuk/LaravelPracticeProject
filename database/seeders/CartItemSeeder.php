<?php

namespace Database\Seeders;

use App\Models\CartItem;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cartItems = [
            [
                'cart_id' => 1,
                'product_id' => 1,
                'quantity' => 2,
            ],
            [
                'cart_id' => 1,
                'product_id' => 3,
                'quantity' => 3,
            ],
        ];

        foreach ($cartItems as $key => $value) {
            CartItem::create($value);
        }
    }
}
