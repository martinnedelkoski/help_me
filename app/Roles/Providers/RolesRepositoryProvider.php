<?php

namespace App\Roles\Providers;

use App\Roles\Repositories\EloquentRolesRepository;
use App\Roles\Repositories\RolesRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RolesRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            RolesRepositoryInterface::class,
            EloquentRolesRepository::class
        );
    }
}
