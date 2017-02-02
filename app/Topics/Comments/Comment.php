<?php

namespace App\Topics\Comments;

use App\Topics\Topic;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";

    public function getId()
    {
        return $this->getAttribute("id");
    }

    public function getCreatedAt()
    {
        return $this->getAttribute("created_at");
    }

    public function getContent()
    {
        return $this->getAttribute("content");
    }

    public function setContent($content)
    {
        $this->setAttribute("content", $content);
    }

    public function getTags()
    {
        return $this->getAttribute("tags");
    }

    public function setTags($tags)
    {
        $this->setAttribute("tags", $tags);
    }

    public function getVotes()
    {
        return $this->getAttribute("votes");
    }

    public function setVotes($votes)
    {
        $this->setAttribute("votes", $votes);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, "topic_id");
    }

    /**
     * @return Topic
     */
    public function getTopic()
    {
        return $this->topic;
    }

    public function setTopic(Topic $topic)
    {
        $this->topic()->associate($topic);
    }

    private function parentComment()
    {
        return $this->belongsTo(Comment::class, "parent_id");
    }

    /**
     * @return Comment
     */
    public function getParent()
    {
        return $this->parentComment;
    }

    public function setParent(Comment $comment)
    {
        $this->parentComment()->associate($comment);
    }

    private function childComments()
    {
        return $this->hasMany(Comment::class);
    }


    /**
     * @return Comment[]
     */
    public function getChildren()
    {
        return $this->childComments()->get()->all();
    }

}
