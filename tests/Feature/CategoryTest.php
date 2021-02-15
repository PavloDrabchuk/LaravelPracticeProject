<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/api/categories');
        $this->assertAuthenticated();

        $response->assertStatus(200);
    }

    /*public function test_the_post_example(){
        $response=$this->post('/api/examples',[
            'name'=>'test_name',
            'value'=>142,
        ]);
        $response->assertStatus(200);
    }*/
}
