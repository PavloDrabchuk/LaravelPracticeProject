<?php

namespace Tests\Feature;

use App\Models\Currency;
use App\Models\Price;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CurrencyTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function test_currency_has_many_prices()
    {
        $this->seed();
        $currency = Currency::all()->first();
        $price = Price::all()->first();

        $this->assertTrue($currency->prices->contains($price));
    }
}
