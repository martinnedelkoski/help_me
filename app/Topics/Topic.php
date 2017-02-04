<?php

namespace App\Topics;

use App\Topics\Comments\Comment;
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

    public function getComments()
    {
        return $this->comments()->get()->all();
    }


//id_user int references users (id)
}
