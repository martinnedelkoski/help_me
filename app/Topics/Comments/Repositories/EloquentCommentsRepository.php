<?php

namespace App\Topics\Comments\Repositories;

use App\Topics\Comments\Comment;
use Exception;

class EloquentCommentsRepository implements CommentsRepositoryInterface
{
    public function find($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            throw new Exception('Comment not found!');
        }

        return $comment;
    }

    public function store(Comment $comment)
    {
        $comment->save();
    }

}
