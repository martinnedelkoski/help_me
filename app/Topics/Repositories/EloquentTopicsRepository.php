<?php

/**
 * Created by PhpStorm.
 * User: jovanmilenkoski
 * Date: 1/30/17
 * Time: 22:33
 */
namespace App\Topics\Repositories;

use App\Topics\Topic;

class EloquentTopicsRepository implements TopicsRepositoryInterface
{
    public function find($id)
    {
        return Topic::where("id", $id)->get()->first();
    }

    public function store(Topic $topic)
    {
        $topic->save();
    }

}
