<?php

namespace App\Http\Middleware;

use App\Facades\CurrencyFacade;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MultiplyPriceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $filters = $request->input('filters', []);
        if (isset($filters['price']['from'])) {
            $filters['price']['from'] = CurrencyFacade::moneyDecorator($filters['price']['from'] * 100);
            $request->merge(['filters' => $filters]);
        }
        if (isset($filters['price']['to'])) {
            $filters['price']['to'] = CurrencyFacade::moneyDecorator($filters['price']['to'] * 100);
            $request->merge(['filters' => $filters]);
        }
        return $next($request);
    }
}
