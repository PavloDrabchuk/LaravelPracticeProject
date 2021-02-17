<?php

namespace Tests\Feature;

use App\Models\Cart;
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

        Log::debug("1: user: $user");


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

        Log::debug("test_the_application_returns_a_successful_response: user: $user");

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

        Log::debug("2: user: $user");
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

        for ($j = 1; $j <= 3; $j++) {
            Price::factory([
                'currency_id' => $j,
                'product_id' => $product->id])->create();
        }
        $prod = Product::all();
        Log::debug("prod: $product->id --- prod:: $prod");


        $response = $this->json('POST', '/api/cart/add_item', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
        $response
            ->assertStatus(200);
//            ->assertJsonStructure([
//                "message" => "Product added to cart.",
//            ]);

    }
}
