<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
*/

if(config('tomato-support.features.apis')) {

    if(config('tomato-support.features.tickets')) {
        Route::middleware(['auth:sanctum'])->prefix('api/tickets')->name('api.tickets.')->group(function () {
            Route::get('/', [\Modules\TomatoSupport\App\Http\Controllers\TicketController::class, 'index'])->name('index');
            Route::post('/', [\Modules\TomatoSupport\App\Http\Controllers\TicketController::class, 'store'])->name('store');
            Route::get('/{model}', [\Modules\TomatoSupport\App\Http\Controllers\TicketController::class, 'show'])->name('show');
            Route::post('/{model}', [\Modules\TomatoSupport\App\Http\Controllers\TicketController::class, 'send'])->name('send');
        });
    }

    if(config('tomato-support.features.faq')) {
        Route::middleware(['auth:sanctum'])->prefix('api/faq')->name('api.faq.')->group(function () {
            Route::get('/', [\Modules\TomatoSupport\App\Http\Controllers\QuestionController::class, 'index'])->name('index');
        });
    }
}