<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_redirect_to_login_page_if_admin_unauthorized()
    {
        $response = $this->get('/users');
        $response->assertRedirect('/login');
    }

    public function test_admin_can_read_information_about_users_with_view()
    {
        $response = $this->actingAs(
            Admin::first() ?: Admin::factory()->create()
        )->get('/users');

        $response->assertViewIs('users.index');
        $response->assertViewHas('users');
        $response->assertSuccessful();
    }

    public function test_admin_can_read_information_about_user_by_id_with_view()
    {
        $this->seed(UserSeeder::class);
        $user = User::first();

        $response = $this->actingAs(
            Admin::first() ?: Admin::factory()->create()
        )->get("/users/{$user->id}");

        $response->assertViewIs('users.show');
        $response->assertViewHas('user');
        $response->assertSuccessful();
    }

    public function test_admin_can_edit_information_about_user_by_id_with_view()
    {
        $this->seed(UserSeeder::class);
        $user = User::first();

        $response = $this->actingAs(
            Admin::first() ?: Admin::factory()->create()
        )->get("/users/{$user->id}/edit");

        $response->assertViewIs('users.edit');
        $response->assertViewHas('user');
        $response->assertSuccessful();
    }

    public function test_authenticated_admins_can_create_a_new_user_with_view()
    {
        $response = $this->actingAs(
            Admin::first() ?: Admin::factory()->create()
        )->get("/users/create");

        $response->assertViewIs('users.create');
        $response->assertSuccessful();
    }

    public function test_authenticated_admins_can_create_a_new_user()
    {
        $this->actingAs(
            Admin::first() ?: Admin::factory()->create()
        );

        $response = $this->post('/users', [
            'name' => 'test_name',
            'phone' => '380987654321',
            'password' => 'test_password',
            'password_confirmation' => 'test_password',
        ]);
        $this->assertEquals(1, User::all()->count());

        $response->assertRedirect('/users');
    }

    public function test_authenticated_admins_can_update_user()
    {
        $this->actingAs(
            Admin::first() ?: Admin::factory()->create()
        );
        $user = User::factory()->create();

        $response = $this->put("/users/{$user->getAttribute('id')}", [
            'name' => 'test_name_upd',
            'phone' => '380987654321',
            'password' => 'test_password_upd',
            'password_confirmation' => 'test_password_upd',
        ]);

        $this->assertEquals('test_name_upd', User::first()->name);

        $response->assertRedirect('/users');
    }

    public function test_admin_can_delete_user_by_id()
    {
        $this->seed(UserSeeder::class);
        $user = User::first();

        $response = $this->actingAs(
            Admin::first() ?: Admin::factory()->create()
        )->delete("/users/{$user->id}");

        $this->assertNull(User::where('id', $user->id)->first());

        $response->assertRedirect('/users');
    }
}
