<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartItemTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function test_cart_item_belongs_to_a_cart()
    {
        $this->seed();
        $cart_item = CartItem::all()->first();

        $this->assertInstanceOf(Cart::class, $cart_item->cart);
    }
}
