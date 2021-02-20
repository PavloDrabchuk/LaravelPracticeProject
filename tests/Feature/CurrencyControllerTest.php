<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Currency;
use Database\Seeders\CurrencySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CurrencyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_redirect_to_login_page_if_admin_unauthorized()
    {
        $response = $this->get('/currencies');
        $response->assertRedirect('/login');
    }

    public function test_admin_can_read_information_about_currencies_with_view()
    {
        $response = $this->actingAs(
            Admin::all()->first() ?: Admin::factory()->create()
        )->get('/currencies');

        $response->assertViewIs('currencies.index');
        $response->assertViewHas('currencies');
        $response->assertSuccessful();
    }

    public function test_admin_can_read_information_about_currency_by_id_with_view()
    {
        $this->seed(CurrencySeeder::class);
        $currency = Currency::all()->first();

        $response = $this->actingAs(
            Admin::all()->first() ?: Admin::factory()->create()
        )->get("/currencies/$currency->id");

        $response->assertViewIs('currencies.show');
        $response->assertViewHas('currency');
        $response->assertSuccessful();
    }

    public function test_admin_can_edit_information_about_currency_by_id_with_view()
    {
        $this->seed(CurrencySeeder::class);
        $currency = Currency::all()->first();

        $response = $this->actingAs(
            Admin::all()->first() ?: Admin::factory()->create()
        )->get("/currencies/$currency->id/edit");

        $response->assertViewIs('currencies.edit');
        $response->assertViewHas('currency');
        $response->assertSuccessful();
    }

    public function test_authenticated_admins_can_create_a_new_currency_with_view()
    {
        $response = $this->actingAs(
            Admin::all()->first() ?: Admin::factory()->create()
        )->get("/currencies/create");

        $response->assertViewIs('currencies.create');
        $response->assertSuccessful();
    }

    public function test_authenticated_admins_can_create_a_new_currency()
    {
        $this->actingAs(
            Admin::all()->first() ?: Admin::factory()->create()
        );

        $response = $this->post('/currencies', [
            'code' => 'USD',
            'sign' => 'a',
        ]);
        $this->assertEquals(1, Currency::all()->count());

        $response->assertRedirect('/currencies');
    }

    public function test_authenticated_admins_can_update_currency()
    {
        $this->actingAs(
            Admin::all()->first() ?: Admin::factory()->create()
        );
        $this->seed(CurrencySeeder::class);
        $currency = Currency::all()->first();

        $response = $this->put("/currencies/$currency->id", [
            'code' => 'USD',
            'sign' => 'b',
        ]);
        $this->assertEquals('b', Currency::all()->first()->sign);

        $response->assertRedirect('/currencies');
    }

    public function test_admin_can_delete_currency_by_id()
    {
        $this->seed(CurrencySeeder::class);
        $currency = Currency::all()->first();

        $response = $this->actingAs(
            Admin::all()->first() ?: Admin::factory()->create()
        )->delete("/currencies/$currency->id");

        $this->assertNull(Currency::where('id', $currency->id)->first());

        $response->assertRedirect('/currencies');
    }
}
