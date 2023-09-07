<?php

namespace App\DTO;

use App\Http\Resources\MenuResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MenuDTO
{
    public ?AnonymousResourceCollection $items;
    public ?MenuResource $menu;

    public function __construct(?AnonymousResourceCollection $items, ?MenuResource $menu)
    {
        $this->items = $items;
        $this->menu = $menu;
    }
}
