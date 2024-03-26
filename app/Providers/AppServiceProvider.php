<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\TomatoCrm\App\Facades\TomatoCrm;
use ProtoneMedia\Splade\Facades\Splade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Splade::defaultModalCloseExplicitly();
    }
}
