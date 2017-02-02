<?php

namespace App\Categories\Handlers;

use App\Categories\Category;
use App\Categories\Commands\StoreCategoryCommand;
use App\Categories\Repositories\CategoriesRepositoryInterface;

class StoreCategoryCommandHandler
{
    private $categories;

    public function __construct(CategoriesRepositoryInterface $categories)
    {
        $this->$categories = $categories;
    }

    public function handle(StoreCategoryCommand $command)
    {
        $category = new Category();

        $category->setContent($command->getName());

        $this->categories->store($category);
    }
}
