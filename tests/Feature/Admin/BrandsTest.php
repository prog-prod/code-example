<?php

namespace Tests\Feature\Admin;

use App\Models\Brand;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BrandsTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function only_authenticated_users_can_view_brands()
    {
        $response = $this->get(route('admin.brands.index'));

        $response->assertRedirect(route('admin.login'));
    }

    /** @test */
    public function authenticated_users_can_view_brands()
    {
        $this->refreshApplicationWithLocale('en');
        $this->signInAsAdmin();

        $brand = Brand::factory()->create();
        $brand->addTranslations([
            'name_en' => fake()->word,
            'description_en' => fake()->text
        ]);

        $response = $this->get(route('admin.brands.index'));
        $response->assertOk();
        $response->assertSee($brand->key);
    }

    /** @test */
    public function only_authenticated_users_can_create_brands()
    {
        $this->refreshApplicationWithLocale('en');

        $response = $this->post(route('admin.brands.store'), []);

        $response->assertRedirect(route('admin.login'));
    }

    /** @test */
    public function authenticated_users_can_create_brands()
    {
        $this->refreshApplicationWithLocale('en');

        $this->signInAsAdmin();

        $attributes = Brand::factory()->raw();

        $response = $this->post(route('admin.brands.store'), $attributes);

        $this->assertDatabaseHas('brands', $attributes);

        $response->assertRedirect(route('admin.brands.index'));
    }

    /** @test */
    public function key_is_required_to_create_brands()
    {
        $this->refreshApplicationWithLocale('en');

        $this->signInAsAdmin();

        $attributes = Brand::factory()->raw(['key' => '']);

        $response = $this->post(route('admin.brands.store'), $attributes);

        $response->assertSessionHasErrors('key');
    }

    /** @test */
    public function only_authenticated_users_can_edit_brands()
    {
        $this->refreshApplicationWithLocale('en');

        $brand = Brand::factory()->create();

        $response = $this->get(route('admin.brands.edit', $brand));

        $response->assertRedirect(route('admin.login'));
    }

    /** @test */
    public function authenticated_users_can_edit_brands()
    {
        $this->refreshApplicationWithLocale('en');

        $this->signInAsAdmin();

        $brand = Brand::factory()->create();

        $attributes = Brand::factory()->raw();

        $response = $this->put(route('admin.brands.update', $brand), $attributes);

        $this->assertDatabaseHas('brands', $attributes);

        $response->assertRedirect(route('admin.brands.index'));
    }

    /** @test */
    public function key_is_required_to_update_brands()
    {
        $this->refreshApplicationWithLocale('en');

        $this->signInAsAdmin();

        $brand = Brand::factory()->create();

        $attributes = Brand::factory()->raw(['key' => '']);

        $response = $this->put(route('admin.brands.update', $brand), $attributes);

        $response->assertSessionHasErrors('key');
    }

    /** @test */
    public function only_authenticated_users_can_delete_brands()
    {
        $this->refreshApplicationWithLocale('en');

        $brand = Brand::factory()->create();

        $response = $this->delete(route('admin.brands.destroy', $brand));

        $response->assertRedirect(route('admin.login'));
    }

    /** @test */
    public function authenticated_users_can_delete_brands()
    {
        $this->refreshApplicationWithLocale('en');

        $this->signInAsAdmin();

        $brand = Brand::factory()->create();

        $response = $this->delete(route('admin.brands.destroy', $brand));

        $this->assertSoftDeleted('brands', [
            'id' => $brand->id,
        ]);

        $response->assertRedirect(route('admin.brands.index'));
    }
}
