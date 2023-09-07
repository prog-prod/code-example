<?php

namespace Tests\Feature\Admin;

use App\Models\Filter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FiltersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test filters index page.
     *
     * @return void
     */
    public function testAdminCanSeeIndexPage(): void
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();
        $filters = Filter::factory()->count(3)->create();

        $response = $this->get(route('admin.filters.index'));

        $response->assertOk();

        foreach ($filters as $filter) {
            $response->assertSee($filter->name);
        }
    }

    /**
     * Test create filter page.
     *
     * @return void
     */
    public function testAdminCanSeeCreatePage(): void
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();
        $response = $this->get(route('admin.filters.create'));

        $response->assertOk()
            ->assertSee('Create Filter');
    }

    /**
     * Test store filter.
     *
     * @return void
     */
    public function testAdminStoreFilter(): void
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();
        $data = [
            'key' => 'test-filter',
        ];

        $response = $this->post(route('admin.filters.store'), $data);

        $response->assertRedirect(route('admin.filters.index'))
            ->assertSessionHas('success', 'Filter created successfully!');

        $this->assertDatabaseHas('filters', $data);
    }

    /**
     * Test edit filter page.
     *
     * @return void
     */
    public function testAdminCanSeeEditPage(): void
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();
        $filter = Filter::factory()->create();

        $response = $this->get(route('admin.filters.edit', $filter));

        $response->assertOk()
            ->assertSee('Edit Filter')
            ->assertSee($filter->name);
    }

    /**
     * Test update filter.
     *
     * @return void
     */
    public function testAdminCanUpdateFilter(): void
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();
        $filter = Filter::factory()->create();

        $data = [
            'key' => 'updated-filter',
        ];

        $response = $this->put(route('admin.filters.update', $filter), $data);

        $response->assertRedirect(route('admin.filters.index'))
            ->assertSessionHas('success', 'Filter updated successfully!');

        $this->assertDatabaseHas('filters', $data);
    }

    /**
     * Test delete filter.
     *
     * @return void
     */
    public function testAdminCanDestroyFilter(): void
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();
        $filter = Filter::factory()->create();

        $response = $this->delete(route('admin.filters.destroy', $filter));

        $response->assertRedirect(route('admin.filters.index'))
            ->assertSessionHas('success', 'Filter deleted successfully!');

        $this->assertDatabaseMissing('filters', ['id' => $filter->id]);
    }

    public function test_store_method_validates_required_fields()
    {
        $this->signInAsAdmin();

        $attributes = Filter::factory()->raw(['key' => '']);

        $response = $this->post(route('admin.filters.store'), $attributes);
        $response->assertStatus(302); // Check that the response is a redirect

        $response->assertSessionHasErrors('key'); // Check that the 'name' field has an error
    }
}
