<?php

namespace Tests\Feature;

use App\Http\Controllers\Cart\CartController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CartControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_function()
    {
        $this->assertIsObject((new CartController())->index());
    }

    public function test_store_function_with_authorized_admin()
    {
        Sanctum::actingAs(
            User::all()->first() ?: User::factory()->create(),
            ['*']
        );

        $this->assertEquals(1, (new CartController())->store()->count());
    }

    public function test_store_function_without_authorized_admin()
    {
        $this->assertEquals(0, (new CartController())->store(new Request()));
    }
}
