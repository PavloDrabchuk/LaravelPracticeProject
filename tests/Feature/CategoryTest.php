<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function test_the_application_returns_a_successful_response()
    {
        Sanctum::actingAs(
            User::all()->first() ?: User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/categories');
        $this->assertAuthenticated();

        $response->assertStatus(200);
    }

    public function test_the_returns_data_in_valid_format()
    {
        Sanctum::actingAs(
            User::all()->first() ?: User::factory()->create(),
            ['*']
        );

        $this->withoutExceptionHandling();
        $this->get('/api/categories')
            ->assertStatus(200)
            ->assertJson(Category::all()->toArray())
            ->assertJsonStructure(
                [
                    'categories' => [
                        '*' => [
                            'id',
                            'name',
                            'products' => [
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
                ]
            );
    }

    public function test_category_by_id_is_shows_correctly_with_authorized_user()
    {
        Sanctum::actingAs(
            User::all()->first() ?: User::factory()->create(),
            ['*']
        );

        $category = Category::factory()->create();

        $this->json('get', "/api/categories/$category->id")
            ->assertStatus(200)
            ->assertExactJson(
                [
                    'categories' => [
                        'id' => $category->id,
                        'name' => [
                            'ua' => $category->getTranslation('name', 'ua'),
                            'en' => $category->getTranslation('name', 'en'),
                            'ru' => $category->getTranslation('name', 'ru'),
                        ]
                    ]
                ]
            );
    }

    public function test_category_by_id_is_shows_correctly_without_authorized_user()
    {
        $category = Category::factory()->create();

        $this->json('get', "/api/categories/$category->id")
            ->assertStatus(401);
    }

    public function test_category_by_id_is_shows_correctly_with_incorrect_id()
    {
        Sanctum::actingAs(
            User::all()->first() ?: User::factory()->create(),
            ['*']
        );

        do {
            $_id = 888;
            $_id++;
            $is = Category::where('id', $_id)->first();
        } while ($is);

        $this->json('get', "/api/categories/$_id")
            ->assertStatus(404);
    }

    public function test_category_has_many_products()
    {
        $this->seed();
        $category = Category::all()->first();
        $product = Product::all()->first();

        $this->assertTrue($category->products->contains($product));
    }
}
