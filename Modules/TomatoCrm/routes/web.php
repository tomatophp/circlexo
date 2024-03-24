<?php

use Illuminate\Support\Facades\Route;
use Modules\TomatoCrm\App\Http\Controllers\TomatoCrmController;

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

if(config('tomato-crm.features.accounts')){
    Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/accounts', [\Modules\TomatoCrm\App\Http\Controllers\AccountController::class, 'index'])->name('accounts.index');
        //Account Types

        Route::get('admin/accounts/groups', [\Modules\TomatoCrm\App\Http\Controllers\AccountController::class, 'groups'])->name('accounts.groups');
        Route::post('admin/accounts/types', [\Modules\TomatoCrm\App\Http\Controllers\AccountController::class, 'typesStore'])->name('accounts.typesStore');
        Route::post('admin/accounts/groups', [\Modules\TomatoCrm\App\Http\Controllers\AccountController::class, 'groupsStore'])->name('accounts.groups.store');
        Route::get('admin/accounts/api', [\Modules\TomatoCrm\App\Http\Controllers\AccountController::class, 'api'])->name('accounts.api');
        Route::get('admin/accounts/create', [\Modules\TomatoCrm\App\Http\Controllers\AccountController::class, 'create'])->name('accounts.create');
        Route::get('admin/accounts/import', [\Modules\TomatoCrm\App\Http\Controllers\AccountController::class, 'import'])->name('accounts.import');
        Route::post('admin/accounts/import', [\Modules\TomatoCrm\App\Http\Controllers\AccountController::class, 'importStore'])->name('accounts.import.store');
        Route::get('admin/accounts/{model}/password', [\Modules\TomatoCrm\App\Http\Controllers\AccountController::class, 'password'])->name('accounts.password');
        Route::post('admin/accounts/{model}/password', [\Modules\TomatoCrm\App\Http\Controllers\AccountController::class, 'updatePassword'])->name('accounts.password.update');
        if(config('tomato-crm.features.notifications')) {
            Route::get('admin/accounts/notifications', [\Modules\TomatoCrm\App\Http\Controllers\NotificationsController::class, 'index'])->name('accounts.notifications.index');
            Route::get('admin/accounts/{model}/notifications', [\Modules\TomatoCrm\App\Http\Controllers\NotificationsController::class, 'user'])->name('accounts.notifications');
            Route::post('admin/accounts/notifications', [\Modules\TomatoCrm\App\Http\Controllers\NotificationsController::class, 'send'])->name('accounts.notifications.send');
        }
        if(config('tomato-crm.features.locations')) {
            Route::get('admin/accounts/{model}/address', [\Modules\TomatoCrm\App\Http\Controllers\AccountController::class, 'addressView'])->name('accounts.address');
            Route::post('admin/accounts/{model}/address', [\Modules\TomatoCrm\App\Http\Controllers\AccountController::class, 'address'])->name('accounts.address.add');
        }
        Route::post('admin/accounts', [\Modules\TomatoCrm\App\Http\Controllers\AccountController::class, 'store'])->name('accounts.store');
        Route::get('admin/accounts/{model}', [\Modules\TomatoCrm\App\Http\Controllers\AccountController::class, 'show'])->name('accounts.show');
        Route::get('admin/accounts/{model}/edit', [\Modules\TomatoCrm\App\Http\Controllers\AccountController::class, 'edit'])->name('accounts.edit');
        Route::post('admin/accounts/{model}', [\Modules\TomatoCrm\App\Http\Controllers\AccountController::class, 'update'])->name('accounts.update');
        Route::delete('admin/accounts/{model}', [\Modules\TomatoCrm\App\Http\Controllers\AccountController::class, 'destroy'])->name('accounts.destroy');
    });
}

if(config('tomato-crm.features.contacts')) {
    Route::middleware(['web', 'auth', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/contacts', [\Modules\TomatoCrm\App\Http\Controllers\ContactController::class, 'index'])->name('contacts.index');
        Route::get('admin/contacts/api', [\Modules\TomatoCrm\App\Http\Controllers\ContactController::class, 'api'])->name('contacts.api');
        Route::get('admin/contacts/create', [\Modules\TomatoCrm\App\Http\Controllers\ContactController::class, 'create'])->name('contacts.create');
        Route::post('admin/contacts', [\Modules\TomatoCrm\App\Http\Controllers\ContactController::class, 'store'])->name('contacts.store');
        Route::get('admin/contacts/{model}', [\Modules\TomatoCrm\App\Http\Controllers\ContactController::class, 'show'])->name('contacts.show');
        Route::get('admin/contacts/{model}/edit', [\Modules\TomatoCrm\App\Http\Controllers\ContactController::class, 'edit'])->name('contacts.edit');
        Route::post('admin/contacts/{model}', [\Modules\TomatoCrm\App\Http\Controllers\ContactController::class, 'update'])->name('contacts.update');
        Route::delete('admin/contacts/{model}', [\Modules\TomatoCrm\App\Http\Controllers\ContactController::class, 'destroy'])->name('contacts.destroy');
        Route::post('admin/contacts/{model}/close', [\Modules\TomatoCrm\App\Http\Controllers\ContactController::class, 'close'])->name('contacts.close');
    });
}


if(config('tomato-crm.features.locations')) {
    Route::middleware(['web', 'auth', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/locations', [\Modules\TomatoCrm\App\Http\Controllers\LocationController::class, 'index'])->name('locations.index');
        Route::get('admin/locations/api', [\Modules\TomatoCrm\App\Http\Controllers\LocationController::class, 'api'])->name('locations.api');
        Route::get('admin/locations/create', [\Modules\TomatoCrm\App\Http\Controllers\LocationController::class, 'create'])->name('locations.create');
        Route::post('admin/locations', [\Modules\TomatoCrm\App\Http\Controllers\LocationController::class, 'store'])->name('locations.store');
        Route::get('admin/locations/{model}', [\Modules\TomatoCrm\App\Http\Controllers\LocationController::class, 'show'])->name('locations.show');
        Route::get('admin/locations/{model}/edit', [\Modules\TomatoCrm\App\Http\Controllers\LocationController::class, 'edit'])->name('locations.edit');
        Route::post('admin/locations/{model}', [\Modules\TomatoCrm\App\Http\Controllers\LocationController::class, 'update'])->name('locations.update');
        Route::delete('admin/locations/{model}', [\Modules\TomatoCrm\App\Http\Controllers\LocationController::class, 'destroy'])->name('locations.destroy');
    });
}

if(config('tomato-crm.features.groups')) {
    Route::middleware(['web', 'auth', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/groups', [\Modules\TomatoCrm\App\Http\Controllers\GroupsController::class, 'index'])
            ->name('groups.index');
        Route::get('admin/groups/api', [\Modules\TomatoCrm\App\Http\Controllers\GroupsController::class, 'api'])->name('groups.api');
        Route::get('admin/groups/create', [\Modules\TomatoCrm\App\Http\Controllers\GroupsController::class, 'create'])->name('groups.create');
        Route::post('admin/groups', [\Modules\TomatoCrm\App\Http\Controllers\GroupsController::class, 'store'])->name('groups.store');
        Route::get('admin/groups/{model}', [\Modules\TomatoCrm\App\Http\Controllers\GroupsController::class, 'show'])->name('groups.show');
        Route::get('admin/groups/{model}/edit', [\Modules\TomatoCrm\App\Http\Controllers\GroupsController::class, 'edit'])->name('groups.edit');
        Route::post('admin/groups/{model}', [\Modules\TomatoCrm\App\Http\Controllers\GroupsController::class, 'update'])->name('groups.update');
        Route::delete('admin/groups/{model}', [\Modules\TomatoCrm\App\Http\Controllers\GroupsController::class, 'destroy'])->name('groups.destroy');
    });
}

if(config('tomato-crm.features.requests')) {
    Route::middleware(['auth', 'splade', 'verified', 'web'])->name('admin.')->group(function () {
        Route::get('admin/account-requests', [\Modules\TomatoCrm\App\Http\Controllers\AccountRequestController::class, 'index'])->name('account-requests.index');
        Route::post('admin/account-requests/{model}/meta/approve-all', [\Modules\TomatoCrm\App\Http\Controllers\AccountRequestController::class, 'approveAll'])->name('account-requests.approve.all');
        Route::post('admin/account-requests/{model}/meta/approve', [\Modules\TomatoCrm\App\Http\Controllers\AccountRequestController::class, 'approve'])->name('account-requests.approve');
        Route::post('admin/account-requests/{model}/meta/reject', [\Modules\TomatoCrm\App\Http\Controllers\AccountRequestController::class, 'reject'])->name('account-requests.reject');
        Route::get('admin/account-requests/api', [\Modules\TomatoCrm\App\Http\Controllers\AccountRequestController::class, 'api'])->name('account-requests.api');
        Route::post('admin/account-requests', [\Modules\TomatoCrm\App\Http\Controllers\AccountRequestController::class, 'store'])->name('account-requests.store');
        Route::get('admin/account-requests/{model}', [\Modules\TomatoCrm\App\Http\Controllers\AccountRequestController::class, 'show'])->name('account-requests.show');
        Route::post('admin/account-requests/{model}', [\Modules\TomatoCrm\App\Http\Controllers\AccountRequestController::class, 'update'])->name('account-requests.update');
        Route::delete('admin/account-requests/{model}', [\Modules\TomatoCrm\App\Http\Controllers\AccountRequestController::class, 'destroy'])->name('account-requests.destroy');
    });
}
