<?php

namespace App\Categories\Handlers;

use App\Categories\Category;
use App\Categories\Commands\StoreCategoryCommand;
use App\Categories\Repositories\CategoriesRepositoryInterface;

class StoreCategoryCommandHandler
{
    private $categoriesRepository;

    public function __construct(CategoriesRepositoryInterface $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    public function handle(StoreCategoryCommand $command)
    {
        $category = new Category();

        $category->setName($command->getName());

        $this->categoriesRepository->store($category);
    }
}
