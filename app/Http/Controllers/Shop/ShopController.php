<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\BaseController;

class ShopController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->showView('Shop/Shop');
    }

}
