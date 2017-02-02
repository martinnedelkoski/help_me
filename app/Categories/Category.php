<?php

namespace App\Categories;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    public function getId()
    {
        return $this->getAttribute("id");
    }

    public function getName()
    {
        return $this->getAttribute("name");
    }

    public function setName($name)
    {
        $this->setAttribute("name", $name);
    }
}
