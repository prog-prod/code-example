<?php

namespace App\Http\Controllers\ComingSoon;

use App\Http\Controllers\BaseController;

class ComingSoonController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->showView('ComingSoon');
    }
}
