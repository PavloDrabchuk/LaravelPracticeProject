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
use Database\Seeders\CurrencySeeder;
use Database\Seeders\PriceSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class PriceTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function test_price_belongs_to_a_currency()
    {
        $this->seed();
        $price = Price::all()->first();

        $this->assertInstanceOf(Currency::class, $price->currency);
    }

    public function test_price_belongs_to_a_product()
    {
        $this->seed();
        $price = Price::all()->first();

        $this->assertInstanceOf(Product::class, $price->product);
    }
}
