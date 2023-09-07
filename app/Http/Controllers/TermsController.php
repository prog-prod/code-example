<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return $this->showView('Terms');
    }
}
