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

Route::name('api.')->middleware(config('tomato-category.middleware'))->prefix('api')->group(function (){
    if(config('tomato-category.features.category')){
        Route::get('categories',[\Modules\TomatoCategory\App\Http\Controllers\CategoryController::class,'index'])->name('categories.index');
        Route::get('categories/{model}',[\Modules\TomatoCategory\App\Http\Controllers\CategoryController::class,'show'])->name('categories.show');
    }
    if(config('tomato-category.features.types')) {
        Route::get('types', [\Modules\TomatoCategory\App\Http\Controllers\TypeController::class, 'index'])->name('types.index');
        Route::get('types/{model}', [\Modules\TomatoCategory\App\Http\Controllers\TypeController::class, 'show'])->name('types.show');
    }
});

