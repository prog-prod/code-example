<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PolicyController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return $this->showView('Policy');
    }
}
