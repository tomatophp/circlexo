<?php

use Illuminate\Support\Facades\Route;
use Modules\TomatoTranslations\App\Http\Controllers\TomatoTranslationsController;

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

if(config('tomato-translations.allow_gui')){
    Route::middleware(['web', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/translations', [\Modules\TomatoTranslations\App\Http\Controllers\TranslationsController::class, 'index'])->name('translations.index');
        Route::get('admin/translations/scan', [\Modules\TomatoTranslations\App\Http\Controllers\TranslationsController::class, 'scan'])->name('translations.scan');
        Route::get('admin/translations/export', [\Modules\TomatoTranslations\App\Http\Controllers\TranslationsController::class, 'export'])->name('translations.export');
        Route::get('admin/translations/import', [\Modules\TomatoTranslations\App\Http\Controllers\TranslationsController::class, 'importView'])->name('translations.importView');
        Route::post('admin/translations/import', [\Modules\TomatoTranslations\App\Http\Controllers\TranslationsController::class, 'import'])->name('translations.import');
        Route::get('admin/translations/auto', [\Modules\TomatoTranslations\App\Http\Controllers\TranslationsController::class, 'auto'])->name('translations.auto');
        Route::get('admin/translations/{model}/edit', [\Modules\TomatoTranslations\App\Http\Controllers\TranslationsController::class, 'edit'])->name('translations.edit');
        Route::post('admin/translations/{model}', [\Modules\TomatoTranslations\App\Http\Controllers\TranslationsController::class, 'update'])->name('translations.update');
        Route::delete('admin/translations/{model}', [\Modules\TomatoTranslations\App\Http\Controllers\TranslationsController::class, 'destroy'])->name('translations.destroy');
    });
}

