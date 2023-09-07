<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\Size;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SizesTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function admin_can_create_a_size()
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();
        $sizeData = Size::factory()->for(Category::factory())->raw();

        $response = $this->post(route('admin.sizes.store'), $sizeData);

        $response->assertRedirect(route('admin.sizes.index'))
            ->assertSessionHas('success', 'Size created successfully');

        $this->assertDatabaseHas('sizes', $sizeData);
    }

    /** @test */
    public function admin_can_edit_a_size()
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();
        $size = Size::factory()->for(Category::factory())->create();

        $newSizeData = Size::factory()->state([
            'category_id' => $size->category->id
        ])->raw();

        $response = $this->put(route('admin.sizes.update', $size), $newSizeData);

        $response->assertRedirect(route('admin.sizes.index'))
            ->assertSessionHas('success', 'Size updated successfully');

        $this->assertDatabaseHas('sizes', $newSizeData);
        $this->assertDatabaseMissing('sizes', [
            'value' => $size->value
        ]);
    }

    /** @test */
    public function admin_can_delete_a_size()
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();
        $size = Size::factory()->for(Category::factory())->create();

        $response = $this->delete(route('admin.sizes.destroy', $size));

        $response->assertRedirect(route('admin.sizes.index'))
            ->assertSessionHas('success', 'Size deleted successfully');

        $this->assertSoftDeleted('sizes', [
            'id' => $size->id
        ]);
    }

    /** @test */
    public function admin_can_see_a_sizes_page()
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();
        $size = Size::factory()->for(Category::factory())->create();

        $response = $this->get(route('admin.sizes.index'));

        $response->assertViewIs('admin.sizes.index');

        $response->assertSee($size->value);
    }

    /** @test */
    public function user_cant_see_a_sizes_page()
    {
        $user = User::factory()->create();
        $this->signIn($user);
        $response = $this->get('/admin/sizes');

        $response->assertRedirect(route('admin.login'));
    }
}
