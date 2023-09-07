<?php

namespace App\Contracts;

interface LayoutRepositoryInterface
{
    public function getAll();

    public function getTrashedLayouts();

    public function getMain();
}
