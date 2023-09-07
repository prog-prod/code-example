<?php

use App\Http\Controllers\About\AboutController;
use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ComingSoon\ComingSoonController;
use App\Http\Controllers\ComparisonController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\FAQ\FAQController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\Main\MainController;
use App\Http\Controllers\Payment\CheckoutController;
use App\Http\Controllers\Payment\ConfirmationController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Payment\ReviewController;
use App\Http\Controllers\Payment\TrackController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\Prints\PrintCategoryController;
use App\Http\Controllers\Profile\AddressController;
use App\Http\Controllers\Profile\DashboardController;
use App\Http\Controllers\Profile\OrderController;
use App\Http\Controllers\Profile\ProfileDetailsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Shop\ProductController;
use App\Http\Controllers\Telegram\TelegramController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\Wishlist\WishlistController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localize', 'localeSessionRedirect', 'localizationRedirect',]
    ],
    function () {
//        Route::get('/order-canceled-mail', function () {
//            $order = Order::latest()->first();
//            return (new \App\Notifications\OrderCanceledNotification($order))
//                ->toMail($order->customer);
//        });
        Route::group(['controller' => MainController::class], function () {
            Route::get('/', 'index')->name('index');
            Route::post('/subscribe', 'storeSubscriber')->name('subscribers.store');
            Route::post('/verify-phone', 'verifyPhone')->name('verify-phone');
            Route::post('/send-code', 'sendCode')
                ->middleware('throttle:1,1')
                ->name('send-code');
        });

        Route::get('/about-us', [AboutController::class, 'index'])->name('about');
        Route::get('/blog', [BlogController::class, 'index'])->name('blog');
        Route::get('/blog-single', [PostController::class, 'index'])->name('blog-single');
        Route::get('/cart', [CartController::class, 'index'])->name('cart');
        Route::get('/coming-soon', [ComingSoonController::class, 'index'])->name('coming-soon');
        Route::get('/confirmation', [ConfirmationController::class, 'index'])->name('confirmation');
        Route::group(['as' => 'contact.', 'prefix' => 'contact-us', 'controller' => ContactController::class],
            function () {
                Route::get('/', [ContactController::class, 'index'])->name('index');
                Route::post('/send-message', [ContactController::class, 'sendMessage'])
                    ->middleware('throttle:6,1')
                    ->name('send-message');
            });
        Route::get('/faq', [FAQController::class, 'index'])->name('faq');
        Route::get('/payment', [PaymentController::class, 'index'])->name('payment');

        Route::group(['as' => 'wishlist.', 'prefix' => 'wishlist', 'controller' => WishlistController::class],
            function () {
                Route::get('/', 'index')->name('index');
                Route::post('/add/{product}', 'add')->name('add');
                Route::post('/delete/{product}', 'delete')->name('delete');
            });
        Route::group(['as' => 'comparisons.', 'prefix' => 'comparisons', 'controller' => ComparisonController::class],
            function () {
                Route::get('/', 'index')->name('index');
                Route::get('/category/{category}', 'showCategory')->name('show');
                Route::post('/add/{product}', 'add')->name('add');
                Route::post('/delete/{product}', 'delete')->name('delete');
            }
        );

        Route::middleware(['auth', 'verified'])->prefix('profile')->as('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'home'])->name('index');

            Route::group(['as' => 'dashboard.', 'prefix' => 'dashboard', 'controller' => DashboardController::class],
                function () {
                    Route::get('/', 'index')->name('index');
                });
            Route::group(['as' => 'order.', 'prefix' => 'order', 'controller' => OrderController::class], function () {
                Route::get('/', 'index')->name('index');
                Route::post('/cancel-order/{order}', 'cancelOrder')->name('cancel-order');
            });
            Route::group(['as' => 'address.', 'prefix' => 'address', 'controller' => AddressController::class],
                function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/add-address', 'addAddress')->name('add-address');
                    Route::delete('/remove-address/{userAddress}', 'removeAddress')->name('remove-address');
                    Route::put('/update-address/{userAddress}', 'updateAddress')->name('update-address');
                });
            Route::group(
                [
                    'as' => 'profile-details.',
                    'prefix' => 'profile-details',
                    'controller' => ProfileDetailsController::class
                ],
                function () {
                    Route::get('/', 'index')->name('index');
                    Route::put('/', 'update')->name('update');
                }
            );
        });

// CHECKOUT
        Route::group(['as' => 'checkout.', 'prefix' => 'checkout', 'controller' => CheckoutController::class],
            function () {
                // Шаг 1: Информация о доставке
                Route::get('/', 'index')->name('index');
                Route::post('/', 'submitCheckoutForm')->name('submit');

                Route::group(['as' => 'review.', 'controller' => ReviewController::class], function () {
                    Route::get('/review', 'index')->name('index');
                    Route::as('coupon.')->group(function () {
                        Route::post('/coupon', 'applyCoupon')->name('apply');
                        Route::post('/remove-coupon', 'removeCoupon')->name('remove');
                    });
                });

                // Шаг 4: Оплата
                Route::group(['as' => 'payment.', 'controller' => PaymentController::class], function () {
                    Route::get('/payment', 'index')->name('index');
                    Route::post('/payment', 'submitPaymentForm')->name('submit');
                });

                // Страница успешного оформления заказа
                Route::get('/success', [CheckoutController::class, 'showSuccess'])->name('success');
            });

        Route::group(['as' => 'cart.', 'prefix' => 'cart', 'controller' => CartController::class], function () {
            Route::post('/add/{product}', 'add')->name('add');
            Route::post('/delete/{product}', 'delete')->name('delete');
        });

        Route::group(['prefix' => 'products', 'controller' => ProductController::class, 'as' => 'products.'],
            function () {
                Route::middleware(['multiply.price'])->get('/', 'index')->name('index');
                Route::get('/{product}', 'show')->name('show');
                Route::post('/{product}/add-review', 'addReview')->name('add-review');
                Route::get('/{product}/get-quick-view-data', 'getQuickViewData')->name('get-quick-view-data');
                Route::middleware('auth:web')->get('/leave-review-after-order/{order}', 'leaveReviewAfterOrder')->name(
                    'leave-review-after-order'
                );
            });

        Route::group(['prefix' => 'category', 'controller' => CategoryController::class, 'as' => 'category.'],
            function () {
                Route::middleware(['multiply.price'])->get('/{category}', 'show')->name('show');
            });

        Route::group(
            ['prefix' => 'print-category', 'controller' => PrintCategoryController::class, 'as' => 'print-category.'],
            function () {
                Route::middleware(['multiply.price'])->get('/{printCategory}', 'show')->name('show');
            }
        );


        Route::get('/track', [TrackController::class, 'index'])->name('track');

        Route::get('/policy', PolicyController::class)->name('policy');
        Route::get('/terms', TermsController::class)->name('terms');

        Route::group(['controller' => LayoutController::class], function () {
            Route::post('/switch-locale', 'switchLocale')->name('switch-locale');
            Route::post('/switch-currency', 'switchCurrency')->name('switch-currency');
        });
    }
);

// Webhooks
Route::post(
    str_replace(
        "<token>",
        config('telegram.bots.printopia_bot.token'),
        config('telegram.bots.printopia_bot.webhook_url')
    ),
    TelegramController::class
)->name('telegram.webhook');




