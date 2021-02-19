<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function test_redirect_to_login_page_if_user_unauthorized()
    {
        $response = $this->get('/products');
        $response->assertRedirect('/login');
    }

    public function test_user_can_read_information_about_products_with_view()
    {
        $response = $this->actingAs(
            Admin::all()->first() ?: Admin::factory()->create()
        )->get('/products');

        $response->assertViewIs('products.index');
        $response->assertViewHas('products');
        $response->assertSuccessful();
    }

    public function test_user_can_read_information_about_product_by_id_with_view()
    {
        $this->seed();
        $product = Product::all()->first();

        $response = $this->actingAs(
            Admin::all()->first() ?: Admin::factory()->create()
        )->get("/products/$product->id");

        $response->assertViewIs('products.show');
        $response->assertViewHas('product');
        $response->assertSuccessful();
    }

    public function test_user_can_edit_information_about_product_by_id_with_view()
    {
        $this->seed();
        $product = Product::all()->first();

        $response = $this->actingAs(
            Admin::all()->first() ?: Admin::factory()->create()
        )->get("/products/$product->id/edit");

        $response->assertViewIs('products.edit');
        $response->assertViewHas('product');
        $response->assertSuccessful();
    }

    public function test_authenticated_users_can_create_a_new_product_with_view()
    {
        $response = $this->actingAs(
            Admin::all()->first() ?: Admin::factory()->create()
        )->get("/products/create");

        $response->assertViewIs('products.create');
        $response->assertSuccessful();
    }

    public function test_authenticated_users_can_create_a_new_product()
    {
        $this->actingAs(
            Admin::all()->first() ?: Admin::factory()->create()
        );

        $this->seed();

        $response = $this->post('/products', [
            'nameUA' => 'ua-name',
            'nameEN' => 'en-name',
            'nameRU' => 'ru-name',
            'category' => 1,
            'quantity' => 88,
            'article' => '000000',
            'color' => 'color',
            'price' => 120,
        ]);
        $this->assertEquals(1, Product::where('article', '000000')->count());

        $response->assertRedirect('/products');
    }

    public function test_authenticated_users_can_update_product()
    {
        $this->actingAs(
            Admin::all()->first() ?: Admin::factory()->create()
        );

        $this->seed();
        $product = Product::all()->first();

        $response = $this->put("/products/$product->id", [
            'nameUA' => 'ua-name',
            'nameEN' => 'en-name',
            'nameRU' => 'ru-name',
            'category' => 1,
            'quantity' => 88,
            'article' => '888888',
            'color' => 'color7',
            'price' => 120,
        ]);
        Log::info('ttt: ' . $product);
        $this->assertEquals(1, Product::where('article', '888888')->count());

        $response->assertRedirect('/products');
    }

    public function test_user_can_delete_product_by_id()
    {
        $this->seed();
        $product = Product::all()->first();

        $response = $this->actingAs(
            Admin::all()->first() ?: Admin::factory()->create()
        )->delete("/products/$product->id");

        $this->assertNull(Product::where('id', $product->id)->first());

        $response->assertRedirect('/products');
    }
}
