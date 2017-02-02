<?php

namespace App\Topics\Comments\Repositories;

use App\Topics\Comments\Comment;

class EloquentCommentsRepository implements CommentsRepositoryInterface
{
    public function find($id)
    {
        return Comment::where("id", $id)->get()->first();
    }

    public function store(Comment $comment)
    {
        $comment->save();
    }

}
