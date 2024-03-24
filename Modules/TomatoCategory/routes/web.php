<?php

use Illuminate\Support\Facades\Route;
use Modules\TomatoCategory\App\Http\Controllers\TomatoCategoryController;

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

if(config("tomato-category.features.category")){
    Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/categories', [\Modules\TomatoCategory\App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
        Route::get('admin/categories/api', [\Modules\TomatoCategory\App\Http\Controllers\CategoryController::class, 'api'])->name('categories.api');
        Route::get('admin/categories/create', [\Modules\TomatoCategory\App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
        Route::post('admin/categories', [\Modules\TomatoCategory\App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
        Route::get('admin/categories/{model}', [\Modules\TomatoCategory\App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');
        Route::get('admin/categories/{model}/edit', [\Modules\TomatoCategory\App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('admin/categories/{model}', [\Modules\TomatoCategory\App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
        Route::delete('admin/categories/{model}', [\Modules\TomatoCategory\App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');
    });

}
if(config("tomato-category.features.types")){
    Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/types', [\Modules\TomatoCategory\App\Http\Controllers\TypeController::class, 'index'])->name('types.index');
        Route::get('admin/types/api', [\Modules\TomatoCategory\App\Http\Controllers\TypeController::class, 'api'])->name('types.api');
        Route::get('admin/types/create', [\Modules\TomatoCategory\App\Http\Controllers\TypeController::class, 'create'])->name('types.create');
        Route::post('admin/types', [\Modules\TomatoCategory\App\Http\Controllers\TypeController::class, 'store'])->name('types.store');
        Route::get('admin/types/{model}', [\Modules\TomatoCategory\App\Http\Controllers\TypeController::class, 'show'])->name('types.show');
        Route::get('admin/types/{model}/edit', [\Modules\TomatoCategory\App\Http\Controllers\TypeController::class, 'edit'])->name('types.edit');
        Route::post('admin/types/{model}', [\Modules\TomatoCategory\App\Http\Controllers\TypeController::class, 'update'])->name('types.update');
        Route::delete('admin/types/{model}', [\Modules\TomatoCategory\App\Http\Controllers\TypeController::class, 'destroy'])->name('types.destroy');
    });
}
