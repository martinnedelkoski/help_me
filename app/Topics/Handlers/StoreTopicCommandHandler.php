<?php

namespace App\Topics\Handlers;

use App\Topics\Commands\StoreTopicCommand;
use App\Topics\Repositories\TopicsRepositoryInterface;
use App\Topics\Topic;

class StoreTopicCommandHandler
{
    private $topics;

    public function __construct(TopicsRepositoryInterface $topics)
    {
        $this->topics = $topics;
    }

    public function handle(StoreTopicCommand $command)
    {
        $topic = new Topic();

        $topic->setContent($command->getContent());
        $topic->setTitle($command->getTitle());
        $topic->setTags($command->getTags());

        $this->topics->store($topic);
    }
}
