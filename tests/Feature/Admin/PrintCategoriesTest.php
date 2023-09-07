<?php

namespace Tests\Feature\Admin;

use App\Models\PrintCategory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;

class PrintCategoriesTest extends TestCase
{
    use WithFaker, DatabaseTransactions;

    /** @test */
    public function admin_can_view_all_print_categories()
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();

        $printCategory1 = PrintCategory::factory()->create();
        $printCategory2 = PrintCategory::factory()->create();

        $response = $this->get(route('admin.print-categories.index'))
            ->assertOk()
            ->assertViewIs('admin.print-categories.index')
            ->assertSee($printCategory1->key)
            ->assertSee($printCategory2->key);
    }

    /** @test */
    public function admin_can_view_the_create_print_category_page()
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();

        $response = $this->get(route('admin.print-categories.create'))
            ->assertOk()
            ->assertViewIs('admin.print-categories.create');
    }

    /** @test */
    public function admin_can_create_a_new_print_category()
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();

        Storage::fake('public');
        $image = UploadedFile::fake()->image('category.jpg');

        $printCategoryData = [
            'key' => $this->faker->unique()->word(),
            'parent_id' => null,
            'image' => $image,
            'name_en' => 'Print category name',
            'name_uk' => 'Print category name 1',
        ];

        $response = $this->post(route('admin.print-categories.store'), $printCategoryData)
            ->assertRedirect(route('admin.print-categories.index'))
            ->assertSessionHas('success', 'Print category created successfully.');

        $this->assertTranslations([
            'name_en' => 'Print category name',
            'name_uk' => 'Print category name 1'
        ], PrintCategory::class);

        $this->assertDatabaseHas('print_categories', ['key' => $printCategoryData['key']]);
        Storage::assertExists('public/prints/categories/' . $image->hashName());
    }

    /** @test */
    public function admin_can_view_the_edit_print_category_page()
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();

        $printCategory = PrintCategory::factory()->create();

        $response = $this->get(route('admin.print-categories.edit', $printCategory))
            ->assertOk()
            ->assertViewIs('admin.print-categories.edit')
            ->assertSee($printCategory->key);
    }

    /**
     * @test
     */
    public function admin_can_update_an_existing_print_category()
    {
        $this->signInAsAdmin();

        // Create a print category
        $printCategory = PrintCategory::factory()->create([
            'key' => 'old_key',
            'parent_id' => null,
            'image' => 'old/image/path.jpg',
        ]);
        $printCategory->addTranslations([
            'name_uk' => 'Принт категорія old',
            'name_en' => 'Print category old'
        ]);
        // Define the new data for the print category
        $newData = [
            'key' => 'new_key',
            'parent_id' => null,
            'image' => UploadedFile::fake()->image('new_image.jpg'),
            'name_uk' => 'Принт категорія new',
            'name_en' => 'Print category new'
        ];

        // Make a PUT request to update the print category
        $response = $this->put(route('admin.print-categories.update', $printCategory), $newData);

        // Assert that the response is a redirect to the index page
        $response->assertRedirect(route('admin.print-categories.index'));

        // Assert that the print category was updated in the database
        $this->assertDatabaseHas('print_categories', [
            'id' => $printCategory->id,
            'key' => $newData['key'],
            'parent_id' => $newData['parent_id'],
            'image' => 'public/prints/categories/' . $newData['image']->hashName(),
        ]);

        $this->assertTranslations([
            'name_uk' => 'Принт категорія new',
            'name_en' => 'Print category new'
        ], PrintCategory::class);
        // Assert that the old image file was deleted
        Storage::missing('public/prints/categories/' . $printCategory->image);

        // Assert that the new image file was uploaded
        Storage::assertExists('public/prints/categories/' . $newData['image']->hashName());
    }


    /**
     * @test
     */
    public function admin_can_delete_an_existing_print_category()
    {
        $this->signInAsAdmin();

        // Create a print category
        $printCategory = PrintCategory::factory()->create([
            'key' => 'delete_key',
            'parent_id' => null,
            'image' => 'image/path.jpg',
        ]);
        $printCategory->addTranslations([
            'name_uk' => 'Принт категорія',
            'name_en' => 'Print category'
        ]);

        // Make a PUT request to update the print category
        $response = $this->delete(route('admin.print-categories.destroy', $printCategory));
        $response->assertRedirect(route('admin.print-categories.index'));
        $response->assertSessionHas('success');
        $this->assertNull(PrintCategory::find($printCategory->id));
    }

    /**
     * @test
     */
    public function user_cant_view_print_category()
    {
        $printCategory = PrintCategory::factory()->create([
            'key' => 'test_key',
            'parent_id' => null,
            'image' => 'image/path.jpg',
        ]);

        $response = $this->get(route('admin.print-categories.index'));
        $response->assertRedirect('/admin/login');
    }
}
