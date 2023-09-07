<?php

namespace App\Providers;

use App\Contracts\AdminRepositoryInterface;
use App\Contracts\BrandRepositoryInterface;
use App\Contracts\CartRepositoryInterface;
use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\ComparisonRepositoryInterface;
use App\Contracts\CountryRepositoryInterface;
use App\Contracts\CurrencyRepositoryInterface;
use App\Contracts\CustomerRepositoryInterface;
use App\Contracts\DeliveryRepositoryInterface;
use App\Contracts\FilterRepositoryInterface;
use App\Contracts\LayoutRepositoryInterface;
use App\Contracts\LogsRepositoryInterface;
use App\Contracts\MenuRepositoryInterface;
use App\Contracts\OrderItemRepositoryInterface;
use App\Contracts\OrderRepositoryInterface;
use App\Contracts\PageRepositoryInterface;
use App\Contracts\PaymentMethodRepositoryInterface;
use App\Contracts\PaymentRepositoryInterface;
use App\Contracts\PrintCategoryRepositoryInterface;
use App\Contracts\ProductAdminRepositoryInterface;
use App\Contracts\ProductRepositoryInterface;
use App\Contracts\SettingsRepositoryInterface;
use App\Contracts\SizeRepositoryInterface;
use App\Contracts\SliderRepositoryInterface;
use App\Contracts\SmsTemplateRepositoryInterface;
use App\Contracts\TelegramRepositoryInterface;
use App\Contracts\TransactionRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Contracts\WishlistRepositoryInterface;
use App\Repositories\AdminRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CartRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ComparisonRepository;
use App\Repositories\CountryRepository;
use App\Repositories\CurrencyRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\DeliveryRepository;
use App\Repositories\FilterRepository;
use App\Repositories\LayoutRepository;
use App\Repositories\LogsRepository;
use App\Repositories\MenuRepository;
use App\Repositories\OrderItemRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PageRepository;
use App\Repositories\PaymentMethodRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\PrintCategoryRepository;
use App\Repositories\ProductAdminRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SettingsRepository;
use App\Repositories\SizeRepository;
use App\Repositories\SliderRepository;
use App\Repositories\SmsTemplateRepository;
use App\Repositories\TelegramRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\Repositories\WishListRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Repositories
        $this->app->bind(SettingsRepositoryInterface::class, SettingsRepository::class);
        $this->app->bind(WishlistRepositoryInterface::class, WishListRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(SmsTemplateRepositoryInterface::class, SmsTemplateRepository::class);
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(TelegramRepositoryInterface::class, TelegramRepository::class);
        $this->app->bind(LogsRepositoryInterface::class, LogsRepository::class);
        $this->app->bind(OrderItemRepositoryInterface::class, OrderItemRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(PaymentMethodRepositoryInterface::class, PaymentMethodRepository::class);
        $this->app->bind(DeliveryRepositoryInterface::class, DeliveryRepository::class);
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
        $this->app->bind(BrandRepositoryInterface::class, BrandRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ProductAdminRepositoryInterface::class, ProductAdminRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(FilterRepositoryInterface::class, FilterRepository::class);
        $this->app->bind(SizeRepositoryInterface::class, SizeRepository::class);
        $this->app->bind(MenuRepositoryInterface::class, MenuRepository::class);
        $this->app->bind(SliderRepositoryInterface::class, SliderRepository::class);
        $this->app->bind(PageRepositoryInterface::class, PageRepository::class);
        $this->app->bind(PrintCategoryRepositoryInterface::class, PrintCategoryRepository::class);
        $this->app->bind(LayoutRepositoryInterface::class, LayoutRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ComparisonRepositoryInterface::class, ComparisonRepository::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(CurrencyRepositoryInterface::class, CurrencyRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
