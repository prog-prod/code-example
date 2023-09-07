<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\BaseController;

class DashboardController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->showView('Profile/Dashboard');
    }
}
