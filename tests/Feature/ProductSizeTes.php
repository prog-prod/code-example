<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Size;
use DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductSizeTes extends TestCase
{
    use RefreshDatabase;

    public function quantityCannotExceedAvailableStock()
    {
        // Create a product with a stock quantity of 10
        $product = Product::factory()->create([
            'quantity' => 10
        ]);

        // Create a size for the product
        $size = Size::factory()->create();

        // Attempt to insert a product_size row with a quantity of 20
        $this->expectException(\Illuminate\Database\QueryException::class);
        $this->expectExceptionMessage('Quantity exceeds available stock');

        DB::table('product_size')->insert([
            'product_id' => $product->id,
            'size_id' => $size->id,
            'quantity' => 20
        ]);
    }
}
