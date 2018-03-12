<?php

namespace App\Core;

use Illuminate\Bus\Dispatcher;
use Illuminate\Support\ServiceProvider;

class BusServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @param \Illuminate\Bus\Dispatcher $dispatcher
     */
    public function boot(Dispatcher $dispatcher)
    {
        $dispatcher->mapUsing(function ($command) {
            $className = get_class($command);

            $parts = explode('Commands', $className);

            $handler = $parts[0].'Handlers'.$parts[1].'Handler@handle';

            return $handler;
        });
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }
}

