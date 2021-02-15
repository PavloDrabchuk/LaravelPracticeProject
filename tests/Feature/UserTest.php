<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /*public function test_users_can_authenticate_using_the_api()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'phone' => $user->phone,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertStatus(201);
        //$response->assertRedirect(RouteServiceProvider::HOME);
    }*/
}
