<?php

namespace Tests\Feature;

use App\Models\Currency;
use App\Models\Price;
use Database\Seeders\CurrencySeeder;
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
        $currency = Currency::first();
        $price = Price::first();

        $this->assertTrue($currency->prices->contains($price));
    }

    public function test_function_for_get_all_possible_currency_codes()
    {
        $this->seed(CurrencySeeder::class);
        $currency = Currency::first();

        $this->assertTrue(count($currency->getAllPossibleCurrencyCode()) > 0);
    }
}
