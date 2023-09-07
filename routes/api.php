<?php

use App\Http\Controllers\Api\DeliveryController;
use App\Http\Controllers\Api\MonoController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
})->name('user');

Route::get('/countries', [ProfileController::class, 'getCountries'])->name('countries');
Route::group(['prefix' => 'delivery'], function () {
    Route::get('/searchCity', [DeliveryController::class, 'searchCity'])->name('city-search');
    Route::get('/searchStreet', [DeliveryController::class, 'searchStreet'])->name('street-search');
    Route::get('/searchNovaPoshtaCity', [DeliveryController::class, 'searchNovaPoshtaCity'])->name(
        'search-nova-poshta-city'
    );
    Route::get('/searchNovaPoshtaDepartments', [DeliveryController::class, 'searchNovaPoshtaDepartments'])
        ->name('search-nova-poshta-departments');
    Route::get('/calc-delivery-cost', [DeliveryController::class, 'calcDeliveryCost'])->name(
        'calc-delivery-cost'
    );
    Route::get('/get-delivery-date', [DeliveryController::class, 'getDeliveryDate'])->name(
        'get-delivery-date'
    );
});

Route::group(['as' => 'mono.'], function () {
    Route::get(
        config('bank.mono.webhook_url'),
        [MonoController::class, 'setMonobankWebhook']
    )->name('webhook');
    Route::post(
        config('bank.mono.webhook_url'),
        [MonoController::class, 'handleMonobankEvent']
    )->name('events');
});
