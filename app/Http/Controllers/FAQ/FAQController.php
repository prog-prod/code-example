<?php

namespace App\Http\Controllers\FAQ;

use App\Http\Controllers\BaseController;

class FAQController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->showView('Faq');
    }
}
