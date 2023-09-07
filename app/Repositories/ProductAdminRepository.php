<?php

namespace App\Repositories;

use App\Contracts\ProductAdminRepositoryInterface;
use App\Http\Controllers\Admin\Traits\ProductTrait;
use App\Models\Product;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProductAdminRepository implements ProductAdminRepositoryInterface
{
    use ProductTrait;

    public function getAllGroupedProducts()
    {
        return $this->productBuilder()->where('main', 1)->orWhereIn(
            'id',
            function ($query) {
                $query->select(DB::raw('MAX(id) as id'))->from('products')->groupBy('key')->havingRaw(
                    'MAX(`main`) = 0'
                )->whereNull(
                    'deleted_at'
                );
            }
        )->latest()->get();
    }

    public function getProductsByGroup(string $key)
    {
        return $this->productBuilder()->where('key', $key)->latest();
    }

    public function getProductById(string $id)
    {
        return $this->productBuilder()->whereId($id)->orWhere('slug', $id)->first();
    }

    public function getProductByIdFail(string $id
    ): Model|Collection|Builder|array|null {
        return $this->productBuilder()->findOrFail($id);
    }


    public function getSimilarProductColors(Product $product): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->productBuilder()->where('key', $product->key)
            ->where('size_id', $product->size?->id)->get();
    }

    public function getSimilarProductSizes(Product $product): \Illuminate\Support\Collection
    {
        if (!$product->color) {
            return collect([]);
        }
        return $this->productBuilder()->where('key', $product->key)->where('color_id', $product->color->id)->get();
    }

    public function countProductsInGroup(string $key): int
    {
        return $this->productBuilder(false)->where('key', $key)->count();
    }

    public function updateProductGroup(string $key, array $data, Product $product): int
    {
        return $this->productBuilder(false)->where('key', $key)->where('id', '!=', $product->id)->update($data);
    }
}
