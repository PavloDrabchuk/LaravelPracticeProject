<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function test_the_application_returns_a_successful_response_with_all_carts()
    {
        Sanctum::actingAs(
            User::all()->first() ?: User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/carts');
        $this->assertAuthenticated();

        $response->assertStatus(200);
    }

    public function test_the_application_returns_a_successful_response()
    {
        $user = User::all()->first() ?: User::factory()->create();
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
        $this->seed();

        Sanctum::actingAs(
            User::all()->first() ?: User::factory()->create(),
            ['*']
        );

        $product = Product::all()->first();

        $response = $this->json('POST', '/api/cart/add_item', [
            'product_id' => $product->id + 1,
            'quantity' => 2,
        ]);
        $response
            ->assertStatus(200)
            ->assertJson([
                "message" => "Product added to cart.",
            ]);
    }

    public function test_the_user_can_add_item_when_the_cart_does_not_exist()
    {
        $this->seed();

        Sanctum::actingAs(
            $user = User::all()->first() ?: User::factory()->create(),
            ['*']
        );

        Cart::where('user_id', $user->id)->first()->delete();

        $product = Product::all()->first();

        $response = $this->json('POST', '/api/cart/add_item', [
            'product_id' => $product->id + 1,
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
        $user = User::all()->first() ?: User::factory()->create();
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
        $user = User::all()->first() ?: User::factory()->create();
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
        $this->seed();
        $cart = Cart::all()->first();
        $cart_item = CartItem::all()->first();

        $this->assertTrue($cart->cartItems->contains($cart_item));
    }
}
