<?php

namespace App\Http\Middleware;

use App\Facades\LocaleFacade;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Localization
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
        if (!session()->has('locale')) {
            $locale = LocaleFacade::getFallbackLocale();
            session('locale', $locale);
        }
        return $next($request);
    }
}
