<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_redirect_to_login_page_if_admin_unauthorized()
    {
        $response = $this->get('/account');
        $response->assertRedirect('/login');
    }

    public function test_admin_can_read_information_about_account_with_view()
    {
        $response = $this->actingAs(
            Admin::first() ?: Admin::factory()->create()
        )->get("/account");

        $response->assertViewIs('account');
        $response->assertViewHas('admin');
        $response->assertSuccessful();
    }

    public function test_admin_can_edit_information_about_account_with_view()
    {
        $response = $this->actingAs(
            Admin::first() ?: Admin::factory()->create()
        )->get("/account/edit");

        $response->assertViewIs('account.edit');
        $response->assertViewHas('admin');
        $response->assertSuccessful();
    }

    public function test_admin_can_update_information_of_account()
    {
        $this->actingAs(
            $admin = Admin::first() ?: Admin::factory()->create()
        );

        $response = $this->put("/admins/{$admin->getAttribute('id')}", [
            'name' => 'admin_upd',
            'password' => 'password_upd',
            'password_confirmation' => 'password_upd',
        ]);

        $this->assertEquals(1, Admin::where('name', 'admin_upd')->count());

        $response->assertRedirect('/account');
    }
}
