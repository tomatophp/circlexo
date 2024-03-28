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
Route::middleware(['web', 'auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/pages/{model}/builder', [\Modules\TomatoThemes\App\Http\Controllers\BuilderController::class, 'builder'])->name('pages.builder');
    Route::post('admin/pages/{model}/sections', [\Modules\TomatoThemes\App\Http\Controllers\BuilderController::class, 'sections'])->name('pages.sections');
    Route::delete('admin/pages/{model}/sections/remove', [\Modules\TomatoThemes\App\Http\Controllers\BuilderController::class, 'remove'])->name('pages.remove');
    Route::get('admin/pages/{model}/meta', [\Modules\TomatoThemes\App\Http\Controllers\BuilderController::class, 'meta'])->name('pages.meta');
    Route::post('admin/pages/{model}/meta', [\Modules\TomatoThemes\App\Http\Controllers\BuilderController::class, 'metaStore'])->name('pages.meta.store');
    Route::post('admin/pages/{model}/clear', [\Modules\TomatoThemes\App\Http\Controllers\BuilderController::class, 'clear'])->name('pages.clear');
});

Route::middleware(['web','auth', 'splade', 'verified'])->prefix('admin/themes')->name('admin.themes.')->group(static function (){
    Route::get('/', [\Modules\TomatoThemes\App\Http\Controllers\ThemesController::class,'index'])->name('index');
    Route::get('/page/{model}', [\Modules\TomatoThemes\App\Http\Controllers\ThemesController::class,'edit'])->name('page.edit');
    Route::post('/page/{model}', [\Modules\TomatoThemes\App\Http\Controllers\ThemesController::class,'update'])->name('page.update');
    Route::post('/active', [\Modules\TomatoThemes\App\Http\Controllers\ThemesController::class,'active'])->name('active');
    if(config('tomato-themes.allow_create')){
        Route::get('/custom/{theme}', [\Modules\TomatoThemes\App\Http\Controllers\ThemesController::class,'custom'])->name('custom');
        Route::post('/custom/{theme}', [\Modules\TomatoThemes\App\Http\Controllers\ThemesController::class,'customSave'])->name('custom.save');
        Route::get('/create', [\Modules\TomatoThemes\App\Http\Controllers\ThemesController::class,'create'])->name('create');
        Route::post('/', [\Modules\TomatoThemes\App\Http\Controllers\ThemesController::class,'store'])->name('store');
    }
    if(config('tomato-themes.allow_upload')){
        Route::get('/upload', [\Modules\TomatoThemes\App\Http\Controllers\ThemesController::class,'upload'])->name('upload');
        Route::post('/upload', [\Modules\TomatoThemes\App\Http\Controllers\ThemesController::class,'uploadNew'])->name('upload.new');
    }

    if(config('tomato-themes.allow_destroy')){
        Route::delete('/destroy/{theme}', [\Modules\TomatoThemes\App\Http\Controllers\ThemesController::class,'destroy'])->name('destroy');
    }
});

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/features', [Modules\TomatoThemes\App\Http\Controllers\FeatureController::class, 'index'])->name('features.index');
    Route::get('admin/features/api', [Modules\TomatoThemes\App\Http\Controllers\FeatureController::class, 'api'])->name('features.api');
    Route::get('admin/features/create', [Modules\TomatoThemes\App\Http\Controllers\FeatureController::class, 'create'])->name('features.create');
    Route::post('admin/features', [Modules\TomatoThemes\App\Http\Controllers\FeatureController::class, 'store'])->name('features.store');
    Route::get('admin/features/{model}', [Modules\TomatoThemes\App\Http\Controllers\FeatureController::class, 'show'])->name('features.show');
    Route::get('admin/features/{model}/edit', [Modules\TomatoThemes\App\Http\Controllers\FeatureController::class, 'edit'])->name('features.edit');
    Route::post('admin/features/{model}', [Modules\TomatoThemes\App\Http\Controllers\FeatureController::class, 'update'])->name('features.update');
    Route::delete('admin/features/{model}', [Modules\TomatoThemes\App\Http\Controllers\FeatureController::class, 'destroy'])->name('features.destroy');
});

Route::fallback(function ($slug){
    $page= \Modules\TomatoCms\App\Models\Page::where('slug', $slug)->firstOrFail();
    return view('tomato-themes::pages.html', compact('page'));
})->middleware(['web','splade']);
