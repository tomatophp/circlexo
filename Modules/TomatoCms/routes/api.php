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

if (config("tomato-cms.features.pages")) {
    Route::middleware(['auth:sanctum'])->prefix('api/pages')->name('api.pages.')->group(function () {
        Route::get('/', [\Modules\TomatoCms\App\Http\Controllers\PageController::class, 'index'])->name('index');
        Route::get('/{model}', [\Modules\TomatoCms\App\Http\Controllers\PageController::class, 'show'])->name('show');
    });
}
