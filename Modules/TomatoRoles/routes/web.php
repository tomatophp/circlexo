<?php

use Illuminate\Support\Facades\Route;
use Modules\TomatoRoles\App\Http\Controllers\TomatoRolesController;

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

use Modules\TomatoRoles\App\Http\Middleware\Can;

Route::middleware(['web', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/users', [\Modules\TomatoRoles\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('admin/users/api', [\Modules\TomatoRoles\App\Http\Controllers\UserController::class, 'api'])->name('users.api');
    Route::get('admin/users/create', [\Modules\TomatoRoles\App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::post('admin/users', [\Modules\TomatoRoles\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::get('admin/users/{model}', [\Modules\TomatoRoles\App\Http\Controllers\UserController::class, 'show'])->name('users.show');
    Route::get('admin/users/{model}/edit', [\Modules\TomatoRoles\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::post('admin/users/{model}', [\Modules\TomatoRoles\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('admin/users/{model}', [\Modules\TomatoRoles\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
});

Route::middleware(['web', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/roles', [\Modules\TomatoRoles\App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::get('admin/roles/api', [\Modules\TomatoRoles\App\Http\Controllers\RoleController::class, 'api'])->name('roles.api');
    Route::get('admin/roles/create', [\Modules\TomatoRoles\App\Http\Controllers\RoleController::class, 'create'])->name('roles.create');
    Route::post('admin/roles', [\Modules\TomatoRoles\App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
    Route::get('admin/roles/{model}', [\Modules\TomatoRoles\App\Http\Controllers\RoleController::class, 'show'])->name('roles.show');
    Route::get('admin/roles/{model}/edit', [\Modules\TomatoRoles\App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
    Route::post('admin/roles/{model}', [\Modules\TomatoRoles\App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
    Route::delete('admin/roles/{model}', [\Modules\TomatoRoles\App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');
});


Route::middleware(['web', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::post('/admin/developer/password', [\Modules\TomatoRoles\App\Http\Controllers\DeveloperController::class, 'check'])->name('developer.check');
    Route::post('/admin/developer/logout', [\Modules\TomatoRoles\App\Http\Controllers\DeveloperController::class, 'logout'])->name('developer.logout');
});
