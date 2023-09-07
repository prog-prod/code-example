<?php

namespace App\Http\Controllers\Admin\Traits;

use App\Models\Product;

trait ProductTrait
{
    protected function productBuilder($globalWith = true): \Illuminate\Database\Eloquent\Builder
    {
        $query = Product::query();
        if ($globalWith) {
            $query->globalWith();
        }
        return $query->withoutGlobalScope('active');
    }
}
