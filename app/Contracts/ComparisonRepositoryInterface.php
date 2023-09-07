<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Auth\Authenticatable;

interface ComparisonRepositoryInterface
{
    public function createComparison(array $data): void;

    public function getCategories(User|Authenticatable|null $user);
}
