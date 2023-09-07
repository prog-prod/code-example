<?php

namespace App\Http\Middleware;

use App\Facades\CurrencyFacade;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetCurrency
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('currency')) {
            $currency = CurrencyFacade::getFallbackCurrency();
            CurrencyFacade::setCurrency($currency);
        } else {
            CurrencyFacade::setCurrency(session('currency'), rewriteSession: false);
        }

        return $next($request);
    }
}
