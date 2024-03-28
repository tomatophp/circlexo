<?php

use Illuminate\Support\Facades\Route;
use Modules\TomatoMenus\App\Http\Controllers\TomatoMenusController;

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

Route::middleware(['web','auth','splade'])->prefix('admin/menus')->name('admin.menus.')->group(function (){
    Route::get('/', [\Modules\TomatoMenus\App\Http\Controllers\MenuController::class, 'index'])->name('index');
    Route::post('/', [\Modules\TomatoMenus\App\Http\Controllers\MenuController::class, 'store'])->name('store');
    Route::get('/api', [\Modules\TomatoMenus\App\Http\Controllers\MenuController::class, 'api'])->name('api');
    Route::post('/{menu}', [\Modules\TomatoMenus\App\Http\Controllers\MenuController::class, 'update'])->name('update');
    Route::delete('/{menu}', [\Modules\TomatoMenus\App\Http\Controllers\MenuController::class, 'destroy'])->name('destroy');

    //Items Routes
    Route::post('/{menu}/item', [\Modules\TomatoMenus\App\Http\Controllers\MenuController::class, 'item'])->name('item');
    Route::post('/{menu}/item/all', [\Modules\TomatoMenus\App\Http\Controllers\MenuController::class, 'itemAll'])->name('item.all');
    Route::post('/{menu}/item/pages', [\Modules\TomatoMenus\App\Http\Controllers\MenuController::class, 'pages'])->name('item.pages');
    Route::delete('/{menu}/item/destroy', [\Modules\TomatoMenus\App\Http\Controllers\MenuController::class, 'itemDestroy'])->name('item.destroy');
    Route::post('/{menu}/item/update', [\Modules\TomatoMenus\App\Http\Controllers\MenuController::class, 'itemUpdate'])->name('item.update');

});
