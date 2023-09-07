<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface TranslatableInterface
{
    public function translations(): MorphMany;
}
