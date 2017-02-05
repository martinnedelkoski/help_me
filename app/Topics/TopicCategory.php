<?php

namespace App\Topics;

use App\Categories\Category;
use Illuminate\Database\Eloquent\Model;

class TopicCategory extends Model
{
    protected $table = 'topics_categories';

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function setTopic(Topic $topic)
    {
        $this->topic()->associate($topic);
    }

    /**
     * @return Topic
     */
    public function getTopic()
    {
        return $this->topic;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function setCategory(Category $category)
    {
        $this->category()->associate($category);
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
