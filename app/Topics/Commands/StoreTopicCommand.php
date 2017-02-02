<?php

namespace App\Topics\Commands;

class StoreTopicCommand
{
    private $title;
    private $content;
    private $tags;

    public function __construct($title, $content, $tags)
    {
        $this->title = $title;
        $this->content = $content;
        $this->tags = $tags;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getTags()
    {
        return $this->tags;
    }
}
