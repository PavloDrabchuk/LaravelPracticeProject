<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function test_the_application_returns_a_successful_response_with_all_carts()
    {
        Sanctum::actingAs(
            User::first() ?: User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/carts');
        $this->assertAuthenticated();

        $response->assertStatus(200);
    }

    public function test_the_application_returns_a_successful_response()
    {
        $user = User::first() ?: User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*']
        );

        Cart::create([
            'user_id' => $user->getAttribute('id'),
        ])->save();

        $response = $this->get('/api/cart');
        $this->assertAuthenticated();

        $response->assertStatus(200);
    }

    public function test_the_user_can_add_item_to_cart()
    {
        $this->seed();

        Sanctum::actingAs(
            User::first() ?: User::factory()->create(),
            ['*']
        );

        $product = Product::first();

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
            $user = User::first() ?: User::factory()->create(),
            ['*']
        );

        Cart::where('user_id', $user->getAttribute('id'))->first()->delete();

        $product = Product::first();

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
        $user = User::first() ?: User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*']
        );

        Cart::create([
            'user_id' => $user->getAttribute('id'),
        ])->save();

        $response = $this->delete('/api/cart');

        $response
            ->assertStatus(200)
            ->assertJson(['message' => ['Cart cleared.']]);

    }

    public function test_the_user_can_clear_the_undefined_cart()
    {
        $user = User::first() ?: User::factory()->create();
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

        $cart = Cart::first();
        $cart_item = CartItem::first();

        $this->assertTrue($cart->cartItems->contains($cart_item));
    }

    public function test_the_user_can_remove_cart_item_by_id()
    {
        $this->seed();

        Sanctum::actingAs(
            User::first() ?: User::factory()->create(),
            ['*']
        );

        $cartItem = CartItem::first();

        $response = $this->json('DELETE', "/api/cart/item/{$cartItem->id}");

        $response
            ->assertStatus(200)
            ->assertJson([
                "message" => "Deleted.",
            ]);
    }

    public function test_the_user_can_not_remove_cart_item_by_non_existent_id()
    {
        $this->seed();

        Sanctum::actingAs(
            User::first() ?: User::factory()->create(),
            ['*']
        );

        do {
            $_id = 888;
            $_id++;
            $is = CartItem::where('id', $_id)->first();
        } while ($is);

        $response = $this->json('DELETE', "/api/cart/item/{$_id}");

        $response
            ->assertStatus(400)
            ->assertJson([
                "message" => "Cart item not found.",
            ]);
    }

    public function test_the_user_can_buy_tours()
    {
        $this->seed();

        Sanctum::actingAs(
            $user = User::first() ?: User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/cart/checkout');

        $response
            ->assertStatus(200)
            ->assertJson([
                "message" => "Tours purchased successfully.",
            ]);

    }

    public function test_the_user_can_not_buy_tours()
    {
        $this->seed();

        Sanctum::actingAs(
            User::first() ?: User::factory()->create(),
            ['*']
        );

        $product = Product::first();

        Product::whereId($product->id)->update([
            'quantity' => 1,
        ]);

        $response = $this->get('/api/cart/checkout');

        $response
            ->assertStatus(400)
            ->assertJson([
                "message" => "These tours are over.",
            ]);
    }
}
