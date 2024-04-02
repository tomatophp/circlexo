<?php

use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo('/auth/login');
        $middleware->redirectUsersTo('/profile');
        $middleware->group('splade', [
            \ProtoneMedia\Splade\Http\SpladeMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(\ProtoneMedia\Splade\SpladeCore::exceptionHandler($exceptions->handler));
        $exceptions->reportable(function (Throwable $e) {
            if(config('services.discord.error-webhook-active')){
                try {
                    $user = User::first();
                    $user->notifyDiscord(
                        title: "================= ERROR ================= \n".'MESSAGE: '.$e->getMessage() . ' | FILE: '.$e->getFile().' | LINE: '.$e->getLine().' | URL: ' . url()->current(),
                        webhook: config('services.discord.error-webhook')
                    );
                }catch (\Exception $exception){
                    // do nothing
                }
            }
        });

    })->create();
