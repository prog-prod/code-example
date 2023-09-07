<?php

namespace Tests\Feature\TestPages;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductPageTest extends TestPage
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     */
    public function test_page_return_ok_status(): void
    {
        $this->withoutExceptionHandling();
        $this->refreshApplicationWithLocale('en');
        $product = Product::factory()
            ->for(Brand::factory())
            ->for(Category::factory())
            ->for(Currency::factory())
            ->create();
        $response = $this->get(route('products.show', $product));

        $response->assertOk();
    }
}
