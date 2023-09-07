<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface FiltersRelationInterface
{
    public function filters(): BelongsToMany;
}
