<?php

namespace App\Contracts;

interface ProductFilterInterface
{
    public function getFilters(?FiltersRelationInterface $category = null);
}
