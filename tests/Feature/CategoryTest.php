<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function test_the_application_returns_a_successful_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/categories');
        $this->assertAuthenticated();

        $response->assertStatus(200);
    }

    public function test_the_returns_data_in_valid_format(){
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('api/categories');
            $response->assertJsonStructure(
                [
                    'categories' => [
                        '*' => [
                            'id',
                            'name',
                            'products'=>[
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

    /*public function test_the_post_example(){
        $response=$this->post('/api/examples',[
            'name'=>'test_name',
            'value'=>142,
        ]);
        $response->assertStatus(200);
    }*/
}
