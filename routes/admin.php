<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\FilterController;
use App\Http\Controllers\Admin\LayoutController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\SmsTemplateController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\Trash\BrandTrashController;
use App\Http\Controllers\Admin\Trash\CategoryTrashController;
use App\Http\Controllers\Admin\Trash\ColorTrashController;
use App\Http\Controllers\Admin\Trash\CustomerTrashController;
use App\Http\Controllers\Admin\Trash\OrderTrashController;
use App\Http\Controllers\Admin\Trash\PrintCategoryTrashController;
use App\Http\Controllers\Admin\Trash\PrintImageTrashController;
use App\Http\Controllers\Admin\Trash\ProductTrashController;
use App\Http\Controllers\Admin\Trash\ReviewTrashController;
use App\Http\Controllers\Admin\Trash\SaleTrashController;
use App\Http\Controllers\Admin\Trash\SizeTrashController;
use App\Http\Controllers\Admin\Trash\UserTrashController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->group(function () {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login_process');
});
Route::middleware('auth_admin:admin')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class);
    Route::group(['as' => 'products.', 'prefix' => 'products', 'controller' => ProductController::class], function () {
        Route::get('/group/{key}', 'group')->name('group');
        Route::delete('/group/{key}', 'destroyGroup')->name('destroy-group');
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/create', 'create')->name('create');
        Route::get('/{product}', 'show')->name('show');
        Route::put('/{product}', 'update')->name('update');
        Route::delete('/{product}', 'destroy')->name('destroy');
        Route::get('/{product}/edit', 'edit')->name('edit');
    });
    Route::resource('categories', CategoryController::class);
    Route::resource('sizes', SizeController::class);
    Route::resource('sales', SaleController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('layouts', LayoutController::class);
    Route::resource('filters', FilterController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('deliveries', DeliveryController::class);
    Route::resource('payment-methods', PaymentMethodController::class)->except('show');
    Route::resource('payments', PaymentController::class);
    Route::resource('sms-templates', SmsTemplateController::class);

    Route::group(['as' => 'payments.', 'prefix' => 'payments', 'controller' => PaymentController::class], function () {
        Route::post('confirm/{payment}', 'confirmPayment')->name('confirm');
    });
    Route::resource('transactions', TransactionController::class)->except(['show', 'index']);

    Route::group(['as' => 'orders.', 'prefix' => 'orders', 'controller' => OrderController::class], function () {
        Route::post('confirm/{order}', 'confirmOrder')->name('confirm');
        Route::post('cancel/{order}', 'cancelOrder')->name('cancel');
    });

    Route::group(['as' => 'settings.', 'prefix' => 'settings'], function () {
        Route::group(['as' => 'notifications.', 'prefix' => 'notifications'], function () {
            Route::get('/', [SettingsController::class, 'getNotifications'])
                ->name('index');
            Route::post('/regenerate-telegram-api-token', [SettingsController::class, 'regenerateTelegramApiToken'])
                ->name('regenerate-telegram-api-token');
            Route::post('/set-telegram-webhook', [SettingsController::class, 'setTelegramWebhook'])->name(
                'set-telegram-webhook'
            );
            Route::post('/remove-telegram-webhook', [SettingsController::class, 'removeTelegramWebhook'])->name(
                'remove-telegram-webhook'
            );
            Route::delete('/remove-telegram-chat/{telegramChat}', [SettingsController::class, 'removeTelegramChat']
            )->name(
                'remove-telegram-chat'
            );
        });

        Route::group(['as' => 'nova-poshta.', 'prefix' => 'nova-poshta'], function () {
            Route::get('/', [SettingsController::class, 'getNovaPoshtaSettings'])
                ->name('index');
            Route::post('/', [SettingsController::class, 'saveSenderCitySetting'])
                ->name('save-sender-city');
        });

        Route::group(['as' => 'banks.', 'prefix' => 'banks'], function () {
            Route::get('/', [SettingsController::class, 'getBanks'])
                ->name('index');
            Route::post('/set-monobank-webhook', [SettingsController::class, 'setMonobankWebhook'])->name(
                'set-monobank-webhook'
            );
            Route::post('/set-monobank-webhook', [SettingsController::class, 'setMonobankWebhook'])->name(
                'set-monobank-webhook'
            );
            Route::post('/get-monobank-extract', [SettingsController::class, 'getMonobankExtract'])->name(
                'get-monobank-extract'
            );
        });
    });
    Route::group(['as' => 'trash.', 'prefix' => 'trash'], function () {
        Route::get('users', [UserTrashController::class, 'index'])
            ->name('users.index');
        Route::delete('users/{user}', [UserTrashController::class, 'destroy'])
            ->name('users.destroy')
            ->withTrashed();
        Route::put('users/{user}/restore', [UserTrashController::class, 'restore'])
            ->name('users.restore')
            ->withTrashed();

        Route::get('orders', [OrderTrashController::class, 'index'])
            ->name('orders.index');
        Route::delete('orders/{order}', [OrderTrashController::class, 'destroy'])
            ->name('orders.destroy')
            ->withTrashed();
        Route::put('orders/{order}/restore', [OrderTrashController::class, 'restore'])
            ->name('orders.restore')
            ->withTrashed();

        Route::get('reviews', [ReviewTrashController::class, 'index'])
            ->name('reviews.index');
        Route::delete('reviews/{review}', [ReviewTrashController::class, 'destroy'])
            ->name('reviews.destroy')
            ->withTrashed();
        Route::put('reviews/{review}/restore', [ReviewTrashController::class, 'restore'])
            ->name('reviews.restore')
            ->withTrashed();

        Route::get('customers', [CustomerTrashController::class, 'index'])
            ->name('customers.index');
        Route::delete('customers/{customer}', [CustomerTrashController::class, 'destroy'])
            ->name('customers.destroy')
            ->withTrashed();
        Route::put('customers/{customer}/restore', [CustomerTrashController::class, 'restore'])
            ->name('customers.restore')
            ->withTrashed();

        Route::get('colors', [ColorTrashController::class, 'index'])
            ->name('colors.index');
        Route::delete('colors/{color}', [ColorTrashController::class, 'destroy'])
            ->name('colors.destroy')->withTrashed();
        Route::put('colors/{color}/restore', [ColorTrashController::class, 'restore'])
            ->name('colors.restore')
            ->withTrashed();

        Route::get('print-categories', [PrintCategoryTrashController::class, 'index'])->name('print-categories.index');
        Route::delete('print-categories/{printCategory}', [PrintCategoryTrashController::class, 'destroy'])->name(
            'print-categories.destroy'
        )->withTrashed();
        Route::put('print-categories/{printCategory}/restore', [PrintCategoryTrashController::class, 'restore'])
            ->name('print-categories.restore')
            ->withTrashed();

        Route::get('prints', [PrintImageTrashController::class, 'index'])->name('prints.index');
        Route::delete('prints/{printImage}', [PrintImageTrashController::class, 'destroy'])->name(
            'prints.destroy'
        )->withTrashed();
        Route::put('prints/{printImage}/restore', [PrintImageTrashController::class, 'restore'])
            ->name('prints.restore')
            ->withTrashed();

        Route::get('categories', [CategoryTrashController::class, 'index'])->name('categories.index');
        Route::delete('categories/{category}', [CategoryTrashController::class, 'destroy'])->name(
            'categories.destroy'
        )->withTrashed();
        Route::put('categories/{category}/restore', [CategoryTrashController::class, 'restore'])
            ->name('categories.restore')
            ->withTrashed();

        Route::get('products', [ProductTrashController::class, 'index'])->name('products.index');
        Route::delete('products/{product}', [ProductTrashController::class, 'destroy'])->name(
            'products.destroy'
        )->withTrashed();

        Route::delete('products/destroy/all', [ProductTrashController::class, 'destroyAll'])->name(
            'products.destroyAll'
        )->withTrashed();

        Route::put('products/{product}/restore', [ProductTrashController::class, 'restore'])
            ->name('products.restore')
            ->withTrashed();

        Route::get('sales', [SaleTrashController::class, 'index'])->name('sales.index');
        Route::delete('sales/{sale}', [SaleTrashController::class, 'destroy'])->name('sales.destroy')->withTrashed();
        Route::put('sales/{sale}/restore', [SaleTrashController::class, 'restore'])
            ->name('sales.restore')
            ->withTrashed();

        Route::get('pages', [\App\Http\Controllers\Admin\Trash\PageController::class, 'index'])->name('pages.index');
        Route::delete('pages/{page}', [\App\Http\Controllers\Admin\Trash\PageController::class, 'destroy'])->name(
            'pages.destroy'
        )->withTrashed();
        Route::put('pages/{page}/restore', [\App\Http\Controllers\Admin\Trash\PageController::class, 'restore'])
            ->name('pages.restore')
            ->withTrashed();

        Route::get('layouts', [\App\Http\Controllers\Admin\Trash\LayoutController::class, 'index'])->name(
            'layouts.index'
        );
        Route::delete('layouts/{layout}', [\App\Http\Controllers\Admin\Trash\LayoutController::class, 'destroy'])->name(
            'layouts.destroy'
        )->withTrashed();
        Route::put('layouts/{layout}/restore', [\App\Http\Controllers\Admin\Trash\LayoutController::class, 'restore'])
            ->name('layouts.restore')
            ->withTrashed();

        Route::get('sizes', [SizeTrashController::class, 'index'])->name('sizes.index');
        Route::delete('sizes/{size}', [SizeTrashController::class, 'destroy'])->name('sizes.destroy')->withTrashed();
        Route::put('sizes/{size}/restore', [SizeTrashController::class, 'restore'])
            ->name('sizes.restore')
            ->withTrashed();

        Route::get('brands', [BrandTrashController::class, 'index'])
            ->name('brands.index');
        Route::delete('brands/{brand}', [BrandTrashController::class, 'destroy'])
            ->name('brands.destroy')
            ->withTrashed();
        Route::put('brands/{brand}/restore', [BrandTrashController::class, 'restore'])
            ->name('brands.restore')
            ->withTrashed();
    });

    Route::get('slides/create/{slider}', [SlideController::class, 'create'])->name('slides.create');
});
