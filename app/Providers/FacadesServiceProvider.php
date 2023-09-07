<?php

namespace App\Providers;

use App\Services\CartService;
use App\Services\CommonService;
use App\Services\ComparisonsService;
use App\Services\CurrencyService;
use App\Services\HelperService;
use App\Services\HeroSliderService;
use App\Services\InstagramService;
use App\Services\LayoutService;
use App\Services\LocaleService;
use App\Services\LogService;
use App\Services\MonobankService;
use App\Services\OrderService;
use App\Services\PhoneConfirmationService;
use App\Services\SaleService;
use App\Services\TelegramService;
use App\Services\WishlistService;
use Illuminate\Support\ServiceProvider;

class FacadesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Facades
        $this->app->bind('monobank', MonobankService::class);
        $this->app->bind('helper', HelperService::class);
        $this->app->bind('telegram', TelegramService::class);
        $this->app->bind('logService', LogService::class);
        $this->app->bind('instagram', InstagramService::class);
        $this->app->bind('order', OrderService::class);
        $this->app->bind('cart', CartService::class);
        $this->app->bind('slider', HeroSliderService::class);
        $this->app->bind('layout', LayoutService::class);
        $this->app->bind('helper', HelperService::class);
        $this->app->bind('phoneConfirmation', PhoneConfirmationService::class);
        $this->app->bind('wishlist', WishlistService::class);
        $this->app->bind('comparisons', ComparisonsService::class);
        $this->app->bind('sale', SaleService::class);
        $this->app->singleton('locale', LocaleService::class);
        $this->app->singleton('common', CommonService::class);
        $this->app->singleton('currency', CurrencyService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
