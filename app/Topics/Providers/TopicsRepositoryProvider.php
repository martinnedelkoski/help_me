<?php

namespace App\Topics\Providers;

use App\Topics\Repositories\EloquentTopicsRepository;
use App\Topics\Repositories\TopicsRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class TopicsRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            TopicsRepositoryInterface::class,
            EloquentTopicsRepository::class
        );
    }
}
