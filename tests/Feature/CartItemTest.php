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
use Database\Seeders\CartItemSeeder;
use Database\Seeders\CartSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ColorSeeder;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
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
