<?php

namespace App\Repositories;

use App\Contracts\LayoutRepositoryInterface;
use App\Models\Layout;

class LayoutRepository implements LayoutRepositoryInterface
{

    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Layout::all();
    }

    public function getTrashedLayouts()
    {
        return Layout::onlyTrashed()->paginate(10);
    }

    public function getMain(): ?Layout
    {
        return Layout::where('key', 'main')->first();
    }
}
