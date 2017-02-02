<?php

/**
 * Created by PhpStorm.
 * User: jovanmilenkoski
 * Date: 1/30/17
 * Time: 23:41
 */
namespace App\Categories\Providers;

use App\Categories\Repositories\EloquentCategoriesRepository;
use Illuminate\Support\ServiceProvider;

class CategoriesRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            EloquentCategoriesRepository::class,
            CategoriesRepositoryProvider::class
        );
    }
}
