<?php

namespace Tests\Feature\Admin;

use App\Models\Sale;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SalesTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function admin_can_view_all_sales()
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();
        // Arrange
        Sale::factory()->count(15)->create();

        // Act
        $response = $this->get(route('admin.sales.index'));

        // Assert
        $response->assertOk();
        $response->assertViewIs('admin.sales.index');
        $response->assertViewHas('sales', function ($sales) {
            return $sales->count() === 10;
        });
    }

    /** @test */
    public function admin_can_create_a_sale()
    {
        $this->withoutExceptionHandling();

        $this->signInAsAdmin();

        // Arrange
        $data = Sale::factory()->raw();

        // Act
        $response = $this->post(route('admin.sales.store'), $data);

        // Assert
        $response->assertRedirect(route('admin.sales.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('sales', $data);
    }

    /** @test */
    public function admin_can_view_a_sale()
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();

        // Arrange
        $sale = Sale::factory()->create();

        // Act
        $response = $this->get(route('admin.sales.show', $sale));

        // Assert
        $response->assertOk();
        $response->assertViewIs('admin.sales.show');
        $response->assertViewHas('sale', $sale);
    }

    /** @test */
    public function admin_can_update_a_sale()
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();

        // Arrange
        $sale = Sale::factory()->create();
        $data = Sale::factory()->raw();

        // Act
        $response = $this->put(route('admin.sales.update', $sale), $data);

        // Assert
        $response->assertRedirect(route('admin.sales.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('sales', $data);
    }

    /** @test */
    public function admin_can_delete_a_sale()
    {
        $this->withoutExceptionHandling();
        $this->signInAsAdmin();

        // Arrange
        $sale = Sale::factory()->create();

        // Act
        $response = $this->delete(route('admin.sales.destroy', $sale));

        // Assert
        $response->assertRedirect(route('admin.sales.index'));
        $response->assertSessionHas('success');

        $this->assertSoftDeleted('sales', [
            'id' => $sale->id,
        ]);
    }
}
