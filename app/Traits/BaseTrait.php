<?php

namespace App\Traits;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Collection;

trait BaseTrait
{
    protected Collection $menus;

    public function initMenuItems()
    {
        $this->menus = Menu::with('items')->get();
    }

    public function getBreadcrumbs()
    {
        $breadcrumbs = [
            'home',
        ];

        if (\Request::is('404')) {
            return [];
        } else {
            if (url()->current() !== route('index')) {
                $breadcrumbs[] = url()->current();
            }
        }

        return $breadcrumbs;
    }
}
