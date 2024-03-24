<?php

use Illuminate\Support\Facades\Route;
use Modules\TomatoSettings\App\Http\Controllers\TomatoSettingsController;

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

Route::middleware(['web', 'splade', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings', [\Modules\TomatoSettings\App\Http\Controllers\SettingsController::class, 'index'])->name('settings.index');
});


Route::middleware(['web', 'splade', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings/local', [\Modules\TomatoSettings\App\Http\Controllers\LocalSettingsController::class, 'index'])->name('settings.local.index');
    Route::post('/settings/local', [\Modules\TomatoSettings\App\Http\Controllers\LocalSettingsController::class, 'store'])->name('settings.local.store');
});

Route::middleware(['web', 'splade', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings/services/facebook', [\Modules\TomatoSettings\App\Http\Controllers\FacebookServicesSettingsController::class, 'index'])->name('settings.services-facebook.index');
    Route::post('/settings/services/facebook', [\Modules\TomatoSettings\App\Http\Controllers\FacebookServicesSettingsController::class, 'store'])->name('settings.services-facebook.store');
});

Route::middleware(['web', 'splade', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings/services/addthis', [\Modules\TomatoSettings\App\Http\Controllers\AddThisServicesSettingsController::class, 'index'])->name('settings.services-addthis.index');
    Route::post('/settings/services/addthis', [\Modules\TomatoSettings\App\Http\Controllers\AddThisServicesSettingsController::class, 'store'])->name('settings.services-addthis.store');
});

Route::middleware(['web', 'splade', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings/services/sms', [\Modules\TomatoSettings\App\Http\Controllers\SMSServicesSettingsController::class, 'index'])->name('settings.services-sms.index');
    Route::post('/settings/services/sms', [\Modules\TomatoSettings\App\Http\Controllers\SMSServicesSettingsController::class, 'store'])->name('settings.services-sms.store');
});

Route::middleware(['web', 'splade', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings/services/shipping', [\Modules\TomatoSettings\App\Http\Controllers\ShippingServicesSettingsController::class, 'index'])->name('settings.services-shipping.index');
    Route::post('/settings/services/shipping', [\Modules\TomatoSettings\App\Http\Controllers\ShippingServicesSettingsController::class, 'store'])->name('settings.services-shipping.store');
});

Route::middleware(['web', 'splade', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings/google/recap', [\Modules\TomatoSettings\App\Http\Controllers\GoogleRecapSettingsController::class, 'index'])->name('settings.google-recap.index');
    Route::post('/settings/google/recap', [\Modules\TomatoSettings\App\Http\Controllers\GoogleRecapSettingsController::class, 'store'])->name('settings.google-recap.store');
});

Route::middleware(['web', 'splade', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings/google/firebase', [\Modules\TomatoSettings\App\Http\Controllers\GoogleFirebaseSettingsController::class, 'index'])->name('settings.google-firebase.index');
    Route::post('/settings/google/firebase', [\Modules\TomatoSettings\App\Http\Controllers\GoogleFirebaseSettingsController::class, 'store'])->name('settings.google-firebase.store');
});

Route::middleware(['web', 'splade', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings/seo', [\Modules\TomatoSettings\App\Http\Controllers\SEOSettingsController::class, 'index'])->name('settings.seo.index');
    Route::post('/settings/seo', [\Modules\TomatoSettings\App\Http\Controllers\SEOSettingsController::class, 'store'])->name('settings.seo.store');
});

Route::middleware(['web', 'splade', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings/site', [\Modules\TomatoSettings\App\Http\Controllers\SiteSettingsController::class, 'index'])->name('settings.site.index');
    Route::post('/settings/site', [\Modules\TomatoSettings\App\Http\Controllers\SiteSettingsController::class, 'store'])->name('settings.site.store');
});

Route::middleware(['web', 'splade', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings/email', [\Modules\TomatoSettings\App\Http\Controllers\EmailSettingsController::class, 'index'])->name('settings.email.index');
    Route::post('/settings/email', [\Modules\TomatoSettings\App\Http\Controllers\EmailSettingsController::class, 'store'])->name('settings.email.store');
});

Route::middleware(['web', 'splade', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings/google', [\Modules\TomatoSettings\App\Http\Controllers\GoogleSettingsController::class, 'index'])->name('settings.google.index');
    Route::post('/settings/google', [\Modules\TomatoSettings\App\Http\Controllers\GoogleSettingsController::class, 'store'])->name('settings.google.store');
});

Route::middleware(['web', 'splade', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings/services', [\Modules\TomatoSettings\App\Http\Controllers\ServicesSettingsController::class, 'index'])->name('settings.services.index');
    Route::post('/settings/services', [\Modules\TomatoSettings\App\Http\Controllers\ServicesSettingsController::class, 'store'])->name('settings.services.store');
});

Route::middleware(['web', 'splade', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings/payments', [\Modules\TomatoSettings\App\Http\Controllers\PaymentsSettingsController::class, 'index'])->name('settings.payments.index');
    Route::post('/settings/payments', [\Modules\TomatoSettings\App\Http\Controllers\PaymentsSettingsController::class, 'store'])->name('settings.payments.store');
});
