<?php

use Illuminate\Database\Seeder;
use App\Categories\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();

        $category->setName('science');
        $category->timestamps = false;
        $category->save();

        $category = new Category();

        $category->setName('technology');
        $category->timestamps = false;
        $category->save();

        $category = new Category();

        $category->setName('marketing');
        $category->timestamps = false;
        $category->save();

        $category = new Category();

        $category->setName('programming');
        $category->timestamps = false;
        $category->save();
    }
}
