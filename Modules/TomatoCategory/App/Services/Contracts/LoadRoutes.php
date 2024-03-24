<?php

namespace Modules\TomatoCategory\App\Services\Contracts;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\TomatoCategory\App\Services\CategoryServices;

trait LoadRoutes
{
    public static function loadRoutes()
    {
        $types = self::get();
        foreach ($types as $type) {
            Route::middleware(['web','auth', 'splade', 'verified'])
                ->prefix('admin/types/'. $type->for . '/'.$type->type )
                ->name('admin.types.'.$type->for.'.'.$type->type.'.')
                ->group(function () use ($type) {
                Route::get('/', function () use ($type) {
                    return (new self)->index($type->for, $type->type, $type->label, $type->back);
                })->name('index');
                Route::get('/create', function () use ($type){
                    return (new self)->create($type->for, $type->type, $type->label);
                })->name('create');
                Route::post('/create', function (Request $request) use ($type){
                    return (new self)->store($request, $type->for, $type->type, $type->label);
                })->name('store');
                Route::get('/edit/{item}', function (\Modules\TomatoCategory\App\Models\Type $item) use ($type){
                    return (new self)->edit($item, $type->for, $type->type, $type->label);
                })->name('edit');
                Route::delete('/delete/{item}', function (\Modules\TomatoCategory\App\Models\Type $item) use ($type){
                    return (new self)->destroy($item, $type->for, $type->type, $type->label);
                })->name('destroy');
            });
        }
    }
}
