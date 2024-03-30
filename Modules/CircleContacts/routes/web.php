<?php

use Illuminate\Support\Facades\Route;
use Modules\CircleContacts\App\Http\Controllers\CircleContactsController;

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


Route::middleware(['auth:accounts','app:circle-contacts', 'splade', 'verified'])->name('profile.')->group(function () {
    Route::get('profile/contacts', [\Modules\CircleContacts\App\Http\Controllers\CircleXoContactController::class, 'index'])->name('contacts.index');
    Route::get('profile/contacts/api', [\Modules\CircleContacts\App\Http\Controllers\CircleXoContactController::class, 'api'])->name('contacts.api');
    Route::get('profile/contacts/api', [\Modules\CircleContacts\App\Http\Controllers\CircleXoContactController::class, 'api'])->name('contacts.api');
    Route::get('profile/contacts/create', [\Modules\CircleContacts\App\Http\Controllers\CircleXoContactController::class, 'create'])->name('contacts.create');
    Route::post('profile/contacts', [\Modules\CircleContacts\App\Http\Controllers\CircleXoContactController::class, 'store'])->name('contacts.store');
    Route::get('profile/contacts/{model}', [\Modules\CircleContacts\App\Http\Controllers\CircleXoContactController::class, 'show'])->name('contacts.show');
    Route::get('profile/contacts/{model}/edit', [\Modules\CircleContacts\App\Http\Controllers\CircleXoContactController::class, 'edit'])->name('contacts.edit');
    Route::post('profile/contacts/{model}', [\Modules\CircleContacts\App\Http\Controllers\CircleXoContactController::class, 'update'])->name('contacts.update');
    Route::delete('profile/contacts/{model}', [\Modules\CircleContacts\App\Http\Controllers\CircleXoContactController::class, 'destroy'])->name('contacts.destroy');
});

Route::middleware(['auth:accounts','app:circle-contacts', 'splade', 'verified'])->prefix('/profile/contacts/{account}/meta')->name('profile.contacts.meta.')->group(function () {
    Route::get('/create', [\Modules\CircleContacts\App\Http\Controllers\CircleXoContactsMetaController::class, 'create'])->name('create');
    Route::post('/create', [\Modules\CircleContacts\App\Http\Controllers\CircleXoContactsMetaController::class, 'store'])->name('store');
    Route::get('/{model}/edit', [\Modules\CircleContacts\App\Http\Controllers\CircleXoContactsMetaController::class, 'edit'])->name('edit');
    Route::post('/{model}', [\Modules\CircleContacts\App\Http\Controllers\CircleXoContactsMetaController::class, 'update'])->name('update');
    Route::delete('/{model}', [\Modules\CircleContacts\App\Http\Controllers\CircleXoContactsMetaController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth:accounts','app:circle-contacts', 'splade', 'verified'])->name('profile.')->group(function () {
    Route::get('profile/groups', [\Modules\CircleContacts\App\Http\Controllers\CircleXoContactsGroupController::class, 'index'])->name('groups.index');
    Route::get('profile/groups/api', [\Modules\CircleContacts\App\Http\Controllers\CircleXoContactsGroupController::class, 'api'])->name('groups.api');
    Route::get('profile/groups/create', [\Modules\CircleContacts\App\Http\Controllers\CircleXoContactsGroupController::class, 'create'])->name('groups.create');
    Route::post('profile/groups', [\Modules\CircleContacts\App\Http\Controllers\CircleXoContactsGroupController::class, 'store'])->name('groups.store');
    Route::get('profile/groups/{model}', [\Modules\CircleContacts\App\Http\Controllers\CircleXoContactsGroupController::class, 'show'])->name('groups.show');
    Route::get('profile/groups/{model}/edit', [\Modules\CircleContacts\App\Http\Controllers\CircleXoContactsGroupController::class, 'edit'])->name('groups.edit');
    Route::post('profile/groups/{model}', [\Modules\CircleContacts\App\Http\Controllers\CircleXoContactsGroupController::class, 'update'])->name('groups.update');
    Route::delete('profile/groups/{model}', [\Modules\CircleContacts\App\Http\Controllers\CircleXoContactsGroupController::class, 'destroy'])->name('groups.destroy');
});
