<?php

namespace App\Categories;

use App\Topics\Topic;
use App\Topics\TopicCategory;
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

    public function topics()
    {
        return $this->hasManyThrough(Topic::class, TopicCategory::class, 'category_id', 'id', 'topic_id');
    }

    /**
     * @return Topic[]
     */
    public function getTopics()
    {
        return $this->topics()->get()->all();
    }
}
