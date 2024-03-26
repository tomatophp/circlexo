<?php

use Illuminate\Support\Facades\Route;
use Modules\CircleXO\App\Http\Controllers\CircleXOController;
use Modules\CircleXO\App\Http\Controllers\AuthController;
use Modules\CircleXO\App\Http\Controllers\ProfileController;
use Modules\CircleXO\App\Http\Controllers\ProfileListingController;
use Modules\CircleXO\App\Http\Controllers\ProfileNotificationsController;
use Modules\CircleXO\App\Http\Controllers\ProfileActionsController;

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

Route::middleware(['splade', 'auth', 'web'])->group(function (){
    Route::post('/account/{account}', [CircleXOController::class, 'verify'])->name('account.verify');
});

Route::middleware(['splade'])->group(function (){
    Route::get('/', [CircleXOController::class, 'index'])->name('home');
});

Route::middleware(['splade', 'throttle:10'])->name('account.')->prefix('auth')->group(function (){
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');
    Route::get('/reset', [AuthController::class, 'reset'])->name('reset');
    Route::post('/reset', [AuthController::class, 'email'])->name('email');
    Route::get('/password', [AuthController::class, 'password'])->name('password');
    Route::post('/password', [AuthController::class, 'passwordUpdate'])->name('password.update');
    Route::get('/otp', [AuthController::class, 'otp'])->name('otp');
    Route::post('/otp', [AuthController::class, 'checkOtp'])->name('otp.check');
    Route::post('/otp/resend', [AuthController::class, 'resend'])->name('otp.resend');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'check'])->name('login.check');
});

Route::middleware(['splade', 'auth:accounts'])->prefix('profile')->name('profile.')->group(function (){
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::get('/qr', [ProfileController::class, 'qr'])->name('qr');
    Route::post('/qr', [ProfileController::class, 'qrUpdate'])->name('qr.update');
    Route::get('/following', [ProfileController::class, 'following'])->name('following');
    Route::get('/messages', [ProfileController::class, 'messages'])->name('messages');
    Route::get('/messages/{message}', [ProfileController::class, 'message'])->name('messages.show');
    Route::get('/edit/password', [ProfileController::class, 'password'])->name('password.show');
    Route::post('/edit/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::get('/edit/avatar', [ProfileController::class, 'avatar'])->name('avatar.show');
    Route::get('/edit/cover', [ProfileController::class, 'cover'])->name('cover.show');
    Route::get('/edit/info', [ProfileController::class, 'info'])->name('info.show');
    Route::post('/edit/info', [ProfileController::class, 'updateInfo'])->name('info.update');
    Route::get('/edit/social', [ProfileController::class, 'social'])->name('social.show');
    Route::post('/edit/meta', [ProfileController::class, 'updateMeta'])->name('meta.update');
    Route::post('/edit/media', [ProfileController::class, 'updateMedia'])->name('media.update');
    Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');
});

Route::middleware(['splade', 'auth:accounts'])->prefix('profile/listing')->name('profile.listing.')->group(function () {
    Route::get('/create', [ProfileListingController::class, 'create'])->name('create');
    Route::post('/', [ProfileListingController::class, 'store'])->name('store');
    Route::get('/{listing}', [ProfileListingController::class, 'show'])->name('show');
    Route::get('/{listing}/edit', [ProfileListingController::class, 'edit'])->name('edit');
    Route::post('/{listing}', [ProfileListingController::class, 'update'])->name('update');
    Route::delete('/{listing}', [ProfileListingController::class, 'destroy'])->name('destroy');
});

Route::middleware(['splade', 'auth:accounts'])->prefix('profile/actions')->name('profile.actions.')->group(function () {
    Route::get('/follow/{account}', [ProfileActionsController::class, 'follow'])->name('follow');
    Route::get('/unfollow/{account}', [ProfileActionsController::class, 'unfollow'])->name('unfollow');
});

Route::middleware([ 'splade', 'auth:accounts'])->prefix('profile/notifications')->name('profile.notifications.')->group(function() {
    Route::get('/', [ProfileNotificationsController::class, 'index'])->name('index');
    Route::post('/read', [ProfileNotificationsController::class, 'read'])->name('read');
    Route::delete('/clear', [ProfileNotificationsController::class, 'clearUser'])->name('clear');
    Route::get('/{model}', [ProfileNotificationsController::class, 'show'])->name('show');
    Route::post('/{model}', [ProfileNotificationsController::class, 'readSelected'])->name('read.selected');
    Route::delete('/{model}', [ProfileNotificationsController::class, 'destroy'])->name('destroy');
});


Route::middleware(['splade'])->group(function (){
    Route::get('/{username}', [CircleXOController::class, 'profile'])->name('profile');
    Route::get('/{username}/contact', [CircleXOController::class, 'contact'])->name('home.contact');
    Route::post('/{username}/contact', [CircleXOController::class, 'send'])->name('home.contact.send');
    Route::get('/{username}/posts/{post}', [CircleXOController::class, 'post'])->name('home.posts');
});
