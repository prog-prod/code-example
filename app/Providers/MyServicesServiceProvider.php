<?php

namespace App\Providers;

use App\Contracts\CartServiceInterface;
use App\Contracts\ComparisonsServiceInterface;
use App\Contracts\CustomerServiceInterface;
use App\Contracts\DeliveryServiceInterface;
use App\Contracts\LayoutServiceInterface;
use App\Contracts\LogServiceInterface;
use App\Contracts\MonobankServiceInterface;
use App\Contracts\NovaPoshtaServiceInterface;
use App\Contracts\OrderServiceInterface;
use App\Contracts\PaymentServiceInterface;
use App\Contracts\PhoneConfirmationServiceInterface;
use App\Contracts\ProductFilterInterface;
use App\Contracts\ProductServiceInterface;
use App\Contracts\SettingsServiceInterface;
use App\Contracts\SMSServiceInterface;
use App\Contracts\TelegramServiceInterface;
use App\Contracts\TransliteratorServiceInterface;
use App\Contracts\UserServiceInterface;
use App\Contracts\WishlistServiceInterface;
use App\Services\CartService;
use App\Services\ComparisonsService;
use App\Services\CustomerService;
use App\Services\DeliveryService;
use App\Services\FilterService;
use App\Services\LayoutService;
use App\Services\LogService;
use App\Services\MonobankService;
use App\Services\NovaPoshtaService;
use App\Services\OrderService;
use App\Services\PaymentService;
use App\Services\PhoneConfirmationService;
use App\Services\ProductService;
use App\Services\SettingsService;
use App\Services\SMSService;
use App\Services\TelegramService;
use App\Services\TransliteratorService;
use App\Services\UserService;
use App\Services\WishlistService;
use Illuminate\Support\ServiceProvider;

class MyServicesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Services
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(SettingsServiceInterface::class, SettingsService::class);
        $this->app->bind(TransliteratorServiceInterface::class, TransliteratorService::class);
        $this->app->bind(TelegramServiceInterface::class, TelegramService::class);
        $this->app->bind(OrderServiceInterface::class, OrderService::class);
        $this->app->bind(LogServiceInterface::class, LogService::class);
        $this->app->bind(PhoneConfirmationServiceInterface::class, PhoneConfirmationService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(PaymentServiceInterface::class, PaymentService::class);
        $this->app->bind(DeliveryServiceInterface::class, DeliveryService::class);
        $this->app->bind(ProductFilterInterface::class, FilterService::class);
        $this->app->bind(CartServiceInterface::class, CartService::class);
        $this->app->bind(LayoutServiceInterface::class, LayoutService::class);
        $this->app->bind(LayoutServiceInterface::class, LayoutService::class);
        $this->app->bind(NovaPoshtaServiceInterface::class, NovaPoshtaService::class);
        $this->app->bind(MonobankServiceInterface::class, MonobankService::class);
        $this->app->bind(SMSServiceInterface::class, SMSService::class);
        $this->app->bind(WishlistServiceInterface::class, WishlistService::class);
        $this->app->bind(ComparisonsServiceInterface::class, ComparisonsService::class);
        $this->app->bind(CustomerServiceInterface::class, CustomerService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
