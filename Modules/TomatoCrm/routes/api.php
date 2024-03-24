<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
*/

if(config('tomato-crm.features.apis')){
    Route::name('api.')->middleware(['throttle:500'])->prefix('api')->group(function (){
        Route::post('login',[\Modules\TomatoCrm\App\Http\Controllers\APIs\AuthController::class,'login'])->name('login');
        Route::post('register',[\Modules\TomatoCrm\App\Http\Controllers\APIs\AuthController::class,'register'])->name('register');
        Route::post('reset',[\Modules\TomatoCrm\App\Http\Controllers\APIs\AuthController::class,'reset'])->name('reset');
        Route::post('resend',[\Modules\TomatoCrm\App\Http\Controllers\APIs\AuthController::class,'resend'])->name('resend');
        Route::post('otp',[\Modules\TomatoCrm\App\Http\Controllers\APIs\AuthController::class,'otp'])->name('otp');
        Route::post('otp-check',[\Modules\TomatoCrm\App\Http\Controllers\APIs\AuthController::class,'otpCheck'])->name('otp.check');
        Route::post('password',[\Modules\TomatoCrm\App\Http\Controllers\APIs\AuthController::class,'password'])->name('password');

        Route::middleware(['auth:sanctum'])->group(function (){
            //Auth
            Route::get('profile',[\Modules\TomatoCrm\App\Http\Controllers\APIs\ProfileController::class,'profile'])->name('profile.user');
            Route::get('profile',[\Modules\TomatoCrm\App\Http\Controllers\APIs\ProfileController::class,'profile'])->name('profile.user');
            Route::get('profile',[\Modules\TomatoCrm\App\Http\Controllers\APIs\ProfileController::class,'profile'])->name('profile.user');
            Route::post('profile',[\Modules\TomatoCrm\App\Http\Controllers\APIs\ProfileController::class,'update'])->name('profile.update');
            Route::post('profile/password',[\Modules\TomatoCrm\App\Http\Controllers\APIs\ProfileController::class,'password'])->name('profile.password');
            Route::delete('profile/destroy',[\Modules\TomatoCrm\App\Http\Controllers\APIs\ProfileController::class,'destroy'])->name('profile.destroy');
            Route::post('profile/logout',[\Modules\TomatoCrm\App\Http\Controllers\APIs\ProfileController::class,'logout'])->name('profile.logout');
        });
    });


    if(config('tomato-crm.features.contacts')){
        Route::middleware(['auth:sanctum'])->name('api.')->prefix('api')->group(function (){
            Route::post('contact',[\Modules\TomatoCrm\App\Http\Controllers\ContactController::class,'store'])->name('contact.store');
        });
    }

    if(config('tomato-crm.features.locations')){
        Route::middleware(['auth:sanctum'])->name('api.')->prefix('api')->group(function (){
            Route::get('locations',[\Modules\TomatoCrm\App\Http\Controllers\LocationController::class,'index'])->name('locations.index');
            Route::get('locations/{model}',[\Modules\TomatoCrm\App\Http\Controllers\LocationController::class,'show'])->name('locations.show');
        });
    }
}
