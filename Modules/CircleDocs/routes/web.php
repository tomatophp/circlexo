<?php

use Illuminate\Support\Facades\Route;
use Modules\CircleDocs\App\Http\Controllers\CircleDocsController;

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



Route::middleware(['splade', 'auth:accounts', 'app:circle-docs'])->name('profile.')->group(function () {
    Route::get('profile/docs', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocController::class, 'index'])->name('docs.index');
    Route::post('profile/docs/like', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocController::class, 'like'])->name('docs.like');
    Route::get('profile/docs/api', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocController::class, 'api'])->name('docs.api');
    Route::get('profile/docs/create', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocController::class, 'create'])->name('docs.create');
    Route::post('profile/docs', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocController::class, 'store'])->name('docs.store');
    Route::get('profile/docs/{model}', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocController::class, 'show'])->name('docs.show');
    Route::get('profile/docs/{model}/edit', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocController::class, 'edit'])->name('docs.edit');
    Route::post('profile/docs/{model}', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocController::class, 'update'])->name('docs.update');
    Route::delete('profile/docs/{model}', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocController::class, 'destroy'])->name('docs.destroy');
});

Route::middleware(['splade', 'auth:accounts', 'app:circle-docs'])->name('profile.')->group(function () {
    Route::get('profile/docs-pages', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocsPageController::class, 'index'])->name('docs-pages.index');
    Route::get('profile/docs-pages/api', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocsPageController::class, 'api'])->name('docs-pages.api');
    Route::get('profile/docs-pages/create', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocsPageController::class, 'create'])->name('docs-pages.create');
    Route::post('profile/docs-pages', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocsPageController::class, 'store'])->name('docs-pages.store');
    Route::get('profile/docs-pages/{model}', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocsPageController::class, 'show'])->name('docs-pages.show');
    Route::get('profile/docs-pages/{model}/edit', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocsPageController::class, 'edit'])->name('docs-pages.edit');
    Route::post('profile/docs-pages/{model}', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocsPageController::class, 'update'])->name('docs-pages.update');
    Route::delete('profile/docs-pages/{model}', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocsPageController::class, 'destroy'])->name('docs-pages.destroy');
});

Route::middleware(['splade'])->prefix('{username}')->name('docs.')->group(function () {
    Route::get('/docs', [CircleDocsController::class, 'profile'])->name('profile');
    Route::get('/docs/{slug}', [CircleDocsController::class, 'show'])->name('show');
    Route::get('/docs/{slug}/{page}', [CircleDocsController::class, 'page'])->name('page');
});

Route::middleware(['splade'])->name('docs.')->group(function () {
    Route::get('/docs', [CircleDocsController::class, 'index'])->name('index');
});
