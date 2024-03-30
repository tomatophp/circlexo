<?php

use Illuminate\Support\Facades\Route;
use Modules\CircleInvoices\App\Http\Controllers\CircleInvoicesController;

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


Route::middleware(['auth:accounts', 'splade', 'app:circle-invoices'])->name('profile.')->group(function () {
    Route::get('profile/invoices', [\Modules\CircleInvoices\App\Http\Controllers\CircleXoInvoiceController::class, 'index'])->name('invoices.index');
    Route::get('profile/invoices/api', [\Modules\CircleInvoices\App\Http\Controllers\CircleXoInvoiceController::class, 'api'])->name('invoices.api');
    Route::get('profile/invoices/create', [\Modules\CircleInvoices\App\Http\Controllers\CircleXoInvoiceController::class, 'create'])->name('invoices.create');
    Route::post('profile/invoices', [\Modules\CircleInvoices\App\Http\Controllers\CircleXoInvoiceController::class, 'store'])->name('invoices.store');
    Route::get('profile/invoices/{model}', [\Modules\CircleInvoices\App\Http\Controllers\CircleXoInvoiceController::class, 'show'])->name('invoices.show');
    Route::get('profile/invoices/{model}/edit', [\Modules\CircleInvoices\App\Http\Controllers\CircleXoInvoiceController::class, 'edit'])->name('invoices.edit');
    Route::get('profile/invoices/{model}/print', [\Modules\CircleInvoices\App\Http\Controllers\CircleXoInvoiceController::class, 'print'])->name('invoices.print');
    Route::post('profile/invoices/{model}', [\Modules\CircleInvoices\App\Http\Controllers\CircleXoInvoiceController::class, 'update'])->name('invoices.update');
    Route::delete('profile/invoices/{model}', [\Modules\CircleInvoices\App\Http\Controllers\CircleXoInvoiceController::class, 'destroy'])->name('invoices.destroy');
});


Route::middleware(['web', 'splade'])->name('invoices.')->group(function () {
    Route::get('invoices/{model}/show', [\Modules\CircleInvoices\App\Http\Controllers\CircleXoInvoiceController::class, 'showPublic'])->name('public.show');
    Route::get('invoices//{model}/print', [\Modules\CircleInvoices\App\Http\Controllers\CircleXoInvoiceController::class, 'printPublic'])->name('public.print');
});

