<?php

use Illuminate\Support\Facades\Route;
use Modules\TomatoEcommerce\App\Http\Controllers\TomatoEcommerceController;

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

//
//Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
//    Route::get('admin/carts', [\Modules\TomatoEcommerce\App\Http\Controllers\CartController::class, 'index'])->name('carts.index');
//    Route::get('admin/carts/api', [\Modules\TomatoEcommerce\App\Http\Controllers\CartController::class, 'api'])->name('carts.api');
//    Route::get('admin/carts/create', [\Modules\TomatoEcommerce\App\Http\Controllers\CartController::class, 'create'])->name('carts.create');
//    Route::post('admin/carts', [\Modules\TomatoEcommerce\App\Http\Controllers\CartController::class, 'store'])->name('carts.store');
//    Route::get('admin/carts/{model}', [\Modules\TomatoEcommerce\App\Http\Controllers\CartController::class, 'show'])->name('carts.show');
//    Route::get('admin/carts/{model}/edit', [\Modules\TomatoEcommerce\App\Http\Controllers\CartController::class, 'edit'])->name('carts.edit');
//    Route::post('admin/carts/{model}', [\Modules\TomatoEcommerce\App\Http\Controllers\CartController::class, 'update'])->name('carts.update');
//    Route::delete('admin/carts/{model}', [\Modules\TomatoEcommerce\App\Http\Controllers\CartController::class, 'destroy'])->name('carts.destroy');
//});
//
//Route::middleware(['auth', 'splade', 'verified'])->name('admin.')->group(function () {
//    Route::get('admin/searches', [\Modules\TomatoEcommerce\App\Http\Controllers\SearchController::class, 'index'])->name('searches.index');
//    Route::get('admin/searches/api', [\Modules\TomatoEcommerce\App\Http\Controllers\SearchController::class, 'api'])->name('searches.api');
//    Route::get('admin/searches/create', [\Modules\TomatoEcommerce\App\Http\Controllers\SearchController::class, 'create'])->name('searches.create');
//    Route::post('admin/searches', [\Modules\TomatoEcommerce\App\Http\Controllers\SearchController::class, 'store'])->name('searches.store');
//    Route::get('admin/searches/{model}', [\Modules\TomatoEcommerce\App\Http\Controllers\SearchController::class, 'show'])->name('searches.show');
//    Route::get('admin/searches/{model}/edit', [\Modules\TomatoEcommerce\App\Http\Controllers\SearchController::class, 'edit'])->name('searches.edit');
//    Route::post('admin/searches/{model}', [\Modules\TomatoEcommerce\App\Http\Controllers\SearchController::class, 'update'])->name('searches.update');
//    Route::delete('admin/searches/{model}', [\Modules\TomatoEcommerce\App\Http\Controllers\SearchController::class, 'destroy'])->name('searches.destroy');
//});
//
//Route::middleware(['auth', 'splade', 'verified'])->name('admin.')->group(function () {
//    Route::get('admin/wishlists', [\Modules\TomatoEcommerce\App\Http\Controllers\WishlistController::class, 'index'])->name('wishlists.index');
//    Route::get('admin/wishlists/api', [\Modules\TomatoEcommerce\App\Http\Controllers\WishlistController::class, 'api'])->name('wishlists.api');
//    Route::get('admin/wishlists/create', [\Modules\TomatoEcommerce\App\Http\Controllers\WishlistController::class, 'create'])->name('wishlists.create');
//    Route::post('admin/wishlists', [\Modules\TomatoEcommerce\App\Http\Controllers\WishlistController::class, 'store'])->name('wishlists.store');
//    Route::get('admin/wishlists/{model}', [\Modules\TomatoEcommerce\App\Http\Controllers\WishlistController::class, 'show'])->name('wishlists.show');
//    Route::get('admin/wishlists/{model}/edit', [\Modules\TomatoEcommerce\App\Http\Controllers\WishlistController::class, 'edit'])->name('wishlists.edit');
//    Route::post('admin/wishlists/{model}', [\Modules\TomatoEcommerce\App\Http\Controllers\WishlistController::class, 'update'])->name('wishlists.update');
//    Route::delete('admin/wishlists/{model}', [\Modules\TomatoEcommerce\App\Http\Controllers\WishlistController::class, 'destroy'])->name('wishlists.destroy');
//});
//
//Route::middleware(['auth', 'splade', 'verified'])->name('admin.')->group(function () {
//    Route::get('admin/comparisons', [\Modules\TomatoEcommerce\App\Http\Controllers\ComparisonController::class, 'index'])->name('comparisons.index');
//    Route::get('admin/comparisons/api', [\Modules\TomatoEcommerce\App\Http\Controllers\ComparisonController::class, 'api'])->name('comparisons.api');
//    Route::get('admin/comparisons/create', [\Modules\TomatoEcommerce\App\Http\Controllers\ComparisonController::class, 'create'])->name('comparisons.create');
//    Route::post('admin/comparisons', [\Modules\TomatoEcommerce\App\Http\Controllers\ComparisonController::class, 'store'])->name('comparisons.store');
//    Route::get('admin/comparisons/{model}', [\Modules\TomatoEcommerce\App\Http\Controllers\ComparisonController::class, 'show'])->name('comparisons.show');
//    Route::get('admin/comparisons/{model}/edit', [\Modules\TomatoEcommerce\App\Http\Controllers\ComparisonController::class, 'edit'])->name('comparisons.edit');
//    Route::post('admin/comparisons/{model}', [\Modules\TomatoEcommerce\App\Http\Controllers\ComparisonController::class, 'update'])->name('comparisons.update');
//    Route::delete('admin/comparisons/{model}', [\Modules\TomatoEcommerce\App\Http\Controllers\ComparisonController::class, 'destroy'])->name('comparisons.destroy');
//});
//
//Route::middleware(['auth', 'splade', 'verified'])->name('admin.')->group(function () {
//    Route::get('admin/downloads', [\Modules\TomatoEcommerce\App\Http\Controllers\DownloadController::class, 'index'])->name('downloads.index');
//    Route::get('admin/downloads/api', [\Modules\TomatoEcommerce\App\Http\Controllers\DownloadController::class, 'api'])->name('downloads.api');
//    Route::get('admin/downloads/create', [\Modules\TomatoEcommerce\App\Http\Controllers\DownloadController::class, 'create'])->name('downloads.create');
//    Route::post('admin/downloads', [\Modules\TomatoEcommerce\App\Http\Controllers\DownloadController::class, 'store'])->name('downloads.store');
//    Route::get('admin/downloads/{model}', [\Modules\TomatoEcommerce\App\Http\Controllers\DownloadController::class, 'show'])->name('downloads.show');
//    Route::get('admin/downloads/{model}/edit', [\Modules\TomatoEcommerce\App\Http\Controllers\DownloadController::class, 'edit'])->name('downloads.edit');
//    Route::post('admin/downloads/{model}', [\Modules\TomatoEcommerce\App\Http\Controllers\DownloadController::class, 'update'])->name('downloads.update');
//    Route::delete('admin/downloads/{model}', [\Modules\TomatoEcommerce\App\Http\Controllers\DownloadController::class, 'destroy'])->name('downloads.destroy');
//});
