<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_redirect_to_login_page_if_user_unauthorized()
    {
        $response = $this->get('/categories');
        $response->assertRedirect('/login');
    }

    public function test_user_can_read_information_about_categories_with_view()
    {
        $response = $this->actingAs(
            Admin::all()->first() ?: Admin::factory()->create()
        )->get('/categories');

        $response->assertViewIs('categories.index');
        $response->assertViewHas('categories');
        $response->assertSuccessful();
    }

    public function test_user_can_read_information_about_category_by_id_with_view()
    {
        $this->seed(CategorySeeder::class);
        $category = Category::all()->first();

        $response = $this->actingAs(
            Admin::all()->first() ?: Admin::factory()->create()
        )->get("/categories/$category->id");

        $response->assertViewIs('categories.show');
        $response->assertViewHas('category');
        $response->assertSuccessful();
    }

    public function test_user_can_edit_information_about_category_by_id_with_view()
    {
        $this->seed(CategorySeeder::class);
        $category = Category::all()->first();

        $response = $this->actingAs(
            Admin::all()->first() ?: Admin::factory()->create()
        )->get("/categories/$category->id/edit");

        $response->assertViewIs('categories.edit');
        $response->assertViewHas('category');
        $response->assertSuccessful();
    }

    public function test_authenticated_users_can_create_a_new_category_with_view()
    {
        $response = $this->actingAs(
            Admin::all()->first() ?: Admin::factory()->create()
        )->get("/categories/create");

        $response->assertViewIs('categories.create');
        $response->assertSuccessful();
    }

    public function test_authenticated_users_can_create_a_new_category()
    {
        $this->actingAs(
            Admin::all()->first() ?: Admin::factory()->create()
        );
        //$category = Category::factory()->create();

        $response = $this->post('/categories', [
            'nameUA' => 'ua-name',
            'nameEN' => 'en-name',
            'nameRU' => 'ru-name',
        ]);
        $this->assertEquals(1, Category::all()->count());

        $response->assertRedirect('/categories');
    }

    public function test_authenticated_users_can_update_category()
    {
        $this->actingAs(
            Admin::all()->first() ?: Admin::factory()->create()
        );
        $category = Category::factory()->create();

        $response = $this->put("/categories/$category->id", [
            'nameUA' => 'ua-name-upd',
            'nameEN' => 'en-name-upd',
            'nameRU' => 'ru-name-upd',
        ]);
        $this->assertEquals('ua-name-upd', Category::all()->first()->getTranslation('name', 'ua'));

        $response->assertRedirect('/categories');
    }

    public function test_user_can_delete_category_by_id()
    {
        $this->seed(CategorySeeder::class);
        $category = Category::all()->first();

        $response = $this->actingAs(
            Admin::all()->first() ?: Admin::factory()->create()
        )->delete("/categories/$category->id");

        $this->assertNull(Category::where('id', $category->id)->first());

        $response->assertRedirect('/categories');
    }
}
