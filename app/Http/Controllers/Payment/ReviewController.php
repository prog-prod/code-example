<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\BaseController;

class ReviewController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->showView('Payment/Review');
    }
}
