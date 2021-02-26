<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApiAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_must_enter_phone_and_password()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(404)
            ->assertJson([
                "message" => ["These credentials do not match our records."],
            ]);

    }

    public function test_users_can_authenticate_using_the_api()
    {
        $user = User::factory()->create();

        $this->post('/api/login', [
            'phone' => $user->getAttribute('phone'),
            'password' => 'password',
        ])->assertStatus(201)
            ->assertJsonStructure([
                "user" => [
                    'id',
                    'name',
                    'phone',
                    'phone_verified_at',
                    'created_at',
                    'updated_at',
                ],
                "token",
            ]);

        //$this->assertAuthenticated();
    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $user = User::factory()->create();

        $this->post('/api/login', [
            'phone' => $user->getAttribute('phone'),
            'password' => 'wrong-password',
        ])->assertStatus(404);

        $this->assertGuest();
    }

    public function test_authenticate_user_can_logout_using_the_api()
    {
        Sanctum::actingAs(
            User::all()->first() ?: User::factory()->create(),
            ['*']
        );

        $this->post('/api/logout')
            ->assertStatus(200)
            ->assertJson(['message' => ['Logout was successful.']]);

    }


}
