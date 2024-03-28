<?php

use Illuminate\Support\Facades\Route;
use Modules\TomatoSupport\App\Http\Controllers\TomatoSupportController;

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

if(config('tomato-support.features.faq')) {
    Route::middleware(['web', 'auth', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/questions', [\Modules\TomatoSupport\App\Http\Controllers\QuestionController::class, 'index'])->name('questions.index');
        Route::get('admin/questions/api', [\Modules\TomatoSupport\App\Http\Controllers\QuestionController::class, 'api'])->name('questions.api');
        Route::get('admin/questions/create', [\Modules\TomatoSupport\App\Http\Controllers\QuestionController::class, 'create'])->name('questions.create');
        Route::post('admin/questions', [\Modules\TomatoSupport\App\Http\Controllers\QuestionController::class, 'store'])->name('questions.store');
        Route::get('admin/questions/{model}', [\Modules\TomatoSupport\App\Http\Controllers\QuestionController::class, 'show'])->name('questions.show');
        Route::get('admin/questions/{model}/edit', [\Modules\TomatoSupport\App\Http\Controllers\QuestionController::class, 'edit'])->name('questions.edit');
        Route::post('admin/questions/{model}', [\Modules\TomatoSupport\App\Http\Controllers\QuestionController::class, 'update'])->name('questions.update');
        Route::delete('admin/questions/{model}', [\Modules\TomatoSupport\App\Http\Controllers\QuestionController::class, 'destroy'])->name('questions.destroy');
    });
}

if(config('tomato-support.features.tickets')) {
    Route::middleware(['web', 'auth', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/tickets', [\Modules\TomatoSupport\App\Http\Controllers\TicketController::class, 'index'])->name('tickets.index');
        Route::get('admin/tickets/api', [\Modules\TomatoSupport\App\Http\Controllers\TicketController::class, 'api'])->name('tickets.api');
        Route::get('admin/tickets/create', [\Modules\TomatoSupport\App\Http\Controllers\TicketController::class, 'create'])->name('tickets.create');
        Route::post('admin/tickets', [\Modules\TomatoSupport\App\Http\Controllers\TicketController::class, 'store'])->name('tickets.store');
        Route::get('admin/tickets/{model}', [\Modules\TomatoSupport\App\Http\Controllers\TicketController::class, 'show'])->name('tickets.show');
        Route::get('admin/tickets/{model}/comments', [\Modules\TomatoSupport\App\Http\Controllers\TicketController::class, 'comments'])->name('tickets.comments');
        Route::post('admin/tickets/{model}/comments', [\Modules\TomatoSupport\App\Http\Controllers\TicketController::class, 'send'])->name('tickets.send');
        Route::get('admin/tickets/{model}/edit', [\Modules\TomatoSupport\App\Http\Controllers\TicketController::class, 'edit'])->name('tickets.edit');
        Route::post('admin/tickets/{model}', [\Modules\TomatoSupport\App\Http\Controllers\TicketController::class, 'update'])->name('tickets.update');
        Route::delete('admin/tickets/{model}', [\Modules\TomatoSupport\App\Http\Controllers\TicketController::class, 'destroy'])->name('tickets.destroy');
    });
}
