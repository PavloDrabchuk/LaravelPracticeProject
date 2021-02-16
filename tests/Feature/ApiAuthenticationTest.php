<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiAuthenticationTest extends TestCase
{
    public function test_user_must_enter_phone_and_password()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(404)
            ->assertJson([
                "message" => ["These credentials do not match our records."],
            ]);

    }

    public function testSuccessfulLogin()
    {
        /*User::create([
            'name' => 'username',
            'phone' => '380123456789',
            'password' => bcrypt('password'),
        ]);*/

        /*User::factory()->create([
            'name' => 'username',
            'phone' => '380123456789',
            'password' => bcrypt('password'),
        ]);*/
        $user = User::factory()->create();
        //$loginData = ['phone' => '380123456789', 'password' => 'password'];

        /*$response = $this->post('api/login', [
            'phone' => $user->phone,
            'password' => 'password',
        ]);*/
        $this->json('POST', 'api/login', [
            'phone' => $user->phone,
            'password' => 'password',
        ],
            ['Accept' => 'application/json']);

        $this->assertAuthenticated();

        /*$response->assertStatus(201)
            ->assertJsonStructure(
            [
                "user" => [
                    'id',
                    'name',
                    'phone',
                    'phone_verified_at',
                    'created_at',
                    'updated_at',
                ],
                "token"
            ]
        );*/

        /*$this->json('POST', 'api/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                "user" => [
                    'id',
                    'name',
                    'phone',
                    'phone_verified_at',
                    'created_at',
                    'updated_at',
                ],
                "token"
            ]);

        $this->assertAuthenticated();*/
    }
}
