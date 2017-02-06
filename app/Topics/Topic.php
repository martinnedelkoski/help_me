<?php

namespace App\Topics;

use App\Categories\Category;
use App\Topics\Comments\Comment;
use App\Users\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = "topics";

    public function getId()
    {
        return $this->getAttribute("id");
    }

    public function getTitle()
    {
        return $this->getAttribute("title");
    }

    public function setTitle($title)
    {
        $this->setAttribute("title", $title);
    }

    public function getContent()
    {
        return $this->getAttribute("content");
    }

    public function setContent($content)
    {
        $this->setAttribute("content", $content);
    }

    public function getCreatedAt()
    {
        return $this->getAttribute("created_at");
    }

    public function setCreatedAt($createAt)
    {
        $this->setAttribute("created_at", $createAt);
    }

    public function getTags()
    {
        return $this->getAttribute("tags");
    }

    public function setTags($tags)
    {
        $this->setAttribute("tags", $tags);
    }

    public function getStatus()
    {
        return $this->getAttribute("status");
    }

    public function setStatus($status)
    {
        $this->setAttribute("status", $status);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return Comment[]
     */
    public function getComments()
    {
        return $this->comments()->get()->all();
    }

    public function categories()
    {
        return $this->hasManyThrough(Category::class, TopicCategory::class);
    }

    public function getCategories()
    {
        return $this->categories()->get()->all();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setUser(User $user)
    {
        $this->user()->associate($user);
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }


//id_user int references users (id)
}
