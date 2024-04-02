<?php

use Illuminate\Support\Facades\Route;
use Modules\CircleNotes\App\Http\Controllers\CircleXoNoteController;
use Modules\CircleNotes\App\Http\Controllers\CircleXoNoteShareController;

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

Route::middleware(['auth:accounts','app:circle-notes', 'splade', 'verified'])->name('profile.')->group(function () {
    Route::get('profile/notes', [CircleXoNoteController::class, 'index'])->name('notes.index');
    Route::get('profile/notes/create', [CircleXoNoteController::class, 'create'])->name('notes.create');
    Route::post('profile/notes', [CircleXoNoteController::class, 'store'])->name('notes.store');
    Route::get('profile/notes/{model}', [CircleXoNoteController::class, 'show'])->name('notes.show');
    Route::get('profile/notes/{model}/edit', [CircleXoNoteController::class, 'edit'])->name('notes.edit');
    Route::post('profile/notes/{model}', [CircleXoNoteController::class, 'update'])->name('notes.update');
    Route::delete('profile/notes/{model}', [CircleXoNoteController::class, 'destroy'])->name('notes.destroy');
    Route::get('profile/notes/{model}/share', [CircleXoNoteShareController::class, 'share'])->name('notes.share');
    Route::post('profile/notes/{model}/generate-one-time-link', [CircleXoNoteShareController::class, 'generateOneTimeLink'])->name('notes.generate-one-time-link');
    Route::get('/{username}/notes/{slug}', [CircleXoNoteShareController::class, 'showShareLink'])->name('note.share');
    Route::get('/{username}/note/{token}', [CircleXoNoteShareController::class, 'showShareOneTimeLink'])->name('note.share-one-time-link');
});

Route::middleware(['splade'])->name('profile.')->group(function () {
    Route::get('/{username}/notes/{slug}', [CircleXoNoteShareController::class, 'showShareLink'])->name('note.share');
    Route::get('/{username}/note/{token}', [CircleXoNoteShareController::class, 'showShareOneTimeLink'])->name('note.share-one-time-link');
});
