<?php

namespace Tests\Feature\Admin;

use App\Models\PrintCategory;
use App\Models\PrintImage;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;

class PrintsTest extends TestCase
{
    use DatabaseTransactions;

    public function testAdminCanViewAllPrints()
    {
        $this->signInAsAdmin();
        $response = $this->get(route('admin.prints.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.prints.index');
    }

    public function testAdminCanViewCreatePrintPage()
    {
        $this->signInAsAdmin();

        $response = $this->get(route('admin.prints.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.prints.create');
    }

    public function testAdminCanCreateNewPrint()
    {
        $this->signInAsAdmin();

        Storage::fake('public');

        $category = PrintCategory::factory()->create();
        $key = fake()->unique()->word;

        $data = [
            'key' => $key,
            'print_category_id' => $category->id,
            'image' => UploadedFile::fake()->image('test-image.jpg'),
        ];

        $response = $this->post(route('admin.prints.store'), $data);
        $response->assertRedirect(route('admin.prints.show', PrintImage::first()));
        $this->assertDatabaseHas('print_images', [
            'key' => $key,
            'print_category_id' => $category->id,
        ]);
        Storage::assertExists('public/prints/' . $data['image']->hashName());
    }

    public function testAdminCanViewPrintDetails()
    {
        $this->signInAsAdmin();

        $category = PrintCategory::factory()->create();

        $print = PrintImage::factory()->create([
            'print_category_id' => $category->id,
        ]);

        $response = $this->get(route('admin.prints.show', $print));

        $response->assertStatus(200);
        $response->assertViewIs('admin.prints.show');
    }

    public function testAdminCanViewEditPrintPage()
    {
        $this->signInAsAdmin();

        $category = PrintCategory::factory()->create();

        $print = PrintImage::factory()->create([
            'print_category_id' => $category->id,
        ]);

        $response = $this->get(route('admin.prints.edit', $print));

        $response->assertStatus(200);
        $response->assertViewIs('admin.prints.edit');
        $response->assertSee($print->key);
        $response->assertSee($print->category->key);
    }

    public function testAdminCanUpdateExistingPrint()
    {
        $this->signInAsAdmin();

        Storage::fake('public');

        $category = PrintCategory::factory()->create();

        $print = PrintImage::factory()->create([
            'print_category_id' => $category->id,
        ]);

        $data = [
            'key' => 'updated-print',
            'print_category_id' => $category->id,
            'image' => UploadedFile::fake()->image('updated-image.jpg'),
        ];

        $response = $this->put(route('admin.prints.update', $print), $data);

        $response->assertRedirect(route('admin.prints.show', $print));
        $this->assertDatabaseHas('print_images', [
            'id' => $print->id,
            'key' => 'updated-print',
            'print_category_id' => $category->id,
        ]);
        Storage::assertExists('public/prints/' . $data['image']->hashName());
        Storage::assertMissing('public/prints/' . $print->image);
    }

    public function testAdminCanDeleteExistingPrint()
    {
        $this->signInAsAdmin();
        // Create a print image and a print category
        $printCategory = PrintCategory::factory()->create();
        $print = PrintImage::factory()->create(['print_category_id' => $printCategory->id]);

        // Delete the print image
        $response = $this->delete(route('admin.prints.destroy', $print->id));

        // Assert that the print image was deleted
        $response->assertRedirect(route('admin.prints.index'));
        $this->assertSoftDeleted('print_images', ['id' => $print->id]);
    }
}
