<?php

namespace App\Categories\Repositories;

use App\Categories\Category;

interface CategoriesRepositoryInterface
{
    public function store(Category $topic);

    /**
     * @param $id
     * @return Category
     */
    public function find($id);

    /**
     * @param string $name
     * @return Category
     */
    public function findByName($name);
}