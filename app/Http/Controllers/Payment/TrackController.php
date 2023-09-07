<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\BaseController;

class TrackController extends BaseController
{
    protected string $pageTitle = 'track';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->showView('Payment/Track');
    }
}
