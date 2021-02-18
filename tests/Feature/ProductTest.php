<?php

namespace Tests\Feature;

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
            User::all()->first() ?: User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/products');
        $this->assertAuthenticated();

        $response->assertStatus(200);
    }

    public function test_the_returns_data_in_valid_format()
    {
        Sanctum::actingAs(
            User::all()->first() ?: User::factory()->create(),
            ['*']
        );

        $this->get('api/products')
            ->assertStatus(200)
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
            User::all()->first() ?: User::factory()->create(),
            ['*']
        );

        $this->seed();
        $product = Product::all()->first();

        $this->json('get', "/api/products/$product->id")
            ->assertStatus(200);
        /*->assertExactJson(
            [
                'products' => [
                    'id' => $product->id,
                    'name' => [
                        'ua' => $product->getTranslation('name', 'ua'),
                        'en' => $product->getTranslation('name', 'en'),
                        'ru' => $product->getTranslation('name', 'ru'),
                    ],
                    'category' =>  [
                        'id' => $category->id,
                        'name' => [
                            'ua' => $category->getTranslation('name', 'ua'),
                            'en' => $category->getTranslation('name', 'en'),
                            'ru' => $category->getTranslation('name', 'ru'),
                        ]
                    ],
                    'quantity' => $product->quantity,
                    'article' => $product->article,
                    'color' => [
                        'id'=>$color->id,
                        'name'=>$color->name,
                    ],
                    'prices' => PriceResource::collection($product->prices),
                ]
            ]
        );*/
    }

    public function test_product_by_id_is_shows_correctly_without_authorized_user()
    {
        $this->seed();
        $product = Product::all()->first();

        $this->json('get', "/api/products/$product->id")
            ->assertStatus(401);
    }

    public function test_product_by_id_is_shows_correctly_with_incorrect_id()
    {
        Sanctum::actingAs(
            User::all()->first() ?: User::factory()->create(),
            ['*']
        );

        do {
            $_id = 888;
            $_id++;
            $is = Product::where('id', $_id)->first();
        } while ($is);
        //Log::debug("_id: $_id.");

        $this->json('get', "/api/products/$_id")
            ->assertStatus(404);
    }
}
