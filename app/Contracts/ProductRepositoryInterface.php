<?php

namespace App\Contracts;

use App\Models\Category;
use App\Models\Product;

interface ProductRepositoryInterface
{
    public function getProductCollection();

    public function getProductForBestDeal();

    public function getAllProducts();

    public function getAllMainProducts();

    public function getProductsWithSale();

    public function getBestCollections();

    public function getMinMaxPrices();

    public function getProductsOfCategory(Category $category);

    public function getProductsWithSimilarPrint(Product $product);

    public function getProductsById(array $ids);

}
