<?php

namespace App\Repositories;

use App\Contracts\MenuRepositoryInterface;
use App\Models\Menu;

class MenuRepository implements MenuRepositoryInterface
{
    public function getMainMenu(): Menu|null
    {
        return Menu::with([
            'items' => function ($q) {
                $q->with('children')->whereNull('parent_id');
            }
        ])
            ->where('name', '=', 'main')
            ->first();
    }
}
