<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Color;
use App\Models\Currency;
use App\Models\Price;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_cart_item_belongs_to_a_cart()
    {
        $codes = [
            [
                'code' => 'UAH',
                'sign' => '₴',
            ],
            [
                'code' => 'USD',
                'sign' => '$',
            ],
            [
                'code' => 'EUR',
                'sign' => '€',
            ],
        ];

        foreach ($codes as $key => $value) {
            $currency = Currency::where('code', $value['code'])->first();
            $currency ?: Currency::create($value);
        }

        $color = Color::factory()->create();

        $category = Category::factory()->create();
        $product = Product::factory([
            'category_id' => $category->id,
            'color_id' => $color->id,
        ])->create();

        $currency_first_id = Currency::all()->first()->id;
        for ($j = $currency_first_id; $j <= $currency_first_id + 2; $j++) {
            Price::factory([
                'currency_id' => $j,
                'product_id' => $product->id])->create();
        }

        $user = User::factory()->create();
        $cart = Cart::create(['user_id' => $user->id]);
        $cart_item = CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => 3,
        ]);

        $this->assertInstanceOf(Cart::class, $cart_item->cart);
    }
}