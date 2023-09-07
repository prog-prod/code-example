<?php

namespace Tests\Feature\Admin;

use App\Models\Slider;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SlidersTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_display_list_of_sliders()
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();
        $sliders = Slider::factory()->count(3)->create();

        $response = $this->get(route('admin.sliders.index'));

        $response->assertOk();
        $response->assertViewIs('admin.sliders.index');
        $response->assertViewHas('sliders', function ($viewSliders) use ($sliders) {
            return $sliders->pluck('id')->diff($viewSliders->pluck('id'))->isEmpty();
        });
    }

    /** @test */
    public function it_can_display_slider_creation_form()
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();
        $response = $this->get(route('admin.sliders.create'));

        $response->assertOk();
        $response->assertViewIs('admin.sliders.create');
    }

    /** @test */
    public function it_can_create_a_slider()
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();
        $data = Slider::factory()->raw();

        $response = $this->post(route('admin.sliders.store'), $data);

        $response->assertRedirect(route('admin.sliders.index'));
        $this->assertDatabaseHas('sliders', $data);
    }

    /** @test */
    public function it_can_display_slider_edit_form()
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();
        $slider = Slider::factory()->create();

        $response = $this->get(route('admin.sliders.edit', $slider));

        $response->assertOk();
        $response->assertViewIs('admin.sliders.edit');
        $response->assertViewHas('slider', $slider);
    }

    /** @test */
    public function it_can_update_a_slider()
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();
        $slider = Slider::factory()->create();
        $data = Slider::factory()->raw();

        $response = $this->put(route('admin.sliders.update', $slider), $data);

        $response->assertRedirect(route('admin.sliders.index'));
        $this->assertDatabaseHas('sliders', array_merge(['id' => $slider->id], $data));
    }

    /** @test */
    public function it_can_delete_a_slider()
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();
        $slider = Slider::factory()->create();

        $response = $this->delete(route('admin.sliders.destroy', $slider));

        $response->assertRedirect(route('admin.sliders.index'));
        $this->assertDatabaseMissing('sliders', ['id' => $slider->id]);
    }

    /** @test */
    public function it_can_display_slider_details()
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();
        $slider = Slider::factory()->create();

        $response = $this->get(route('admin.sliders.show', $slider));

        $response->assertOk();
        $response->assertViewIs('admin.sliders.show');
        $response->assertViewHas('slider', $slider);
    }
}
