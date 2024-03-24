<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\TomatoNotifications\App\Http\Controllers\API\NotificationsController;

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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('api/notifications')->name('api.notifications.')->group(function () {
        Route::get('/', [NotificationsController::class, 'index'])->name('index');
        Route::post('/clear', [NotificationsController::class, 'clear'])->name('clear');
        Route::delete('/{id}/delete', [NotificationsController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/read', [NotificationsController::class, 'markAsRead'])->name('markAsRead');
        Route::post('/toggle', [NotificationsController::class, 'setting'])->name('setting');
    });
});
