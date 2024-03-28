<?php

use Illuminate\Support\Facades\Route;
use Modules\CircleApps\App\Http\Controllers\CircleAppsController;

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

//Route::middleware(['web', 'splade'])->prefix('apps')->name('apps.')->group(function () {
//    Route::get('/', [CircleAppsController::class, 'index'])->name('index');
//    Route::get('/{app}', [CircleAppsController::class, 'show'])->name('show');
//});
//
//Route::middleware(['web', 'splade', 'auth:accounts'])->prefix('apps')->name('apps.')->group(function () {
//    Route::post('/{app}/install', [CircleAppsController::class, 'install'])->name('install');
//    Route::post('/{app}/uninstall', [CircleAppsController::class, 'uninstall'])->name('uninstall');
//});

Route::middleware(['auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/apps', [\Modules\CircleApps\App\Http\Controllers\AppController::class, 'index'])->name('apps.index');
    Route::get('admin/apps/api', [\Modules\CircleApps\App\Http\Controllers\AppController::class, 'api'])->name('apps.api');
    Route::get('admin/apps/create', [\Modules\CircleApps\App\Http\Controllers\AppController::class, 'create'])->name('apps.create');
    Route::post('admin/apps', [\Modules\CircleApps\App\Http\Controllers\AppController::class, 'store'])->name('apps.store');
    Route::get('admin/apps/{model}', [\Modules\CircleApps\App\Http\Controllers\AppController::class, 'show'])->name('apps.show');
    Route::get('admin/apps/{model}/edit', [\Modules\CircleApps\App\Http\Controllers\AppController::class, 'edit'])->name('apps.edit');
    Route::post('admin/apps/{model}', [\Modules\CircleApps\App\Http\Controllers\AppController::class, 'update'])->name('apps.update');
    Route::delete('admin/apps/{model}', [\Modules\CircleApps\App\Http\Controllers\AppController::class, 'destroy'])->name('apps.destroy');
});
