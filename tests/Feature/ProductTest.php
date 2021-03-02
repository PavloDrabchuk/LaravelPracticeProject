<?php

namespace Tests\Feature;

use App\Models\CartItem;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function test_the_application_returns_a_successful_response()
    {
        Sanctum::actingAs(
            User::first() ?: User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/products');
        $this->assertAuthenticated();

        $response->assertStatus(200);
    }

    public function test_the_returns_data_in_valid_format()
    {
        Sanctum::actingAs(
            User::first() ?: User::factory()->create(),
            ['*']
        );

        $this->get('api/products')
            ->assertStatus(200)
            ->assertJson(Product::all()->toArray())
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'name',
                            'category',
                            'quantity',
                            'article',
                            'color',
                            'prices',
                        ],
                    ]
                ]
            );
    }

    public function test_product_by_id_is_shows_correctly_with_authorized_user()
    {
        Sanctum::actingAs(
            User::first() ?: User::factory()->create(),
            ['*']
        );

        $this->seed();
        $product = Product::first();

        $this->json('get', "/api/products/{$product->id}")
            ->assertStatus(200);
    }

    public function test_product_by_id_is_shows_correctly_without_authorized_user()
    {
        $this->seed();
        $product = Product::first();

        $this->json('get', "/api/products/{$product->id}")
            ->assertStatus(401);
    }

    public function test_product_by_id_is_shows_correctly_with_incorrect_id()
    {
        Sanctum::actingAs(
            User::first() ?: User::factory()->create(),
            ['*']
        );

        do {
            $_id = 888;
            $_id++;
            $is = Product::where('id', $_id)->first();
        } while ($is);

        $this->json('get', "/api/products/{$_id}")
            ->assertStatus(404);
    }

    public function test_the_product_belongs_to_a_category()
    {
        $this->seed();
        $product = Product::first();

        $this->assertInstanceOf(Category::class, $product->category);
    }

    public function test_the_product_belongs_to_a_color()
    {
        $this->seed();
        $product = Product::first();

        $this->assertInstanceOf(Color::class, $product->color);
    }

    public function test_the_product_belongs_to_a_cart_item()
    {
        $this->seed();
        $product = Product::first();

        $this->assertInstanceOf(CartItem::class, $product->cartItem);
    }
}
