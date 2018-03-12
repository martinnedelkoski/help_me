<?php

namespace App\Topics\Handlers;

use App\Categories\Category;
use App\Topics\Commands\StoreTopicCommand;
use App\Topics\Repositories\TopicsRepositoryInterface;
use App\Topics\Topic;
use App\Topics\TopicCategory;

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
        $topic->setUser($command->getUser());

        $this->topics->store($topic);

        $topic = $topic->fresh();

        if ($command->getCategories() != []) {
            foreach ($command->getCategories() as $current) {
                $category = Category::where('name', $current)->get()->first();

                $topicCategory = new TopicCategory();
                $topicCategory->setCategory($category);
                $topicCategory->setTopic($topic);
                $topicCategory->save();
            }
        }
    }
}
