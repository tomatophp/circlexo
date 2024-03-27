<?php

use Illuminate\Support\Facades\Route;
use Modules\TomatoForms\App\Http\Controllers\FieldOptionsController;
use Modules\TomatoForms\App\Http\Controllers\FormController;
use Modules\TomatoForms\App\Http\Controllers\FormRequestController;

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


Route::middleware(['web', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/forms', [FormController::class, 'index'])->name('forms.index');
    Route::post('admin/forms/{model}/clear', [FormController::class, 'clear'])->name('forms.clear');
    Route::get('admin/forms/api', [FormController::class, 'api'])->name('forms.api');
    Route::get('admin/forms/create', [FormController::class, 'create'])->name('forms.create');
    Route::get('admin/forms/options', [FormController::class, 'formOptions'])->name('forms.form-options');
    Route::post('admin/forms', [FormController::class, 'store'])->name('forms.store');
    Route::get('admin/forms/{model}', [FormController::class, 'show'])->name('forms.show');
    Route::get('admin/forms/{model}/build', [FormController::class, 'build'])->name('forms.build');
    Route::post('admin/forms/{model}/order', [FormController::class, 'order'])->name('forms.order');
    Route::post('admin/forms/{model}/build', [FormController::class, 'options'])->name('forms.options');
    Route::get('admin/forms/{model}/edit', [FormController::class, 'edit'])->name('forms.edit');
    Route::post('admin/forms/{model}', [FormController::class, 'update'])->name('forms.update');
    Route::delete('admin/forms/{model}', [FormController::class, 'destroy'])->name('forms.destroy');
});

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/form-requests', [\Modules\TomatoForms\App\Http\Controllers\FormRequestController::class, 'index'])->name('form-requests.index');
    Route::get('admin/form-requests/api', [\Modules\TomatoForms\App\Http\Controllers\FormRequestController::class, 'api'])->name('form-requests.api');
    Route::get('admin/form-requests/create', [\Modules\TomatoForms\App\Http\Controllers\FormRequestController::class, 'create'])->name('form-requests.create');
    Route::post('admin/form-requests', [\Modules\TomatoForms\App\Http\Controllers\FormRequestController::class, 'store'])->name('form-requests.store');
    Route::get('admin/form-requests/{model}', [\Modules\TomatoForms\App\Http\Controllers\FormRequestController::class, 'show'])->name('form-requests.show');
    Route::get('admin/form-requests/{model}/edit', [\Modules\TomatoForms\App\Http\Controllers\FormRequestController::class, 'edit'])->name('form-requests.edit');
    Route::post('admin/form-requests/{model}', [\Modules\TomatoForms\App\Http\Controllers\FormRequestController::class, 'update'])->name('form-requests.update');
    Route::delete('admin/form-requests/{model}', [\Modules\TomatoForms\App\Http\Controllers\FormRequestController::class, 'destroy'])->name('form-requests.destroy');
});


Route::middleware(['web', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::post('admin/form-options/{model}', [FieldOptionsController::class, 'update'])->name('form-options.update');
    Route::delete('admin/form-options/{model}', [FieldOptionsController::class, 'destroy'])->name('form-options.destroy');
});

Route::middleware(['auth:sanctum'])->name('api.')->group(function () {
    Route::get('api/forms', [FormController::class, 'index'])->name('forms.index');
    Route::get('api/forms/{model}', [FormController::class, 'show'])->name('forms.show');
    Route::get('api/form-requests', [FormRequestController::class, 'index'])->name('forms.requests');
    Route::post('api/form-requests', [FormRequestController::class, 'store'])->name('forms.requests.store');
    Route::get('api/form-requests/{model}', [FormRequestController::class, 'show'])->name('forms.requests.show');
});
