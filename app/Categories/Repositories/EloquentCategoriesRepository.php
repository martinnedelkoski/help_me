<?php

namespace App\Categories\Repositories;

use App\Categories\Category;

class EloquentCategoriesRepository implements CategoriesRepositoryInterface
{
    public function find($id)
    {
        return Category::where("id", $id)->get()->first();
    }

    public function store(Category $category)
    {
        $category->save();
    }

    public function findByName($name)
    {
        return Category::where('name', $name)->get()->first();
    }

}
