<?php

use Illuminate\Support\Facades\Route;
use Modules\CircleXO\App\Http\Controllers\CircleXOController;
use Modules\CircleXO\App\Http\Controllers\AuthController;
use Modules\CircleXO\App\Http\Controllers\ProfileController;

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

Route::middleware(['splade'])->group(function (){
    Route::get('/', [CircleXOController::class, 'index'])->name('home');
});

Route::middleware(['splade'])->name('account.')->prefix('auth')->group(function (){
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');
    Route::get('/reset', [AuthController::class, 'reset'])->name('reset');
    Route::get('/otp', [AuthController::class, 'otp'])->name('otp');
    Route::post('/otp', [AuthController::class, 'checkOtp'])->name('otp.check');
    Route::get('/email', [AuthController::class, 'email'])->name('email');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'check'])->name('login.check');
});

Route::middleware(['splade', 'auth:accounts'])->prefix('profile')->name('profile.')->group(function (){
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::get('/edit/avatar', [ProfileController::class, 'avatar'])->name('avatar.show');
    Route::get('/edit/cover', [ProfileController::class, 'cover'])->name('cover.show');
    Route::get('/edit/info', [ProfileController::class, 'info'])->name('info.show');
    Route::post('/edit/info', [ProfileController::class, 'updateInfo'])->name('info.update');
    Route::get('/edit/social', [ProfileController::class, 'social'])->name('social.show');
    Route::post('/edit/meta', [ProfileController::class, 'updateMeta'])->name('meta.update');
    Route::post('/edit/media', [ProfileController::class, 'updateMedia'])->name('media.update');
});

Route::middleware(['splade'])->group(function (){
    Route::get('/{username}', [CircleXOController::class, 'profile'])->name('profile');
});
