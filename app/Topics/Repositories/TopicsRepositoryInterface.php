<?php

namespace App\Topics\Repositories;

use App\Topics\Topic;

interface TopicsRepositoryInterface
{
    public function store(Topic $topic);

    /**
     * @param $id
     * @return Topic
     */
    public function find($id);
}
