<?php

namespace Tests\Feature\Admin;

use App\Models\Slide;
use App\Models\Slider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;

class SlidesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_create_slide()
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();
        Storage::fake('public');

        $slider = Slider::factory()->create();
        $data = [
            'slider_id' => $slider->id,
            'title_uk' => 'Title UK',
            'title_en' => 'Title EN',
            'link_url' => '/products',
            'image_webp_mobile' => UploadedFile::fake()->image('1.jpg'),
            'image_jpg_mobile' => UploadedFile::fake()->image('2.jpg'),
            'image_webp_desktop' => UploadedFile::fake()->image('3.jpg'),
            'image_jpg_desktop' => UploadedFile::fake()->image('4.jpg'),
            'image_jpg' => UploadedFile::fake()->image('5.jpg'),
            'order' => 1
        ];

        $response = $this->post(route('admin.slides.store'), $data);
        $slide = Slide::latest()->first();

        $response->assertRedirect(route('admin.slides.show', $slide));
        $response->assertSessionHas('success', 'Slide created successfully.');

        $this->assertNotNull($slide);
        $this->assertEquals($slider->id, $slide->slider_id);
        $this->assertEquals(1, $slide->order);
        $this->assertTranslations([
            'title_uk' => 'Title UK',
            'title_en' => 'Title EN',
        ], Slide::class);
        Storage::assertExists($slide->image);
    }

    /** @test */
    public function admin_can_edit_slide()
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();
        Storage::fake('public');

        $slider = Slider::factory()->create();
        $slide = Slide::factory()->create([
            'slider_id' => $slider->id,
            'order' => 1,
        ]);

        $data = [
            'slider_id' => $slider->id,
            'title_uk' => 'Title UK 1',
            'title_en' => 'Title EN 1',
            'link_url' => '/products',
            'image_webp_mobile' => UploadedFile::fake()->image('1.jpg'),
            'image_jpg_mobile' => UploadedFile::fake()->image('2.jpg'),
            'image_webp_desktop' => UploadedFile::fake()->image('3.jpg'),
            'image_jpg_desktop' => UploadedFile::fake()->image('4.jpg'),
            'image_jpg' => UploadedFile::fake()->image('5.jpg'),
            'order' => 2
        ];

        $response = $this->put(route('admin.slides.update', $slide), $data);
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Slide updated successfully.');

        $slide->refresh();

        $this->assertTranslations([
            'title_uk' => 'Title UK 1',
            'title_en' => 'Title EN 1',
        ], Slide::class);
        $this->assertEquals($slider->id, $slide->slider_id);
        $this->assertEquals(2, $slide->order);

        Storage::assertExists($slide->image);
    }

    /** @test */
    public function admin_can_delete_slide()
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();

        // Create a slide
        $slide = Slide::factory()->for(Slider::factory())->create();

        // Delete the slide
        $response = $this->delete(route('admin.slides.destroy', $slide));

        // Assert that the slide is deleted from the database
        $this->assertDatabaseMissing('slides', ['id' => $slide->id]);

        // Assert that the user is redirected to the sliders index page with a success message
        $response->assertRedirect(route('admin.sliders.index'));
        $response->assertSessionHas('success', 'Slide deleted successfully.');
    }
}
