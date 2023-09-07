<?php

namespace App\Repositories;

use App\Contracts\ComparisonRepositoryInterface;
use App\Models\Category;
use App\Models\Comparison;
use App\Models\User;
use Illuminate\Auth\Authenticatable;

class ComparisonRepository implements ComparisonRepositoryInterface
{

    public function createComparison(array $data): void
    {
        Comparison::create($data);
    }

    public function getCategories(User|Authenticatable|null $user)
    {
        return Category::whereIn('id', function ($query) use ($user) {
            $query->select('category_id')
                ->from('comparisons')
                ->where('user_id', optional($user)->id);
        })->get();
    }
}
