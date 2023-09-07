<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;

class CategoriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_create_a_category()
    {
        $this->signInAsAdmin();

        Storage::fake('public');
        $image = UploadedFile::fake()->image('category.jpg');

        $translations = [
            'name_uk' => 'Нова категорія',
            'name_en' => 'New Category',
            'description_uk' => 'Опис нової категорії',
            'description_en' => 'Description of New Category',
        ];

        $response = $this->post('/admin/categories', [
            'key' => 'new-category',
            'image' => $image,
            ...$translations
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('categories', [
            'key' => 'new-category',
            'parent_id' => null,
        ]);

        $this->assertDatabaseHas('categories', [
            'key' => 'new-category'
        ]);

        $this->assertTranslations($translations, Category::class);
        Storage::assertExists(Category::where('key', 'new-category')->first()->image);
    }

    /** @test */
    public function admin_can_update_a_category()
    {
        $this->signInAsAdmin();
        $category = Category::factory()->create();
        $category->addTranslations([
            'name_uk' => 'Нова категорія',
            'name_en' => 'New Category',
            'description_uk' => 'Опис нової категорії',
            'description_en' => 'Description of New Category',
        ]);

        Storage::fake('public');
        $image = UploadedFile::fake()->image('category.jpg');

        $translations = [
            'name_uk' => 'Оновлена категорія',
            'name_en' => 'Updated Category',
            'description_uk' => 'Опис оновленої категорії',
            'description_en' => 'Description of Updated Category',
        ];

        $response = $this->put("/admin/categories/{$category->key}", [
            'key' => 'updated-category',
            'image' => $image,
            ...$translations
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('categories', [
            'key' => 'updated-category',
            'parent_id' => null,
        ]);
        $this->assertTranslations($translations, Category::class);

        Storage::assertExists(Category::where('key', 'updated-category')->first()->image);
    }

    /** @test */
    public function admin_can_delete_a_category()
    {
        $this->signInAsAdmin();
        $category = Category::factory()->create();

        $response = $this->delete("/admin/categories/{$category->key}");

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertSoftDeleted('categories', [
            'id' => $category->id,
        ]);
    }

    public function test_admin_can_view_categories()
    {
        // Create a test admin user
        $this->signInAsAdmin();

        // Make a GET request to the admin categories index page
        $response = $this->get(route('admin.categories.index'));

        // Assert that the response has a successful status code
        $response->assertStatus(200);

        // Assert that the response view has the categories variable
        $response->assertViewHas('categories');
    }

    public function test_admin_can_view_category()
    {
        // Create an admin user and authenticate them
        $this->signInAsAdmin();

        // Create a category and make a GET request to the category view page
        $category = Category::factory()->create();
        $response = $this->get(route('admin.categories.show', $category));

        // Assert that the response has a successful status code and contains the category name
        $response->assertStatus(200);
        $response->assertSee($category->name);
    }

    public function test_user_can_not_view_categories()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/admin/categories');

        $response->assertRedirect('/admin/login');
    }
}
