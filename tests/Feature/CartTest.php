<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Color;
use App\Models\Price;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CartTest extends TestCase
{
    public function test_the_application_returns_a_successful_response_with_all_carts()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/carts');
        $this->assertAuthenticated();

        $response->assertStatus(200);
    }

    public function test_the_application_returns_a_successful_response()
    {
        Sanctum::actingAs(
            $user = User::factory()->create(),
            ['*']
        );

        Cart::create([
            'user_id' => $user->id,
        ])->save();

        $response = $this->get('/api/cart');
        $this->assertAuthenticated();

        $response->assertStatus(200);
    }

    /*public function test_the_user_can_add_item_to_cart(){

        Sanctum::actingAs(
            $user=User::factory()->create(),
            ['*']
        );

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

        $this->post('/cart/add_item', [
            'product_id' => $product->id,
            'quantity' => 1,
        ])->assertStatus(200);
//            ->assertJsonStructure([
//                "message"=> "Product added to cart.",
//            ]);

        //$this->assertAuthenticated();
    }*/
}
