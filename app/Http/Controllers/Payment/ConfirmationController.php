<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\BaseController;

class ConfirmationController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->showView('Payment/Confirmation');
    }
}
