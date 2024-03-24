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

Route::name('api.')->middleware(['auth:sanctum'])->prefix('api')->group(function (){
    Route::get('countires',[\Modules\TomatoLocations\App\Http\Controllers\CountryController::class,'index'])->name('countires.index');
    Route::get('countires/{model}',[\Modules\TomatoLocations\App\Http\Controllers\CountryController::class,'show'])->name('countires.show');
    Route::get('cities',[\Modules\TomatoLocations\App\Http\Controllers\CityController::class,'index'])->name('cities.index');
    Route::get('cities/{model}',[\Modules\TomatoLocations\App\Http\Controllers\CityController::class,'show'])->name('cities.show');
    Route::get('areas',[\Modules\TomatoLocations\App\Http\Controllers\AreaController::class,'index'])->name('areas.index');
    Route::get('areas/{model}',[\Modules\TomatoLocations\App\Http\Controllers\AreaController::class,'show'])->name('areas.show');
});
