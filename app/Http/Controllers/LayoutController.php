<?php

namespace App\Http\Controllers;

use App\Facades\CurrencyFacade;
use Illuminate\Http\Request;

class LayoutController extends BaseController
{

    public function switchCurrency(Request $request)
    {
        $currency = $request->get('currency');

        if (!in_array($currency, CurrencyFacade::getCurrencies())) {
            abort(400);
        }
        CurrencyFacade::setCurrency($currency);
    }
}
