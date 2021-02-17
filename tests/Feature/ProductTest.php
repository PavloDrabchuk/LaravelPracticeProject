<?php

namespace Tests\Feature;

use App\Http\Resources\PriceResource;
use App\Models\Category;
use App\Models\Color;
use App\Models\Currency;
use App\Models\Price;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_the_application_returns_a_successful_response()
    {
        $user = User::all()->first();
        $user = $user ?: User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*']
        );

        $response = $this->get('/api/products');
        $this->assertAuthenticated();

        $response->assertStatus(200);
    }

    public function test_the_returns_data_in_valid_format()
    {
        $user = User::all()->first();
        $user = $user ?: User::factory()->create();
        Sanctum::actingAs(
            $user,
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
        $user = User::all()->first();
        $user = $user ?: User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*']
        );

        $codes = [
            [
                'code' => 'UAH',
                'sign' => '₴',
            ],
            [
                'code' => 'USD',
                'sign' => '$',
            ],
            [
                'code' => 'EUR',
                'sign' => '€',
            ],
        ];

        foreach ($codes as $key => $value) {
            $currency=Currency::where('code',$value['code'])->first();
            $currency ?: Currency::create($value);
        }

        $color = Color::factory()->create();

        $category = Category::factory()->create();
        $product = Product::factory([
            'category_id' => $category->id,
            'color_id' => $color->id,
        ])->create();

        for ($j = 1; $j <= 3; $j++) {
            Price::factory([
                'currency_id' => $j,
                'product_id' => $product->id])->create();
        }

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
        $color = Color::factory()->create();

        $category = Category::factory()->create();
        $product = Product::factory([
            'category_id' => $category->id,
            'color_id' => $color->id,
        ])->create();

        for ($j = 1; $j <= 3; $j++) {
            Price::factory([
                'currency_id' => $j,
                'product_id' => $product->id])->create();
        }

        $this->json('get', "/api/products/$product->id")
            ->assertStatus(401);
    }

    public function test_product_by_id_is_shows_correctly_with_incorrect_id()
    {
        $user = User::all()->first();
        $user = $user ?: User::factory()->create();
        Sanctum::actingAs(
            $user,
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
