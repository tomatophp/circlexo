<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Modules\TomatoNotifications\App\Http\Controllers\NotificationsController;

Route::middleware(['web', 'splade', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings/notifications', [\Modules\TomatoNotifications\App\Http\Controllers\NotificationsSettingsController::class, 'index'])->name('settings.notifications.index');
    Route::post('/settings/notifications', [\Modules\TomatoNotifications\App\Http\Controllers\NotificationsSettingsController::class, 'store'])->name('settings.notifications.store');
});

Route::middleware([
    'web',
    'splade',
    'verified'
])->name('admin.')->group(function () {
    Route::get('admin/notifications', [NotificationsController::class, 'index'])->name('notifications.index');
    Route::delete('admin/notifications/clear', [NotificationsController::class, 'clearUser'])->name('notifications.clear');
    Route::post('admin/notifications/read', [NotificationsController::class, 'read'])->name('notifications.read');
    Route::get('admin/notifications/{model}', [NotificationsController::class, 'show'])->name('notifications.show');
    Route::post('admin/notifications/{model}/read', [NotificationsController::class, 'readSelected'])->name('notifications.read.selected');
    Route::delete('admin/notifications/{model}/destroy', [NotificationsController::class, 'destroy'])->name('notifications.destroy');
});

Route::post('token', [NotificationsController::class, 'token'])->name('admin.notifications.token');


Route::middleware(['web', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/user-notifications', [\Modules\TomatoNotifications\App\Http\Controllers\UserNotificationController::class, 'index'])->name('user-notifications.index');
    Route::get('admin/user-notifications/api', [\Modules\TomatoNotifications\App\Http\Controllers\UserNotificationController::class, 'api'])->name('user-notifications.api');
    Route::get('admin/user-notifications/get/{model}', [\Modules\TomatoNotifications\App\Http\Controllers\UserNotificationController::class, 'get'])->name('user-notifications.get');
    Route::get('admin/user-notifications/create', [\Modules\TomatoNotifications\App\Http\Controllers\UserNotificationController::class, 'create'])->name('user-notifications.create');
    Route::post('admin/user-notifications', [\Modules\TomatoNotifications\App\Http\Controllers\UserNotificationController::class, 'store'])->name('user-notifications.store');
    Route::get('admin/user-notifications/{model}', [\Modules\TomatoNotifications\App\Http\Controllers\UserNotificationController::class, 'show'])->name('user-notifications.show');
    Route::get('admin/user-notifications/{model}/resend', [\Modules\TomatoNotifications\App\Http\Controllers\UserNotificationController::class, 'resend'])->name('user-notifications.resend');
    Route::delete('admin/user-notifications/{model}', [\Modules\TomatoNotifications\App\Http\Controllers\UserNotificationController::class, 'destroy'])->name('user-notifications.destroy');
});

Route::middleware(['web', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/notifications-templates', [\Modules\TomatoNotifications\App\Http\Controllers\NotificationsTemplateController::class, 'index'])->name('notifications-templates.index');
    Route::get('admin/notifications-templates/api', [\Modules\TomatoNotifications\App\Http\Controllers\NotificationsTemplateController::class, 'api'])->name('notifications-templates.api');
    Route::get('admin/notifications-templates/create', [\Modules\TomatoNotifications\App\Http\Controllers\NotificationsTemplateController::class, 'create'])->name('notifications-templates.create');
    Route::post('admin/notifications-templates', [\Modules\TomatoNotifications\App\Http\Controllers\NotificationsTemplateController::class, 'store'])->name('notifications-templates.store');
    Route::get('admin/notifications-templates/{model}', [\Modules\TomatoNotifications\App\Http\Controllers\NotificationsTemplateController::class, 'show'])->name('notifications-templates.show');
    Route::get('admin/notifications-templates/{template}/send', [\Modules\TomatoNotifications\App\Http\Controllers\NotificationsTemplateController::class, 'send'])->name('notifications-templates.send');
    Route::get('admin/notifications-templates/{model}/edit', [\Modules\TomatoNotifications\App\Http\Controllers\NotificationsTemplateController::class, 'edit'])->name('notifications-templates.edit');
    Route::post('admin/notifications-templates/{model}', [\Modules\TomatoNotifications\App\Http\Controllers\NotificationsTemplateController::class, 'update'])->name('notifications-templates.update');
    Route::delete('admin/notifications-templates/{model}', [\Modules\TomatoNotifications\App\Http\Controllers\NotificationsTemplateController::class, 'destroy'])->name('notifications-templates.destroy');
});

Route::middleware(['web', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/notifications-logs', [\Modules\TomatoNotifications\App\Http\Controllers\NotificationsLogController::class, 'index'])->name('notifications-logs.index');
    Route::post('admin/notifications-logs/clear', [\Modules\TomatoNotifications\App\Http\Controllers\NotificationsLogController::class, 'clear'])->name('notifications-logs.clear');
    Route::get('admin/notifications-logs/api', [\Modules\TomatoNotifications\App\Http\Controllers\NotificationsLogController::class, 'api'])->name('notifications-logs.api');
    Route::get('admin/notifications-logs/create', [\Modules\TomatoNotifications\App\Http\Controllers\NotificationsLogController::class, 'create'])->name('notifications-logs.create');
    Route::post('admin/notifications-logs', [\Modules\TomatoNotifications\App\Http\Controllers\NotificationsLogController::class, 'store'])->name('notifications-logs.store');
    Route::get('admin/notifications-logs/{model}', [\Modules\TomatoNotifications\App\Http\Controllers\NotificationsLogController::class, 'show'])->name('notifications-logs.show');
    Route::get('admin/notifications-logs/{model}/edit', [\Modules\TomatoNotifications\App\Http\Controllers\NotificationsLogController::class, 'edit'])->name('notifications-logs.edit');
    Route::post('admin/notifications-logs/{model}', [\Modules\TomatoNotifications\App\Http\Controllers\NotificationsLogController::class, 'update'])->name('notifications-logs.update');
    Route::delete('admin/notifications-logs/{model}', [\Modules\TomatoNotifications\App\Http\Controllers\NotificationsLogController::class, 'destroy'])->name('notifications-logs.destroy');
});
