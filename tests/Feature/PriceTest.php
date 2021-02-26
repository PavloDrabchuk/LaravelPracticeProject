<?php

namespace Tests\Feature;

use App\Models\Currency;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PriceTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function test_price_belongs_to_a_currency()
    {
        $this->seed();
        $price = Price::first();

        $this->assertInstanceOf(Currency::class, $price->currency);
    }

    public function test_price_belongs_to_a_product()
    {
        $this->seed();
        $price = Price::first();

        $this->assertInstanceOf(Product::class, $price->product);
    }
}
