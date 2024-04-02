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


//Route::middleware(['auth:sanctum'])->name('api.')->group(function () {
//    Route::get('/circle-xo-docs', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocController::class, 'index'])->name('circle-xo-docs.index');
//    Route::post('/circle-xo-docs', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocController::class, 'store'])->name('circle-xo-docs.store');
//    Route::get('/circle-xo-docs/{model}', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocController::class, 'show'])->name('circle-xo-docs.show');
//    Route::post('/circle-xo-docs/{model}', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocController::class, 'update'])->name('circle-xo-docs.update');
//    Route::delete('/circle-xo-docs/{model}', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocController::class, 'destroy'])->name('circle-xo-docs.destroy');
//});
//
//Route::middleware(['auth:sanctum'])->name('api.')->group(function () {
//    Route::get('/circle-xo-docs-pages', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocsPageController::class, 'index'])->name('circle-xo-docs-pages.index');
//    Route::post('/circle-xo-docs-pages', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocsPageController::class, 'store'])->name('circle-xo-docs-pages.store');
//    Route::get('/circle-xo-docs-pages/{model}', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocsPageController::class, 'show'])->name('circle-xo-docs-pages.show');
//    Route::post('/circle-xo-docs-pages/{model}', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocsPageController::class, 'update'])->name('circle-xo-docs-pages.update');
//    Route::delete('/circle-xo-docs-pages/{model}', [\Modules\CircleDocs\App\Http\Controllers\CircleXoDocsPageController::class, 'destroy'])->name('circle-xo-docs-pages.destroy');
//});
