<?php

namespace Tests\Feature;

use App\Facades\SaleFacade;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SalesTes extends TestCase
{
    use RefreshDatabase;

    /**
     * Test adding a sale with a discount greater than or equal to the product price should fail.
     *
     * @return void
     */
    public function addingSaleWithInvalidDiscount()
    {
        // Create a category
        $category = Category::factory()->create();

        // Create a product
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'price' => 100,
        ]);

        // Attempt to add a sale with an invalid discount
        $data = [
            'user_id' => 1,
            'product_id' => $product->id,
            'quantity' => 1,
            'discount' => 100,
            'percent' => SaleFacade::getPercent($product->price, 100),
            'endDate' => '2023-03-31 23:59:59',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $this->expectException(\Illuminate\Database\QueryException::class);
        Sale::create($data);
        $this->assertDatabaseMissing('sales', $data);
    }

    /**
     * Test adding a sale with a valid discount should succeed.
     *
     * @return void
     */
    public function addingSaleWithValidDiscount()
    {
        // Create a category
        $category = Category::factory()->create();
        $user = User::factory()->create();

        // Create a product
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'price' => 100,
        ]);

        // Add a sale with a valid discount
        $data = [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'discount' => 50,
            'percent' => SaleFacade::getPercent($product->price, 50),
            'endDate' => '2023-03-31 23:59:59',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        Sale::create($data);

        $this->assertDatabaseHas('sales', $data);
    }
}
