<?php

namespace App\Http\Middleware;

use App\Facades\CartServiceFacade;
use App\Facades\CommonFacade;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'flash' => [
                'error' => fn() => $request->session()->get('error'),
                'success' => fn() => $request->session()->get('success'),
                'message' => fn() => $request->session()->get('message')
            ],
            'auth' => [
                'user' => $request->user() ? new UserResource($request->user()) : null,
            ],
            'settings' => CommonFacade::getSiteSettings(),
            'cart' => CartServiceFacade::getItems(),
            'menu' => CommonFacade::getMenu(),
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
        ]);
    }
}
