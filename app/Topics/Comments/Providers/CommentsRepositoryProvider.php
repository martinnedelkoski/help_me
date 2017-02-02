<?php

/**
 * Created by PhpStorm.
 * User: jovanmilenkoski
 * Date: 1/30/17
 * Time: 23:14
 */
namespace App\Topics\Comments\Providers;

use App\Topics\Comments\Repositories\CommentsRepositoryInterface;
use App\Topics\Comments\Repositories\EloquentCommentsRepository;
use Illuminate\Support\ServiceProvider;

class CommentsRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            EloquentCommentsRepository::class,
            CommentsRepositoryInterface::class
        );
    }
}
