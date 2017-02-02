<?php

namespace App\Users\Providers;

use App\Users\Repositories\EloquentUsersRepository;
use App\Users\Repositories\UsersRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class UsersRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            UsersRepositoryInterface::class,
            EloquentUsersRepository::class
        );
    }
}
