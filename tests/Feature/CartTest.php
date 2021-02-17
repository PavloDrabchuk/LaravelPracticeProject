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
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response_with_all_carts()
    {
        $user = User::all()->first();
        $user = $user ?: User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*']
        );

        $response = $this->get('/api/carts');
        $this->assertAuthenticated();

        $response->assertStatus(200);
    }

    public function test_the_application_returns_a_successful_response()
    {
        $user = User::all()->first();
        $user = $user ?: User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*']
        );

        Cart::create([
            'user_id' => $user->id,
        ])->save();

        $response = $this->get('/api/cart');
        $this->assertAuthenticated();

        $response->assertStatus(200);
    }

    public function test_the_user_can_add_item_to_cart()
    {

        $user = User::all()->first();
        $user = $user ?: User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*']
        );

        Cart::create([
            'user_id' => $user->id,
        ])->save();

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
        $prod = Product::all();

        $response = $this->json('POST', '/api/cart/add_item', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
        $response
            ->assertStatus(200)
            ->assertJson([
                "message" => "Product added to cart.",
            ]);

    }

    public function test_the_user_can_clear_the_cart()
    {

        $user = User::all()->first();
        $user = $user ?: User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*']
        );

        Cart::create([
            'user_id' => $user->id,
        ])->save();

        $response = $this->delete('/api/cart');
        $response
            ->assertStatus(200)
            ->assertJson(['message' => ['Cart cleared.']]);

    }

    public function test_the_user_can_clear_the_undefined_cart()
    {

        $user = User::all()->first();
        $user = $user ?: User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*']
        );

        $response = $this->delete('/api/cart');
        $response
            ->assertStatus(404)
            ->assertJson(['message' => ['Cart not found.']]);
    }

    public function test_cart_has_many_cart_items()
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

        $this->assertTrue($cart->cartItems->contains($cart_item));
    }
}
