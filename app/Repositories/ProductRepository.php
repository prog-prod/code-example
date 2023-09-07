<?php

namespace App\Repositories;

use App\Contracts\ProductRepositoryInterface;
use App\Models\Category;
use App\Models\PrintCategory;
use App\Models\Product;
use DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProductRepository implements ProductRepositoryInterface
{

    public function getProductCollection(): Collection|array
    {
        return Product::globalWith()->limit(
            10
        )->get();
    }

    public function getProductForBestDeal()
    {
        return $this->getProductsForBestDeal()->first();
    }

    public function getProductsForBestDeal(): Collection|array
    {
        return Product::globalWith()->whereHas(
            'sales',
            function ($query) {
                return $query->whereRaw(
                    "30 <= sales.percent AND sales.percent <= 100"
                );
            }
        )->get();
    }


    public function getAllProducts()
    {
        return Product::globalWith()->filtered()->sorted()->globalPaginate();
    }

    public function getProductsWithSale(): Collection
    {
        return Product::globalWith()->whereHas('sales')->get();
    }

    public function getMinMaxPrices(Category $category = null
    ): Model {
        $query = Product::query();
        if ($category) {
            $query->whereBelongsTo($category);
        }

        return $query
            ->select(DB::raw('MAX(price) AS max_price'), DB::raw('MIN(price) AS min_price'))
            ->first();
    }

    public function getProductsOfCategory(Category $category)
    {
        $categories = $category->children->pluck('id');
        return Product::query()->whereIn('category_id', [$category->id, ...$categories])
            ->globalWith()
            ->filtered()
            ->sorted()
            ->globalPaginate();
    }

    public function getBestCollections(): Collection|array
    {
        return Product::query()->whereHas('reviews', function ($q) {
            $q->select('product_id', \DB::raw('AVG(rating) as avg_rating'))
                ->groupBy('product_id')
                ->having('avg_rating', '>=', 3);
        })->get();
    }

    public function getProductsByPrintCategory(PrintCategory $printCategory)
    {
        return Product::globalWith()->whereIn('id', function ($query) use ($printCategory) {
            $query->select('product_id')
                ->from('print_image_product')
                ->whereIn('print_image_id', function ($query) use ($printCategory) {
                    $query->select('id')
                        ->from('print_images')
                        ->where('print_category_id', $printCategory->id);
                });
        })->filtered()->sorted()->globalPaginate();
    }

    public function getProductsWithSimilarPrint(Product $product): Collection|array
    {
        return Product::globalWith()->whereHas('prints', function ($q) use ($product) {
            $q->whereIn('print_images.id', $product->prints->pluck('id')->toArray());
        })->where('products.id', '!=', $product->id)->limit(10)->where('main', 1)->orderBy('id')->get();
    }

    public function getAllMainProducts(): LengthAwarePaginator
    {
        return Product::globalWith()->where('main', 1)->latest()->paginate(25);
    }

    public function getProductsById(array $ids): Collection|array
    {
        return Product::query()->whereIn('id', $ids)->get();
    }
}
